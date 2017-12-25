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
		      <a class="navbar-brand" href="home.php">SIANGBANG</a>
		    </div>
		    <ul class="nav navbar-nav">
		    <?php
		      echo '<li class="active"><a href="#">Home</a></li>';
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
			  if($_SESSION['user_type'] == "admin_ruangan"){
			      echo '<li><a href="peminjaman_ruangan.php">Daftar Peminjaman</a></li>';
			      echo '<li><a href="jadwal.php">Jadwal Ruangan</a></li>';
			      echo '<li><a href="entry_jadwal.php">Entry Jadwal</a></li>';
			  }
			  if($_SESSION['user_type'] == "manajer"){
			      echo '<li><a href="peminjaman_ruangan.php">Daftar Peminjaman Ruangan</a></li>';
			      echo '<li><a href="jadwal.php">Jadwal Ruangan</a></li>';
			      echo '<li><a href="list_barang.php">List Barang</a></li>';
			  }			  
		      echo '<li><a href="logout.php">Logout</a></li>;' 
		    ?>
		    </ul>
		  </div>
		</nav>

		<div class="panel-heading">
            <?php
				if($_SESSION["user_type"] == "mahasiswa"){
					echo '<h2>Hello, Mahasiswa ' . $nama. ' - ' .$npm.'!</h2>';
				}
				if($_SESSION["user_type"] == "admin_barang"){
					echo '<h2>Hello, Admin Barang ' . $nama. '!</h2>';
				}
				if($_SESSION["user_type"] == "admin_ruangan"){
					echo '<h2>Hello, Admin Ruangan ' . $nama. '!</h2>';
				}
				if($_SESSION["user_type"] == "manajer"){
					echo '<h2>Hello, Manajer!</h2>';
				}
			?>	
        </div>
	
	
		<footer>			
		</footer>
		<script type="text/javascript" src="../js/jquery-3.1.1.js"></script>
	</body>
</html>