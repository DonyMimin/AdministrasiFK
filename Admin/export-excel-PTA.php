<?php
    include "function.php";
    require 'vendor/autoload.php';

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    $spreadsheet = new Spreadsheet();
    $Excel_writer = new Xlsx($spreadsheet);
    $spreadsheet->setActiveSheetIndex(0);
    $activeSheet = $spreadsheet->getActiveSheet();

    // $activeSheet->setCellValue('A1', 'ID');
    $activeSheet->setCellValue('A1', 'Nama');
    $activeSheet->setCellValue('B1', 'NIM');
    $activeSheet->setCellValue('C1', 'Nomor hp');
    $activeSheet->setCellValue('D1', 'Email');
    $activeSheet->setCellValue('E1', 'Judul Tugas Akhir');
    $activeSheet->setCellValue('F1', 'Nama Pembimbing');
    $activeSheet->setCellValue('G1', 'KSM');
    $activeSheet->setCellValue('H1', 'Logbook bimbingan TA');
    $activeSheet->setCellValue('I1', 'Formulir Perpanjangan Waktu Penyelesaian TA');
    
    $PTA = mysqli_query($db,"SELECT * FROM perpanjanganta");

        $i = 2;
        while($row = mysqli_fetch_assoc($PTA)) {
            // $activeSheet->setCellValue('A'.$i, $row['id']);
            $activeSheet->setCellValue('A'.$i, $row['nama']);
            $activeSheet->setCellValue('B'.$i, $row['nim']);
            $activeSheet->setCellValue('C'.$i, $row['nomor_hp']);
            $activeSheet->setCellValue('D'.$i, $row['email']);
            $activeSheet->setCellValue('E'.$i, $row['judul_ta']);
            $activeSheet->setCellValue('F'.$i, $row['nama_pembimbing']);
            $activeSheet->setCellValue('G'.$i, $row['ksm']);
            $activeSheet->setCellValue('H'.$i, $row['logbook']);
            $activeSheet->setCellValue('I'.$i, $row['formulir_perpanjangan']);
            
            $i++; 
        }    
    
    

    $filename = "Laporan PTA.xlsx";
 
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'. $filename);
    header('Cache-Control: max-age=0');
    $Excel_writer->save('php://output');
?>