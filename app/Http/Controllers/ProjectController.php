<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Kris\LaravelFormBuilder\FormBuilder;
use Yajra\DataTables\Facades\DataTables;

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
            // $model = Project::where('user_id', Auth::user()->id)->get();
            $query = Project::query();
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
    public function create(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(\App\Forms\ProjectForm::class, [
            'method' => 'POST',
            'url' => route('project.store')
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
                $blog = [
                    'user_id' => 1,
                    'name' => $request->name,
                    // 'background' => $request->file('background')->store('background'),
                    'unique_field' => $request->unique_field,
                ];
                if ($request->file('background')) {
                    $blog['background'] = $request->file('background')->store('background-img');
                }
                // dd($blog);
                Project::create($blog);
                return redirect()->route($this->module . '.index')->with('success','Data berhasil ditambahkan');;
            });
        } catch (\Exception $th) {
        //    $this->logger->error($th);
            return redirect()->route($this->module . '.index')->with('error','Data berhasil ditambahkan');;

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
