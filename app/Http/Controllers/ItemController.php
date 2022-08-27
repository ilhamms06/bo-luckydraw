<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemRequest;
use App\Models\Item;
use App\Models\Screen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Kris\LaravelFormBuilder\FormBuilder;
use Yajra\DataTables\Facades\DataTables;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->module = 'item';
        View::share(['module' => $this->module]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Item::query()->whereHas('screen.project', function($q){
                $q->where('user_id', Auth::user()->id);
            });
            return DataTables::of($query)
            ->addColumn('action','pages.'.$this->module.'._action')
            ->editColumn('screen_id', function ($query) {
                if (isset($query->screen->name)) {
                    return $query->screen->name;
                }else{
                    return "Not Found";
                }
            })
            ->addIndexColumn()
            ->make();
        }
       
       return view('pages.'.$this->module . '.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $screen = Screen::whereHas('project', function($q){
            $q->where('user_id', Auth::user()->id);
        })->get();
        return view('pages.'.$this->module.'.create',[
            'screen' => $screen
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $data = [
                    'screen_id' => $request->screen_id,
                    'name' => $request->name,
                    'image' => $request->image,
                    'total_draw' => (int)$request->total_draw,
                    'limit_per_draw' => (int)$request->limit_per_draw,
                ];
                if ($request->hasFile('image')) {
                    $file = $request->file('image');
                    $name = time().'.'.$file->extension();
                    $destinationPath = public_path('image');
                    $file->move($destinationPath, $name);
                    $data['image'] = $name;
                }
                Item::create($data);
            });
            return redirect()->route($this->module . '.index')->with('success','Data berhasil ditambahkan');;
        } catch (\Exception $th) {
        //    $this->logger->error($th);
            return redirect()->route($this->module . '.index')->with('error','Data gagal ditambahkan');;

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Item::find($id);
        return view('pages.' .$this->module . '.view',[
            'model' => $item
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Item::find($id);
        $screen = Screen::all();
        return view('pages.' .$this->module . '.update',[
            'model' => $item,
            'screen' => $screen
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            DB::transaction(function () use ($request, $id) {
                $item = [
                    'screen_id' => $request->screen_id,
                    'name' => $request->name,
                    'total_draw' => $request->total_draw,
                    'limit_per_draw' => $request->limit_per_draw,
                ];
                if ($request->hasFile('image')) {
                    $file = $request->file('image');
                    $name = time().'.'.$file->extension();
                    $destinationPath = public_path('image');
                    $file->move($destinationPath, $name);
                    $data['image'] = $name;
                }
                $model = Item::findOrFail($id);
                $model->update($item);
            });
            return redirect()->route($this->module . '.index')->with('success','Data berhasil diupdate');
        } catch (\Exception $th) {
            $message = $th->getMessage();
            return redirect()->route($this->module . '.index')->with('error',$message);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $model = Item::find($id);
                if(File::exists(public_path(Storage::url($model->image)))){
                    File::delete(public_path(Storage::url($model->image)));
                }
                $model->delete($id);
            });
            return redirect()->route($this->module . '.index')->with('success','Data berhasil dihapus');;
        } catch (\Exception $ex) {
            $data['message'] = $ex->getMessage();
            $status = 500;
        }
    }
}
