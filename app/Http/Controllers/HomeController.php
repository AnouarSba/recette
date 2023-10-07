<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Infraction;
use App\Models\Kabid;
use App\Models\Ligne;
use App\Models\Bus;
use App\Models\Validation;

use Carbon\carbon;

class HomeController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $r = explode(' ',Carbon::today())[0];
        $kabid = Kabid::where('id','>','2')->get();
        $ligne = Ligne::get();
        $bus = Bus::get();
        $day = '';
        if($request->month)
        $m = $request->month;
        else{
        $m = date('m',strtotime("-1 days"));
        $day = 'ليوم '.date('d/m/y',strtotime("-1 days"));
        }
        $data = Validation::whereMonth('c_date',$m)->get();
        
        return view('pages.dashboard', ['today'=>date('Y-m-d'),'data'=>$data,'kabids'=>$kabid,'lignes'=>$ligne, 'm' => $m, 'day' => $day, 'buses' => $bus]);
    }
}