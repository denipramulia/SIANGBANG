CREATE SCHEMA SIANGBANG;

SET search_path TO SIANGBANG;

CREATE TABLE TERM(
	tahun INT,
	semester INT NOT NULL CHECK(semester BETWEEN 1 AND 3),
	PRIMARY KEY(tahun,semester)
);

CREATE TABLE ADMIN_BARANG(
	username VARCHAR(50),
	password VARCHAR(20) NOT NULL,
	email VARCHAR(50) NOT NULL,
	nama VARCHAR(100) NOT NULL,
	PRIMARY KEY (username)
);

CREATE TABLE ADMIN_RUANGAN(
	username VARCHAR(50),
	password VARCHAR(20) NOT NULL,
	email VARCHAR(50) NOT NULL,
	nama VARCHAR(100) NOT NULL,
	PRIMARY KEY(username)
);

CREATE TABLE MAHASISWA(
	username VARCHAR(50),
	password VARCHAR(20) NOT NULL,
	email VARCHAR(50) NOT NULL,
	nama VARCHAR(100) NOT NULL,
	NPM CHAR(50) UNIQUE NOT NULL,
	PRIMARY KEY(username)
);

CREATE TABLE MANAJER(
	username VARCHAR(50),
	password VARCHAR(20) NOT NULL,
	PRIMARY KEY (username, password)
);

CREATE TABLE BARANG(
	kode_barang CHAR(8),
	nama_barang VARCHAR(100) NOT NULL,
	jumlah_barang INT NOT NULL DEFAULT 0,
	jenis_barang VARCHAR(50) NOT NULL,
	keterangan TEXT,
	foto VARCHAR(100),
	username_admin VARCHAR(50) NOT NULL,
	PRIMARY KEY(kode_barang),
	FOREIGN KEY(username_admin) REFERENCES ADMIN_BARANG(username) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE BARANG_ELEKTRONIK(
	kode_barang CHAR(8),
	watt INT NOT NULL,
	merk VARCHAR(50) NOT NULL,
	warna VARCHAR(10) NOT NULL,
	PRIMARY KEY(kode_barang),
	FOREIGN KEY(kode_barang) REFERENCES BARANG(kode_barang) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE RUANGAN(
	no_ruangan CHAR(4),
	nama_ruangan VARCHAR(100) NOT NULL,
	jenis_ruangan VARCHAR(50) NOT NULL,
	PRIMARY KEY(no_ruangan)
);

CREATE TABLE JADWAL(
	kode_jadwal CHAR(5),
	tahun_term INT NOT NULL,
	semester_term INT NOT NULL,
	nama_matkul VARCHAR(100) NOT NULL,
	kelas VARCHAR(5) NOT NULL,
	jam_mulai TIMESTAMP NOT NULL,
	jam_selesai TIMESTAMP NOT NULL,
	hari VARCHAR(10) NOT NULL,
	kode_ruangan CHAR(4) NOT NULL,
	username_admin VARCHAR(50) NOT NULL,
	PRIMARY KEY(kode_jadwal),
	FOREIGN KEY(tahun_term,semester_term) REFERENCES TERM(tahun,semester) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY(kode_ruangan) REFERENCES RUANGAN(no_ruangan) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY(username_admin) REFERENCES ADMIN_RUANGAN(username) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE RUANGAN_INDOOR(
	no_ruangan CHAR(4),
	jenis_indoor VARCHAR(50) NOT NULL,
	kapasitas INT NOT NULL,
	PRIMARY KEY(no_ruangan),
	FOREIGN KEY(no_ruangan) REFERENCES RUANGAN(no_ruangan) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE PEMINJAMAN_RUANG(
	tgl_mulai DATE,
	kode_ruangan CHAR(4),
	username_mhs VARCHAR(50),
	tgl_selesai DATE NOT NULL,
	tgl_req DATE NOT NULL,
	waktu_mulai TIMESTAMP NOT NULL,
	waktu_selesai TIMESTAMP NOT NULL,
	nama_kegiatan VARCHAR(100) NOT NULL,
	tujuan TEXT NOT NULL,
	jumlah_peserta INT NOT NULL,
	status SMALLINT NOT NULL CHECK(status BETWEEN 1 AND 7),
	username_admin VARCHAR(50) NOT NULL,
	PRIMARY KEY(tgl_mulai,kode_ruangan,username_mhs),
	FOREIGN KEY(kode_ruangan) REFERENCES RUANGAN(no_ruangan) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY(username_mhs) REFERENCES MAHASISWA(username) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY(username_admin) REFERENCES ADMIN_RUANGAN(username) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE PEMINJAMAN_BARANG(
	tgl_mulai DATE,
	username_mhs VARCHAR(50),
	tgl_selesai DATE NOT NULL,
	tgl_req DATE NOT NULL,
	waktu_mulai TIMESTAMP NOT NULL,
	waktu_selesai TIMESTAMP NOT NULL,
	nama_kegiatan VARCHAR(100) NOT NULL,
	tujuan TEXT NOT NULL,
	status SMALLINT NOT NULL CHECK(status BETWEEN 1 AND 3),
	denda NUMERIC(10,2) NOT NULL DEFAULT 0,
	username_admin VARCHAR(50) NOT NULL,
	PRIMARY KEY(tgl_mulai, username_mhs),
	FOREIGN KEY(username_mhs) REFERENCES MAHASISWA(username) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY(username_admin) REFERENCES ADMIN_BARANG(username) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE LIST_PINJAM_BARANG(
	tgl_mulai DATE,
	username_mhs VARCHAR(50),
	kode_barang CHAR(8),
	jumlah INT NOT NULL,
	PRIMARY KEY(tgl_mulai, username_mhs, kode_barang),
	FOREIGN KEY(tgl_mulai,username_mhs) REFERENCES PEMINJAMAN_BARANG(tgl_mulai,username_mhs) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY(kode_barang) REFERENCES BARANG(kode_barang) ON UPDATE CASCADE ON DELETE CASCADE 
);

CREATE TABLE PENGEMBALIAN_BARANG(
	tgl_mulai DATE,
	username_mhs VARCHAR(50),
	kode_barang CHAR(8),
	tgl_kembali DATE NOT NULL,
	PRIMARY KEY(tgl_mulai,username_mhs,kode_barang),
	FOREIGN KEY(tgl_mulai,username_mhs,kode_barang) REFERENCES LIST_PINJAM_BARANG(tgl_mulai,username_mhs,kode_barang) ON UPDATE CASCADE ON DELETE CASCADE
);