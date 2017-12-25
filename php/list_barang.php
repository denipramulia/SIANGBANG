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
	if($user_type == "admin_barang"){
		$nama = $_SESSION["nama"];
	}
	$log_id = $_SESSION["log_id"];
?>

<!Doctype html>
<html>
	<head>
		<meta charset = "utf-8">
		<title>SIANGBANG - Home</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link id="general_theme" rel="stylesheet" type = "text/css" href = "../css/style.css"/>
		<link id="local_theme" rel="stylesheet" type = "text/css" href = "../css/login.css"/>
		<link type = "text/css" rel="stylesheet" href="../css/bootstrap.min.css"/>
	</head>

	<body style="overflow-x:hidden">
		<nav class="navbar navbar-inverse">
		  <div class="container-fluid">
		    <div class="navbar-header">
		      <a class="navbar-brand" href="index.php">SIANGBANG</a>
		    </div>
		    <ul class="nav navbar-nav">
		    <?php
		      if($_SESSION['user_type'] == "mahasiswa"){
			      echo '<li><a href="jadwal.php">Jadwal Ruangan</a></li>';
			      echo '<li><a href="list_barang.php">List Barang</a></li>';
			      echo '<li><a href="list_ruangan.php">List Ruangan</a></li>';	      
			      echo '<li><a href="create_peminjaman.php">Membuat Peminjaman</a></li>';
			      echo '<li><a href="print_peminjaman.php">Cetak Bukti Peminjaman</a></li>';
			      echo '<li><a href="history_peminjaman.php">Riwayat Peminjaman</a></li>';
		      } 
		      if($_SESSION['user_type'] == "admin_barang"){
			      echo '<li><a href="peminjaman_barang.php">Daftar Peminjaman</a></li>';
			      echo '<li><a href="pengembalian_barang.php">Pengembalian Barang</a></li>';
			      echo '<li><a href="list_barang.php">List Barang</a></li>';
			      echo '<li><a href="entry_barang.php">Entry Barang</a></li>';
			  }
			  echo '<li><a href="logout.php">Logout</a></li>;' 
			 ?>
		    </ul>
		  </div>
		</nav>
		<div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="panel">
                        <div class="panel-heading">
                            <h2> List Barang </h2>
                        </div>
                        <div class="panel-body">
                            <form method="post" id="form-register" action="list_barang.php">
                                <table class="table">
                                    <tbody>
                                       <tr>
                                          <td> Bulan </td>
                                          <td>
                                              <div class="form-group">
                                                 <select class="form-control"  name="Bulan" >  
                                                  <option selected="Januari" value="Januari">Januari</option>  
                                                  <option value="Februari">Februari</option>
                                                  <option value="Maret">Maret</option>  
                                                  <option value="April">April</option>
                                                  <option value="Mei">Mei</option>
                                                  <option value="Juni">Juni</option>  
                                                  <option value="Juli">Juli</option>
                                                  <option value="Agustus">Agustus</option>  
                                                  <option value="September">September</option>  
                                                  <option value="Oktober">Oktober</option>  
                                                  <option value="November">November</option>  
                                                  <option value="Desember">Desember</option>          
                                                 </select>
                                              </div>
                                          </td>
                                       </tr>
                                   </tbody>
                               </table>
                               <button name="submit" type="submit" class="btn btn-primary">Lihat</button>

                               <table class="table">
			                            <?php
			                              if ($_SERVER["REQUEST_METHOD"] == "POST"){
			                              	$Bulan = $_POST["Bulan"];
			                              	echo "<h3>Bulan $Bulan</h3>";
			                              	echo "<thead>
			                                       <tr>
			                                       	<th> Kode Barang </th> 
						                            <th> Nama Barang </th>
						                            <th> Jumlah Barang </th>
						                            <th> Jenis Barang </th>
						                            <th> Keterangan </th>
						                            <th> Foto </th>
						                           </tr>
						                          </thead>
						                          <tbody>";
			                                
			                                $sql = "SELECT kode_barang,nama_barang,jumlah_barang,jenis_barang,keterangan,foto FROM BARANG";
			                                    $result = pg_query($sql);		                                    
			                                    while ($row = pg_fetch_row($result)) {
			                                     echo "<tr>
			                                     			<td>$row[0]</td>
			                                     			<td>$row[1]</td>
			                                     			<td>$row[2]</td>
			                                     			<td>$row[3]</td>
			                                     			<td>$row[4]</td>
			                                     			<td>$row[5]</td>
			                                     		</tr>";
			                                    }
			                               	}
			                               	echo "</tbody>";
			                            ?>

	                           </table>
                           </form>
                       </div>
                    </div>
                </div>
            </div>
        </div>
		<footer>			
		</footer>
		<script type="text/javascript" src="../js/jquery-3.1.1.js"></script>
	</body>
</html>