<?php

namespace App\Http\Controllers;

use App\Models\Muestra;
use App\Models\Quote;
use App\Models\Shopping;
use App\Models\User;
use App\Models\UserLogs;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;


class StadisticController extends Controller
{
    public function stadistics() {
        $styleTitle = [
            'borders' => [
                'outline' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                 ],
            ],
            'font' => [
                'name' => 'Arial',
                'size' => 10
            ]
        ];

        $styleSubtitle = [
            'borders' => [
                'outline' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                 ],
            ],
            'font' => [
                'name' => 'Arial',
                'size' => 10
            ],
            'fill' => array(
                'fillType' => Fill::FILL_SOLID,
                'startColor' => array('argb' => 'FFEDEFF0')
            )
        ];

        $styleBody = [
            'borders' => [
                'outline' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                 ],
            ],
            'font' => [
                'name' => 'Arial',
                'size' => 10
            ],
            
        ];



        $spreadsheet = new Spreadsheet();
        $spreadsheet->getActiveSheet()->setTitle("HH Global");

        $sheet = $spreadsheet->getActiveSheet();

        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(4);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);

        $sheet->getStyle('A1:F1')->applyFromArray($styleTitle);
        $sheet->getStyle('A2:F2')->applyFromArray($styleSubtitle);

        $loop = 0; 
        $start = 2;
        
        $sheet->setCellValue('A1', 'REGISTROS DE USUARIOS');

        $sheet->setCellValue('A2', '#');
        $sheet->setCellValue('B2', 'Usuario');  
        $sheet->setCellValue('C2', 'Correo');  
        $sheet->setCellValue('D2', 'Actividad');
        $sheet->setCellValue('E2', 'Descripción');
        $sheet->setCellValue('F2', 'Fecha y hora');

        $excludedUserIds = [1, 2, 3, 4,179, 180,181];
        $user_logs = UserLogs::whereNotIn('user_id', $excludedUserIds)
            ->orderBy('created_at', 'desc')
            ->get();

        foreach($user_logs as $user){
            $start = $start +1;
            $loop = $loop +1;
            $sheet->setCellValue('A'.$start, $loop);
            $sheet->setCellValue('B'.$start, $user->user->name);
            $sheet->setCellValue('C'.$start, $user->user->email);
            $sheet->setCellValue('D'.$start, $user->type);
            $sheet->setCellValue('E'.$start, $user->value);
            $sheet->setCellValue('F'.$start, $user->created_at);

        }
      
        $sheet->getStyle('A2:F'.$start)->applyFromArray($styleBody);

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . 'registro_usuarios ' . '.xls');
        header('Cache-Control: max-age=0');
          
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');
        $writer->save('php://output');
    }


    public function  viewStadistics() {
    
        $excludedUserIds = [1, 2, 3, 4,179, 180,181];
        $stadistics = UserLogs::whereNotIn('user_id', $excludedUserIds)
            ->orderBy('created_at', 'desc')
            ->paginate(30);


        $activeUsers =  User::whereNotIn('id', $excludedUserIds)->get();
        
        $activeUsersData = [
            'active' => 0,
            'inactive' => 0,
        ];

        $totalCotizations = [];
        $totalShoppings = [];
        $totalMuestras = [];
        
        $totalCompras = 0;
        $totalMuestas = 0;
        $totalCotizaciones = 0;

        foreach($activeUsers as $user){

            $existUser = UserLogs::where('user_id',$user->id)->first();

            if($existUser){
                $activeUsersData['active'] += 1;
            }else{
                $activeUsersData['inactive'] += 1;
            }


            $allCotization  = Quote::where('user_id', $user->id)->count();
            $allShoppings  = Shopping::where('user_id', $user->id)->count();
            $allMuestras  = Muestra::where('user_id', $user->id)->count();


            if($allCotization > 0){

                array_push($totalCotizations, (object)[
                    'user' => $user->name,
                    'total' => $allCotization,
                ]);


                array_push($totalShoppings, (object)[
                    'user' => $user->name,
                    'total' => $allShoppings,
                ]);


                array_push($totalMuestras, (object)[
                    'user' => $user->name,
                    'total' => $allMuestras,
                ]);
                
            }
    
        }


        return view('pages.buyer.statistics', compact('stadistics','activeUsersData', 'totalCotizations','totalShoppings', 'totalMuestras'));


    }

    public function stadisticsFilter(Request $request)  {

        $start = $request->start_date;
        $end = $request->end_date;
        
        $excludedUserIds = [1, 2, 3, 4,179, 180,181];
        $stadistics = UserLogs::whereNotIn('user_id', $excludedUserIds)
            ->orderBy('created_at', 'desc')
            ->paginate(30);


        $activeUsers =  User::whereNotIn('id', $excludedUserIds)->get();
        
        $activeUsersData = [
            'active' => 0,
            'inactive' => 0,
        ];

        $totalCotizations = [];
        $totalShoppings = [];
        $totalMuestras = [];
        
        $totalCompras = 0;
        $totalMuestas = 0;
        $totalCotizaciones = 0;

        foreach($activeUsers as $user){

            $existUser = UserLogs::where('user_id', $user->id)->whereBetween('created_at', [$start, $end])->first();

            if($existUser){
                $activeUsersData['active'] += 1;
            }else{
                $activeUsersData['inactive'] += 1;
            }

            $allCotization = Quote::where('user_id', $user->id)->whereBetween('created_at', [$start, $end])->count();

            $allShoppings = Shopping::where('user_id', $user->id)->whereBetween('created_at', [$start, $end])->count();

            $allMuestras = Muestra::where('user_id', $user->id)->whereBetween('created_at', [$start, $end])->count();


            if($allCotization > 0){

                array_push($totalCotizations, (object)[
                    'user' => $user->name,
                    'total' => $allCotization,
                ]);


                array_push($totalShoppings, (object)[
                    'user' => $user->name,
                    'total' => $allShoppings,
                ]);


                array_push($totalMuestras, (object)[
                    'user' => $user->name,
                    'total' => $allMuestras,
                ]);
                
            }
    
        }

        return view('pages.buyer.statistics', compact('stadistics','activeUsersData', 'totalCotizations','totalShoppings', 'totalMuestras'));

    }
   
}
