-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 06, 2024 at 06:13 PM
-- Server version: 8.0.31
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `schoolpersonnelmanagement`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `createEmployee` (IN `p_fullName` TEXT, IN `p_birthday` DATE, IN `p_gender` TEXT, IN `p_email` VARCHAR(30), IN `p_address` TEXT, IN `p_phone` VARCHAR(11), IN `p_username` VARCHAR(20), IN `p_departmentID` INT, IN `p_positionID` INT, IN `p_imgPath` TEXT, IN `p_status` VARCHAR(155))   BEGIN
    DECLARE v_userID INT;
    
    INSERT INTO users (FullName, Birthday, Gender, Email, Address, Phone, Username, Password, PositionID, DeptID,Status)
    VALUES (p_fullName, p_birthday, p_gender, p_email, p_address, p_phone, p_username, MD5(RIGHT(p_phone, 6)), p_positionID, p_departmentID,p_status);
	SET v_userID = LAST_INSERT_ID();
    INSERT INTO img (UserID, Url) VALUES (v_userID, p_imgPath);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertTimesheetAndSalary` (IN `p_sDate` DATE, IN `p_workedDay` INT, IN `p_authorizedAbsences` INT, IN `p_unauthorizedAbsence` INT, IN `p_userID` INT, IN `p_basic` DECIMAL, IN `p_allowance` DECIMAL, IN `p_advance` DECIMAL, IN `p_total` DECIMAL)   BEGIN
    DECLARE lastSheetID INT;

    INSERT INTO Timesheet (SDate, WorkedDay, AuthorizedAbsences, UnauthorizedAbsences, UserID)
    VALUES (p_sDate, p_workedDay, p_authorizedAbsences, p_unauthorizedAbsence, p_userID);

    SET lastSheetID = LAST_INSERT_ID();

    INSERT INTO salary (SheetID, Basic, Allowance, Advance, Total, SDate, UserID)
    VALUES (lastSheetID, p_basic, p_allowance, p_advance, p_total, p_sDate, p_userID);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `degree`
--

CREATE TABLE `degree` (
  `DegreeID` int NOT NULL,
  `DegreeName` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `GrantedDate` date DEFAULT NULL,
  `Unit` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `UserID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `degree`
--

INSERT INTO `degree` (`DegreeID`, `DegreeName`, `GrantedDate`, `Unit`, `UserID`) VALUES
(2, 'Bằng Thạc sĩ công nghệ thông tin', '2008-04-02', 'Trường đại học bách khoa Thành phố Hồ Chí Minh', 10),
(3, NULL, NULL, NULL, 3),
(4, 'Bẵng kỹ sư', '2024-05-29', 'Trường đại học công thương', 3),
(5, 'Bẵng kỹ sư', '2024-05-29', 'Trường đại học công thương', 1);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `DeptID` int NOT NULL,
  `DeptName` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `People` int DEFAULT '0',
  `Location` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`DeptID`, `DeptName`, `People`, `Location`) VALUES
(1, 'Ban giám hiệu', 4, 'Tầng 2'),
(2, 'Phòng hành chính', 4, 'Tầng 1'),
(6, 'Phòng đào tạo', 1, 'Tầng 3 dãy c, 144 Lê trọng tấn'),
(7, 'Phòng khoa công nghệ thông tin', 3, 'Tầng 2 dãy c cơ sở 144 Lê trọng tấn'),
(8, 'Phòng tài chính', 2, 'Tầng 4 dãy A cơ sở 144 Lê trọng tấn'),
(10, 'phòng văn nghệ', 2, 'Tầng 3 dãy A, 144 Lê trọng tấn'),
(11, 'phòng âm nhạc', 0, '302 dãy A, 144 Lê trọng tấn');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `EmployeeID` int NOT NULL,
  `UserID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`EmployeeID`, `UserID`) VALUES
(1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `img`
--

CREATE TABLE `img` (
  `ImgID` int NOT NULL,
  `Url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `Comment` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Ảnh thẻ',
  `UserID` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `img`
--

INSERT INTO `img` (`ImgID`, `Url`, `Comment`, `UserID`) VALUES
(1, 'nv1.jpg\r\n', 'Ảnh thẻ', 1),
(2, 'nv1.jpg', 'Ảnh thẻ', 2),
(3, 'nv1.jpg', 'Ảnh thẻ', 3),
(4, 'nv1.jpg', 'Ảnh thẻ', 10),
(5, 'thang124.jpg', 'Ảnh thẻ', 11),
(6, 'nv1.jpg', 'Ảnh thẻ', 13),
(8, 'nv2.jpg', 'Ảnh thẻ', 15),
(9, 'download.jpg', 'Ảnh thẻ', 16),
(10, 'nv1.jpg', 'Ảnh thẻ', 17),
(32, '92ec2117ad8042de1b91.jpg', 'Ảnh thẻ', 39),
(33, '92ec2117ad8042de1b91.jpg', 'Ảnh thẻ', 41),
(34, 'thang124.jpg', 'Ảnh thẻ', 42),
(37, 'nv1.jpg', 'Ảnh thẻ', 43),
(38, 'thang124.jpg', 'Ảnh thẻ', 44);

-- --------------------------------------------------------

--
-- Table structure for table `insurance`
--

CREATE TABLE `insurance` (
  `InsuranceID` int NOT NULL,
  `PayDate` date DEFAULT NULL,
  `GrantBy` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Cơ quan Bảo hiểm Xã hội Việt Nam',
  `UserID` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `insurance`
--

INSERT INTO `insurance` (`InsuranceID`, `PayDate`, `GrantBy`, `UserID`) VALUES
(1, '2024-03-07', 'Cơ quan Bảo hiểm Xã hội Việt Nam', 2),
(2, '2024-03-06', 'Cơ quan Bảo hiểm Xã hội Việt Nam', 3),
(3, '2024-04-12', 'Cơ quan Bảo hiểm Xã hội Việt Nam', 1);

-- --------------------------------------------------------

--
-- Table structure for table `laborcontract`
--

CREATE TABLE `laborcontract` (
  `LaborID` int NOT NULL,
  `LaborName` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Hợp đồng lao động',
  `SignDay` date DEFAULT NULL,
  `StartDate` date DEFAULT NULL,
  `EndDate` date DEFAULT NULL,
  `UserID` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `laborcontract`
--

INSERT INTO `laborcontract` (`LaborID`, `LaborName`, `SignDay`, `StartDate`, `EndDate`, `UserID`) VALUES
(1, 'Hợp đồng lao động', '2022-12-01', '2022-12-01', '2026-02-07', 2),
(2, 'Hợp đồng lao động', '2023-07-01', '2023-07-01', '2028-07-01', 1),
(3, 'Hợp đồng lao động', '2023-01-04', '2023-01-04', '2024-01-13', 3);

-- --------------------------------------------------------

--
-- Table structure for table `leaveapplicationsheet`
--

CREATE TABLE `leaveapplicationsheet` (
  `LSheetID` int NOT NULL,
  `Type` text COLLATE utf8mb4_general_ci NOT NULL,
  `StartDate` date NOT NULL,
  `EndDate` date NOT NULL,
  `Reason` text COLLATE utf8mb4_general_ci NOT NULL,
  `LStatus` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Wait for confirmation',
  `UserID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leaveapplicationsheet`
--

INSERT INTO `leaveapplicationsheet` (`LSheetID`, `Type`, `StartDate`, `EndDate`, `Reason`, `LStatus`, `UserID`) VALUES
(1, 'Nghỉ bệnh', '2024-05-07', '2024-05-07', 'Tôi bị cảm sốt', 'Confirmed', 15),
(2, 'Nghỉ bệnh', '2024-05-18', '2024-05-20', 'Tôi có công việc bận nên cần về quê gắp', 'Confirmed', 16),
(3, 'Nghỉ bệnh', '2024-06-05', '2024-06-06', 'Tôi cần đi khám bệnh', 'Wait for confirmation', 16);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('vnn159357@gmail.com', 'a71ba01f457d1f1fe6894403bc1dda1780ac8a4551e4a9f7b92397595cb2c0749ba8471cf8e7f4083001b9db14b67d9d6cc9', '2024-06-04 07:07:12');

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `PositionID` int NOT NULL,
  `PositionName` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`PositionID`, `PositionName`) VALUES
(1, 'Hiệu trưởng'),
(2, 'Phó hiệu trưởng'),
(3, 'Giáo viên'),
(4, 'Nhân viên'),
(7, 'Thư kí');

-- --------------------------------------------------------

--
-- Table structure for table `rate`
--

CREATE TABLE `rate` (
  `RateID` int NOT NULL,
  `Classifiled` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `RDate` date DEFAULT NULL,
  `Reason` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `UserID` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rate`
--

INSERT INTO `rate` (`RateID`, `Classifiled`, `RDate`, `Reason`, `UserID`) VALUES
(1, 'Khen thưởng', '2024-01-03', 'Tích cực làm việc và có được sự ủng hộ từ mọi người', 3),
(2, 'Khen thưởng', '2024-04-18', 'zzzz', 1),
(3, 'Khen thưởng', '2024-04-25', 'Tích cực trong phong trào đoàn hội', 10),
(4, 'Khen thưởng', '2024-04-22', 'zzzzaaa', 13),
(6, 'Kỹ luật', '2024-04-28', 'Đi trễ 30 phút', 13),
(7, 'Kỹ luật', '2024-06-16', 'Đi trễ 1h', 1),
(8, 'Khen thưởng', '2024-05-20', 'Thực hiện tốt công tác đoàn hội', 16),
(9, 'Khen thưởng', '2024-06-05', 'Thực hành tốt nội quy', 44);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `RoleID` int NOT NULL,
  `RoleName` text COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`RoleID`, `RoleName`) VALUES
(1, 'User'),
(2, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE `salary` (
  `SalaryID` int NOT NULL,
  `Basic` float DEFAULT NULL,
  `Allowance` float DEFAULT NULL,
  `Advance` float DEFAULT NULL,
  `Total` float DEFAULT NULL,
  `SDate` date DEFAULT NULL,
  `UserID` int DEFAULT NULL,
  `Payday` date DEFAULT NULL,
  `Status` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Chưa thanh toán',
  `SheetID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `salary`
--

INSERT INTO `salary` (`SalaryID`, `Basic`, `Allowance`, `Advance`, `Total`, `SDate`, `UserID`, `Payday`, `Status`, `SheetID`) VALUES
(23, 8000000, 600000, 1000000, 7600000, '2024-05-04', 15, NULL, 'Chưa thanh toán', 22),
(24, 8000000, 600000, 2000000, 6600000, '2024-04-08', 15, NULL, 'Chưa thanh toán', 23),
(25, 8000000, 500000, 500000, 8000000, '2024-05-13', 10, NULL, 'Chưa thanh toán', 24),
(26, 6000000, 500000, 500000, 7000000, '2024-03-12', 11, NULL, 'Chưa thanh toán', 25),
(27, 7000000, 500000, 0, 7500000, '2024-04-11', 1, NULL, 'Chưa thanh toán', 26);

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `ScheduleID` int NOT NULL,
  `StartDate` date DEFAULT NULL,
  `EndDate` date DEFAULT NULL,
  `WorkPlace` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `Descriptions` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `UserID` int DEFAULT NULL
) ;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`ScheduleID`, `StartDate`, `EndDate`, `WorkPlace`, `Descriptions`, `UserID`) VALUES
(1, '2024-04-23', '2024-04-27', 'Khoa hành chính', 'Lịch làm', 3),
(3, '2024-04-28', '2024-05-11', 'Cần thơ', 'Khảo sát địa bàn dự án sắp tơi', 1),
(4, '2024-05-04', '2024-05-15', 'Tiền giang', 'Dự hội nghị', 1),
(5, '2024-05-05', '2024-05-10', 'Tiền giang', 'Đi dự hội nghị đồng bằng sông cửu long', 15),
(6, '2024-06-01', '2024-06-08', 'Cần thơ', 'Tham dự cuộc thi tại trường đại học Cần Thơ', 15),
(7, '2024-05-03', '2024-05-08', 'Hà nội', 'gặp mặt đối tác tại Hà Nội', 15),
(8, '2024-05-02', '2024-05-03', 'An giang', 'Đi khảo sát một số thông tin', 15),
(9, '2024-06-04', '2024-06-07', 'Cần thơ', 'Khảo sát hội nghị truyền thông', 42);

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `TeacherID` int NOT NULL,
  `Class` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `UserID` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`TeacherID`, `Class`, `UserID`) VALUES
(1, 'Lớp 10A1', 2);

-- --------------------------------------------------------

--
-- Table structure for table `timesheet`
--

CREATE TABLE `timesheet` (
  `SheetID` int NOT NULL,
  `SDate` date DEFAULT NULL,
  `WorkedDay` int DEFAULT NULL,
  `AuthorizedAbsences` int DEFAULT NULL,
  `UnauthorizedAbsences` int DEFAULT NULL,
  `UserID` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `timesheet`
--

INSERT INTO `timesheet` (`SheetID`, `SDate`, `WorkedDay`, `AuthorizedAbsences`, `UnauthorizedAbsences`, `UserID`) VALUES
(22, '2024-05-04', 26, 0, 0, 15),
(23, '2024-04-08', 27, 0, 0, 15),
(24, '2024-05-13', 26, 0, 0, 10),
(25, '2024-03-12', 26, 0, 0, 11),
(26, '2024-04-11', 26, 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int NOT NULL,
  `FullName` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Birthday` date DEFAULT NULL,
  `Gender` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Email` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Phone` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Username` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Role` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'User',
  `Status` varchar(155) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Đang làm việc',
  `PositionID` int NOT NULL,
  `DeptID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `FullName`, `Birthday`, `Gender`, `Email`, `Address`, `Phone`, `Username`, `Password`, `Role`, `Status`, `PositionID`, `DeptID`) VALUES
(1, 'Đinh Thị Hoa', '1995-04-18', 'Nữ', 'abczyxe@gmail.com', '102 đường Lê Trọng Tấn, quận Tân Phú,TPHCM', '09093322569', 'aaabbbccc', 'aaabbbccc', 'User\r\n', 'Đang làm việc', 1, 1),
(2, 'Phạm Thanh Ngọc', '1999-02-10', 'Nam', 'thanhngoc1122@gmail.com', '35 Chu Văn An, quận 6, TPHCM', '0987654321', 'ngocphamtnt', '0987654321', 'User', 'Đang làm việc', 3, 2),
(3, 'Nguyễn Thanh Mai', '1999-01-13', 'Nữ', 'Mainguyen@gmail.com', '11 Ngô Bệ, quận Tân Bình, TPHCM', '0938113413', 'usermai', '0938113413', 'User', 'Đang làm việc', 4, 1),
(10, 'Nguyễn Huy Hoàng', '2000-01-04', 'Nam', 'Hoangst123@gmail.com', '124 Trần phú, hồ chí minh', '0912841256', 'admin', 'fcea920f7412b5da7be0cf42b8c93759', 'Admin', 'Đang làm việc', 1, 1),
(11, 'Trương quốc huy', '1999-02-10', 'Nam', 'huy@gmail.com', '22 Lê trọng tấn', '091111455', 'huy2222', 'e10adc3949ba59abbe56e057f20f883e', 'Admin', 'Đang làm việc', 4, 1),
(13, 'Vương kim dinh', '2002-01-02', 'Nam', 'VanTho2011@gmail.com', '266 Nguyễn trí thanh TPHCM', '0241421233', 'zing12', 'e10adc3949ba59abbe56e057f20f883e', 'User', 'Đã nghỉ việc', 4, 7),
(15, 'Trần Thị Trúc', '2000-04-11', 'Female', 'Tructran@gmail.com', '22 Đinh tiên hoàng TP HCM ', '0356171716', 'tructran41', 'e10adc3949ba59abbe56e057f20f883e', 'User', 'Thực tập', 3, 10),
(16, 'Hà trọng thắng', '1994-04-18', 'Nam', 'nguyenhuyhoang05102018@gmail.com', '141 Trần hưng đạo', '0983421452', 'trongthang41', 'e10adc3949ba59abbe56e057f20f883e', 'User', 'Thực tập', 4, 8),
(17, 'Nguyễn Minh Hoàng', '2003-05-22', 'Nam', 'Minhhoang12222@gmail.com', '166 Lê Trọng Tấn', '21244441', 'hoangminh22', 'f0ffb1c4ecb04eb8b49deeca11f950a1', 'User', 'Thực tập', 3, 7),
(39, 'Trần thị na', '2000-05-07', 'Nam', 'nathi@gmail.com', '141 Lê trọng tấn', '0515223712', 'Nathi2', '39bc211a89ed0f48f6ae1cc8b2bfd49d', 'User', 'Thực tập', 1, 2),
(41, 'Nguyễn Minh Hoàng 2', '2000-05-17', 'Nam', 'Minhhoang12222@gmail.com', '176 Lê Trọng Tấn', '0925161100', 'minhhon22', '3c5ecd26206e5ec9f0884e984917544a', 'User', 'Đã nghỉ việc', 3, 7),
(42, 'Hà trọng thắng', '2000-05-01', 'Nam', 'centoscashflow@gmail.com', '141 Trần hưng đạo', '0983421122', 'thangtrong12345', 'e557b1212cf885ec98a4e21c379eaac5', 'User', 'Đang làm việc', 4, 6),
(43, 'Trần thị nai', '1990-01-01', 'Nữ', 'Nathi@gmail.com', '412 Trần hưng đạo', '123456789', 'johndoe', 'e35cf7b66449df565f93c607d5a81d09', 'User', 'Đang làm việc', 2, 1),
(44, 'Nguyễn minh thư', '2000-06-13', 'Nam', 'vnn159357@gmail.com', '141 Trần hưng đạo', '0983421122', 'thangtrong12345', 'e557b1212cf885ec98a4e21c379eaac5', 'User', 'Đang làm việc', 3, 8);

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `update_people_in_department` AFTER INSERT ON `users` FOR EACH ROW UPDATE department
SET people = people + 1
WHERE DeptID = NEW.DeptID
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `degree`
--
ALTER TABLE `degree`
  ADD PRIMARY KEY (`DegreeID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`DeptID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`EmployeeID`),
  ADD UNIQUE KEY `UserID_2` (`UserID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `img`
--
ALTER TABLE `img`
  ADD PRIMARY KEY (`ImgID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `insurance`
--
ALTER TABLE `insurance`
  ADD PRIMARY KEY (`InsuranceID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `laborcontract`
--
ALTER TABLE `laborcontract`
  ADD PRIMARY KEY (`LaborID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `leaveapplicationsheet`
--
ALTER TABLE `leaveapplicationsheet`
  ADD PRIMARY KEY (`LSheetID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`PositionID`);

--
-- Indexes for table `rate`
--
ALTER TABLE `rate`
  ADD PRIMARY KEY (`RateID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`RoleID`);

--
-- Indexes for table `salary`
--
ALTER TABLE `salary`
  ADD PRIMARY KEY (`SalaryID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `SheetID` (`SheetID`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`ScheduleID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`TeacherID`),
  ADD UNIQUE KEY `UserID_2` (`UserID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `timesheet`
--
ALTER TABLE `timesheet`
  ADD PRIMARY KEY (`SheetID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD KEY `PositionID` (`PositionID`),
  ADD KEY `DeptID` (`DeptID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `degree`
--
ALTER TABLE `degree`
  MODIFY `DegreeID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `DeptID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `EmployeeID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `img`
--
ALTER TABLE `img`
  MODIFY `ImgID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `insurance`
--
ALTER TABLE `insurance`
  MODIFY `InsuranceID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `laborcontract`
--
ALTER TABLE `laborcontract`
  MODIFY `LaborID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `leaveapplicationsheet`
--
ALTER TABLE `leaveapplicationsheet`
  MODIFY `LSheetID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `PositionID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `rate`
--
ALTER TABLE `rate`
  MODIFY `RateID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `RoleID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `salary`
--
ALTER TABLE `salary`
  MODIFY `SalaryID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `ScheduleID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `TeacherID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `timesheet`
--
ALTER TABLE `timesheet`
  MODIFY `SheetID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `degree`
--
ALTER TABLE `degree`
  ADD CONSTRAINT `degree_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `img`
--
ALTER TABLE `img`
  ADD CONSTRAINT `img_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `insurance`
--
ALTER TABLE `insurance`
  ADD CONSTRAINT `insurance_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `laborcontract`
--
ALTER TABLE `laborcontract`
  ADD CONSTRAINT `laborcontract_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `leaveapplicationsheet`
--
ALTER TABLE `leaveapplicationsheet`
  ADD CONSTRAINT `leaveapplicationsheet_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rate`
--
ALTER TABLE `rate`
  ADD CONSTRAINT `rate_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `salary`
--
ALTER TABLE `salary`
  ADD CONSTRAINT `salary_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `salary_ibfk_2` FOREIGN KEY (`SheetID`) REFERENCES `timesheet` (`SheetID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teacher`
--
ALTER TABLE `teacher`
  ADD CONSTRAINT `teacher_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `timesheet`
--
ALTER TABLE `timesheet`
  ADD CONSTRAINT `timesheet_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`PositionID`) REFERENCES `position` (`PositionID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`DeptID`) REFERENCES `department` (`DeptID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
