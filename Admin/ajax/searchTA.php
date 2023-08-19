<?php
require '../function.php';

$keyword = $_GET["keyword"];
$query = "SELECT*FROM ujianta
        WHERE
        nama LIKE '%$keyword%' OR 
        nim LIKE '%$keyword%' OR
        nomor_hp LIKE '%$keyword%' OR
        email LIKE '%$keyword%'OR
        judul_ta LIKE '%$keyword%' OR
        nama_pembimbing LIKE '%$keyword%' OR
        judul_artikel LIKE '%$keyword%' OR
        nama_jurnal LIKE '%$keyword%' OR
        tahun LIKE '%$keyword%' OR
        volume LIKE '%$keyword%' OR
        nomor_jurnal LIKE '%$keyword%' OR
        halaman LIKE '%$keyword%' OR
        url_artikel LIKE '%$keyword%'

        ORDER BY nama
        ";

$TA = query($query)

?>

<div class="table-responsive">
  <table class="table table-bordered">
    <thead class="thead-light">
        <tr>
        <th scope="col">#</th>
        <th scope="col">Aksi</th>
        <th scope="col">Nama</th>
        <th scope="col">nim</th>
        <th scope="col">nomor_hp</th>
        <th scope="col">email</th>
        <th scope="col">judul_TA</th>
        <th scope="col">Nama_Pembimbing</th>
        <th scope="col">KSM</th>
        <th scope="col">logbook</th>
        <th scope="col">Lembar persetujuan</th>
        <th scope="col">Lembar keterangan</th>
        <th scope="col">Naskah TA</th>
        <th scope="col">Artikel Publikasi</th>
        <th scope="col">Laman OJS</th>
        <th scope="col">Nama Jurnal</th>
        <th scope="col">Tahun Jurnal</th>
        <th scope="col">Volume Jurnal</th>
        <th scope="col">Nomor Jurnal</th>
        <th scope="col">Halaman Jurnal</th>
        <th scope="col">URL artikel</th>
        </tr>
    </thead>
    <tbody class="content_table">
        <?php $i = 1 ?>
        <?php foreach($TA as $row) : ?>
        <?php
          $logbookName = $row["logbook"];
          $lembar_persetujuanName = $row["lembar_persetujuan"];
          $lembar_keteranganName = $row["lembar_keterangan"];
          $naskah_taName = $row["naskah_ta"];
          $artikel_publikasiName = $row["artikel_publikasi"];
          //============================================================
          $logbookLink = "Data/" . $logbookName;
          $lembar_persetujuanLink = "Data/" . $lembar_persetujuanName;
          $lembar_keteranganLink = "Data/" . $lembar_keteranganName;
          $naskah_taLink = "Data/" . $naskah_taName;
          $artikel_publikasiLink = "Data/" . $artikel_publikasiName;
        ?>
        <tr>
        <th scope="row"><?= $i; ?></th>
        <td>
            <a href="editTA.php?id=<?= $row["id"] ?>">ubah</a>
            <a href="deleteTA.php?id=<?= $row["id"]; ?>" onclick="
            return confirm('Anda yakin ingin menghapus?')" >hapus</a>
        </td>
        <td><?= $row["nama"] ?></td>
        <td><?= $row["nim"] ?></td>
        <td><?= $row["nomor_hp"] ?></td>
        <td><?= $row["email"] ?></td>
        <td><?= $row["judul_ta"] ?></td>
        <td><?= $row["nama_pembimbing"] ?></td>
        <td><img src="Data/<?= $row["ksm"] ?>" width="100"></td>
        <td><a href="<?= $logbookLink ?>"><?= $logbookName ?></td>
        <td><a href="<?= $lembar_persetujuanLink ?>"><?= $lembar_persetujuanName ?></td>
        <td><a href="<?= $lembar_keteranganLink ?>"><?= $lembar_keteranganName ?></td>
        <td><a href="<?= $naskah_taLink ?>"><?= $naskah_taName ?></td>
        <td><a href="<?= $artikel_publikasiLink ?>"><?= $artikel_publikasiName ?></td>
        <td><img src="Data/<?= $row["laman_ojs"] ?>" width="100"></td>
        <td><?= $row["nama_jurnal"] ?></td>
        <td><?= $row["tahun"] ?></td>
        <td><?= $row["volume"] ?></td>
        <td><?= $row["nomor_jurnal"] ?></td>
        <td><?= $row["halaman"] ?></td>
        <td><?= $row["url_artikel"] ?></td>
        </tr>
        <?php $i++; ?>
        <?php endforeach; ?>
    </tbody>
  </table>
</div>