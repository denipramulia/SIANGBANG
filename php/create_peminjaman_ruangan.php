<?php
    session_start(); 
 
    if(!isset($_SESSION["log_id"])){
      header('Location: login.php');
  } 

  include "connection.php";
    
  global $db;

  $user_type = $_SESSION["user_type"];

  if($user_type == "mahasiswa"){
    $nama = $_SESSION["nama"];
    $npm = $_SESSION["npm"];
  }
  if($user_type == "admin_ruangan" || $user_type == "admin_barang"){
    $nama = $_SESSION["nama"];
  }
  $log_id = $_SESSION["log_id"];

  $Tgl_request = $Ruangan = $Tgl_mulai = $Tgl_selesai = $Waktu_mulai = $Waktu_selesai = $Nama_kegiatan = $Tujuan = $Jumlah_peserta = "";
  if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $sql = "SELECT username FROM ADMIN_RUANGAN ORDER BY RANDOM() LIMIT 1";
    $result = pg_query($sql);
    $row = pg_fetch_row($result);
    
    $Tgl_request = date("Y-m-d");
    $Ruangan = $_POST["Ruangan"];
    $Tgl_mulai = $_POST["tglMulai"];
    $Tgl_selesai = $_POST["tglSelesai"];

    $Waktu_mulai = $_POST["tglMulai"] . " " .$_POST["WktMulai"];
    $timestamp_TglMulai = $Waktu_mulai;

    $Waktu_selesai = $_POST["tglSelesai"] . " " .$_POST["WktSelesai"];
    $timestamp_TglSelesai = $Waktu_selesai;

    $Nama_kegiatan = $_POST["Kegiatan"];
    $Tujuan = $_POST["Tujuan"];
    $Jumlah_peserta = $_POST["JmlhPeserta"];

      $a = "INSERT INTO PEMINJAMAN_RUANG(tgl_mulai, kode_ruangan, username_mhs, tgl_selesai, tgl_req, waktu_mulai, waktu_selesai, nama_kegiatan, tujuan, jumlah_peserta, status, username_admin) VALUES ('".$Tgl_mulai."' , '".$Ruangan."' , '".$log_id."' , '".$Tgl_selesai."' , '".$Tgl_request."' , '".$timestamp_TglMulai."' , '".$timestamp_TglSelesai."' , '".$Nama_kegiatan."' , '".$Tujuan."' , '".$Jumlah_peserta."' , 1 , '".$row[0]."') ";

      if ( pg_query($db, $a) == TRUE) {
         $_SESSION['errMsg'] = "New record created successfully";
      } else {
         $_SESSION['errMsg'] = "Error Input Database";
      }
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
      <title>Entry Peminjaman Ruangan</title>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="../css/bootstrap.min.css" />
      <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
      <header>
      <nav class="navbar navbar-inverse">
      		  <div class="container-fluid">
      		    <div class="navbar-header">
      		      <a class="navbar-brand" href="index.php">Back to Home</a>
      		    </div>
      		  </div>
      </nav>
      </header>
      <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
      <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  </head>
  <body>
      <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="panel">
                        <div class="panel-heading">
                            <h2> Buat Peminjaman Ruangan </h2>
                        </div>
                        <div id="errMsg">
                          <?php
                            if(isset($_SESSION['errMsg'])) {
                              echo "<p><b>" . $_SESSION['errMsg'] . "</b></p>";
                              unset($_SESSION['errMsg']);
                            }
                          ?>
                        </div>
                        <div class="panel-body">
                            <form method="post" id="form-register" action="create_peminjaman_ruangan.php">
                                <table class="table">
                                    <tbody>
                                      <tr>
                                          <td> Tanggal Request </td>
                                          <td>
                                            <div class="form-group">
                                             <?php
                                               echo date("j F Y") ;  
                                             ?>                                             
                                            </div>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td> Ruangan </td>
                                          <td>
                                            <div class="form-group">
                                             <?php
                                                  $sql = "SELECT no_ruangan,nama_ruangan FROM RUANGAN";
                                                  $result = pg_query($sql);
                                                   print '<select class="form-control"  name="Ruangan" >';
                                                  while ($row = pg_fetch_row($result)) {
                                                       print '<option value="'.$row[0].'">'.$row[0]. ' - '.$row[1].'</option>';

                                                  }
                                                   print '</select>';
                                              ?>                                             
                                              </div>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td> Tanggal Mulai </td>
                                          <td>
                                            <div class="form-group">
                                             <input class="form-control"  placeholder="Tanggal Mulai" type="date" name="tglMulai" id="datepicker" required>
                                            </div>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td> Tanggal Selesai </td>
                                          <td>
                                            <div class="form-group">
                                             <input class="form-control"  placeholder="Tanggal Selesai" type="date" name="tglSelesai" id="datepicker" required>
                                            </div>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td> Waktu Mulai </td>
                                          <td>
                                            <div class="form-group">
                                             <input class="form-control"  placeholder="Waktu Mulai" type="time" name="WktMulai" id="datepicker" required>
                                            </div>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td> Waktu Selesai </td>
                                          <td>
                                            <div class="form-group">
                                             <input class="form-control"  placeholder="Waktu Selesai" type="time" name="WktSelesai" id="datepicker" required>
                                            </div>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td> Nama Kegiatan </td>
                                          <td>
                                            <div class="form-group">
                                              <input class="form-control" placeholder="Nama Kegiatan" type="text" name="Kegiatan" required>
                                            </div>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td> Tujuan </td>
                                          <td>
                                              <div class="form-group">
                                                <input class="form-control" placeholder="Tujuan" type="text" name="Tujuan" required>
                                              </div>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td> Jumlah Peserta </td>
                                          <td>
                                            <div class="form-group">
                                             <input class="form-control" placeholder="Jumlah Peserta" type="text" name="JmlhPeserta" required>
                                            </div>
                                          </td>
                                       </tr>
                                    </tbody>
                                </table>

                                <button name="submit" type="submit" class="btn btn-primary">Create</button>    
                                <button type="reset" class="btn btn-danger"> Reset </button>          
                            </form>
                        </div>
                        <!-- <script>
                          $( function() {
                            $( "#datepicker" ).datepicker();
                          } );
                        </script> -->
                    </div>
                </div>
            </div>
        </div>
  </body>
</html>