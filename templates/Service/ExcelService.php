<?php
/**
 * Created by PhpStorm.
 * User: biduletruck
 * Date: 13/12/17
 * Time: 23:03
 */

namespace AppBundle\Service;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Symfony\Component\HttpFoundation\Response;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Style;

class ExcelService
{

    public function newExcel()
    {
        return $spreadsheet = new Spreadsheet();
    }


    public function newExcelFromModel()
    {
        return \PhpOffice\PhpSpreadsheet\IOFactory::load('modelBaseVir.xlsx');

    }

    public function saveExcel($claseur, $title)
    {
        $writer = new Xlsx($claseur);
        $writer->save($title.'.xlsx');
        return new Response();
    }

    public function exportExcel($claseur, $title)
    {

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($claseur, "Xlsx");
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'. $title .'.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit();
    }

    public function exportPdf($claseur, $title)
    {
        $claseur->getActiveSheet()->setShowGridLines(false);
        IOFactory::registerWriter('Pdf', \PhpOffice\PhpSpreadsheet\Writer\Pdf\Mpdf::class);

        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment;filename="'. $title .'.pdf"');
        header('Cache-Control: max-age=0');
        $writer = IOFactory::createWriter($claseur, 'Pdf');
        $writer->save('php://output');
    }



    public function alernateStyle($rowCount)
    {
        //Style des celules;
        $color = ($rowCount % 2) == 0 ? 'c6e2ff' : '63b8ff';
        $style = [
            'alignment' => [
                'horizontal'        => Alignment::HORIZONTAL_CENTER,
                'vertical'          => Alignment::VERTICAL_CENTER,
                'wrapText'          => true,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle'   => Border::BORDER_THIN,
                    'color'         => array('rgb' => 'FFFFFF')
                ],
            ],
            'fill' => [
                'fillType'          => Fill::FILL_SOLID,
                'color' => [
                    'argb'          => $color,
                ],
            ],
        ];
        return $style;
    }
}
