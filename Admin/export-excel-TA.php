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
    $activeSheet->setCellValue('G1', 'Judul Artikel Publikasi');
    $activeSheet->setCellValue('H1', 'KSM');
    $activeSheet->setCellValue('I1', 'Logbook Bimbingan TA');
    $activeSheet->setCellValue('J1', 'Lembar Persetujuan Ujian TA');
    $activeSheet->setCellValue('K1', 'Lembar Keterangan publikasi TA');
    $activeSheet->setCellValue('L1', 'naskah TA');
    $activeSheet->setCellValue('M1', 'Artikel Publikasi');
    $activeSheet->setCellValue('N1', 'Laman OJS');
    $activeSheet->setCellValue('O1', 'Jurnal Ilmiah');
    $activeSheet->setCellValue('P1', 'URL');
    
    $TA = mysqli_query($db, "SELECT
                    nama, nim, nomor_hp, email, judul_ta, nama_pembimbing, judul_artikel,
                    ksm, logbook, lembar_persetujuan, lembar_keterangan, naskah_ta,
                    artikel_publikasi, laman_ojs,
                    CONCAT(nama_jurnal, ', ', tahun, ', ', volume, ', ', nomor_jurnal, ', ', halaman) AS jurnal,
                    url_artikel
                FROM ujianta");

        $i = 2;
        while($row = mysqli_fetch_assoc($TA)) {
            // $activeSheet->setCellValue('A'.$i, $row['id']);
            $activeSheet->setCellValue('A'.$i, $row['nama']);
            $activeSheet->setCellValue('B'.$i, $row['nim']);
            $activeSheet->setCellValue('C'.$i, $row['nomor_hp']);
            $activeSheet->setCellValue('D'.$i, $row['email']);
            $activeSheet->setCellValue('E'.$i, $row['judul_ta']);
            $activeSheet->setCellValue('F'.$i, $row['nama_pembimbing']);
            $activeSheet->setCellValue('G'.$i, $row['judul_artikel']);
            $activeSheet->setCellValue('H'.$i, $row['ksm']);
            $activeSheet->setCellValue('I'.$i, $row['logbook']);
            $activeSheet->setCellValue('J'.$i, $row['lembar_persetujuan']);
            $activeSheet->setCellValue('K'.$i, $row['lembar_keterangan']);
            $activeSheet->setCellValue('L'.$i, $row['naskah_ta']);
            $activeSheet->setCellValue('M'.$i, $row['artikel_publikasi']);
            $activeSheet->setCellValue('N'.$i, $row['laman_ojs']);
            $activeSheet->setCellValue('O'.$i, $row['jurnal']);
            $activeSheet->setCellValue('P'.$i, $row['url_artikel']);
            
            $i++; 
        }    
    
    

    $filename = "Laporan TA.xlsx";
 
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'. $filename);
    header('Cache-Control: max-age=0');
    $Excel_writer->save('php://output');
?>