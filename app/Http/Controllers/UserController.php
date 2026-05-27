<?php

namespace App\Http\Controllers;

use App\Models\Notes;
use App\Models\Order;
use App\Models\Preparing;
use App\Models\PreparingImage;
use App\Models\Sample;
use App\Models\Project;
use App\Models\SurveyKepuasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index()
    {
        $projectM = new Project();
        $data['project'] = $projectM->with('orders')->where('id_user', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        return view('order.index', $data);
    }

    public function informasi()
    {
        $data['sidebar_step'] = 1;
        $data['sidebar_progress'] = 12.5;  
        return view('order.informasi', $data);
    }

    public function pilihLab()
    {
        $sampleM = new Sample();
        $projectM = new Project();
        
        $data['project'] = $projectM->find(Session::get('id_project'));
        $data['sample'] = $sampleM->where('type', 'Sample')->where('display', 'Show')->get();
        $data['sidebar_step'] = $data['project']->sidebar_step;
        $data['sidebar_progress'] = 25;   
        return view('order.pilihlab', $data);
    }

    public function quotation()
    {
        $orderM = new Order();
        $sampleM = new Sample();
        $projectM = new Project();
        $data['orders'] = $orderM->leftJoin('sample', 'sample.id_sample', '=', 'orders.id_sample')
        ->where('orders.id_project', Session::get('id_project'))->get();
        $data['preparation'] = $sampleM->where('type', 'Preparation')->first();
        $data['project'] = $projectM->find(Session::get('id_project'));

        $data['sidebar_step'] = $data['project']->sidebar_step;
        $data['sidebar_progress'] = 37.5;    
        return view ('order.quotation', $data);
    }

    public function pengiriman()
    {
        $projectM = new Project();
        $data['project'] = $projectM->find(Session::get('id_project'));
        $data['sidebar_step'] = $data['project']->sidebar_step;
        $data['sidebar_progress'] = 50;
        return view('order.pengiriman', $data);
    }

    public function preparasi()
    {
        $id_project = Session::get('id_project');
        $data['preparing'] = Preparing::where('id_project', $id_project)->get();
        $data['notes'] = Notes::where('id_project', $id_project)->first();
        $data['images'] = PreparingImage::where('id_project', $id_project)->get();
        $data['project'] = Project::where('id_project', $id_project)->first();
        $data['sidebar_step'] = $data['project']->sidebar_step;
        $data['sidebar_progress'] = 62.5; 
        return view('order.preparasi', $data);
    }

    public function labtest()
    {
        $orderM = new Order();
        $projectM = new Project();
        $data['project'] = $orderM->with(['project', 'sample', 'labtest'])->where('id_project', Session::get('id_project'))->get();
        $data['proj'] = $projectM->find(Session::get('id_project'));

        $total_selesai = 0;
        $total_sample = 0;
        foreach($data['project'] as $row)
        {
            $total_sample += $row->quantity * $row->sample->sample_rates;
            if(isset($row->labtest))
            {
                $total_selesai += $row->labtest->selesai_qty;
            }
        }

        $data['total_sample'] = $total_sample;
        $data['total_selesai'] = $total_selesai;
        $data['sidebar_step'] = $data['proj']->sidebar_step;
        $data['sidebar_progress'] = 75;  
        return view('order.labtest', $data);
    }

    public function invoice()
    {
        $projectM = new Project();
        $data['project'] = $projectM->find(Session::get('id_project'));
        $data['sidebar_step'] = $data['project']->sidebar_step;
        $data['sidebar_progress'] = 87.5;  
        return view('order.invoice', $data);
    }

    public function download()
    {
        $survey = SurveyKepuasan::where('id_project', Session::get('id_project'))->first();
        $data['project'] = Project::with(['hasil_image'])->find(Session::get('id_project'));

        $data['sidebar_step'] = $data['project']->sidebar_step;
        $data['sidebar_progress'] = 100;
        $data['survey'] = $survey;
        return view('order.download', $data);
    }
}
