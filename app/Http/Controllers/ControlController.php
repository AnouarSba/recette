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
    return redirect()->route('home');

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
        $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(10);

// Add some data

$range = $this->create_columns_range('A', 'ZZ');
$k=0;
for ($i=0; $i <150 ; $i+=5) { 
    $k++;
    $j=$i+4;
$spreadSheet->setActiveSheetIndex(1)
        ->setCellValue($range[$i].'1', 'A'.$k);
        $spreadSheet->getActiveSheet()->getStyle($range[$i].'1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$spreadSheet->getActiveSheet()->getStyle($range[$i].'1')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
        $begin = $range[$i]."1";
        $end = $range[$j]."1";
        $spreadSheet->getActiveSheet()->mergeCells("{$begin}:{$end}");  
}

	
	  
    
   
$spreadSheet->getActiveSheet()->fromArray($etat_bus,Null,'A2');
        
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
    function create_columns_range($start = 'A', $end = 'ZZ'){
        $return_range = [];
        for ($i = $start; $i !== $end; $i++){
            $return_range[] = $i;
        }
        return $return_range;
    }
    function exportData(Request $request){
        $req = $request->validate([
            'start_date' => 'required|date',
            'brigade' => 'required',
           ]);
           $from= $req['start_date'];	
           $types= ['','A','B','C','D'];
        $data_array [] = array("Num","Receveur","Recette");
       if ($req['brigade'] == 0) {
        $data = Recette::query();
       } else {
        $data = Recette::query()->where('brigade',$req['brigade']);
       }
        $data = $data
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
        if ($req['brigade'] == 0) {
            $data = Recette::query();
           } else {
            $data = Recette::query()->where('brigade',$req['brigade']);
           }
            $data = $data
            ->join('buses', 'buses.id', '=', 'recettes.bus_id')
           /* ->join('lignes', 'lignes.id', '=', 'recettes.ligne_id')
            ->join('buses', 'buses.id', '=', 'recettes.bus_id')*/
            ->where('b_date', $from)
            ->select("buses.name as bname",   DB::raw("sum(t20) as t20"),   DB::raw("sum(t25) as t25"),   DB::raw("sum(t30) as t30"))
            ->groupBy(['bname'])->orderBy('bus_id', 'ASC')
            ->get();
        $arr = array("15","20","25","30","40");
        $arrs=[];
        for($i=0;$i<29;$i++)
        array_push($arrs, ...$arr);
        
        $data_array2 [] = $arrs;
      $d=[];
      $arr =[];
      $arrs =[];
        foreach($data as $data_item)
        {   
            $arr[$data_item->bname]= [$data_item->t20,$data_item->t25,$data_item->t30];
            array_push($arrs,$data_item->bname);
        }

            for ($i=1; $i <=30 ; $i++) { 
                $j= ($i<10)? "A0".$i : "A".$i; 
                if (in_array($j, $arrs)) {
                    
                 $t15=0;
            $t40=0;
            $t20 = ($arr[$j][0] > 0)? $arr[$j][0] *20 : 0;
            $t25 = ($arr[$j][1] > 0)? $arr[$j][1] *25 : 0;
            $t30 = ($arr[$j][2] > 0)? $arr[$j][2] *30 : 0;
             array_push($d,$t15);
             array_push($d,$t20);
             array_push($d,$t25);
             array_push($d,$t30);
             array_push($d,$t40);
            } else {
                array_push($d,0);
                array_push($d,0);
                array_push($d,0);
                array_push($d,0);
                array_push($d,0);

            }
        }
        
            
             $data_array2 [] =$d; /*  $data = Vent::query()
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