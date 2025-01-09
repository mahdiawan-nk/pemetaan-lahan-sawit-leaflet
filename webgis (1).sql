-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 06 Jan 2025 pada 14.03
-- Versi server: 8.0.30
-- Versi PHP: 8.2.0

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
(19, '1997', 'H', '23,50', '18.924', '503.600');

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
(8, 1, '{\"type\": \"polygon\", \"coordinates\": [[[101.05715651181696, 0.4374958242839], [101.05691982875597, 0.4416772719588522], [101.05085134506226, 0.4411975650492771], [101.05002150999997, 0.4403795057567806], [101.05071841552255, 0.43974777309095714], [101.05277180671692, 0.43994232834031105], [101.05196058920842, 0.4385941244612894], [101.05202777798952, 0.4385187441331339], [101.05204416549792, 0.4384695830497236], [101.05201958423532, 0.4382598290882669], [101.05202777798952, 0.43813364896737994], [101.05206710800888, 0.43808776528693727], [101.05295530957568, 0.4372782433350011], [101.05308804839046, 0.4371930307750347]]]}'),
(9, 2, '{\"type\": \"Polygon\", \"coordinates\": [[[101.0569195991821, 0.4416750085780592], [101.05715824658768, 0.4374946520678833], [101.05764334725676, 0.4375063408996738], [101.05918631805504, 0.43761154038676864], [101.06056564043746, 0.43765245129780794], [101.06186898319686, 0.43771673987248505], [101.0631765306166, 0.4379063670942714], [101.06296985102443, 0.4420838664099591], [101.0569195991821, 0.4416750085780592]]]}'),
(10, 3, '{\"type\": \"Polygon\", \"coordinates\": [[[101.06296744854536, 0.44208644246972995], [101.063178467581, 0.4379159675226134], [101.06708604657598, 0.4382822923445957], [101.0667889329806, 0.44234260068806464], [101.06296744854536, 0.44208644246972995]]]}'),
(11, 4, '{\"type\": \"Polygon\", \"coordinates\": [[[101.05666524982148, 0.445962508687046], [101.05691896102076, 0.44167882120775914], [101.06678894960868, 0.4423425214597642], [101.06648192156814, 0.4464894313491498], [101.0590657480812, 0.4462162121959068], [101.05666524982148, 0.445962508687046]]]}'),
(12, 5, '{\"type\": \"Polygon\", \"coordinates\": [[[101.0773322614362, 0.4430976856750135], [101.06678913076264, 0.4423419583390285], [101.0670813119313, 0.43827916029052005], [101.06735240750668, 0.4383140416857571], [101.0677078125047, 0.4383543815424673], [101.07096324661194, 0.4385986962190742], [101.07199760764996, 0.4386865167527531], [101.07237817444724, 0.4386865167527531], [101.0728953549662, 0.4386865167527531], [101.07400778099031, 0.4386279697306463], [101.07489577018288, 0.43858893838206825], [101.07724747782748, 0.4385596648703398], [101.077325542812, 0.4386572432413658], [101.07709134786, 0.440725904404232], [101.07701328287555, 0.44147725760922185], [101.07714989659884, 0.44204321192162865], [101.0773322614362, 0.4430976856750135]]]}'),
(13, 6, '{\"type\": \"Polygon\", \"coordinates\": [[[101.06647428596808, 0.44648762679683784], [101.0667890656572, 0.4423416282095758], [101.07733268869616, 0.44309732983009553], [101.07750096496584, 0.44700479159457984], [101.06647428596808, 0.44648762679683784]]]}'),
(14, 8, '{\"type\": \"Polygon\", \"coordinates\": [[[101.0463672835608, 0.4618657928271403], [101.04794363418635, 0.460608743817815], [101.05077707455558, 0.4652977350183391], [101.04896127826424, 0.4663086944162984], [101.0463672835608, 0.4618657928271403]]]}'),
(15, 9, '{\"type\": \"Polygon\", \"coordinates\": [[[101.04795028613358, 0.4606287020880444], [101.0502148848176, 0.4588748941754659], [101.05299859890306, 0.4641537595825582], [101.05079037777068, 0.4653110422268867], [101.04795028613358, 0.4606287020880444]]]}'),
(16, 10, '{\"type\": \"Polygon\", \"coordinates\": [[[101.04233368279203, 0.46491034492603944], [101.04435875416328, 0.46334181213818226], [101.04694494935568, 0.46751949148573146], [101.04483932766853, 0.4687434239742174], [101.0443955760192, 0.4680496395950797], [101.04414282781556, 0.4681494052926638], [101.04233368279203, 0.46491034492603944]]]}'),
(17, 11, '{\"type\": \"Polygon\", \"coordinates\": [[[101.0443587487092, 0.4633472779829617], [101.04636847161686, 0.4618627612738493], [101.04896527174832, 0.46631085582046694], [101.0469512824099, 0.4675170261852628], [101.0443587487092, 0.4633472779829617]]]}'),
(18, 12, '{\"type\": \"Polygon\", \"coordinates\": [[[101.04003169510486, 0.4609898760500357], [101.04202402472498, 0.4595157456521406], [101.044352058237, 0.4633543221894456], [101.04233053697452, 0.4649306191771103], [101.04003169510486, 0.4609898760500357]]]}'),
(19, 13, '{\"type\": \"Polygon\", \"coordinates\": [[[101.0420313219227, 0.4595230436471951], [101.04406743900648, 0.4579978292029949], [101.04635168505496, 0.4618728949271542], [101.0443520575236, 0.46335432250801034], [101.0420313219227, 0.4595230436471951]]]}'),
(20, 14, '{\"type\": \"Polygon\", \"coordinates\": [[[101.04407473773216, 0.45799053231138487], [101.04555621360385, 0.4568447968456866], [101.04792803457951, 0.46062499342100693], [101.04635168586948, 0.4618801933864347], [101.04407473773216, 0.45799053231138487]]]}'),
(21, 15, '{\"type\": \"Polygon\", \"coordinates\": [[[101.04556350831903, 0.4568593932795153], [101.04807398959872, 0.4549619965684286], [101.05020497952182, 0.4588881476706632], [101.04793532929574, 0.4606176968234763], [101.04556350831903, 0.4568593932795153]]]}'),
(22, 16, '{\"type\": \"Polygon\", \"coordinates\": [[[101.0400282566739, 0.46100040808875065], [101.03948431427654, 0.45972951364157666], [101.03929398741884, 0.4595319169619927], [101.03926991301734, 0.4592069229831566], [101.03934213622364, 0.4587856344705159], [101.03959491744185, 0.4586532295041792], [101.039763438254, 0.4585930454276905], [101.03988381026318, 0.4584967509047999], [101.04230328764538, 0.45830416185415856], [101.04265236647136, 0.45830416185415856], [101.04289311048984, 0.45819583051059], [101.04649223355892, 0.4549940367405725], [101.0466005683665, 0.4548977421694502], [101.04676908918054, 0.45466904255732743], [101.04711816800648, 0.4544644165821268], [101.04738298642638, 0.4542838642458946], [101.0476839164494, 0.454332011536195], [101.0480691068766, 0.4549819999193545], [101.0400282566739, 0.46100040808875065]]]}'),
(23, 17, '{\"type\": \"Polygon\", \"coordinates\": [[[101.04964695348563, 0.441247821360264], [101.05692418815948, 0.4416913265547038], [101.05667010694827, 0.44596250957431494], [101.05625808336232, 0.44591444161207505], [101.0561276092282, 0.4458251725379227], [101.0560589386306, 0.4456947023514459], [101.0558803950762, 0.4455916995706417], [101.05564004798543, 0.4454200282661418], [101.05539283383342, 0.44522088954836647], [101.05513875262228, 0.4452964249253313], [101.05482973493385, 0.4452689575151112], [101.0544245784069, 0.445028617678247], [101.054136161898, 0.444925614888163], [101.05370538580075, 0.4447155828897564], [101.05337576693285, 0.44482545253494266], [101.05310795160348, 0.44490785476800454], [101.05301181276496, 0.4448460530935278], [101.0528126680332, 0.4446812486250593], [101.05246244798582, 0.444585112683626], [101.0522495691336, 0.4445713789777699], [101.0520023549816, 0.4445988463894537], [101.05183754554764, 0.4447430503009002], [101.0517482737704, 0.44472244974198816], [101.05141865490252, 0.4440632318349884], [101.05121264310952, 0.4437748239816841], [101.0510203654369, 0.44356195151181055], [101.05083495482336, 0.4433765464520576], [101.05042979829864, 0.442943934628218], [101.04955768170844, 0.442387719388563], [101.04964695348563, 0.441247821360264]]]}'),
(24, 18, '{\"type\": \"Polygon\", \"coordinates\": [[[101.05651001013716, 0.4523497435273498], [101.05572416042428, 0.4511025162332487], [101.0568632820279, 0.4498552887253453], [101.05701468426572, 0.449639006477625], [101.05700026500404, 0.4493578395449589], [101.05667583163677, 0.4459622072748459], [101.05906221929877, 0.4462073272789553], [101.0605906609415, 0.447915957669153], [101.05896849410315, 0.4484278257676806], [101.05651001013716, 0.4523497435273498]]]}'),
(25, 19, '{\"type\": \"Polygon\", \"coordinates\": [[[101.04958589889486, 0.4577284535034494], [101.05571835496414, 0.4510906924393652], [101.05650985591188, 0.45232778992856026], [101.0571550384836, 0.45348507319990006], [101.0571550384836, 0.454023809051435], [101.05721489989838, 0.45486184251772954], [101.05695550042913, 0.4550214679287734], [101.05641674768282, 0.45519439545320495], [101.0561107893322, 0.4555202973157151], [101.05120880840173, 0.460728079231302], [101.04958589889486, 0.4577284535034494]]]}'),
(26, 1, '{\"type\": \"polygon\", \"coordinates\": [[[101.05715651181696, 0.4374958242839], [101.05691982875597, 0.4416772719588522], [101.05085134506226, 0.4411975650492771], [101.05002150999997, 0.4403795057567806], [101.05071841552255, 0.43974777309095714], [101.05277180671692, 0.43994232834031105], [101.05196058920842, 0.4385941244612894], [101.05202777798952, 0.4385187441331339], [101.05204416549792, 0.4384695830497236], [101.05201958423532, 0.4382598290882669], [101.05202777798952, 0.43813364896737994], [101.05206710800888, 0.43808776528693727], [101.05295530957568, 0.4372782433350011], [101.05308804839046, 0.4371930307750347]]]}'),
(27, 7, '{\"type\": \"Polygon\", \"coordinates\": [[[101.05002325599752, 0.4404021864484235], [101.05091270150854, 0.44130611335390313], [101.04964206506742, 0.4412383480865571], [101.04965900688636, 0.4403404582411241], [101.05002325599752, 0.4404021864484235]]]}');

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
  MODIFY `id_lahan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `pemetaan_blok`
--
ALTER TABLE `pemetaan_blok`
  MODIFY `id_pemetaan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

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
