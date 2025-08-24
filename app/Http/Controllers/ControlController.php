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
use App\Models\Ticket;
use App\Models\Validation;
use App\Models\Carnet;
use DateTime;
use Carbon\carbon;

use DateInterval;
use DatePeriod;
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
use Illuminate\Support\Facades\Http;

class ControlController extends Controller
{
    public function control(Request $request)
    {
        $users = User::where('id', '>', 2)->get();
        return view('controls.control', ['users' => $users]);
    }

    public function caisse(Request $request)
    {

        $t20 = $request->tc20;
        $c20 = $request->t20;
        $t25 = $request->tc25;
        $c25 = $request->t25;
        $t30 = $request->tc30;
        $c30 = $request->t30;
        Carnet::where('id', '!=', 0)->where('status', 2)->update(['status' => 1]);
        if ($t20 != []) {
            Carnet::whereIn('id', $t20)->update(['status' => 2]);
        }

        if ($c20 != []) {
            Carnet::whereIn('id', $c20)->update(['status' => 2]);
        }

        if ($t25 != []) {
            Carnet::whereIn('id', $t25)->update(['status' => 2]);
        }

        if ($c25 != []) {
            Carnet::whereIn('id', $c25)->update(['status' => 2]);
        }

        if ($t30 != []) {
            Carnet::whereIn('id', $t30)->update(['status' => 2]);
        }

        if ($c30 != []) {
            Carnet::whereIn('id', $c30)->update(['status' => 2]);
        }

        $r = explode(' ', Carbon::today())[0];
        $kabid = Kabid::where('id', '>', '2')->get();
        $ligne = Ligne::get();
        $bus = Bus::get();
        $day = '';
        if ($request->month) {
            $m = $request->month;
        } else {
            $m = date('m', strtotime("-1 days"));
            $day = 'ليوم ' . date('d/m/y', strtotime("-1 days"));
        }
        //   $d = Validation::whereMonth('c_date',$m)->select('sum(sbm) as ssbm','sum(sbm) as ssbm',)->get();
        $data = Validation::whereMonth('c_date', $m)->get();
        return redirect('/dashboard#section-2');
        return view('pages.dashboard', ['today' => date('Y-m-d'), 'data' => $data, 'kabids' => $kabid, 'lignes' => $ligne, 'm' => $m, 'day' => $day, 'buses' => $bus]);
    }
    public function recette(Request $request)
    {
        $t20 = $request->tc20;
        $c20 = $request->tt20;
        $t25 = $request->tc25;
        $c25 = $request->tt25;
        $t30 = $request->tc30;
        $c30 = $request->tt30;
        $crnt = Carnet::where('status', $request->nameC)->get('id');
        foreach ($crnt as $v) {
            $count = Ticket::where('status', 1)->where('carnet_id', $v->id)->count();
            if ($count == 100) {
                Carnet::where('id', $v->id)->update(['buy' => 1]);
            }
        }

        if ($t20 != []) {
            Carnet::whereIn('id', $t20)->update(['status' => $request->nameC]);
        }

        if ($t25 != []) {
            Carnet::whereIn('id', $t25)->update(['status' => $request->nameC]);
        }

        if ($t30 != []) {
            Carnet::whereIn('id', $t30)->update(['status' => $request->nameC]);
        }

        if ($c20 != []) {
            Ticket::whereIn('id', $c20)->update(['status' => 1]);
        }

        if ($c25 != []) {
            Ticket::whereIn('id', $c25)->update(['status' => 1]);
        }

        if ($c30 != []) {
            Ticket::whereIn('id', $c30)->update(['status' => 1]);
        }

        $y = Auth::id();
        $name = $request->name;
        $brigade = $request->brigade;
        $recette = $request->recette;
        $flexy = $request->flexy;
        $dette = $request->dettes;
        $name_c = $request->name_c;

        Kabid::where('id', $name)->update(['dettes' => $dette]);

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
        $row = Recette::create(['user_id' => $y, 'emp_id' => $name, 'ch_id' => $name_c, 'brigade' => $brigade, 'rotation' => $rotation, 'type' => $type, 'recette' => $recette, 'flexy' => $flexy, 'dettes' => $dette, 'bus_id' => $bus_id, 'ligne_id' => $ligne, 't20' => $t20, 't25' => $t25, 't30' => $t30, 's20' => $s20, 's25' => $s25, 's30' => $s30, 'r20' => $r20, 'r25' => $r25, 'r30' => $r30, 'b_date' => $date]);

        $r = explode(' ', Carbon::today())[0];
        $kabid = Kabid::where('id', '>', '2')->get();
        $ligne = Ligne::get();
        $bus = Bus::get();
        return redirect()->route('home');
    }
    public function recette_c(Request $request)
    {
        $t20 = $request->tc20;
        $c20 = $request->tt20;
        $t25 = $request->tc25;
        $c25 = $request->tt25;
        $t30 = $request->tc30;
        $c30 = $request->tt30;
        $crnt = Carnet::where('status', $request->nameC)->get('id');
        foreach ($crnt as $v) {
            $count = Ticket::where('status', 1)->where('carnet_id', $v->id)->count();
            if ($count == 100) {
                Carnet::where('id', $v->id)->update(['buy' => 1]);
            }
        }

        if ($t20 != []) {
            Carnet::whereIn('id', $t20)->update(['status' => $request->nameC]);
        }

        if ($t25 != []) {
            Carnet::whereIn('id', $t25)->update(['status' => $request->nameC]);
        }

        if ($t30 != []) {
            Carnet::whereIn('id', $t30)->update(['status' => $request->nameC]);
        }

        if ($c20 != []) {
            Ticket::whereIn('id', $c20)->update(['status' => 1]);
        }

        if ($c25 != []) {
            Ticket::whereIn('id', $c25)->update(['status' => 1]);
        }

        if ($c30 != []) {
            Ticket::whereIn('id', $c30)->update(['status' => 1]);
        }

        $y = Auth::id();
        $name = $request->name;
        $brigade = $request->brigade;
        $recette = $request->recette;
        $flexy = $request->flexy;
        $dette = $request->dettes;

        Kabid::where('id', $name)->update(['dettes' => $dette]);

        // $ligne = $request->ligne_id;
        // $bus_id = $request->bus_id;
        // $type = $request->type;
        // $t20 = $request->t20;
        // $t25 = $request->t25;
        // $t30 = $request->t30;
        // $s20 = $request->s20;
        // $s25 = $request->s25;
        // $s30 = $request->s30;
        // $r20 = $request->r20;
        // $r25 = $request->r25;
        // $r30 = $request->r30;
        // $date = $request->date;
        // $rotation = $request->rotation;
        // DB::statement("SET SQL_MODE=''");
        // $row = Recette::create(['user_id' => $y, 'emp_id' => $name, 'brigade' => $brigade,'rotation' => $rotation, 'type' => $type, 'recette' => $recette, 'flexy' => $flexy, 'dettes' => $dette,'bus_id' => $bus_id,'ligne_id' => $ligne, 't20' => $t20,'t25' => $t25,'t30' => $t30,  's20' => $s20,'s25' => $s25,'s30' => $s30,  'r20' => $r20,'r25' => $r25,'r30' => $r30, 'b_date' => $date ]);

        $r = explode(' ', Carbon::today())[0];
        $kabid = Kabid::where('id', '>', '2')->get();
        $ligne = Ligne::get();
        $bus = Bus::get();
        return redirect()->route('home2');
    }
    public function confirm(Request $request)
    {

        $y = Auth::id();
        $smm = Recette::where('b_date', $request->input('date'))->where('brigade', 1)->select(DB::raw("sum(recette) as recette"))->get();
        $sms = Recette::where('b_date', $request->input('date'))->where('brigade', 2)->select(DB::raw("sum(recette) as recette"))->get();
        $smn = Recette::where('b_date', $request->input('date'))->where('brigade', 3)->select(DB::raw("sum(recette) as recette"))->get();
        $smn = ($smn[0]->recette != null) ? $smn[0]->recette : 0;
        $sms = ($sms[0]->recette != null) ? $sms[0]->recette : 0;
        $smm = ($smm[0]->recette != null) ? $smm[0]->recette : 0;

        $valid = Validation::updateOrCreate(
            ['c_date' => $request->input('date')],
            [
                'user_id' => $y,

                'sbm' => $smm,
                'sbs' => $sms,
                'sbn' => $smn,
                'money' => $smm + $sms + $smn,

                'tsc' => $request->input('tsc'),
                'tc' => $request->input('tc'),
                'flexy' => $request->input('flexy') + $request->input('cf')
            ]
        );
        $brigade = $request->brigade;
        $date = $request->date;
        // DB::statement("SET SQL_MODE=''");

        return redirect()->route('get_list', ["start_date" => $date, 'brigade' => $brigade, 'confirm' => 1]);
    }
    public function ticket_show(Request $request)
    {

        $emp20 = Carnet::where('type', 1)->where('status', $request->id)->where('buy', 0)->pluck("name", "id");
        $emp25 = Carnet::where('type', 2)->where('status', $request->id)->where('buy', 0)->pluck("name", "id");
        $emp30 = Carnet::where('type', 3)->where('status', $request->id)->where('buy', 0)->pluck("name", "id");
        $arr20 = array_keys($emp20->toArray());
        $arr25 = array_keys($emp25->toArray());
        $arr30 = array_keys($emp30->toArray());
        $temp20 = Ticket::whereIn('carnet_id', $arr20)->where('status', 0)->pluck("name", "id");
        $temp25 = Ticket::whereIn('carnet_id', $arr25)->where('status', 0)->pluck("name", "id");
        $temp30 = Ticket::whereIn('carnet_id', $arr30)->where('status', 0)->pluck("name", "id");
        $data20 = view('t20-ajax-select', compact('emp20'))->render();
        $data25 = view('t25-ajax-select', compact('emp25'))->render();
        $data30 = view('t30-ajax-select', compact('emp30'))->render();

        $tick20 = view('tk20-ajax-select', compact('temp20'))->render();
        $tick25 = view('tk25-ajax-select', compact('temp25'))->render();
        $tick30 = view('tk30-ajax-select', compact('temp30'))->render();

        return response()->json(['options20' => $data20, 'options25' => $data25, 'options30' => $data30, 'tickets20' => $tick20, 'tickets25' => $tick25, 'tickets30' => $tick30]);
    }
    public function dette(Request $request)
    {

        $d = Kabid::where('id', $request->id)->first();
        if ($d) {
            return $d->dettes;
        } else {
            return 0;
        }
    }


    public function exportAnalyticData(Request $request)
    {

        // Define the month and year for which you want to retrieve data
        if ($request->month) {
            $month = $request->month;
            $year = $request->year;
        } else {
            $month = date('m');
            $year = date('Y');
        }
        // Retrieve data grouped by date and brigade
        $data_j = Recette::select('b_date', "buses.name as bname", "lignes.name as lname", "kabids.matricule as k_matricule", "chauffeurs.matricule as c_matricule", 'bus_id', 'brigade', 'emp_id', 'recettes.ligne_id', 'rotation')
            ->whereYear('b_date', $year)
            ->whereMonth('b_date', $month)
            ->join('lignes', 'lignes.id', '=', 'recettes.ligne_id')
            ->join('buses', 'buses.id', '=', 'recettes.bus_id')
            ->leftjoin('kabids', 'kabids.id', '=', 'recettes.emp_id')
            ->leftjoin('chauffeurs', 'chauffeurs.id', '=', 'recettes.ch_id')
            ->orderBy('b_date')
            ->orderBy('brigade')
            ->orderBy('bus_id') // Add order by bus_id if needed
            ->get()
            ->groupBy('bus_id');
        $excel_data_j = [];
        $excel_data_j[] = array('DATE', 'LIGNE', 'BUS', 'BRIGADE', 'MATRICULE RECEVEUR', 'MATRICULE CHAUFFEUR', 'NOMBRE ROTATIONS');

        foreach ($data_j as $busId => $busData) {
            $row = [];
            foreach ($busData as $record) {

                $arr = array(
                    'DATE' => $record->b_date,
                    'LIGNE' => $record->lname,
                    'BUS' => $record->bname,
                    'BRIGADE' => $record->brigade == 1 ? 'matin' : 'soir',
                    'MATRICULE RECEVEUR' => $record->k_matricule,
                    'MATRICULE CHAUFFEUR' => $record->c_matricule,
                    'NOMBRE ROTATIONS' => $record->rotation,
                );


                array_push($excel_data_j, $arr);
            }
        }
        $excel_data_m = [];
        // $excel_data_m[] = array('DATE','LIGNE','BUS', 'PRODUIT'	,'RECETTE', 'NOMBRE VOYAGEUR TRANSPOTE');
        $data_m = Recette::select('b_date', "buses.name as bname", "lignes.name as lname", 'ordre', 't20', 't25', 't30',  'recettes.ligne_id as l_id', 'rotation')
            ->whereYear('b_date', $year)
            ->whereMonth('b_date', $month)
            ->join('lignes', 'lignes.id', '=', 'recettes.ligne_id')
            ->join('buses', 'buses.id', '=', 'recettes.bus_id')
            ->orderBy('b_date')
            ->orderBy('brigade')
            ->orderBy('recettes.ligne_id') // Add order by recettes.ligne_id if needed
            ->get()
            ->groupBy('recettes.ligne_id');
        $merge = [];
        $i = 1;
        $total = 0;
        $total_nb_vt = 0;
        foreach ($data_m as $key => $ligneData) {
            $row = [];
            foreach ($ligneData as $record) {
                $i++;
                if (in_array($record->ordre, [7, 10])) {
                    $arr = array(
                        'DATE' => $record->b_date,
                        'LIGNE' => $record->lname,
                        'BUS' => $record->bname,
                        'PRODUIT' => 'T20',
                        'RECETTE' => $record->t20 * 20 + $record->t25 * 25,
                        'NOMBRE VOYAGEUR TRANSPOTE' => $record->t20,
                    );
                    $arr2 = array(
                        'DATE' => '',
                        'LIGNE' => '',
                        'BUS' => '',
                        'PRODUIT' => 'T25',
                        'RECETTE' => '',
                        'NOMBRE VOYAGEUR TRANSPOTE' => $record->t25,
                    );
                    array_push($excel_data_m, $arr);
                    array_push($excel_data_m, $arr2);
                    array_push($merge, $i);
                    $total += $record->t20 * 20 + $record->t25 * 25;
                    $total_nb_vt += $record->t20 + $record->t25;
                    $i++;
                } elseif ($record->ordre == 6) {
                    $arr = array(
                        'DATE' => $record->b_date,
                        'LIGNE' => $record->lname,
                        'BUS' => $record->bname,
                        'PRODUIT' => 'T20',
                        'RECETTE' => $record->t20 * 20 + $record->t30 * 30,
                        'NOMBRE VOYAGEUR TRANSPOTE' => $record->t20,
                    );
                    $arr2 = array(
                        'DATE' => '',
                        'LIGNE' => '',
                        'BUS' => '',
                        'PRODUIT' => 'T30',
                        'RECETTE' => '',
                        'NOMBRE VOYAGEUR TRANSPOTE' => $record->t30,
                    );

                    array_push($excel_data_m, $arr);
                    array_push($excel_data_m, $arr2);
                    array_push($merge, $i);
                    $total += $record->t20 * 20 + $record->t30 * 30;
                    $total_nb_vt += $record->t20 + $record->t30;
                    $i++;
                } else {
                    $arr = array(
                        'DATE' => $record->b_date,
                        'LIGNE' => $record->lname,
                        'BUS' => $record->bname,
                        'PRODUIT' => 'T20',
                        'RECETTE' => $record->t20 * 20,
                        'NOMBRE VOYAGEUR TRANSPOTE' => $record->t20,
                    );
                    $total += $record->t20 * 20;
                    $total_nb_vt += $record->t20;
                    array_push($excel_data_m, $arr);
                }
            }
        }
        $total_arr = array(
            'DATE' => '',
            'LIGNE' => '',
            'BUS' => '',
            'PRODUIT' => '',
            'RECETTE' => $total,
            'NOMBRE VOYAGEUR TRANSPOTE' => $total_nb_vt,
        );
        array_push($excel_data_m, $total_arr);
        return $this->ExportExcelAnalytic($excel_data_j, $excel_data_m, $merge, $month, $year);
    }
    public function ExportExcelAnalytic($excel_data_j, $excel_data_m, $merge, $m, $y)
    {
        ini_set('max_execution_time', -1);
        ini_set('memory_limit', '40000M');
        try {

            $inputFileType = 'Xlsx';
            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);


            $month = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Decembre"];
            $month_ar = ["جانفي", "فيفري", "مارس", "أفريل", "ماي", "جوان", "جويلية", "أوت", "سبتمبر", "أكتوبر", "نوفمبر", "ديسمبر"];
            $month_abrv = ["Janv", "Févr", "Mars", "Avr", "Mai", "Juin", "Juil", "Août", "Sept", "Oct", "Nov", "Dec"];

            $spreadSheet = $reader->load('assets/word/ComptabiliteAnalytique.xlsx');
            $spreadSheet->setActiveSheetIndex(0);

            // $spreadSheet->getActiveSheet()->fromArray(['Avance - ' . $month[(int)$m -1] . ' ' . $y], null, 'D2');
            $spreadSheet->getActiveSheet()->fromArray($excel_data_j, null, 'A1');
            $spreadSheet->setActiveSheetIndex(1);
            foreach ($merge as $key) {
                $spreadSheet->getActiveSheet()->mergeCells('A' . $key . ':A' . $key + 1); // Span cell A1 across two rows
                $spreadSheet->getActiveSheet()->mergeCells('B' . $key . ':B' . $key + 1); // Span cell A1 across two rows
                $spreadSheet->getActiveSheet()->mergeCells('C' . $key . ':C' . $key + 1); // Span cell A1 across two rows
                $spreadSheet->getActiveSheet()->mergeCells('E' . $key . ':E' . $key + 1); // Span cell A1 across two rows
            }


            $row = 2;
            foreach ($excel_data_m as $rowData) {
                $column = 1;
                foreach ($rowData as $cellData) {
                    $spreadSheet->getActiveSheet()->setCellValueByColumnAndRow($column, $row, $cellData);
                    $column++;
                }
                $row++;
            }
            //  $spreadSheet->getActiveSheet()->fromArray($excel_data_m, null, 'A1');

            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

            header('Content-Disposition: attachment;filename="ComptabiliteAnalytique-' . $month[(int)$m - 1] . '-' . $y . '.xlsx"');

            $writer = IOFactory::createWriter($spreadSheet, 'Xlsx');

            //save into php output
            $writer->save('php://output');
            exit();
        } catch (Exception $e) {
            return;
        }
    }
    public function ExportExcel($etat_rec, $etat_bus, $etat_bus2, $etat_bus3, $etat_ligne, $etat_ligne2, $etat_ligne3, $rotation_b, $rotation_b2, $rotation_b3, $rotation_l, $rotation_l2, $rotation_l3, $d, $d2, $m, $y, $flexy, $cart, $sp, $resp, $resp_h)
    {
        ini_set('max_execution_time', -1);
        ini_set('memory_limit', '40000M');
        try {

            $inputFileType = 'Xlsx';
            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
            $reader->setIncludeCharts(true);
            $spreadSheet = $reader->load('assets/word/Etat.xlsx');
            //change it

            $spreadSheet->setActiveSheetIndex(0);

            //   $spreadSheet = new Spreadsheet();
            $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
            $spreadSheet->getActiveSheet()->fromArray($etat_rec);
            // $spreadSheet->getActiveSheet()->setTitle('Etat_receveur');
            //$spreadSheet->createSheet();

            /* Add some data */
            $spreadSheet->setActiveSheetIndex(1);
            $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(10);

            // Add some data
            /*
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
 */

            $month = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Decembre"];
            $month_ar = ["جانفي", "فيفري", "مارس", "أفريل", "ماي", "جوان", "جويلية", "أوت", "سبتمبر", "أكتوبر", "نوفمبر", "ديسمبر"];
            $month_abrv = ["Janv", "Févr", "Mars", "Avr", "Mai", "Juin", "Juil", "Août", "Sept", "Oct", "Nov", "Dec"];

            $spreadSheet->getActiveSheet()->fromArray([$month_ar[$m] . ' ' . $y], null, 'T2');

            $spreadSheet->getActiveSheet()->fromArray($etat_bus, null, 'B8');
            $spreadSheet->getActiveSheet()->fromArray($etat_bus2, null, 'B44');
            $spreadSheet->getActiveSheet()->fromArray($etat_bus3, null, 'B80');

            // $spreadSheet->getActiveSheet()->setTitle('Etat_bus');
            //$spreadSheet->createSheet();

            /* Add some data */
            $spreadSheet->setActiveSheetIndex(2);
            $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(8);
            /*             $k=0;
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
            */
            $spreadSheet->getActiveSheet()->fromArray($etat_ligne, null, 'B4');
            $spreadSheet->getActiveSheet()->fromArray($etat_ligne2, null, 'B40');
            $spreadSheet->getActiveSheet()->fromArray($etat_ligne3, null, 'B75');

            // $spreadSheet->getActiveSheet()->setTitle('Etat_ligne');

            //$spreadSheet->createSheet();

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

            $spreadSheet->getActiveSheet()->fromArray($rotation_b, null, 'B5');
            $spreadSheet->getActiveSheet()->fromArray($rotation_b2, null, 'AM5');
            $spreadSheet->getActiveSheet()->fromArray($rotation_b3, null, 'BX5');

            // $spreadSheet->getActiveSheet()->setTitle('Rotation_bus');

            //$spreadSheet->createSheet();

            /* Add some data */
            $spreadSheet->setActiveSheetIndex(4);
            $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(8);
            /*           $k=0;
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
             */
            $spreadSheet->getActiveSheet()->fromArray($rotation_l, null, 'B5');
            $spreadSheet->getActiveSheet()->fromArray($rotation_l2, null, 'AS5');
            $spreadSheet->getActiveSheet()->fromArray($rotation_l3, null, 'CI5');

            // $spreadSheet->getActiveSheet()->setTitle('Rotation_ligne');

            $spreadSheet->setActiveSheetIndex(5);
            $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(10);
            $spreadSheet->getActiveSheet()->fromArray([$d . ' - ' . $d2 . ' ' . $month_ar[$m] . ' ' . $y], null, 'T2');

            $spreadSheet->getActiveSheet()->fromArray([' مداخيل' . $d . ' - ' . $d2 . ' ' . $month_ar[$m] . ' ' . $y], null, 'A2');
            $spreadSheet->getActiveSheet()->fromArray([$month_abrv[$m]], null, 'X37');
            $spreadSheet->getActiveSheet()->fromArray(['عدد المسافرين المنقول/الحافلة ' . $d . ' - ' . $d2 . ' ' . $month_ar[$m] . ' ' . $y], null, 'A46');

            $spreadSheet->setActiveSheetIndex(7);
            $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(10);

            $spreadSheet->getActiveSheet()->fromArray([$month[$m] . ' ' . $y], null, 'A2');

            $spreadSheet->setActiveSheetIndex(8);
            $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(10);

            $spreadSheet->getActiveSheet()->fromArray([$month[$m] . ' ' . $y], null, 'B4');
            $spreadSheet->getActiveSheet()->fromArray($resp, null, 'B8');
            $spreadSheet->getActiveSheet()->fromArray($resp_h, null, 'R44');

            $spreadSheet->setActiveSheetIndex(9);
            $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(10);

            $spreadSheet->getActiveSheet()->fromArray([' مداخيل بيع بطاقة رحلات + الشحن ' . $d . ' - ' . $d2 . ' ' . $month_ar[$m] . ' ' . $y], null, 'A3');

            $range = $this->create_columns_range('B', 'ZZ');
            for ($i = 0; $i < count($cart); $i++) {
                $spreadSheet->setActiveSheetIndex(9)
                    ->setCellValue($range[$i] . '6', $cart[$i]);
                $spreadSheet->setActiveSheetIndex(9)
                    ->setCellValue($range[$i] . '7', $flexy[$i]);
                $spreadSheet->setActiveSheetIndex(9)
                    ->setCellValue($range[$i] . '8', $sp[$i]);
            }
            $spreadSheet->setActiveSheetIndex(10);
            $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(10);

            $spreadSheet->getActiveSheet()->fromArray(['  المداخيل الاجمالية ' . $d . ' - ' . $d2 . ' ' . $month_ar[$m] . ' ' . $y], null, 'C7');
            $spreadSheet->setActiveSheetIndex(11);

            /*    $Excel_writer = new Xls($spreadSheet);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Etat_ExportedData.xls"');
            header('Cache-Control: max-age=0');
            ob_end_clean();
            $Excel_writer->save('php://output');*/

            //set the header first, so the result will be treated as an xlsx file.
            //               dd($etat_bus);
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

            //make it an attachment so we can define filename
            header('Content-Disposition: attachment;filename="etat ' . $d . '-' . $d2 . ' ' . $month[$m] . ' ' . $y . '.xlsx"');

            //create IOFactory object
            $writer = IOFactory::createWriter($spreadSheet, 'Xlsx');
            $writer->setIncludeCharts(true);

            //save into php output
            $writer->save('php://output');
            exit();
        } catch (Exception $e) {
            return;
        }
    }
    /**
     *This function loads the customer data from the database then converts it
     * into an Array that will be exported to Excel
     */
    public function create_columns_range($start = 'A', $end = 'ZZ')
    {
        $return_range = [];
        for ($i = $start; $i !== $end; $i++) {
            $return_range[] = $i;
        }
        return $return_range;
    }
    public function exportData(Request $request)
    {
        $req = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);
        $from = $req['start_date'];
        $to = $req['end_date'];

        $day = $request->day;
        $day2 = $request->day2;
        $month = $request->month;
        $year = $request->year;
        /*    $current_month_first_day = new DateTime('first day of this month'); // first day of the current month
        $current_month_last_day  = date('t');  // last day of the current month
        $interval = new DateInterval('P1D');*/
        // Step 1: Setting the Start and End Dates
        $start_date = date_create($from);
        $end_date = date_create($to);

        $end_date = $end_date->add(DateInterval::createFromDateString('tomorrow'));
        // Step 2: Defining the Date Interval
        $interval = new DateInterval('P1D');

        // Step 3: Creating the Date Range
        $period = new DatePeriod($start_date, $interval, $end_date);

        //  $period = new DatePeriod($current_month_first_day, $interval, $current_month_last_day - 1);
        $date = date('Y-m-d');

        $types = ['', 'A', 'B', 'C', 'D'];
        $data_array = [];
        $flexy = [];
        $cart = [];
        $sp = [];
        $resp = [];
        $resp_h = [];
        $r = 0;
        // $response2 = Http::get('https://etus22.deepertech.dz/api/stat_site2/' . $from . '/' . $to);
        $response2 = Http::withOptions([
            'verify' => false // désactive la vérification SSL
        ])->get('https://etus22.deepertech.dz/api/stat_site2/' . $from . '/' . $to);

        if ($response2->successful()) {

            $resp = $response2[1]; // Extract JSON data from the response
            $resp_h = $response2[0];
        } else {
            // Handle unsuccessful response
            return response()->json(['error' => 'Failed to send data to the other website'], 500);
        }
        foreach ($period as $value) {
            if ($value->format("Y-m-d") <= $date) {

                // $response = Http::get('https://etus22.deepertech.dz/api/stat_site/' . $value->format("Y-m-d") . 'T00:01/' . $value->format("Y-m-d") . 'T23:59');
                $response = Http::withOptions([
                    'verify' => false
                ])->get('https://etus22.deepertech.dz/api/stat_site/' . $value->format("Y-m-d") . 'T00:01/' . $value->format("Y-m-d") . 'T23:59');

                if ($response->successful()) {
                    $responseData = $response->json(); // Extract JSON data from the response
                    // Process $responseData as needed
                    $flexy[] = $responseData[0];
                    $cart[] = $responseData[1] * 200;
                    $sp[] = $responseData[2] * 300;
                } else {
                    // Handle unsuccessful response
                    return response()->json(['error' => 'Failed to send data to the other website'], 500);
                }

                $data = Recette::query()
                    ->join('kabids', 'kabids.id', '=', 'recettes.emp_id')
                    /* ->join('lignes', 'lignes.id', '=', 'recettes.ligne_id')
                ->join('buses', 'buses.id', '=', 'recettes.bus_id')*/
                    ->where('b_date', $value->format("Y-m-d"))
                    ->select("kabids.name as kname", DB::raw("sum(recette) as recette"))
                    ->groupBy(['kname'])->orderBy('emp_id', 'ASC')
                    ->get();
                $i = 0;
                if ($data != []) {

                    $data_array[] = array($value->format("Y-m-d"));
                    $data_array[] = [];
                    $data_array[] = array("Num", "Receveur", "Recette");
                    foreach ($data as $data_item) {
                        $i++;
                        $r += $data_item->recette;

                        $arr = array(
                            'Num' => $i,
                            'Receveur' => $data_item->kname,
                            'Recette' => $data_item->recette,
                            /* 'Ligne' => $data_item->lname,
                        'Bus' => $data_item->bname,
                        'Bus' => $types[$data_item->type],*/

                        );
                        array_push($data_array, $arr);
                    }
                } else {
                    $data_array[] = [];
                }
            }
        }

        $data_array[] = [];
        $data_array[] = ['', '', $r];
        $arr = array("20", "25", "30");
        $arrt = [];
        for ($i = 0; $i < 35; $i++) {
            array_push($arrt, ...$arr);
        }

        //  $data_array2 [] = $arrt;
        $data_array4 = [];
        $data_array42 = [];
        foreach ($period as $value) {
            if ($value->format("Y-m-d") <= $date) {

                $data = Recette::query()->where('brigade', 1)
                    ->join('buses', 'buses.id', '=', 'recettes.bus_id')
                    /* ->join('lignes', 'lignes.id', '=', 'recettes.ligne_id')
                ->join('buses', 'buses.id', '=', 'recettes.bus_id')*/
                    ->where('b_date', $value->format("Y-m-d"))
                    ->select("buses.name as bname", DB::raw("sum(rotation) as rotation"), DB::raw("sum(t20) as t20"), DB::raw("sum(t25) as t25"), DB::raw("sum(t30) as t30"))
                    ->groupBy(['bname'])->orderBy('bus_id', 'ASC')
                    ->get();
                $s = 0;
                $d = [];
                $arr = [];
                $arr_br = [];
                $arrs = [];
                foreach ($data as $data_item) {
                    $arr[$data_item->bname] = [$data_item->t20, $data_item->t25, $data_item->t30, $data_item->rotation];
                    array_push($arrs, $data_item->bname);
                }
                for ($i = 1; $i <= 35; $i++) {
                    $j = ($i < 10) ? "A0" . $i : "A" . $i;
                    if (in_array($j, $arrs)) {


                        $t20 = ($arr[$j][0] > 0) ? $arr[$j][0] * 20 : 0;
                        $t25 = ($arr[$j][1] > 0) ? $arr[$j][1] * 25 : 0;
                        $t30 = ($arr[$j][2] > 0) ? $arr[$j][2] * 30 : 0;
                        $r = $arr[$j][3];

                        $s += $t20 + $t25 + $t30;
                        array_push($d, $t20);
                        array_push($d, $t25);
                        array_push($d, $t30);
                        array_push($arr_br, $r);
                    } else {
                        array_push($d, 0);
                        array_push($d, 0);
                        array_push($d, 0);
                        array_push($arr_br, 0);
                    }
                }

                array_push($d, $s);

                $data_array2[] = $d;
                $data_array4[] = $arr_br;
            }
        }

        /*  $data_array2 [] =[];
        $data_array2 [] =[];
        $data_array2 [] =[];
        $data_array2 [] = $arrt;*/
        $arrs = [];

        foreach ($period as $value) {
            if ($value->format("Y-m-d") <= $date) {

                $data = Recette::query()->where('brigade', 2)
                    ->join('buses', 'buses.id', '=', 'recettes.bus_id')
                    /* ->join('lignes', 'lignes.id', '=', 'recettes.ligne_id')
                ->join('buses', 'buses.id', '=', 'recettes.bus_id')*/
                    ->where('b_date', $value->format("Y-m-d"))
                    ->select("buses.name as bname", DB::raw("sum(rotation) as rotation"), DB::raw("sum(t20) as t20"), DB::raw("sum(t25) as t25"), DB::raw("sum(t30) as t30"))
                    ->groupBy(['bname'])->orderBy('bus_id', 'ASC')
                    ->get();
                $s = 0;

                $d = [];
                $arr = [];
                $arr_br = [];
                $arrs = [];
                foreach ($data as $data_item) {
                    $arr[$data_item->bname] = [$data_item->t20, $data_item->t25, $data_item->t30, $data_item->rotation];
                    array_push($arrs, $data_item->bname);
                }
                for ($i = 1; $i <= 35; $i++) {
                    $j = ($i < 10) ? "A0" . $i : "A" . $i;
                    if (in_array($j, $arrs)) {


                        $t20 = ($arr[$j][0] > 0) ? $arr[$j][0] * 20 : 0;
                        $t25 = ($arr[$j][1] > 0) ? $arr[$j][1] * 25 : 0;
                        $t30 = ($arr[$j][2] > 0) ? $arr[$j][2] * 30 : 0;
                        $r = $arr[$j][3];

                        $s += $t20 + $t25 + $t30;
                        array_push($d, $t20);
                        array_push($d, $t25);
                        array_push($d, $t30);
                        array_push($arr_br, $r);
                    } else {
                        array_push($d, 0);
                        array_push($d, 0);
                        array_push($d, 0);
                        array_push($arr_br, 0);
                    }
                }

                array_push($d, $s);

                $data_array22[] = $d;
                $data_array42[] = $arr_br;
            }
        }
        foreach ($period as $value) {
            if ($value->format("Y-m-d") <= $date) {

                $data = Recette::query()->where('brigade', 3)
                    ->join('buses', 'buses.id', '=', 'recettes.bus_id')
                    /* ->join('lignes', 'lignes.id', '=', 'recettes.ligne_id')
                ->join('buses', 'buses.id', '=', 'recettes.bus_id')*/
                    ->where('b_date', $value->format("Y-m-d"))
                    ->select("buses.name as bname", DB::raw("sum(rotation) as rotation"), DB::raw("sum(t20) as t20"), DB::raw("sum(t25) as t25"), DB::raw("sum(t30) as t30"))
                    ->groupBy(['bname'])->orderBy('bus_id', 'ASC')
                    ->get();
                $s = 0;

                $d = [];
                $arr = [];
                $arr_br = [];
                $arrs = [];
                foreach ($data as $data_item) {
                    $arr[$data_item->bname] = [$data_item->t20, $data_item->t25, $data_item->t30, $data_item->rotation];
                    array_push($arrs, $data_item->bname);
                }
                for ($i = 1; $i <= 35; $i++) {
                    $j = ($i < 10) ? "A0" . $i : "A" . $i;
                    if (in_array($j, $arrs)) {


                        $t20 = ($arr[$j][0] > 0) ? $arr[$j][0] * 20 : 0;
                        $t25 = ($arr[$j][1] > 0) ? $arr[$j][1] * 25 : 0;
                        $t30 = ($arr[$j][2] > 0) ? $arr[$j][2] * 30 : 0;
                        $r = $arr[$j][3];

                        $s += $t20 + $t25 + $t30;
                        array_push($d, $t20);
                        array_push($d, $t25);
                        array_push($d, $t30);
                        array_push($arr_br, $r);
                    } else {
                        array_push($d, 0);
                        array_push($d, 0);
                        array_push($d, 0);
                        array_push($arr_br, 0);
                    }
                }

                array_push($d, $s);

                $data_array23[] = $d;
                $data_array43[] = $arr_br;
            }
        }
        $arr = [];

        for ($i = 0; $i < 22; $i++) {
            array_push($arr, 20);
        }
        for ($i = 0; $i < 5; $i++) {
            array_push($arr, 20);
            array_push($arr, 30);
        }
        for ($i = 0; $i < 4; $i++) {
            array_push($arr, 20);
            array_push($arr, 25);
        }

        for ($i = 0; $i < 10; $i++) {
            array_push($arr, 20);
        }
        for ($i = 0; $i < 3; $i++) {
            array_push($arr, 20);
            array_push($arr, 25);
        }

        $data_array5 = [];
        $data_array52 = [];
        //$data_array3 [] = $arr;
        foreach ($period as $value) {
            if ($value->format("Y-m-d") <= $date) {

                $datal = Recette::query()->where('brigade', 1)
                    ->join('lignes', 'lignes.id', '=', 'recettes.ligne_id')
                    /* ->join('lignes', 'lignes.id', '=', 'recettes.ligne_id')
                ->join('lignes', 'lignes.id', '=', 'recettes.bus_id')*/
                    ->where('b_date', $value->format("Y-m-d"))
                    ->select("lignes.name as lname", "lignes.ordre as ordre", "type", "t20", "t25", "t30", "rotation")
                    // ->groupBy(['lname'])
                    ->orderBy('lignes.ordre', 'ASC')
                    ->get();
                $j = 0;
                $i = 0;
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

                $arp = [];
                $lr = [];
                $cl = 'cl';
                $k = 1;
                //   $l=[1B,16,9,11,25,27,26,28,' ',03,'-T lac'];
                $c = [3, 5, 4, 5, 5, 10, 8, 4, 6, 6];
                for ($i = 1; $i <= 10; $i++) {
                    $l = $c[$k - 1];
                    $k++;
                    for ($j = 0; $j < $l; $j++) {

                        ${$cl . $i . $j} = 0;
                    }
                }
                $j = -1;

                foreach ($datal as $key => $data_item) {
                    if ($data_item->ordre != $j) {
                        $j = $data_item->ordre;
                        //  array_push($count,$i);

                        $i = 0;
                        # code...
                    } else {
                        $i++;
                    }

                    if ($j == 6) {
                        ${$cl . $j . $i} = $data_item->t20 * 20;
                        $i++;
                        ${$cl . $j . $i} = $data_item->t30 * 30;
                    } elseif (($j == 7 || $j == 10)) {
                        ${$cl . $j . $i} = $data_item->t20 * 20;
                        $i++;
                        ${$cl . $j . $i} = $data_item->t25 * 25;
                    } else {
                        ${$cl . $j . $i} = $data_item->t20 * 20;
                    }

                    /*    array_push($arrs,$j);
                if ($key == $endkey) {
                array_push($count,$i);
                }*/
                }
                $k = 1;
                $c = [3, 5, 4, 5, 5, 10, 8, 4, 6, 6];
                for ($i = 1; $i <= 10; $i++) {

                    $l = $c[$k - 1];
                    $k++;
                    for ($j = 0; $j < $l; $j++) {

                        array_push($arp, ${$cl . $i . $j});
                    }
                }

                $clr = 'clr';
                $kr = 1;
                $jr = 0;
                //   $l=[1B,16,9,11,25,27,26,28,' ',03,'-T lac'];
                $cr = [3, 5, 4, 5, 5, 5, 4, 4, 6];
                for ($ir = 1; $ir <= 9; $ir++) {
                    $l = $cr[$kr - 1];
                    $kr++;
                    for ($jr = 0; $jr < $l; $jr++) {

                        ${$clr . $ir . $jr} = 0;
                    }
                }
                $jr = 0;
                foreach ($datal as $data_item) {
                    if ($data_item->ordre != $jr) {
                        $jr = $data_item->ordre;
                        //  array_push($count,$ir);

                        $ir = 0;
                        # code...
                    } else {
                        $ir++;
                    }

                    ${$clr . $jr . $ir} = $data_item->rotation;
                    /*    array_push($arrs,$jr);
                if ($krey == $endkrey) {
                array_push($count,$ir);
                }*/
                }
                $kr = 1;
                //   $l=[1B,16,9,11,25,27,26,28,' ',03,'-T lac'];
                // $c = [3, 5, 4, 5, 5, 4, 4, 4, 6];
                for ($ir = 1; $ir <= 9; $ir++) {
                    $l = $cr[$kr - 1];
                    $kr++;
                    for ($jr = 0; $jr < $l; $jr++) {

                        array_push($lr, ${$clr . $ir . $jr});
                    }
                }

                $data_array3[] = $arp;
                $data_array5[] = $lr;
            }
        }

        foreach ($period as $value) {
            if ($value->format("Y-m-d") <= $date) {

                $datal = Recette::query()->where('brigade', 2)
                    ->join('lignes', 'lignes.id', '=', 'recettes.ligne_id')
                    /* ->join('lignes', 'lignes.id', '=', 'recettes.ligne_id')
                    ->join('lignes', 'lignes.id', '=', 'recettes.bus_id')*/
                    ->where('b_date', $value->format("Y-m-d"))
                    ->select("lignes.name as lname", "lignes.ordre as ordre", "type", "t20", "t25", "t30", "rotation")
                    // ->groupBy(['lname'])
                    ->orderBy('lignes.ordre', 'ASC')
                    ->get();
                $j = 0;
                $i = 0;
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

                $arp = [];
                $lr = [];
                $cl = 'cl';
                $k = 1;
                //   $l=[1B,16,9,11,25,27,26,28,' ',03,'-T lac'];
                $c = [3, 5, 4, 5, 5, 10, 8, 4, 6, 6];
                for ($i = 1; $i <= 10; $i++) {
                    $l = $c[$k - 1];
                    $k++;
                    for ($j = 0; $j < $l; $j++) {

                        ${$cl . $i . $j} = 0;
                    }
                }
                $j = -1;

                foreach ($datal as $key => $data_item) {
                    if ($data_item->ordre != $j) {
                        $j = $data_item->ordre;
                        //  array_push($count,$i);

                        $i = 0;
                        # code...
                    } else {
                        $i++;
                    }

                    if ($j == 6) {
                        ${$cl . $j . $i} = $data_item->t20 * 20;
                        $i++;
                        ${$cl . $j . $i} = $data_item->t30 * 30;
                    } elseif (($j == 7 || $j == 10)) {
                        ${$cl . $j . $i} = $data_item->t20 * 20;
                        $i++;
                        ${$cl . $j . $i} = $data_item->t25 * 25;
                    } else {
                        ${$cl . $j . $i} = $data_item->t20 * 20;
                    }

                    /*    array_push($arrs,$j);
                    if ($key == $endkey) {
                    array_push($count,$i);
                    }*/
                }
                $k = 1;
                //   $l=[1B,16,9,11,25,27,26,28,' ',03,'-T lac'];
                $c = [3, 5, 4, 5, 5, 10, 8, 4, 6, 6];
                for ($i = 1; $i <= 10; $i++) {

                    $l = $c[$k - 1];
                    $k++;
                    for ($j = 0; $j < $l; $j++) {

                        array_push($arp, ${$cl . $i . $j});
                    }
                }

                $clr = 'clr';
                $kr = 1;
                $jr = 0;
                //   $l=[1B,16,9,11,25,27,26,28,' ',03,'-T lac'];
                $cr = [3, 5, 4, 5, 5, 5, 4, 4, 6];

                for ($ir = 1; $ir <= 9; $ir++) {
                    $l = $cr[$kr - 1];
                    $kr++;
                    for ($jr = 0; $jr < $l; $jr++) {

                        ${$clr . $ir . $jr} = 0;
                    }
                }
                $jr = -1;
                foreach ($datal as $data_item) {
                    if ($data_item->ordre != $jr) {
                        $jr = $data_item->ordre;
                        //  array_push($count,$ir);

                        $ir = 0;
                        # code...
                    } else {
                        $ir++;
                    }

                    ${$clr . $jr . $ir} = $data_item->rotation;
                    /*    array_push($arrs,$jr);
                    if ($krey == $endkrey) {
                    array_push($count,$ir);
                    }*/
                }
                $kr = 1;
                //   $l=[1B,16,9,11,25,27,26,28,' ',03,'-T lac'];
                // $c = [3, 4, 4, 5, 3, 8, 8, 3, 6, 6];
                for ($ir = 1; $ir <= 9; $ir++) {
                    $l = $cr[$kr - 1];
                    $kr++;
                    for ($jr = 0; $jr < $l; $jr++) {

                        array_push($lr, ${$clr . $ir . $jr});
                    }
                }

                $data_array32[] = $arp;
                $data_array52[] = $lr;
            }
        }


        foreach ($period as $value) {
            if ($value->format("Y-m-d") <= $date) {

                $datal = Recette::query()->where('brigade', 3)
                    ->join('lignes', 'lignes.id', '=', 'recettes.ligne_id')
                    /* ->join('lignes', 'lignes.id', '=', 'recettes.ligne_id')
                ->join('lignes', 'lignes.id', '=', 'recettes.bus_id')*/
                    ->where('b_date', $value->format("Y-m-d"))
                    ->select("lignes.name as lname", "lignes.ordre as ordre", "type", "t20", "t25", "t30", "rotation")
                    // ->groupBy(['lname'])
                    ->orderBy('lignes.ordre', 'ASC')
                    ->get();
                $j = 0;
                $i = 0;
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

                $arp = [];
                $lr = [];
                $cl = 'cl';
                $k = 1;
                //   $l=[1B,16,9,11,25,27,26,28,' ',03,'-T lac'];
                $c = [3, 5, 4, 5, 5, 10, 8, 4, 6, 6];
                for ($i = 1; $i <= 10; $i++) {
                    $l = $c[$k - 1];
                    $k++;
                    for ($j = 0; $j < $l; $j++) {

                        ${$cl . $i . $j} = 0;
                    }
                }
                $j = -1;

                foreach ($datal as $key => $data_item) {
                    if ($data_item->ordre != $j) {
                        $j = $data_item->ordre;
                        //  array_push($count,$i);

                        $i = 0;
                        # code...
                    } else {
                        $i++;
                    }

                    if ($j == 6) {
                        ${$cl . $j . $i} = $data_item->t20 * 20;
                        $i++;
                        ${$cl . $j . $i} = $data_item->t30 * 30;
                    } elseif (($j == 7 || $j == 10)) {
                        ${$cl . $j . $i} = $data_item->t20 * 20;
                        $i++;
                        ${$cl . $j . $i} = $data_item->t25 * 25;
                    } else {
                        ${$cl . $j . $i} = $data_item->t20 * 20;
                    }

                    /*    array_push($arrs,$j);
                if ($key == $endkey) {
                array_push($count,$i);
                }*/
                }
                $k = 1;
                //   $l=[1B,16,9,11,25,27,26,28,' ',03,'-T lac'];
                $c = [3, 5, 4, 5, 5, 10, 8, 4, 6, 6];
                for ($i = 1; $i <= 10; $i++) {

                    $l = $c[$k - 1];
                    $k++;
                    for ($j = 0; $j < $l; $j++) {

                        array_push($arp, ${$cl . $i . $j});
                    }
                }

                $clr = 'clr';
                $kr = 1;
                $jr = 0;
                //   $l=[1B,16,9,11,25,27,26,28,' ',03,'-T lac'];
                $cr = [3, 4, 4, 5, 3, 4, 4, 3, 5];

                for ($ir = 1; $ir <= 9; $ir++) {
                    $l = $cr[$kr - 1];
                    $kr++;
                    for ($jr = 0; $jr < $l; $jr++) {

                        ${$clr . $ir . $jr} = 0;
                    }
                }
                $jr = -1;
                foreach ($datal as $data_item) {
                    if ($data_item->ordre != $jr) {
                        $jr = $data_item->ordre;
                        //  array_push($count,$ir);

                        $ir = 0;
                        # code...
                    } else {
                        $ir++;
                    }

                    ${$clr . $jr . $ir} = $data_item->rotation;
                    /*    array_push($arrs,$jr);
                if ($krey == $endkrey) {
                array_push($count,$ir);
                }*/
                }
                $kr = 1;
                //   $l=[1B,16,9,11,25,27,26,28,' ',03,'-T lac'];
                // $c = [3, 4, 4, 5, 3, 8, 8, 3, 6, 6];
                for ($ir = 1; $ir <= 9; $ir++) {
                    $l = $cr[$kr - 1];
                    $kr++;
                    for ($jr = 0; $jr < $l; $jr++) {

                        array_push($lr, ${$clr . $ir . $jr});
                    }
                }

                $data_array33[] = $arp;
                $data_array53[] = $lr;
            }
        }

        /* $arr=[];
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

        }*/
        //   $data_array4[]= $arr_t;
        /*   $data_array4[]= $rb;
        $data_array42[]= $rb2;

        $arp= [];
        $cl='cl';
        $k=1;
        $j=0;
        //   $l=[16,9,11,25,27,26,28,' ',03,'-T lac'];
        $c=[4,5,4,5,3,5,4,3,4];
        for ($i=1; $i <=9 ; $i++) {
        $l=$c[$k-1];
        $k++;
        for ($j=0; $j < $l; $j++) {

        ${$cl.$i.$j} =0;
        }
        }
        $j=0;
        foreach($datal as $data_item)
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
        }*
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

        $data_array5 [] = $arp;*/

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
        return $this->ExportExcel($data_array, $data_array2, $data_array22, $data_array23, $data_array3, $data_array32, $data_array33, $data_array4, $data_array42, $data_array43, $data_array5, $data_array52, $data_array53, $day, $day2, $month, $year, $flexy, $cart, $sp, $resp, $resp_h);
    }

    public function Infractions()
    {
        return view('pages.Infractions');
    }
    public function update(Request $request)
    {
        if ($request->val) {
            $kname = $request->val['kname'];
            $bname = $request->val['bname'];
            $lname = $request->val['lname'];
            $recette = $request->val['recette'];
            $t20 = $request->val['t20'];
            $t25 = $request->val['t25'];
            $t30 = $request->val['t30'];
            $s20 = $request->val['s20'];
            $s25 = $request->val['s25'];
            $s30 = $request->val['s30'];
            $r20 = $request->val['r20'];
            $r25 = $request->val['r25'];
            $r30 = $request->val['r30'];
            $brigade = $request->val['brigade'];
            $type = $request->val['type'];
            $flexy = $request->val['flexy'];
            $rotation = $request->val['rotation'];
            $rc = Recette::where('id', $request->val['id'])->first();
            if ($rc) {

                $rc->update([
                    'emp_id' => $kname,
                    'bus_id' => $bname,
                    'ligne_id' => $lname,
                    'type' => $type,
                    'brigade' => $brigade,
                    't20' => $t20,
                    't25' => $t25,
                    't30' => $t30,
                    's20' => $s20,
                    's25' => $s25,
                    's30' => $s30,
                    'r20' => $r20,
                    'r25' => $r25,
                    'r30' => $r30,
                    'recette' => $recette,
                    'rotation' => $rotation,
                    'flexy' => $flexy,
                ]);
                return ['تم التحديث بنجاح', $brigade, $rc->b_date];
            }
        }
        return false;
    }

    public function delete(Request $request)
    {
        if ($request->val) {
            $rc = Recette::where('id', $request->val)->first();
            if ($rc) {

                $rc->delete();
                return ['تم الحذف ', $rc->brigade, $rc->b_date];
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
        if ($request->brigade >= 1) {
            $data = Recette::query()->where('b_date', $request->start_date)->where('brigade', $request->brigade);
        } else {
            $data = Recette::query()->where('b_date', $request->start_date);
        }

        $data = $data
            ->join('kabids', 'kabids.id', '=', 'recettes.emp_id')
            ->join('buses', 'buses.id', '=', 'recettes.bus_id')
            ->join('lignes', 'lignes.id', '=', 'recettes.ligne_id')
            ->select("recettes.id as r_id", "kabids.name as kname", "buses.name as bname", "lignes.name as lname", "rotation", "recettes.dettes", "t20", "t25", "t30", "s20", "s25", "s30", "r20", "r25", "r30", "brigade", "recette", "recettes.type", "flexy")
            ->get();
        $s = 0;
        foreach ($data as $d) {
            $s += $d->flexy;
        }
        $valid = Validation::where('c_date', $request->start_date)->first();
        if ($valid) {
            $cr = $valid->tc;
            $cf = $valid->flexy - $s;
            $cs = $valid->tsc;
        } else {
            $cr = 0;
            $cs = 0;
            $cf = 0;
        }
        $k = Kabid::select('id', 'name')->get();
        $l = Ligne::select('id', 'name')->get();
        $b = Bus::select('id', 'name')->get();
        return view('pages.edit', ['data' => $data, 'cr' => $cr, 'cf' => $cf, 'cs' => $cs, 'brigade' => $request->brigade, 'start_date' => $request->start_date, 'buses' => $b, 'kabids' => $k, 'lignes' => $l]);
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
