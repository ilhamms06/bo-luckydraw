<?php

namespace App\Http\Controllers;

use App\Models\Screen;
use Illuminate\Http\Request;
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
            $query = Screen::query();
            return DataTables::of($query)
            ->addColumn('action','pages.'. $this->module.'._action')
            ->editColumn('project_id', function ($query) {
                return $query->project->name;
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
    public function store(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $data = [
                    'project_id' => $request->project_id,
                    'name' => $request->name,
                ];
                Screen::create($data);
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
