<?php
$server = "localhost";
$user = "root";
$password = "12345123";
$database = "dbsiswa";
//buat koneksi
$koneksi = mysqli_connect($server, $user, $password, $database) or die(mysqli_error($koneksi));

//kode otomatis 
$q = mysqli_query($koneksi,"SELECT absen FROM tsiswa10 order by absen asc limit 1");+
B$datax = mysqli_fetch_array($q);
if($datax){
$no_terakhir =substr($datax['absen'],-3);
$no=$no_terakhir +1;

if($no > 0 and $no <10){
  
}
}

//jika tombol simpan di klik
if(isset($_POST['bsimpan'])){

  //pengujian apakah data akan dia edit atau di simpan baru
  if(isset($_GET['hal'])=="edit"){
    //data akan di edit 
    $edit= mysqli_query($koneksi,"UPDATE tsiswa10 SET 
                                  absen   = '$_POST[tabsen]',
                                  id_nis  = '$_POST[tnis]',
                                  nama    = '$_POST[tnama]',
                                  kelas   = '$_POST[tkelas]',
                                  alamat  = '$_POST[talamat]'
                                  where absen = '$_GET[id]'");


               if($edit){
                echo"<script>
                        alert('edit Data Sukses!');
                        document.location='siswaTKJ10.php';         
                    </script>";
                  }else{
                    echo"<script>
                            alert('edit Data Gagal!');
                            document.location='siswaTKJ10.php';         
                        </script>";
                 }                   
                

  }else{
    //Data Akan di simpan baru
    $simpan =mysqli_query($koneksi," INSERT INTO tsiswa10 (absen,id_nis,nama,kelas,alamat)
                                      VALUE ('$_POST[tabsen]',
                                             '$_POST[tnis]',
                                             '$_POST[tnama]',
                                             '$_POST[tkelas]',
                                             '$_POST[talamat]')");
  if($simpan){
    echo"<script>
            alert('Simpan Data Sukses!');
            document.location='siswaTKJ10.php';         
        </script>";
      }else{
        echo"<script>
                alert('Simpan Data Gagal!');
                document.location='siswaTKJ10.php';         
            </script>";
     }
  }
}


//deklarasi variable untuk menampung data yang akan di edit
$vabsen="";
$vnis="";
$vnama="";
$vkelas="";
$valamat="";


//pengujian jika tombol edit /hapus di klik 
if(isset($_GET['hal'])){
  //pengujian jika edit data 
  if($_GET['hal'] == "edit"){

      //tampikan data yang akan di edit
        $tampil=mysqli_query($koneksi,"SELECT * FROM tsiswa10 WHERE absen = '$_GET[id]'");
        $data=mysqli_fetch_array($tampil);
        if($data){
          //jika data di temukan,maka data akan di tampung ke dalam variable
          $vabsen =$data['absen'];
          $vnis   =$data['id_nis'];
          $vnama  =$data['nama'];
          $vkelas =$data['kelas'];
          $valamat=$data['alamat'];
        }

  }elseif( $_GET['hal']=="hapus"){
    //persiapan hapus data 
    $hapus = mysqli_query($koneksi,"DELETE FROM tsiswa10 WHERE absen = '$_GET[id]'");
    //uji hapus data
    if($hapus){
      echo"<script>
              alert('hapus Data Sukses!');
              document.location='siswaTKJ10.php';         
          </script>";
        }else{
          echo"<script>
                  alert('hapus Data Gagal!');
                  document.location='siswaTKJ10.php';         
              </script>";
       }                   
      
  }
}










?>



<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
  <!-- Awal container -->
  <div class="container">

    <h2 class="text-center">Data Siswa TKJ Kelas 10</h2>
    <!-- Awal row -->
    <div class="row">
      <!-- Awal col -->
      <div class="col-md-8 mx-auto">
        <!-- Awal Card -->
        <div class="card">
          <div class="card-header bg-danger text-light">
            Form Input Data SIswa
          </div>
          <div class="card-body">
            <!-- Awal Form -->
            <form method="POST">
              <div class="mb-3">
                <label class="form-label">No Absen</label>
                <input type="text" name="tabsen" value="<?=$vabsen?>" class="form-control" placeholder="Masuukan No Absen Siswa">
              </div>

              <div class="mb-3">
                <label class="form-label">Nis</label>
                <input type="text" name="tnis" value="<?=$vnis?>" class="form-control" placeholder="Masukkan Nis Siswa">
              </div>

              <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="tnama" value="<?=$vnama?>" class="form-control" placeholder="Masukkan Nama Siswa">
              </div>

              <label class="form-label">Kelas</label>
              <select class="form-select" name="tkelas">
                <option value="<?=$vkelas?>"><?=$vkelas?></option>
                <option value="10 TKJ 1">10 TKJ 1 </option>
                <option value="10 TKJ 2">10 TKJ 2</option>
              </select>

              <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Alamat</label>
                <textarea class="form-control" name="talamat" value="<?=$valamat?>" id="exampleFormControlTextarea1" placeholder="Masukkan Alamat Siswa" rows="3"><?=$valamat?></textarea>
              </div>

              <div class="text-center">
                <hr>
                <button class="btn btn-primary" name="bsimpan" type="submit">Simpan</button>
                <button class="btn btn-danger" name="bkosongkan" type="riset">kosongkan</button>
              </div>


            </form>
            <!-- Akhir Form -->
          </div>
          <div class="card-footer bg-danger">

          </div>
        </div>
        <!-- Akhir Card -->
      </div>
      <!-- Akhir col -->
    </div>
    <!-- Akhir row -->


    <!-- Awal Card -->
    <div class="card mt-4">
      <div class="card-header bg-danger text-light">
        Data Barang
      </div>
      <div class="card-body">
        <div class="col-md-8 mx-auto">
          <form method="POST">
            <div class="input-group mb-3">
              <input type="text" class="form-control" value="<?= @$_POST['tcari'] ?>" name="tcari" placeholder="Masukkan kata kunci">
              <button class="btn btn-primary" name="bcari" type="submit">Cari</button>
              <button class="btn btn-danger" name="briset" type="submit">Reset</button>
            </div>
          </form>
        </div>
        <table class="table table-striped table-hover tabel-bordered">
          <tr>
            <th>No Absen</th>
            <th>Nis</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Alamat</th>
            <th>Aksi</th>
          </tr>

          <?php
          //persiapan menampikan data
          $tampil = mysqli_query($koneksi, "SELECT * FROM tsiswa10 order by absen ASC");
          while ($data = mysqli_fetch_array($tampil)) :

          ?>
            <tr>
              <td><?= $data['absen'] ?></td>
              <td><?= $data['id_nis'] ?></td>
              <td><?= $data['nama'] ?></td>
              <td><?= $data['kelas'] ?></td>
              <td><?= $data['alamat'] ?></td>
              <td>
                <a href="siswaTkj10.php?hal=edit&id=<?=$data['absen']?>" class="btn btn-warning">Edit</a>
                <a href="siswaTkj10.php?hal=hapus&id=<?=$data['absen']?>" class="btn btn-danger" 
                onclick="return confirm ('Apakah anda yakin menghapus data ini?')">Hapus</a>
              </td>
            </tr>

          <?php endwhile; ?>


        </table>
      </div>
      <div class="card-footer bg-danger">
      </div>
    </div>


  </div>
  <!-- Akhir container -->




  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>