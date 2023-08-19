<?php
usleep(500000);
require '../function.php';

$keyword = $_GET["keyword"];
$query = "SELECT*FROM perpanjanganta 
        WHERE
        nama LIKE '%$keyword%' OR 
        nim LIKE '%$keyword%' OR
        nomor_hp LIKE '%$keyword%' OR
        email LIKE '%$keyword%'OR
        judul_ta LIKE '%$keyword%' OR
        nama_pembimbing LIKE '%$keyword%'
        ORDER BY nama
        ";

$perpanjanganTA = query($query)

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
          <th scope="col">Formulir perpanjangan waktu</th>
        </tr>
      </thead>
      <tbody class="content_table">
        <?php $i = 1 ?>
        <?php foreach($perpanjanganTA as $row) : ?>
          <?php
            $logbookName = $row["logbook"];
            $formulirName = $row["formulir_perpanjangan"];
            //============================================
            $logbookLink = "Data/" . $logbookName;
            $formulirLink = "Data/" . $formulirName;
          ?>
          <tr>
            <th scope="row"><?= $i; ?></th>
            <td>
              <a href="editPTA.php?id=<?= $row["id"] ?>">ubah</a>
              <a href="deletePTA.php?id=<?= $row["id"] ?>" onclick="
              return confirm('Anda yakin ingin menghapus?')">hapus</a>
            </td>
            <td><?= $row["nama"] ?></td>
            <td><?= $row["nim"] ?></td>
            <td><?= $row["nomor_hp"] ?></td>
            <td><?= $row["email"] ?></td>
            <td><?= $row["judul_ta"] ?></td>
            <td><?= $row["nama_pembimbing"] ?></td>
            <td><img src="Data/<?= $row["ksm"] ?>" width="100" ></td>
            <td><a href="<?= $logbookLink ?>"><?= $logbookName ?></a> </td>
            <td><a href="<?= $formulirLink ?>"><?= $formulirName ?></a> </td>
          </tr>
          <?php $i++; ?>
        <?php endforeach; ?>
      </tbody>
    </table>
</div>