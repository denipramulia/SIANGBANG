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
		      echo '<li class="active"><a href="#">Home</a></li>';
		      echo '<li><a href="peminjaman_ruangan.php">Daftar Peminjaman</a></li>';
		      echo '<li><a href="jadwal.php">Jadwal Ruangan</a></li>';
		      echo '<li><a href="entry_jadwal.php">Entry Jadwal</a></li>';
		      echo '<li><a href="logout.php">Logout</a></li>;' 
		    ?>
		    </ul>
		  </div>
		</nav>
		<div class="panel-heading">
            <h2>Hello, Admin Ruangan! </h2>
        </div>
		<footer>			
		</footer>
		<script type="text/javascript" src="../js/jquery-3.1.1.js"></script>
	</body>
</html>