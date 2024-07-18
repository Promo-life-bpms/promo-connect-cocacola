<?php

namespace App\Http\Controllers;

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

        $user_logs = UserLogs::all();

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
}
