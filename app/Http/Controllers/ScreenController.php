<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScreenRequest;
use App\Models\Screen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Kris\LaravelFormBuilder\FormBuilder;
use Yajra\DataTables\Facades\DataTables;

class ScreenController extends Controller
{
    public function __construct()
    {
        $this->module = 'screen';
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
            $query = Screen::query()->whereHas('project', function($q){
                $q->where('user_id', Auth::user()->id);
            });
            return DataTables::of($query)
            ->addColumn('action','pages.'. $this->module.'._action')
            ->editColumn('project_id', function ($query) {
                if (isset($query->project->name)) {
                    return $query->project->name;
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
    public function create(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(\App\Forms\ScreenForm::class, [
            'method' => 'POST',
            'url' => route('screen.store')
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
    public function store(ScreenRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $screen = [
                    'project_id' => $request->project_id,
                    'name' => $request->name,
                ];
                Screen::create($screen);
            });
            return redirect()->route($this->module . '.index')->with('success','Data berhasil ditambahkan');;
        } catch (\Exception $th) {
            return redirect()->route($this->module . '.index')->with('error',$th->getMessage());;

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
        $screen = Screen::find($id);
        return view('pages.' .$this->module . '.view',[
            'model' => $screen
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(FormBuilder $formBuilder,$id)
    {
        $screen = Screen::find($id);
        $form = $formBuilder->create(\App\Forms\ScreenForm::class, [
            'method' => 'PUT',
            'url' => route('screen.update',$id),
            'model' => $screen,
        ]);
        return view('pages.' .$this->module . '.create',[
            'form' => $form
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
                $screen = [
                    'project_id' => $request->project_id,
                    'name' => $request->name,
                ];
                $model = Screen::findOrFail($id);
                $model->update($screen);
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
                $model = Screen::find($id);
                $model->delete($id);
            });
            return redirect()->route($this->module . '.index')->with('success','Data berhasil dihapus');;
        } catch (\Exception $ex) {
            $data['message'] = $ex->getMessage();
            $status = 500;
        }
    }
}
