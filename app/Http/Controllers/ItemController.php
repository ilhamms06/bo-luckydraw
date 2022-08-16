<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            $query = Item::query();
            return DataTables::of($query)
            ->addColumn('action','pages.'.$this->module.'._action')
            ->editColumn('screen_id', function ($query) {
                return $query->screen->name;
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
    public function create(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(\App\Forms\ItemForm::class, [
            'method' => 'POST',
            'url' => route('item.store')
        ]);
        return view('pages.'.$this->module.'.create',[
            'form' => $form
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
                // dd($data);
                // $input = $request->all();
                // if ($request->hasFile('image')) {
                //     $file = $request->file('image');
                //     $name = time().'.'.$file->extension();
                //     $destinationPath = public_path('project-images');
                //     $file->move($destinationPath, $name);
                //     $input['image'] = $name;
                // }
                Item::create($data);
                return redirect()->route($this->module . '.index')->with('success','Data berhasil ditambahkan');;
            });
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
