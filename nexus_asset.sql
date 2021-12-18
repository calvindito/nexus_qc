-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2021 at 12:02 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nexus_asset`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nik` int(11) NOT NULL,
  `username` varchar(500) NOT NULL,
  `password` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nik`, `username`, `password`) VALUES
(1, 1223456, 'user', '$2y$11$EsOM4IhVQSv6inkG4.Pdgecy0BZVWrYR3Qht8no/IlD3t11H8/kJ6');

-- --------------------------------------------------------

--
-- Table structure for table `asset`
--

CREATE TABLE `asset` (
  `id` int(11) NOT NULL,
  `idsistercompany` int(11) NOT NULL,
  `idgroup` int(11) NOT NULL,
  `idsubgroup` int(11) NOT NULL,
  `idcategory` int(11) NOT NULL,
  `idinitialcondition` int(11) NOT NULL,
  `idcondition` int(11) NOT NULL,
  `idtemplate` int(11) NOT NULL,
  `noasset` varchar(500) NOT NULL,
  `name` varchar(500) NOT NULL,
  `noPo` varchar(1000) NOT NULL,
  `purchase_from` int(11) NOT NULL,
  `posting_date` date NOT NULL,
  `status_posting_date` varchar(100) NOT NULL DEFAULT 'no',
  `totalmonth` int(11) NOT NULL,
  `purchase_price` int(11) NOT NULL,
  `ppn` varchar(10000) NOT NULL,
  `total_purchase_price` int(11) NOT NULL,
  `economical` int(11) NOT NULL,
  `cost_per_month` int(11) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `image` longtext DEFAULT NULL,
  `status` varchar(500) NOT NULL DEFAULT 'Active',
  `status_transaction` varchar(1000) NOT NULL DEFAULT 'newasset'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `asset`
--

INSERT INTO `asset` (`id`, `idsistercompany`, `idgroup`, `idsubgroup`, `idcategory`, `idinitialcondition`, `idcondition`, `idtemplate`, `noasset`, `name`, `noPo`, `purchase_from`, `posting_date`, `status_posting_date`, `totalmonth`, `purchase_price`, `ppn`, `total_purchase_price`, `economical`, `cost_per_month`, `start_date`, `end_date`, `image`, `status`, `status_transaction`) VALUES
(58, 1, 1, 1, 1, 1, 2, 1, '001-001-0056', 'Vas', '1020302', 5, '2021-03-26', 'yes', 10, 1000000, '0', 1000000, 10, 100000, '0000-00-00', '0000-00-00', '001-001-0056_2021_09_27_12_00_25_', 'Active', 'placed'),
(59, 2, 1, 1, 1, 1, 2, 1, '888', 'Assetbaru', '00012312', 5, '2021-08-24', 'yes', 2, 1000000, '0', 1000000, 10, 100000, '0000-00-00', '0000-00-00', '888_2021_09_27_12_04_21_', 'Active', 'placed'),
(60, 1, 1, 7, 23, 1, 2, 2, '10000', 'Handphone', 'PO-001', 5, '2021-10-01', 'no', 0, 150000, '0.1', 165000, 10, 16500, '0000-00-00', '0000-00-00', '10000_2021_10_01_08_28_33_beverage(1).png,10000_2021_10_01_08_28_33_egg.png,10000_2021_10_01_08_28_33_sacred-cow.png', 'Active', 'placed'),
(61, 1, 1, 7, 23, 1, 2, 2, '112312312312', 'Handphone', 'PO-001', 5, '2021-08-01', 'no', 2, 150000, '0.1', 165000, 10, 16500, '0000-00-00', '0000-00-00', '112312312312_2021_10_01_08_28_43_beverage(1).png,112312312312_2021_10_01_08_28_43_egg.png,112312312312_2021_10_01_08_28_43_sacred-cow.png', 'Active', 'placed'),
(62, 2, 1, 1, 1, 1, 2, 1, 'qqww', 'Handphone 2', '112', 5, '2021-10-04', 'no', 0, 1000000, '0.1', 1100000, 50, 22000, '0000-00-00', '0000-00-00', 'qqww_2021_10_04_07_54_39_', 'Active', 'placed');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `id` int(11) NOT NULL,
  `idprovince` int(11) NOT NULL,
  `name` varchar(700) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `idprovince`, `name`, `status`) VALUES
(5, 1, 'Surabaya', 'Active'),
(6, 1, 'Malang', 'Active'),
(7, 1, 'Blitar', 'Active'),
(8, 1, 'Batu', 'Active'),
(10, 3, 'Semarang', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `conditions`
--

CREATE TABLE `conditions` (
  `id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `description` varchar(500) NOT NULL,
  `status` varchar(600) NOT NULL,
  `modified_by` datetime DEFAULT NULL,
  `date_created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `conditions`
--

INSERT INTO `conditions` (`id`, `name`, `description`, `status`, `modified_by`, `date_created`) VALUES
(2, 'Broken', 'Broken', 'Active', NULL, NULL),
(3, 'Damage', 'Damage', 'Active', NULL, NULL),
(4, 'Some Part Missing', 'Some Part Missing', 'Active', NULL, NULL),
(5, 'Need To Repair', 'Need To Repair', 'InActive', NULL, NULL),
(6, 'mycond', 'mydescrip', 'Active', NULL, NULL),
(10, 'myconds', 'test', 'Active', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` int(11) NOT NULL,
  `name` varchar(700) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `name`, `status`) VALUES
(1, 'Indonesia', 'Active'),
(2, 'Malaysia', 'Active'),
(3, 'Jepang', 'InActive'),
(4, 'zimbabwe', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `custom_template_answer`
--

CREATE TABLE `custom_template_answer` (
  `id` int(11) NOT NULL,
  `id_custom_to_template` int(11) NOT NULL,
  `idasset` int(11) NOT NULL,
  `answer` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `custom_template_answer`
--

INSERT INTO `custom_template_answer` (`id`, `id_custom_to_template`, `idasset`, `answer`) VALUES
(1, 0, 8, ''),
(2, 3, 9, 'xx918923'),
(3, 1, 9, 'Wonorejo'),
(4, 3, 10, ''),
(5, 1, 10, ''),
(6, 3, 11, ''),
(7, 1, 11, ''),
(8, 0, 38, ''),
(9, 0, 39, ''),
(10, 3, 40, 'xx12321'),
(11, 1, 40, 'Mulyo'),
(12, 3, 41, 'qw312312312'),
(13, 1, 41, 'eqwe12'),
(14, 3, 42, 'qw312312312'),
(15, 1, 42, 'eqwe12'),
(16, 3, 46, 'qw312312312'),
(17, 1, 46, 'eqwe12'),
(18, 3, 47, 'Certf - 001'),
(19, 1, 47, 'Baruk'),
(20, 3, 48, '12314'),
(21, 1, 48, '123124'),
(22, 3, 49, '-'),
(23, 1, 49, '-'),
(24, 3, 52, '-'),
(25, 1, 52, '-'),
(26, 3, 53, 'mycertif'),
(27, 1, 53, 'myadd'),
(28, 3, 55, 'Mycertif'),
(29, 1, 55, 'Myadd'),
(30, 3, 58, 'Cert'),
(31, 1, 58, 'Wonogiriii'),
(32, 3, 59, 'Cerasd'),
(33, 1, 59, 'Addr'),
(34, 6, 60, ''),
(35, 6, 61, ''),
(36, 3, 62, '002'),
(37, 1, 62, 'Wonogiri');

-- --------------------------------------------------------

--
-- Table structure for table `custom_to_template`
--

CREATE TABLE `custom_to_template` (
  `id` int(11) NOT NULL,
  `idtemplate` int(11) NOT NULL,
  `idcustom` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `custom_to_template`
--

INSERT INTO `custom_to_template` (`id`, `idtemplate`, `idcustom`) VALUES
(1, 1, 3),
(2, 2, 6),
(3, 1, 1),
(4, 6, 1),
(5, 6, 6);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `iddivisi` int(11) NOT NULL,
  `department` varchar(700) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `iddivisi`, `department`, `description`, `status`) VALUES
(1, 1, 'Research And Development', 'ini deskripsi research', 'Active'),
(2, 1, 'Ads Management', 'Handle ads untuk penjualan', 'Active'),
(3, 2, 'M1', 'M1', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `divisi`
--

CREATE TABLE `divisi` (
  `id` int(11) NOT NULL,
  `id_branch` int(11) NOT NULL,
  `divisi` varchar(700) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `divisi`
--

INSERT INTO `divisi` (`id`, `id_branch`, `divisi`, `description`, `status`) VALUES
(1, 10, 'Production', 'ini deskripsi production', 'Active'),
(2, 12, 'Marketing', 'ini deskripsi marketing', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE `document` (
  `id` int(11) NOT NULL,
  `code` varchar(200) NOT NULL,
  `idsistercompany` int(11) NOT NULL,
  `idbranch` int(11) NOT NULL,
  `iddivisi` int(11) NOT NULL,
  `iddepartement` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `tanggaldokumen` date NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `document`
--

INSERT INTO `document` (`id`, `code`, `idsistercompany`, `idbranch`, `iddivisi`, `iddepartement`, `name`, `tanggaldokumen`, `status`) VALUES
(1, 'Doc - XXi', 1, 2, 1, 2, 'Dokumen Penting Perusahaans', '2021-09-08', 'Active'),
(2, 'Doc -XX2', 1, 2, 1, 1, 'Document Karyawan', '2021-09-05', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `document_displacement_new`
--

CREATE TABLE `document_displacement_new` (
  `id` int(11) NOT NULL,
  `notransaction` varchar(1000) NOT NULL,
  `iddivisi` int(11) NOT NULL,
  `iddepartment` int(11) NOT NULL,
  `iddocument` int(11) NOT NULL,
  `tanggalpindah` date NOT NULL,
  `id_branch_to` int(11) NOT NULL,
  `id_room_to` int(11) NOT NULL,
  `id_rack_to` int(11) NOT NULL,
  `id_subrack_to` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `document_displacement_new`
--

INSERT INTO `document_displacement_new` (`id`, `notransaction`, `iddivisi`, `iddepartment`, `iddocument`, `tanggalpindah`, `id_branch_to`, `id_room_to`, `id_rack_to`, `id_subrack_to`) VALUES
(1, 'Trans-001', 1, 2, 1, '2021-09-08', 2, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `document_displacement_to_other_rack`
--

CREATE TABLE `document_displacement_to_other_rack` (
  `id` int(11) NOT NULL,
  `notransaction` varchar(1000) NOT NULL,
  `iddivisi` int(11) NOT NULL,
  `iddepartment` int(11) NOT NULL,
  `iddocument` int(11) NOT NULL,
  `tanggalpindah` date NOT NULL,
  `id_branch_from` int(11) NOT NULL,
  `id_room_from` int(11) NOT NULL,
  `id_rack_from` int(11) NOT NULL,
  `id_subrack_from` int(11) NOT NULL,
  `id_branch_to` int(11) NOT NULL,
  `id_room_to` int(11) NOT NULL,
  `id_rack_to` int(11) NOT NULL,
  `id_subrack_to` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `document_displacement_to_other_rack`
--

INSERT INTO `document_displacement_to_other_rack` (`id`, `notransaction`, `iddivisi`, `iddepartment`, `iddocument`, `tanggalpindah`, `id_branch_from`, `id_room_from`, `id_rack_from`, `id_subrack_from`, `id_branch_to`, `id_room_to`, `id_rack_to`, `id_subrack_to`) VALUES
(1, 'Trans-Other-001', 1, 2, 1, '2021-09-02', 1, 1, 1, 3, 2, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `document_dispose`
--

CREATE TABLE `document_dispose` (
  `id` int(11) NOT NULL,
  `idsistercompany` int(11) NOT NULL,
  `idbranch` int(11) NOT NULL,
  `iddocument` int(11) NOT NULL,
  `nik_admin` int(11) NOT NULL,
  `reason` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `notransaction` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `document_dispose`
--

INSERT INTO `document_dispose` (`id`, `idsistercompany`, `idbranch`, `iddocument`, `nik_admin`, `reason`, `created_at`, `notransaction`) VALUES
(1, 9, 2, 2, 1223456, 2, '2021-09-10 00:00:00', 'Dispose-001');

-- --------------------------------------------------------

--
-- Table structure for table `document_lend`
--

CREATE TABLE `document_lend` (
  `id` int(11) NOT NULL,
  `notransaction` varchar(200) NOT NULL,
  `idsistercompany` int(11) NOT NULL,
  `idbranch` int(11) NOT NULL,
  `ibuilding` int(11) NOT NULL,
  `idfloor` int(11) NOT NULL,
  `idrooms` int(11) NOT NULL,
  `iddocument` int(11) NOT NULL,
  `nik` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `remark` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `document_lend`
--

INSERT INTO `document_lend` (`id`, `notransaction`, `idsistercompany`, `idbranch`, `ibuilding`, `idfloor`, `idrooms`, `iddocument`, `nik`, `start_date`, `end_date`, `remark`) VALUES
(1, 'trx-001', 1, 2, 2, 1, 1, 2, 1223456, '2021-09-09', '2021-09-12', 'remark'),
(2, 'trx-001', 2, 1, 1, 2, 3, 1, 3231321, '2021-09-02', '2021-09-11', 'remarks');

-- --------------------------------------------------------

--
-- Table structure for table `document_lend_extend_log`
--

CREATE TABLE `document_lend_extend_log` (
  `id` int(11) NOT NULL,
  `iddocumentlend` int(11) NOT NULL,
  `extendfrom` date NOT NULL,
  `extendto` date NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `document_lend_extend_log`
--

INSERT INTO `document_lend_extend_log` (`id`, `iddocumentlend`, `extendfrom`, `extendto`, `created_at`) VALUES
(1, 1, '2021-09-10', '2021-09-24', '2021-09-10'),
(2, 1, '2021-09-25', '2021-09-30', '2021-09-10');

-- --------------------------------------------------------

--
-- Table structure for table `document_return_log`
--

CREATE TABLE `document_return_log` (
  `id` int(11) NOT NULL,
  `iddocumentlend` int(11) NOT NULL,
  `nik_return` int(11) NOT NULL,
  `nik_admin` int(11) NOT NULL,
  `returnat` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `document_return_log`
--

INSERT INTO `document_return_log` (`id`, `iddocumentlend`, `nik_return`, `nik_admin`, `returnat`) VALUES
(1, 1, 3231321, 5293813, '2021-09-11 00:00:00'),
(14, 2, 3231321, 5293813, '2021-09-13 12:55:37');

-- --------------------------------------------------------

--
-- Table structure for table `driving_force`
--

CREATE TABLE `driving_force` (
  `id` int(11) NOT NULL,
  `drivingforce` varchar(500) NOT NULL,
  `description` varchar(500) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'Active',
  `modified_by` datetime DEFAULT NULL,
  `date_created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `driving_force`
--

INSERT INTO `driving_force` (`id`, `drivingforce`, `description`, `status`, `modified_by`, `date_created`) VALUES
(1, 'Hidrolik', 'Driving Force Description', 'InActive', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `folder`
--

CREATE TABLE `folder` (
  `id` int(11) NOT NULL,
  `barcode` varchar(10000) NOT NULL,
  `code` varchar(10000) NOT NULL,
  `idsistercompany` int(11) NOT NULL,
  `idbranch` int(11) NOT NULL,
  `idbuilding` int(11) NOT NULL,
  `idrack` int(11) NOT NULL,
  `idfloor` int(11) NOT NULL,
  `idroom` int(11) NOT NULL,
  `folder` varchar(10000) NOT NULL,
  `description` varchar(10000) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `folder`
--

INSERT INTO `folder` (`id`, `barcode`, `code`, `idsistercompany`, `idbranch`, `idbuilding`, `idrack`, `idfloor`, `idroom`, `folder`, `description`) VALUES
(1, '-', 'Folder001', 1, 1, 1, 1, 1, 1, 'folder Penyimpanan 1', 'khusus untuk file tidak terlalu penting');

-- --------------------------------------------------------

--
-- Table structure for table `folder_custom`
--

CREATE TABLE `folder_custom` (
  `id` int(11) NOT NULL,
  `name` varchar(700) NOT NULL,
  `type` varchar(1000) NOT NULL,
  `status_field` varchar(100) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `folder_custom`
--

INSERT INTO `folder_custom` (`id`, `name`, `type`, `status_field`) VALUES
(1, 'No. Certificate', 'text', 'Active'),
(2, 'No. BKPB', 'text', 'Active'),
(3, 'Address', 'text', 'Active'),
(4, 'Start Valid Date', 'text', 'Active'),
(5, 'Expired Date', 'text', 'Active'),
(6, 'Model', 'text', 'Active'),
(7, 'No. Machine', 'text', 'Active'),
(8, 'No.Frame', 'text', 'Active'),
(9, 'Colour', 'text', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `fuel`
--

CREATE TABLE `fuel` (
  `id` int(11) NOT NULL,
  `fuel` varchar(500) NOT NULL,
  `description` varchar(500) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'Active',
  `modified_by` datetime DEFAULT NULL,
  `date_created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fuel`
--

INSERT INTO `fuel` (`id`, `fuel`, `description`, `status`, `modified_by`, `date_created`) VALUES
(1, 'Bensin', 'Bensin', 'Active', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `holding_company`
--

CREATE TABLE `holding_company` (
  `id` int(11) NOT NULL,
  `code` varchar(1000) NOT NULL,
  `name` varchar(10000) NOT NULL,
  `description` varchar(10000) NOT NULL,
  `address` varchar(10000) NOT NULL,
  `idcity` int(11) NOT NULL,
  `idprovince` int(11) NOT NULL,
  `idcountry` int(11) NOT NULL,
  `notelp` varchar(10000) NOT NULL,
  `modified` datetime NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `holding_company`
--

INSERT INTO `holding_company` (`id`, `code`, `name`, `description`, `address`, `idcity`, `idprovince`, `idcountry`, `notelp`, `modified`, `created`) VALUES
(1, 'KKS01', 'Pt.KKS', 'Pt.Kasih Karunia Sejati', 'Pandanlandung No.51', 6, 1, 1, '0341-563259', '2021-08-19 00:00:00', '2021-08-19 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `initial_condition`
--

CREATE TABLE `initial_condition` (
  `id` int(11) NOT NULL,
  `initial_condition` varchar(400) NOT NULL,
  `description` varchar(400) NOT NULL,
  `status` varchar(700) NOT NULL DEFAULT 'Active',
  `modified_by` datetime DEFAULT NULL,
  `date_created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `initial_condition`
--

INSERT INTO `initial_condition` (`id`, `initial_condition`, `description`, `status`, `modified_by`, `date_created`) VALUES
(1, 'New', 'no Description', 'InActive', NULL, NULL),
(2, 'Second', 'Bekas', 'Active', NULL, NULL),
(3, 'New', 'Baru', 'Active', NULL, NULL),
(5, 'New', 'ok', 'InActive', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `nik` varchar(50) NOT NULL,
  `nama` varchar(200) DEFAULT NULL,
  `idsistercompany` int(11) NOT NULL,
  `idbranch` int(11) NOT NULL,
  `iddivisi` int(11) NOT NULL,
  `iddepartment` int(11) NOT NULL,
  `idrank` int(11) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `status` varchar(1000) DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`nik`, `nama`, `idsistercompany`, `idbranch`, `iddivisi`, `iddepartment`, `idrank`, `email`, `description`, `status`) VALUES
('1223456', 'cacas', 1, 1, 1, 1, 4, 'caca@gmail.com', 'mydescriptions', 'InActive'),
('3231321', 'joseph', 1, 1, 2, 2, 3, 'owningmoon@gmail.com', 'test', 'Active'),
('5293813', 'Budiman', 1, 1, 2, 2, 4, 'budiman.oke@gmail.com', 'test', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_asset`
--

CREATE TABLE `kategori_asset` (
  `id` int(11) NOT NULL,
  `nama` varchar(1000) NOT NULL,
  `assignto` varchar(1000) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `status` varchar(1000) NOT NULL DEFAULT 'Active'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori_asset`
--

INSERT INTO `kategori_asset` (`id`, `nama`, `assignto`, `description`, `status`) VALUES
(5, 'Aset Tetap tdk Berwujud', 'None', 'Asset Tetap tdk Berwujud', 'Active'),
(16, 'Asset Tetap Berwujud', 'None', 'Asset Tetap Berwujud', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_categorysubgroup`
--

CREATE TABLE `kategori_categorysubgroup` (
  `id` int(11) NOT NULL,
  `idgroup` int(11) NOT NULL,
  `idsubgroup` int(11) NOT NULL,
  `idtemplate` int(11) NOT NULL,
  `category` varchar(1000) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori_categorysubgroup`
--

INSERT INTO `kategori_categorysubgroup` (`id`, `idgroup`, `idsubgroup`, `idtemplate`, `category`, `description`, `status`) VALUES
(1, 16, 2, 2, 'Pabrik', 'Pabrik', 'InActive'),
(2, 16, 3, 3, 'Sepeda Pancal', 'Sepeda Pancal', 'Active'),
(3, 16, 3, 3, 'Sepeda Motor', 'Sepeda Motor', 'Active'),
(23, 16, 9, 4, 'Sn', 'Singgle Neddle', 'Active'),
(26, 16, 7, 3, 'Mobil Niaga Solar', 'Mobil Niaga Solar', 'Active'),
(27, 16, 7, 3, 'Mobil Niaga Bensin', 'Mobil Niaga Bensin', 'Active'),
(28, 16, 1, 1, 'Tanah Kosong', 'Tanah Kosong', 'Active'),
(29, 16, 2, 2, 'Rumah', 'Rumah', 'Active'),
(30, 16, 1, 1, 'Tanah dan Bangunan', 'Tanah dan Bangunan', 'Active'),
(31, 16, 7, 3, 'Mobil MPV', 'Mobil MPV', 'Active'),
(32, 5, 23, 1, '1', '', 'Active'),
(33, 5, 23, 1, '2', '', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_subgroup`
--

CREATE TABLE `kategori_subgroup` (
  `id` int(11) NOT NULL,
  `idkategoriaset` int(11) NOT NULL,
  `subgroup` varchar(1000) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'Active'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori_subgroup`
--

INSERT INTO `kategori_subgroup` (`id`, `idkategoriaset`, `subgroup`, `description`, `status`) VALUES
(1, 5, 'Tanah', 'Tanah', 'InActive'),
(2, 5, 'Bangunan', 'Bangunan', 'Active'),
(3, 16, 'Kendaraan Roda 2', 'Kendaraan Roda 2', 'Active'),
(7, 5, 'Kendaraan Roda 4', 'Kendaraan Roda 4', 'Active'),
(9, 5, 'Mesin  dan Peralatan Jahit', 'Mesin dan Peralatan Jahit', 'Active'),
(10, 5, 'Mesin Laundry', 'Mesin Laundry', 'Active'),
(11, 5, 'Mesin dan Peralatan Printing', 'Mesin dan Peralatan Printing', 'Active'),
(12, 16, 'Mesin Embroidery', 'Mesin Embroidery', 'Active'),
(13, 16, 'Mesin dan Peralatan Material Handling', 'Mesin dan Peralatan Material Handling', 'Active'),
(14, 16, 'Mesin dan Peralataan Air', 'Mesin dan Peralatan Air', 'Active'),
(15, 16, 'Mesin dan Peralatan Angin', 'Mesin dan Peralatan Angin', 'Active'),
(16, 16, 'Mesin dan Peralatan Bolier,Steam dan Gas', 'Mesin dan Peralatan Boiler,Steam dan Gas', 'Active'),
(17, 16, 'Mesin dan Peralatan Pemadam Kebakaran', 'Mesin dan Peralatan Pemadam Kebakaran', 'Active'),
(18, 16, 'Peralatan dan Perlengkapan Teknik', 'Perlalatan dan Perlengkapan Teknik', 'Active'),
(19, 16, 'Peralatan dan Perlengkapan Dapur dan Rumah Tangga', 'Peralatan dan Perlengkapan Dapur dan Rumah Tangga', 'Active'),
(20, 16, 'Mesin dan Peralatan Cleaning Service', 'Mesin dan Peralatan Cleaning Service', 'Active'),
(21, 16, 'Furniture', 'Furniture', 'Active'),
(22, 16, 'Software', 'Software', 'Active'),
(23, 5, 'Merk Dagang', 'Merk Dagang', 'Active'),
(24, 5, 'Franchise', 'Franchise', 'Active'),
(25, 5, 'Lisensi', 'Lisensi', 'Active'),
(26, 5, 'Hak Paten', 'Hak Paten', 'Active'),
(27, 5, 'Hak Sewa', 'Hak Sewa', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `level_access`
--

CREATE TABLE `level_access` (
  `id` int(11) NOT NULL,
  `nama` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `location_branch`
--

CREATE TABLE `location_branch` (
  `idbranch` int(11) NOT NULL,
  `code` varchar(500) NOT NULL,
  `branch` varchar(500) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `telp` varchar(10000) DEFAULT NULL,
  `phone` varchar(10000) DEFAULT NULL,
  `status` varchar(1000) NOT NULL DEFAULT 'Active'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location_branch`
--

INSERT INTO `location_branch` (`idbranch`, `code`, `branch`, `description`, `telp`, `phone`, `status`) VALUES
(1, 'b001', 'Branch Jakarta', 'Branch Jakarta Pusat', '11232,1313131', '55,111', 'Active'),
(2, 'W31SNtKG', 'surabaya', 'test', '11232,1313131', '55,111', 'InActive'),
(3, 'w2222', 'bandung', 'testbandung', '11232,1313131', '55,111', 'InActive');

-- --------------------------------------------------------

--
-- Table structure for table `location_building`
--

CREATE TABLE `location_building` (
  `id` int(11) NOT NULL,
  `barcode` varchar(10000) NOT NULL,
  `code` varchar(200) NOT NULL,
  `buildingname` varchar(200) NOT NULL,
  `idsetupsisterbranch` int(11) NOT NULL,
  `description` varchar(10000) NOT NULL,
  `status` varchar(1000) NOT NULL DEFAULT 'Active'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location_building`
--

INSERT INTO `location_building` (`id`, `barcode`, `code`, `buildingname`, `idsetupsisterbranch`, `description`, `status`) VALUES
(1, '-', 'B-011', 'Bangunan Pencakar Langit', 10, 'ini bangunan baru', 'Active'),
(2, '-', 'B001', 'Gedung Botol', 10, 'testsete', 'Active'),
(3, '-', 'B0012', 'Gedung Botol', 12, 'asdasd', 'Active'),
(4, '-', 'B0012News', 'Gedung Botol Barus', 13, 'asdasd', 'Active'),
(5, '-', 'B001', 'Building Sacara', 12, 'Ini deskripsi building sacara', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `location_floor`
--

CREATE TABLE `location_floor` (
  `id` int(11) NOT NULL,
  `barcode` varchar(10000) NOT NULL,
  `code` varchar(200) NOT NULL,
  `floor` varchar(200) NOT NULL,
  `description` varchar(10000) NOT NULL,
  `status` varchar(1000) NOT NULL DEFAULT 'Active'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location_floor`
--

INSERT INTO `location_floor` (`id`, `barcode`, `code`, `floor`, `description`, `status`) VALUES
(1, '-', 'F0011', 'F-LT12', 'Lantai Dasar', 'Active'),
(2, '-', 'F1', 'FLT', 'FLT Description', 'Active'),
(3, '-', 'F1', 'FLTt', 'test', 'Active'),
(4, '-', 'FL-003', 'Floor LG', 'gunakan ini untuk lantai dasar saja', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `location_room`
--

CREATE TABLE `location_room` (
  `id` int(11) NOT NULL,
  `barcode` varchar(10000) NOT NULL,
  `code` varchar(700) NOT NULL,
  `idsetupbuildingfloor` int(11) NOT NULL,
  `room` varchar(700) NOT NULL,
  `description` varchar(10000) NOT NULL,
  `status` varchar(1000) NOT NULL DEFAULT 'Active'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location_room`
--

INSERT INTO `location_room` (`id`, `barcode`, `code`, `idsetupbuildingfloor`, `room`, `description`, `status`) VALUES
(1, '-', 'R0013333', 41, 'Ruangan Khusus Tamuss', 'Ini ruangan khusus untuk tamus', 'Active'),
(2, '-', 'R002', 42, 'Ruangan Khusus Tamus', 'test', 'Active'),
(3, '-', 'R0022', 44, 'Ruangan Khusus Tamussqwe', 'test', 'Active'),
(4, '-', 'R00223', 43, 'Ruangan Khusus Tamussqwes', 'test', 'Active'),
(5, '-', 'R00211', 43, 'Ruangan Serbaguna', 'test descripsi', 'Active'),
(11, '-', 'Sacara002', 45, 'Ruangan Administrasiss', 'Deskripsi Ruangan Admins', 'Active'),
(10, '-', 'Sacara001', 46, 'Ruangan Saca', 'Deskripsi ruangan saca', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `location_setup_building_floor`
--

CREATE TABLE `location_setup_building_floor` (
  `idlocationsetupbuildingfloor` int(11) NOT NULL,
  `idbuilding` int(11) NOT NULL,
  `idfloor` int(11) NOT NULL,
  `code` varchar(700) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'Active'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location_setup_building_floor`
--

INSERT INTO `location_setup_building_floor` (`idlocationsetupbuildingfloor`, `idbuilding`, `idfloor`, `code`, `status`) VALUES
(41, 3, 1, 'PT JMG 1', 'Active'),
(42, 3, 2, 'PT JMG L2', 'Active'),
(40, 1, 1, 'PT JMG', 'Active'),
(43, 1, 2, 'PT JMG 3', 'Active'),
(44, 3, 3, 'BJakarta', 'Active'),
(45, 4, 1, '112', 'Active'),
(46, 5, 4, 'LGKKS3', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `location_setup_sister_branch`
--

CREATE TABLE `location_setup_sister_branch` (
  `idsetupsisterbranch` int(11) NOT NULL,
  `code` varchar(1000) NOT NULL,
  `idsistercompany` int(11) NOT NULL,
  `idbranch` int(11) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `status` varchar(1000) NOT NULL DEFAULT 'Active'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location_setup_sister_branch`
--

INSERT INTO `location_setup_sister_branch` (`idsetupsisterbranch`, `code`, `idsistercompany`, `idbranch`, `description`, `status`) VALUES
(10, 'xx4 - w2222', 1, 3, 'surabaya pt jmg', 'InActive'),
(9, 'xx4 - W31SNtKG', 1, 2, 'surabaya pt jmg', 'Active'),
(12, 'xx42 - Kasih', 2, 1, 'PT Kasih', 'Active'),
(13, 'xx42s - Kasih', 2, 2, 'PT Kasih', 'Active'),
(14, 'xx24 - W31SNtKG', 2, 2, 'Ini PT Kasih Surabaya', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `location_sister_company`
--

CREATE TABLE `location_sister_company` (
  `id` int(11) NOT NULL,
  `idholdingcompany` int(11) NOT NULL,
  `code` varchar(400) NOT NULL,
  `name` varchar(400) NOT NULL,
  `address` varchar(1000) NOT NULL,
  `country` int(11) NOT NULL,
  `province` int(11) NOT NULL,
  `city` int(11) NOT NULL,
  `telp` varchar(1000) NOT NULL,
  `description` varchar(10000) NOT NULL,
  `status` varchar(1000) NOT NULL DEFAULT 'Active'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location_sister_company`
--

INSERT INTO `location_sister_company` (`id`, `idholdingcompany`, `code`, `name`, `address`, `country`, `province`, `city`, `telp`, `description`, `status`) VALUES
(1, 1, 'xx4', 'Pt.JMG', 'Abdurrahman Wahid No 1 ', 1, 1, 5, '0341-556095', 'Pt.Jaya Mandiri Garment', 'Active'),
(2, 1, 'xx24', 'Pt.KKS3', 'Abdurrahman Wahid No 1 2', 1, 1, 8, '0341-5560952', 'Pt.Jaya Mandiri Garment3', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `logpic`
--

CREATE TABLE `logpic` (
  `id` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `iddivisi` int(11) NOT NULL,
  `iddepartment` int(11) NOT NULL,
  `idsistercompany` int(11) NOT NULL,
  `idbranch` int(11) NOT NULL,
  `idbuilding` int(11) NOT NULL,
  `idfloor` int(11) NOT NULL,
  `idroom` int(11) NOT NULL,
  `updatedat` datetime NOT NULL,
  `status` varchar(1000) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logpic`
--

INSERT INTO `logpic` (`id`, `iduser`, `iddivisi`, `iddepartment`, `idsistercompany`, `idbranch`, `idbuilding`, `idfloor`, `idroom`, `updatedat`, `status`) VALUES
(1, 5293813, 1, 1, 1, 1, 1, 1, 1, '2021-08-18 12:00:00', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `logpicdepartment`
--

CREATE TABLE `logpicdepartment` (
  `id` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `updatedat` datetime NOT NULL,
  `status` varchar(1000) DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logpicdepartment`
--

INSERT INTO `logpicdepartment` (`id`, `iduser`, `updatedat`, `status`) VALUES
(1, 3231321, '2021-08-20 08:00:00', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `master_other_location`
--

CREATE TABLE `master_other_location` (
  `id` int(11) NOT NULL,
  `locationname` varchar(1000) NOT NULL,
  `city` varchar(1000) NOT NULL,
  `desc1` varchar(1000) NOT NULL,
  `desc2` varchar(1000) NOT NULL,
  `status` varchar(1000) NOT NULL DEFAULT 'Active'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_other_location`
--

INSERT INTO `master_other_location` (`id`, `locationname`, `city`, `desc1`, `desc2`, `status`) VALUES
(1, 'Lokasi Petambunan', '5', 'ini deskripsi pertama', 'ini deskripsi kedua', 'Active'),
(2, 'myloc', '5', '', '', 'Active'),
(3, 'myloc', '5', '', '', 'Active'),
(4, 'myloc', '5', '', '', 'Active'),
(5, 'myloc', '5', 'desc1 test', '', 'Active'),
(6, 'myloc', '5', 'desc1 test', 'desc2 ini', 'Active'),
(7, 'test', '5', 'setset', 'estse', 'Active'),
(8, 'myloc1', '6', 'desc1', 'desc2', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `province`
--

CREATE TABLE `province` (
  `id` int(11) NOT NULL,
  `idcountry` int(11) NOT NULL,
  `name` varchar(700) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `province`
--

INSERT INTO `province` (`id`, `idcountry`, `name`, `status`) VALUES
(1, 1, 'Jawa Timur', 'Active'),
(2, 1, 'Jawa Barat', 'Active'),
(3, 1, 'Jawa Tengah', 'Active'),
(4, 1, 'Bali', 'Active'),
(5, 4, 'provinsi zimbabwe', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `rack`
--

CREATE TABLE `rack` (
  `id` int(11) NOT NULL,
  `code` varchar(500) NOT NULL,
  `idsistercompany` int(11) NOT NULL,
  `idbranch` int(11) NOT NULL,
  `idbuilding` int(11) NOT NULL,
  `idfloor` int(11) NOT NULL,
  `idroom` int(11) NOT NULL,
  `rackname` varchar(500) NOT NULL,
  `description` varchar(10000) NOT NULL,
  `status` varchar(1000) NOT NULL DEFAULT 'Active'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rack`
--

INSERT INTO `rack` (`id`, `code`, `idsistercompany`, `idbranch`, `idbuilding`, `idfloor`, `idroom`, `rackname`, `description`, `status`) VALUES
(1, 'Rack-0012', 1, 2, 3, 2, 5, 'A', 'ini rak penyimpanan3', 'Active'),
(2, 'Rack-002', 1, 3, 1, 1, 1, 'B', 'Ini rak cadangan', 'Active'),
(3, 'Rack-003', 1, 3, 1, 1, 1, 'C', 'ini rak cadangan', 'Active'),
(4, 'RK001', 1, 3, 1, 2, 4, 'RK', 'TestRKs', 'Active'),
(5, 'RS000', 2, 1, 5, 4, 10, 'RS', 'Ini untuk rack penyimpanan ', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `rank`
--

CREATE TABLE `rank` (
  `id` int(11) NOT NULL,
  `rank` varchar(700) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `status` varchar(1000) NOT NULL,
  `modified` int(11) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rank`
--

INSERT INTO `rank` (`id`, `rank`, `description`, `status`, `modified`, `date_created`) VALUES
(3, 'Director', 'Level Director', 'Active', NULL, NULL),
(4, 'Manager', 'Level Manager', 'Active', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reason`
--

CREATE TABLE `reason` (
  `id` int(11) NOT NULL,
  `reason` varchar(300) NOT NULL,
  `description` varchar(500) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reason`
--

INSERT INTO `reason` (`id`, `reason`, `description`, `status`) VALUES
(1, 'Good', 'Please choose this if the stuff condition is good', 'Active'),
(2, 'Half', 'Please choose this if the stuff condition is half damaged', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `relation`
--

CREATE TABLE `relation` (
  `id` int(11) NOT NULL,
  `code` varchar(200) NOT NULL,
  `contactname` varchar(200) NOT NULL,
  `description` varchar(300) NOT NULL,
  `idrank` int(11) NOT NULL,
  `iddepartment` int(11) NOT NULL,
  `hp1` varchar(100) NOT NULL,
  `hp2` varchar(100) NOT NULL,
  `email1` varchar(100) NOT NULL,
  `email2` varchar(100) NOT NULL,
  `address` varchar(300) NOT NULL,
  `idcountry` int(11) NOT NULL,
  `idprovince` int(11) NOT NULL,
  `idcity` int(11) NOT NULL,
  `company` varchar(300) NOT NULL,
  `remark` varchar(300) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `relation`
--

INSERT INTO `relation` (`id`, `code`, `contactname`, `description`, `idrank`, `iddepartment`, `hp1`, `hp2`, `email1`, `email2`, `address`, `idcountry`, `idprovince`, `idcity`, `company`, `remark`, `status`) VALUES
(5, 'Rel-001', 'MR Paijos', 'Relation  PT Suka Maju', 4, 2, '08183283823', '08328283823', 'sukamaju@gmail.com', 'cs.sukamaju@gmail.com', 'Jalan Kedung Asem 5', 1, 3, 10, 'PT Suka Maju', 'Remark Desc', 'Active'),
(6, 'Rel-002', 'Mrs Suti', 'Relation PT SukaJaya', 3, 1, '081835555', '083282444', 'SukaJaya@gmail.com', 'cs.SukaJaya@gmail.com', 'Jalan Kedung Anyar 5 no 10', 1, 1, 5, 'PTSuka Jaya', 'Remark Desc', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `ruangan`
--

CREATE TABLE `ruangan` (
  `id` varchar(100) NOT NULL,
  `nama_ruangan` varchar(200) DEFAULT NULL,
  `pic_ruangan` varchar(200) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ruangan`
--

INSERT INTO `ruangan` (`id`, `nama_ruangan`, `pic_ruangan`, `status`) VALUES
('1', 'Ruangan HRD', '3231321', 1),
('2', 'Ruangan Tamu', NULL, 1),
('3', 'Ruangan Kantor Tengah', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `subrack`
--

CREATE TABLE `subrack` (
  `id` int(11) NOT NULL,
  `idrack` int(11) NOT NULL,
  `code` varchar(300) NOT NULL,
  `subrackname` varchar(200) NOT NULL,
  `rows` int(11) NOT NULL,
  `colum` int(11) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subrack`
--

INSERT INTO `subrack` (`id`, `idrack`, `code`, `subrackname`, `rows`, `colum`, `status`) VALUES
(1, 1, 'A-1-1', 'A', 1, 1, 'Active'),
(3, 1, 'A-2-1', 'A', 2, 1, 'Active'),
(4, 3, 'C-0-0', 'C', 0, 0, 'Active'),
(10, 3, 'C-1-3', 'C', 1, 3, 'Active'),
(12, 3, 'C-1-2', 'C', 1, 2, 'Active'),
(13, 1, 'A-2-2', 'A', 2, 2, 'Active'),
(14, 1, 'A-222-199', 'A', 222, 199, 'Active'),
(15, 5, 'RS-1-2', 'RS', 1, 2, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `company` varchar(500) NOT NULL,
  `description` varchar(500) NOT NULL,
  `address` varchar(500) NOT NULL,
  `idcountry` int(11) NOT NULL,
  `idprovince` int(11) NOT NULL,
  `idcity` int(11) NOT NULL,
  `idrank` int(11) NOT NULL,
  `iddepartment` int(11) NOT NULL,
  `officetelp` varchar(100) NOT NULL,
  `contactname` varchar(500) NOT NULL,
  `hp1` varchar(100) NOT NULL,
  `hp2` varchar(100) NOT NULL,
  `email1` varchar(100) NOT NULL,
  `email2` varchar(100) NOT NULL,
  `remark` varchar(200) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `company`, `description`, `address`, `idcountry`, `idprovince`, `idcity`, `idrank`, `iddepartment`, `officetelp`, `contactname`, `hp1`, `hp2`, `email1`, `email2`, `remark`, `status`) VALUES
(1, 'PT Supplier Asik', 'Deskripsi PT Supplier Asiks', 'Alamat PT Supplier Asiks', 1, 1, 6, 3, 1, '08383483838', 'Bambangs', '08383483222', '08383455538', 'bambang1@gmail.coms', 'bambang2@gmail.coms', 'Remark PT Supplier Asiks', 'Active'),
(2, 'PT Kasih', 'Description PT kasih', 'Address PT kasih', 1, 1, 7, 3, 1, '081838283823', 'Joseph', '081818382832', '082832813182', 'joseph1@gmail.com', 'joseph2@gmail.com', 'joseph2@gmail.com', 'Active'),
(4, 'PT kasih abadi', 'PT kasih abadi', 'alamat PT kasih abadi', 1, 1, 5, 3, 1, '083838113', 'Juri', '08823928392', '083293923929', 'owning1@gmail.com', 'owning2@gmail.com', 'remark2', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `template`
--

CREATE TABLE `template` (
  `id` int(11) NOT NULL,
  `template` varchar(100) NOT NULL,
  `status` varchar(60) NOT NULL DEFAULT 'Active',
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template`
--

INSERT INTO `template` (`id`, `template`, `status`, `created_by`, `created_at`, `updated_by`) VALUES
(1, 'Template Asset Tanah', 'Active', 1, '2021-09-17 09:35:39', '2021-09-17 09:35:39'),
(2, 'Template Bangunan', 'Active', 1, '2021-09-17 09:37:40', '2021-09-17 09:37:40'),
(3, 'Template Kendaraan', 'Active', 1, '2021-09-17 09:37:51', '2021-09-17 09:37:51'),
(4, 'Template Peralatan', 'Active', 1, '2021-09-17 09:40:48', '2021-09-17 09:40:48'),
(5, 'Template Asset Tidak Berwujud', 'Active', 1, '2021-09-17 09:41:02', '2021-09-17 09:41:02'),
(6, 'Template Aset Berjalan', 'Active', 1, '2021-09-24 04:41:48', '2021-09-24 04:41:48');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_displacement_department`
--

CREATE TABLE `transaction_displacement_department` (
  `id` int(11) NOT NULL,
  `notransaction` varchar(1000) NOT NULL,
  `idsister` int(11) NOT NULL,
  `idbranch` int(11) NOT NULL,
  `iddepartment` int(11) NOT NULL,
  `idfromroom` int(11) NOT NULL,
  `idtoroom` int(11) NOT NULL,
  `remark` varchar(1000) NOT NULL,
  `status_approval` varchar(1000) NOT NULL,
  `lead_time` timestamp NULL DEFAULT current_timestamp(),
  `mydate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_displacement_department`
--

INSERT INTO `transaction_displacement_department` (`id`, `notransaction`, `idsister`, `idbranch`, `iddepartment`, `idfromroom`, `idtoroom`, `remark`, `status_approval`, `lead_time`, `mydate`) VALUES
(1, 'TRX-0012', 1, 1, 2, 1, 1, 'myremark', 'rejected', '0000-00-00 00:00:00', '2021-10-05'),
(2, 'TRX-0013', 1, 1, 2, 1, 1, 'myremark', 'pending', '0000-00-00 00:00:00', '2021-10-03'),
(11, 'TRX---', 1, 3, 1, 4, 4, 'renm', 'pending', '0000-00-00 00:00:00', '2021-10-05');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_displacement_department_log`
--

CREATE TABLE `transaction_displacement_department_log` (
  `id` int(11) NOT NULL,
  `idtransaksi` int(11) NOT NULL,
  `idasset` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_displacement_department_log`
--

INSERT INTO `transaction_displacement_department_log` (`id`, `idtransaksi`, `idasset`) VALUES
(6, 1, 58),
(7, 1, 59),
(8, 2, 62),
(9, 2, 60),
(10, 11, 58),
(11, 11, 62);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_displacement_new_asset`
--

CREATE TABLE `transaction_displacement_new_asset` (
  `id` int(11) NOT NULL,
  `notransaction` varchar(1000) NOT NULL,
  `idsister` int(11) NOT NULL,
  `idbranch` int(11) NOT NULL,
  `idroom` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `status_approval` varchar(1000) NOT NULL,
  `lead_time` timestamp NULL DEFAULT current_timestamp(),
  `mydate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_displacement_new_asset`
--

INSERT INTO `transaction_displacement_new_asset` (`id`, `notransaction`, `idsister`, `idbranch`, `idroom`, `created_by`, `status_approval`, `lead_time`, `mydate`) VALUES
(11, 'TRX---', 1, 3, 4, 1223456, 'accepted', '0000-00-00 00:00:00', '2021-10-04'),
(13, 'TRX---', 1, 3, 4, 1223456, 'pending', '0000-00-00 00:00:00', '2021-10-05'),
(14, 'TRX---', 1, 3, 4, 1223456, 'pending', '0000-00-00 00:00:00', '2021-10-08');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_displacement_new_asset_log`
--

CREATE TABLE `transaction_displacement_new_asset_log` (
  `id` int(11) NOT NULL,
  `idtransaksi` int(11) NOT NULL,
  `idasset` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_displacement_new_asset_log`
--

INSERT INTO `transaction_displacement_new_asset_log` (`id`, `idtransaksi`, `idasset`) VALUES
(6, 11, 58),
(7, 11, 59),
(8, 11, 62),
(9, 13, 60),
(10, 14, 60),
(11, 14, 61);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_displacement_other_department`
--

CREATE TABLE `transaction_displacement_other_department` (
  `id` int(11) NOT NULL,
  `notransaction` varchar(1000) NOT NULL,
  `idsister` int(11) NOT NULL,
  `idbranchfrom` int(11) NOT NULL,
  `idbranchto` int(11) NOT NULL,
  `idfromroom` int(11) NOT NULL,
  `idtoroom` int(11) NOT NULL,
  `remark` varchar(1000) NOT NULL,
  `status_approval` varchar(1000) NOT NULL,
  `lead_time` timestamp NULL DEFAULT current_timestamp(),
  `mydate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_displacement_other_department`
--

INSERT INTO `transaction_displacement_other_department` (`id`, `notransaction`, `idsister`, `idbranchfrom`, `idbranchto`, `idfromroom`, `idtoroom`, `remark`, `status_approval`, `lead_time`, `mydate`) VALUES
(1, 'TRX-0012', 1, 1, 2, 1, 1, 'myremark', 'rejected', '0000-00-00 00:00:00', '2021-10-03'),
(2, 'TRX-0013', 1, 1, 3, 1, 1, 'myremark', 'pending', '0000-00-00 00:00:00', '2021-10-11'),
(9, 'TRX---', 1, 3, 3, 4, 4, '123123123', 'pending', '0000-00-00 00:00:00', '2021-10-05');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_displacement_other_department_log`
--

CREATE TABLE `transaction_displacement_other_department_log` (
  `id` int(11) NOT NULL,
  `idtransaksi` int(11) NOT NULL,
  `idasset` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_displacement_other_department_log`
--

INSERT INTO `transaction_displacement_other_department_log` (`id`, `idtransaksi`, `idasset`) VALUES
(6, 1, 58),
(7, 1, 59),
(8, 2, 62),
(9, 2, 60),
(16, 9, 58),
(17, 9, 59);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_dispose`
--

CREATE TABLE `transaction_dispose` (
  `id` int(11) NOT NULL,
  `idsister` int(11) NOT NULL,
  `mydate` date NOT NULL,
  `notransaction` varchar(1000) NOT NULL,
  `approval` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_dispose`
--

INSERT INTO `transaction_dispose` (`id`, `idsister`, `mydate`, `notransaction`, `approval`) VALUES
(1, 1, '2021-09-16', 'TRX-020202', 'pending'),
(2, 1, '2021-09-30', 'TRX-020202', 'pending'),
(7, 1, '2021-10-05', 'TRX-020202', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_dispose_log`
--

CREATE TABLE `transaction_dispose_log` (
  `id` int(11) NOT NULL,
  `idtransaksi` int(11) NOT NULL,
  `idasset` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_dispose_log`
--

INSERT INTO `transaction_dispose_log` (`id`, `idtransaksi`, `idasset`) VALUES
(6, 1, 58),
(7, 1, 59),
(16, 2, 58),
(17, 2, 59),
(21, 7, 59);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_extension_department`
--

CREATE TABLE `transaction_extension_department` (
  `id` int(11) NOT NULL,
  `transactionextension` varchar(1000) NOT NULL,
  `transactionlend` int(11) NOT NULL,
  `date` date NOT NULL,
  `add_date` int(11) NOT NULL,
  `extended_due_date` date NOT NULL,
  `status_approval_extension` varchar(100) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_extension_department`
--

INSERT INTO `transaction_extension_department` (`id`, `transactionextension`, `transactionlend`, `date`, `add_date`, `extended_due_date`, `status_approval_extension`) VALUES
(1, 'TRXE-001', 1, '2021-10-08', 20, '2021-10-30', 'accepted');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_extension_personal`
--

CREATE TABLE `transaction_extension_personal` (
  `id` int(11) NOT NULL,
  `transactionextension` varchar(1000) NOT NULL,
  `transactionlend` int(11) NOT NULL,
  `date` date NOT NULL,
  `add_date` int(11) NOT NULL,
  `extended_due_date` date NOT NULL,
  `status_approval_extension` varchar(100) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_extension_personal`
--

INSERT INTO `transaction_extension_personal` (`id`, `transactionextension`, `transactionlend`, `date`, `add_date`, `extended_due_date`, `status_approval_extension`) VALUES
(1, 'TRXPer-001', 8, '2021-10-01', 30, '2021-11-05', 'accepted');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_extension_relation`
--

CREATE TABLE `transaction_extension_relation` (
  `id` int(11) NOT NULL,
  `transactionextension` varchar(1000) NOT NULL,
  `transactionlend` int(11) NOT NULL,
  `date` date NOT NULL,
  `add_date` int(11) NOT NULL,
  `extended_due_date` date NOT NULL,
  `status_approval_extension` varchar(100) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_extension_relation`
--

INSERT INTO `transaction_extension_relation` (`id`, `transactionextension`, `transactionlend`, `date`, `add_date`, `extended_due_date`, `status_approval_extension`) VALUES
(1, 'TRXRel-001', 1, '2021-10-08', 10, '2021-10-20', 'accepted');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_lend_to_department`
--

CREATE TABLE `transaction_lend_to_department` (
  `id` int(11) NOT NULL,
  `notransaction` varchar(1000) NOT NULL,
  `idbranch` int(11) NOT NULL,
  `department` int(11) NOT NULL,
  `room` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `due_date` date NOT NULL,
  `approval` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `mydate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_lend_to_department`
--

INSERT INTO `transaction_lend_to_department` (`id`, `notransaction`, `idbranch`, `department`, `room`, `start_date`, `due_date`, `approval`, `status`, `mydate`) VALUES
(1, 'TRX-112233', 1, 1, 1, '2021-09-22', '2021-10-10', 'pending', 'waiting', '0000-00-00'),
(6, 'TRX-020', 1, 1, 1, '2021-09-30', '2021-09-30', 'pending', 'waiting', '2021-09-30'),
(8, 'TRX-020', 2, 3, 11, '2021-09-09', '2021-09-11', 'pending', 'waiting', '2021-09-30'),
(10, 'TRX-020', 1, 1, 1, '2021-10-05', '2021-10-05', 'accepted', 'waiting', '2021-10-05');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_lend_to_department_log`
--

CREATE TABLE `transaction_lend_to_department_log` (
  `id` int(11) NOT NULL,
  `idtransaksi` int(11) NOT NULL,
  `idasset` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_lend_to_department_log`
--

INSERT INTO `transaction_lend_to_department_log` (`id`, `idtransaksi`, `idasset`) VALUES
(6, 1, 58),
(7, 1, 59),
(16, 6, 58),
(17, 8, 59),
(21, 8, 59),
(22, 10, 59);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_lend_to_personal`
--

CREATE TABLE `transaction_lend_to_personal` (
  `id` int(11) NOT NULL,
  `notransaction` varchar(1000) NOT NULL,
  `id_department` int(11) NOT NULL,
  `idbranch` int(11) NOT NULL,
  `nik` int(11) NOT NULL,
  `idbranchroom` int(11) NOT NULL,
  `room` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `due_date` date NOT NULL,
  `approval` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `mydate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_lend_to_personal`
--

INSERT INTO `transaction_lend_to_personal` (`id`, `notransaction`, `id_department`, `idbranch`, `nik`, `idbranchroom`, `room`, `start_date`, `due_date`, `approval`, `status`, `mydate`) VALUES
(1, 'TRX-112233', 1, 1, 1223456, 1, 1, '2021-09-22', '2021-10-30', 'accepted', 'waiting', '2021-09-10'),
(5, 'TRX-0000', 1, 1, 1223456, 1, 2, '2021-09-01', '2021-09-30', 'pending', 'waiting', '2021-09-30'),
(8, 'TRX-0000', 1, 1, 1223456, 1, 1, '2021-10-05', '2021-10-05', 'pending', 'waiting', '2021-10-05');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_lend_to_personal_log`
--

CREATE TABLE `transaction_lend_to_personal_log` (
  `id` int(11) NOT NULL,
  `idtransaksi` int(11) NOT NULL,
  `idasset` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_lend_to_personal_log`
--

INSERT INTO `transaction_lend_to_personal_log` (`id`, `idtransaksi`, `idasset`) VALUES
(6, 1, 58),
(7, 1, 59),
(16, 5, 58),
(17, 5, 59),
(21, 8, 59);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_lend_to_relation`
--

CREATE TABLE `transaction_lend_to_relation` (
  `id` int(11) NOT NULL,
  `notransaction` varchar(1000) NOT NULL,
  `idbranch` int(11) NOT NULL,
  `relation` int(11) NOT NULL,
  `room` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `due_date` date NOT NULL,
  `approval` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `mydate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_lend_to_relation`
--

INSERT INTO `transaction_lend_to_relation` (`id`, `notransaction`, `idbranch`, `relation`, `room`, `start_date`, `due_date`, `approval`, `status`, `mydate`) VALUES
(1, 'TRX-112233', 1, 5, 1, '2021-10-07', '2021-10-10', 'pending', 'waiting', '0000-00-00'),
(5, 'TRX-0000', 1, 6, 2, '2021-09-01', '2021-09-30', 'accepted', 'waiting', '2021-09-30'),
(8, 'TRX-020', 2, 6, 11, '2021-09-09', '2021-09-11', 'pending', 'waiting', '2021-09-30'),
(9, 'TRX-020', 1, 5, 1, '2021-10-05', '2021-10-05', 'accepted', 'waiting', '2021-10-05');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_lend_to_relation_log`
--

CREATE TABLE `transaction_lend_to_relation_log` (
  `id` int(11) NOT NULL,
  `idtransaksi` int(11) NOT NULL,
  `idasset` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_lend_to_relation_log`
--

INSERT INTO `transaction_lend_to_relation_log` (`id`, `idtransaksi`, `idasset`) VALUES
(6, 1, 58),
(7, 1, 59),
(8, 5, 62),
(9, 5, 60),
(16, 8, 58),
(17, 8, 59),
(18, 9, 62);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_mutation`
--

CREATE TABLE `transaction_mutation` (
  `id` int(11) NOT NULL,
  `idsisterfrom` int(11) NOT NULL,
  `idbranchfrom` int(11) NOT NULL,
  `idroomfrom` int(11) NOT NULL,
  `idsisterto` int(11) NOT NULL,
  `idbranchto` int(11) NOT NULL,
  `mydate` date NOT NULL,
  `notransaction` varchar(1000) NOT NULL,
  `approval` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_mutation`
--

INSERT INTO `transaction_mutation` (`id`, `idsisterfrom`, `idbranchfrom`, `idroomfrom`, `idsisterto`, `idbranchto`, `mydate`, `notransaction`, `approval`) VALUES
(1, 1, 1, 1, 2, 2, '2021-09-16', 'TRX-020202', 'pending'),
(5, 1, 1, 1, 2, 2, '2021-10-06', 'TRX-020202', 'pending'),
(8, 1, 1, 1, 2, 2, '2021-10-06', 'TRX-020202', 'pending'),
(9, 1, 1, 2, 2, 2, '2021-10-06', 'TRX-020202', 'pending'),
(13, 1, 2, 11, 2, 2, '2021-10-06', 'TRX-11111', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_mutation_log`
--

CREATE TABLE `transaction_mutation_log` (
  `id` int(11) NOT NULL,
  `idtransaksi` int(11) NOT NULL,
  `idasset` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_mutation_log`
--

INSERT INTO `transaction_mutation_log` (`id`, `idtransaksi`, `idasset`) VALUES
(6, 1, 58),
(7, 1, 59),
(8, 5, 62),
(9, 5, 60),
(16, 8, 58),
(17, 8, 59),
(18, 9, 62),
(19, 13, 58);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_return_department`
--

CREATE TABLE `transaction_return_department` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `transactionreturn` varchar(10000) NOT NULL,
  `transactionlend` int(11) NOT NULL,
  `status_approval_return` varchar(100) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_return_department`
--

INSERT INTO `transaction_return_department` (`id`, `date`, `transactionreturn`, `transactionlend`, `status_approval_return`) VALUES
(1, '2021-10-07', 'TRXR-001', 1, 'pending'),
(2, '2021-10-02', 'TRXR-002', 6, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_return_personel`
--

CREATE TABLE `transaction_return_personel` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `transactionreturn` varchar(10000) NOT NULL,
  `transactionlend` int(11) NOT NULL,
  `status_approval_return` varchar(100) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_return_personel`
--

INSERT INTO `transaction_return_personel` (`id`, `date`, `transactionreturn`, `transactionlend`, `status_approval_return`) VALUES
(1, '2021-10-07', 'TRXR-001', 1, 'pending'),
(2, '2021-10-02', 'TRXR-002', 5, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_return_relation`
--

CREATE TABLE `transaction_return_relation` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `transactionreturn` varchar(10000) NOT NULL,
  `transactionlend` int(11) NOT NULL,
  `status_approval_return` varchar(100) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_return_relation`
--

INSERT INTO `transaction_return_relation` (`id`, `date`, `transactionreturn`, `transactionlend`, `status_approval_return`) VALUES
(1, '2021-10-06', 'TRXR-002', 8, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_sale`
--

CREATE TABLE `transaction_sale` (
  `id` int(11) NOT NULL,
  `idsister` int(11) NOT NULL,
  `mydate` date NOT NULL,
  `notransaction` varchar(1000) NOT NULL,
  `approval` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_sale`
--

INSERT INTO `transaction_sale` (`id`, `idsister`, `mydate`, `notransaction`, `approval`) VALUES
(1, 1, '2021-09-16', 'TRX-020202', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_sale_log`
--

CREATE TABLE `transaction_sale_log` (
  `id` int(11) NOT NULL,
  `idtransaksi` int(11) NOT NULL,
  `idasset` int(11) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_sale_log`
--

INSERT INTO `transaction_sale_log` (`id`, `idtransaksi`, `idasset`, `harga`) VALUES
(6, 1, 58, 10000),
(7, 1, 59, 20000);

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `id` int(11) NOT NULL,
  `name` varchar(1000) DEFAULT NULL,
  `address` varchar(1000) DEFAULT NULL,
  `city` varchar(1000) DEFAULT NULL,
  `Province` varchar(1000) DEFAULT NULL,
  `telp` varchar(1000) DEFAULT NULL,
  `address2` varchar(1000) DEFAULT NULL,
  `city2` varchar(1000) DEFAULT NULL,
  `province2` varchar(1000) DEFAULT NULL,
  `telp2` varchar(1000) DEFAULT NULL,
  `pic_name` varchar(1000) DEFAULT NULL,
  `nohp` varchar(1000) DEFAULT NULL,
  `whatsapp` varchar(1000) DEFAULT NULL,
  `email1` varchar(1000) DEFAULT NULL,
  `email2` varchar(1000) DEFAULT NULL,
  `akunbank` varchar(1000) DEFAULT NULL,
  `npwp` varchar(1000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `asset`
--
ALTER TABLE `asset`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `noasset` (`noasset`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idprovince` (`idprovince`,`name`);

--
-- Indexes for table `conditions`
--
ALTER TABLE `conditions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`,`description`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `custom_template_answer`
--
ALTER TABLE `custom_template_answer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `custom_to_template`
--
ALTER TABLE `custom_to_template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `iddivisi` (`iddivisi`,`department`);

--
-- Indexes for table `divisi`
--
ALTER TABLE `divisi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `divisi` (`divisi`);

--
-- Indexes for table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `document_displacement_new`
--
ALTER TABLE `document_displacement_new`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `document_displacement_to_other_rack`
--
ALTER TABLE `document_displacement_to_other_rack`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `document_dispose`
--
ALTER TABLE `document_dispose`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `document_lend`
--
ALTER TABLE `document_lend`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `document_lend_extend_log`
--
ALTER TABLE `document_lend_extend_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `document_return_log`
--
ALTER TABLE `document_return_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `driving_force`
--
ALTER TABLE `driving_force`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `drivingforce` (`drivingforce`,`description`);

--
-- Indexes for table `folder`
--
ALTER TABLE `folder`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idsistercompany` (`idsistercompany`,`idbranch`,`idbuilding`,`idrack`,`idfloor`,`idroom`);

--
-- Indexes for table `folder_custom`
--
ALTER TABLE `folder_custom`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `fuel`
--
ALTER TABLE `fuel`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `fuel` (`fuel`,`description`);

--
-- Indexes for table `holding_company`
--
ALTER TABLE `holding_company`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idcity` (`idcity`),
  ADD KEY `idcountry` (`idcountry`),
  ADD KEY `idprovince` (`idprovince`);

--
-- Indexes for table `initial_condition`
--
ALTER TABLE `initial_condition`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `initial_condition` (`initial_condition`,`description`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`nik`),
  ADD KEY `idsistercompany` (`idsistercompany`,`idbranch`,`iddivisi`),
  ADD KEY `iddepartment` (`iddepartment`);

--
-- Indexes for table `kategori_asset`
--
ALTER TABLE `kategori_asset`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama` (`nama`);

--
-- Indexes for table `kategori_categorysubgroup`
--
ALTER TABLE `kategori_categorysubgroup`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idsubgroup` (`idsubgroup`,`category`(767),`idgroup`) USING BTREE,
  ADD KEY `idgroup` (`idgroup`);

--
-- Indexes for table `kategori_subgroup`
--
ALTER TABLE `kategori_subgroup`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subgroup` (`subgroup`),
  ADD KEY `idkategoriaset` (`idkategoriaset`);

--
-- Indexes for table `level_access`
--
ALTER TABLE `level_access`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location_branch`
--
ALTER TABLE `location_branch`
  ADD PRIMARY KEY (`idbranch`),
  ADD UNIQUE KEY `code_2` (`code`,`branch`);

--
-- Indexes for table `location_building`
--
ALTER TABLE `location_building`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`,`buildingname`),
  ADD KEY `idsetupsisterbranch` (`idsetupsisterbranch`);

--
-- Indexes for table `location_floor`
--
ALTER TABLE `location_floor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`,`floor`);

--
-- Indexes for table `location_room`
--
ALTER TABLE `location_room`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD UNIQUE KEY `idsetupsisterbranch` (`room`);

--
-- Indexes for table `location_setup_building_floor`
--
ALTER TABLE `location_setup_building_floor`
  ADD PRIMARY KEY (`idlocationsetupbuildingfloor`),
  ADD UNIQUE KEY `idsetupsisterbranch` (`idbuilding`,`idfloor`) USING BTREE;

--
-- Indexes for table `location_setup_sister_branch`
--
ALTER TABLE `location_setup_sister_branch`
  ADD PRIMARY KEY (`idsetupsisterbranch`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `idsistercompany` (`idsistercompany`),
  ADD KEY `idbranch` (`idbranch`);

--
-- Indexes for table `location_sister_company`
--
ALTER TABLE `location_sister_company`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`,`name`),
  ADD KEY `country` (`country`),
  ADD KEY `province` (`province`),
  ADD KEY `city` (`city`);

--
-- Indexes for table `logpic`
--
ALTER TABLE `logpic`
  ADD PRIMARY KEY (`id`),
  ADD KEY `iduser` (`iduser`),
  ADD KEY `idsistercompany` (`idsistercompany`,`idbranch`,`idbuilding`,`idfloor`,`idroom`),
  ADD KEY `iddivisi` (`iddivisi`,`iddepartment`);

--
-- Indexes for table `logpicdepartment`
--
ALTER TABLE `logpicdepartment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `iduser` (`iduser`);

--
-- Indexes for table `master_other_location`
--
ALTER TABLE `master_other_location`
  ADD PRIMARY KEY (`id`),
  ADD KEY `city` (`city`);

--
-- Indexes for table `province`
--
ALTER TABLE `province`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idcountry_2` (`idcountry`,`name`),
  ADD KEY `idcountry` (`idcountry`);

--
-- Indexes for table `rack`
--
ALTER TABLE `rack`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`,`rackname`);

--
-- Indexes for table `rank`
--
ALTER TABLE `rank`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rank` (`rank`);

--
-- Indexes for table `reason`
--
ALTER TABLE `reason`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `relation`
--
ALTER TABLE `relation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `contactname` (`contactname`,`description`);

--
-- Indexes for table `ruangan`
--
ALTER TABLE `ruangan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pic_ruangan` (`pic_ruangan`);

--
-- Indexes for table `subrack`
--
ALTER TABLE `subrack`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idrack` (`idrack`,`code`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `company` (`company`),
  ADD KEY `idcountry` (`idcountry`,`idprovince`,`idcity`);

--
-- Indexes for table `template`
--
ALTER TABLE `template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_displacement_department`
--
ALTER TABLE `transaction_displacement_department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_displacement_department_log`
--
ALTER TABLE `transaction_displacement_department_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_displacement_new_asset`
--
ALTER TABLE `transaction_displacement_new_asset`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_displacement_new_asset_log`
--
ALTER TABLE `transaction_displacement_new_asset_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_displacement_other_department`
--
ALTER TABLE `transaction_displacement_other_department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_displacement_other_department_log`
--
ALTER TABLE `transaction_displacement_other_department_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_dispose`
--
ALTER TABLE `transaction_dispose`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_dispose_log`
--
ALTER TABLE `transaction_dispose_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_extension_department`
--
ALTER TABLE `transaction_extension_department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_extension_personal`
--
ALTER TABLE `transaction_extension_personal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_extension_relation`
--
ALTER TABLE `transaction_extension_relation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_lend_to_department`
--
ALTER TABLE `transaction_lend_to_department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_lend_to_department_log`
--
ALTER TABLE `transaction_lend_to_department_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_lend_to_personal`
--
ALTER TABLE `transaction_lend_to_personal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_lend_to_personal_log`
--
ALTER TABLE `transaction_lend_to_personal_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_lend_to_relation`
--
ALTER TABLE `transaction_lend_to_relation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_lend_to_relation_log`
--
ALTER TABLE `transaction_lend_to_relation_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_mutation`
--
ALTER TABLE `transaction_mutation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_mutation_log`
--
ALTER TABLE `transaction_mutation_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_return_department`
--
ALTER TABLE `transaction_return_department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_return_personel`
--
ALTER TABLE `transaction_return_personel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_return_relation`
--
ALTER TABLE `transaction_return_relation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_sale`
--
ALTER TABLE `transaction_sale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_sale_log`
--
ALTER TABLE `transaction_sale_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `asset`
--
ALTER TABLE `asset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `conditions`
--
ALTER TABLE `conditions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `custom_template_answer`
--
ALTER TABLE `custom_template_answer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `custom_to_template`
--
ALTER TABLE `custom_to_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `divisi`
--
ALTER TABLE `divisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `document`
--
ALTER TABLE `document`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `document_dispose`
--
ALTER TABLE `document_dispose`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `document_lend`
--
ALTER TABLE `document_lend`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `document_lend_extend_log`
--
ALTER TABLE `document_lend_extend_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `document_return_log`
--
ALTER TABLE `document_return_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `driving_force`
--
ALTER TABLE `driving_force`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `folder`
--
ALTER TABLE `folder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `folder_custom`
--
ALTER TABLE `folder_custom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `fuel`
--
ALTER TABLE `fuel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `holding_company`
--
ALTER TABLE `holding_company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `initial_condition`
--
ALTER TABLE `initial_condition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kategori_asset`
--
ALTER TABLE `kategori_asset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `kategori_categorysubgroup`
--
ALTER TABLE `kategori_categorysubgroup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `kategori_subgroup`
--
ALTER TABLE `kategori_subgroup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `level_access`
--
ALTER TABLE `level_access`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `location_branch`
--
ALTER TABLE `location_branch`
  MODIFY `idbranch` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `location_building`
--
ALTER TABLE `location_building`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `location_floor`
--
ALTER TABLE `location_floor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `location_room`
--
ALTER TABLE `location_room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `location_setup_building_floor`
--
ALTER TABLE `location_setup_building_floor`
  MODIFY `idlocationsetupbuildingfloor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `location_setup_sister_branch`
--
ALTER TABLE `location_setup_sister_branch`
  MODIFY `idsetupsisterbranch` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `location_sister_company`
--
ALTER TABLE `location_sister_company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `logpic`
--
ALTER TABLE `logpic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `logpicdepartment`
--
ALTER TABLE `logpicdepartment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `master_other_location`
--
ALTER TABLE `master_other_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `province`
--
ALTER TABLE `province`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `rack`
--
ALTER TABLE `rack`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `rank`
--
ALTER TABLE `rank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reason`
--
ALTER TABLE `reason`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `relation`
--
ALTER TABLE `relation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `subrack`
--
ALTER TABLE `subrack`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `template`
--
ALTER TABLE `template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transaction_displacement_department`
--
ALTER TABLE `transaction_displacement_department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `transaction_displacement_department_log`
--
ALTER TABLE `transaction_displacement_department_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `transaction_displacement_new_asset`
--
ALTER TABLE `transaction_displacement_new_asset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `transaction_displacement_new_asset_log`
--
ALTER TABLE `transaction_displacement_new_asset_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `transaction_displacement_other_department`
--
ALTER TABLE `transaction_displacement_other_department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `transaction_displacement_other_department_log`
--
ALTER TABLE `transaction_displacement_other_department_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `transaction_dispose`
--
ALTER TABLE `transaction_dispose`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `transaction_dispose_log`
--
ALTER TABLE `transaction_dispose_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `transaction_extension_department`
--
ALTER TABLE `transaction_extension_department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaction_extension_personal`
--
ALTER TABLE `transaction_extension_personal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaction_extension_relation`
--
ALTER TABLE `transaction_extension_relation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaction_lend_to_department`
--
ALTER TABLE `transaction_lend_to_department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `transaction_lend_to_department_log`
--
ALTER TABLE `transaction_lend_to_department_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `transaction_lend_to_personal`
--
ALTER TABLE `transaction_lend_to_personal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `transaction_lend_to_personal_log`
--
ALTER TABLE `transaction_lend_to_personal_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `transaction_lend_to_relation`
--
ALTER TABLE `transaction_lend_to_relation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `transaction_lend_to_relation_log`
--
ALTER TABLE `transaction_lend_to_relation_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `transaction_mutation`
--
ALTER TABLE `transaction_mutation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `transaction_mutation_log`
--
ALTER TABLE `transaction_mutation_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `transaction_return_department`
--
ALTER TABLE `transaction_return_department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaction_return_personel`
--
ALTER TABLE `transaction_return_personel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaction_return_relation`
--
ALTER TABLE `transaction_return_relation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaction_sale`
--
ALTER TABLE `transaction_sale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaction_sale_log`
--
ALTER TABLE `transaction_sale_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `city`
--
ALTER TABLE `city`
  ADD CONSTRAINT `city_ibfk_1` FOREIGN KEY (`idprovince`) REFERENCES `province` (`id`);

--
-- Constraints for table `department`
--
ALTER TABLE `department`
  ADD CONSTRAINT `department_ibfk_1` FOREIGN KEY (`iddivisi`) REFERENCES `divisi` (`id`);

--
-- Constraints for table `holding_company`
--
ALTER TABLE `holding_company`
  ADD CONSTRAINT `holding_company_ibfk_1` FOREIGN KEY (`idcity`) REFERENCES `city` (`id`),
  ADD CONSTRAINT `holding_company_ibfk_2` FOREIGN KEY (`idcountry`) REFERENCES `country` (`id`),
  ADD CONSTRAINT `holding_company_ibfk_3` FOREIGN KEY (`idprovince`) REFERENCES `province` (`id`);

--
-- Constraints for table `province`
--
ALTER TABLE `province`
  ADD CONSTRAINT `province_ibfk_1` FOREIGN KEY (`idcountry`) REFERENCES `country` (`id`);

--
-- Constraints for table `ruangan`
--
ALTER TABLE `ruangan`
  ADD CONSTRAINT `ruangan_ibfk_1` FOREIGN KEY (`pic_ruangan`) REFERENCES `karyawan` (`nik`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
