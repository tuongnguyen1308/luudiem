-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2020 at 08:14 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbmau6`
--

-- --------------------------------------------------------

--
-- Table structure for table `dm_chucdanh`
--

CREATE TABLE `dm_chucdanh` (
  `PK_iMaCD` int(11) NOT NULL,
  `sChucDanh` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sTenVietTat` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `dm_chucdanh`
--

INSERT INTO `dm_chucdanh` (`PK_iMaCD`, `sChucDanh`, `sTenVietTat`) VALUES
(1, 'Giáo sư', 'GS'),
(2, 'Phó giáo sư', 'PGS');

-- --------------------------------------------------------

--
-- Table structure for table `dm_dantoc`
--

CREATE TABLE `dm_dantoc` (
  `PK_iMaDanToc` int(11) NOT NULL,
  `sTenDanToc` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `dm_dantoc`
--

INSERT INTO `dm_dantoc` (`PK_iMaDanToc`, `sTenDanToc`) VALUES
(1, 'Kinh'),
(2, 'Tày'),
(3, 'Thái'),
(4, 'Mường'),
(5, 'Khơ Me'),
(6, 'H''Mông'),
(7, 'Nùng'),
(8, 'Hoa'),
(9, 'Dao'),
(10, 'Gia Rai'),
(11, 'Ê Đê'),
(12, 'Ba Na'),
(13, 'Xơ Đăng'),
(14, 'Sán Chay'),
(15, 'Cơ Ho'),
(16, 'Chăm'),
(17, 'Sán Dìu'),
(18, 'Hrê'),
(19, 'Ra Glai'),
(20, 'M''Nông'),
(21, 'X’Tiêng'),
(22, 'Bru-Vân Kiều'),
(23, 'Thổ'),
(24, 'Khơ Mú'),
(25, 'Cơ Tu'),
(26, 'Giáy'),
(27, 'Giẻ Triêng'),
(28, 'Tà Ôi'),
(29, 'Mạ'),
(30, 'Co'),
(31, 'Chơ Ro'),
(32, 'Xinh Mun'),
(33, 'Hà Nhì'),
(34, 'Chu Ru'),
(35, 'Lào'),
(36, 'Kháng'),
(37, 'La Chí'),
(38, 'Phú Lá'),
(39, 'La Hủ'),
(40, 'La Ha'),
(41, 'Pà Thẻn'),
(42, 'Chứt'),
(43, 'Lự'),
(44, 'Lô Lô'),
(45, 'Mảng'),
(46, 'Cờ Lao'),
(47, 'Bố Y'),
(48, 'Cống'),
(49, 'Ngái'),
(50, 'Si La'),
(51, 'Pu Péo'),
(52, 'Rơ măm'),
(53, 'Brâu'),
(54, 'Ơ Đu'),
(55, 'Khác');

-- --------------------------------------------------------

--
-- Table structure for table `dm_doituong`
--

CREATE TABLE `dm_doituong` (
  `PK_iMaDoiTuong` int(11) NOT NULL,
  `sTenDoiTuong` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sVietTatDT` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `dm_doituong`
--

INSERT INTO `dm_doituong` (`PK_iMaDoiTuong`, `sTenDoiTuong`, `sVietTatDT`) VALUES
(1, 'Giảng viên', 'GV'),
(2, 'Giảng viên thỉnh giảng', 'GVTG');

-- --------------------------------------------------------

--
-- Table structure for table `dm_nganh`
--

CREATE TABLE `dm_nganh` (
  `PK_iMaNganh` int(11) NOT NULL,
  `sTenNganh` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sGhiChu` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `dm_nganh`
--

INSERT INTO `dm_nganh` (`PK_iMaNganh`, `sTenNganh`, `sGhiChu`) VALUES
(1, '1. Chăn nuôi-Thú y-Thủy sản', 'http://hdgsnn.gov.vn/hdgsnn1/'),
(2, '2. Cơ học', 'http://hdgsnn.gov.vn/dkhstt/'),
(3, '3. Cơ khí-Động lực', 'http://hdgsnn.gov.vn/hdgsnn1/'),
(4, '4. Công nghệ Thông tin', 'http://hdgsnn.gov.vn/dkhstt/'),
(5, '5. Dược học', 'http://hdgsnn.gov.vn/hdgsnn1/'),
(6, '6. Điện-Điện tử-Tự động hóa', 'http://hdgsnn.gov.vn/hdgsnn1/'),
(7, '7. Giao thông Vận tải', 'http://hdgsnn.gov.vn/hdgsnn1/'),
(8, '8. Giáo dục học', 'http://hdgsnn.gov.vn/hdgsnn1/'),
(9, '9. Hóa học-Công nghệ thực phẩm', 'http://hdgsnn.gov.vn/hdgsnn1/'),
(10, '10. Khoa học An ninh', 'http://hdgsnn.gov.vn/hdgsnn1/'),
(11, '11. Khoa học Quân sự', 'http://hdgsnn.gov.vn/hdgsnn1/'),
(12, '12. Khoa học Trái đất-Mỏ', 'http://hdgsnn.gov.vn/hdgsnn1/'),
(13, '13. Kinh tế', 'http://hdgsnn.gov.vn/hdgsnn1/'),
(14, '14. Luật học', 'http://hdgsnn.gov.vn/hdgsnn1/'),
(15, '15. Luyện kim', 'http://hdgsnn.gov.vn/hdgsnn1/'),
(16, '16. Ngôn ngữ học', 'http://hdgsnn.gov.vn/hdgsnn1/'),
(17, '17. Nông nghiệp-Lâm nghiệp', 'http://hdgsnn.gov.vn/hdgsnn1/'),
(18, '18. Sinh học', 'http://hdgsnn.gov.vn/hdgsnn1/'),
(19, '19. Sử học-Khảo cổ học-Dân tộc học', 'http://hdgsnn.gov.vn/hdgsnn1/'),
(20, '20. Tâm lý học', 'http://hdgsnn.gov.vn/hdgsnn1/'),
(21, '21. Thủy lợi', 'http://hdgsnn.gov.vn/dkhstt/'),
(22, '22. Toán học', 'http://hdgsnn.gov.vn/dkhstt/'),
(23, '23. Triết học-Xã hội học-Chính trị học', 'http://hdgsnn.gov.vn/hdgsnn1/'),
(24, '24. Văn hóa-Nghệ thuật-Thể dục Thể thao', 'http://hdgsnn.gov.vn/hdgsnn1/'),
(25, '25. Văn học', 'http://hdgsnn.gov.vn/hdgsnn1/'),
(26, '26. Vật lý', 'http://hdgsnn.gov.vn/dkhstt/'),
(27, '27. Xây dựng-Kiến trúc', 'http://hdgsnn.gov.vn/hdgsnn1/'),
(28, '28. Y học', 'http://hdgsnn.gov.vn/hdgsnn1/');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kqtd`
--

CREATE TABLE `tbl_kqtd` (
  `PK_iMaKQTD` int(11) NOT NULL,
  `FK_iMaDoiTuong` int(11) DEFAULT NULL,
  `sNoiTG` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sBangDH` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sBangThS` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sBangTS` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sBangTSKH` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sCongNhanPGS` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `iTongSoThoiGian` int(11) DEFAULT NULL,
  `sNamThuNhat` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sNamThuHai` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sNamThuBa` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sNamThuTu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sNamThuNam` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sNamThuSau` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sHuongDanNCSChinh` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sHuongDanNCSPhu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sHuongDanHVCHChinh` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sNhiemVuKhoaHoc` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sBBKhaiTrenTong` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sBBUyTin` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sBBConLai` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sSangChe` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sTongSoDiemBBSC` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `iSoLuongBBUyTinSauPGS` int(11) DEFAULT NULL,
  `FK_iMaTK` int(11) DEFAULT NULL,
  `FK_iMaUV` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_nhanxet`
--

CREATE TABLE `tbl_nhanxet` (
  `PK_iMaNhanXet` bigint(20) NOT NULL,
  `FK_iMaKQTD` int(11) DEFAULT NULL,
  `sUuDiem` text COLLATE utf8_unicode_ci,
  `sNhuocDiem` text COLLATE utf8_unicode_ci,
  `sDanhGiaChung` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sach`
--

CREATE TABLE `tbl_sach` (
  `PK_iMaSach` bigint(20) NOT NULL,
  `sLoaiSach` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sTenSach` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `iSoTacGia` int(11) DEFAULT NULL,
  `iSoDiem` int(11) DEFAULT NULL,
  `iDiemBaNamCuoi` int(11) DEFAULT NULL,
  `FK_iMaKQTD` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_taikhoan`
--

CREATE TABLE `tbl_taikhoan` (
  `PK_iMaTK` int(11) NOT NULL,
  `sUsername` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `sPassword` text COLLATE utf8_unicode_ci NOT NULL,
  `sHoTen` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FK_iMaCD` int(11) DEFAULT NULL,
  `FK_iMaNganh` int(11) DEFAULT NULL,
  `sChuyenNganh` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_taikhoan`
--

INSERT INTO `tbl_taikhoan` (`PK_iMaTK`, `sUsername`, `sPassword`, `sHoTen`, `FK_iMaCD`, `FK_iMaNganh`, `sChuyenNganh`) VALUES
(1, 'admin', '356a192b7913b04c54574d18c28d46e6395428ab', 'Nguyễn Đình Admin', 2, 4, 'Công nghệ phầm mền');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_thongtinungvien`
--

CREATE TABLE `tbl_thongtinungvien` (
  `PK_iMaUV` int(11) NOT NULL,
  `sChucVuXetTuyen` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FK_iMaNganh` int(11) DEFAULT NULL,
  `sChuyenNganh` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sHoTen` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dNgaySinh` date DEFAULT NULL,
  `sGioiTinh` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FK_iMaDanToc` int(11) DEFAULT NULL,
  `sQueQuan` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sCoQuan` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sCoSoXetChucDanh` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tonghop`
--

CREATE TABLE `tbl_tonghop` (
  `PK_iMaTongHop` bigint(20) NOT NULL,
  `FK_iMaKQTD` int(11) DEFAULT NULL,
  `iSoDiemSach` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `iSoDiemSach3` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `iSoDiemConLai` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `iSoDiemConLai3` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `iDiemTongCong` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `iDiemTongCong3` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `iTongCongSauPGS` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sNamThieuPGS` text COLLATE utf8_unicode_ci,
  `sNamThieuTNDT` text COLLATE utf8_unicode_ci,
  `sGioGiangDay` text COLLATE utf8_unicode_ci,
  `sHuongDanChinh` text COLLATE utf8_unicode_ci,
  `sChuTriNVB` text COLLATE utf8_unicode_ci,
  `sChuTriNVCS` text COLLATE utf8_unicode_ci,
  `iCTKH3` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `iCTKH4` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `iCTKH2` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sThayTheCTKH5` text COLLATE utf8_unicode_ci,
  `sThayTheCTKH3` text COLLATE utf8_unicode_ci,
  `sTongDiemBienSoanSach` text COLLATE utf8_unicode_ci,
  `sSoDiemBienSoanGTCK` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dm_chucdanh`
--
ALTER TABLE `dm_chucdanh`
  ADD PRIMARY KEY (`PK_iMaCD`);

--
-- Indexes for table `dm_dantoc`
--
ALTER TABLE `dm_dantoc`
  ADD PRIMARY KEY (`PK_iMaDanToc`);

--
-- Indexes for table `dm_doituong`
--
ALTER TABLE `dm_doituong`
  ADD PRIMARY KEY (`PK_iMaDoiTuong`);

--
-- Indexes for table `dm_nganh`
--
ALTER TABLE `dm_nganh`
  ADD PRIMARY KEY (`PK_iMaNganh`);

--
-- Indexes for table `tbl_kqtd`
--
ALTER TABLE `tbl_kqtd`
  ADD PRIMARY KEY (`PK_iMaKQTD`),
  ADD KEY `FK_sUsername` (`FK_iMaTK`),
  ADD KEY `FK_iMaUV` (`FK_iMaUV`),
  ADD KEY `FK_iMaDoiTuong` (`FK_iMaDoiTuong`);

--
-- Indexes for table `tbl_nhanxet`
--
ALTER TABLE `tbl_nhanxet`
  ADD PRIMARY KEY (`PK_iMaNhanXet`),
  ADD KEY `FK_iMaKQTD` (`FK_iMaKQTD`);

--
-- Indexes for table `tbl_sach`
--
ALTER TABLE `tbl_sach`
  ADD PRIMARY KEY (`PK_iMaSach`),
  ADD KEY `FK_iMaKQTD` (`FK_iMaKQTD`);

--
-- Indexes for table `tbl_taikhoan`
--
ALTER TABLE `tbl_taikhoan`
  ADD PRIMARY KEY (`PK_iMaTK`),
  ADD KEY `FK_iMaCD` (`FK_iMaCD`,`FK_iMaNganh`),
  ADD KEY `FK_iMaNganh` (`FK_iMaNganh`);

--
-- Indexes for table `tbl_thongtinungvien`
--
ALTER TABLE `tbl_thongtinungvien`
  ADD PRIMARY KEY (`PK_iMaUV`),
  ADD KEY `FK_iMaDanToc` (`FK_iMaDanToc`),
  ADD KEY `FK_iMaDanToc_2` (`FK_iMaDanToc`),
  ADD KEY `FK_iMaNganh` (`FK_iMaNganh`);

--
-- Indexes for table `tbl_tonghop`
--
ALTER TABLE `tbl_tonghop`
  ADD PRIMARY KEY (`PK_iMaTongHop`),
  ADD KEY `FK_iMaKQTD` (`FK_iMaKQTD`),
  ADD KEY `FK_iMaKQTD_2` (`FK_iMaKQTD`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_kqtd`
--
ALTER TABLE `tbl_kqtd`
  ADD CONSTRAINT `tbl_kqtd_ibfk_1` FOREIGN KEY (`FK_iMaUV`) REFERENCES `tbl_thongtinungvien` (`PK_iMaUV`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_kqtd_ibfk_2` FOREIGN KEY (`FK_iMaTK`) REFERENCES `tbl_taikhoan` (`PK_iMaTK`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_kqtd_ibfk_3` FOREIGN KEY (`FK_iMaDoiTuong`) REFERENCES `dm_doituong` (`PK_iMaDoiTuong`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_nhanxet`
--
ALTER TABLE `tbl_nhanxet`
  ADD CONSTRAINT `tbl_nhanxet_ibfk_1` FOREIGN KEY (`FK_iMaKQTD`) REFERENCES `tbl_kqtd` (`PK_iMaKQTD`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_sach`
--
ALTER TABLE `tbl_sach`
  ADD CONSTRAINT `tbl_sach_ibfk_1` FOREIGN KEY (`FK_iMaKQTD`) REFERENCES `tbl_kqtd` (`PK_iMaKQTD`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_taikhoan`
--
ALTER TABLE `tbl_taikhoan`
  ADD CONSTRAINT `tbl_taikhoan_ibfk_1` FOREIGN KEY (`FK_iMaCD`) REFERENCES `dm_chucdanh` (`PK_iMaCD`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_taikhoan_ibfk_2` FOREIGN KEY (`FK_iMaNganh`) REFERENCES `dm_nganh` (`PK_iMaNganh`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_thongtinungvien`
--
ALTER TABLE `tbl_thongtinungvien`
  ADD CONSTRAINT `tbl_thongtinungvien_ibfk_1` FOREIGN KEY (`FK_iMaNganh`) REFERENCES `dm_nganh` (`PK_iMaNganh`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_thongtinungvien_ibfk_2` FOREIGN KEY (`FK_iMaDanToc`) REFERENCES `dm_dantoc` (`PK_iMaDanToc`) ON UPDATE CASCADE;

--
-- Constraints for table `tbl_tonghop`
--
ALTER TABLE `tbl_tonghop`
  ADD CONSTRAINT `tbl_tonghop_ibfk_1` FOREIGN KEY (`FK_iMaKQTD`) REFERENCES `tbl_kqtd` (`PK_iMaKQTD`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
