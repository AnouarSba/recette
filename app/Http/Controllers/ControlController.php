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
use App\Models\Validation;
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
    $flexy = $request->flexy;
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
    $rotation = $request->rotation;
   // DB::statement("SET SQL_MODE=''");
    $row = Recette::create(['user_id' => $y, 'emp_id' => $name, 'brigade' => $brigade,'rotation' => $rotation, 'type' => $type, 'recette' => $recette, 'flexy' => $flexy, 'dette' => $dette,'bus_id' => $bus_id,'ligne_id' => $ligne, 't20' => $t20,'t25' => $t25,'t30' => $t30,  's20' => $s20,'s25' => $s25,'s30' => $s30,  'r20' => $r20,'r25' => $r25,'r30' => $r30, 'b_date' => $date ]);
   
    $r = explode(' ',Carbon::today())[0];
    $kabid = Kabid::where('id','>','2')->get();
    $ligne = Ligne::get();
    $bus = Bus::get();
    return redirect()->route('home');

}

public function confirm(Request $request)
{


    $y = Auth::id();
    $smm= Recette::where('b_date', $request->input('date') )->where('brigade', 1)->select( DB::raw("sum(recette) as recette"))->get();
    $sms= Recette::where('b_date', $request->input('date') )->where('brigade', 2)->select( DB::raw("sum(recette) as recette"))->get();
    $smn= Recette::where('b_date', $request->input('date') )->where('brigade', 3)->select( DB::raw("sum(recette) as recette"))->get();
    $smn= ($smn[0]->recette !=null)? $smn[0]->recette : 0 ;
    $sms= ($sms[0]->recette !=null)? $sms[0]->recette : 0 ;
    $smm= ($smm[0]->recette !=null)? $smm[0]->recette : 0 ;
   
    $valid = Validation::updateOrCreate(
        ['c_date' => $request->input('date')],
        ['user_id' => $y,

            'sbm' => $smm,
            'sbs' => $sms,
            'sbn' => $smn,
            'money' => $smm+$sms+$smn,

            'tsc' => $request->input('tsc'),
            'tc' => $request->input('tc'),
            'flexy' => $request->input('flexy') + $request->input('cf')]
    );
    $brigade =  $request->brigade;
    $date = $request->date;
   // DB::statement("SET SQL_MODE=''");
   
    return redirect()->route('get_list',["start_date" => $date,'brigade' =>$brigade,'confirm' =>1]);

}
    public function ExportExcel($etat_rec, $etat_bus, $etat_ligne,$rotation_b,$rotation_l){
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
        $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(8);
        $k=0;
$l=[16,9,11,25,27,26,28,' ',03,'-T lac'];
$c=[4,5,8,10,8,12,12,1,3,9];
for ($i=0; $i <64 ;$i+=$c[$k-1]) { 
        
$spreadSheet->setActiveSheetIndex(2)
        ->setCellValue($range[$i].'1', 'Ligne'.$l[$k]);
        $spreadSheet->getActiveSheet()->getStyle($range[$i].'1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$spreadSheet->getActiveSheet()->getStyle($range[$i].'1')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
    $k++;
    $begin = $range[$i]."1";
    $end = $range[$c[$k-1]-1]."1";

        $spreadSheet->getActiveSheet()->mergeCells("{$begin}:{$end}");  
}
	  
        $spreadSheet->getActiveSheet()->fromArray($etat_ligne,Null,'A2');
        
        $spreadSheet->getActiveSheet()->setTitle('Etat_ligne');



        $spreadSheet->createSheet();
            
        /* Add some data */
        $spreadSheet->setActiveSheetIndex(3);
        $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(8);
     /*   $k=0;
$l=[16,9,11,25,27,26,28,' ',03,'-T lac'];
$c=[4,5,8,10,8,12,12,1,3,9];
for ($i=0; $i <64 ;$i+=$c[$k-1]) { 
        
$spreadSheet->setActiveSheetIndex(2)
        ->setCellValue($range[$i].'1', 'Ligne'.$l[$k]);
        $spreadSheet->getActiveSheet()->getStyle($range[$i].'1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$spreadSheet->getActiveSheet()->getStyle($range[$i].'1')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
    $k++;
    $begin = $range[$i]."1";
    $end = $range[$c[$k-1]-1]."1";

        $spreadSheet->getActiveSheet()->mergeCells("{$begin}:{$end}");  
}*/
	  
        $spreadSheet->getActiveSheet()->fromArray($rotation_b,Null,'A2');
        
        $spreadSheet->getActiveSheet()->setTitle('Rotation_bus');





        $spreadSheet->createSheet();
            
        /* Add some data */
        $spreadSheet->setActiveSheetIndex(4);
        $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(8);
      $k=0;
$l=[16,9,11,27,25,26,28,03,'-T lac'];
$c=[4,5,4,3,5,5,4,3,4];
for ($i=0; $i <37 ;$i+=$c[$k-1]) { 
        
$spreadSheet->setActiveSheetIndex(4)
        ->setCellValue($range[$i].'1', 'Ligne'.$l[$k]);
        $spreadSheet->getActiveSheet()->getStyle($range[$i].'1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$spreadSheet->getActiveSheet()->getStyle($range[$i].'1')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
    $k++;
    $begin = $range[$i]."1";
    $end = $range[$c[$k-1]-1]."1";

        $spreadSheet->getActiveSheet()->mergeCells("{$begin}:{$end}");  
}
	  
        $spreadSheet->getActiveSheet()->fromArray($rotation_l,Null,'A2');
        
        $spreadSheet->getActiveSheet()->setTitle('Rotation_ligne');





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
            ->select("buses.name as bname",   DB::raw("sum(rotation) as rotation"), DB::raw("sum(t20) as t20"),   DB::raw("sum(t25) as t25"),   DB::raw("sum(t30) as t30"))
            ->groupBy(['bname'])->orderBy('bus_id', 'ASC')
            ->get();
        $arr = array("15","20","25","30","40");
        $arrs=[];
        for($i=0;$i<29;$i++)
        array_push($arrs, ...$arr);
        
        $data_array2 [] = $arrs;
      $d=[];
      $arr =[];
      $arr_br =[];
      $arrs =[];
        foreach($data as $data_item)
        {   
            $arr[$data_item->bname]= [$data_item->t20,$data_item->t25,$data_item->t30];
            array_push($arrs,$data_item->bname);
            array_push($arr_br,$data_item->rotation);
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
        
            
             $data_array2 [] =$d; 
             
           
             if ($req['brigade'] == 0) {
                $datal = Recette::query();
               } else {
                $datal = Recette::query()->where('brigade',$req['brigade']);
               }
                $datal = $datal
                ->join('lignes', 'lignes.id', '=', 'recettes.ligne_id')
               /* ->join('lignes', 'lignes.id', '=', 'recettes.ligne_id')
                ->join('lignes', 'lignes.id', '=', 'recettes.bus_id')*/
                ->where('b_date', $from)
                ->select("lignes.name as lname","lignes.ordre as ordre", "type",  "t20",  "t25",  "t30","rotation")
               // ->groupBy(['lname'])
               ->orderBy('lignes.ordre', 'ASC')
                ->get();
                $j=0;
                $i=0;
 /*               $end= end($data);
                $endkey = key($end);
                $count = [];
                foreach($data as $key => $data_item)
                {   
                    if ($data_item->ordre != $j) {
                        $j = $data_item->ordre;
                    array_push($count,$i);

                        $i=0;
                        # code...
                    }else $i++;
                    $arr[$j][$i]= [$data_item->t20,$data_item->t25,$data_item->t30];
                    array_push($arrs,$j);
                    if ($key == $endkey) {
                        array_push($count,$i);
                    }
                }
                    /*$k=0;
                    for ($i=1; $i <=9 ; $i++) { 
                        
                        if (in_array($i, $arrs)) {
                            $k++;
                            if ($i==1) {
                               for ($j=0; $j < $count[$k] ; $j++) { 
                                array_push($d,$arr[$i][$j]);
                               }
                               for ($j=0; $j <4- $count[$k] ; $j++) { 
                                array_push($d,0);
                               }
                            }
                            if ($i==2) {
                                for ($j=0; $j < $count[$k] ; $j++) { 
                                 array_push($d,$arr[$i][$j]);
                                }
                                for ($j=0; $j <5- $count[$k] ; $j++) { 
                                 array_push($d,0);
                                }
                             }
        
                    }*/
                
            $arr = [];
            
            for ($i=0; $i <9 ;$i++) { 
            array_push($arr,20);
            }
            for ($i=0; $i <13 ;$i++) { 
                array_push($arr,15);
                array_push($arr,20);
                }
                for ($i=0; $i <4 ;$i++) { 
                    array_push($arr,15);
                    array_push($arr,20);
                    array_push($arr,30);
                    }
                    for ($i=0; $i <4 ;$i++) { 
                        array_push($arr,15);
                        array_push($arr,20);
                        array_push($arr,25);
                        }
                    array_push($arr,20);

                    for ($i=0; $i <3 ;$i++) { 
                        array_push($arr,20);
                        }
                        for ($i=0; $i <3 ;$i++) { 
                            array_push($arr,15);
                            array_push($arr,20);
                            array_push($arr,25);
                            }
        $data_array3 [] = $arr;
        $arp= [];
        $cl='cl';
            $k=1;
            $j=0;
         //   $l=[16,9,11,25,27,26,28,' ',03,'-T lac'];
$c=[4,5,8,10,8,12,12,3,9];
            for ($i=1; $i <=9 ; $i++) { 
                $l=$c[$k-1];
                $k++;
                for ($j=0; $j < $l; $j++) { 
                    
                    ${$cl.$i.$j} =0;
                }
            } 
            foreach($datal as $key => $data_item)
                {   
                    if ($data_item->ordre != $j) {
                        $j = $data_item->ordre;
                  //  array_push($count,$i);

                        $i=0;
                        # code...
                    }else $i++;

                    if ((($j==3 || $j==4 || $j==5) && $i%2==0) ) {
                        $i++;
                    }
                    if($j==6  ){
                        $i++;
                    ${$cl.$j.$i}= $data_item->t20*20;
                    $i++;
                    ${$cl.$j.$i}= $data_item->t30*30;                
                }
                    elseif(($j==7 || $j==9)){
                        $i++;
                        ${$cl.$j.$i}= $data_item->t20*20;
                        $i++;
                        ${$cl.$j.$i}= $data_item->t25*25;                
                    }
                    else
                    ${$cl.$j.$i}= $data_item->t20*20;
                /*    array_push($arrs,$j);
                    if ($key == $endkey) {
                        array_push($count,$i);
                    }*/
                }
                $k=1;
                //   $l=[16,9,11,25,27,26,28,' ',03,'-T lac'];
       $c=[4,5,8,10,8,12,12,3,9];
                   for ($i=1; $i <=9 ; $i++) { 
                    if ($i==8) {
                        array_push($arp,0);
                    }
                       $l=$c[$k-1];
                       $k++;
                       for ($j=0; $j < $l; $j++) { 
                           
                           array_push($arp,${$cl.$i.$j});
                       }
                   } 

            $data_array3 [] = $arp;
            $data_array4=[];
            $arr=[];
            $arr_t=[];
            $k=0;
            for ($i=1; $i <31 ; $i++) { 
                $j= ($i<10)? "A0".$i : "A".$i; 
                array_push($arr_t,$j);
                if (in_array($j, $arrs)) {
                   array_push($arr,$arr_br[$k]);
                   $k++;
            } else {
                array_push($arr,0);
                        }

            }
            $data_array4[]= $arr_t;
            $data_array4[]= $arr;
            $data_array5=[];
            $arp= [];
            $cl='cl';
                $k=1;
                $j=0;
             //   $l=[16,9,11,25,27,26,28,' ',03,'-T lac'];
             $c=[4,5,4,3,5,5,4,3,4];
             for ($i=1; $i <=9 ; $i++) { 
                    $l=$c[$k-1];
                    $k++;
                    for ($j=0; $j < $l; $j++) { 
                        
                        ${$cl.$i.$j} =0;
                    }
                } 
                $j=0;
                foreach($datal as $key => $data_item)
                    {   
                        if ($data_item->ordre != $j) {
                            $j = $data_item->ordre;
                      //  array_push($count,$i);
    
                            $i=0;
                            # code...
                        }else $i++;
    
                        
                        ${$cl.$j.$i}= $data_item->rotation;
                    /*    array_push($arrs,$j);
                        if ($key == $endkey) {
                            array_push($count,$i);
                        }*/
                    }
                    $k=1;
                    //   $l=[16,9,11,25,27,26,28,' ',03,'-T lac'];
                    $c=[4,5,4,3,5,5,4,3,4];
                    for ($i=1; $i <=9 ; $i++) { 
                           $l=$c[$k-1];
                           $k++;
                           for ($j=0; $j < $l; $j++) { 
                               
                               array_push($arp,${$cl.$i.$j});
                           }
                       } 
    
                $data_array5 [] = $arp;
          
        /*
        $i = 0;
        foreach($data as $data_item)
        { $i++;
            $data_array3[] = array(
                'Num' =>$i,
                'Name' => $data_item->name,
                'Count' => $data_item->cmpt
            );
        }*/
        return $this->ExportExcel($data_array,$data_array2,$data_array3,$data_array4,$data_array5);
    }



    public function Infractions()
    {
        return view('pages.Infractions');
    }
    public function update(Request $request)
    {
        if ($request->val ){
            $kname= $request->val['kname'];
            $bname= $request->val['bname'];
            $lname= $request->val['lname'];
            $recette= $request->val['recette'];
            $t20= $request->val['t20'];
            $t25= $request->val['t25'];
            $t30= $request->val['t30'];
            $s20= $request->val['s20'];
            $s25= $request->val['s25'];
            $s30= $request->val['s30'];
            $r20= $request->val['r20'];
            $r25= $request->val['r25'];
            $r30= $request->val['r30'];
            $brigade= $request->val['brigade'];
            $type= $request->val['type'];
            $flexy= $request->val['flexy'];
            $rotation= $request->val['rotation'];
            $rc = Recette::where('id', $request->val['id'])->first();
            if ($rc) {
    
                $rc->update([
                    'emp_id'		=>	$kname,
                    'bus_id'		=>	$bname,
                    'ligne_id'		=>	$lname,
                    'type'		=>	$type,
                    'brigade'		=>	$brigade,
                    't20'		=>	$t20,
                    't25'		=>	$t25,
                    't30'		=>	$t30,
                    's20'		=>	$s20,
                    's25'		=>	$s25,
                    's30'		=>	$s30,
                    'r20'		=>	$r20,
                    'r25'		=>	$r25,
                    'r30'		=>	$r30,
                    'recette'		=>	$recette,
                    'rotation'		=>	$rotation,
                    'flexy'		=>	$flexy,
            ]);
                    return  ['تم التحديث بنجاح',$brigade,$rc->b_date];

            }
        }
        return false;
    }

    public function delete(Request $request)
    {
        if ($request->val ){
            $rc = Recette::where('id', $request->val)->first();
            if ($rc) {
    
                $rc->delete();
                    return  ['تم الحذف ',$rc->brigade,$rc->b_date];

            }
        }
        return false;
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
    public function list(Request $request)
    {
        if ($request->brigade >=1) {
            $data = Recette::query()->where('b_date', $request->start_date)->where('brigade',$request->brigade);
        }
        else
        $data = Recette::query()->where('b_date', $request->start_date);

        $data = $data
        ->join('kabids', 'kabids.id', '=', 'recettes.emp_id')
        ->join('buses', 'buses.id', '=', 'recettes.bus_id')
        ->join('lignes', 'lignes.id', '=', 'recettes.ligne_id')
        ->select("recettes.id as r_id", "kabids.name as kname", "buses.name as bname", "lignes.name as lname", "rotation","t20","t25","t30","s20","s25","s30","r20","r25","r30","brigade","recette","recettes.type","flexy")
        ->get();
        $s=0;
        foreach($data as $d){
            $s+=$d->flexy;
        }
        $valid = Validation::where('c_date', $request->start_date)->first();
        if ($valid) {
           $cr = $valid->tc;
           $cf = $valid->flexy-$s;
           $cs = $valid->tsc;
        }else {
            $cr = 0;
            $cs=0;
            $cf=0;
        }
        $k = Kabid::select('id', 'name')->get();
        $l = Ligne::select('id', 'name')->get();
        $b = Bus::select('id', 'name')->get();
        return view('pages.edit', ['data' => $data, 'cr' => $cr,'cf' => $cf, 'cs' => $cs, 'brigade' => $request->brigade, 'start_date' => $request->start_date,'buses' => $b, 'kabids' => $k, 'lignes' => $l]);
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