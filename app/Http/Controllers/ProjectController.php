<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Kris\LaravelFormBuilder\FormBuilder;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->module = 'project';
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
            $query = Project::query()->where('user_id', Auth::user()->id);
            return DataTables::of($query)
            ->addColumn('action','pages.'.$this->module.'._action')
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
        return view('pages.'.$this->module.'.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $code = random_int(100000, 999999);
                $project = [
                    'user_id' => Auth::user()->id,
                    'sprint_type' => $request->sprint_type,
                    'name' => $request->name,
                    'unique_field' => $code,
                ];
                if ($request->hasFile('background')) {
                    $file = $request->file('background');
                    $name = time().'.'.$file->extension();
                    $destinationPath = public_path('background');
                    $file->move($destinationPath, $name);
                    $project['background'] = $name;
                }

                Project::create($project);
            });
            return redirect()->route($this->module . '.index')->with('success','Data berhasil ditambahkan');
        } catch (\Exception $th) {
            $message = $th->getMessage();
            return redirect()->route($this->module . '.index')->with('error',$message);

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
        $project = Project::find($id);
        return view('pages.' .$this->module . '.view',[
            'model' => $project
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
        $project = Project::find($id);
        return view('pages.' .$this->module . '.update',[
            'model' => $project
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
                $model = Project::findOrFail($id);
                $project = [
                    'user_id' => Auth::user()->id,
                    'name' => $request->name,
                    'unique_field' => $model->unique_field,
                ];
                if ($request->hasFile('background')) {
                    $file = $request->file('background');
                    $name = time().'.'.$file->extension();
                    $destinationPath = public_path('background');
                    $file->move($destinationPath, $name);
                    $project['background'] = $name;
                }
                $model->update($project);
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
                $model = Project::find($id);
                if(File::exists(public_path(Storage::url($model->background)))){
                    File::delete(public_path(Storage::url($model->background)));
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
