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
		      echo '<li class="active"><a href="index.php">Home</a></li>';
		      echo '<li><a href="jadwal.php">Jadwal Ruangan</a></li>';
		      echo '<li><a href="list_barang.php">List Barang</a></li>';
		      echo '<li><a href="list_ruangan.php">List Ruangan</a></li>';	      
		      echo '<li><a href="#">Membuat Peminjaman</a></li>';
		      echo '<li><a href="print_peminjaman.php">Cetak Bukti Peminjaman</a></li>';
		      echo '<li><a href="history_peminjaman.php">Riwayat Peminjaman</a></li>';
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
                            <h2> Membuat Peminjaman </h2>
                        </div>
                        <div class="panel-body">
                        	 <table class="table">
                                    <tbody>
                                       <tr>
                                          <td><a href="create_peminjaman_ruangan.php"><h3>Peminjaman Ruangan</h3></a></td>
                                          <td><a href="create_peminjaman_barang.php"><h3>Peminjaman Barang</h3></a></td>
                                       </tr>
                                    </tbody>
                             </table>
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