<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\SurveyKepuasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SurveyController extends Controller
{

    public function ajaxDataTable(Request $request)
    {
        $data = SurveyKepuasan::where('id_project', $request->id_project)->get();
        $myArray = [];
        array_push($myArray, (object)[
            'name' => 'Ketepatan Waktu',
            'value' => $data[0]->ketepatan_waktu,
        ]);
        array_push($myArray, (object)[
            'name' => 'Komunikasi',
            'value' => $data[0]->komunikasi,
        ]);
        array_push($myArray, (object)[
            'name' => 'Kejelasan',
            'value' => $data[0]->kejelasan,
        ]);
        array_push($myArray, (object)[
            'name' => 'Informasi',
            'value' => $data[0]->informasi,
        ]);
        return datatables($myArray)->make(true);
    }
    public function addSurvey(Request $request)
    {
        $survey = new SurveyKepuasan();
        $survey->id_user = Auth::user()->id;
        $survey->id_project = Session::get('id_project');
        $survey->ketepatan_waktu = $request->ketepatan_waktu;
        $survey->komunikasi = $request->komunikasi;
        $survey->kejelasan = $request->kejelasan;
        $survey->informasi = $request->informasi;
        $survey->save();

        $projectM = Project::find(Session::get('id_project'));
        $projectM->saran = $request->saran;
        $projectM->sidebar_step = 8;
        $projectM->save();

        $response['code'] = 200;
        $response['message'] = 'success';
        $response['data'] = $survey;

        return response()->json($response, 200);
    }

    public function editSurvey(Request $request)
    {
        $survey = SurveyKepuasan::find($request->id_survey);
        $survey->ketepatan_waktu = $request->ketepatan_waktu;
        $survey->komunikasi = $request->komunikasi;
        $survey->kejelasan = $request->kejelasan;
        $survey->informasi = $request->informasi;
        $survey->save();

        $projectM = Project::find(Session::get('id_project'));
        $projectM->saran = $request->saran;
        $projectM->sidebar_step = 8;
        $projectM->save();

        $response['code'] = 200;
        $response['message'] = 'success';
        $response['data'] = $survey;

        return response()->json($response, 200);
    }
}
