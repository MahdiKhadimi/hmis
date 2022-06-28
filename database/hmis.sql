-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2022 at 02:39 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hmis`
--

-- --------------------------------------------------------

--
-- Table structure for table `admit`
--

CREATE TABLE `admit` (
  `admit_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `in_date` date NOT NULL,
  `out_date` date DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admit`
--

INSERT INTO `admit` (`admit_id`, `patient_id`, `room_id`, `in_date`, `out_date`, `status`) VALUES
(6, 8, 1, '2022-06-20', '2022-06-20', 'needed'),
(7, 4, 1, '2022-06-20', '2022-06-20', 'needed');

-- --------------------------------------------------------

--
-- Table structure for table `advertisement`
--

CREATE TABLE `advertisement` (
  `advertisement_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `description` text DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `photo` varchar(128) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `advertisement`
--

INSERT INTO `advertisement` (`advertisement_id`, `title`, `description`, `url`, `photo`, `start_date`, `end_date`) VALUES
(3, 'this is for you', '                                                                        \r\n				Video provides a powerful way to help you prove your point. When you click Online Video, you can paste in the embed code for the video you want to add. You can also type a keyword to search online for the video that best fits your document.\r\nTo make your document look professionally produced, Word \r\n \r\n\r\n																', 'some.html', '../../images/advertisement/1656332582teeth1 (3).jpg', '2022-06-25', '2022-07-25');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `appointment_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `staff_id` int(11) NOT NULL,
  `absent_year` int(11) NOT NULL,
  `absent_month` int(11) NOT NULL,
  `absent_day` int(11) NOT NULL,
  `hours` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`staff_id`, `absent_year`, `absent_month`, `absent_day`, `hours`) VALUES
(2, 2022, 6, 17, 4);

-- --------------------------------------------------------

--
-- Table structure for table `blood_bank`
--

CREATE TABLE `blood_bank` (
  `blood_bank_id` int(11) NOT NULL,
  `blood_group` varchar(8) NOT NULL,
  `quantity` int(11) NOT NULL,
  `expire_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blood_donate`
--

CREATE TABLE `blood_donate` (
  `donate_id` int(11) NOT NULL,
  `blood_group` varchar(8) NOT NULL,
  `donate_date` date NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `blood_receipt`
--

CREATE TABLE `blood_receipt` (
  `receipt_id` int(11) NOT NULL,
  `blood_group` varchar(8) NOT NULL,
  `receipt_date` date NOT NULL,
  `amount` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `department_name`) VALUES
(2, 'heart'),
(4, 'Psychology'),
(1, 'Surgery');

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `expense_id` int(11) NOT NULL,
  `expense_to` varchar(128) NOT NULL,
  `amount` float NOT NULL,
  `currency` char(3) NOT NULL,
  `expense_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`expense_id`, `expense_to`, `amount`, `currency`, `expense_date`) VALUES
(2, 'food', 1000, 'AFN', '2022-06-18'),
(3, 'transport', 1000, 'AFN', '2022-06-23');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `email` varchar(128) DEFAULT NULL,
  `phone` char(10) DEFAULT NULL,
  `title` varchar(128) NOT NULL,
  `message` text NOT NULL,
  `feedback_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `history_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `photo` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`history_id`, `title`, `description`, `photo`) VALUES
(1, 'This is about you1', '                                        Video provides a powerful way to help you prove your point. When you click Online Video, you can paste in the embed code for the video you want to add. You can also type a keyword to search online for the video that best fits your document.\r\nTo make your document look professionally produced, Word provides header, footer, cover page, and text box designs that complement each other. For example, you can add a matching cover page, header, and sidebar. Click Insert and then choose the elements you want from the different galleries.\r\nThemes and styles also help keep your document coordinated. When you click Design and choose a new Theme, the pictures, charts, and SmartArt graphics change to match your new theme. When you apply styles, your headings change to match the new theme.\r\n\r\n												', '../../images/history/1656132123Tulips.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `income`
--

CREATE TABLE `income` (
  `income_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `income_currency` varchar(6) DEFAULT NULL,
  `income_type` varchar(32) NOT NULL,
  `income_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `income`
--

INSERT INTO `income` (`income_id`, `patient_id`, `amount`, `income_currency`, `income_type`, `income_date`) VALUES
(4, 4, 10000, 'AFG', 'surgery', '2022-06-23'),
(5, 6, 10000, 'AFG', 'surgery', '2022-06-23'),
(6, 4, 200, 'USD', 'test', '2022-06-22');

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

CREATE TABLE `medicine` (
  `medicine_id` int(11) NOT NULL,
  `medicine_name` varchar(64) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `form` varchar(32) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) DEFAULT NULL,
  `price_unit` varchar(6) NOT NULL,
  `expire_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `medicine`
--

INSERT INTO `medicine` (`medicine_id`, `medicine_name`, `description`, `form`, `quantity`, `price`, `price_unit`, `expire_date`) VALUES
(2, 'pracetomol', 'This is new king of drag', 'Injection', 2, 10000, 'AFG', '2022-06-19');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `news_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `news_file` varchar(128) DEFAULT NULL,
  `news_date` date DEFAULT NULL,
  `source` varchar(64) NOT NULL,
  `visit` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`news_id`, `title`, `description`, `news_file`, `news_date`, `source`, `visit`) VALUES
(2, 'Thew rate of Covid-19 in Afghanistan', '                                                      Video provides a powerful way to help you prove your point. When you click Online Video, you can paste in the embed code for the video you want to add. You can also type a keyword to search online for the video that best fits your document.\r\nTo make your document look professionally produced, Word provides header, footer, cover page, and text box designs that complement each other. For example, you can add a matching cover page, header, and sidebar. Click Insert and then choose the elements you want from the different galleries.\r\nThemes and styles also help keep your document coordinated. When you click Design and choose a new Theme, the pictures, charts, and SmartArt graphics change to match your new theme. When you apply styles, your headings change to match the new theme.\r\nSave time in Word with new buttons that show up where you need them. To change the way a picture fits in your document, click it and a button for layout options appears next to it. When you work on a table, click where you want to add a row or a column, and then click the plus sign.\r\nReading is easier, too, in the new Reading view. You can collapse parts of the document and focus on the text you want. If you need to stop reading before you reach the end, Word remembers where you left off - even on another device.\r\n\r\n												', '../../images/news/1656332494medic-563423__340 (1) - Copy.jpg', '2022-06-25', '8Am', 5),
(3, 'celebating from a wise student', '\r\nSave time in Word with new buttons that show up where you need them. To change the way a picture fits in your document, click it and a button for layout options appears next to it. When you work on a table, click where you want to add a row or a column, and then click the plus sign.	', '../../images/news/1656226840marcelo-leal-483685-unsplash - Copy.jpg', '2022-06-26', 'Bamyan Journal.com', 7);

-- --------------------------------------------------------

--
-- Table structure for table `overtime`
--

CREATE TABLE `overtime` (
  `staff_id` int(11) NOT NULL,
  `overtime_year` int(11) NOT NULL,
  `overtime_month` int(11) NOT NULL,
  `overtime_day` int(11) NOT NULL,
  `hours` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `overtime`
--

INSERT INTO `overtime` (`staff_id`, `overtime_year`, `overtime_month`, `overtime_day`, `hours`) VALUES
(2, 2019, 5, 20, 2),
(2, 2021, 4, 18, 2),
(2, 2022, 6, 6, 3),
(3, 2022, 6, 22, 10);

-- --------------------------------------------------------

--
-- Table structure for table `partner`
--

CREATE TABLE `partner` (
  `partner_id` int(11) NOT NULL,
  `hospital_name` varchar(64) NOT NULL,
  `country` varchar(64) NOT NULL,
  `phone` varchar(16) NOT NULL,
  `email` varchar(128) DEFAULT NULL,
  `address` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `patient_id` int(11) NOT NULL,
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `address` varchar(128) NOT NULL,
  `phone` char(10) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `birth_year` int(11) NOT NULL,
  `history` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`patient_id`, `firstname`, `lastname`, `address`, `phone`, `gender`, `birth_year`, `history`) VALUES
(2, 'zaman-1', 'kamali', 'Bamyan/Panja', '03434324', 0, 1999, 'This is zaman kamali and here with  lot of new skills with new thing so become specialist with his	   '),
(4, 'zaman-2', 'kamali', 'Bamyan/Panja', '034343243', 0, 1999, 'This is zaman kamali and here with  lot of new skills with new thing so become specialist with his	   '),
(5, 'zaman-3', 'kamali', 'Bamyan/Panja', '034343824', 0, 1999, 'This is zaman kamali and here with  lot of new skills with new thing so become specialist with his	   '),
(6, 'zaman-4', 'kamali', 'Bamyan/Panja', '0343432243', 0, 1999, 'This is zaman kamali and here with  lot of new skills with new thing so become specialist with his	   '),
(7, 'zaman', 'kamali', 'Bamyan/Panja', '03434', 0, 1999, 'This is zaman kamali and here with  lot of new skills with new thing so become specialist with his	   '),
(8, 'zaman', 'kamali', 'Bamyan/Panja', '03434334', 0, 1999, '                  This is zaman kamali and here with  lot of new skills with new thing so become specialist with his	   			   ');

-- --------------------------------------------------------

--
-- Table structure for table `patient_medicine`
--

CREATE TABLE `patient_medicine` (
  `patient_medicine_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `medicine_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` varchar(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `apply_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `patient_medicine`
--

INSERT INTO `patient_medicine` (`patient_medicine_id`, `patient_id`, `medicine_id`, `quantity`, `unit_price`, `total_price`, `apply_date`) VALUES
(3, 6, 2, 2, 'AFG', 100, '2022-06-20'),
(4, 6, 2, 2, 'USD', 100, '2022-06-20'),
(5, 4, 2, 2, 'AFG', 100, '2022-06-20'),
(6, 6, 2, 23, 'AFG', 2300, '2022-06-29');

-- --------------------------------------------------------

--
-- Table structure for table `patient_record`
--

CREATE TABLE `patient_record` (
  `patient_record_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `record_date` date NOT NULL,
  `sickness` varchar(255) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `record_result` varchar(255) DEFAULT NULL,
  `time_in` varchar(32) NOT NULL,
  `time_out` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `patient_surgery`
--

CREATE TABLE `patient_surgery` (
  `patient_surgery_id` int(11) NOT NULL,
  `surgery_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `surgery_date` date NOT NULL,
  `surgery_result` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `patient_surgery`
--

INSERT INTO `patient_surgery` (`patient_surgery_id`, `surgery_id`, `patient_id`, `staff_id`, `surgery_date`, `surgery_result`) VALUES
(4, 2, 4, 3, '2022-06-23', 'safe'),
(5, 3, 4, 3, '2022-06-23', 'safe'),
(6, 3, 6, 3, '2022-06-23', 'This need to be safe');

-- --------------------------------------------------------

--
-- Table structure for table `patient_test`
--

CREATE TABLE `patient_test` (
  `patient_test_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  `test_date` date NOT NULL,
  `test_result` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `patient_test`
--

INSERT INTO `patient_test` (`patient_test_id`, `patient_id`, `test_id`, `test_date`, `test_result`) VALUES
(2, 6, 2, '2022-06-21', 'This seems good'),
(3, 6, 2, '2022-06-23', 'This seems good'),
(4, 4, 7, '2022-06-22', 'This seems good');

-- --------------------------------------------------------

--
-- Table structure for table `practice`
--

CREATE TABLE `practice` (
  `practice_id` int(11) NOT NULL,
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) DEFAULT NULL,
  `phone` char(10) NOT NULL,
  `email` varchar(128) DEFAULT NULL,
  `gender` tinyint(1) NOT NULL,
  `address` varchar(128) NOT NULL,
  `photo` varchar(128) NOT NULL,
  `university` varchar(64) NOT NULL,
  `department_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `purchase_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `item_name` varchar(64) NOT NULL,
  `purchase_date` date NOT NULL,
  `guarantee` varchar(255) NOT NULL,
  `expire_date` date DEFAULT NULL,
  `quantity` float NOT NULL,
  `unitprice` float NOT NULL,
  `totalprice` float NOT NULL,
  `currency` char(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `research`
--

CREATE TABLE `research` (
  `research_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `research_result` text NOT NULL,
  `research_date` date NOT NULL,
  `staff_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `room_id` int(11) NOT NULL,
  `room_no` varchar(32) NOT NULL,
  `room_type` varchar(32) NOT NULL,
  `department_id` int(11) NOT NULL,
  `capacity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_id`, `room_no`, `room_type`, `department_id`, `capacity`) VALUES
(1, '23    ', 'for rest', 4, 23);

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE `salary` (
  `staff_id` int(11) NOT NULL,
  `salary_year` int(11) NOT NULL,
  `salary_month` int(11) NOT NULL,
  `absent_amount` float NOT NULL,
  `overtime_amount` float NOT NULL,
  `insurance` float NOT NULL,
  `tax` float NOT NULL,
  `bonus` float NOT NULL,
  `net_salary` float NOT NULL,
  `currency` varchar(16) NOT NULL,
  `pay_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `salary`
--

INSERT INTO `salary` (`staff_id`, `salary_year`, `salary_month`, `absent_amount`, `overtime_amount`, `insurance`, `tax`, `bonus`, `net_salary`, `currency`, `pay_date`) VALUES
(2, 2018, 6, 0, 0, 0, 0, 0, 20000, 'AFG', '2022-06-22'),
(2, 2022, 1, 0, 0, 0, 0, 0, 20000, 'AFG', '2022-06-23'),
(2, 2022, 6, 385, 289, 100, 1000, 10000, 28804, 'USD', '2022-06-22');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `service_id` int(11) NOT NULL,
  `service_name` varchar(64) NOT NULL,
  `description` text DEFAULT NULL,
  `amount` int(11) NOT NULL,
  `currency` varchar(16) NOT NULL,
  `photo` varchar(128) DEFAULT NULL,
  `timing` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`service_id`, `service_name`, `description`, `amount`, `currency`, `photo`, `timing`) VALUES
(2, 'heart surgery', 'To make your document look professionally produced, Word provides header, footer, cover page, and text box designs that complement each other. For example, you can add a matching cover page, header, and sidebar. Click Insert and then choose the elements you want from the different galleries.\r\nThemes and styles also help keep your document coordinated. When you click Design and choose a new Theme, the pictures, charts, and SmartArt graphics change to match your new theme. When you apply styles, your headings change to match the new theme.\r\nSave time in Word with new buttons that show up where you need them. To change the way a picture fits in your document, click it and a button for layout options appears next to it. When you work on a table, click where you want to add a row or a column, and then click the plus sign.\r\nReading is easier, too, in the new Reading view. You can collapse parts of the document and focus on the text you want. If you need to stop reading before you reach the end, Word remembers where you left off - even on another device.\r\n', 80000, 'AFG', '../../images/service/1656218497clinic-1807543__340 - Copy.jpg', 'once a week'),
(3, 'enter sicks', '                Themes and styles also help keep your document coordinated. When you click Design and choose a new Theme, the pictures, charts, and SmartArt graphics change to match your new theme. When you apply styles, your headings change to match the new theme.\r\nSave time in Word with new buttons that show up where you need them. To change the way a picture fits in your document, click it and a button for layout options appears next to it. When you work on a table, click where you want to add a row or a column, and then click the plus sign.\r\n				', 1000, 'AFG', '../../images/service/1656219830img6.jpg', '6:00 am - 8:00 pm ');

-- --------------------------------------------------------

--
-- Table structure for table `slide_show`
--

CREATE TABLE `slide_show` (
  `slide_show_id` int(11) NOT NULL,
  `title` varchar(64) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `photo` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `slide_show`
--

INSERT INTO `slide_show` (`slide_show_id`, `title`, `description`, `photo`) VALUES
(2, 'doctor', '\r\nThe professional doctors here are trying to improve your new skill		', '../../images/slide_show/1656214052main-slide.jpg'),
(4, 'eyes', '\r\nThere are so many professional doctor to serve you with good quality', '../../images/slide_show/1656214197slidew.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` int(11) NOT NULL,
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `dob` int(11) NOT NULL,
  `nic` varchar(64) NOT NULL,
  `photo` varchar(128) NOT NULL,
  `position` varchar(64) NOT NULL,
  `gross_salary` int(11) NOT NULL,
  `currency` char(3) NOT NULL,
  `phone` char(10) NOT NULL,
  `email` varchar(128) DEFAULT NULL,
  `address` varchar(128) NOT NULL,
  `hire_date` date NOT NULL,
  `staff_type` int(11) NOT NULL,
  `department_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `firstname`, `lastname`, `gender`, `dob`, `nic`, `photo`, `position`, `gross_salary`, `currency`, `phone`, `email`, `address`, `hire_date`, `staff_type`, `department_id`) VALUES
(2, 'aliAzari', 'Kamran', 0, 1984, '94545', '../../images/staff/16554449401582627803user(4).jpg', 'nurse', 20000, 'AFN', '077734333', 'AliAzar@gmail.com', 'Bamyan/Panja', '2022-06-17', 2, 1),
(3, 'hamid', 'Ahmadi', 0, 1995, '03434', '../../images/staff/1655813850in1.jpg', 'it offeser', 2000, 'USD', '۰۳۴۵۳۵۳۳۴۵', 'hamid@gmail.com', 'Kabul/Kar-4', '2022-06-21', 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `stock_id` int(11) NOT NULL,
  `item_name` varchar(64) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `stock_type` varchar(32) NOT NULL,
  `price` int(11) NOT NULL,
  `new_quantity` int(11) NOT NULL,
  `used_quantity` int(11) NOT NULL,
  `damaged_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` int(11) NOT NULL,
  `supplier_name` varchar(64) NOT NULL,
  `supplier_type` varchar(32) NOT NULL,
  `country` varchar(32) NOT NULL,
  `contract` tinyint(1) NOT NULL,
  `phone` varchar(16) NOT NULL,
  `email` varchar(128) DEFAULT NULL,
  `address` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `surgery`
--

CREATE TABLE `surgery` (
  `surgery_id` int(11) NOT NULL,
  `surgery_name` varchar(64) NOT NULL,
  `department_id` int(11) DEFAULT NULL,
  `price` int(11) NOT NULL,
  `currency` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `surgery`
--

INSERT INTO `surgery` (`surgery_id`, `surgery_name`, `department_id`, `price`, `currency`) VALUES
(2, 'for mouth', 1, 100000, 'AFG'),
(3, 'nose', 1, 10000, 'AFG');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `test_id` int(11) NOT NULL,
  `test_name` varchar(128) NOT NULL,
  `test_type` varchar(64) NOT NULL,
  `price` int(11) NOT NULL,
  `currency` varchar(16) DEFAULT NULL,
  `normal_result` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`test_id`, `test_name`, `test_type`, `price`, `currency`, `normal_result`) VALUES
(2, 'blood test', 'blood', 2200, 'AFG', '23'),
(6, 'water', 'new ', 100, 'AFG', '12'),
(7, 'Rheumatism', 'physical', 200, 'USD', '10');

-- --------------------------------------------------------

--
-- Table structure for table `timetable`
--

CREATE TABLE `timetable` (
  `timetable_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `weekday` int(11) NOT NULL,
  `time_from` varchar(32) NOT NULL,
  `time_to` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(64) NOT NULL,
  `user_type` tinyint(1) NOT NULL,
  `admin_level` tinyint(4) NOT NULL DEFAULT 0,
  `website_level` tinyint(4) NOT NULL DEFAULT 0,
  `stock_level` tinyint(4) NOT NULL DEFAULT 0,
  `hr_level` tinyint(4) NOT NULL DEFAULT 0,
  `finance_level` tinyint(4) NOT NULL DEFAULT 0,
  `surgery_level` tinyint(4) NOT NULL DEFAULT 0,
  `pharmacy_level` tinyint(4) NOT NULL DEFAULT 0,
  `laboratoar_level` tinyint(4) NOT NULL DEFAULT 0,
  `blood_bank_level` tinyint(4) NOT NULL DEFAULT 0,
  `patient_level` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `user_type`, `admin_level`, `website_level`, `stock_level`, `hr_level`, `finance_level`, `surgery_level`, `pharmacy_level`, `laboratoar_level`, `blood_bank_level`, `patient_level`) VALUES
(2, 'admin@gmail.com', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', 1, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8),
(3, 'ali@gmail.com', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', 0, 0, 0, 0, 2, 0, 0, 0, 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admit`
--
ALTER TABLE `admit`
  ADD PRIMARY KEY (`admit_id`),
  ADD KEY `patient_admit_fk` (`patient_id`),
  ADD KEY `room_admit_fk` (`room_id`);

--
-- Indexes for table `advertisement`
--
ALTER TABLE `advertisement`
  ADD PRIMARY KEY (`advertisement_id`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `patient_appointment_fk` (`patient_id`),
  ADD KEY `staff_appointment_fk` (`staff_id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`staff_id`,`absent_year`,`absent_month`,`absent_day`);

--
-- Indexes for table `blood_bank`
--
ALTER TABLE `blood_bank`
  ADD PRIMARY KEY (`blood_bank_id`);

--
-- Indexes for table `blood_donate`
--
ALTER TABLE `blood_donate`
  ADD PRIMARY KEY (`donate_id`);

--
-- Indexes for table `blood_receipt`
--
ALTER TABLE `blood_receipt`
  ADD PRIMARY KEY (`receipt_id`),
  ADD KEY `patient_blood_receipt_fk` (`patient_id`),
  ADD KEY `staff_blood_receipt_fk` (`staff_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`department_id`),
  ADD UNIQUE KEY `department_name` (`department_name`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`expense_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`history_id`);

--
-- Indexes for table `income`
--
ALTER TABLE `income`
  ADD PRIMARY KEY (`income_id`),
  ADD KEY `patient_income_fk` (`patient_id`);

--
-- Indexes for table `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`medicine_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`news_id`);

--
-- Indexes for table `overtime`
--
ALTER TABLE `overtime`
  ADD PRIMARY KEY (`staff_id`,`overtime_year`,`overtime_month`,`overtime_day`);

--
-- Indexes for table `partner`
--
ALTER TABLE `partner`
  ADD PRIMARY KEY (`partner_id`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`patient_id`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `patient_medicine`
--
ALTER TABLE `patient_medicine`
  ADD PRIMARY KEY (`patient_medicine_id`),
  ADD KEY `patient_patient_medicine_fk` (`patient_id`),
  ADD KEY `medicine_patient_medicine_fk` (`medicine_id`);

--
-- Indexes for table `patient_record`
--
ALTER TABLE `patient_record`
  ADD PRIMARY KEY (`patient_record_id`),
  ADD KEY `patient_patient_record_fk` (`patient_id`),
  ADD KEY `staff_patient_record_fk` (`staff_id`);

--
-- Indexes for table `patient_surgery`
--
ALTER TABLE `patient_surgery`
  ADD PRIMARY KEY (`patient_surgery_id`),
  ADD KEY `surgery_patient_surgery_fk` (`surgery_id`),
  ADD KEY `patient_patient_surgery_fk` (`patient_id`),
  ADD KEY `staff_patient_surgery_fk` (`staff_id`);

--
-- Indexes for table `patient_test`
--
ALTER TABLE `patient_test`
  ADD PRIMARY KEY (`patient_test_id`),
  ADD KEY `patient_patient_test_fk` (`patient_id`),
  ADD KEY `test_patient_test_fk` (`test_id`);

--
-- Indexes for table `practice`
--
ALTER TABLE `practice`
  ADD PRIMARY KEY (`practice_id`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `department_practice_fk` (`department_id`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`purchase_id`),
  ADD KEY `supplier_purchase` (`supplier_id`);

--
-- Indexes for table `research`
--
ALTER TABLE `research`
  ADD PRIMARY KEY (`research_id`),
  ADD KEY `staff_research_fk` (`staff_id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_id`),
  ADD KEY `department_room_fk` (`department_id`);

--
-- Indexes for table `salary`
--
ALTER TABLE `salary`
  ADD PRIMARY KEY (`staff_id`,`salary_year`,`salary_month`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `slide_show`
--
ALTER TABLE `slide_show`
  ADD PRIMARY KEY (`slide_show_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`),
  ADD UNIQUE KEY `nic` (`nic`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `department_staff_fk` (`department_id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`stock_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_id`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `surgery`
--
ALTER TABLE `surgery`
  ADD PRIMARY KEY (`surgery_id`),
  ADD KEY `department_surgery_fk` (`department_id`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`test_id`);

--
-- Indexes for table `timetable`
--
ALTER TABLE `timetable`
  ADD PRIMARY KEY (`timetable_id`),
  ADD KEY `staff_timetable_fk` (`staff_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admit`
--
ALTER TABLE `admit`
  MODIFY `admit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `advertisement`
--
ALTER TABLE `advertisement`
  MODIFY `advertisement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blood_bank`
--
ALTER TABLE `blood_bank`
  MODIFY `blood_bank_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blood_donate`
--
ALTER TABLE `blood_donate`
  MODIFY `donate_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blood_receipt`
--
ALTER TABLE `blood_receipt`
  MODIFY `receipt_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `expense_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `income`
--
ALTER TABLE `income`
  MODIFY `income_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `medicine`
--
ALTER TABLE `medicine`
  MODIFY `medicine_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `partner`
--
ALTER TABLE `partner`
  MODIFY `partner_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `patient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `patient_medicine`
--
ALTER TABLE `patient_medicine`
  MODIFY `patient_medicine_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `patient_record`
--
ALTER TABLE `patient_record`
  MODIFY `patient_record_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient_surgery`
--
ALTER TABLE `patient_surgery`
  MODIFY `patient_surgery_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `patient_test`
--
ALTER TABLE `patient_test`
  MODIFY `patient_test_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `practice`
--
ALTER TABLE `practice`
  MODIFY `practice_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `research`
--
ALTER TABLE `research`
  MODIFY `research_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `slide_show`
--
ALTER TABLE `slide_show`
  MODIFY `slide_show_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `surgery`
--
ALTER TABLE `surgery`
  MODIFY `surgery_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `test_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `timetable`
--
ALTER TABLE `timetable`
  MODIFY `timetable_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admit`
--
ALTER TABLE `admit`
  ADD CONSTRAINT `patient_admit_fk` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `room_admit_fk` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`);

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `patient_appointment_fk` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `staff_appointment_fk` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`) ON UPDATE CASCADE;

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `staff_attendance_fk` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `blood_receipt`
--
ALTER TABLE `blood_receipt`
  ADD CONSTRAINT `patient_blood_receipt_fk` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `staff_blood_receipt_fk` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `income`
--
ALTER TABLE `income`
  ADD CONSTRAINT `patient_income_fk` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`);

--
-- Constraints for table `overtime`
--
ALTER TABLE `overtime`
  ADD CONSTRAINT `staff_overtime_fk` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient_medicine`
--
ALTER TABLE `patient_medicine`
  ADD CONSTRAINT `medicine_patient_medicine_fk` FOREIGN KEY (`medicine_id`) REFERENCES `medicine` (`medicine_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `patient_patient_medicine_fk` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`) ON UPDATE CASCADE;

--
-- Constraints for table `patient_record`
--
ALTER TABLE `patient_record`
  ADD CONSTRAINT `patient_patient_record_fk` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `staff_patient_record_fk` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `patient_surgery`
--
ALTER TABLE `patient_surgery`
  ADD CONSTRAINT `patient_patient_surgery_fk` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `staff_patient_surgery_fk` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `surgery_patient_surgery_fk` FOREIGN KEY (`surgery_id`) REFERENCES `surgery` (`surgery_id`) ON UPDATE CASCADE;

--
-- Constraints for table `patient_test`
--
ALTER TABLE `patient_test`
  ADD CONSTRAINT `patient_patient_test_fk` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `test_patient_test_fk` FOREIGN KEY (`test_id`) REFERENCES `test` (`test_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `practice`
--
ALTER TABLE `practice`
  ADD CONSTRAINT `department_practice_fk` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`) ON UPDATE CASCADE;

--
-- Constraints for table `purchase`
--
ALTER TABLE `purchase`
  ADD CONSTRAINT `supplier_purchase` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`supplier_id`) ON UPDATE CASCADE;

--
-- Constraints for table `research`
--
ALTER TABLE `research`
  ADD CONSTRAINT `staff_research_fk` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `department_room_fk` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `salary`
--
ALTER TABLE `salary`
  ADD CONSTRAINT `staff_salary_fk` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `department_staff_fk` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `surgery`
--
ALTER TABLE `surgery`
  ADD CONSTRAINT `department_surgery_fk` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`) ON UPDATE CASCADE;

--
-- Constraints for table `timetable`
--
ALTER TABLE `timetable`
  ADD CONSTRAINT `staff_timetable_fk` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
