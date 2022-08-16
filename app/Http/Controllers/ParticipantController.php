<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Kris\LaravelFormBuilder\FormBuilder;
use Yajra\DataTables\Facades\DataTables;

class ParticipantController extends Controller
{
    public function __construct()
    {
        $this->module = 'participant';
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
            $query = Participant::query();
            return DataTables::of($query)
            ->addColumn('action','pages.'. $this->module.'._action')
            ->editColumn('project_id', function ($query) {
                return $query->project->name;
            })
            ->editColumn('screen_id', function ($query) {
                return $query->screen->name;
            })
            ->editColumn('item_id', function ($query) {
                return $query->item->name;
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
        $form = $formBuilder->create(\App\Forms\ParticipantForm::class, [
            'method' => 'POST',
            'url' => route('participant.store')
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
                    'screen_id' => $request->screen_id,
                    'item_id' => $request->item_id,
                    'code' => $request->code,
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'branch' => $request->branch,
                    'province' => $request->province,
                    'city' => $request->city,
                ];
                Participant::create($data);
                return redirect()->route($this->module . '.index')->with('success','Data berhasil ditambahkan');;
            });
        } catch (\Exception $th) {
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
