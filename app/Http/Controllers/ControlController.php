<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;
use App\Models\Infraction;
use App\Models\Coffre;
use App\Models\Chauffeur;
use App\Models\Kabid;
use App\Models\Fkab;
use App\Models\Fchauffeur;
use App\Models\User;
use App\Models\Position;
use App\Models\Bus;
use App\Models\Ligne;
use App\Models\Arret;
use App\Models\Recette;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Location\Facades\Location;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\Client;
use App\Models\Flixy;
use App\Models\Vent;
use \PhpOffice\PhpWord\TemplateProcessor;
use Carbon\carbon;
class ControlController extends Controller
{
    public function control(Request $request)
{
    $users = User::where('id', '>', 2)->get();
    return view('controls.control', ['users' => $users]);

}

public function recette(Request $request)
{


    $y = Auth::id();
    $name = $request->name;
    $brigade = $request->brigade;
    $recette = $request->recette;
    $dette = $request->dettes;
    $ligne = $request->ligne_id;
    $bus_id = $request->bus_id;
    $type = $request->type;
    $t20 = $request->t20;
    $t25 = $request->t25;
    $t30 = $request->t30;
    $s20 = $request->s20;
    $s25 = $request->s25;
    $s30 = $request->s30;
    $r20 = $request->r20;
    $r25 = $request->r25;
    $r30 = $request->r30;
    $date = $request->date;
   // DB::statement("SET SQL_MODE=''");
    $row = Recette::create(['user_id' => $y, 'emp_id' => $name, 'brigade' => $brigade, 'type' => $type, 'recette' => $recette, 'dette' => $dette,'bus_id' => $bus_id,'ligne_id' => $ligne, 't20' => $t20,'t25' => $t25,'t30' => $t30,  's20' => $s20,'s25' => $s25,'s30' => $s30,  'r20' => $r20,'r25' => $r25,'r30' => $r30, 'b_date' => $date ]);
   
    $r = explode(' ',Carbon::today())[0];
    $kabid = Kabid::where('id','>','2')->get();
    $ligne = Ligne::get();
    $bus = Bus::get();
    return view('pages.dashboard', ['today'=>$r, 'kabids' => $kabid, 'lignes' => $ligne, 'buses' => $bus]);

}
    public function ExportExcel($etat_rec, $etat_bus, $etat_ligne){
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '4000M');        
        try {
            $spreadSheet = new Spreadsheet();
            $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
            $spreadSheet->getActiveSheet()->fromArray($etat_rec);
        $spreadSheet->getActiveSheet()->setTitle('Etat_receveur');
            $spreadSheet->createSheet();
            
        /* Add some data */
        $spreadSheet->setActiveSheetIndex(1);
        $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
        $spreadSheet->getActiveSheet()->fromArray($etat_bus);
        
        $spreadSheet->getActiveSheet()->setTitle('Etat_bus');
        $spreadSheet->createSheet();
            
        /* Add some data */
        $spreadSheet->setActiveSheetIndex(2);
        $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
        $spreadSheet->getActiveSheet()->fromArray($etat_ligne);
        
        $spreadSheet->getActiveSheet()->setTitle('Etat_ligne');
        $spreadSheet->setActiveSheetIndex(0);

            $Excel_writer = new Xls($spreadSheet);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Etat_ExportedData.xls"');
            header('Cache-Control: max-age=0');
            ob_end_clean();
            $Excel_writer->save('php://output');
            exit();
        } catch (Exception $e) {
            return;
        }
    }
    /**
     *This function loads the customer data from the database then converts it
     * into an Array that will be exported to Excel
     */
    function exportData(Request $request){
        $req = $request->validate([
            'start_date' => 'required|date',
           ]);
           $from= $req['start_date'];	
           $types= ['','A','B','C','D'];
        $data_array [] = array("Num","Receveur","Recette");
       
        $data = Recette::query()
        ->join('kabids', 'kabids.id', '=', 'recettes.emp_id')
       /* ->join('lignes', 'lignes.id', '=', 'recettes.ligne_id')
        ->join('buses', 'buses.id', '=', 'recettes.bus_id')*/
        ->where('b_date', $from)
        ->select("kabids.name as kname",   DB::raw("sum(recette) as recette"))
        ->groupBy(['kname'])->orderBy('emp_id', 'ASC')
        ->get();
        $i = 0;
        foreach($data as $data_item)
        { $i++;
            $data_array[] = array(
                'Num' =>$i,
                'Receveur' => $data_item->kname,
                'Recette' => $data_item->recette,
               /* 'Ligne' => $data_item->lname,
                'Bus' => $data_item->bname,
                'Bus' => $types[$data_item->type],*/
                
            );
        }
      /*  $data = Flixy::query()
        ->join('kabids', 'kabids.id', '=', 'flixies.flixy_id')->where('flixy_type','App\Models\Kabid')->whereBetween('flixies.created_at', [$from, $to])->select("flixy_id", "name", DB::raw("sum(amount) as flexy"))
        ->groupBy('flixy_id')->orderBy('flexy', 'DESC')
        ->get();*/
    
        $data_array2 [] = array("Num","Name","Flexy");
       /* $i = 0;
        foreach($data as $data_item)
        { $i++;
            $data_array2[] = array(
                'Num' =>$i,
                'Name' => $data_item->name,
                'Flexy' => $data_item->flexy
            );
        }
        $data = Vent::query()
        ->join('controls', 'controls.id', '=', 'vents.c_id')->where('c_type','App\Models\Control')
        ->whereBetween('vents.created_at', [$from, $to])
        ->select("c_id", "name", DB::raw("count(vents.id) as cmpt"))
        ->groupBy('c_id')->orderBy('cmpt', 'DESC')
        ->get();*/
        $data_array3 [] = array("Num","Name","Count");/*
        $i = 0;
        foreach($data as $data_item)
        { $i++;
            $data_array3[] = array(
                'Num' =>$i,
                'Name' => $data_item->name,
                'Count' => $data_item->cmpt
            );
        }*/
        return $this->ExportExcel($data_array,$data_array2,$data_array3);
    }



    public function Infractions()
    {
        return view('pages.Infractions');
    }
    public function Coffre()
    {
        return view('pages.Coffre');
    }
    public function Alerts()
    {
        return view('pages.Alerts');
    }
    public function Accidents()
    {
        return view('pages.Accidents');
    }
    public function Declaration_perte()
    {
        return view('pages.Declaration_perte');
    }
    public function Controle_Employer()
    {
        return view('pages.Controle_Employer');
    }
    public function Controle_Bus()
    {
        return view('pages.Controle_Bus');
    }



}