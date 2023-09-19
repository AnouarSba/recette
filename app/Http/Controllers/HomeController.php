<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Infraction;
use App\Models\Kabid;
use App\Models\Ligne;
use App\Models\Bus;

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
    public function index()
    {
        $r = explode(' ',Carbon::today())[0];
        $kabid = Kabid::where('id','>','2')->get();
        $ligne = Ligne::get();
        $bus = Bus::get();
        return view('pages.dashboard', ['today'=>$r, 'kabids' => $kabid, 'lignes' => $ligne, 'buses' => $bus]);
    }
}