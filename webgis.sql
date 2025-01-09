-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 29 Des 2024 pada 06.57
-- Versi server: 8.0.30
-- Versi PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webgis`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `lahan`
--

CREATE TABLE `lahan` (
  `id_lahan` int NOT NULL,
  `tahun_tanam` varchar(255) NOT NULL,
  `blok` varchar(255) NOT NULL,
  `luas_blok` varchar(255) NOT NULL,
  `jumlah_tandan` varchar(255) NOT NULL,
  `produksi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `lahan`
--

INSERT INTO `lahan` (`id_lahan`, `tahun_tanam`, `blok`, `luas_blok`, `jumlah_tandan`, `produksi`) VALUES
(1, '1993', 'A', '28,75', '27.604', '680.200'),
(2, '1993', 'B1', '29,89', '28.172', '695.600'),
(3, '1993', 'B2', '18,95', '15.497', '385.510'),
(4, '1993', 'E', '48,23', '45.940', '1.120.600'),
(5, '1994', 'C', '51,64', '40.835', '1.002.2950'),
(6, '1994', 'D', '51,83', '45.683', '1.043.400'),
(7, '1995', '1', '11,59', '9.768', '231.070'),
(8, '1995', 'J.1', '12,32', '12.439', '238.420'),
(9, '1995', 'J.2', '18,20', '17.204', '401.490'),
(10, '1995', 'K.1', '14,70', '17.093', '332.300'),
(11, '1995', 'K.2', '14,12', '415.694', '340.110'),
(12, '1995', '1.1', '13,36', '16.207', '334.670'),
(13, '1995', '1.2', '13,14', '18.108', '352.760'),
(14, '1995', 'M.1', '9,73', '11.526', '250.630'),
(15, '1995', 'M.2', '16,12', '17.335', '390.130'),
(16, '1995', 'N', '11,50', '11.366', '250.820'),
(17, '1997', 'F', '25,79', '23.398', '512.200'),
(18, '1997', 'G', '13,26', '11.819', '267.500'),
(19, '1997', 'H', '23,50', '18.924', '503.600'),
(20, 'kjgk', 'kjgki', 'iyo', 'iut', 'yjfuj'),
(21, 'teww', 'sdfa', 'sdfasd', 'sdfa', 'sdfasd');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemetaan_blok`
--

CREATE TABLE `pemetaan_blok` (
  `id_pemetaan` int NOT NULL,
  `lahan_id` int NOT NULL,
  `coordinates` json NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `pemetaan_blok`
--

INSERT INTO `pemetaan_blok` (`id_pemetaan`, `lahan_id`, `coordinates`) VALUES
(8, 1, '{\"type\": \"polygon\", \"coordinates\": [[0.4374958242839, 101.05715651181696], [0.4416772719588522, 101.05691982875597], [0.4413087421999222, 101.05090294418744], [0.4408649809845918, 101.05046510696413], [0.4403795057567806, 101.05002150999997], [0.43974777309095714, 101.05071841552255], [0.4385941244612894, 101.05196058920842], [0.4385187441331339, 101.05202777798952], [0.4384695830497236, 101.05204416549792], [0.4382598290882669, 101.05201958423532], [0.43813364896737994, 101.05202777798952], [0.43808776528693727, 101.05206710800888], [0.4372782433350011, 101.05295530957568], [0.4371930307750347, 101.05308804839046]]}'),
(9, 2, '{\"type\": \"Polygon\", \"coordinates\": [[[101.0569195991821, 0.4416750085780592], [101.05715824658768, 0.4374946520678833], [101.05764334725676, 0.4375063408996738], [101.05918631805504, 0.43761154038676864], [101.06056564043746, 0.43765245129780794], [101.06186898319686, 0.43771673987248505], [101.0631765306166, 0.4379063670942714], [101.06296985102443, 0.4420838664099591], [101.0569195991821, 0.4416750085780592]]]}'),
(10, 3, '{\"type\": \"Polygon\", \"coordinates\": [[[101.06296744854536, 0.44208644246972995], [101.063178467581, 0.4379159675226134], [101.06708604657598, 0.4382822923445957], [101.0667889329806, 0.44234260068806464], [101.06296744854536, 0.44208644246972995]]]}');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sejarah`
--

CREATE TABLE `sejarah` (
  `id` int NOT NULL,
  `title` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `content` text COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `sejarah`
--

INSERT INTO `sejarah` (`id`, `title`, `content`) VALUES
(1, 'Sejarah Singkat Berdirinya Perusahaan', '<p style=\"text-align: justify;\">PKS-PT. Mitra Bumi merupakan suatu perseroan terbatas (PT) bergerak dalam bidang penerimaan Tandan Buah Segar (TBS) Sawit yang kemudian diolah menjadi CPO <em id=\"isPasted\">(crude palm oil)</em> dan PK <em>(palm kernel)</em> dengan nama PKS-PT. Mitra Bumi didirikan pada tanggal 08 September 2008 dan selanjutnya tanggal 11 Februari 2010 dimulai pembangunan PMKS (pabrik minyak kelapa sawit) dan baru beroperasi pada tanggal 09 April 2012. Dalam perkembangannya perusahaan ini dikenal dengan nama &ldquo;PKS-PT. Mitra Bumi&rdquo;. Pabrik tersebut didirikan diatas lahan seluas + 14 Ha yang berasal dari lahan perkebunan milik PT. Kumu Kampar Sehati yang merupakan anak perusahaan dari Septa Group (juga induk dari PT. Mitra Bumi) dibawah pimpinan Bapak<strong>&nbsp;Nazwar.</strong> Secara geografis, PKS ini dalam menjalankan aktivitas perusahaannya beralokasi diwilayah Desa Bukit Sembilan Kecamatan Bangkinang Kabupaten Kampar. Perusahaan ini dalam eksistensinya bertujuan melakukan dan menunjang kebijakan serta program pemerintah dibidang ekonomi dan pembangunan nasional umumnya dan khususnnya subsector perkebunan yang menyangkut penyediaan<em>&nbsp;Crude Palm Oil dan Palm Kernel.</em> Serta berusahan mengakat marwah Melayu Riau dengan menjadi pelopor pembangunan Pabrik kelapa Sawit milik pribumi di bumi lancing kuning. Selain itu, Septa Group selaku induk dari PT. Mitra Bumi untuk jangka panjang juga memiliki keinginan yang kuat untuk dapat mendirikan industri hilir yang akan menghasilkan turunan dari CPO baik berupa Minyak Goreng, Odol, Sabun dan lain-lain. Sehingga kita tidak perlu mengekspor CPO ke luar negeri serta dapat memenuhi kebutuhan didalam negeri sendiri. Saat ini, PT, Mitra Bumi sudah mempunyai pabrik kelapa sawit di pasir pangaraiyan dan sedang membangun PKS dikabupaten Kuansing.</p>');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `nama_pengguna` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_aktif` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `nama_pengguna`, `email`, `password`, `is_aktif`) VALUES
(1, 'Administrator', 'admin@test.com', '$2y$12$9JrVD1Hoq0KamuycFokDpemij5uJb1ikXX8PegkjuW9hXdYxKNBwe', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `visi_misi`
--

CREATE TABLE `visi_misi` (
  `id` int NOT NULL,
  `title` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `content` text COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `visi_misi`
--

INSERT INTO `visi_misi` (`id`, `title`, `content`) VALUES
(1, 'Visi dan Misi Perusahaan', '<p style=\"text-align: justify;\">Sebagai pelopor pembangunan pabrik kelapa sawit milik pribumi di bumi lancing kuning PT. Mitra Bumi ini mempunyai visi perusahaan yaitu menjadikan perusahaan pengelolahan kelapa sawit yang berwawasan lingkungan, menciptakan lapangan kerja bagi masyarakat Kampar khususnya riau pada umumnya,serta selanjutnya secara bertahap dapt diakui secara nasional maupun internasional. Adapun misi perusahaan yang telah dirumuskan leh Perussahaan tersebut antara lain :</p><p style=\"text-align: left;\"><strong>Visi</strong></p><p style=\"text-align: justify;\">Menjadi Perusahaan pengelolahan Kelapa Sawit yang berwawasan lingkungan, menciptakan lapangan kerja bagimasyarakat Kampar khususnya da Riau pada umumnya, serta selanjutnya secara bertahap dapat diakui secara nasional maupun internasional.</p><p style=\"text-align: left;\"><strong>Misi</strong></p><ol style=\"list-style-type: lower-alpha;\"><li style=\"text-align: left;\">Menciptakan lapangan kerja yang seluas-luasnya bagi masyarakat tempatan baik itu menjadi karyawan tetap ataupun buruh bongkar TBS</li><li style=\"text-align: left;\">Memberikan pelayanan yang baik terhadap para rekanan baik itu dari pihak pemasok/supplier TBS ataupun juga para pembeli produk olahan berupa CPO dan PK</li></ol><p><strong>Moto</strong></p><p>motto dari perusahaan ini adalah &ldquo;From Zero to Hero&rdquo; yang berarti dari mulai nol hingga menjadi pahlawan, dengan kata lain pemilik perusahaan memulai usaha dibidang ini dari nol sampai nanti akhirnya diharapkan bias berkembang pesat sehingga bias menjadi pahlawan devisa daerah Kampar Khususnya dan Riau pada umumnya.</p><p><br></p><p>Logo dari perusahaan adalah berupa gambar bumi yang mana menjadi nama perusahaan yakni PKS-PT. Mitra Bumi yang berarti bahwa didalam setiap aktivitas ataupun kegiatan perusahaan akan selalu memperhatikan kelestarian lingkungan hidup agar bumi Indonesia ini tetap terjada dengan baik.</p><p style=\"text-align: center;\"><br></p>');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `lahan`
--
ALTER TABLE `lahan`
  ADD PRIMARY KEY (`id_lahan`);

--
-- Indeks untuk tabel `pemetaan_blok`
--
ALTER TABLE `pemetaan_blok`
  ADD PRIMARY KEY (`id_pemetaan`);

--
-- Indeks untuk tabel `sejarah`
--
ALTER TABLE `sejarah`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `visi_misi`
--
ALTER TABLE `visi_misi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `lahan`
--
ALTER TABLE `lahan`
  MODIFY `id_lahan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `pemetaan_blok`
--
ALTER TABLE `pemetaan_blok`
  MODIFY `id_pemetaan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `sejarah`
--
ALTER TABLE `sejarah`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `visi_misi`
--
ALTER TABLE `visi_misi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
