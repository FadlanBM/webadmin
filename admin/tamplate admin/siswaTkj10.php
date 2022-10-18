<?php
include "koneksidatasiswa.php";

session_start();
if(empty($_SESSION['username']) or empty($_SESSION['level'])){
    echo "<script>alert('Maaf,Untuk mengakses halaman ini,anda harus login terlebih dahulu'); 
   document.location='login.php'</script>";
}


//jika tombol simpan di klik
if (isset($_POST['bsimpan'])) {

  //pengujian apakah data akan dia edit atau di simpan baru
  if (isset($_GET['hal']) == "edit") {
    //data akan di edit 
    $edit = mysqli_query($koneksi, "UPDATE tsiswa10 SET 
                                  absen   = '$_POST[tabsen]',
                                  id_nis  = '$_POST[tnis]',
                                  nama    = '$_POST[tnama]',
                                  kelas   = '$_POST[tkelas]',
                                  alamat  = '$_POST[talamat]'
                                  where absen = '$_GET[id]'");


    if ($edit) {
      echo "<script>
                        alert('edit Data Sukses!');
                        document.location='siswaTKJ10.php';         
                    </script>";
    } else {
      echo "<script>
                            alert('edit Data Gagal!');
                            document.location='siswaTKJ10.php';         
                        </script>";
    }
  } else {
    //Data Akan di simpan baru
    $simpan = mysqli_query($koneksi, " INSERT INTO tsiswa10 (absen,id_nis,nama,kelas,alamat)
                                      VALUE ('$_POST[tabsen]',
                                             '$_POST[tnis]',
                                             '$_POST[tnama]',
                                             '$_POST[tkelas]',
                                             '$_POST[talamat]')");
    if ($simpan) {
      echo "<script>
            alert('Simpan Data Sukses!');
            document.location='siswaTKJ10.php';         
        </script>";
    } else {
      echo "<script>
                alert('Simpan Data Gagal!');
                document.location='siswaTKJ10.php';         
            </script>";
    }
  }
}


//deklarasi variable untuk menampung data yang akan di edit
$vabsen = "";
$vnis = "";
$vnama = "";
$vkelas = "";
$valamat = "";


//pengujian jika tombol edit /hapus di klik 
if (isset($_GET['hal'])) {
  //pengujian jika edit data 
  if ($_GET['hal'] == "edit") {

    //tampikan data yang akan di edit
    $tampil = mysqli_query($koneksi, "SELECT * FROM tsiswa10 WHERE absen = '$_GET[id]'");
    $data = mysqli_fetch_array($tampil);
    if ($data) {
      //jika data di temukan,maka data akan di tampung ke dalam variable
      $vabsen = $data['absen'];
      $vnis   = $data['id_nis'];
      $vnama  = $data['nama'];
      $vkelas = $data['kelas'];
      $valamat = $data['alamat'];
    }
  } elseif ($_GET['hal'] == "hapus") {
    //persiapan hapus data 
    $hapus = mysqli_query($koneksi, "DELETE FROM tsiswa10 WHERE absen = '$_GET[id]'");
    //uji hapus data
    if ($hapus) {
      echo "<script>
              alert('hapus Data Sukses!');
              document.location='siswaTKJ10.php';         
          </script>";
    } else {
      echo "<script>
                  alert('hapus Data Gagal!');
                  document.location='siswaTKJ10.php';         
              </script>";
    }
  }
}










?>



<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Guru<sup>admin</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog "></i>
                    <span>Components</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Components:</h6>
                        <a class="collapse-item" href="buttons.html">Buttons</a>
                        <a class="collapse-item" href="cards.html">Cards</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Data siswa
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            

            <!-- Nav Item - Data siswa -->
            <li class="nav-item active">
                <a class="nav-link collapsed " href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Data Siswa</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Merubah Data Siswa</h6>
                        <a class="collapse-item active" href="utilities-color.html">X TKJ </a>
                        <a class="collapse-item" href="utilities-border.html">XI TKJ</a>
                        <a class="collapse-item" href="utilities-animation.html">XII TKJ</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tables</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->
            <div class="sidebar-card d-none d-lg-flex">
                <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">
                <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!</p>
                <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?=$_SESSION['username']?></span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Ubah Password
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Data Siswa </h1>
                    </div>

                    <!-- Content Row -->
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
                <input type="text" name="tabsen" value="<?= $vabsen ?>" class="form-control" placeholder="Masuukan No Absen Siswa">
              </div>

              <div class="mb-3">
                <label class="form-label">Nis</label>
                <input type="text" name="tnis" value="<?= $vnis ?>" class="form-control" placeholder="Masukkan Nis Siswa">
              </div>

              <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="tnama" value="<?= $vnama ?>" class="form-control" placeholder="Masukkan Nama Siswa">
              </div>

              <label class="form-label">Kelas</label>
              <select class="form-select" name="tkelas">
                <option value="<?= $vkelas ?>"><?= $vkelas ?></option>
                <option value="10 TKJ 1">10 TKJ 1 </option>
                <option value="10 TKJ 2">10 TKJ 2</option>
              </select>
              <br>
              <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Alamat</label>
                <textarea class="form-control" name="talamat" value="<?= $valamat ?>" id="exampleFormControlTextarea1" placeholder="Masukkan Alamat Siswa" rows="3"><?= $valamat ?></textarea>
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
              <input type="text" class="form-control" name="tcari" placeholder="Masukkan kata kunci">
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
          //untuk pencarian data
          if (isset($_POST['bcari'])) {
            $keyword = $_POST['tcari'];
            $q = "SELECT * FROM tsiswa10 WHERE id_nis like '%$keyword%' or nama like '%$keyword%' or alamat like '%$keyword%' or absen like '%$keyword%' or kelas like '%$keyword%'order by absen asc";
          } else {
            $q = "SELECT * FROM tsiswa10 order by absen ASC";
          }

          //persiapan menampikan data
          $tampil = mysqli_query($koneksi, $q);
          while ($data = mysqli_fetch_array($tampil)) :

          ?>
            <tr>
              <td><?= $data['absen'] ?></td>
              <td><?= $data['id_nis'] ?></td>
              <td><?= $data['nama'] ?></td>
              <td><?= $data['kelas'] ?></td>
              <td><?= $data['alamat'] ?></td>
              <td>
                <a href="siswaTkj10.php?hal=edit&id=<?= $data['absen'] ?>" class="btn btn-warning">Edit</a>
                <a href="siswaTkj10.php?hal=hapus&id=<?= $data['absen'] ?>" class="btn btn-danger" onclick="return confirm ('Apakah anda yakin menghapus data ini?')">Hapus</a>
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

                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>