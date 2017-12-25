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

  $kode_jadwal = $Tahun = $Semester = $NamaMatkul = $Kelas = $JamMulai_date = $JamSelesai_date = $Hari = $KodeRuangan = "";
  if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $kode_jadwal = $_POST["KodeJadwal"];
    $Tahun = $_POST["Tahun"];
    $Semester = $_POST["Semester"];
    $NamaMatkul = $_POST["NamaMatkul"];
    $Kelas = $_POST["Kelas"];
    $JamMulai = $_POST["JamMulai_date"] . " " .$_POST["JamMulai_jam"];
    $timestamp_JamMulai = $JamMulai;

    $JamSelesai = $_POST["JamSelesai_date"] . " " .$_POST["JamSelesai_jam"];
    $timestamp_JamSelesai = $JamSelesai;

    $Hari = $_POST["Hari"];
    $KodeRuangan = $_POST["KodeRuangan"];

    $query = "SELECT * FROM JADWAL";
    $result = pg_query($db, $query);
    $row = pg_fetch_assoc($result);

    if($row["kode_jadwal"] == $kode_jadwal){
      $_SESSION['errMsg'] =  'Kode Jadwal Sudah Ada';
    }
    else {
      $a = "INSERT INTO JADWAL(kode_jadwal,tahun_term,semester_term,nama_matkul,kelas,jam_mulai,jam_selesai,hari,kode_ruangan,username_admin) VALUES ('".$kode_jadwal."' , '".$Tahun."' , '".$Semester."' , '".$NamaMatkul."' , '".$Kelas."' , '".$timestamp_JamMulai."' , '".$timestamp_JamSelesai."' , '".$Hari."' , '".$KodeRuangan."' , '".$log_id."') ";

      if ( pg_query($db, $a) == TRUE) {
         $_SESSION['errMsg'] =  "New record created successfully";
      } else {
         $_SESSION['errMsg'] = "Error Input Database";
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
      <title>Entry Jadwal</title>
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
                            <h2> Entry Jadwal </h2>
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
                            <form method="post" id="form-register" action="entry_jadwal.php">
                                <table class="table">
                                    <tbody>
                                       <tr>
                                          <td> Kode Jadwal </td>
                                          <td>
                                            <div class="form-group">
                                             <input class="form-control" placeholder="Kode Jadwal" type="text" name="KodeJadwal" required>
                                            </div>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td> Tahun </td>
                                          <td>
                                            <div class="form-group">
                                              <?php
                                                $currently_selected = date('Y'); 
                                                $earliest_year = $currently_selected - 5; 
                                                $latest_year = $currently_selected + 5; 

                                                print '<select class="form-control"  name="Tahun" >';
                                                foreach ( range( $latest_year, $earliest_year ) as $i ) {
                                                  print '<option value="'.$i.'"'.($i === $currently_selected ? ' selected="selected"' : '').'>'.$i.'</option>';
                                                }
                                                print '</select>';
                                              ?>
                                            </div>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td> Semester </td>
                                          <td>
                                              <div class="form-group">
                                                 <select class="form-control"  name="Semester" >  
                                                  <option selected="" value="1">1</option>  
                                                  <option value="2">2</option>
                                                  <option value="3">3</option>       
                                                 </select>
                                              </div>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td> Nama Mata Kuliah </td>
                                          <td>
                                            <div class="form-group">
                                             <input class="form-control" placeholder="Nama Mata Kuliah" type="text" name="NamaMatkul" required>
                                            </div>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td> Kelas </td>
                                          <td>
                                            <div class="form-group">
                                             <input class="form-control" placeholder="Kelas" type="text" name="Kelas" required>
                                            </div>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td> Jam Mulai </td>
                                          <td>
                                            <div class="form-group">
                                              <input class="form-control"  placeholder="Waktu Mulai" type="date" name="JamMulai_date" id="datepicker" required>
                                              <input class="form-control"  placeholder="Waktu Mulai" type="time" name="JamMulai_jam" id="datepicker" required>
                                            </div>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td> Jam Selesai </td>
                                          <td>
                                            <input class="form-control"  placeholder="Waktu Selesai" type="date" name="JamSelesai_date" id="datepicker" required>
                                            <input class="form-control"  placeholder="Waktu Selesai" type="time" name="JamSelesai_jam" id="datepicker" required>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td> Hari </td>
                                          <td>
                                              <div class="form-group">
                                                 <select class="form-control"  name="Hari" >  
                                                  <option selected="" value="">(Pilih Hari)</option>  
                                                  <option value="Senin">Senin</option>  
                                                  <option value="Selasa">Selasa</option>
                                                  <option value="Rabu">Rabu</option>  
                                                  <option value="Kamis">Kamis</option>
                                                  <option value="Jumat">Jumat</option>
                                                  <option value="Sabtu">Sabtu</option>  
                                                  <option value="Minggu">Minggu</option>        
                                                 </select>
                                              </div>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td> Kode Ruangan </td>
                                          <td>
                                            <div class="form-group">
                                             <input class="form-control" placeholder="Kode Ruangan" type="text" name="KodeRuangan" required>
                                            </div>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td> Admin Ruangan </td>
                                          <td>
                                            <div class="form-group">
                                              <?php
                                              echo $nama ;
                                              ?>
                                            </div>
                                          </td>
                                       </tr>
                                    </tbody>
                                </table>

                                <button name="submit" type="submit" class="btn btn-primary">Create</button>    
                                <button type="reset" class="btn btn-danger"> Reset </button>          
                            </form>
                        <!-- <script>
                          $( function() {
                            $( "#datepicker" ).datepicker();
                          } );
                        </script> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
  </body>
</html>