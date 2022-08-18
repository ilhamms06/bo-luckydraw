<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    public function access_project(Request $request)
    {
        try {
            $project =  DB::table('projects')
                ->where('projects.unique_field', '=', $request->code)
                ->first();
            $data['message'] = 'Berhasil';
            $data['status'] = 200;
            $data['data'] = $project;
        } catch (\Exception $ex) {
            $data['message'] = $ex->getMessage();
            $data['status'] = 500;
        }
        return $data;
    }

    public function access_screen_by_code_project(Request $request)
    {
        try {
            $project =  DB::table('projects')
                ->join('screens', 'screens.project_id', '=', 'projects.id')
                ->select('screens.*')
                ->where('projects.unique_field', '=', $request->code)
                ->first();
            if (count($project) != 0) {
                $data['message'] = 'Berhasil';
                $data['status'] = 200;
                $data['data'] = $project;
            } else {
                $data['message'] = 'Gagal';
                $data['status'] = 400;
            }
        } catch (\Exception $ex) {
            $data['message'] = $ex->getMessage();
            $data['status'] = 500;
        }
        return $data;
    }

    public function getItemByScreen(Request $request)
    {
        try {
            $project =  DB::table('screens')
                ->join('items', 'items.screen_id', '=', 'screens.id')
                ->select('items.*')
                ->where('screens.id', '=', $request->screen_id)
                ->get();
            $data['message'] = 'Berhasil';
            $data['status'] = 200;
            $data['data'] = $project;
        } catch (\Exception $ex) {
            $data['message'] = $ex->getMessage();
            $data['status'] = 500;
        }
        return $data;
    }

    public function getParticipantByItemID(Request $request)
    {
        try {
            $project =  DB::table('items')
                ->join('participants', 'participants.item_id', '=', 'items.id')
                ->select('participants.*')
                ->where('items.id', '=', $request->item_id)
                ->get();
            $data['message'] = 'Berhasil';
            $data['status'] = 200;
            $data['data'] = $project;
        } catch (\Exception $ex) {
            $data['message'] = $ex->getMessage();
            $data['status'] = 500;
        }
        return $data;
    }
}