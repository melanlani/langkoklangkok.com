-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2018 at 08:30 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.5.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bumbu`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `bank_id` int(11) NOT NULL,
  `nama_bank` varchar(100) NOT NULL,
  `pemilik` varchar(100) NOT NULL,
  `no_rek` varchar(100) NOT NULL,
  `logo` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`bank_id`, `nama_bank`, `pemilik`, `no_rek`, `logo`) VALUES
(1, 'BNI', 'Melani Putri Utami', '12345678', 'bni.png'),
(2, 'BRI', 'Melani Putri Utami', '87873412323', 'bri.png'),
(3, 'Mandiri', 'Melani Putri Utami', '778734098', 'mandiri.png'),
(4, 'BCA', 'Melani Putri Utami', '998980342487', 'bca.png');

-- --------------------------------------------------------

--
-- Table structure for table `dyn_menu`
--

CREATE TABLE `dyn_menu` (
  `page_id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `is_modul` int(11) DEFAULT NULL,
  `dyn_group_id` int(11) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `is_parent` char(1) DEFAULT NULL,
  `show_menu` char(1) DEFAULT NULL,
  `icon` varchar(30) DEFAULT NULL,
  `xuser` varchar(30) DEFAULT NULL,
  `xcreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dyn_menu`
--

INSERT INTO `dyn_menu` (`page_id`, `title`, `url`, `is_modul`, `dyn_group_id`, `position`, `parent_id`, `is_parent`, `show_menu`, `icon`, `xuser`, `xcreate`) VALUES
(2, 'Resep Masakan', '#', NULL, NULL, 3, 0, '1', '1', 'book', 'Admin', '2018-01-06 06:47:43'),
(7, 'Administrator', '#', NULL, NULL, 1, 0, '1', '1', 'laptop', 'Admin', '2017-12-05 14:38:41'),
(27, 'Data Menu', 'administrator/menu', NULL, NULL, 2, 7, '0', '1', '', 'Admin', '2017-11-06 10:16:26'),
(28, 'Data Role', 'administrator/role', NULL, NULL, 3, 7, '0', '1', '', 'Admin', '2017-11-06 11:30:20'),
(29, 'Data User', 'administrator/user', NULL, NULL, 1, 7, '0', '1', '', 'Admin', '2017-11-06 10:16:13'),
(111, 'Kategori', 'kategori_resep/kategoris', NULL, NULL, 1, 2, '0', '1', '', NULL, '2018-01-06 06:22:15'),
(112, 'Resep', 'resep/reseps', NULL, NULL, 2, 2, '0', '1', '', NULL, '2018-01-06 07:06:18'),
(113, 'Produk', '', NULL, NULL, 2, 0, '1', '1', 'building', NULL, '2018-01-09 04:54:36'),
(114, 'Produk', 'produk/produks', NULL, NULL, 1, 113, '0', '1', '', NULL, '2018-01-09 04:54:36'),
(115, 'Kategori Produk', 'kategori/kategoris', NULL, NULL, 5, 113, '0', '1', '', NULL, '2018-01-09 05:05:08'),
(116, 'Produk Resep', 'resep/add_bumbu', NULL, NULL, 6, 113, '0', '1', '', NULL, '2018-01-09 05:10:34'),
(117, 'Transaksi', '', NULL, NULL, 4, 0, '1', '1', 'fa fa-money', NULL, '2018-01-16 05:56:15'),
(118, 'Order', 'order/transaksi', NULL, NULL, 1, 117, '0', '1', '', NULL, '2018-01-15 04:48:45'),
(119, 'Validasi Order', 'order/transaksi_pelapak', NULL, NULL, 2, 117, '0', '1', '', NULL, '2018-01-28 17:17:53'),
(120, 'Laporan ', '', NULL, NULL, 5, 0, '1', '1', 'fa fa-file-photo-o', NULL, '2018-02-04 15:46:12'),
(121, 'Barang Pesanan', 'report/transaksi', NULL, NULL, 2, 120, '0', '1', '', NULL, '2018-02-10 00:48:00'),
(122, 'Barang Terbayar', 'report/konfirmasi', NULL, NULL, 3, 120, '0', '1', '', NULL, '2018-02-10 00:48:00'),
(123, 'Barang Terkirim', 'report/kirim', NULL, NULL, 4, 120, '0', '1', '', NULL, '2018-02-10 00:48:00'),
(124, 'Laporan Penjualan', '', NULL, NULL, 6, 0, '1', '1', 'fa fa-file-photo-o', NULL, '2018-02-04 15:46:12'),
(128, 'Pilihan Laporan', 'report', NULL, NULL, 1, 124, '0', '1', '', NULL, '2018-02-10 01:50:20');

-- --------------------------------------------------------

--
-- Table structure for table `dyn_role_menu`
--

CREATE TABLE `dyn_role_menu` (
  `id` int(11) NOT NULL,
  `role_id` tinyint(1) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `menu` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dyn_role_menu`
--

INSERT INTO `dyn_role_menu` (`id`, `role_id`, `menu_id`, `menu`) VALUES
(429, 3, 117, 'Transaksi'),
(430, 3, 113, 'Produk'),
(431, 3, 114, '<i class="fa fa-angle-double-right fa-fw"></i>Produk'),
(432, 3, 119, '<i class="fa fa-angle-double-right fa-fw"></i>Validasi Order'),
(433, 3, 115, '<i class="fa fa-angle-double-right fa-fw"></i>Kategori Produk'),
(434, 3, 116, '<i class="fa fa-angle-double-right fa-fw"></i>Produk Resep'),
(435, 3, 124, 'Laporan Penjualan'),
(436, 3, 125, '<i class="fa fa-angle-double-right fa-fw"></i>Order Lunas'),
(437, 3, 126, '<i class="fa fa-angle-double-right fa-fw"></i>Order Selesai'),
(438, 3, 128, '<i class="fa fa-angle-double-right fa-fw"></i>Pilih Laporan'),
(480, 6, 2, 'Resep Masakan'),
(481, 6, 111, '<i class="fa fa-angle-double-right fa-fw"></i>Kategori'),
(482, 6, 112, '<i class="fa fa-angle-double-right fa-fw"></i>Resep'),
(483, 6, 117, 'Transaksi'),
(484, 6, 118, '<i class="fa fa-angle-double-right fa-fw"></i>Order'),
(485, 6, 120, 'Laporan '),
(486, 6, 121, '<i class="fa fa-angle-double-right fa-fw"></i>Barang Pesanan'),
(487, 6, 122, '<i class="fa fa-angle-double-right fa-fw"></i>Barang Terbayar'),
(488, 6, 123, '<i class="fa fa-angle-double-right fa-fw"></i>Barang Terkirim'),
(489, 1, 2, 'Resep Masakan'),
(490, 1, 111, '<i class="fa fa-angle-double-right fa-fw"></i>Kategori'),
(491, 1, 112, '<i class="fa fa-angle-double-right fa-fw"></i>Resep'),
(492, 1, 7, 'Administrator'),
(493, 1, 29, '<i class="fa fa-angle-double-right fa-fw"></i>Data User'),
(494, 1, 27, '<i class="fa fa-angle-double-right fa-fw"></i>Data Menu'),
(495, 1, 28, '<i class="fa fa-angle-double-right fa-fw"></i>Data Role'),
(496, 1, 113, 'Produk'),
(497, 1, 115, '<i class="fa fa-angle-double-right fa-fw"></i>Kategori Produk'),
(498, 1, 120, 'Laporan '),
(499, 1, 121, '<i class="fa fa-angle-double-right fa-fw"></i>Barang Pesanan'),
(500, 1, 122, '<i class="fa fa-angle-double-right fa-fw"></i>Barang Terbayar'),
(501, 1, 123, '<i class="fa fa-angle-double-right fa-fw"></i>Barang Terkirim');

-- --------------------------------------------------------

--
-- Table structure for table `dyn_role_user`
--

CREATE TABLE `dyn_role_user` (
  `id` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `roleid` tinyint(1) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dyn_role_user`
--

INSERT INTO `dyn_role_user` (`id`, `userid`, `roleid`, `role`) VALUES
(1, 1, 1, 'admin'),
(6, 3, 2, 'member'),
(10, 4, 2, 'member'),
(13, 9, 6, 'Pengelola lapak'),
(15, 2, 3, 'pelapak'),
(16, 7, 6, 'Pengelola lapak');

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE `komentar` (
  `id_komentar` int(11) NOT NULL,
  `comment` text NOT NULL,
  `produk_id` int(11) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`id_komentar`, `comment`, `produk_id`, `userid`) VALUES
(15, 'coba kasih komentar', 14, 8);

-- --------------------------------------------------------

--
-- Table structure for table `lokasi_kota`
--

CREATE TABLE `lokasi_kota` (
  `kota_id` int(11) NOT NULL,
  `provinsi_id` int(11) NOT NULL,
  `nama_kota` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lokasi_kota`
--

INSERT INTO `lokasi_kota` (`kota_id`, `provinsi_id`, `nama_kota`) VALUES
(17, 1, 'Badung'),
(32, 1, 'Bangli'),
(94, 1, 'Buleleng'),
(114, 1, 'Denpasar'),
(128, 1, 'Gianyar'),
(161, 1, 'Jembrana'),
(170, 1, 'Karangasem'),
(197, 1, 'Klungkung'),
(447, 1, 'Tabanan'),
(27, 2, 'Bangka'),
(28, 2, 'Bangka Barat'),
(29, 2, 'Bangka Selatan'),
(30, 2, 'Bangka Tengah'),
(56, 2, 'Belitung'),
(57, 2, 'Belitung Timur'),
(334, 2, 'Pangkal Pinang'),
(106, 3, 'Cilegon'),
(232, 3, 'Lebak'),
(331, 3, 'Pandeglang'),
(402, 3, 'Serang'),
(403, 3, 'Serang'),
(455, 3, 'Tangerang'),
(456, 3, 'Tangerang'),
(457, 3, 'Tangerang Selatan'),
(62, 4, 'Bengkulu'),
(63, 4, 'Bengkulu Selatan'),
(64, 4, 'Bengkulu Tengah'),
(65, 4, 'Bengkulu Utara'),
(175, 4, 'Kaur'),
(183, 4, 'Kepahiang'),
(233, 4, 'Lebong'),
(294, 4, 'Muko Muko'),
(379, 4, 'Rejang Lebong'),
(397, 4, 'Seluma'),
(39, 5, 'Bantul'),
(135, 5, 'Gunung Kidul'),
(210, 5, 'Kulon Progo'),
(419, 5, 'Sleman'),
(501, 5, 'Yogyakarta'),
(151, 6, 'Jakarta Barat'),
(152, 6, 'Jakarta Pusat'),
(153, 6, 'Jakarta Selatan'),
(154, 6, 'Jakarta Timur'),
(155, 6, 'Jakarta Utara'),
(189, 6, 'Kepulauan Seribu'),
(77, 7, 'Boalemo'),
(88, 7, 'Bone Bolango'),
(129, 7, 'Gorontalo'),
(130, 7, 'Gorontalo'),
(131, 7, 'Gorontalo Utara'),
(361, 7, 'Pohuwato'),
(50, 8, 'Batang Hari'),
(97, 8, 'Bungo'),
(156, 8, 'Jambi'),
(194, 8, 'Kerinci'),
(280, 8, 'Merangin'),
(293, 8, 'Muaro Jambi'),
(393, 8, 'Sarolangun'),
(442, 8, 'Sungaipenuh'),
(460, 8, 'Tanjung Jabung Barat'),
(461, 8, 'Tanjung Jabung Timur'),
(471, 8, 'Tebo'),
(22, 9, 'Bandung'),
(23, 9, 'Bandung'),
(24, 9, 'Bandung Barat'),
(34, 9, 'Banjar'),
(54, 9, 'Bekasi'),
(55, 9, 'Bekasi'),
(78, 9, 'Bogor'),
(79, 9, 'Bogor'),
(103, 9, 'Ciamis'),
(104, 9, 'Cianjur'),
(107, 9, 'Cimahi'),
(108, 9, 'Cirebon'),
(109, 9, 'Cirebon'),
(115, 9, 'Depok'),
(126, 9, 'Garut'),
(149, 9, 'Indramayu'),
(171, 9, 'Karawang'),
(211, 9, 'Kuningan'),
(252, 9, 'Majalengka'),
(332, 9, 'Pangandaran'),
(376, 9, 'Purwakarta'),
(428, 9, 'Subang'),
(430, 9, 'Sukabumi'),
(431, 9, 'Sukabumi'),
(440, 9, 'Sumedang'),
(468, 9, 'Tasikmalaya'),
(469, 9, 'Tasikmalaya'),
(37, 10, 'Banjarnegara'),
(41, 10, 'Banyumas'),
(49, 10, 'Batang'),
(76, 10, 'Blora'),
(91, 10, 'Boyolali'),
(92, 10, 'Brebes'),
(105, 10, 'Cilacap'),
(113, 10, 'Demak'),
(134, 10, 'Grobogan'),
(163, 10, 'Jepara'),
(169, 10, 'Karanganyar'),
(177, 10, 'Kebumen'),
(181, 10, 'Kendal'),
(196, 10, 'Klaten'),
(209, 10, 'Kudus'),
(249, 10, 'Magelang'),
(250, 10, 'Magelang'),
(344, 10, 'Pati'),
(348, 10, 'Pekalongan'),
(349, 10, 'Pekalongan'),
(352, 10, 'Pemalang'),
(375, 10, 'Purbalingga'),
(377, 10, 'Purworejo'),
(380, 10, 'Rembang'),
(386, 10, 'Salatiga'),
(398, 10, 'Semarang'),
(399, 10, 'Semarang'),
(427, 10, 'Sragen'),
(433, 10, 'Sukoharjo'),
(445, 10, 'Surakarta (Solo)'),
(472, 10, 'Tegal'),
(473, 10, 'Tegal'),
(476, 10, 'Temanggung'),
(497, 10, 'Wonogiri'),
(498, 10, 'Wonosobo'),
(31, 11, 'Bangkalan'),
(42, 11, 'Banyuwangi'),
(51, 11, 'Batu'),
(74, 11, 'Blitar'),
(75, 11, 'Blitar'),
(80, 11, 'Bojonegoro'),
(86, 11, 'Bondowoso'),
(133, 11, 'Gresik'),
(160, 11, 'Jember'),
(164, 11, 'Jombang'),
(178, 11, 'Kediri'),
(179, 11, 'Kediri'),
(222, 11, 'Lamongan'),
(243, 11, 'Lumajang'),
(247, 11, 'Madiun'),
(248, 11, 'Madiun'),
(251, 11, 'Magetan'),
(256, 11, 'Malang'),
(255, 11, 'Malang'),
(289, 11, 'Mojokerto'),
(290, 11, 'Mojokerto'),
(305, 11, 'Nganjuk'),
(306, 11, 'Ngawi'),
(317, 11, 'Pacitan'),
(330, 11, 'Pamekasan'),
(342, 11, 'Pasuruan'),
(343, 11, 'Pasuruan'),
(363, 11, 'Ponorogo'),
(369, 11, 'Probolinggo'),
(370, 11, 'Probolinggo'),
(390, 11, 'Sampang'),
(409, 11, 'Sidoarjo'),
(418, 11, 'Situbondo'),
(441, 11, 'Sumenep'),
(444, 11, 'Surabaya'),
(487, 11, 'Trenggalek'),
(489, 11, 'Tuban'),
(492, 11, 'Tulungagung'),
(61, 12, 'Bengkayang'),
(168, 12, 'Kapuas Hulu'),
(176, 12, 'Kayong Utara'),
(195, 12, 'Ketapang'),
(208, 12, 'Kubu Raya'),
(228, 12, 'Landak'),
(279, 12, 'Melawi'),
(364, 12, 'Pontianak'),
(365, 12, 'Pontianak'),
(388, 12, 'Sambas'),
(391, 12, 'Sanggau'),
(395, 12, 'Sekadau'),
(415, 12, 'Singkawang'),
(417, 12, 'Sintang'),
(18, 13, 'Balangan'),
(33, 13, 'Banjar'),
(35, 13, 'Banjarbaru'),
(36, 13, 'Banjarmasin'),
(43, 13, 'Barito Kuala'),
(143, 13, 'Hulu Sungai Selatan'),
(144, 13, 'Hulu Sungai Tengah'),
(145, 13, 'Hulu Sungai Utara'),
(203, 13, 'Kotabaru'),
(446, 13, 'Tabalong'),
(452, 13, 'Tanah Bumbu'),
(454, 13, 'Tanah Laut'),
(466, 13, 'Tapin'),
(44, 14, 'Barito Selatan'),
(45, 14, 'Barito Timur'),
(46, 14, 'Barito Utara'),
(136, 14, 'Gunung Mas'),
(167, 14, 'Kapuas'),
(174, 14, 'Katingan'),
(205, 14, 'Kotawaringin Barat'),
(206, 14, 'Kotawaringin Timur'),
(221, 14, 'Lamandau'),
(296, 14, 'Murung Raya'),
(326, 14, 'Palangka Raya'),
(371, 14, 'Pulang Pisau'),
(405, 14, 'Seruyan'),
(432, 14, 'Sukamara'),
(19, 15, 'Balikpapan'),
(66, 15, 'Berau'),
(89, 15, 'Bontang'),
(214, 15, 'Kutai Barat'),
(215, 15, 'Kutai Kartanegara'),
(216, 15, 'Kutai Timur'),
(341, 15, 'Paser'),
(354, 15, 'Penajam Paser Utara'),
(387, 15, 'Samarinda'),
(96, 16, 'Bulungan (Bulongan)'),
(257, 16, 'Malinau'),
(311, 16, 'Nunukan'),
(450, 16, 'Tana Tidung'),
(467, 16, 'Tarakan'),
(48, 17, 'Batam'),
(71, 17, 'Bintan'),
(172, 17, 'Karimun'),
(184, 17, 'Kepulauan Anambas'),
(237, 17, 'Lingga'),
(302, 17, 'Natuna'),
(462, 17, 'Tanjung Pinang'),
(21, 18, 'Bandar Lampung'),
(223, 18, 'Lampung Barat'),
(224, 18, 'Lampung Selatan'),
(225, 18, 'Lampung Tengah'),
(226, 18, 'Lampung Timur'),
(227, 18, 'Lampung Utara'),
(282, 18, 'Mesuji'),
(283, 18, 'Metro'),
(355, 18, 'Pesawaran'),
(356, 18, 'Pesisir Barat'),
(368, 18, 'Pringsewu'),
(458, 18, 'Tanggamus'),
(490, 18, 'Tulang Bawang'),
(491, 18, 'Tulang Bawang Barat'),
(496, 18, 'Way Kanan'),
(14, 19, 'Ambon'),
(99, 19, 'Buru'),
(100, 19, 'Buru Selatan'),
(185, 19, 'Kepulauan Aru'),
(258, 19, 'Maluku Barat Daya'),
(259, 19, 'Maluku Tengah'),
(260, 19, 'Maluku Tenggara'),
(261, 19, 'Maluku Tenggara Barat'),
(400, 19, 'Seram Bagian Barat'),
(401, 19, 'Seram Bagian Timur'),
(488, 19, 'Tual'),
(138, 20, 'Halmahera Barat'),
(139, 20, 'Halmahera Selatan'),
(140, 20, 'Halmahera Tengah'),
(141, 20, 'Halmahera Timur'),
(142, 20, 'Halmahera Utara'),
(191, 20, 'Kepulauan Sula'),
(372, 20, 'Pulau Morotai'),
(477, 20, 'Ternate'),
(478, 20, 'Tidore Kepulauan'),
(1, 21, 'Aceh Barat'),
(2, 21, 'Aceh Barat Daya'),
(3, 21, 'Aceh Besar'),
(4, 21, 'Aceh Jaya'),
(5, 21, 'Aceh Selatan'),
(6, 21, 'Aceh Singkil'),
(7, 21, 'Aceh Tamiang'),
(8, 21, 'Aceh Tengah'),
(9, 21, 'Aceh Tenggara'),
(10, 21, 'Aceh Timur'),
(11, 21, 'Aceh Utara'),
(20, 21, 'Banda Aceh'),
(59, 21, 'Bener Meriah'),
(72, 21, 'Bireuen'),
(127, 21, 'Gayo Lues'),
(230, 21, 'Langsa'),
(235, 21, 'Lhokseumawe'),
(300, 21, 'Nagan Raya'),
(358, 21, 'Pidie'),
(359, 21, 'Pidie Jaya'),
(384, 21, 'Sabang'),
(414, 21, 'Simeulue'),
(429, 21, 'Subulussalam'),
(68, 22, 'Bima'),
(69, 22, 'Bima'),
(118, 22, 'Dompu'),
(238, 22, 'Lombok Barat'),
(239, 22, 'Lombok Tengah'),
(240, 22, 'Lombok Timur'),
(241, 22, 'Lombok Utara'),
(276, 22, 'Mataram'),
(438, 22, 'Sumbawa'),
(439, 22, 'Sumbawa Barat'),
(13, 23, 'Alor'),
(58, 23, 'Belu'),
(122, 23, 'Ende'),
(125, 23, 'Flores Timur'),
(212, 23, 'Kupang'),
(213, 23, 'Kupang'),
(234, 23, 'Lembata'),
(269, 23, 'Manggarai'),
(270, 23, 'Manggarai Barat'),
(271, 23, 'Manggarai Timur'),
(301, 23, 'Nagekeo'),
(304, 23, 'Ngada'),
(383, 23, 'Rote Ndao'),
(385, 23, 'Sabu Raijua'),
(412, 23, 'Sikka'),
(434, 23, 'Sumba Barat'),
(435, 23, 'Sumba Barat Daya'),
(436, 23, 'Sumba Tengah'),
(437, 23, 'Sumba Timur'),
(479, 23, 'Timor Tengah Selatan'),
(480, 23, 'Timor Tengah Utara'),
(16, 24, 'Asmat'),
(67, 24, 'Biak Numfor'),
(90, 24, 'Boven Digoel'),
(111, 24, 'Deiyai (Deliyai)'),
(117, 24, 'Dogiyai'),
(150, 24, 'Intan Jaya'),
(157, 24, 'Jayapura'),
(158, 24, 'Jayapura'),
(159, 24, 'Jayawijaya'),
(180, 24, 'Keerom'),
(193, 24, 'Kepulauan Yapen (Yapen Waropen)'),
(231, 24, 'Lanny Jaya'),
(263, 24, 'Mamberamo Raya'),
(264, 24, 'Mamberamo Tengah'),
(274, 24, 'Mappi'),
(281, 24, 'Merauke'),
(284, 24, 'Mimika'),
(299, 24, 'Nabire'),
(303, 24, 'Nduga'),
(335, 24, 'Paniai'),
(347, 24, 'Pegunungan Bintang'),
(373, 24, 'Puncak'),
(374, 24, 'Puncak Jaya'),
(392, 24, 'Sarmi'),
(443, 24, 'Supiori'),
(484, 24, 'Tolikara'),
(495, 24, 'Waropen'),
(499, 24, 'Yahukimo'),
(500, 24, 'Yalimo'),
(124, 25, 'Fakfak'),
(165, 25, 'Kaimana'),
(272, 25, 'Manokwari'),
(273, 25, 'Manokwari Selatan'),
(277, 25, 'Maybrat'),
(346, 25, 'Pegunungan Arfak'),
(378, 25, 'Raja Ampat'),
(424, 25, 'Sorong'),
(425, 25, 'Sorong'),
(426, 25, 'Sorong Selatan'),
(449, 25, 'Tambrauw'),
(474, 25, 'Teluk Bintuni'),
(475, 25, 'Teluk Wondama'),
(60, 26, 'Bengkalis'),
(120, 26, 'Dumai'),
(147, 26, 'Indragiri Hilir'),
(148, 26, 'Indragiri Hulu'),
(166, 26, 'Kampar'),
(187, 26, 'Kepulauan Meranti'),
(207, 26, 'Kuantan Singingi'),
(350, 26, 'Pekanbaru'),
(351, 26, 'Pelalawan'),
(381, 26, 'Rokan Hilir'),
(382, 26, 'Rokan Hulu'),
(406, 26, 'Siak'),
(253, 27, 'Majene'),
(262, 27, 'Mamasa'),
(265, 27, 'Mamuju'),
(266, 27, 'Mamuju Utara'),
(362, 27, 'Polewali Mandar'),
(38, 28, 'Bantaeng'),
(47, 28, 'Barru'),
(87, 28, 'Bone'),
(95, 28, 'Bulukumba'),
(123, 28, 'Enrekang'),
(132, 28, 'Gowa'),
(162, 28, 'Jeneponto'),
(244, 28, 'Luwu'),
(245, 28, 'Luwu Timur'),
(246, 28, 'Luwu Utara'),
(254, 28, 'Makassar'),
(275, 28, 'Maros'),
(328, 28, 'Palopo'),
(333, 28, 'Pangkajene Kepulauan'),
(336, 28, 'Parepare'),
(360, 28, 'Pinrang'),
(396, 28, 'Selayar (Kepulauan Selayar)'),
(408, 28, 'Sidenreng Rappang/Rapang'),
(416, 28, 'Sinjai'),
(423, 28, 'Soppeng'),
(448, 28, 'Takalar'),
(451, 28, 'Tana Toraja'),
(486, 28, 'Toraja Utara'),
(493, 28, 'Wajo'),
(25, 29, 'Banggai'),
(26, 29, 'Banggai Kepulauan'),
(98, 29, 'Buol'),
(119, 29, 'Donggala'),
(291, 29, 'Morowali'),
(329, 29, 'Palu'),
(338, 29, 'Parigi Moutong'),
(366, 29, 'Poso'),
(410, 29, 'Sigi'),
(482, 29, 'Tojo Una-Una'),
(483, 29, 'Toli-Toli'),
(53, 30, 'Bau-Bau'),
(85, 30, 'Bombana'),
(101, 30, 'Buton'),
(102, 30, 'Buton Utara'),
(182, 30, 'Kendari'),
(198, 30, 'Kolaka'),
(199, 30, 'Kolaka Utara'),
(200, 30, 'Konawe'),
(201, 30, 'Konawe Selatan'),
(202, 30, 'Konawe Utara'),
(295, 30, 'Muna'),
(494, 30, 'Wakatobi'),
(73, 31, 'Bitung'),
(81, 31, 'Bolaang Mongondow (Bolmong)'),
(82, 31, 'Bolaang Mongondow Selatan'),
(83, 31, 'Bolaang Mongondow Timur'),
(84, 31, 'Bolaang Mongondow Utara'),
(188, 31, 'Kepulauan Sangihe'),
(190, 31, 'Kepulauan Siau Tagulandang Biaro (Sitaro)'),
(192, 31, 'Kepulauan Talaud'),
(204, 31, 'Kotamobagu'),
(267, 31, 'Manado'),
(285, 31, 'Minahasa'),
(286, 31, 'Minahasa Selatan'),
(287, 31, 'Minahasa Tenggara'),
(288, 31, 'Minahasa Utara'),
(485, 31, 'Tomohon'),
(12, 32, 'Agam'),
(93, 32, 'Bukittinggi'),
(116, 32, 'Dharmasraya'),
(186, 32, 'Kepulauan Mentawai'),
(236, 32, 'Lima Puluh Koto/Kota'),
(318, 32, 'Padang'),
(321, 32, 'Padang Panjang'),
(322, 32, 'Padang Pariaman'),
(337, 32, 'Pariaman'),
(339, 32, 'Pasaman'),
(340, 32, 'Pasaman Barat'),
(345, 32, 'Payakumbuh'),
(357, 32, 'Pesisir Selatan'),
(394, 32, 'Sawah Lunto'),
(411, 32, 'Sijunjung (Sawah Lunto Sijunjung)'),
(420, 32, 'Solok'),
(421, 32, 'Solok'),
(422, 32, 'Solok Selatan'),
(453, 32, 'Tanah Datar'),
(40, 33, 'Banyuasin'),
(121, 33, 'Empat Lawang'),
(220, 33, 'Lahat'),
(242, 33, 'Lubuk Linggau'),
(292, 33, 'Muara Enim'),
(297, 33, 'Musi Banyuasin'),
(298, 33, 'Musi Rawas'),
(312, 33, 'Ogan Ilir'),
(313, 33, 'Ogan Komering Ilir'),
(314, 33, 'Ogan Komering Ulu'),
(315, 33, 'Ogan Komering Ulu Selatan'),
(316, 33, 'Ogan Komering Ulu Timur'),
(324, 33, 'Pagar Alam'),
(327, 33, 'Palembang'),
(367, 33, 'Prabumulih'),
(15, 34, 'Asahan'),
(52, 34, 'Batu Bara'),
(70, 34, 'Binjai'),
(110, 34, 'Dairi'),
(112, 34, 'Deli Serdang'),
(137, 34, 'Gunungsitoli'),
(146, 34, 'Humbang Hasundutan'),
(173, 34, 'Karo'),
(217, 34, 'Labuhan Batu'),
(218, 34, 'Labuhan Batu Selatan'),
(219, 34, 'Labuhan Batu Utara'),
(229, 34, 'Langkat'),
(268, 34, 'Mandailing Natal'),
(278, 34, 'Medan'),
(307, 34, 'Nias'),
(308, 34, 'Nias Barat'),
(309, 34, 'Nias Selatan'),
(310, 34, 'Nias Utara'),
(319, 34, 'Padang Lawas'),
(320, 34, 'Padang Lawas Utara'),
(323, 34, 'Padang Sidempuan'),
(325, 34, 'Pakpak Bharat'),
(353, 34, 'Pematang Siantar'),
(389, 34, 'Samosir'),
(404, 34, 'Serdang Bedagai'),
(407, 34, 'Sibolga'),
(413, 34, 'Simalungun'),
(459, 34, 'Tanjung Balai'),
(463, 34, 'Tapanuli Selatan'),
(464, 34, 'Tapanuli Tengah'),
(465, 34, 'Tapanuli Utara'),
(470, 34, 'Tebing Tinggi'),
(481, 34, 'Toba Samosir');

-- --------------------------------------------------------

--
-- Table structure for table `lokasi_provinsi`
--

CREATE TABLE `lokasi_provinsi` (
  `provinsi_id` int(11) NOT NULL,
  `nama_provinsi` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lokasi_provinsi`
--

INSERT INTO `lokasi_provinsi` (`provinsi_id`, `nama_provinsi`) VALUES
(1, 'Bali'),
(2, 'Bangka Belitung'),
(3, 'Banten'),
(4, 'Bengkulu'),
(5, 'DI Yogyakarta'),
(6, 'DKI Jakarta'),
(7, 'Gorontalo'),
(8, 'Jambi'),
(9, 'Jawa Barat'),
(10, 'Jawa Tengah'),
(11, 'Jawa Timur'),
(12, 'Kalimantan Barat'),
(13, 'Kalimantan Selatan'),
(14, 'Kalimantan Tengah'),
(15, 'Kalimantan Timur'),
(16, 'Kalimantan Utara'),
(17, 'Kepulauan Riau'),
(18, 'Lampung'),
(19, 'Maluku'),
(20, 'Maluku Utara'),
(21, 'Nanggroe Aceh Darussalam (NAD)'),
(22, 'Nusa Tenggara Barat (NTB)'),
(23, 'Nusa Tenggara Timur (NTT)'),
(24, 'Papua'),
(25, 'Papua Barat'),
(26, 'Riau'),
(27, 'Sulawesi Barat'),
(28, 'Sulawesi Selatan'),
(29, 'Sulawesi Tengah'),
(30, 'Sulawesi Tenggara'),
(31, 'Sulawesi Utara'),
(32, 'Sumatera Barat'),
(33, 'Sumatera Selatan'),
(34, 'Sumatera Utara');

-- --------------------------------------------------------

--
-- Table structure for table `masakan`
--

CREATE TABLE `masakan` (
  `id_masakan` int(11) NOT NULL,
  `negara` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `masakan`
--

INSERT INTO `masakan` (`id_masakan`, `negara`) VALUES
(1, 'Masakan Indonesia'),
(2, 'Masakan India'),
(4, 'Masakan Turki'),
(5, 'Masakan Thailand'),
(6, 'Masakan Timur-timur');

-- --------------------------------------------------------

--
-- Table structure for table `paket_resep`
--

CREATE TABLE `paket_resep` (
  `id_paket` int(11) NOT NULL,
  `id_resep` int(11) NOT NULL,
  `produk_id` int(11) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paket_resep`
--

INSERT INTO `paket_resep` (`id_paket`, `id_resep`, `produk_id`, `userid`) VALUES
(4, 100, 14, 6),
(6, 100, 19, 6),
(7, 99, 19, 6),
(9, 126, 30, 2);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `pelanggan_id` int(11) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `alamatbaru` text NOT NULL,
  `notelp` varchar(30) NOT NULL,
  `email` varchar(60) NOT NULL,
  `provinsi` varchar(60) NOT NULL,
  `kota` varchar(60) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`pelanggan_id`, `nama_pelanggan`, `alamat`, `alamatbaru`, `notelp`, `email`, `provinsi`, `kota`, `userid`) VALUES
(9, 'Contoh Member', 'Universitas Negeri Padang', '', '6281261892118', 'kompre@kompre.com', '', '318', 7),
(10, 'Melani Putri ', 'Jl. Pegambiran', '', '082142342342', 'melanlani96@gmail.com', '32', '93', 8),
(11, 'Indah Putri', 'Jl Universitas Negeri Padang', '', '08643535123', 'indah@indah.com', '', 'Pilih Kota', 10),
(14, 'User Sebelum Kompre', 'Jl Cendrawasih No 9', '', '085634858848', 'sebelum@kompre.com', '26', '350', 11),
(15, 'Putra Setiawan', 'JL. Padang no 23', '', '08123232332', 'putra@gmail.com', '32', '318', 12);

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `penjualan_id` int(11) NOT NULL,
  `invoice` varchar(40) NOT NULL,
  `pelanggan_id` int(11) NOT NULL,
  `tamu` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `notelp` varchar(20) NOT NULL,
  `kota` varchar(30) NOT NULL,
  `alamat` text NOT NULL,
  `kodepos` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `belanja` bigint(20) NOT NULL,
  `total` bigint(20) NOT NULL,
  `kurir` varchar(20) NOT NULL,
  `pelayanan` varchar(50) NOT NULL,
  `ongkir` bigint(20) NOT NULL,
  `berat` int(11) NOT NULL,
  `status` enum('draft','konfirmasi','lunas','kirim') NOT NULL,
  `promo` bigint(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`penjualan_id`, `invoice`, `pelanggan_id`, `tamu`, `email`, `notelp`, `kota`, `alamat`, `kodepos`, `tanggal`, `belanja`, `total`, `kurir`, `pelayanan`, `ongkir`, `berat`, `status`, `promo`) VALUES
(88, '1518566615', 0, 'Muhammad Ihsan', 'ihsan@ihsan.com', '08123455668', '318,Padang', 'Jl Lubuk Minturun no 1', 25227, '2018-02-14 01:03:35', 134000, 140000, 'jne', '6000,CTC(JNE City Courier)6000', 6000, 1100, 'kirim', 0),
(89, '1518592137', 15, '', '', '', '318', 'JL. Padang no 23', 34556, '2018-02-14 08:08:57', 55000, 75000, 'pos', '20000,Paket Kilat Khusus(Paket Kilat Khusus)20000', 20000, 500, 'kirim', 0),
(90, '1518968687', 10, '', '', '', '93', 'Jl. Pegambiran', 123232, '2018-02-18 16:44:47', 110000, 110000, 'jne', '12000,CTC(JNE City Courier)12000', 0, 1000, 'draft', 0);

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_detail`
--

CREATE TABLE `penjualan_detail` (
  `penjualan_detail_id` int(11) NOT NULL,
  `penjualan_id` int(11) NOT NULL,
  `produk_id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga` bigint(20) NOT NULL,
  `subtotal` bigint(20) NOT NULL,
  `gudang` enum('ok','belum') NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan_detail`
--

INSERT INTO `penjualan_detail` (`penjualan_detail_id`, `penjualan_id`, `produk_id`, `userid`, `qty`, `harga`, `subtotal`, `gudang`, `keterangan`) VALUES
(112, 90, 19, 6, 1, 110000, 110000, 'belum', ''),
(111, 89, 14, 6, 2, 27500, 55000, 'ok', 'Dibungkus dengan rapi'),
(110, 88, 19, 6, 1, 110000, 110000, 'ok', ''),
(109, 88, 27, 2, 2, 12000, 24000, 'ok', '');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_konfirmasi`
--

CREATE TABLE `penjualan_konfirmasi` (
  `konfirmasi_id` int(11) NOT NULL,
  `invoice` varchar(100) NOT NULL,
  `bank_id` int(11) NOT NULL,
  `pemilik` varchar(100) NOT NULL,
  `tanggal` datetime NOT NULL,
  `tanggal_transfer` date NOT NULL,
  `bukti_transfer` varchar(100) NOT NULL,
  `penjualan_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan_konfirmasi`
--

INSERT INTO `penjualan_konfirmasi` (`konfirmasi_id`, `invoice`, `bank_id`, `pemilik`, `tanggal`, `tanggal_transfer`, `bukti_transfer`, `penjualan_id`) VALUES
(10, '1517199779', 1, 'Ayu', '2018-01-29 06:49:10', '2018-01-29', 'bukti-1517199779.jpg', 46),
(9, '1517158574', 1, 'Melani Putri Utami', '2018-01-28 17:56:57', '2018-01-28', 'bukti-1517158574.png', 45),
(8, '1516861755', 1, 'Indah Putri', '2018-01-25 07:39:35', '2018-01-25', 'bukti-1516861755.jpg', 36),
(7, '1516500624', 1, 'Semoga Kompre', '2018-01-21 05:28:05', '2018-01-21', 'bukti-1516500624.jpg', 30),
(11, '1517539517', 1, 'Melani Putri ', '2018-02-02 03:45:49', '2018-02-02', 'bukti-1517539517.jpg', 50),
(12, '1517793922', 1, 'Melani Putri ', '2018-02-05 02:29:51', '2018-02-05', 'bukti-1517793922.jpg', 51),
(13, '1517796599', 1, 'Melani Putri ', '2018-02-05 03:59:10', '2018-02-05', 'bukti-1517796599.jpg', 59),
(14, '1518266068', 1, 'Melani Putri ', '2018-02-10 13:35:25', '2018-02-10', 'bukti-1518266068.png', 62),
(15, '1518267804', 1, 'Melani Putri ', '2018-02-10 14:03:53', '2018-02-10', 'bukti-1518267804.jpg', 66),
(16, '1518357430', 1, 'Melani Putri ', '2018-02-11 14:58:56', '2018-02-11', 'bukti-1518357430.jpg', 68),
(17, '1518360745', 1, 'Melani Putri ', '2018-02-11 15:59:50', '2018-02-11', 'bukti-1518360745.jpg', 70),
(18, '1518361519', 1, 'Melani Putri ', '2018-02-11 16:09:19', '2018-02-11', 'bukti-1518361519.jpg', 71),
(19, '1518370031', 1, 'Melani Putri ', '2018-02-11 18:27:57', '2018-02-11', 'bukti-1518370031.png', 72),
(20, '1518435840', 1, 'Melani Putri ', '2018-02-12 12:45:55', '2018-02-12', 'bukti-1518435840.jpg', 73),
(21, '1518436286', 1, 'Melani Putri ', '2018-02-12 12:51:49', '2018-02-12', 'bukti-1518436286.png', 74),
(22, '1518442860', 1, 'Melani Putri ', '2018-02-12 14:42:07', '2018-02-12', 'bukti-1518442860.png', 75),
(23, '1518452562', 1, 'Ahmad Afifi', '2018-02-12 17:23:41', '2018-02-12', 'bukti-1518452562.jpg', 76),
(24, '1518453469', 1, 'Ahmad Afifi', '2018-02-12 17:38:14', '2018-02-12', 'bukti-1518453469.jpg', 78),
(25, '1518454148', 1, 'Ahmad Afifi', '2018-02-12 17:50:34', '2018-02-12', 'bukti-1518454148.jpg', 79),
(26, '1518477713', 1, 'Muhammad Ihsan', '2018-02-13 00:22:45', '2018-02-13', 'bukti-1518477713.jpg', 80),
(27, '1518479341', 1, 'Irsyad Halim', '2018-02-13 00:50:33', '2018-02-13', 'bukti-1518479341.png', 81),
(28, '1518479726', 1, 'Muhammad Ihsan', '2018-02-13 00:56:12', '2018-02-13', 'bukti-1518479726.jpg', 82),
(29, '1518479970', 1, 'Melani Putri ', '2018-02-13 01:00:23', '2018-02-13', 'bukti-1518479970.jpg', 83),
(30, '1518480850', 1, 'Melani Putri ', '2018-02-13 01:14:41', '2018-02-13', 'bukti-1518480850.jpg', 84),
(31, '1518536366', 1, 'Melani Putri ', '2018-02-13 16:41:03', '2018-02-13', 'bukti-1518536366.jpg', 85),
(32, '1518536593', 1, 'Muhammad Ihsan', '2018-02-13 16:44:17', '2018-02-13', 'bukti-1518536593.jpg', 86),
(33, '1518536846', 1, 'Irsyad Halim', '2018-02-13 16:47:50', '2018-02-13', 'bukti-1518536846.jpg', 87),
(34, '1518566615', 1, 'Muhammad Ihsan', '2018-02-14 01:05:29', '2018-02-14', 'bukti-1518566615.png', 88),
(35, '1518592137', 3, 'Putra Setiawan', '2018-02-14 08:10:37', '2018-02-14', 'bukti-1518592137.jpg', 89);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `produk_id` int(11) NOT NULL,
  `kode_produk` varchar(30) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `merek_id` int(11) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `id_resep` int(11) NOT NULL,
  `deskripsi` longtext NOT NULL,
  `harga` int(11) NOT NULL,
  `berat` double NOT NULL,
  `jumlah_lihat` int(11) NOT NULL,
  `jumlah_beli` int(11) NOT NULL,
  `rating` int(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`produk_id`, `kode_produk`, `nama_produk`, `supplier_id`, `userid`, `merek_id`, `kategori_id`, `id_resep`, `deskripsi`, `harga`, `berat`, `jumlah_lihat`, `jumlah_beli`, `rating`) VALUES
(14, 'A001', 'Bumbu Rendang', 5, 6, 4, 1, 100, 'Bumbu masak siap saji, Terbuat dari bahan-bahan alami berkualitas, Diproses secara higienis dan praktis, Exp. 1 Tahun', 27500, 500, 0, 51, 5),
(15, 'A002', 'Jinten', 5, 6, 4, 3, 0, 'Di Indonesia, Jinten hitam sudah digunakan secara turun temurun sejak zaman nenek moyang sebagai bahan campuran dalm berbagai obat-obatan herbal. Jinten hitam dipercaya  mampu memberikan nutrisi untuk menjaga daya tahan tubuh, menjaga kesehatan otak serta mampu mengobati kanker', 45000, 300, 0, 47, 2),
(19, 'A004', 'Pala', 5, 6, 4, 3, 100, 'Manfaat dan kandungan biji pala. Pala (Myristica fragrans) merupakan tumbuhan berupa pohon yang berasal dari kepulauan Banda dan Maluku. Akibat nilainya yang tinggi sebagai rempah-rempah, buah dan biji pala telah menjadi komoditi perdagangan yang penting sejak masa Romawi.', 110000, 1000, 0, 18, 5),
(25, 'A005', 'Merica', 5, 6, 4, 3, 0, 'deskripsi', 11000, 100, 0, 51, 5),
(27, 'B001', 'Klabet', 3, 2, 4, 1, 0, 'deskripsi', 12000, 100, 0, 71, 5),
(30, 'B002', 'Wijen', 3, 2, 4, 3, 0, 'Wijen (Sesamum indicum L. syn. Sesamum orientalis L.) adalah semak semusim yang termasuk dalam famili Pedaliaceae. Tanaman ini dibudidayakan sebagai sumber minyak nabati, yang dikenal sebagai minyak wijen, yang diperoleh dari ekstraksi bijinya. Afrika tropik merupakan daerah asalnya, kemudian tersebar ke timur hingga ke India dan Tiongkok. Di Indonesia, tanaman wijen tidak terlalu luas ditanam. Di daerah Gunungkidul, Yogyakarta, terdapat area penanaman wijen yang tidak terlalu luas.', 40000, 1000, 0, 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `produk_kategori`
--

CREATE TABLE `produk_kategori` (
  `kategori_id` int(11) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk_kategori`
--

INSERT INTO `produk_kategori` (`kategori_id`, `nama_kategori`) VALUES
(3, 'Rempah- rempah'),
(1, 'Bumbu Masak Siap Saji'),
(2, 'Rempah Bubuk');

-- --------------------------------------------------------

--
-- Table structure for table `produk_merek`
--

CREATE TABLE `produk_merek` (
  `merek_id` int(11) NOT NULL,
  `nama_merek` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk_merek`
--

INSERT INTO `produk_merek` (`merek_id`, `nama_merek`) VALUES
(4, 'Cap Ayam');

-- --------------------------------------------------------

--
-- Table structure for table `produk_photo`
--

CREATE TABLE `produk_photo` (
  `photo_id` int(11) NOT NULL,
  `produk_id` int(11) NOT NULL,
  `photo` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk_photo`
--

INSERT INTO `produk_photo` (`photo_id`, `produk_id`, `photo`) VALUES
(169, 30, 'produk_30-1.jpg'),
(101, 28, 'produk_28-1.jpg'),
(97, 27, 'produk_27-1.jpg'),
(67, 26, 'produk_26-1.jpg'),
(84, 25, 'produk_25-1.jpg'),
(65, 24, 'produk_24-1.jpg'),
(64, 20, 'produk_20-1.jpg'),
(168, 29, 'produk_29-1.jpg'),
(164, 19, 'produk_19-1.jpg'),
(152, 18, 'produk_18-1.jpg'),
(30, 12, 'produk_12-1.png'),
(31, 13, 'produk_13-1.png'),
(129, 14, 'produk_14-1.jpg'),
(160, 15, 'produk_15-1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `produk_stok`
--

CREATE TABLE `produk_stok` (
  `stok_id` int(11) NOT NULL,
  `produk_id` int(11) NOT NULL,
  `toko_id` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `stok_mutasi` int(11) NOT NULL,
  `stok_jual` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk_stok`
--

INSERT INTO `produk_stok` (`stok_id`, `produk_id`, `toko_id`, `stok`, `stok_mutasi`, `stok_jual`) VALUES
(33, 30, 1, 350, 0, 0),
(18, 15, 1, 200, 0, 47),
(19, 16, 1, 2, 0, 0),
(20, 17, 1, 2, 0, 0),
(17, 14, 1, 200, 0, 51),
(22, 19, 1, 300, 0, 18),
(24, 21, 1, 25, 0, 0),
(25, 22, 1, 23, 0, 0),
(26, 23, 1, 24, 0, 0),
(28, 25, 1, 200, 0, 51),
(29, 26, 1, 14, 0, 0),
(30, 27, 1, 100, 0, 71);

-- --------------------------------------------------------

--
-- Table structure for table `publik`
--

CREATE TABLE `publik` (
  `tamu_id` int(11) NOT NULL,
  `nama_tamu` varchar(30) NOT NULL,
  `email` varchar(40) NOT NULL,
  `notelp` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `resep_masakan`
--

CREATE TABLE `resep_masakan` (
  `id_resep` int(11) NOT NULL,
  `jdl_resep` varchar(30) NOT NULL,
  `resep` text NOT NULL,
  `bahan` text NOT NULL,
  `bumbu` text NOT NULL,
  `foto_resep` varchar(100) NOT NULL,
  `id_masakan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `resep_masakan`
--

INSERT INTO `resep_masakan` (`id_resep`, `jdl_resep`, `resep`, `bahan`, `bumbu`, `foto_resep`, `id_masakan`) VALUES
(99, 'Tempe Baladooo', '<p>Tiriskan semua bahan tersebut hingga matang kemudian masukkan tempe dan aduk hingga merata. tambahkan air sedikit saja dan tutup dengan penutu panci setelah itu angkat.</p>', '<p>- Satu buah tomat,</p>\r\n<p>- tiga sendok makan cabe giling,</p>\r\n<p>- garam 3 sendok teh,</p>\r\n<p>- kecap manis,</p>\r\n<p>- minyak goreng,</p>\r\n<p>- bawang merah dan putih 3 siung</p>\r\n<p>- Satu buah tomat</p>', '<p>- Cabe,</p>', 'resep_99-1.jpg', 1),
(100, 'Rendang Padang', '<p>Pertama tama olah daging yang sudah disiapkan, potong-potong daging rendang dengan bentuk dadu atau seukuran yang diinginkan, hanya saja jangan pernah memotong daging terlalu kecil untuk diolah menjadi rendang agar saat dimasak nanti daging tidak hancur.</p>\r\n<p>Tuangkan santan ke wajan berukuran besar, masukkan pula serai, irisan bawang merah, asam dan daun kunyit. Aduk-aduk hingga santan mendidih dan pastikan santan yang anda masak tidak pecah, untuk itu Anda harus terus mengaduk-aduk santan hingga mendidih merata.</p>\r\n<p>Setelah santan mendidih, masukkan perlahan bumbu yang telah dihaluskan kedalamnya dan sesekali aduk-aduk selama kurang lebih 20 – 30 menit.</p>\r\n<p>Setelah anda melihat santan tampak berminyak, berarti ini saatnya kamu memasukan potongan daging rendang yang telah dibersihkan dan masak dengan menggunakan api kecil/sedang hingga santan mengental dan mengering serta bumbu meresap ke pori pori daging.</p>\r\n<p>Terus masak hingga daging empuk dan matang merata, jangan lengah untuk terus diaduk-aduk agar bagian dasar tidak gosong dan daging tidak gagal.</p>', '<p>- 1.5 kg daging</p>\r\n<p>- 2 liter santan dari 2 butir kelapa tua Bumbu dan Rempah Untuk Membuat Rendang Minang Asli:</p>\r\n<p>- 2 batang daun serai, memarkan 4 lembar daun jeruk purut 2 cm asam kandis/gelugur 2 lembar daun kunyit,   simpulkan</p>', '<p>- Cabe</p>\r\n<p>- Bumbu Rendang</p>', 'resep_100-1.jpg', 1),
(125, 'Seblak', '<p>Haluskan atau uleg bawang putih, bawang merah, cabe rawit, dan kencur hingga halus. Tumis bumbu yang telah halus sampai beraroma harum baru masukkan kerupuk. Aduk hingga kerupuk merekah dan tercampur dengan bumbu. Angkat lalu tiriskan dan kemudian masukkan pada wadah tertutup. Anda bisa menambahkan penyedap rasa ke dalamnya. Masukkan penyedap rasa, tutup wadah lalu kocok-kocok.</p>', '<li> Kerupuk bawang 1 ons</li>\r\n<li> Bawang putih 1 siung</li>\r\n<li> Bawang merah 2 siung</li>\r\n<li> Cabe rawit 3 buah</li>\r\n<li> Minyak untuk menggoreng</li>', '<li>Kencur 2 ruas</li>', 'resep_125-1.jpg', 1),
(126, 'Indian Chicken Curry', '<p>-Haluskan semua bumbu halus dan tumis hingga harum.</p>\r\n<p>-Masukkan potongan ayam, lengkuas, serai, cengkeh, kapulaga, daun salam, lada putih bubuk.</p>\r\n<p>-Biarkan 1/2 matang sambil diaduk.</p>\r\n<p>-Masukkan santan dan air panas secukupnya.</p>\r\n<p>-Aduk hingga rata, tutup sebentar.</p>\r\n<p>-Kecilkan api</p>\r\n<p>-Tambahkan gula merah dan garam dan aduk rata kembali.</p>\r\n<p>-Sajikan dgn potongan tomat dan daun ketumbar sbg garnish.</p>\r\n<p>-Sajikan dengan roti canai</p>', '<p>-2 sdm garam</p>\r\n<p>-1/2 sdt gula merah</p>\r\n<p>-1/2 kotak santan kara</p>\r\n<p>-Secukupnya air</p>\r\n<p>-10 Bawang Merah</p>\r\n<p>-4 Bawang Putih</p>\r\n<p>-3 Cabe Merah Besar</p>\r\n<p>-2 lembar Daun Salam</p>', '<p>-2 sdt bumbu kare</p>\r\n<p>-5 butir Kapulaga</p>\r\n<p>-5 butir Cengkeh</p>\r\n<p>-2 batang Serai</p>\r\n<p>-3 cm lengkuas 1/4 sdt</p>\r\n<p>-Lada putih bubuk 2 cm</p>\r\n<p>-jahe 3 cm kunyit (bakar)</p>\r\n<p>-5 btr kemiri (Sangrai)</p>\r\n<p>-1/2 sdt Ketumbar</p>\r\n<p>-1/4 sdt jinten</p>', 'resep_Indian_Chicken_Curry-1.jpg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `role_users`
--

CREATE TABLE `role_users` (
  `id` tinyint(1) NOT NULL,
  `role` varchar(255) NOT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role_users`
--

INSERT INTO `role_users` (`id`, `role`, `deskripsi`, `is_active`) VALUES
(1, 'admin', 'Role to maintain all module', 1),
(2, 'member', 'Role for member', 1),
(3, 'pelapak', 'Role for shopper', 1),
(6, 'Pengelola lapak', 'Role for admin of seller', 1),
(7, 'Tes', 'Role for example', 0);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` int(11) NOT NULL,
  `nama_supplier` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `notelp` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `kota` varchar(60) NOT NULL,
  `userid` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `nama_supplier`, `alamat`, `notelp`, `email`, `kota`, `userid`) VALUES
(3, 'Supplier Bumbu', 'Alamat', '123123', '', '', 2),
(5, 'Toko Barkah', 'Pasar Raya Padang', '0751234567', 'barkah@barkah', '318', 6);

-- --------------------------------------------------------

--
-- Table structure for table `toko`
--

CREATE TABLE `toko` (
  `toko_id` int(11) NOT NULL,
  `nama_toko` varchar(100) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `telepon` varchar(30) NOT NULL,
  `kota` varchar(50) NOT NULL,
  `tipe` enum('pusat','cabang') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `toko`
--

INSERT INTO `toko` (`toko_id`, `nama_toko`, `alamat`, `telepon`, `kota`, `tipe`) VALUES
(1, 'Toko MPU ', 'Pegambiran Padang', '12345', '318', 'pusat'),
(3, 'Toko Barkah', 'Pasar Raya Padang', '55555', '93', 'cabang');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(10) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(60) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `status` enum('aktif','banned') NOT NULL,
  `deleted` int(255) NOT NULL,
  `roleid` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `username`, `password`, `fullname`, `foto`, `status`, `deleted`, `roleid`) VALUES
(1, 'admin', 'admin', '', '', 'aktif', 0, 1),
(2, 'melan', '123', 'Melani Putri Utami', '', 'aktif', 0, 3),
(6, 'tobarkah', '123', 'Toko Barkah', '', 'aktif', 0, 3),
(7, 'kompre', '123', 'Semoga Kompre', '', 'aktif', 0, 2),
(8, 'lani', '123', 'Melani Putri Utami', '', 'aktif', 0, 2),
(9, 'minmin', '123', '', '', 'aktif', 0, 6),
(10, 'indah', '123', 'Indah Putri', '', 'aktif', 0, 2),
(11, 'userkompre', '123', 'User Sebelum Kompre', '', 'aktif', 0, 2),
(12, 'putra', '123', 'Putra Setiawan', '', 'aktif', 0, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`bank_id`);

--
-- Indexes for table `dyn_menu`
--
ALTER TABLE `dyn_menu`
  ADD PRIMARY KEY (`page_id`);

--
-- Indexes for table `dyn_role_menu`
--
ALTER TABLE `dyn_role_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dyn_role_user`
--
ALTER TABLE `dyn_role_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`id_komentar`);

--
-- Indexes for table `lokasi_kota`
--
ALTER TABLE `lokasi_kota`
  ADD PRIMARY KEY (`kota_id`);

--
-- Indexes for table `lokasi_provinsi`
--
ALTER TABLE `lokasi_provinsi`
  ADD PRIMARY KEY (`provinsi_id`);

--
-- Indexes for table `masakan`
--
ALTER TABLE `masakan`
  ADD PRIMARY KEY (`id_masakan`);

--
-- Indexes for table `paket_resep`
--
ALTER TABLE `paket_resep`
  ADD PRIMARY KEY (`id_paket`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`pelanggan_id`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`penjualan_id`);

--
-- Indexes for table `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  ADD PRIMARY KEY (`penjualan_detail_id`);

--
-- Indexes for table `penjualan_konfirmasi`
--
ALTER TABLE `penjualan_konfirmasi`
  ADD PRIMARY KEY (`konfirmasi_id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`produk_id`);

--
-- Indexes for table `produk_kategori`
--
ALTER TABLE `produk_kategori`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indexes for table `produk_merek`
--
ALTER TABLE `produk_merek`
  ADD PRIMARY KEY (`merek_id`);

--
-- Indexes for table `produk_photo`
--
ALTER TABLE `produk_photo`
  ADD PRIMARY KEY (`photo_id`);

--
-- Indexes for table `produk_stok`
--
ALTER TABLE `produk_stok`
  ADD PRIMARY KEY (`stok_id`);

--
-- Indexes for table `publik`
--
ALTER TABLE `publik`
  ADD PRIMARY KEY (`tamu_id`);

--
-- Indexes for table `resep_masakan`
--
ALTER TABLE `resep_masakan`
  ADD PRIMARY KEY (`id_resep`);

--
-- Indexes for table `role_users`
--
ALTER TABLE `role_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `toko`
--
ALTER TABLE `toko`
  ADD PRIMARY KEY (`toko_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `bank_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `dyn_menu`
--
ALTER TABLE `dyn_menu`
  MODIFY `page_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;
--
-- AUTO_INCREMENT for table `dyn_role_menu`
--
ALTER TABLE `dyn_role_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=502;
--
-- AUTO_INCREMENT for table `dyn_role_user`
--
ALTER TABLE `dyn_role_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `komentar`
--
ALTER TABLE `komentar`
  MODIFY `id_komentar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `lokasi_kota`
--
ALTER TABLE `lokasi_kota`
  MODIFY `kota_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=502;
--
-- AUTO_INCREMENT for table `lokasi_provinsi`
--
ALTER TABLE `lokasi_provinsi`
  MODIFY `provinsi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `masakan`
--
ALTER TABLE `masakan`
  MODIFY `id_masakan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `paket_resep`
--
ALTER TABLE `paket_resep`
  MODIFY `id_paket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `pelanggan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `penjualan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;
--
-- AUTO_INCREMENT for table `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  MODIFY `penjualan_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;
--
-- AUTO_INCREMENT for table `penjualan_konfirmasi`
--
ALTER TABLE `penjualan_konfirmasi`
  MODIFY `konfirmasi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `produk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `produk_kategori`
--
ALTER TABLE `produk_kategori`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `produk_merek`
--
ALTER TABLE `produk_merek`
  MODIFY `merek_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `produk_photo`
--
ALTER TABLE `produk_photo`
  MODIFY `photo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;
--
-- AUTO_INCREMENT for table `produk_stok`
--
ALTER TABLE `produk_stok`
  MODIFY `stok_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `publik`
--
ALTER TABLE `publik`
  MODIFY `tamu_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `resep_masakan`
--
ALTER TABLE `resep_masakan`
  MODIFY `id_resep` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;
--
-- AUTO_INCREMENT for table `role_users`
--
ALTER TABLE `role_users`
  MODIFY `id` tinyint(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `toko`
--
ALTER TABLE `toko`
  MODIFY `toko_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
