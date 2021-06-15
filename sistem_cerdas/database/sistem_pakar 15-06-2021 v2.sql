-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2021 at 01:50 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.3.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistem_pakar`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_user`
--

CREATE TABLE `access_user` (
  `id_access_menu` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `access_user`
--

INSERT INTO `access_user` (`id_access_menu`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(7, 2, 3),
(8, 2, 2),
(9, 3, 2),
(10, 4, 2),
(18, 1, 8),
(24, 12, 2),
(29, 1, 15),
(30, 1, 3),
(35, 1, 18),
(36, 1, 19),
(37, 1, 20),
(39, 1, 17);

-- --------------------------------------------------------

--
-- Table structure for table `submenu_user`
--

CREATE TABLE `submenu_user` (
  `id_submenu` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `submenu_user`
--

INSERT INTO `submenu_user` (`id_submenu`, `menu_id`, `title`, `url`, `is_active`) VALUES
(2, 1, 'Dashboard', 'admin', 1),
(3, 2, 'My Profile', 'user', 1),
(4, 2, 'Edit Profile', 'user/edit', 1),
(5, 3, 'Management Menu', 'menu', 1),
(6, 3, 'Sub Menu Management', 'menu/submenu', 1),
(7, 1, 'Role', 'admin/role', 1),
(8, 2, 'Edit Password', 'user/edit_password', 1),
(26, 18, 'Obat Tanaman', 'obat', 1),
(27, 20, 'Organisme Pengganggu Tanaman', 'opt', 1),
(28, 19, 'Gejala Penyakit', 'gejala', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_gejala`
--

CREATE TABLE `tb_gejala` (
  `kode_gejala` varchar(5) NOT NULL,
  `gejala` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_gejala`
--

INSERT INTO `tb_gejala` (`kode_gejala`, `gejala`) VALUES
('GJ01', 'Ngengat di pertanaman'),
('GJ02', 'Larva di dalam batang'),
('GJ03', 'Anakan kerdil'),
('GJ04', 'Anakan mati / sundep'),
('GJ05', 'Tanaman menguning'),
('GJ06', 'Tanaman cepat mengering'),
('GJ07', 'Gejala terlihat mengumpul / hopperburn'),
('GJ08', 'Tanaman kerdil'),
('GJ09', 'Anakan berkurang'),
('GJ10', 'Daun berubah warna kuning'),
('GJ11', 'Daun berubah warna oranye'),
('GJ12', 'Daerah sekitar lubang bekas hisapan berubah warna menjadi coklat'),
('GJ13', 'Daun menjadi kering'),
('GJ14', 'Daun menggulung secara membujur'),
('GJ15', 'Beras berubah warna'),
('GJ16', 'Beras mengapur'),
('GJ17', 'Beras hampa'),
('GJ18', 'Daun menggulung seperti daun bawang'),
('GJ19', 'Anakan tidak menghasilkan malai'),
('GJ20', 'Adanya warna putih di pertanaman'),
('GJ21', 'Adanya kehadiran ngengat di sawah, berwarna coklat'),
('GJ22', 'Adanya ngengat kecil dan larva'),
('GJ23', 'Daun terpotong seperti digunting'),
('GJ24', 'Larva makan bagian atas tanaman malam hari dan cuaca berawan'),
('GJ25', 'Daun yang dimakan larva dari tepi daun sampai hanya meninggalkan tulang dan batang'),
('GJ26', 'Ngengat berupa kupu - kupu yang berukuran besar pada sayapnya terdapat bercak seperti bentuk mata'),
('GJ27', 'Larva makan daun mulai dari pinggiran dan ujung daun'),
('GJ28', 'Larva muda memarut jaringan epidermis tanaman meninggalkan lapisan bawah daun yang berwarna putih'),
('GJ29', 'Larva bergerak seperti ulat jengkal'),
('GJ30', 'Tanaman padi dipupuk dengan takaran tinggi'),
('GJ31', 'Pertanaman padi muda mati sehingga terlihat adanya spot - spot kosong di sawah'),
('GJ32', 'Bercak kuning di sepanjang tepi daun yang baru muncul'),
('GJ33', 'Daun yang terserang mengalami perubahan bentuk'),
('GJ34', 'Telur diletakkan di atas permukaan daun berwara keputih - putihan berbentuk lonjong seperti pisang'),
('GJ35', 'Bekas potongan daun dan batang yang diserang terlihat mengambang'),
('GJ36', 'Adanya telur berwarna merah muda dan keong emas dengan berbagai ukuran dan warna'),
('GJ37', 'Kerusakan tanaman dimulai dari tengah petak, kemudian meluas ke arah pinggir, sehingga pada keadaan serangan berat hanya menyisakan 1 - 2 baris padi di pinggir petakan'),
('GJ38', 'Biji banyak yang hilang'),
('GJ39', 'Bercak kuning sampai putih berawal dari terbentuknya garis lebam berair pada bagian tepi daun'),
('GJ40', 'Bercak sempit berwarna hijau gelap dan lama kelamaan membesar berwarna kuning dan tembus cahaya di antara pembuluh daun'),
('GJ41', 'Bercak berbentuk belah ketupat - lebar ditengah dan meruncing kedua ujungnya berukuran 1-1,5 x 0,3-0,5 cm'),
('GJ42', 'Pada stadia anakan sampai stadia matang susu pada pelepah daun, di antara permukaan air dan daun terdapat bercak spot keabuan yang berbentuk oval memanjang atau elips'),
('GJ43', 'Bercak berwarna kehitam - hitaman bentuknya tidak teratur pada sisi luar pelepah daun dan secara bertahap membesar'),
('GJ44', 'Noda berbentuk bulat memanjang hingga tidak teratur dengan panjang 0,5 - 1,5cm, warna abu - abu di tengahnya dan coklat atau abu - abu di pinggirnya'),
('GJ45', 'Bercak membesar sering bersambung dan bisa menutupi pelepah daun'),
('GJ46', 'Bercak berwarna hijau kuning terang yang berkembang menuju ujung daun'),
('GJ47', 'Bercak lama - lama menjadi nekrotik dan menyatu'),
('GJ48', 'Daun mengalami perubahan warna dari hijau menjadi sedikit kuning sampai kuning oranye dan kuning coklat dimulai dari ujung daun, terutama daun muda'),
('GJ49', 'Anakan berlebihan, sehingga tampak seperti rumput'),
('GJ50', 'Daun tanaman menjadi sempit, pendek, kaku, berwarna hijau pucat sampai hijau, kadang - kadang terdapat bercak karat'),
('GJ51', 'Daun bergerigi'),
('GJ52', 'Pinggir daun tidak rata atau pecah - pecah'),
('GJ53', 'Bagian daun yang rusak menunjukkan gejala khlorotik, menjadi kuning atau kuning kecoklatan dan terpecah - pecah'),
('GJ54', 'Infeksi pada daun bendera menyebabkan daun melintir, berubah bentuk dan memendek pada fase bunting'),
('GJ55', 'Tanaman kerdil dan menunging'),
('GJ56', 'Daun lebih kecil dibandingkan dan tanaman sehat'),
('GJ57', 'Pertumbuhan akar tanaman lambat'),
('GJ58', 'Daun berwarna hijau gelap dan tegak lama kelamaan daun berwarna keungu - unguan anakan sedikit'),
('GJ59', 'Waktu pembungaan terlambat atau tidak rata'),
('GJ60', 'Umur tanaman yang panen lebih panjang'),
('GJ61', 'Gabah yang terbentuk berkurang'),
('GJ62', 'Sebagian akar membusuk'),
('GJ63', 'Layu terkulai'),
('GJ64', 'Pinggiran ujung daun tua seperti terbakar'),
('GJ65', 'Anakan berkurang'),
('GJ66', 'Ukuran dan berat gabah berkurang'),
('GJ67', 'Klorosis pada daun - daun  muda diikuti dengan menguningnya daun tua dan seluruh tanaman'),
('GJ68', 'Daun mengapung di atas air'),
('GJ69', 'Setengah dari tajuk bagian bawah daunnya berwarna hijau pucat 2 - 4 hari setelah digenangi'),
('GJ70', 'Khlorotik dan mulai mengering setelah 3 - 7 hari digenangi'),
('GJ71', 'Adanya bercak - bercak kecil berwarna coklat pada daun - daun bawah'),
('GJ72', 'Pertumbuhan dan pembentukan anakan terhambat'),
('GJ73', 'Sistem perakarannya jarang atau sedikit, kasar, dan berwarna coklat gelap atau membusuk');

-- --------------------------------------------------------

--
-- Table structure for table `tb_obat`
--

CREATE TABLE `tb_obat` (
  `kode_obat` varchar(6) NOT NULL,
  `nama_bahan_aktif` varchar(60) NOT NULL,
  `nama_dagang` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_obat`
--

INSERT INTO `tb_obat` (`kode_obat`, `nama_bahan_aktif`, `nama_dagang`) VALUES
('OB001', 'Amitraz', 'MITAC'),
('OB002', 'Beauveria Bassiana 6.20 x 1010 cfu/ml', 'BIVE AS'),
('OB003', 'Bensultap', 'BANCOL'),
('OB004', 'Bisultap', 'PANZER, SPONTAN'),
('OB005', 'BPMC', 'BASSA, KILTOP, BAYCARB'),
('OB006', 'Buprofezin', 'APPLAUD'),
('OB007', 'Dihemipo', 'DIPHO'),
('OB008', 'Etonfeproks', '-'),
('OB009', 'Fipronil', 'REGENT'),
('OB010', 'Imidakloprid', 'CONFIDOR'),
('OB011', 'Karbofuran', 'CURATER, DHARMAFUR, FURADAN'),
('OB012', 'Karbosulfan', 'MARSHAL'),
('OB013', 'Metolkarb', 'REXAL'),
('OB014', 'MIPC', 'MIPCIN, MILKARB, DHARMACIN'),
('OB015', 'Propoksur', 'POKSINDO'),
('OB016', 'Tiametoksam', 'ACTARA'),
('OB017', 'Etofenproks', 'TREBON'),
('OB018', 'Heksakonazol', 'ANVIL'),
('OB019', 'Karbendazim', 'BAVISTIN'),
('OB020', 'Tebukanazol', 'FOLICUR'),
('OB021', 'Belerang', 'KUMULUS'),
('OB022', 'Flutalonil', 'MONKAT'),
('OB023', 'Difenokonazol', 'SCORE'),
('OB024', 'Propikonazol', 'TILT'),
('OB025', 'Validasimin A', 'VALIDACIN'),
('OB026', 'Benomil', 'BENLATE'),
('OB027', 'Brodifakum', 'KLERAT, PHYTON'),
('OB028', 'Bromediolon', 'PETROLONE'),
('OB029', 'Flokumafen', 'STORM'),
('OB030', 'Kumatetralil', 'RACUMIN'),
('OB031', 'Fosdifen, Kasugamisin', 'KASUMIRON'),
('OB032', 'Mankozeb', 'DITHANE'),
('OB033', 'Metil Tiofanat', 'TOPSIN'),
('OB034', 'Niclos Amida', 'BAYLUSIDE'),
('OB035', 'Seng Fosfida', 'MESOPHIDE, MURATA'),
('OB036', '-', 'PETROBAN'),
('OB000', 'Belum Terdefinisi', 'Belum Terdefinisi');

-- --------------------------------------------------------

--
-- Table structure for table `tb_opt`
--

CREATE TABLE `tb_opt` (
  `kode_opt` varchar(4) NOT NULL,
  `nama_opt` varchar(35) NOT NULL,
  `nama_inggris` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_opt`
--

INSERT INTO `tb_opt` (`kode_opt`, `nama_opt`, `nama_inggris`) VALUES
('HM01', 'Penggerek Batang Padi', 'Stem Borer'),
('HM02', 'Wereng Coklat', 'Brown Planthopper'),
('HM03', 'Wereng Hijau', 'Green Leafhopper'),
('HM04', 'Kepinding Tanah', 'Black Bug'),
('HM05', 'Walang Sangit', 'Rice Bug'),
('HM06', 'Tikus', 'Rat'),
('HM07', 'Ganjur', 'Gall Midge'),
('HM08', 'Hama Putih Palsu', 'Leaffolder'),
('HM09', 'Hama Putih', 'Caseworm'),
('HM10', 'Ulat Tentara', 'Armyworm'),
('HM11', 'Ulat Tanduk Hijau', 'Green Horned Caterpillar'),
('HM12', 'Ulat Jengkal Palsu Hijau', 'Green Semilooper'),
('HM13', 'Orong-orong', 'Mole Cricket'),
('HM14', 'Lalat Bibit', 'Rice Whorl Maggot'),
('HM15', 'Keong Mas', 'Golden Apple Snail'),
('HM16', 'Burung', 'Bird'),
('HM17', 'Ulat Bulu Kuduk Merinding', ''),
('HR01', 'Kahat Nitrogen', 'Nitrogen Deficiency'),
('HR02', 'Kahat Fosfor', 'Phosporus Deficiency'),
('HR03', 'Kahat Kalium', 'Potassium Deficiency'),
('HR04', 'Kahat Belerang', 'Sulfur Deficiency'),
('HR05', 'Kahat Seng', 'Zinc Deficiency'),
('HR06', 'Keracunan Besi', 'Iron Toxicity'),
('PN01', 'Hawar Daun Bakteri', 'Bacterial Leaf Blight'),
('PN02', 'Bakteri daun Bergaris', 'Bacterial Leaf Streak'),
('PN03', 'Blast', 'Blast'),
('PN04', 'Hawar Pelepah Daun', 'Sheath Blight'),
('PN05', 'Busuk Batang', 'Stem Rot'),
('PN06', 'Busuk Pelepah Daun Bendera', 'Sheath Rot'),
('PN07', 'Hawar Daun Jingga', 'Red Stripe'),
('PN08', 'Tungro', 'Tungro'),
('PN09', 'Kerdil Rumput', 'Grassy Stunt'),
('PN10', 'Kerdil Hampa', 'Ragged Stunt'),
('HM00', 'Belum Terdefinisi', 'Belum Terdefinisi'),
('PN11', 'asdas', 'asdasd');

-- --------------------------------------------------------

--
-- Table structure for table `token_user`
--

CREATE TABLE `token_user` (
  `id_token` int(15) NOT NULL,
  `email` varchar(64) NOT NULL,
  `token` varchar(128) NOT NULL,
  `date_created` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `token_user`
--

INSERT INTO `token_user` (`id_token`, `email`, `token`, `date_created`) VALUES
(2, 'alfianrochmatul77@gmail.com', 'sNVNlun4tEIZrMEYOukhNCSmiMrsTJqwdguQ8ePab3o=', 1604159648);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` varchar(40) NOT NULL,
  `nama` varchar(48) NOT NULL,
  `email` varchar(48) NOT NULL,
  `image` varchar(48) NOT NULL,
  `password` varchar(64) NOT NULL,
  `about` varchar(64) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(11) NOT NULL,
  `date_created` int(15) NOT NULL,
  `change_pass` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `email`, `image`, `password`, `about`, `role_id`, `is_active`, `date_created`, `change_pass`) VALUES
('ID-U11302', 'Alfian Rochmatul Irman', 'alfianrochmatul77@gmail.com', 'IMG-20190926-WA00371.jpg', 'c86d1f757d79b8c7aee8bef4c5a86d796dc03dbbeef1404a7523dbe0324e2b2a', 'Wani Tok! yoto', 1, 1, 1583394165, 1586009053),
('ID-U11333', 'adminadmin', 'adminadmin123@admin.com', 'koala.jpg', '$2y$10$9Xwqw2u3OrNbKYz9V1sxM.nFbXtWWqrC9OqHAZY3Mc73YBRcc0q2G', 'nothing', 1, 1, 1583394165, 1583394222);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id_menu` int(11) NOT NULL,
  `menu` varchar(32) NOT NULL,
  `icon` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id_menu`, `menu`, `icon`) VALUES
(1, 'admin', 'fas fa-tachometer-alt'),
(2, 'user', 'fas fa-users'),
(3, 'menu', 'fas fa-bars'),
(18, 'obat', 'fas fa-fw fa-first-aid'),
(19, 'gejala', 'fas fa-fw fa-head-side-mask'),
(20, 'opt', 'fas fa-fw fa-leaf');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id_role` int(11) NOT NULL,
  `role` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id_role`, `role`) VALUES
(1, 'admin'),
(2, 'operator');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_user`
--
ALTER TABLE `access_user`
  ADD PRIMARY KEY (`id_access_menu`);

--
-- Indexes for table `submenu_user`
--
ALTER TABLE `submenu_user`
  ADD PRIMARY KEY (`id_submenu`);

--
-- Indexes for table `tb_gejala`
--
ALTER TABLE `tb_gejala`
  ADD PRIMARY KEY (`kode_gejala`);

--
-- Indexes for table `token_user`
--
ALTER TABLE `token_user`
  ADD PRIMARY KEY (`id_token`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id_role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_user`
--
ALTER TABLE `access_user`
  MODIFY `id_access_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `submenu_user`
--
ALTER TABLE `submenu_user`
  MODIFY `id_submenu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `token_user`
--
ALTER TABLE `token_user`
  MODIFY `id_token` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
