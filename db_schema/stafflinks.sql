-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2025 at 01:21 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stafflinks`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `userId` int(11) NOT NULL,
  `user_fullname` varchar(500) NOT NULL,
  `user_email_address` varchar(500) NOT NULL,
  `company_name` varchar(500) NOT NULL,
  `user_password` varchar(500) NOT NULL,
  `user_special_Id` varchar(500) NOT NULL,
  `verification_code` varchar(500) NOT NULL,
  `status` varchar(500) NOT NULL,
  `my_city` varchar(500) NOT NULL,
  `my_ip` varchar(500) NOT NULL,
  `my_country` varchar(500) NOT NULL,
  `finance_access` varchar(500) NOT NULL,
  `finance_access2` varchar(500) NOT NULL,
  `admin_access` varchar(500) NOT NULL,
  `last_login` varchar(500) NOT NULL,
  `col_company_Id` varchar(500) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`userId`, `user_fullname`, `user_email_address`, `company_name`, `user_password`, `user_special_Id`, `verification_code`, `status`, `my_city`, `my_ip`, `my_country`, `finance_access`, `finance_access2`, `admin_access`, `last_login`, `col_company_Id`, `dateTime`) VALUES
(1, 'Samson Gift', 'osaretin4samson@gmail.com', 'Ese Sphere', 'a8f5dea10f7504a0305998adef3a9c8c2f769c475ad5a3baf23acf9be81cea33', 'USR-72C32DAB-A80E-454C-B1A2-6C382B5C8A1E', 'A86F00', 'Verified', 'Wolverhampton', '::1', 'Unknown', 'Granted', 'Granted', 'Granted', '2025-10-25 09:01', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 08:01:13');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_assessment_entries`
--

CREATE TABLE `tbl_assessment_entries` (
  `userId` int(11) NOT NULL,
  `sectionTitle` varchar(255) NOT NULL,
  `sectionContent` text NOT NULL,
  `slug` varchar(500) NOT NULL,
  `assessor` varchar(100) NOT NULL,
  `uryyTteamoeSS4` varchar(100) NOT NULL,
  `assessm_Id` varchar(100) NOT NULL,
  `uniqueId` varchar(500) NOT NULL,
  `uryyToeSS4` varchar(255) DEFAULT NULL,
  `company_Id` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_billing_config`
--

CREATE TABLE `tbl_billing_config` (
  `userId` int(11) NOT NULL,
  `col_billing_add` varchar(500) NOT NULL,
  `col_invoice_numb` varchar(500) NOT NULL,
  `col_office_numb` varchar(500) NOT NULL,
  `col_payment_details` varchar(500) NOT NULL,
  `col_communication` varchar(500) NOT NULL,
  `col_special_Id` varchar(500) NOT NULL,
  `col_date` varchar(500) NOT NULL,
  `col_company_Id` varchar(500) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cancelled_call`
--

CREATE TABLE `tbl_cancelled_call` (
  `id` int(11) NOT NULL,
  `col_client_name` varchar(500) NOT NULL,
  `cancelled_by` varchar(500) DEFAULT NULL,
  `col_care_call` varchar(500) NOT NULL,
  `col_client_Id` varchar(500) NOT NULL,
  `col_date` varchar(500) NOT NULL,
  `col_time` varchar(500) NOT NULL,
  `col_cancellation_by` varchar(500) NOT NULL,
  `col_reason` varchar(500) NOT NULL,
  `col_pay_status` varchar(500) NOT NULL,
  `col_invoice` varchar(500) NOT NULL,
  `col_note` text NOT NULL,
  `col_company_Id` varchar(500) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_care_plan`
--

CREATE TABLE `tbl_care_plan` (
  `userId` int(11) NOT NULL,
  `asm_name` varchar(500) NOT NULL,
  `asm_header` text NOT NULL,
  `slug` varchar(500) NOT NULL,
  `assessm_Id` varchar(500) NOT NULL,
  `created_by` varchar(500) NOT NULL,
  `uryyTteamoeSS4` varchar(500) NOT NULL,
  `company_Id` varchar(500) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_care_plan_section`
--

CREATE TABLE `tbl_care_plan_section` (
  `userId` int(11) NOT NULL,
  `assessm_name` varchar(500) NOT NULL,
  `sectionTitle` varchar(500) NOT NULL,
  `slug` varchar(500) NOT NULL,
  `assessm_Id` varchar(500) NOT NULL,
  `created_by` varchar(500) NOT NULL,
  `uryyTteamoeSS4` varchar(500) NOT NULL,
  `company_Id` varchar(500) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_chat_system`
--

CREATE TABLE `tbl_chat_system` (
  `userId` int(11) NOT NULL,
  `carer_email` varchar(500) NOT NULL,
  `carer_name` varchar(500) NOT NULL,
  `carer_specialId` varchar(500) NOT NULL,
  `carer_chat` text NOT NULL,
  `time_sent` varchar(500) NOT NULL,
  `date_sent` varchar(500) NOT NULL,
  `chat_color` varchar(500) NOT NULL,
  `admin_email` varchar(500) NOT NULL,
  `admin_name` varchar(500) NOT NULL,
  `admin_chat` text NOT NULL,
  `admin_specialId` varchar(500) NOT NULL,
  `adTime_sent` varchar(500) NOT NULL,
  `adDate_sent` varchar(500) NOT NULL,
  `adChat_color` varchar(500) NOT NULL,
  `chat_status` varchar(500) NOT NULL,
  `col_company_Id` varchar(500) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_clients_medication_records`
--

CREATE TABLE `tbl_clients_medication_records` (
  `id` int(11) NOT NULL,
  `uryyToeSS4` varchar(500) NOT NULL,
  `med_name` varchar(500) NOT NULL,
  `med_dosage` varchar(500) NOT NULL,
  `med_type` varchar(500) NOT NULL,
  `med_support_required` varchar(500) NOT NULL,
  `med_package` varchar(500) NOT NULL,
  `med_details` varchar(500) NOT NULL,
  `date_uploaded` varchar(500) NOT NULL,
  `time_uploaded` varchar(500) NOT NULL,
  `care_call1` varchar(500) NOT NULL,
  `care_call2` varchar(500) NOT NULL,
  `care_call3` varchar(500) NOT NULL,
  `care_call4` varchar(500) NOT NULL,
  `extra_call1` varchar(500) NOT NULL,
  `extra_call2` varchar(500) NOT NULL,
  `extra_call3` varchar(500) NOT NULL,
  `extra_call4` varchar(500) NOT NULL,
  `col_extra_visit` text NOT NULL,
  `monday` varchar(500) NOT NULL,
  `tuesday` varchar(500) NOT NULL,
  `wednesday` varchar(500) NOT NULL,
  `thursday` varchar(500) NOT NULL,
  `friday` varchar(500) NOT NULL,
  `saturday` varchar(500) NOT NULL,
  `sunday` varchar(500) NOT NULL,
  `client_startMed` varchar(500) NOT NULL,
  `client_endMed` varchar(500) NOT NULL,
  `col_fifo` varchar(500) NOT NULL,
  `col_occurence` varchar(500) NOT NULL,
  `col_period_one` varchar(100) NOT NULL,
  `col_period_two` varchar(100) NOT NULL,
  `col_taskId` varchar(500) NOT NULL,
  `med_colours` varchar(500) NOT NULL,
  `visibility` varchar(500) NOT NULL,
  `col_path` text NOT NULL,
  `col_company_Id` varchar(500) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_clients_medication_records`
--

INSERT INTO `tbl_clients_medication_records` (`id`, `uryyToeSS4`, `med_name`, `med_dosage`, `med_type`, `med_support_required`, `med_package`, `med_details`, `date_uploaded`, `time_uploaded`, `care_call1`, `care_call2`, `care_call3`, `care_call4`, `extra_call1`, `extra_call2`, `extra_call3`, `extra_call4`, `col_extra_visit`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `saturday`, `sunday`, `client_startMed`, `client_endMed`, `col_fifo`, `col_occurence`, `col_period_one`, `col_period_two`, `col_taskId`, `med_colours`, `visibility`, `col_path`, `col_company_Id`, `dateTime`) VALUES
(1, '1028', 'Paracetamol', '50mcg', 'Supplement', 'Prompt', 'PRN', 'The carer will see this note in the app each time they complete this task.', 'October 24, 2025', '12:22 pm', 'Morning', 'Lunch', 'Tea', 'Bed', '', '', '', '', '', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', '2025-10-24', '', '', '2025-10-24', '', 'Daily', '001', '#000', 'Not updated', 'medication-report-form', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 11:23:46'),
(2, '1028', 'Alendronic acid', '10mg', 'Muscle Relaxant', 'Administer', 'Blister', 'The carer will see this note in the app each time they complete this task.', 'October 24, 2025', '12:24 pm', 'Morning', 'Lunch', 'Tea', 'Bed', '', '', '', '', '', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', '2025-10-24', '', '', '2025-10-24', '', 'Daily', '002', '#000', 'Not updated', 'medication-report-form', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 11:24:50'),
(3, '1037', 'Magnesium sulfate', '25mg', 'Muscle Relaxant', 'Administer', 'Blister', 'The carer will see this note in the app each time they complete this Medication', 'October 24, 2025', '12:30 pm', 'Morning', 'Lunch', 'Tea', 'Bed', '', '', '', '', '', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', '2025-10-24', '', '', '2025-10-24', '', 'Daily', '003', '#000', 'Not updated', 'medication-report-form', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 11:31:50'),
(4, '1030', 'Hydrochlorothiazide', '5mg', 'Aromatase Inhibitor', 'Administer', 'PRN', 'The carer will see this note in the app each time they complete this Medication', 'October 24, 2025', '12:32 pm', 'Morning', 'Lunch', 'Tea', 'Bed', '', '', '', '', '', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', '2025-10-24', '', '', '2025-10-24', '', 'Daily', '004', '#000', 'Not updated', 'medication-report-form', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 11:32:49'),
(5, '1030', 'Allopurinol', '100mg', 'Calcium Channel Blocker', 'Administer', 'Scheduled', 'The carer will see this note in the app each time they complete this Medication', 'October 24, 2025', '12:32 pm', 'Morning', 'Lunch', 'Tea', 'Bed', '', '', '', '', '', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', '2025-10-24', '', '', '2025-10-24', '', 'Daily', '005', '#000', 'Not updated', 'medication-report-form', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 11:33:18'),
(6, '1030', 'Aspirin', '500mg', 'Antibiotic', 'Administer', 'Scheduled', 'The carer will see this note in the app each time they complete this Medication', 'October 24, 2025', '12:33 pm', 'Morning', 'Lunch', 'Tea', 'Bed', '', '', '', '', '', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', '2025-10-24', '', '', '2025-10-24', '', 'Daily', '006', '#000', 'Not updated', 'medication-report-form', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 11:33:50'),
(7, '1030', 'Enoxaparin', '25mg', 'Muscle Relaxant', 'Administer', 'Scheduled', 'The carer will see this note in the app each time they complete this Medication', 'October 24, 2025', '12:33 pm', 'Morning', 'Lunch', 'Tea', 'Bed', '', '', '', '', '', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', '2025-10-24', '', '', '2025-10-24', '', 'Daily', '007', '#000', 'Not updated', 'medication-report-form', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 11:34:17'),
(8, '1023', 'Paracetamol', '10mg', 'Anxiolytic', 'Administer', 'PRN', 'Follow the care plan for all tasks and activities, including personal care and meals.\r\nAdminister medications as prescribed and record the time.\r\nObserve and report any changes in health, mood, or behavior.', 'October 24, 2025', '12:36 pm', 'Morning', 'Lunch', 'Tea', 'Bed', '', '', '', '', '', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', '2025-10-24', '', '', '2025-10-24', '', 'Daily', '008', '#000', 'Not updated', 'medication-report-form', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 11:37:26'),
(9, '1023', 'Magnesium sulfate', '20mg', 'Muscle Relaxant', 'Administer', 'Scheduled', 'Follow the care plan for all tasks and activities, including personal care and meals.\r\nAdminister medications as prescribed and record the time.\r\nObserve and report any changes in health, mood, or behavior.', 'October 24, 2025', '12:37 pm', 'Morning', 'Lunch', 'Tea', 'Bed', '', '', '', '', '', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', '2025-10-24', '', '', '2025-10-24', '', 'Daily', '009', '#000', 'Not updated', 'medication-report-form', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 11:37:54'),
(10, '1033', 'Gabapentin', '75mg', 'Statin', 'Administer', 'Scheduled', 'Follow the care plan for all tasks and activities, including personal care and meals.\r\nAdminister medications as prescribed and record the time.\r\nObserve and report any changes in health, mood, or behavior.', 'October 24, 2025', '12:39 pm', 'Morning', 'Lunch', 'Tea', 'Bed', '', '', '', '', '', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', '2025-10-24', '', '', '2025-10-24', '', 'Daily', '0010', '#000', 'Not updated', 'medication-report-form', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 11:39:42'),
(11, '1035', 'Methadone', '20mg', 'Muscle Relaxant', 'Administer', 'Scheduled', 'Follow the care plan for all tasks and activities, including personal care and meals.\r\nAdminister medications as prescribed and record the time.\r\nObserve and report any changes in health, mood, or behavior.', 'October 24, 2025', '12:40 pm', 'Morning', 'Lunch', 'Tea', 'Bed', '', '', '', '', '', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', '2025-10-24', '', '', '2025-10-24', '', 'Daily', '0011', '#000', 'Not updated', 'medication-report-form', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 11:41:22'),
(12, '1035', 'Ranitidine', '50mg', 'Immunosuppressant', 'Administer', 'Scheduled', 'Follow the care plan for all tasks and activities, including personal care and meals.\r\nAdminister medications as prescribed and record the time.\r\nObserve and report any changes in health, mood, or behavior.', 'October 24, 2025', '12:41 pm', 'Morning', 'Lunch', 'Tea', 'Bed', '', '', '', '', '', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', '2025-10-24', '', '', '2025-10-24', '', 'Daily', '0012', '#000', 'Not updated', 'medication-report-form', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 11:41:49'),
(13, '1024', 'Naloxone', '50mg', 'Corticosteroid', 'Administer', 'Scheduled', 'Follow the care plan for all tasks and activities, including personal care and meals.\r\nAdminister medications as prescribed and record the time.\r\nObserve and report any changes in health, mood, or behavior.', 'October 24, 2025', '12:42 pm', 'Morning', 'Lunch', 'Tea', 'Bed', '', '', '', '', '', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', '2025-10-24', '', '', '2025-10-24', '', 'Daily', '0013', '#000', 'Not updated', 'medication-report-form', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 11:43:21'),
(14, '1024', 'Lansoprazole', '75mg', 'Muscle Relaxant', 'Administer', 'Scheduled', 'Follow the care plan for all tasks and activities, including personal care and meals.\r\nAdminister medications as prescribed and record the time.\r\nObserve and report any changes in health, mood, or behavior.', 'October 24, 2025', '12:43 pm', 'Morning', 'Lunch', 'Tea', 'Bed', '', '', '', '', '', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', '2025-10-24', '', '', '2025-10-24', '', 'Daily', '0014', '#000', 'Not updated', 'medication-report-form', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 11:43:49'),
(15, '1036', 'Pantoprazole', '20mg', 'Statin', 'Administer', 'Scheduled', 'Follow the care plan for all tasks and activities, including personal care and meals.\r\nAdminister medications as prescribed and record the time.\r\nObserve and report any changes in health, mood, or behavior.', 'October 24, 2025', '12:45 pm', 'Morning', 'Lunch', 'Tea', 'Bed', '', '', '', '', '', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', '2025-10-24', '', '', '2025-10-24', '', 'Daily', '0015', '#000', 'Not updated', 'medication-report-form', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 11:45:40'),
(16, '1036', 'Gabapentin', '20mg', 'Statin', 'Administer', 'Scheduled', 'Follow the care plan for all tasks and activities, including personal care and meals.\r\nAdminister medications as prescribed and record the time.\r\nObserve and report any changes in health, mood, or behavior.', 'October 24, 2025', '12:45 pm', 'Morning', 'Lunch', 'Tea', 'Bed', '', '', '', '', '', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', '2025-10-24', '', '', '2025-10-24', '', 'Daily', '0016', '#000', 'Not updated', 'medication-report-form', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 11:46:57'),
(17, '1034', 'Paroxetine', '20mg', 'Statin', 'Administer', 'Scheduled', 'Follow the care plan for all tasks and activities, including personal care and meals.\r\nAdminister medications as prescribed and record the time.\r\nObserve and report any changes in health, mood, or behavior.', 'October 24, 2025', '12:47 pm', 'Morning', 'Lunch', 'Tea', 'Bed', '', '', '', '', '', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', '2025-10-24', '', '', '2025-10-24', '', 'Daily', '0017', '#000', 'Not updated', 'medication-report-form', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 11:48:19'),
(18, '1032', 'Paracetamol', '20mg', 'Corticosteroid', 'Administer', 'Scheduled', 'Follow the care plan for all tasks and activities, including personal care and meals.\r\nAdminister medications as prescribed and record the time.\r\nObserve and report any changes in health, mood, or behavior.', 'October 24, 2025', '12:49 pm', 'Morning', 'Lunch', 'Tea', 'Bed', '', '', '', '', '', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', '2025-10-24', '', '', '2025-10-24', '', 'Daily', '0018', '#000', 'Not updated', 'medication-report-form', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 11:49:51'),
(19, '1032', 'Latanoprost', '20mg', 'Muscle Relaxant', 'Administer', 'Scheduled', 'Follow the care plan for all tasks and activities, including personal care and meals.\r\nAdminister medications as prescribed and record the time.\r\nObserve and report any changes in health, mood, or behavior.', 'October 24, 2025', '12:49 pm', 'Morning', 'Lunch', 'Tea', 'Bed', '', '', '', '', '', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', '2025-10-24', '', '', '2025-10-24', '', 'Daily', '0019', '#000', 'Not updated', 'medication-report-form', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 11:50:19'),
(20, '1032', 'Ramipril', '10mg', 'Muscle Relaxant', 'Administer', 'Scheduled', 'Follow the care plan for all tasks and activities, including personal care and meals.\r\nAdminister medications as prescribed and record the time.\r\nObserve and report any changes in health, mood, or behavior.', 'October 24, 2025', '12:50 pm', 'Morning', 'Lunch', 'Tea', 'Bed', '', '', '', '', '', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', '2025-10-24', '', '', '2025-10-24', '', 'Daily', '0020', '#000', 'Not updated', 'medication-report-form', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 11:50:52'),
(21, '1032', 'Temazepam', '75mg', 'Antiplatelet', 'Administer', 'Scheduled', 'Follow the care plan for all tasks and activities, including personal care and meals.\r\nAdminister medications as prescribed and record the time.\r\nObserve and report any changes in health, mood, or behavior.', 'October 24, 2025', '12:50 pm', 'Morning', 'Lunch', 'Tea', 'Bed', '', '', '', '', '', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', '2025-10-24', '', '', '2025-10-24', '', 'Daily', '0021', '#000', 'Not updated', 'medication-report-form', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 11:52:42'),
(22, '1029', 'Olanzapine', '5mg', 'Antidepressant', 'Administer', 'Scheduled', '', 'October 24, 2025', '12:54 pm', 'Morning', 'Lunch', 'Tea', 'Bed', '', '', '', '', '', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', '2025-10-24', '', '', '2025-10-24', '', 'Daily', '0022', '#000', 'Not updated', 'medication-report-form', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 11:59:38'),
(23, '1029', 'Omeprazole', '10mg', 'Antidepressant', 'Administer', 'Scheduled', 'Follow the care plan for all tasks and activities, including personal care and meals.\r\nAdminister medications as prescribed and record the time.\r\nObserve and report any changes in health, mood, or behavior.', 'October 24, 2025', '12:59 pm', 'Morning', 'Lunch', 'Tea', 'Bed', '', '', '', '', '', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', '2025-10-24', '', '', '2025-10-24', '', 'Daily', '0023', '#000', 'Not updated', 'medication-report-form', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 12:00:11'),
(24, '1029', 'Warfarin', '500mg', 'Aromatase Inhibitor', 'Administer', 'Scheduled', 'Follow the care plan for all tasks and activities, including personal care and meals.\r\nAdminister medications as prescribed and record the time.\r\nObserve and report any changes in health, mood, or behavior.', 'October 24, 2025', '01:00 pm', 'Morning', 'Lunch', 'Tea', 'Bed', '', '', '', '', '', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', '2025-10-24', '', '', '2025-10-24', '', 'Daily', '0024', '#000', 'Not updated', 'medication-report-form', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 12:00:26'),
(25, '1029', 'Enoxaparin', '500mg', 'Antibiotic', 'Administer', 'Scheduled', 'Follow the care plan for all tasks and activities, including personal care and meals.\r\nAdminister medications as prescribed and record the time.\r\nObserve and report any changes in health, mood, or behavior.', 'October 24, 2025', '01:00 pm', 'Morning', 'Lunch', 'Tea', 'Bed', '', '', '', '', '', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', '2025-10-24', '', '', '2025-10-24', '', 'Daily', '0025', '#000', 'Not updated', 'medication-report-form', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 12:00:46'),
(26, '1029', 'Quetiapine', '25mg', 'Statin', 'Administer', 'Scheduled', 'Follow the care plan for all tasks and activities, including personal care and meals.\r\nAdminister medications as prescribed and record the time.\r\nObserve and report any changes in health, mood, or behavior.', 'October 24, 2025', '01:00 pm', 'Morning', 'Lunch', 'Tea', 'Bed', '', '', '', '', '', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', '2025-10-24', '', '', '2025-10-24', '', 'Daily', '0026', '#000', 'Not updated', 'medication-report-form', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 12:01:05'),
(27, '1027', 'Quetiapine', '500mg', 'Anxiolytic', 'Administer', 'Scheduled', 'Follow the care plan for all tasks and activities, including personal care and meals.\r\nAdminister medications as prescribed and record the time.\r\nObserve and report any changes in health, mood, or behavior.', 'October 24, 2025', '01:16 pm', 'Morning', 'Lunch', 'Tea', 'Bed', '', '', '', '', '', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', '2025-10-24', '', '', '2025-10-24', '', 'Daily', '0027', '#000', 'Not updated', 'medication-report-form', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 12:16:36'),
(28, '1026', 'Ondansetron', '0.5mg', 'Calcium Channel Blocker', 'Administer', 'Scheduled', 'Follow the care plan for all tasks and activities, including personal care and meals.\r\nAdminister medications as prescribed and record the time.\r\nObserve and report any changes in health, mood, or behavior.', 'October 24, 2025', '01:17 pm', 'Morning', 'Lunch', 'Tea', 'Bed', '', '', '', '', '', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', '2025-10-24', '', '', '2025-10-24', '', 'Daily', '0028', '#000', 'Not updated', 'medication-report-form', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 12:17:35'),
(29, '1026', 'Sertraline', '500mg', 'Muscle Relaxant', 'Administer', 'Scheduled', 'Follow the care plan for all tasks and activities, including personal care and meals.\r\nAdminister medications as prescribed and record the time.\r\nObserve and report any changes in health, mood, or behavior.', 'October 24, 2025', '01:17 pm', 'Morning', 'Lunch', 'Tea', 'Bed', '', '', '', '', '', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', '2025-10-24', '', '', '2025-10-24', '', 'Daily', '0029', '#000', 'Not updated', 'medication-report-form', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 12:17:53');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_clients_task_records`
--

CREATE TABLE `tbl_clients_task_records` (
  `id` int(11) NOT NULL,
  `uryyToeSS4` varchar(500) NOT NULL,
  `client_taskName` varchar(500) NOT NULL,
  `client_task_details` varchar(500) NOT NULL,
  `care_call1` varchar(500) NOT NULL,
  `care_call2` varchar(500) NOT NULL,
  `care_call3` varchar(500) NOT NULL,
  `care_call4` varchar(500) NOT NULL,
  `extra_call1` varchar(500) NOT NULL,
  `extra_call2` varchar(500) NOT NULL,
  `extra_call3` varchar(500) NOT NULL,
  `extra_call4` varchar(500) NOT NULL,
  `col_extra_visit` text NOT NULL,
  `monday` varchar(500) NOT NULL,
  `tuesday` varchar(500) NOT NULL,
  `wednesday` varchar(500) NOT NULL,
  `thursday` varchar(500) NOT NULL,
  `friday` varchar(500) NOT NULL,
  `saturday` varchar(500) NOT NULL,
  `sunday` varchar(500) NOT NULL,
  `tast_anytimeSession` varchar(500) NOT NULL,
  `task_startDate` varchar(500) NOT NULL,
  `task_endDate` varchar(500) NOT NULL,
  `col_fifo` varchar(500) NOT NULL,
  `col_occurence` varchar(500) NOT NULL,
  `col_period_one` varchar(500) NOT NULL,
  `col_period_two` varchar(500) NOT NULL,
  `date_uploaded` varchar(500) NOT NULL,
  `time_uploaded` varchar(500) NOT NULL,
  `col_taskId` varchar(500) NOT NULL,
  `task_colours` varchar(500) NOT NULL,
  `visibility` varchar(500) NOT NULL,
  `col_path` text NOT NULL,
  `col_company_Id` varchar(500) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_clients_task_records`
--

INSERT INTO `tbl_clients_task_records` (`id`, `uryyToeSS4`, `client_taskName`, `client_task_details`, `care_call1`, `care_call2`, `care_call3`, `care_call4`, `extra_call1`, `extra_call2`, `extra_call3`, `extra_call4`, `col_extra_visit`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `saturday`, `sunday`, `tast_anytimeSession`, `task_startDate`, `task_endDate`, `col_fifo`, `col_occurence`, `col_period_one`, `col_period_two`, `date_uploaded`, `time_uploaded`, `col_taskId`, `task_colours`, `visibility`, `col_path`, `col_company_Id`, `dateTime`) VALUES
(1, '1028', 'Assist with adaptive equipment', 'The carer will see this note in the app each time they complete this task.', 'Morning', 'Lunch', 'Tea', 'Bed', '', '', '', '', '', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Anytime/Session', '2025-10-24', '', '', '2025-10-24', '', 'Daily', '', '', '001', '#000', 'Not updated', 'task-report-form', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 11:21:40'),
(2, '1028', 'Assist with admin tasks', 'The carer will see this note in the app each time they complete this task.', 'Morning', 'Lunch', 'Tea', 'Bed', '', '', '', '', '', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Anytime/Session', '2025-10-24', '', '', '2025-10-24', '', 'Daily', '', '', '002', '#000', 'Not updated', 'task-report-form', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 11:21:57'),
(3, '1028', 'Assist with awareness campaigns', 'The carer will see this note in the app each time they complete this task.', 'Morning', 'Lunch', 'Tea', 'Bed', '', '', '', '', '', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Anytime/Session', '2025-10-24', '', '', '2025-10-24', '', 'Daily', '', '', '003', '#000', 'Not updated', 'task-report-form', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 11:22:16'),
(4, '1037', 'Assist with balance exercises', 'The carer will see this note in the app each time they complete this task.', 'Morning', 'Lunch', 'Tea', 'Bed', '', '', '', '', '', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Anytime/Session', '2025-10-24', '', '', '2025-10-24', '', 'Daily', '', '', '004', '#000', 'Not updated', 'task-report-form', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 11:29:30'),
(5, '1037', 'Assist with bathing', 'The carer will see this note in the app each time they complete this task.', 'Morning', 'Lunch', 'Tea', 'Bed', '', '', '', '', '', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Anytime/Session', '2025-10-24', '', '', '2025-10-24', '', 'Daily', '', '', '005', '#000', 'Not updated', 'task-report-form', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 11:29:53'),
(6, '1030', 'Assist with change of pad', 'The carer will see this note in the app each time they complete this task', 'Morning', 'Lunch', 'Tea', 'Bed', '', '', '', '', '', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Anytime/Session', '2025-10-24', '', '', '2025-10-24', '', 'Daily', '', '', '006', '#000', 'Not updated', 'task-report-form', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 11:34:39'),
(7, '1023', 'Maintenance and repairs', 'Follow the care plan for all tasks and activities, including personal care and meals.\r\nAdminister medications as prescribed and record the time.\r\nObserve and report any changes in health, mood, or behavior.', 'Morning', 'Lunch', 'Tea', 'Bed', '', '', '', '', '', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Anytime/Session', '2025-10-24', '', '', '2025-10-24', '', 'Daily', '', '', '007', '#000', 'Not updated', 'task-report-form', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 11:36:41'),
(8, '1033', 'Assist with daily routine', 'Follow the care plan for all tasks and activities, including personal care and meals.\r\nAdminister medications as prescribed and record the time.\r\nObserve and report any changes in health, mood, or behavior.', 'Morning', 'Lunch', 'Tea', 'Bed', '', '', '', '', '', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Anytime/Session', '2025-10-24', '', '', '2025-10-24', '', 'Daily', '', '', '008', '#000', 'Not updated', 'task-report-form', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 11:38:58'),
(9, '1033', 'Assist with assisted living tasks', 'Follow the care plan for all tasks and activities, including personal care and meals.\r\nAdminister medications as prescribed and record the time.\r\nObserve and report any changes in health, mood, or behavior.', 'Morning', 'Lunch', 'Tea', 'Bed', '', '', '', '', '', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Anytime/Session', '2025-10-24', '', '', '2025-10-24', '', 'Daily', '', '', '009', '#000', 'Not updated', 'task-report-form', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 11:39:10'),
(10, '1035', 'Occupational therapy', 'Follow the care plan for all tasks and activities, including personal care and meals.\r\nAdminister medications as prescribed and record the time.\r\nObserve and report any changes in health, mood, or behavior.', 'Morning', 'Lunch', 'Tea', 'Bed', '', '', '', '', '', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Anytime/Session', '2025-10-24', '', '', '2025-10-24', '', 'Daily', '', '', '0010', '#000', 'Not updated', 'task-report-form', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 11:40:20'),
(11, '1035', 'Physiotherapy session', 'Follow the care plan for all tasks and activities, including personal care and meals.\r\nAdminister medications as prescribed and record the time.\r\nObserve and report any changes in health, mood, or behavior.', 'Morning', 'Lunch', 'Tea', 'Bed', '', '', '', '', '', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Anytime/Session', '2025-10-24', '', '', '2025-10-24', '', 'Daily', '', '', '0011', '#000', 'Not updated', 'task-report-form', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 11:40:38'),
(12, '1035', 'Wellbeing programs', 'Follow the care plan for all tasks and activities, including personal care and meals.\r\nAdminister medications as prescribed and record the time.\r\nObserve and report any changes in health, mood, or behavior.', 'Morning', 'Lunch', 'Tea', 'Bed', '', '', '', '', '', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Anytime/Session', '2025-10-24', '', '', '2025-10-24', '', 'Daily', '', '', '0012', '#000', 'Not updated', 'task-report-form', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 11:40:53'),
(13, '1024', 'Assist with adaptive equipment', 'Follow the care plan for all tasks and activities, including personal care and meals.\r\nAdminister medications as prescribed and record the time.\r\nObserve and report any changes in health, mood, or behavior.', 'Morning', 'Lunch', 'Tea', 'Bed', '', '', '', '', '', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Anytime/Session', '2025-10-24', '', '', '2025-10-24', '', 'Daily', '', '', '0013', '#000', 'Not updated', 'task-report-form', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 11:42:22'),
(14, '1024', 'Assist with feeding tube', 'Follow the care plan for all tasks and activities, including personal care and meals.\r\nAdminister medications as prescribed and record the time.\r\nObserve and report any changes in health, mood, or behavior.', 'Morning', 'Lunch', 'Tea', 'Bed', '', '', '', '', '', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Anytime/Session', '2025-10-24', '', '', '2025-10-24', '', 'Daily', '', '', '0014', '#000', 'Not updated', 'task-report-form', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 11:42:37'),
(15, '1024', 'Assist with daily therapy tasks', 'Follow the care plan for all tasks and activities, including personal care and meals.\r\nAdminister medications as prescribed and record the time.\r\nObserve and report any changes in health, mood, or behavior.', 'Morning', 'Lunch', 'Tea', 'Bed', '', '', '', '', '', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Anytime/Session', '2025-10-24', '', '', '2025-10-24', '', 'Daily', '', '', '0015', '#000', 'Not updated', 'task-report-form', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 11:42:52'),
(16, '1025', 'Assist with admin tasks', 'Follow the care plan for all tasks and activities, including personal care and meals.\r\nAdminister medications as prescribed and record the time.\r\nObserve and report any changes in health, mood, or behavior.', 'Morning', 'Lunch', 'Tea', 'Bed', '', '', '', '', '', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Anytime/Session', '2025-10-24', '', '', '2025-10-24', '', 'Daily', '', '', '0016', '#000', 'Not updated', 'task-report-form', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 11:44:30'),
(17, '1025', 'Sanitize surfaces', 'Follow the care plan for all tasks and activities, including personal care and meals.\r\nAdminister medications as prescribed and record the time.\r\nObserve and report any changes in health, mood, or behavior.', 'Morning', 'Lunch', 'Tea', 'Bed', '', '', '', '', '', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Anytime/Session', '2025-10-24', '', '', '2025-10-24', '', 'Daily', '', '', '0017', '#000', 'Not updated', 'task-report-form', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 11:44:44'),
(18, '1025', 'Window cleaning', 'Follow the care plan for all tasks and activities, including personal care and meals.\r\nAdminister medications as prescribed and record the time.\r\nObserve and report any changes in health, mood, or behavior.', 'Morning', 'Lunch', 'Tea', 'Bed', '', '', '', '', '', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Anytime/Session', '2025-10-24', '', '', '2025-10-24', '', 'Daily', '', '', '0018', '#000', 'Not updated', 'task-report-form', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 11:44:57'),
(19, '1034', 'Inspect safety equipment', 'Follow the care plan for all tasks and activities, including personal care and meals.\r\nAdminister medications as prescribed and record the time.\r\nObserve and report any changes in health, mood, or behavior.', 'Morning', 'Lunch', 'Tea', 'Bed', '', '', '', '', '', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Anytime/Session', '2025-10-24', '', '', '2025-10-24', '', 'Daily', '', '', '0019', '#000', 'Not updated', 'task-report-form', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 11:47:33'),
(20, '1034', 'Assist with adaptive equipment', 'Follow the care plan for all tasks and activities, including personal care and meals.\r\nAdminister medications as prescribed and record the time.\r\nObserve and report any changes in health, mood, or behavior.', 'Morning', 'Lunch', 'Tea', 'Bed', '', '', '', '', '', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Anytime/Session', '2025-10-24', '', '', '2025-10-24', '', 'Daily', '', '', '0020', '#000', 'Not updated', 'task-report-form', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 11:47:51'),
(21, '1032', 'Sit-in care', 'Follow the care plan for all tasks and activities, including personal care and meals.\r\nAdminister medications as prescribed and record the time.\r\nObserve and report any changes in health, mood, or behavior.', 'Morning', 'Lunch', 'Tea', 'Bed', '', '', '', '', '', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Anytime/Session', '2025-10-24', '', '', '2025-10-24', '', 'Daily', '', '', '0021', '#000', 'Not updated', 'task-report-form', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 11:49:23'),
(22, '1031', 'Assist with outings', 'Follow the care plan for all tasks and activities, including personal care and meals.\r\nAdminister medications as prescribed and record the time.\r\nObserve and report any changes in health, mood, or behavior.', 'Morning', 'Lunch', 'Tea', 'Bed', '', '', '', '', '', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Anytime/Session', '2025-10-24', '', '', '2025-10-24', '', 'Daily', '', '', '0022', '#000', 'Not updated', 'task-report-form', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 11:53:18'),
(23, '1029', 'Assist with daily therapy tasks', 'Follow the care plan for all tasks and activities, including personal care and meals.\r\nAdminister medications as prescribed and record the time.\r\nObserve and report any changes in health, mood, or behavior.', 'Morning', 'Lunch', 'Tea', 'Bed', '', '', '', '', '', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Anytime/Session', '2025-10-24', '', '', '2025-10-24', '', 'Daily', '', '', '0023', '#000', 'Not updated', 'task-report-form', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 12:01:26'),
(24, '1027', 'Assist with social campaigns', 'Follow the care plan for all tasks and activities, including personal care and meals.\r\nAdminister medications as prescribed and record the time.\r\nObserve and report any changes in health, mood, or behavior.', 'Morning', 'Lunch', 'Tea', 'Bed', '', '', '', '', '', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Anytime/Session', '2025-10-24', '', '', '2025-10-24', '', 'Daily', '', '', '0024', '#000', 'Not updated', 'task-report-form', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 12:11:38'),
(25, '1027', 'Assist with adaptive equipment', 'Follow the care plan for all tasks and activities, including personal care and meals.\r\nAdminister medications as prescribed and record the time.\r\nObserve and report any changes in health, mood, or behavior.', 'Morning', 'Lunch', 'Tea', 'Bed', '', '', '', '', '', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Anytime/Session', '2025-10-24', '', '', '2025-10-24', '', 'Daily', '', '', '0025', '#000', 'Not updated', 'task-report-form', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 12:11:48'),
(26, '1027', 'Assist with daily routine', 'Follow the care plan for all tasks and activities, including personal care and meals.\r\nAdminister medications as prescribed and record the time.\r\nObserve and report any changes in health, mood, or behavior.', 'Morning', 'Lunch', 'Tea', 'Bed', '', '', '', '', '', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Anytime/Session', '2025-10-24', '', '', '2025-10-24', '', 'Daily', '', '', '0026', '#000', 'Not updated', 'task-report-form', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 12:11:59'),
(27, '1027', 'Emergency response', 'Follow the care plan for all tasks and activities, including personal care and meals.\r\nAdminister medications as prescribed and record the time.\r\nObserve and report any changes in health, mood, or behavior.', 'Morning', 'Lunch', 'Tea', 'Bed', '', '', '', '', '', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Anytime/Session', '2025-10-24', '', '', '2025-10-24', '', 'Daily', '', '', '0027', '#000', 'Not updated', 'task-report-form', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 12:15:41'),
(28, '1026', 'Assist with change of pad', 'Follow the care plan for all tasks and activities, including personal care and meals.\r\nAdminister medications as prescribed and record the time.\r\nObserve and report any changes in health, mood, or behavior.', 'Morning', 'Lunch', 'Tea', 'Bed', '', '', '', '', '', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Anytime/Session', '2025-10-24', '', '', '2025-10-24', '', 'Daily', '', '', '0028', '#000', 'Not updated', 'task-report-form', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 12:17:01'),
(29, '1026', 'Assist with bathing', 'Follow the care plan for all tasks and activities, including personal care and meals.\r\nAdminister medications as prescribed and record the time.\r\nObserve and report any changes in health, mood, or behavior.', 'Morning', 'Lunch', 'Tea', 'Bed', '', '', '', '', '', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Anytime/Session', '2025-10-24', '', '', '2025-10-24', '', 'Daily', '', '', '0029', '#000', 'Not updated', 'task-report-form', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 12:17:12'),
(30, '1031', 'Sit-in care', 'Follow the care plan for all tasks and activities, including personal care and meals.\r\nAdminister medications as prescribed and record the time.\r\nObserve and report any changes in health, mood, or behavior.', '', '', '', '', 'EM morning call', '', '', '', '', 'Monday', '', 'Wednesday', '', 'Friday', '', '', 'Anytime/Session', '2025-10-24', '', '', '2025-10-24', '', 'Daily', '', '', '0030', '#000', 'Not updated', 'task-report-form', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 12:46:41');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_clienttime_calls`
--

CREATE TABLE `tbl_clienttime_calls` (
  `id` int(11) NOT NULL,
  `client_name` varchar(500) NOT NULL,
  `client_area` varchar(500) NOT NULL,
  `client_city` varchar(500) NOT NULL,
  `uryyToeSS4` varchar(500) NOT NULL,
  `care_calls` varchar(500) NOT NULL,
  `dateTime_in` varchar(500) NOT NULL,
  `dateTime_out` varchar(500) NOT NULL,
  `col_monday` varchar(500) NOT NULL,
  `col_tuesday` varchar(500) NOT NULL,
  `col_wednesday` varchar(500) NOT NULL,
  `col_thursday` varchar(500) NOT NULL,
  `col_friday` varchar(500) NOT NULL,
  `col_saturday` varchar(500) NOT NULL,
  `col_sunday` varchar(500) NOT NULL,
  `col_client_funding` varchar(500) NOT NULL,
  `col_funding_rate` varchar(500) NOT NULL,
  `col_required_carers` varchar(500) NOT NULL,
  `col_startDate` varchar(500) NOT NULL,
  `col_endDate` varchar(500) NOT NULL,
  `col_occurence` varchar(500) NOT NULL,
  `col_period_one` varchar(500) NOT NULL,
  `col_period_two` varchar(500) NOT NULL,
  `col_right_to_display` varchar(500) NOT NULL,
  `col_val_Id` varchar(500) NOT NULL,
  `col_company_Id` varchar(500) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_clienttime_calls`
--

INSERT INTO `tbl_clienttime_calls` (`id`, `client_name`, `client_area`, `client_city`, `uryyToeSS4`, `care_calls`, `dateTime_in`, `dateTime_out`, `col_monday`, `col_tuesday`, `col_wednesday`, `col_thursday`, `col_friday`, `col_saturday`, `col_sunday`, `col_client_funding`, `col_funding_rate`, `col_required_carers`, `col_startDate`, `col_endDate`, `col_occurence`, `col_period_one`, `col_period_two`, `col_right_to_display`, `col_val_Id`, `col_company_Id`, `dateTime`) VALUES
(1, 'Curran Dante', 'Cannock', 'Wolverhampton', '1023', 'Morning', '06:50', '07:51', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 09:47:04'),
(2, 'Curran Dante', 'Cannock', 'Wolverhampton', '1023', 'Lunch', '11:55', '13:20', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 09:47:04'),
(3, 'Curran Dante', 'Cannock', 'Wolverhampton', '1023', 'Tea', '16:35', '17:48', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 09:47:04'),
(4, 'Curran Dante', 'Cannock', 'Wolverhampton', '1023', 'Bed', '20:25', '21:53', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 09:47:04'),
(5, 'Gloria Kyle', 'Codsall', 'Wolverhampton', '1024', 'Morning', '07:55', '09:14', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 09:47:04'),
(6, 'Gloria Kyle', 'Codsall', 'Wolverhampton', '1024', 'Lunch', '12:25', '13:35', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 09:47:04'),
(7, 'Gloria Kyle', 'Codsall', 'Wolverhampton', '1024', 'Tea', '16:20', '17:25', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 09:47:04'),
(8, 'Gloria Kyle', 'Codsall', 'Wolverhampton', '1024', 'Bed', '20:50', '21:38', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 09:47:04'),
(9, 'Kamal Kenneth', 'Codsall', 'Wolverhampton', '1025', 'Morning', '06:10', '07:27', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 09:47:04'),
(10, 'Kamal Kenneth', 'Codsall', 'Wolverhampton', '1025', 'Lunch', '12:30', '14:00', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 09:47:04'),
(11, 'Kamal Kenneth', 'Codsall', 'Wolverhampton', '1025', 'Tea', '17:40', '18:56', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 09:47:04'),
(12, 'Kamal Kenneth', 'Codsall', 'Wolverhampton', '1025', 'Bed', '20:30', '21:37', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 09:47:04'),
(13, 'Taylor Carla', 'Codsall', 'Wolverhampton', '1026', 'Morning', '07:00', '08:22', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 09:47:04'),
(14, 'Taylor Carla', 'Codsall', 'Wolverhampton', '1026', 'Lunch', '11:25', '12:43', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 09:47:04'),
(15, 'Taylor Carla', 'Codsall', 'Wolverhampton', '1026', 'Tea', '16:50', '17:56', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 09:47:04'),
(16, 'Taylor Carla', 'Codsall', 'Wolverhampton', '1026', 'Bed', '20:35', '22:05', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 09:47:04'),
(17, 'Summer Declan', 'Codsall', 'Wolverhampton', '1027', 'Morning', '07:10', '08:40', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 09:47:04'),
(18, 'Summer Declan', 'Codsall', 'Wolverhampton', '1027', 'Lunch', '11:10', '11:55', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 09:47:04'),
(19, 'Summer Declan', 'Codsall', 'Wolverhampton', '1027', 'Tea', '17:00', '18:09', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 09:47:04'),
(20, 'Summer Declan', 'Codsall', 'Wolverhampton', '1027', 'Bed', '20:35', '21:28', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 09:47:04'),
(21, 'Caldwell Isaiah', 'Codsall', 'Wolverhampton', '1028', 'Morning', '07:25', '08:48', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 09:47:04'),
(22, 'Caldwell Isaiah', 'Codsall', 'Wolverhampton', '1028', 'Lunch', '12:35', '13:33', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 09:47:04'),
(23, 'Caldwell Isaiah', 'Codsall', 'Wolverhampton', '1028', 'Tea', '16:15', '17:31', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 09:47:04'),
(24, 'Caldwell Isaiah', 'Codsall', 'Wolverhampton', '1028', 'Bed', '20:40', '21:38', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 09:47:04'),
(25, 'Rhona Chastity', 'Cannock', 'Wolverhampton', '1029', 'Morning', '07:15', '08:28', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 09:47:04'),
(26, 'Rhona Chastity', 'Cannock', 'Wolverhampton', '1029', 'Lunch', '12:15', '13:30', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 09:47:04'),
(27, 'Rhona Chastity', 'Cannock', 'Wolverhampton', '1029', 'Tea', '16:30', '17:20', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 09:47:04'),
(28, 'Rhona Chastity', 'Cannock', 'Wolverhampton', '1029', 'Bed', '20:40', '21:38', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 09:47:04'),
(29, 'Autumn Fletcher', 'Cannock', 'Wolverhampton', '1030', 'Morning', '06:15', '07:13', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 09:47:04'),
(30, 'Autumn Fletcher', 'Cannock', 'Wolverhampton', '1030', 'Lunch', '11:55', '12:51', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 09:47:04'),
(31, 'Autumn Fletcher', 'Cannock', 'Wolverhampton', '1030', 'Tea', '16:10', '17:32', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 09:47:04'),
(32, 'Autumn Fletcher', 'Cannock', 'Wolverhampton', '1030', 'Bed', '20:55', '21:59', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 09:47:04'),
(33, 'Peter Ori', 'Cannock', 'Wolverhampton', '1031', 'Morning', '07:50', '09:00', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 09:47:04'),
(34, 'Peter Ori', 'Cannock', 'Wolverhampton', '1031', 'Lunch', '11:15', '12:20', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 09:47:04'),
(35, 'Peter Ori', 'Cannock', 'Wolverhampton', '1031', 'Tea', '16:50', '17:46', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 09:47:04'),
(36, 'Peter Ori', 'Cannock', 'Wolverhampton', '1031', 'Bed', '20:50', '21:37', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 09:47:04'),
(37, 'Kylan Tamekah', 'Cannock', 'Wolverhampton', '1032', 'Morning', '07:15', '08:42', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 09:47:04'),
(38, 'Kylan Tamekah', 'Cannock', 'Wolverhampton', '1032', 'Lunch', '12:50', '13:56', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 09:47:04'),
(39, 'Kylan Tamekah', 'Cannock', 'Wolverhampton', '1032', 'Tea', '17:40', '18:50', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 09:47:04'),
(40, 'Kylan Tamekah', 'Cannock', 'Wolverhampton', '1032', 'Bed', '20:40', '22:10', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 09:47:04'),
(41, 'Destiny Russell', 'Kidderminster', 'Wolverhampton', '1033', 'Morning', '07:55', '08:55', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 09:47:04'),
(42, 'Destiny Russell', 'Kidderminster', 'Wolverhampton', '1033', 'Lunch', '11:45', '12:54', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 09:47:04'),
(43, 'Destiny Russell', 'Kidderminster', 'Wolverhampton', '1033', 'Tea', '17:35', '18:21', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 09:47:04'),
(44, 'Destiny Russell', 'Kidderminster', 'Wolverhampton', '1033', 'Bed', '20:20', '21:28', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 09:47:04'),
(45, 'Kerry Kessie', 'Kidderminster', 'Wolverhampton', '1034', 'Morning', '06:55', '07:41', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 09:47:04'),
(46, 'Kerry Kessie', 'Kidderminster', 'Wolverhampton', '1034', 'Lunch', '11:05', '12:10', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 09:47:04'),
(47, 'Kerry Kessie', 'Kidderminster', 'Wolverhampton', '1034', 'Tea', '17:15', '18:39', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 09:47:04'),
(48, 'Kerry Kessie', 'Kidderminster', 'Wolverhampton', '1034', 'Bed', '20:05', '21:06', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 09:47:04'),
(49, 'Galvin Janna', 'Kidderminster', 'Wolverhampton', '1035', 'Morning', '06:15', '07:03', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 09:47:04'),
(50, 'Galvin Janna', 'Kidderminster', 'Wolverhampton', '1035', 'Lunch', '11:15', '12:04', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 09:47:04'),
(51, 'Galvin Janna', 'Kidderminster', 'Wolverhampton', '1035', 'Tea', '17:55', '18:56', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 09:47:04'),
(52, 'Galvin Janna', 'Kidderminster', 'Wolverhampton', '1035', 'Bed', '20:15', '21:04', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 09:47:04'),
(53, 'Katell Todd', 'Kidderminster', 'Wolverhampton', '1036', 'Morning', '07:55', '08:59', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 09:47:04'),
(54, 'Katell Todd', 'Kidderminster', 'Wolverhampton', '1036', 'Lunch', '11:20', '12:18', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 09:47:04'),
(55, 'Katell Todd', 'Kidderminster', 'Wolverhampton', '1036', 'Tea', '16:30', '17:57', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 09:47:04'),
(56, 'Katell Todd', 'Kidderminster', 'Wolverhampton', '1036', 'Bed', '20:35', '21:24', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 09:47:04'),
(57, 'Armand Forrest', 'Kidderminster', 'Wolverhampton', '1037', 'Morning', '07:45', '09:06', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 09:47:04'),
(58, 'Armand Forrest', 'Kidderminster', 'Wolverhampton', '1037', 'Lunch', '11:35', '12:50', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 09:47:04'),
(59, 'Armand Forrest', 'Kidderminster', 'Wolverhampton', '1037', 'Tea', '17:45', '18:51', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 09:47:04'),
(60, 'Armand Forrest', 'Kidderminster', 'Wolverhampton', '1037', 'Bed', '20:20', '21:09', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 09:47:04'),
(61, 'Peter Ori', 'Cannock', 'Wolverhampton', '1031', 'EM morning call', '08:45', '21:00', 'Monday', '', 'Wednesday', '', 'Friday', '', '', 'Staffordshire dom care', '24.95', '1', '', '', '', '', 'Daily', 'True', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 12:46:08');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_client_invoice`
--

CREATE TABLE `tbl_client_invoice` (
  `userId` int(11) NOT NULL,
  `col_invoice_date` varchar(500) NOT NULL,
  `col_invoice_time` varchar(500) NOT NULL,
  `col_client_name` varchar(500) NOT NULL,
  `col_contract_rate` varchar(500) NOT NULL,
  `col_worked_time` varchar(500) NOT NULL,
  `col_client_Id` varchar(500) NOT NULL,
  `col_special_Id` varchar(500) NOT NULL,
  `col_company_Id` varchar(500) NOT NULL,
  `col_date` varchar(500) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_client_medical`
--

CREATE TABLE `tbl_client_medical` (
  `id` int(11) NOT NULL,
  `col_nhs_number` varchar(500) NOT NULL,
  `col_medical_support` varchar(500) NOT NULL,
  `col_dnar` varchar(500) NOT NULL,
  `col_allergies` varchar(500) NOT NULL,
  `col_gp_name` varchar(500) NOT NULL,
  `col_phone_number` varchar(500) NOT NULL,
  `gp_email_address` varchar(500) NOT NULL,
  `gp_address` varchar(500) NOT NULL,
  `col_pharmancy_name` varchar(500) NOT NULL,
  `pharmacy_phone` varchar(500) NOT NULL,
  `col_pharmancy_address` varchar(500) NOT NULL,
  `col_swname` varchar(500) DEFAULT NULL,
  `col_swaddress` varchar(500) DEFAULT NULL,
  `col_swtelephone` varchar(500) DEFAULT NULL,
  `col_distnurse` varchar(500) DEFAULT NULL,
  `uryyToeSS4` varchar(500) NOT NULL,
  `col_company_Id` varchar(500) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_client_nok`
--

CREATE TABLE `tbl_client_nok` (
  `userId` int(11) NOT NULL,
  `col_first_name` varchar(500) NOT NULL,
  `col_last_name` varchar(500) NOT NULL,
  `col_relationship` varchar(500) NOT NULL,
  `col_phone_number` varchar(500) NOT NULL,
  `col_type_ofContact` varchar(500) NOT NULL,
  `nok_emailaddress` varchar(500) NOT NULL,
  `col_client_statement` varchar(500) NOT NULL,
  `lpa_documents` varchar(500) NOT NULL,
  `uryyToeSS4` varchar(500) NOT NULL,
  `col_company_Id` varchar(500) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_client_notes`
--

CREATE TABLE `tbl_client_notes` (
  `userId` int(11) NOT NULL,
  `team_name` varchar(500) NOT NULL,
  `uryyToeSS4` varchar(500) NOT NULL,
  `client_note` text NOT NULL,
  `dateof_note` varchar(500) NOT NULL,
  `timeof_note` varchar(500) NOT NULL,
  `col_company_Id` varchar(500) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_client_notes`
--

INSERT INTO `tbl_client_notes` (`userId`, `team_name`, `uryyToeSS4`, `client_note`, `dateof_note`, `timeof_note`, `col_company_Id`, `date`) VALUES
(1, '', '1023', 'Upload client latest update.', '', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-23 11:11:54'),
(2, '', '1024', 'Upload client latest update.', '', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 08:43:42'),
(3, '', '1025', 'Upload client latest update.', '', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 08:45:34'),
(4, '', '1026', 'Upload client latest update.', '', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 08:45:50'),
(5, '', '1027', 'Upload client latest update.', '', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 08:46:09'),
(6, '', '1028', 'Upload client latest update.', '', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 08:46:22'),
(7, '', '1029', 'Upload client latest update.', '', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 10:20:15'),
(8, '', '1030', 'Upload client latest update.', '', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 10:20:47'),
(9, '', '1031', 'Upload client latest update.', '', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 10:20:59'),
(10, '', '1032', 'Upload client latest update.', '', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 10:21:17'),
(11, '', '1033', 'Upload client latest update.', '', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 10:26:02'),
(12, '', '1034', 'Upload client latest update.', '', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 10:26:11'),
(13, '', '1035', 'Upload client latest update.', '', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 10:26:23'),
(14, '', '1036', 'Upload client latest update.', '', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 10:26:33'),
(15, '', '1037', 'Upload client latest update.', '', '', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 10:26:48');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_client_runs`
--

CREATE TABLE `tbl_client_runs` (
  `id` int(11) NOT NULL,
  `run_name` varchar(500) NOT NULL,
  `run_town` varchar(500) NOT NULL,
  `col_run_city` varchar(500) NOT NULL,
  `run_ids` varchar(500) NOT NULL,
  `comp_location_view` varchar(500) NOT NULL,
  `col_company_Id` varchar(500) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_client_runs`
--

INSERT INTO `tbl_client_runs` (`id`, `run_name`, `run_town`, `col_run_city`, `run_ids`, `comp_location_view`, `col_company_Id`, `dateTime`) VALUES
(1, 'Codsall Single Run - Only', 'Null', 'Wolverhampton', '1', 'Wolverhampton', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 12:22:55'),
(2, 'Kinderminster Single Late Run', 'Null', 'Wolverhampton', '2', 'Wolverhampton', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 12:27:51'),
(3, 'Codsall Double Male Run - Only', 'Null', 'Wolverhampton', '3', 'Wolverhampton', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 12:31:14'),
(4, 'Codsall Double Female Run - Only', 'Null', 'Wolverhampton', '4', 'Wolverhampton', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 12:34:40'),
(5, 'Kidderminster Double Male Run - Only', 'Null', 'Wolverhampton', '5', 'Wolverhampton', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 12:36:46'),
(6, 'Kidderminster Double Female Run - Only', 'Null', 'Wolverhampton', '6', 'Wolverhampton', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 12:38:12'),
(7, 'Cannock Double Female Run - Only', 'Null', 'Wolverhampton', '7', 'Wolverhampton', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 12:41:46'),
(8, 'Cannock Double Male Run - Only', 'Null', 'Wolverhampton', '8', 'Wolverhampton', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 12:43:39'),
(9, 'Peter Ori Sit-In-Call', 'Null', 'Wolverhampton', '9', 'Wolverhampton', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 12:47:24');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_client_status_records`
--

CREATE TABLE `tbl_client_status_records` (
  `id` int(11) NOT NULL,
  `col_client_name` varchar(500) NOT NULL,
  `col_reason` varchar(500) NOT NULL,
  `col_time` varchar(500) NOT NULL,
  `col_note` varchar(500) NOT NULL,
  `col_status_color` varchar(500) NOT NULL,
  `col_start_date` varchar(500) NOT NULL,
  `col_end_date` varchar(500) NOT NULL,
  `col_active_date` varchar(500) NOT NULL,
  `client_city` varchar(500) NOT NULL,
  `col_client_Id` varchar(500) NOT NULL,
  `col_company_Id` varchar(500) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contract`
--

CREATE TABLE `tbl_contract` (
  `userId` int(11) NOT NULL,
  `col_all` varchar(500) NOT NULL,
  `col_name` varchar(500) NOT NULL,
  `col_payer` varchar(500) NOT NULL,
  `col_service_type` varchar(500) NOT NULL,
  `col_rate_card` varchar(500) NOT NULL,
  `col_invoice_format` varchar(500) NOT NULL,
  `col_invoice_group` varchar(500) NOT NULL,
  `col_payer_Id` varchar(500) NOT NULL,
  `col_special_Id` varchar(500) NOT NULL,
  `col_company_Id` varchar(500) NOT NULL,
  `col_date` varchar(500) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_daily_shift_records`
--

CREATE TABLE `tbl_daily_shift_records` (
  `id` int(11) NOT NULL,
  `shift_status` varchar(500) NOT NULL,
  `shift_date` varchar(500) NOT NULL,
  `planned_timeIn` varchar(500) NOT NULL,
  `planned_timeOut` varchar(500) NOT NULL,
  `shift_start_time` varchar(500) NOT NULL,
  `shift_end_time` varchar(500) NOT NULL,
  `client_name` varchar(500) NOT NULL,
  `uryyToeSS4` varchar(500) NOT NULL,
  `col_care_call` varchar(500) NOT NULL,
  `client_group` varchar(500) NOT NULL,
  `carer_Name` varchar(500) NOT NULL,
  `task_note` text NOT NULL,
  `col_carer_Id` varchar(500) NOT NULL,
  `timesheet_date` varchar(500) NOT NULL,
  `col_area_Id` varchar(1000) NOT NULL,
  `col_company_Id` varchar(500) NOT NULL,
  `col_call_status` varchar(500) NOT NULL,
  `col_carecall_rate` varchar(500) NOT NULL,
  `col_miles` varchar(500) NOT NULL,
  `col_mileage` varchar(500) NOT NULL,
  `col_worked_time` varchar(500) NOT NULL,
  `col_client_rate` varchar(500) NOT NULL,
  `col_client_payer` varchar(500) NOT NULL,
  `col_visit_status` varchar(500) NOT NULL,
  `col_visit_confirmation` varchar(500) NOT NULL,
  `col_care_call_Id` varchar(500) NOT NULL,
  `col_postcode` varchar(500) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_documents`
--

CREATE TABLE `tbl_documents` (
  `userId` int(11) NOT NULL,
  `col_description` varchar(500) NOT NULL,
  `col_document` varchar(500) NOT NULL,
  `uryyTteamoeSS4` varchar(500) NOT NULL,
  `col_company_Id` varchar(500) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_finished_meds`
--

CREATE TABLE `tbl_finished_meds` (
  `id` int(11) NOT NULL,
  `meds` varchar(500) NOT NULL,
  `med_date` varchar(500) NOT NULL,
  `timeIn` varchar(500) NOT NULL,
  `note` text NOT NULL,
  `uniqueId` varchar(500) NOT NULL,
  `uryyToeSS4` varchar(500) NOT NULL,
  `carer_Id` varchar(500) NOT NULL,
  `carer_name` varchar(500) NOT NULL,
  `care_calls` varchar(500) NOT NULL,
  `col_status` varchar(500) NOT NULL,
  `col_company_Id` varchar(500) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_finished_tasks`
--

CREATE TABLE `tbl_finished_tasks` (
  `id` int(11) NOT NULL,
  `task` varchar(500) NOT NULL,
  `task_date` varchar(500) NOT NULL,
  `timeIn` varchar(500) NOT NULL,
  `note` text NOT NULL,
  `uniqueId` varchar(500) NOT NULL,
  `uryyToeSS4` varchar(500) NOT NULL,
  `carer_Id` varchar(500) NOT NULL,
  `carer_name` varchar(500) NOT NULL,
  `care_calls` varchar(500) NOT NULL,
  `col_status` varchar(500) NOT NULL,
  `col_company_Id` varchar(500) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_funding`
--

CREATE TABLE `tbl_funding` (
  `userId` int(11) NOT NULL,
  `uryyToeSS4` varchar(50) NOT NULL,
  `company_id` varchar(50) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `la_funding` varchar(50) DEFAULT NULL,
  `private_funding` varchar(50) DEFAULT NULL,
  `nhs_funding` varchar(50) DEFAULT NULL,
  `order_funding` varchar(50) DEFAULT NULL,
  `local_authority_id` varchar(100) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_future_planning`
--

CREATE TABLE `tbl_future_planning` (
  `id` int(11) NOT NULL,
  `col_first_box` varchar(500) DEFAULT NULL,
  `col_second_box` varchar(500) DEFAULT NULL,
  `col_third_box` varchar(500) DEFAULT NULL,
  `col_fourt_box` varchar(500) DEFAULT NULL,
  `col_fift_box` varchar(500) DEFAULT NULL,
  `col_sixth_box` varchar(500) DEFAULT NULL,
  `col_seventh_box` varchar(500) DEFAULT NULL,
  `uryyToeSS4` varchar(500) DEFAULT NULL,
  `col_company_Id` varchar(500) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_future_planning`
--

INSERT INTO `tbl_future_planning` (`id`, `col_first_box`, `col_second_box`, `col_third_box`, `col_fourt_box`, `col_fift_box`, `col_sixth_box`, `col_seventh_box`, `uryyToeSS4`, `col_company_Id`, `dateTime`) VALUES
(1, 'Est consequatur sit', 'Cupidatat ex itaque ', 'Aut ea accusamus dol', 'Do Not', 'Provident neque nul', 'Enim perspiciatis d', 'Fugit fugiat volupt', '1028', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 11:12:12');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_general_client_form`
--

CREATE TABLE `tbl_general_client_form` (
  `id` int(11) NOT NULL,
  `client_title` varchar(500) NOT NULL,
  `client_first_name` varchar(500) NOT NULL,
  `client_last_name` varchar(500) NOT NULL,
  `client_middle_name` varchar(500) NOT NULL,
  `client_preferred_name` varchar(500) NOT NULL,
  `client_email_address` varchar(500) NOT NULL,
  `client_referred_to` varchar(500) NOT NULL,
  `client_date_of_birth` varchar(500) NOT NULL,
  `client_ailment` varchar(500) NOT NULL,
  `client_primary_phone` varchar(500) NOT NULL,
  `col_second_phone` text NOT NULL,
  `client_culture_religion` varchar(500) NOT NULL,
  `client_sexuality` varchar(500) NOT NULL,
  `client_area` varchar(500) NOT NULL,
  `client_address_line_1` varchar(500) NOT NULL,
  `client_address_line_2` varchar(500) NOT NULL,
  `client_city` varchar(500) NOT NULL,
  `client_county` varchar(500) NOT NULL,
  `client_poster_code` varchar(500) NOT NULL,
  `client_country` varchar(500) NOT NULL,
  `client_access_details` varchar(500) NOT NULL,
  `client_highlights` text NOT NULL,
  `col_Office_Incharge` text NOT NULL,
  `clientStart_date` varchar(500) NOT NULL,
  `clientEnd_date` varchar(500) NOT NULL,
  `uryyToeSS4` varchar(500) NOT NULL,
  `client_service` varchar(500) NOT NULL,
  `what_is_important_to_me` text NOT NULL,
  `my_likes_and_dislikes` text NOT NULL,
  `my_current_condition` text NOT NULL,
  `my_medical_history` text NOT NULL,
  `my_physical_health` text NOT NULL,
  `my_mental_health` text NOT NULL,
  `how_i_communicate` text NOT NULL,
  `assistive_equipment_i_use` text NOT NULL,
  `client_latitude` varchar(500) NOT NULL,
  `client_longitude` varchar(500) NOT NULL,
  `col_pay_rate` varchar(500) NOT NULL,
  `col_swn_number` text NOT NULL,
  `col_qrcode_path` varchar(500) NOT NULL,
  `geolocation` varchar(500) DEFAULT NULL,
  `qrcode` varchar(500) DEFAULT NULL,
  `col_company_Id` varchar(500) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_general_client_form`
--

INSERT INTO `tbl_general_client_form` (`id`, `client_title`, `client_first_name`, `client_last_name`, `client_middle_name`, `client_preferred_name`, `client_email_address`, `client_referred_to`, `client_date_of_birth`, `client_ailment`, `client_primary_phone`, `col_second_phone`, `client_culture_religion`, `client_sexuality`, `client_area`, `client_address_line_1`, `client_address_line_2`, `client_city`, `client_county`, `client_poster_code`, `client_country`, `client_access_details`, `client_highlights`, `col_Office_Incharge`, `clientStart_date`, `clientEnd_date`, `uryyToeSS4`, `client_service`, `what_is_important_to_me`, `my_likes_and_dislikes`, `my_current_condition`, `my_medical_history`, `my_physical_health`, `my_mental_health`, `how_i_communicate`, `assistive_equipment_i_use`, `client_latitude`, `client_longitude`, `col_pay_rate`, `col_swn_number`, `col_qrcode_path`, `geolocation`, `qrcode`, `col_company_Id`, `dateTime`) VALUES
(1, 'Mr.', 'Curran', 'Dante', 'Slade', 'Moses', 'hycexab@mailinator.com', 'She/Her', '1971-12-17', 'Thane', '+44 (113) 341-5558', '', 'Christianity', 'Male', 'Cannock', '1', 'Culwell Street', 'Wolverhampton', 'West Midlands', 'WV10 0JT', 'United Kingdom', 'None', 'can refer to a personal introduction, a self-reflection essay, or the premise of a game. In a personal introduction, you describe yourself with facts like your name, age, and location, along with your interests and goals. A self-reflection can delve deeper into your character, beliefs, and journey, while the game involves other people guessing your identity based on clues. ', 'Wolverhampton', '1992-09-26T23:40', '', '1023', 'Child care', '', '', '', '', '', '', '', '', '52.589199', '-2.1207331', '', '', '', 'Active', 'Inactive', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 13:32:57'),
(2, 'Mr.', 'Gloria', 'Kyle', 'Ginger', 'Ezra', 'gemahydaw@mailinator.com', 'She/Her', '1985-02-25', 'Neil', '+44 (113) 341-3828', '', 'Nonreligious', 'Female', 'Codsall', '10', '10 Carter Ave', 'Wolverhampton', 'West Midlands', 'WV8 1HH', 'United Kingdom', 'Omnis autem omnis ve', 'Occaecat est dolor a', 'Wolverhampton', '1979-11-02T00:54', '', '1024', 'Domiciliary care', '', '', '', '', '', '', '', '', '52.6257088', '-2.184189', '', '', '', 'Active', 'Inactive', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 13:33:26'),
(3, 'Miss.', 'Kamal', 'Kenneth', 'Grace', 'Isaac', 'paras@mailinator.com', 'They/Them', '2001-07-19', 'Blossom', '+44 (486) 205-9395', '', 'Judaism', 'Other', 'Codsall', '10', '10 Carter Ave', 'Wolverhampton', 'West Midlands', 'WV8 1HH', 'United Kingdom', 'Quia suscipit evenie', 'Aut dolor nihil eius', 'Wolverhampton', '2005-01-10T07:21', '', '1025', 'Domiciliary care', '', '', '', '', '', '', '', '', '52.6257088', '-2.184189', '', '', '', 'Active', 'Inactive', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 12:55:30'),
(4, 'Mrs.', 'Taylor', 'Carla', 'Hiram', 'Amelia', 'wyxizefyx@mailinator.com', 'She/Her', '1990-03-14', 'Ginger', '+44 (998) 171-2491', '', 'Buddhism', 'Other', 'Codsall', '10', '10 Carter Ave', 'Wolverhampton', 'West Midlands', 'WV8 1HH', 'United Kingdom', 'Ut qui irure non qui', 'Modi magna voluptas ', 'Wolverhampton', '1972-12-19T21:02', '', '1026', 'Domiciliary care', '', '', '', '', '', '', '', '', '52.6257088', '-2.184189', '', '', '', 'Active', 'Inactive', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 13:34:58'),
(5, 'Sir.', 'Summer', 'Declan', 'Kalia', 'Xaviera', 'furewigec@mailinator.com', 'They/Them', '1935-05-22', 'Seth', '+44 (269) 156-1655', '', 'Hinduism', 'Male', 'Codsall', '10', '10 Carter Ave', 'Wolverhampton', 'West Midlands', 'WV8 1HH', 'United Kingdom', 'Ut voluptatem elit ', 'Qui eos facere cum v', 'Wolverhampton', '2000-02-12T21:44', '', '1027', 'Domiciliary care', '', '', '', '', '', '', '', '', '52.6257088', '-2.184189', '', '', '', 'Active', 'Inactive', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 13:34:50'),
(6, 'Mrs.', 'Caldwell', 'Isaiah', 'Althea', 'Elmo', 'wemadas@mailinator.com', 'He/Him', '1975-07-22', 'Gavin', '+44 (956) 317-6224', '+1 (972) 874-9982', 'Tenrikyo', 'Male', 'Codsall', '10', '10 Carter Ave', 'Wolverhampton', 'West Midlands', 'WV8 1HH', 'United Kingdom', 'Illum nulla duis en', 'In sit porro repelle', 'Wolverhampton', '2002-11-15T11:59', '', '1028', 'Domiciliary care', '', '', '', '', '', '', '', '', '52.6257088', '-2.184189', '', '916788', '', 'Active', 'Inactive', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 13:32:49'),
(7, 'Mr.', 'Rhona', 'Chastity', 'Charissa', 'Angelica', 'nafexehe@mailinator.com', 'They/Them', '1971-03-08', 'Gary', '+44 (404) 327-2086', '', 'Juche', 'Male', 'Cannock', '153', 'Ground Floor, Avon Rd', 'Wolverhampton', 'West Midlands', 'WS11 1LF', 'United Kingdom', 'Cumque facilis offic', 'Maxime suscipit sit ', 'Wolverhampton', '2006-01-20T08:08', '', '1029', 'Domiciliary care', '', '', '', '', '', '', '', '', '52.5868159', '-2.1256587', '', '', '', 'Active', 'Inactive', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 13:34:42'),
(8, 'Mrs.', 'Autumn', 'Fletcher', 'Finn', 'Scarlett', 'tufyc@mailinator.com', 'She/Her', '1933-02-14', 'Simon', '+44 (932) 123-7104', '', 'Rastafarianism', 'Female', 'Cannock', '153', 'Ground Floor, Avon Rd', 'Wolverhampton', 'West Midlands', 'WS11 1LF', 'United Kingdom', 'Maiores voluptatem ', 'Ducimus qui tempor ', 'Wolverhampton', '1989-10-07T20:26', '', '1030', 'Domiciliary care', '', '', '', '', '', '', '', '', '52.5868159', '-2.1256587', '', '', '', 'Active', 'Inactive', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 13:32:41'),
(9, 'Ms.', 'Peter', 'Ori', 'Fritz', 'Dahlia', 'jafucy@mailinator.com', 'He/Him', '1940-10-27', 'Sybil', '+44 (976) 346-1094', '', 'Zoroastrianism', 'Other', 'Cannock', '153', 'Ground Floor, Avon Rd', 'Wolverhampton', 'West Midlands', 'WS11 1LF', 'United Kingdom', 'Commodi quia dolorem', 'Facilis veniam qui ', 'Wolverhampton', '2012-11-20T17:48', '', '1031', 'Domiciliary care', '', '', '', '', '', '', '', '', '52.5868159', '-2.1256587', '', '', '', 'Active', 'Inactive', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 13:34:35'),
(10, 'Prof.', 'Kylan', 'Tamekah', 'Amy', 'Noah', 'kejyzytoh@mailinator.com', 'He/Him', '1945-11-04', 'Scott', '+44 (304) 915-3414', '', 'Islam', 'Male', 'Cannock', '153', 'Ground Floor, Avon Rd', 'Wolverhampton', 'West Midlands', 'WS11 1LF', 'United Kingdom', 'Nihil quis omnis qui', 'Adipisci fuga Reici', 'Wolverhampton', '2012-09-10T08:53', '', '1032', 'Domiciliary care', '', '', '', '', '', '', '', '', '52.5868159', '-2.1256587', '', '', '', 'Active', 'Inactive', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 13:34:25'),
(11, 'Lord.', 'Destiny', 'Russell', 'Wanda', 'Chanda', 'tibyqo@mailinator.com', 'She/Her', '1939-09-23', 'Inga', '+44 (353) 418-5273', '', 'Nonreligious', 'Female', 'Kidderminster', '111', 'Sutton Rd', 'Wolverhampton', 'West Midlands', 'DY11 7BB', 'United Kingdom', 'Recusandae Qui ex s', 'Pariatur Excepturi ', 'Wolverhampton', '1998-12-04T16:40', '', '1033', 'Domiciliary care', '', '', '', '', '', '', '', '', '52.5499177', '-2.1142209', '', '', '', 'Active', 'Inactive', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 13:33:05'),
(12, 'Miss.', 'Kerry', 'Kessie', 'Fredericka', 'Samantha', 'juhipetyz@mailinator.com', 'He/Him', '1946-01-11', 'Barclay', '+44 (432) 444-3804', '', 'Baha\'i', 'Male', 'Kidderminster', '111', 'Sutton Rd', 'Wolverhampton', 'West Midlands', 'DY11 7BB', 'United Kingdom', 'Enim incidunt ad ne', 'Commodo molestiae in', 'Wolverhampton', '1987-02-16T11:53', '', '1034', 'Domiciliary care', '', '', '', '', '', '', '', '', '52.5499177', '-2.1142209', '', '', '', 'Active', 'Inactive', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 13:34:00'),
(13, 'Prof.', 'Galvin', 'Janna', 'Quin', 'Ila', 'cawu@mailinator.com', 'They/Them', '1937-12-23', 'Avye', '+44 (602) 447-4252', '', 'primal-indigenous', 'Male', 'Kidderminster', '111', 'Sutton Rd', 'Wolverhampton', 'West Midlands', 'DY11 7BB', 'United Kingdom', 'Perferendis dignissi', 'Quo quibusdam maxime', 'Wolverhampton', '1975-07-16T13:25', '', '1035', 'Domiciliary care', '', '', '', '', '', '', '', '', '52.5499177', '-2.1142209', '', '', '', 'Active', 'Inactive', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 13:33:13'),
(14, 'Lord.', 'Katell', 'Todd', 'Cassandra', 'Carolyn', 'mewexuledu@mailinator.com', 'She/Her', '1946-08-15', 'Eleanor', '+44 (155) 705-4017', '', 'Secular', 'Female', 'Kidderminster', '111', 'Sutton Rd', 'Wolverhampton', 'West Midlands', 'DY11 7BB', 'United Kingdom', 'Proident quia imped', 'Excepteur ut et alia', 'Wolverhampton', '1994-10-04T03:14', '', '1036', 'Domiciliary care', '', '', '', '', '', '', '', '', '52.5499177', '-2.1142209', '', '', '', 'Active', 'Inactive', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 13:33:49'),
(15, 'Lord.', 'Armand', 'Forrest', 'Dillon', 'Avye', 'watyfapoj@mailinator.com', 'She/Her', '1944-05-10', 'Regan', '+44 (176) 947-8837', '', 'Secular', 'Male', 'Kidderminster', '111', 'Sutton Rd', 'Wolverhampton', 'West Midlands', 'DY11 7BB', 'United Kingdom', 'Id error reprehender', 'Quia eum placeat re', 'Wolverhampton', '2021-12-06T16:34', '', '1037', 'Domiciliary care', 'Dolore ea esse dolor', '', '', '', '', '', '', '', '52.5499177', '-2.1142209', '', '', '', 'Active', 'Inactive', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 13:32:35');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_general_team_form`
--

CREATE TABLE `tbl_general_team_form` (
  `id` int(11) NOT NULL,
  `team_title` varchar(500) NOT NULL,
  `team_first_name` varchar(500) NOT NULL,
  `team_last_name` varchar(500) NOT NULL,
  `team_middle_name` varchar(500) NOT NULL,
  `team_preferred_name` varchar(500) NOT NULL,
  `team_email_address` varchar(500) NOT NULL,
  `team_referred_to` varchar(500) NOT NULL,
  `team_date_of_birth` varchar(500) NOT NULL,
  `team_nationality` varchar(500) NOT NULL,
  `team_primary_phone` varchar(500) NOT NULL,
  `team_culture_religion` varchar(500) NOT NULL,
  `team_sexuality` varchar(500) NOT NULL,
  `team_dbs` varchar(500) NOT NULL,
  `team_nin` varchar(500) NOT NULL,
  `team_address_line_1` varchar(500) NOT NULL,
  `team_address_line_2` varchar(500) NOT NULL,
  `team_city` varchar(500) NOT NULL,
  `team_county` varchar(500) NOT NULL,
  `team_poster_code` varchar(500) NOT NULL,
  `team_country` varchar(500) NOT NULL,
  `uryyTteamoeSS4` varchar(500) NOT NULL,
  `transportation` varchar(500) NOT NULL,
  `col_pay_rate` varchar(500) NOT NULL,
  `col_rate_type` varchar(500) NOT NULL,
  `col_mileage` text NOT NULL,
  `employment_type` varchar(500) NOT NULL,
  `col_company_city` varchar(500) NOT NULL,
  `col_start_date` varchar(500) NOT NULL,
  `col_company_Id` varchar(500) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_general_team_form`
--

INSERT INTO `tbl_general_team_form` (`id`, `team_title`, `team_first_name`, `team_last_name`, `team_middle_name`, `team_preferred_name`, `team_email_address`, `team_referred_to`, `team_date_of_birth`, `team_nationality`, `team_primary_phone`, `team_culture_religion`, `team_sexuality`, `team_dbs`, `team_nin`, `team_address_line_1`, `team_address_line_2`, `team_city`, `team_county`, `team_poster_code`, `team_country`, `uryyTteamoeSS4`, `transportation`, `col_pay_rate`, `col_rate_type`, `col_mileage`, `employment_type`, `col_company_city`, `col_start_date`, `col_company_Id`, `dateTime`) VALUES
(1, 'Mr.', 'Osaretin', 'Samson', 'Gift', 'Ese', 'samsonosaretin@yahoo.com', 'He/Him', '1992-07-27', 'Nigeria', '+44 (328) 264-7854', 'Christianity', 'Male', 'ER47758756453533', 'TL999583', '1', 'Culwell Street', 'Wolverhampton', 'West Midlands', 'wv10 0jt', 'United Kingdom', '20001', 'car', '14.30', 'Senior Carer', '0.00', 'Full-time employment', 'Wolverhampton', '2025-10-25', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 09:28:23'),
(2, 'Mr.', 'Ingrid', 'Orla', 'Quynn', 'Chancellor', 'padebyno@mailinator.com', 'He/Him', '1976-04-19', 'Nigeria', '+44 (228) 264-9990', 'primal-indigenous', 'Male', 'RE8857556637333', 'CV588595', '26', 'Waterloo Road', 'Wolverhampton', 'West Midlands', 'wv1 5nu', 'United Kingdom', '20002', 'bicycle', '13.21', 'Assistant Carer', '0.00', 'Full-time employment', 'Wolverhampton', '2025-10-25', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 09:28:32'),
(3, 'Mrs.', 'Cruz', 'Abra', 'Addison', 'Stella', 'besyv@mailinator.com', 'He/Him', '1964-12-27', 'India', '+44 (398) 264-4138', 'Hinduism', 'Male', 'YT47744646464', 'T499L99', '88', 'Stafford Road', 'Wolverhampton', 'West Midlands', 'wv6 9np', 'United Kingdom', '20003', 'car', '20.52', 'Nurce', '0.00', 'Full-time employment', 'Wolverhampton', '2025-10-25', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 09:28:40');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_group_list`
--

CREATE TABLE `tbl_group_list` (
  `id` int(11) NOT NULL,
  `group_area` varchar(500) NOT NULL,
  `group_city` varchar(500) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_group_list`
--

INSERT INTO `tbl_group_list` (`id`, `group_area`, `group_city`, `dateTime`) VALUES
(1, 'Pattingham', 'Wolverhampton', '2025-10-23 10:58:56'),
(2, 'Codsall', 'Wolverhampton', '2025-10-23 10:58:56'),
(3, 'Perton', 'Wolverhampton', '2025-10-23 10:58:56'),
(4, 'Tettenhall', 'Wolverhampton', '2025-10-23 10:58:56'),
(5, 'Penn', 'Wolverhampton', '2025-10-23 10:58:56'),
(6, 'Wednesfield', 'Wolverhampton', '2025-10-23 10:58:56'),
(7, 'Bilston', 'Wolverhampton', '2025-10-23 10:58:56'),
(8, 'Whitmore Reans', 'Wolverhampton', '2025-10-23 10:58:56'),
(9, 'Bushbury', 'Wolverhampton', '2025-10-23 10:58:56'),
(10, 'Oxley', 'Wolverhampton', '2025-10-23 10:58:56'),
(11, 'Cannock', 'Staffordshire', '2025-10-23 10:58:56'),
(12, 'Hednesford', 'Staffordshire', '2025-10-23 10:58:56'),
(13, 'Norton Canes', 'Staffordshire', '2025-10-23 10:58:56'),
(14, 'Rugeley', 'Staffordshire', '2025-10-23 10:58:56'),
(15, 'Lichfield', 'Staffordshire', '2025-10-23 10:58:56'),
(16, 'Burntwood', 'Staffordshire', '2025-10-23 10:58:56'),
(17, 'Tamworth', 'Staffordshire', '2025-10-23 10:58:56'),
(18, 'Stafford', 'Staffordshire', '2025-10-23 10:58:56'),
(19, 'Stone', 'Staffordshire', '2025-10-23 10:58:56'),
(20, 'Eccleshall', 'Staffordshire', '2025-10-23 10:58:56'),
(21, 'Birmingham City Centre', 'Birmingham', '2025-10-23 10:58:56'),
(22, 'Selly Oak', 'Birmingham', '2025-10-23 10:58:56'),
(23, 'Harborne', 'Birmingham', '2025-10-23 10:58:56'),
(24, 'Edgbaston', 'Birmingham', '2025-10-23 10:58:56'),
(25, 'Moseley', 'Birmingham', '2025-10-23 10:58:56'),
(26, 'Kings Heath', 'Birmingham', '2025-10-23 10:58:56'),
(27, 'Erdington', 'Birmingham', '2025-10-23 10:58:56'),
(28, 'Sutton Coldfield', 'Birmingham', '2025-10-23 10:58:56'),
(29, 'Handsworth', 'Birmingham', '2025-10-23 10:58:56'),
(30, 'Perry Barr', 'Birmingham', '2025-10-23 10:58:56'),
(31, 'Walsall', 'West Midlands', '2025-10-23 10:58:56'),
(32, 'Bloxwich', 'West Midlands', '2025-10-23 10:58:56'),
(33, 'Aldridge', 'West Midlands', '2025-10-23 10:58:56'),
(34, 'Willenhall', 'West Midlands', '2025-10-23 10:58:56'),
(35, 'Darlaston', 'West Midlands', '2025-10-23 10:58:56'),
(36, 'Brownhills', 'West Midlands', '2025-10-23 10:58:56'),
(37, 'Leamore', 'West Midlands', '2025-10-23 10:58:56'),
(38, 'Short Heath', 'West Midlands', '2025-10-23 10:58:56'),
(39, 'Shelfield', 'West Midlands', '2025-10-23 10:58:56'),
(40, 'Pelsall', 'West Midlands', '2025-10-23 10:58:56'),
(41, 'Dudley', 'West Midlands', '2025-10-23 10:58:56'),
(42, 'Stourbridge', 'West Midlands', '2025-10-23 10:58:56'),
(43, 'Halesowen', 'West Midlands', '2025-10-23 10:58:56'),
(44, 'Brierley Hill', 'West Midlands', '2025-10-23 10:58:56'),
(45, 'Kingswinford', 'West Midlands', '2025-10-23 10:58:56'),
(46, 'Sedgley', 'West Midlands', '2025-10-23 10:58:56'),
(47, 'Gornal', 'West Midlands', '2025-10-23 10:58:56'),
(48, 'Coseley', 'West Midlands', '2025-10-23 10:58:56'),
(49, 'Netherton', 'West Midlands', '2025-10-23 10:58:56'),
(50, 'Wordsley', 'West Midlands', '2025-10-23 10:58:56'),
(51, 'Telford', 'Shropshire', '2025-10-23 10:58:56'),
(52, 'Wellington', 'Shropshire', '2025-10-23 10:58:56'),
(53, 'Oakengates', 'Shropshire', '2025-10-23 10:58:56'),
(54, 'Madeley', 'Shropshire', '2025-10-23 10:58:56'),
(55, 'Newport', 'Shropshire', '2025-10-23 10:58:56'),
(56, 'Ironbridge', 'Shropshire', '2025-10-23 10:58:56'),
(57, 'Bridgnorth', 'Shropshire', '2025-10-23 10:58:56'),
(58, 'Ludlow', 'Shropshire', '2025-10-23 10:58:56'),
(59, 'Shrewsbury', 'Shropshire', '2025-10-23 10:58:56'),
(60, 'Whitchurch', 'Shropshire', '2025-10-23 10:58:56'),
(61, 'Coventry City Centre', 'Coventry', '2025-10-23 10:58:56'),
(62, 'Tile Hill', 'Coventry', '2025-10-23 10:58:56'),
(63, 'Earlsdon', 'Coventry', '2025-10-23 10:58:56'),
(64, 'Canley', 'Coventry', '2025-10-23 10:58:56'),
(65, 'Foleshill', 'Coventry', '2025-10-23 10:58:56'),
(66, 'Stoke', 'Coventry', '2025-10-23 10:58:56'),
(67, 'Radford', 'Coventry', '2025-10-23 10:58:56'),
(68, 'Binley', 'Coventry', '2025-10-23 10:58:56'),
(69, 'Wyken', 'Coventry', '2025-10-23 10:58:56'),
(70, 'Cheylesmore', 'Coventry', '2025-10-23 10:58:56'),
(71, 'Solihull', 'West Midlands', '2025-10-23 10:58:56'),
(72, 'Shirley', 'West Midlands', '2025-10-23 10:58:56'),
(73, 'Olton', 'West Midlands', '2025-10-23 10:58:56'),
(74, 'Knowle', 'West Midlands', '2025-10-23 10:58:56'),
(75, 'Dorridge', 'West Midlands', '2025-10-23 10:58:56'),
(76, 'Balsall Common', 'West Midlands', '2025-10-23 10:58:56'),
(77, 'Cheswick Green', 'West Midlands', '2025-10-23 10:58:56'),
(78, 'Meriden', 'West Midlands', '2025-10-23 10:58:56'),
(79, 'Monkspath', 'West Midlands', '2025-10-23 10:58:56'),
(80, 'Elmdon', 'West Midlands', '2025-10-23 10:58:56'),
(81, 'Worcester', 'Worcestershire', '2025-10-23 10:58:56'),
(82, 'Droitwich Spa', 'Worcestershire', '2025-10-23 10:58:56'),
(83, 'Malvern', 'Worcestershire', '2025-10-23 10:58:56'),
(84, 'Evesham', 'Worcestershire', '2025-10-23 10:58:56'),
(85, 'Pershore', 'Worcestershire', '2025-10-23 10:58:56'),
(86, 'Bewdley', 'Worcestershire', '2025-10-23 10:58:56'),
(87, 'Kidderminster', 'Worcestershire', '2025-10-23 10:58:56'),
(88, 'Bromsgrove', 'Worcestershire', '2025-10-23 10:58:56'),
(89, 'Stourport-on-Severn', 'Worcestershire', '2025-10-23 10:58:56'),
(90, 'Tenbury Wells', 'Worcestershire', '2025-10-23 10:58:56'),
(91, 'Burton upon Trent', 'Staffordshire', '2025-10-23 10:58:56'),
(92, 'Uttoxeter', 'Staffordshire', '2025-10-23 10:58:56'),
(93, 'Swadlincote', 'Derbyshire', '2025-10-23 10:58:56'),
(94, 'Derby City Centre', 'Derbyshire', '2025-10-23 10:58:56'),
(95, 'Mickleover', 'Derbyshire', '2025-10-23 10:58:56'),
(96, 'Allestree', 'Derbyshire', '2025-10-23 10:58:56'),
(97, 'Littleover', 'Derbyshire', '2025-10-23 10:58:56'),
(98, 'Chesterfield', 'Derbyshire', '2025-10-23 10:58:56'),
(99, 'Matlock', 'Derbyshire', '2025-10-23 10:58:56'),
(100, 'Buxton', 'Derbyshire', '2025-10-23 10:58:56'),
(101, 'Nottingham City Centre', 'Nottinghamshire', '2025-10-23 10:58:56'),
(102, 'Beeston', 'Nottinghamshire', '2025-10-23 10:58:56'),
(103, 'Arnold', 'Nottinghamshire', '2025-10-23 10:58:56'),
(104, 'Carlton', 'Nottinghamshire', '2025-10-23 10:58:56'),
(105, 'West Bridgford', 'Nottinghamshire', '2025-10-23 10:58:56'),
(106, 'Mansfield', 'Nottinghamshire', '2025-10-23 10:58:56'),
(107, 'Newark-on-Trent', 'Nottinghamshire', '2025-10-23 10:58:56'),
(108, 'Worksop', 'Nottinghamshire', '2025-10-23 10:58:56'),
(109, 'Retford', 'Nottinghamshire', '2025-10-23 10:58:56'),
(110, 'Hucknall', 'Nottinghamshire', '2025-10-23 10:58:56'),
(111, 'Leicester City Centre', 'Leicestershire', '2025-10-23 10:58:56'),
(112, 'Loughborough', 'Leicestershire', '2025-10-23 10:58:56'),
(113, 'Hinckley', 'Leicestershire', '2025-10-23 10:58:56'),
(114, 'Coalville', 'Leicestershire', '2025-10-23 10:58:56'),
(115, 'Market Harborough', 'Leicestershire', '2025-10-23 10:58:56'),
(116, 'Melton Mowbray', 'Leicestershire', '2025-10-23 10:58:56'),
(117, 'Wigston', 'Leicestershire', '2025-10-23 10:58:56'),
(118, 'Ashby-de-la-Zouch', 'Leicestershire', '2025-10-23 10:58:56'),
(119, 'Oadby', 'Leicestershire', '2025-10-23 10:58:56'),
(120, 'Shepshed', 'Leicestershire', '2025-10-23 10:58:56'),
(121, 'London City Centre', 'London', '2025-10-23 10:58:56'),
(122, 'Camden', 'London', '2025-10-23 10:58:56'),
(123, 'Islington', 'London', '2025-10-23 10:58:56'),
(124, 'Hackney', 'London', '2025-10-23 10:58:56'),
(125, 'Kensington', 'London', '2025-10-23 10:58:56'),
(126, 'Chelsea', 'London', '2025-10-23 10:58:56'),
(127, 'Hammersmith', 'London', '2025-10-23 10:58:56'),
(128, 'Fulham', 'London', '2025-10-23 10:58:56'),
(129, 'Greenwich', 'London', '2025-10-23 10:58:56'),
(130, 'Bromley', 'London', '2025-10-23 10:58:56'),
(131, 'Kent', 'Kent', '2025-10-23 10:58:56'),
(132, 'Maidstone', 'Kent', '2025-10-23 10:58:56'),
(133, 'Dartford', 'Kent', '2025-10-23 10:58:56'),
(134, 'Tunbridge Wells', 'Kent', '2025-10-23 10:58:56'),
(135, 'Sevenoaks', 'Kent', '2025-10-23 10:58:56'),
(136, 'Canterbury', 'Kent', '2025-10-23 10:58:56'),
(137, 'Tonbridge', 'Kent', '2025-10-23 10:58:56'),
(138, 'Ashford', 'Kent', '2025-10-23 10:58:56'),
(139, 'Folkestone', 'Kent', '2025-10-23 10:58:56'),
(140, 'Rochester', 'Kent', '2025-10-23 10:58:56'),
(141, 'Lancashire', 'Lancashire', '2025-10-23 10:58:56'),
(142, 'Blackburn', 'Lancashire', '2025-10-23 10:58:56'),
(143, 'Blackpool', 'Lancashire', '2025-10-23 10:58:56'),
(144, 'Preston', 'Lancashire', '2025-10-23 10:58:56'),
(145, 'Burnley', 'Lancashire', '2025-10-23 10:58:56'),
(146, 'Clitheroe', 'Lancashire', '2025-10-23 10:58:56'),
(147, 'Lancaster', 'Lancashire', '2025-10-23 10:58:56'),
(148, 'Morecambe', 'Lancashire', '2025-10-23 10:58:56'),
(149, 'Ormskirk', 'Lancashire', '2025-10-23 10:58:56'),
(150, 'Fleetwood', 'Lancashire', '2025-10-23 10:58:56'),
(151, 'York', 'North Yorkshire', '2025-10-23 10:58:56'),
(152, 'Harrogate', 'North Yorkshire', '2025-10-23 10:58:56'),
(153, 'Scarborough', 'North Yorkshire', '2025-10-23 10:58:56'),
(154, 'Whitby', 'North Yorkshire', '2025-10-23 10:58:56'),
(155, 'Ripon', 'North Yorkshire', '2025-10-23 10:58:56'),
(156, 'Selby', 'North Yorkshire', '2025-10-23 10:58:56'),
(157, 'Knaresborough', 'North Yorkshire', '2025-10-23 10:58:56'),
(158, 'Malton', 'North Yorkshire', '2025-10-23 10:58:56'),
(159, 'Thirsk', 'North Yorkshire', '2025-10-23 10:58:56'),
(160, 'Easingwold', 'North Yorkshire', '2025-10-23 10:58:56'),
(161, 'Essex', 'Essex', '2025-10-23 10:58:56'),
(162, 'Chelmsford', 'Essex', '2025-10-23 10:58:56'),
(163, 'Colchester', 'Essex', '2025-10-23 10:58:56'),
(164, 'Southend-on-Sea', 'Essex', '2025-10-23 10:58:56'),
(165, 'Basildon', 'Essex', '2025-10-23 10:58:56'),
(166, 'Harlow', 'Essex', '2025-10-23 10:58:56'),
(167, 'Brentwood', 'Essex', '2025-10-23 10:58:56'),
(168, 'Clacton-on-Sea', 'Essex', '2025-10-23 10:58:56'),
(169, 'Braintree', 'Essex', '2025-10-23 10:58:56'),
(170, 'Witham', 'Essex', '2025-10-23 10:58:56'),
(171, 'Surrey', 'Surrey', '2025-10-23 10:58:56'),
(172, 'Guildford', 'Surrey', '2025-10-23 10:58:56'),
(173, 'Woking', 'Surrey', '2025-10-23 10:58:56'),
(174, 'Epsom', 'Surrey', '2025-10-23 10:58:56'),
(175, 'Reigate', 'Surrey', '2025-10-23 10:58:56'),
(176, 'Redhill', 'Surrey', '2025-10-23 10:58:56'),
(177, 'Farnham', 'Surrey', '2025-10-23 10:58:56'),
(178, 'Camberley', 'Surrey', '2025-10-23 10:58:56'),
(179, 'Godalming', 'Surrey', '2025-10-23 10:58:56'),
(180, 'Leatherhead', 'Surrey', '2025-10-23 10:58:56'),
(181, 'Hampshire', 'Hampshire', '2025-10-23 10:58:56'),
(182, 'Winchester', 'Hampshire', '2025-10-23 10:58:56'),
(183, 'Southampton', 'Hampshire', '2025-10-23 10:58:56'),
(184, 'Portsmouth', 'Hampshire', '2025-10-23 10:58:56'),
(185, 'Andover', 'Hampshire', '2025-10-23 10:58:56'),
(186, 'Basingstoke', 'Hampshire', '2025-10-23 10:58:56'),
(187, 'Farnborough', 'Hampshire', '2025-10-23 10:58:56'),
(188, 'Fleet', 'Hampshire', '2025-10-23 10:58:56'),
(189, 'Lymington', 'Hampshire', '2025-10-23 10:58:56'),
(190, 'Ringwood', 'Hampshire', '2025-10-23 10:58:56');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_holiday`
--

CREATE TABLE `tbl_holiday` (
  `userId` int(11) NOT NULL,
  `col_description` varchar(500) NOT NULL,
  `col_holiday_date` varchar(500) NOT NULL,
  `col_pay_multiplier` varchar(500) NOT NULL,
  `col_charge_multiplier` varchar(500) NOT NULL,
  `col_special_Id` varchar(500) NOT NULL,
  `col_date` varchar(500) NOT NULL,
  `col_company_Id` varchar(500) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_holiday`
--

INSERT INTO `tbl_holiday` (`userId`, `col_description`, `col_holiday_date`, `col_pay_multiplier`, `col_charge_multiplier`, `col_special_Id`, `col_date`, `col_company_Id`, `dateTime`) VALUES
(1, 'Winter Bank Holiday', '2025-10-24', '15.00', '5.00', '1024', '2025-10-24', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 10:04:56'),
(2, 'Good Friday', '2025-04-20', '14.92', '5.00', '1024', '2025-10-24', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24 10:06:51');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoices`
--

CREATE TABLE `tbl_invoices` (
  `userId` int(11) NOT NULL,
  `col_invoice_Id` varchar(500) NOT NULL,
  `col_payer` varchar(500) NOT NULL,
  `col_payer_rate` varchar(500) NOT NULL,
  `col_time_in` varchar(500) NOT NULL,
  `col_time_out` varchar(500) NOT NULL,
  `col_care_recipient` varchar(500) NOT NULL,
  `col_worked_rate` varchar(500) NOT NULL,
  `col_worked_time` varchar(500) NOT NULL,
  `col_invoice_start_date` varchar(500) NOT NULL,
  `col_invoice_end_date` varchar(500) NOT NULL,
  `col_carer_Id` varchar(500) NOT NULL,
  `col_client_Id` varchar(500) NOT NULL,
  `col_company_Id` varchar(500) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoice_rate`
--

CREATE TABLE `tbl_invoice_rate` (
  `userId` int(11) NOT NULL,
  `col_name` varchar(500) NOT NULL,
  `col_days` varchar(500) NOT NULL,
  `col_applies` varchar(500) NOT NULL,
  `col_type` varchar(500) NOT NULL,
  `col_rates` varchar(500) NOT NULL,
  `col_service_type` varchar(500) NOT NULL,
  `col_fee_name` varchar(500) NOT NULL,
  `col_fee_rate` varchar(500) NOT NULL,
  `col_special_Id` varchar(500) NOT NULL,
  `col_company_Id` varchar(500) NOT NULL,
  `col_date` varchar(500) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_invoice_rate`
--

INSERT INTO `tbl_invoice_rate` (`userId`, `col_name`, `col_days`, `col_applies`, `col_type`, `col_rates`, `col_service_type`, `col_fee_name`, `col_fee_rate`, `col_special_Id`, `col_company_Id`, `col_date`, `dateTime`) VALUES
(1, 'Staffordshire dom care', 'All', 'Always', 'Fixed', '24.95', 'Domiciliary care', 'NON', '0.00', '1', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24', '2025-10-24 09:46:18');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_manage_runs`
--

CREATE TABLE `tbl_manage_runs` (
  `id` int(11) NOT NULL,
  `client_name` varchar(500) NOT NULL,
  `col_run_name` varchar(500) NOT NULL,
  `client_area` varchar(500) NOT NULL,
  `col_client_city` varchar(500) NOT NULL,
  `uryyToeSS4` varchar(500) NOT NULL,
  `care_calls` varchar(500) NOT NULL,
  `dateTime_in` varchar(500) NOT NULL,
  `dateTime_out` varchar(500) NOT NULL,
  `col_monday` varchar(500) NOT NULL,
  `col_tuesday` varchar(500) NOT NULL,
  `col_wednesday` varchar(500) NOT NULL,
  `col_thursday` varchar(500) NOT NULL,
  `col_friday` varchar(500) NOT NULL,
  `col_saturday` varchar(500) NOT NULL,
  `col_sunday` varchar(500) NOT NULL,
  `col_client_funding` varchar(500) NOT NULL,
  `col_funding_rate` varchar(500) NOT NULL,
  `col_required_carers` varchar(500) NOT NULL,
  `col_startDate` varchar(500) NOT NULL,
  `col_endDate` varchar(500) NOT NULL,
  `col_occurence` varchar(500) NOT NULL,
  `col_period_one` varchar(500) NOT NULL,
  `col_period_two` varchar(500) NOT NULL,
  `col_right_to_display` varchar(500) NOT NULL,
  `run_area_nameId` varchar(500) NOT NULL,
  `col_status` varchar(500) NOT NULL,
  `checkin_type` varchar(1000) NOT NULL,
  `col_company_Id` varchar(500) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_manage_runs`
--

INSERT INTO `tbl_manage_runs` (`id`, `client_name`, `col_run_name`, `client_area`, `col_client_city`, `uryyToeSS4`, `care_calls`, `dateTime_in`, `dateTime_out`, `col_monday`, `col_tuesday`, `col_wednesday`, `col_thursday`, `col_friday`, `col_saturday`, `col_sunday`, `col_client_funding`, `col_funding_rate`, `col_required_carers`, `col_startDate`, `col_endDate`, `col_occurence`, `col_period_one`, `col_period_two`, `col_right_to_display`, `run_area_nameId`, `col_status`, `checkin_type`, `col_company_Id`, `dateTime`) VALUES
(1, 'Gloria Kyle', 'Codsall Single Run - Only', 'Codsall', 'Wolverhampton', '1024', 'Morning', '07:55', '09:14', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '1', 'rgba(22, 160, 133,1.0)', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:15:32'),
(2, 'Gloria Kyle', 'Codsall Single Run - Only', 'Codsall', 'Wolverhampton', '1024', 'Lunch', '12:25', '13:35', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '1', 'rgba(22, 160, 133,1.0)', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:15:32'),
(3, 'Gloria Kyle', 'Codsall Single Run - Only', 'Codsall', 'Wolverhampton', '1024', 'Tea', '16:20', '17:25', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '1', 'rgba(22, 160, 133,1.0)', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:15:32'),
(4, 'Gloria Kyle', 'Codsall Single Run - Only', 'Codsall', 'Wolverhampton', '1024', 'Bed', '20:50', '21:38', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '1', 'rgba(22, 160, 133,1.0)', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:15:32'),
(5, 'Kamal Kenneth', 'Codsall Single Run - Only', 'Codsall', 'Wolverhampton', '1025', 'Morning', '06:10', '07:27', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '1', 'rgba(22, 160, 133,1.0)', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:14:10'),
(6, 'Kamal Kenneth', 'Codsall Single Run - Only', 'Codsall', 'Wolverhampton', '1025', 'Lunch', '12:30', '14:00', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '1', 'rgba(22, 160, 133,1.0)', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:14:10'),
(7, 'Kamal Kenneth', 'Codsall Single Run - Only', 'Codsall', 'Wolverhampton', '1025', 'Tea', '17:40', '18:56', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '1', 'rgba(22, 160, 133,1.0)', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:14:10'),
(8, 'Kamal Kenneth', 'Codsall Single Run - Only', 'Codsall', 'Wolverhampton', '1025', 'Bed', '20:30', '21:37', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '1', 'rgba(22, 160, 133,1.0)', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:14:10'),
(9, 'Destiny Russell', 'Kinderminster Single Late Run', 'Kidderminster', 'Wolverhampton', '1033', 'Morning', '07:55', '08:55', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '2', 'rgba(22, 160, 133,1.0)', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:14:54'),
(10, 'Destiny Russell', 'Kinderminster Single Late Run', 'Kidderminster', 'Wolverhampton', '1033', 'Lunch', '11:45', '12:54', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '2', 'rgba(22, 160, 133,1.0)', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:14:54'),
(11, 'Destiny Russell', 'Kinderminster Single Late Run', 'Kidderminster', 'Wolverhampton', '1033', 'Tea', '17:35', '18:21', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '2', 'rgba(22, 160, 133,1.0)', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:14:54'),
(12, 'Destiny Russell', 'Kinderminster Single Late Run', 'Kidderminster', 'Wolverhampton', '1033', 'Bed', '20:20', '21:28', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '2', 'rgba(22, 160, 133,1.0)', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:14:54'),
(13, 'Kerry Kessie', 'Kinderminster Single Late Run', 'Kidderminster', 'Wolverhampton', '1034', 'Morning', '06:55', '07:41', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '2', 'rgba(22, 160, 133,1.0)', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:16:00'),
(14, 'Kerry Kessie', 'Kinderminster Single Late Run', 'Kidderminster', 'Wolverhampton', '1034', 'Lunch', '11:05', '12:10', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '2', 'rgba(22, 160, 133,1.0)', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:16:00'),
(15, 'Kerry Kessie', 'Kinderminster Single Late Run', 'Kidderminster', 'Wolverhampton', '1034', 'Tea', '17:15', '18:39', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '2', 'rgba(22, 160, 133,1.0)', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:16:00'),
(16, 'Kerry Kessie', 'Kinderminster Single Late Run', 'Kidderminster', 'Wolverhampton', '1034', 'Bed', '20:05', '21:06', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '2', 'rgba(22, 160, 133,1.0)', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:16:00'),
(17, 'Galvin Janna', 'Kinderminster Single Late Run', 'Kidderminster', 'Wolverhampton', '1035', 'Morning', '06:15', '07:03', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '2', 'rgba(22, 160, 133,1.0)', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:15:08'),
(18, 'Taylor Carla', 'Codsall Double Male Run - Only', 'Codsall', 'Wolverhampton', '1026', 'Morning', '07:00', '08:22', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '3', 'rgba(22, 160, 133,1.0)', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:16:52'),
(19, 'Taylor Carla', 'Codsall Double Male Run - Only', 'Codsall', 'Wolverhampton', '1026', 'Lunch', '11:25', '12:43', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '3', 'rgba(22, 160, 133,1.0)', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:16:52'),
(20, 'Taylor Carla', 'Codsall Double Male Run - Only', 'Codsall', 'Wolverhampton', '1026', 'Tea', '16:50', '17:56', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '3', 'rgba(22, 160, 133,1.0)', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:16:52'),
(21, 'Taylor Carla', 'Codsall Double Male Run - Only', 'Codsall', 'Wolverhampton', '1026', 'Bed', '20:35', '22:05', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '3', 'rgba(22, 160, 133,1.0)', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:16:52'),
(22, 'Summer Declan', 'Codsall Double Male Run - Only', 'Codsall', 'Wolverhampton', '1027', 'Morning', '07:10', '08:40', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '3', 'rgba(22, 160, 133,1.0)', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:16:39'),
(23, 'Summer Declan', 'Codsall Double Male Run - Only', 'Codsall', 'Wolverhampton', '1027', 'Lunch', '11:10', '11:55', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '3', 'rgba(22, 160, 133,1.0)', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:16:39'),
(24, 'Summer Declan', 'Codsall Double Male Run - Only', 'Codsall', 'Wolverhampton', '1027', 'Tea', '17:00', '18:09', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '3', 'rgba(22, 160, 133,1.0)', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:16:39'),
(25, 'Summer Declan', 'Codsall Double Male Run - Only', 'Codsall', 'Wolverhampton', '1027', 'Bed', '20:35', '21:28', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '3', 'rgba(22, 160, 133,1.0)', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:16:39'),
(26, 'Summer Declan', 'Codsall Double Female Run - Only', 'Codsall', 'Wolverhampton', '1027', 'Morning', '07:10', '08:40', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '4', 'rgba(22, 160, 133,1.0)', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:16:39'),
(27, 'Summer Declan', 'Codsall Double Female Run - Only', 'Codsall', 'Wolverhampton', '1027', 'Lunch', '11:10', '11:55', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '4', 'rgba(22, 160, 133,1.0)', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:16:39'),
(28, 'Summer Declan', 'Codsall Double Female Run - Only', 'Codsall', 'Wolverhampton', '1027', 'Tea', '17:00', '18:09', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '4', 'rgba(22, 160, 133,1.0)', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:16:39'),
(29, 'Summer Declan', 'Codsall Double Female Run - Only', 'Codsall', 'Wolverhampton', '1027', 'Bed', '20:35', '21:28', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '4', 'rgba(22, 160, 133,1.0)', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:16:39'),
(30, 'Taylor Carla', 'Codsall Double Female Run - Only', 'Codsall', 'Wolverhampton', '1026', 'Morning', '07:00', '08:22', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '4', 'rgba(22, 160, 133,1.0)', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:16:52'),
(31, 'Taylor Carla', 'Codsall Double Female Run - Only', 'Codsall', 'Wolverhampton', '1026', 'Lunch', '11:25', '12:43', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '4', 'rgba(22, 160, 133,1.0)', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:16:52'),
(32, 'Taylor Carla', 'Codsall Double Female Run - Only', 'Codsall', 'Wolverhampton', '1026', 'Tea', '16:50', '17:56', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '4', 'rgba(22, 160, 133,1.0)', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:16:52'),
(33, 'Taylor Carla', 'Codsall Double Female Run - Only', 'Codsall', 'Wolverhampton', '1026', 'Bed', '20:35', '22:05', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday', 'Staffordshire dom care', '24.95', '2', '2025-10-24', '', '2025-10-24', '', 'Daily', 'True', '4', 'rgba(22, 160, 133,1.0)', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:16:52'),
(34, 'Peter Ori', 'Peter Ori Sit-In-Call', 'Cannock', 'Wolverhampton', '1031', 'EM morning call', '08:45', '21:00', 'Monday', '', 'Wednesday', '', 'Friday', '', '', 'Staffordshire dom care', '24.95', '1', '', '', '', '', 'Daily', 'True', '9', 'rgba(22, 160, 133,1.0)', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:16:20');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_medication_list`
--

CREATE TABLE `tbl_medication_list` (
  `id` int(11) NOT NULL,
  `med_name` varchar(500) NOT NULL,
  `med_dosage` varchar(500) NOT NULL,
  `med_type` varchar(500) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_medication_list`
--

INSERT INTO `tbl_medication_list` (`id`, `med_name`, `med_dosage`, `med_type`, `dateTime`) VALUES
(1, 'Aciclovir', '200mg', 'Antiviral', '2025-10-23 10:37:58'),
(2, 'Adenosine', '6mg', 'Antiarrhythmic', '2025-10-23 10:37:58'),
(3, 'Alendronic acid', '70mg', 'Bisphosphonate', '2025-10-23 10:37:58'),
(4, 'Allopurinol', '100mg', 'Gout Medication', '2025-10-23 10:37:58'),
(5, 'Alprazolam', '0.5mg', 'Anxiolytic', '2025-10-23 10:37:58'),
(6, 'Amiodarone', '200mg', 'Antiarrhythmic', '2025-10-23 10:37:58'),
(7, 'Amitriptyline', '25mg', 'Antidepressant', '2025-10-23 10:37:58'),
(8, 'Amlodipine', '5mg', 'Calcium Channel Blocker', '2025-10-23 10:37:58'),
(9, 'Amoxicillin', '500mg', 'Antibiotic', '2025-10-23 10:37:58'),
(10, 'Anastrozole', '1mg', 'Aromatase Inhibitor', '2025-10-23 10:37:58'),
(11, 'Aripiprazole', '10mg', 'Antipsychotic', '2025-10-23 10:37:58'),
(12, 'Aspirin', '75mg', 'Antiplatelet', '2025-10-23 10:37:58'),
(13, 'Atorvastatin', '20mg', 'Statin', '2025-10-23 10:37:58'),
(14, 'Azathioprine', '50mg', 'Immunosuppressant', '2025-10-23 10:37:58'),
(15, 'Azithromycin', '250mg', 'Antibiotic', '2025-10-23 10:37:58'),
(16, 'Baclofen', '10mg', 'Muscle Relaxant', '2025-10-23 10:37:58'),
(17, 'Benzylpenicillin', '1.2g', 'Antibiotic', '2025-10-23 10:37:58'),
(18, 'Bisoprolol', '5mg', 'Beta Blocker', '2025-10-23 10:37:58'),
(19, 'Budesonide', '200mcg', 'Corticosteroid', '2025-10-23 10:37:58'),
(20, 'Bupropion', '150mg', 'Antidepressant', '2025-10-23 10:37:58'),
(21, 'Captopril', '25mg', 'ACE Inhibitor', '2025-10-23 10:37:58'),
(22, 'Carbamazepine', '200mg', 'Anticonvulsant', '2025-10-23 10:37:58'),
(23, 'Cefalexin', '500mg', 'Antibiotic', '2025-10-23 10:37:58'),
(24, 'Cefuroxime', '250mg', 'Antibiotic', '2025-10-23 10:37:58'),
(25, 'Cetirizine', '10mg', 'Antihistamine', '2025-10-23 10:37:58'),
(26, 'Chlorpromazine', '25mg', 'Antipsychotic', '2025-10-23 10:37:58'),
(27, 'Ciclosporin', '25mg', 'Immunosuppressant', '2025-10-23 10:37:58'),
(28, 'Ciprofloxacin', '500mg', 'Antibiotic', '2025-10-23 10:37:58'),
(29, 'Citalopram', '20mg', 'Antidepressant', '2025-10-23 10:37:58'),
(30, 'Clarithromycin', '250mg', 'Antibiotic', '2025-10-23 10:37:58'),
(31, 'Clonazepam', '1mg', 'Anxiolytic', '2025-10-23 10:37:58'),
(32, 'Clopidogrel', '75mg', 'Antiplatelet', '2025-10-23 10:37:58'),
(33, 'Clozapine', '25mg', 'Antipsychotic', '2025-10-23 10:37:58'),
(34, 'Codeine', '30mg', 'Opioid Analgesic', '2025-10-23 10:37:58'),
(35, 'Colchicine', '0.5mg', 'Gout Medication', '2025-10-23 10:37:58'),
(36, 'Cyclizine', '50mg', 'Antiemetic', '2025-10-23 10:37:58'),
(37, 'Cyclobenzaprine', '10mg', 'Muscle Relaxant', '2025-10-23 10:37:58'),
(38, 'Dantrolene', '25mg', 'Muscle Relaxant', '2025-10-23 10:37:58'),
(39, 'Dexamethasone', '4mg', 'Corticosteroid', '2025-10-23 10:37:58'),
(40, 'Diazepam', '5mg', 'Anxiolytic', '2025-10-23 10:37:58'),
(41, 'Diltiazem', '120mg', 'Calcium Channel Blocker', '2025-10-23 10:37:58'),
(42, 'Doxycycline', '100mg', 'Antibiotic', '2025-10-23 10:37:58'),
(43, 'Duloxetine', '60mg', 'Antidepressant', '2025-10-23 10:37:58'),
(44, 'Enalapril', '5mg', 'ACE Inhibitor', '2025-10-23 10:37:58'),
(45, 'Enoxaparin', '40mg', 'Anticoagulant', '2025-10-23 10:37:58'),
(46, 'Escitalopram', '10mg', 'Antidepressant', '2025-10-23 10:37:58'),
(47, 'Esomeprazole', '40mg', 'Proton Pump Inhibitor', '2025-10-23 10:37:58'),
(48, 'Etoricoxib', '60mg', 'NSAID', '2025-10-23 10:37:58'),
(49, 'Fentanyl', '25mcg', 'Opioid Analgesic', '2025-10-23 10:37:58'),
(50, 'Ferrous sulfate', '200mg', 'Iron Supplement', '2025-10-23 10:37:58'),
(51, 'Finasteride', '5mg', '5-Alpha Reductase Inhibitor', '2025-10-23 10:37:58'),
(52, 'Fluoxetine', '20mg', 'Antidepressant', '2025-10-23 10:37:58'),
(53, 'Fluticasone', '50mcg', 'Corticosteroid', '2025-10-23 10:37:58'),
(54, 'Furosemide', '40mg', 'Diuretic', '2025-10-23 10:37:58'),
(55, 'Gabapentin', '300mg', 'Anticonvulsant', '2025-10-23 10:37:58'),
(56, 'Gliclazide', '80mg', 'Antidiabetic', '2025-10-23 10:37:58'),
(57, 'Glimepiride', '1mg', 'Antidiabetic', '2025-10-23 10:37:58'),
(58, 'Glucagon', '1mg', 'Hypoglycaemia Treatment', '2025-10-23 10:37:58'),
(59, 'Glyceryl trinitrate', '0.3mg', 'Vasodilator', '2025-10-23 10:37:58'),
(60, 'Hydrochlorothiazide', '25mg', 'Diuretic', '2025-10-23 10:37:58'),
(61, 'Hydrocortisone', '20mg', 'Corticosteroid', '2025-10-23 10:37:58'),
(62, 'Ibuprofen', '200mg', 'NSAID', '2025-10-23 10:37:58'),
(63, 'Imipramine', '25mg', 'Antidepressant', '2025-10-23 10:37:58'),
(64, 'Indapamide', '1.5mg', 'Diuretic', '2025-10-23 10:37:58'),
(65, 'Insulin glargine', '10 units', 'Antidiabetic', '2025-10-23 10:37:58'),
(66, 'Insulin lispro', '10 units', 'Antidiabetic', '2025-10-23 10:37:58'),
(67, 'Isosorbide mononitrate', '20mg', 'Vasodilator', '2025-10-23 10:37:58'),
(68, 'Lansoprazole', '30mg', 'Proton Pump Inhibitor', '2025-10-23 10:37:58'),
(69, 'Latanoprost', '0.005%', 'Ophthalmic', '2025-10-23 10:37:58'),
(70, 'Levetiracetam', '500mg', 'Anticonvulsant', '2025-10-23 10:37:58'),
(71, 'Levomepromazine', '25mg', 'Antipsychotic', '2025-10-23 10:37:58'),
(72, 'Levothyroxine', '50mcg', 'Thyroid Hormone', '2025-10-23 10:37:58'),
(73, 'Lisinopril', '10mg', 'ACE Inhibitor', '2025-10-23 10:37:58'),
(74, 'Lithium carbonate', '300mg', 'Mood Stabilizer', '2025-10-23 10:37:58'),
(75, 'Lorazepam', '1mg', 'Anxiolytic', '2025-10-23 10:37:58'),
(76, 'Losartan', '50mg', 'Angiotensin II Receptor Blocker', '2025-10-23 10:37:58'),
(77, 'Loratadine', '10mg', 'Antihistamine', '2025-10-23 10:37:58'),
(78, 'Loperamide', '2mg', 'Antidiarrheal', '2025-10-23 10:37:58'),
(79, 'Lorazepam', '1mg', 'Anxiolytic', '2025-10-23 10:37:58'),
(80, 'Loratadine', '10mg', 'Antihistamine', '2025-10-23 10:37:58'),
(81, 'Loxapine', '10mg', 'Antipsychotic', '2025-10-23 10:37:58'),
(82, 'Magnesium sulfate', '500mg', 'Supplement', '2025-10-23 10:37:58'),
(83, 'Methylprednisolone', '4mg', 'Corticosteroid', '2025-10-23 10:37:58'),
(84, 'Metformin', '500mg', 'Antidiabetic', '2025-10-23 10:37:58'),
(85, 'Methadone', '10mg', 'Opioid Analgesic', '2025-10-23 10:37:58'),
(86, 'Methotrexate', '10mg', 'Immunosuppressant', '2025-10-23 10:37:58'),
(87, 'Methylphenidate', '10mg', 'Stimulant', '2025-10-23 10:37:58'),
(88, 'Midazolam', '10mg', 'Benzodiazepine', '2025-10-23 10:37:58'),
(89, 'Mirtazapine', '15mg', 'Antidepressant', '2025-10-23 10:37:58'),
(90, 'Morphine', '10mg', 'Opioid Analgesic', '2025-10-23 10:37:58'),
(91, 'Mupirocin', '2%', 'Topical Antibiotic', '2025-10-23 10:37:58'),
(92, 'Nabumetone', '500mg', 'NSAID', '2025-10-23 10:37:58'),
(93, 'Naloxone', '400mcg', 'Opioid Antagonist', '2025-10-23 10:37:58'),
(94, 'Naproxen', '250mg', 'NSAID', '2025-10-23 10:37:58'),
(95, 'Nifedipine', '30mg', 'Calcium Channel Blocker', '2025-10-23 10:37:58'),
(96, 'Nitrofurantoin', '50mg', 'Antibiotic', '2025-10-23 10:37:58'),
(97, 'Nitroglycerin', '0.3mg', 'Vasodilator', '2025-10-23 10:37:58'),
(98, 'Nortriptyline', '25mg', 'Antidepressant', '2025-10-23 10:37:58'),
(99, 'Olanzapine', '10mg', 'Antipsychotic', '2025-10-23 10:37:58'),
(100, 'Omeprazole', '20mg', 'Proton Pump Inhibitor', '2025-10-23 10:37:58'),
(101, 'Ondansetron', '4mg', 'Antiemetic', '2025-10-23 10:37:58'),
(102, 'Oxycodone', '5mg', 'Opioid Analgesic', '2025-10-23 10:37:58'),
(103, 'Pantoprazole', '40mg', 'Proton Pump Inhibitor', '2025-10-23 10:37:58'),
(104, 'Paracetamol', '500mg', 'Analgesic', '2025-10-23 10:37:58'),
(105, 'Paroxetine', '20mg', 'Antidepressant', '2025-10-23 10:37:58'),
(106, 'Perindopril', '5mg', 'ACE Inhibitor', '2025-10-23 10:37:58'),
(107, 'Phenytoin', '100mg', 'Anticonvulsant', '2025-10-23 10:37:58'),
(108, 'Pioglitazone', '15mg', 'Antidiabetic', '2025-10-23 10:37:58'),
(109, 'Prednisolone', '5mg', 'Corticosteroid', '2025-10-23 10:37:58'),
(110, 'Pregabalin', '75mg', 'Anticonvulsant', '2025-10-23 10:37:58'),
(111, 'Propranolol', '40mg', 'Beta Blocker', '2025-10-23 10:37:58'),
(112, 'Quetiapine', '25mg', 'Antipsychotic', '2025-10-23 10:37:58'),
(113, 'Ramipril', '5mg', 'ACE Inhibitor', '2025-10-23 10:37:58'),
(114, 'Ranitidine', '150mg', 'H2 Antagonist', '2025-10-23 10:37:58'),
(115, 'Rivastigmine', '3mg', 'Dementia Medication', '2025-10-23 10:37:58'),
(116, 'Rosuvastatin', '10mg', 'Statin', '2025-10-23 10:37:58'),
(117, 'Salbutamol', '100mcg', 'Bronchodilator', '2025-10-23 10:37:58'),
(118, 'Sertraline', '50mg', 'Antidepressant', '2025-10-23 10:37:58'),
(119, 'Simvastatin', '20mg', 'Statin', '2025-10-23 10:37:58'),
(120, 'Sodium valproate', '200mg', 'Anticonvulsant', '2025-10-23 10:37:58'),
(121, 'Spironolactone', '25mg', 'Diuretic', '2025-10-23 10:37:58'),
(122, 'Temazepam', '10mg', 'Hypnotic', '2025-10-23 10:37:58'),
(123, 'Terazosin', '1mg', 'Alpha Blocker', '2025-10-23 10:37:58'),
(124, 'Theophylline', '100mg', 'Bronchodilator', '2025-10-23 10:37:58'),
(125, 'Thiamine', '100mg', 'Vitamin B1 Supplement', '2025-10-23 10:37:58'),
(126, 'Tizanidine', '4mg', 'Muscle Relaxant', '2025-10-23 10:37:58'),
(127, 'Tolterodine', '2mg', 'Anticholinergic', '2025-10-23 10:37:58'),
(128, 'Tramadol', '50mg', 'Opioid Analgesic', '2025-10-23 10:37:58'),
(129, 'Trazodone', '50mg', 'Antidepressant', '2025-10-23 10:37:58'),
(130, 'Valproic acid', '500mg', 'Anticonvulsant', '2025-10-23 10:37:58'),
(131, 'Venlafaxine', '75mg', 'Antidepressant', '2025-10-23 10:37:58'),
(132, 'Warfarin', '5mg', 'Anticoagulant', '2025-10-23 10:37:58'),
(133, 'Zolpidem', '10mg', 'Hypnotic', '2025-10-23 10:37:58'),
(134, 'Zopiclone', '7.5mg', 'Hypnotic', '2025-10-23 10:37:58');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payer`
--

CREATE TABLE `tbl_payer` (
  `userId` int(11) NOT NULL,
  `col_name` varchar(500) NOT NULL,
  `col_email` varchar(500) NOT NULL,
  `col_phone_number` varchar(500) NOT NULL,
  `col_invoice_pref` varchar(500) NOT NULL,
  `col_address` varchar(500) NOT NULL,
  `col_status` varchar(500) NOT NULL,
  `col_special_Id` varchar(500) NOT NULL,
  `col_company_Id` varchar(500) NOT NULL,
  `col_date` varchar(500) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pay_rate`
--

CREATE TABLE `tbl_pay_rate` (
  `userId` int(11) NOT NULL,
  `col_name` varchar(500) NOT NULL,
  `col_days` varchar(500) NOT NULL,
  `col_applies` varchar(500) NOT NULL,
  `col_type` varchar(500) NOT NULL,
  `col_rates` varchar(500) NOT NULL,
  `col_service_type` varchar(500) NOT NULL,
  `col_special_Id` varchar(500) NOT NULL,
  `col_company_Id` varchar(500) NOT NULL,
  `col_date` varchar(500) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_pay_rate`
--

INSERT INTO `tbl_pay_rate` (`userId`, `col_name`, `col_days`, `col_applies`, `col_type`, `col_rates`, `col_service_type`, `col_special_Id`, `col_company_Id`, `col_date`, `dateTime`) VALUES
(1, 'Senior Carer', 'All', 'Always', 'Fixed', '14.30', 'Personal Care', '1021', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24', '2025-10-24 09:29:30'),
(2, 'Assistant Carer', 'All', 'Always', 'Fixed', '13.21', 'Personal Care', '1022', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24', '2025-10-24 09:30:36'),
(3, 'Nurce', 'All', 'Always', 'Fixed', '20.52', 'Personal Care', '1023', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24', '2025-10-24 09:31:20');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pay_run`
--

CREATE TABLE `tbl_pay_run` (
  `userId` int(11) NOT NULL,
  `col_caregiver` varchar(500) NOT NULL,
  `col_Time_In` varchar(500) NOT NULL,
  `col_Time_Out` varchar(500) NOT NULL,
  `col_work_rate` varchar(500) NOT NULL,
  `col_travel_rate` varchar(500) NOT NULL,
  `col_waiting_rate` varchar(500) NOT NULL,
  `col_miles` varchar(500) NOT NULL,
  `col_mileage_rate` varchar(500) NOT NULL,
  `col_extra_rate` varchar(500) NOT NULL,
  `col_start_date` varchar(500) NOT NULL,
  `col_end_date` varchar(500) NOT NULL,
  `col_month` varchar(500) NOT NULL,
  `col_pay_runId` varchar(500) NOT NULL,
  `col_carer_Id` varchar(500) NOT NULL,
  `col_company_Id` varchar(500) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_position`
--

CREATE TABLE `tbl_position` (
  `id` int(11) NOT NULL,
  `position_name` varchar(500) NOT NULL,
  `position_details` varchar(500) NOT NULL,
  `col_company_Id` varchar(500) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_position`
--

INSERT INTO `tbl_position` (`id`, `position_name`, `position_details`, `col_company_Id`, `dateTime`) VALUES
(1, 'Care Assistant', 'Provides personal care and support to clients in care homes or domiciliary settings', 'COMPANY123', '2025-10-23 11:08:00'),
(2, 'Senior Care Assistant', 'Supervises care assistants and assists with complex care tasks', 'COMPANY123', '2025-10-23 11:08:00'),
(3, 'Registered Nurse (RN)', 'Delivers professional nursing care and administers medication', 'COMPANY123', '2025-10-23 11:08:00'),
(4, 'Senior Nurse', 'Leads nursing teams and manages clinical operations', 'COMPANY123', '2025-10-23 11:08:00'),
(5, 'Healthcare Support Worker', 'Supports nurses and provides basic healthcare assistance', 'COMPANY123', '2025-10-23 11:08:00'),
(6, 'Home Care Worker', 'Provides care to clients in their own homes', 'COMPANY123', '2025-10-23 11:08:00'),
(7, 'Dementia Care Specialist', 'Specialized care for clients with dementia', 'COMPANY123', '2025-10-23 11:08:00'),
(8, 'Palliative Care Nurse', 'Provides end-of-life and palliative care', 'COMPANY123', '2025-10-23 11:08:00'),
(9, 'Mental Health Support Worker', 'Assists clients with mental health needs', 'COMPANY123', '2025-10-23 11:08:00'),
(10, 'Disability Support Worker', 'Supports clients with physical or learning disabilities', 'COMPANY123', '2025-10-23 11:08:00'),
(11, 'Nursing Assistant', 'Assists nurses in patient care and monitoring', 'COMPANY123', '2025-10-23 11:08:00'),
(12, 'Companion Carer', 'Provides social support and companionship to clients', 'COMPANY123', '2025-10-23 11:08:00'),
(13, 'Health Care Assistant', 'Supports nursing staff and provides personal care', 'COMPANY123', '2025-10-23 11:08:00'),
(14, 'Night Care Assistant', 'Provides overnight care in care homes', 'COMPANY123', '2025-10-23 11:08:00'),
(15, 'Team Leader – Care', 'Leads a team of care staff and ensures quality standards', 'COMPANY123', '2025-10-23 11:08:00'),
(16, 'Care Coordinator', 'Organizes and manages client care plans', 'COMPANY123', '2025-10-23 11:08:00'),
(17, 'Respite Care Worker', 'Provides temporary relief for primary carers', 'COMPANY123', '2025-10-23 11:08:00'),
(18, 'Live-in Carer', 'Provides 24-hour care and support in client homes', 'COMPANY123', '2025-10-23 11:08:00'),
(19, 'Personal Support Worker', 'Assists with personal hygiene, mobility, and daily tasks', 'COMPANY123', '2025-10-23 11:08:00'),
(20, 'Senior Health Care Worker', 'Oversees care delivery and ensures compliance', 'COMPANY123', '2025-10-23 11:08:00'),
(21, 'Cleaning Operative', 'Performs cleaning and maintenance tasks', 'COMPANY123', '2025-10-23 11:08:00'),
(22, 'Housekeeper', 'Maintains hygiene and cleanliness in facilities', 'COMPANY123', '2025-10-23 11:08:00'),
(23, 'Laundry Operative', 'Handles laundry services and linen management', 'COMPANY123', '2025-10-23 11:08:00'),
(24, 'Domestic Assistant', 'Supports cleaning, catering, and housekeeping tasks', 'COMPANY123', '2025-10-23 11:08:00'),
(25, 'Janitor', 'Performs general cleaning and maintenance duties', 'COMPANY123', '2025-10-23 11:08:00'),
(26, 'Facilities Assistant', 'Assists with general facilities management', 'COMPANY123', '2025-10-23 11:08:00'),
(27, 'Catering Assistant', 'Prepares and serves food in care homes or hospitals', 'COMPANY123', '2025-10-23 11:08:00'),
(28, 'Kitchen Assistant', 'Supports cooking and kitchen hygiene', 'COMPANY123', '2025-10-23 11:08:00'),
(29, 'Chef', 'Prepares meals and manages kitchen operations', 'COMPANY123', '2025-10-23 11:08:00'),
(30, 'Security Officer', 'Maintains safety and security in premises', 'COMPANY123', '2025-10-23 11:08:00'),
(31, 'Security Supervisor', 'Oversees security staff and operations', 'COMPANY123', '2025-10-23 11:08:00'),
(32, 'CCTV Operator', 'Monitors surveillance systems and reports incidents', 'COMPANY123', '2025-10-23 11:08:00'),
(33, 'Door Supervisor', 'Controls access and ensures security compliance', 'COMPANY123', '2025-10-23 11:08:00'),
(34, 'Patrol Officer', 'Performs security patrols and risk assessments', 'COMPANY123', '2025-10-23 11:08:00'),
(35, 'Paramedic', 'Provides emergency medical services', 'COMPANY123', '2025-10-23 11:08:00'),
(36, 'Physiotherapist', 'Assists clients with mobility and physical therapy', 'COMPANY123', '2025-10-23 11:08:00'),
(37, 'Occupational Therapist', 'Supports clients to improve daily living skills', 'COMPANY123', '2025-10-23 11:08:00'),
(38, 'Speech and Language Therapist', 'Provides therapy for speech and communication difficulties', 'COMPANY123', '2025-10-23 11:08:00'),
(39, 'Dietitian', 'Develops nutrition plans for clients', 'COMPANY123', '2025-10-23 11:08:00'),
(40, 'Phlebotomist', 'Collects blood samples for testing', 'COMPANY123', '2025-10-23 11:08:00'),
(41, 'Clinical Lead', 'Oversees clinical operations and standards', 'COMPANY123', '2025-10-23 11:08:00'),
(42, 'Pharmacy Technician', 'Assists in dispensing medication', 'COMPANY123', '2025-10-23 11:08:00'),
(43, 'Medical Secretary', 'Provides administrative support in healthcare settings', 'COMPANY123', '2025-10-23 11:08:00'),
(44, 'Care Manager', 'Manages care home operations and staff', 'COMPANY123', '2025-10-23 11:08:00'),
(45, 'Health and Safety Officer', 'Ensures compliance with safety regulations', 'COMPANY123', '2025-10-23 11:08:00'),
(46, 'Training Coordinator', 'Organizes staff training and professional development', 'COMPANY123', '2025-10-23 11:08:00'),
(47, 'Volunteer Coordinator', 'Manages volunteers and community engagement', 'COMPANY123', '2025-10-23 11:08:00'),
(48, 'Activity Coordinator', 'Plans and delivers activities for clients', 'COMPANY123', '2025-10-23 11:08:00'),
(49, 'Wellbeing Officer', 'Promotes health and wellbeing programs', 'COMPANY123', '2025-10-23 11:08:00'),
(50, 'Rehabilitation Therapist', 'Provides therapy for physical recovery', 'COMPANY123', '2025-10-23 11:08:00'),
(51, 'Night Nurse', 'Provides overnight nursing care and monitoring', 'COMPANY123', '2025-10-23 11:08:00'),
(52, 'Care Apprentice', 'Learns practical care skills under supervision', 'COMPANY123', '2025-10-23 11:08:00'),
(53, 'Senior Care Coordinator', 'Manages complex care plans and staff allocation', 'COMPANY123', '2025-10-23 11:08:00'),
(54, 'Medical Social Worker', 'Supports clients with social care needs', 'COMPANY123', '2025-10-23 11:08:00'),
(55, 'Clinical Support Worker', 'Assists in clinical procedures and patient care', 'COMPANY123', '2025-10-23 11:08:00'),
(56, 'Housekeeping Supervisor', 'Oversees cleaning and domestic staff', 'COMPANY123', '2025-10-23 11:08:00'),
(57, 'Laundry Supervisor', 'Manages laundry services and quality control', 'COMPANY123', '2025-10-23 11:08:00'),
(58, 'Facilities Manager', 'Oversees building maintenance and operations', 'COMPANY123', '2025-10-23 11:08:00'),
(59, 'Catering Supervisor', 'Manages kitchen staff and meal provision', 'COMPANY123', '2025-10-23 11:08:00'),
(60, 'Head of Security', 'Leads security operations and strategy', 'COMPANY123', '2025-10-23 11:08:00'),
(61, 'Security Trainer', 'Trains security staff on procedures and compliance', 'COMPANY123', '2025-10-23 11:08:00'),
(62, 'Health Care Trainer', 'Delivers training to care and health staff', 'COMPANY123', '2025-10-23 11:08:00'),
(63, 'Infection Control Nurse', 'Implements infection control procedures', 'COMPANY123', '2025-10-23 11:08:00'),
(64, 'Clinical Nurse Specialist', 'Provides expert nursing in specialized areas', 'COMPANY123', '2025-10-23 11:08:00'),
(65, 'Community Nurse', 'Delivers care to clients in the community', 'COMPANY123', '2025-10-23 11:08:00'),
(66, 'Wound Care Nurse', 'Manages complex wound care', 'COMPANY123', '2025-10-23 11:08:00'),
(67, 'Mental Health Nurse', 'Supports clients with mental health needs', 'COMPANY123', '2025-10-23 11:08:00'),
(68, 'Care Quality Officer', 'Monitors and audits care standards', 'COMPANY123', '2025-10-23 11:08:00'),
(69, 'Compliance Officer', 'Ensures regulatory compliance in care services', 'COMPANY123', '2025-10-23 11:08:00'),
(70, 'Patient Liaison Officer', 'Supports communication between patients and staff', 'COMPANY123', '2025-10-23 11:08:00'),
(71, 'Health Assistant', 'Supports healthcare staff in day-to-day duties', 'COMPANY123', '2025-10-23 11:08:00'),
(72, 'Medical Officer', 'Provides clinical oversight and advice', 'COMPANY123', '2025-10-23 11:08:00'),
(73, 'Emergency Care Assistant', 'Supports emergency care provision', 'COMPANY123', '2025-10-23 11:08:00'),
(74, 'Respite Care Coordinator', 'Organizes respite care services', 'COMPANY123', '2025-10-23 11:08:00'),
(75, 'Care Administrator', 'Handles administrative tasks for care services', 'COMPANY123', '2025-10-23 11:08:00'),
(76, 'Home Support Coordinator', 'Organizes home care visits and schedules', 'COMPANY123', '2025-10-23 11:08:00'),
(77, 'Senior Domestic Operative', 'Leads domestic staff and operations', 'COMPANY123', '2025-10-23 11:08:00'),
(78, 'Porter', 'Assists with moving clients and hospital logistics', 'COMPANY123', '2025-10-23 11:08:00'),
(79, 'Laundry Assistant', 'Supports laundry operations and linen management', 'COMPANY123', '2025-10-23 11:08:00'),
(80, 'Senior Security Officer', 'Leads security teams and incident response', 'COMPANY123', '2025-10-23 11:08:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_post_updates`
--

CREATE TABLE `tbl_post_updates` (
  `userId` int(11) NOT NULL,
  `description` text NOT NULL,
  `start_date` varchar(500) NOT NULL,
  `end_date` varchar(500) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchase_order`
--

CREATE TABLE `tbl_purchase_order` (
  `userId` int(11) NOT NULL,
  `col_client_name` varchar(500) NOT NULL,
  `col_payer` varchar(500) NOT NULL,
  `col_contract_name` varchar(500) NOT NULL,
  `col_contract_rate` varchar(500) NOT NULL,
  `col_service_type` varchar(500) NOT NULL,
  `col_hours_per_week` varchar(500) NOT NULL,
  `col_client_Id` varchar(500) NOT NULL,
  `col_special_Id` varchar(500) NOT NULL,
  `col_company_Id` varchar(500) NOT NULL,
  `col_date` varchar(500) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_raise_concern`
--

CREATE TABLE `tbl_raise_concern` (
  `userId` int(11) NOT NULL,
  `col_client_name` varchar(500) NOT NULL,
  `col_team_name` varchar(500) NOT NULL,
  `col_title` varchar(500) NOT NULL,
  `col_note` text NOT NULL,
  `col_image` varchar(500) NOT NULL,
  `col_status` varchar(500) NOT NULL,
  `uryyToeSS4` varchar(500) NOT NULL,
  `uryyTteamoeSS4` varchar(500) NOT NULL,
  `col_company_Id` varchar(500) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ratings`
--

CREATE TABLE `tbl_ratings` (
  `id` int(11) NOT NULL,
  `stars` int(11) NOT NULL,
  `clientName` varchar(500) DEFAULT NULL,
  `feedback` text DEFAULT NULL,
  `uryyToeSS4` varchar(500) DEFAULT NULL,
  `col_company_Id` varchar(500) DEFAULT NULL,
  `submitted_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_report_issues`
--

CREATE TABLE `tbl_report_issues` (
  `report_Id` int(11) NOT NULL,
  `reP56klix75ort` varchar(500) NOT NULL,
  `team_members` varchar(500) NOT NULL,
  `client_name` varchar(500) NOT NULL,
  `report_title` varchar(500) NOT NULL,
  `report_details` text NOT NULL,
  `reply_report` text NOT NULL,
  `report_status` varchar(500) NOT NULL,
  `col_company_Id` varchar(500) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_schedule_calls`
--

CREATE TABLE `tbl_schedule_calls` (
  `id` int(100) NOT NULL,
  `client_name` varchar(500) NOT NULL,
  `client_area` varchar(500) NOT NULL,
  `col_area_city` varchar(500) NOT NULL,
  `col_area_Id` varchar(500) NOT NULL,
  `uryyToeSS4` varchar(500) NOT NULL,
  `first_carer` varchar(500) NOT NULL,
  `first_carer_Id` varchar(500) NOT NULL,
  `care_calls` varchar(500) NOT NULL,
  `dateTime_in` varchar(500) NOT NULL,
  `dateTime_out` varchar(500) NOT NULL,
  `col_run_name` varchar(500) NOT NULL,
  `col_required_carers` varchar(500) NOT NULL,
  `Clientshift_Date` varchar(500) NOT NULL,
  `timeline_colour` varchar(500) NOT NULL,
  `col_visitColor_code` varchar(500) NOT NULL,
  `mileage_rate` varchar(500) NOT NULL,
  `call_status` varchar(500) NOT NULL,
  `bgChange` varchar(500) NOT NULL,
  `col_period_one` varchar(500) NOT NULL,
  `col_period_two` varchar(500) NOT NULL,
  `pay_rate` varchar(500) NOT NULL,
  `client_rate` varchar(500) NOT NULL,
  `checkin_type` varchar(500) NOT NULL,
  `col_company_Id` varchar(500) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_schedule_calls`
--

INSERT INTO `tbl_schedule_calls` (`id`, `client_name`, `client_area`, `col_area_city`, `col_area_Id`, `uryyToeSS4`, `first_carer`, `first_carer_Id`, `care_calls`, `dateTime_in`, `dateTime_out`, `col_run_name`, `col_required_carers`, `Clientshift_Date`, `timeline_colour`, `col_visitColor_code`, `mileage_rate`, `call_status`, `bgChange`, `col_period_one`, `col_period_two`, `pay_rate`, `client_rate`, `checkin_type`, `col_company_Id`, `dateTime`) VALUES
(1, 'Kamal Kenneth', 'Codsall', 'Wolverhampton', '1', '1025', 'Osaretin Samson', '20001', 'Morning', '06:10', '07:27', 'Codsall Single Run - Only', '2', '2025-10-25', '#34495e', 'rgba(255, 255, 255,1.0)', '0.00', 'Scheduled', 'rgba(44, 62, 80, 0.5)', '', 'Daily', '14.30', '24.95', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:14:10'),
(2, 'Gloria Kyle', 'Codsall', 'Wolverhampton', '1', '1024', 'Osaretin Samson', '20001', 'Morning', '07:55', '09:14', 'Codsall Single Run - Only', '2', '2025-10-25', '#34495e', 'rgba(255, 255, 255,1.0)', '0.00', 'Scheduled', 'rgba(44, 62, 80, 0.5)', '', 'Daily', '14.30', '24.95', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:15:32'),
(3, 'Gloria Kyle', 'Codsall', 'Wolverhampton', '1', '1024', 'Osaretin Samson', '20001', 'Lunch', '12:25', '13:35', 'Codsall Single Run - Only', '2', '2025-10-25', '#34495e', 'rgba(255, 255, 255,1.0)', '0.00', 'Scheduled', 'rgba(44, 62, 80, 0.5)', '', 'Daily', '14.30', '24.95', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:15:32'),
(4, 'Kamal Kenneth', 'Codsall', 'Wolverhampton', '1', '1025', 'Osaretin Samson', '20001', 'Lunch', '12:30', '14:00', 'Codsall Single Run - Only', '2', '2025-10-25', '#34495e', 'rgba(255, 255, 255,1.0)', '0.00', 'Scheduled', 'rgba(44, 62, 80, 0.5)', '', 'Daily', '14.30', '24.95', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:14:10'),
(5, 'Gloria Kyle', 'Codsall', 'Wolverhampton', '1', '1024', 'Osaretin Samson', '20001', 'Tea', '16:20', '17:25', 'Codsall Single Run - Only', '2', '2025-10-25', '#34495e', 'rgba(255, 255, 255,1.0)', '0.00', 'Scheduled', 'rgba(44, 62, 80, 0.5)', '', 'Daily', '14.30', '24.95', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:15:32'),
(6, 'Kamal Kenneth', 'Codsall', 'Wolverhampton', '1', '1025', 'Osaretin Samson', '20001', 'Tea', '17:40', '18:56', 'Codsall Single Run - Only', '2', '2025-10-25', '#34495e', 'rgba(255, 255, 255,1.0)', '0.00', 'Scheduled', 'rgba(44, 62, 80, 0.5)', '', 'Daily', '14.30', '24.95', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:14:10'),
(7, 'Kamal Kenneth', 'Codsall', 'Wolverhampton', '1', '1025', 'Osaretin Samson', '20001', 'Bed', '20:30', '21:37', 'Codsall Single Run - Only', '2', '2025-10-25', '#34495e', 'rgba(255, 255, 255,1.0)', '0.00', 'Scheduled', 'rgba(44, 62, 80, 0.5)', '', 'Daily', '14.30', '24.95', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:14:10'),
(8, 'Gloria Kyle', 'Codsall', 'Wolverhampton', '1', '1024', 'Osaretin Samson', '20001', 'Bed', '20:50', '21:38', 'Codsall Single Run - Only', '2', '2025-10-25', '#34495e', 'rgba(255, 255, 255,1.0)', '0.00', 'Scheduled', 'rgba(44, 62, 80, 0.5)', '', 'Daily', '14.30', '24.95', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:15:32'),
(9, 'Galvin Janna', 'Kidderminster', 'Wolverhampton', '2', '1035', 'Osaretin Samson', '20001', 'Morning', '06:15', '07:03', 'Kinderminster Single Late Run', '2', '2025-10-26', '#34495e', 'rgba(255, 255, 255,1.0)', '0.00', 'Scheduled', 'rgba(44, 62, 80, 0.5)', '', 'Daily', '14.30', '24.95', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:15:08'),
(10, 'Kerry Kessie', 'Kidderminster', 'Wolverhampton', '2', '1034', 'Osaretin Samson', '20001', 'Morning', '06:55', '07:41', 'Kinderminster Single Late Run', '2', '2025-10-26', '#34495e', 'rgba(255, 255, 255,1.0)', '0.00', 'Scheduled', 'rgba(44, 62, 80, 0.5)', '', 'Daily', '14.30', '24.95', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:16:00'),
(11, 'Destiny Russell', 'Kidderminster', 'Wolverhampton', '2', '1033', 'Osaretin Samson', '20001', 'Morning', '07:55', '08:55', 'Kinderminster Single Late Run', '2', '2025-10-26', '#34495e', 'rgba(255, 255, 255,1.0)', '0.00', 'Scheduled', 'rgba(44, 62, 80, 0.5)', '', 'Daily', '14.30', '24.95', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:14:54'),
(12, 'Kerry Kessie', 'Kidderminster', 'Wolverhampton', '2', '1034', 'Osaretin Samson', '20001', 'Lunch', '11:05', '12:10', 'Kinderminster Single Late Run', '2', '2025-10-26', '#34495e', 'rgba(255, 255, 255,1.0)', '0.00', 'Scheduled', 'rgba(44, 62, 80, 0.5)', '', 'Daily', '14.30', '24.95', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:16:00'),
(13, 'Destiny Russell', 'Kidderminster', 'Wolverhampton', '2', '1033', 'Osaretin Samson', '20001', 'Lunch', '11:45', '12:54', 'Kinderminster Single Late Run', '2', '2025-10-26', '#34495e', 'rgba(255, 255, 255,1.0)', '0.00', 'Scheduled', 'rgba(44, 62, 80, 0.5)', '', 'Daily', '14.30', '24.95', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:14:54'),
(14, 'Kerry Kessie', 'Kidderminster', 'Wolverhampton', '2', '1034', 'Osaretin Samson', '20001', 'Tea', '17:15', '18:39', 'Kinderminster Single Late Run', '2', '2025-10-26', '#34495e', 'rgba(255, 255, 255,1.0)', '0.00', 'Scheduled', 'rgba(44, 62, 80, 0.5)', '', 'Daily', '14.30', '24.95', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:16:00'),
(15, 'Destiny Russell', 'Kidderminster', 'Wolverhampton', '2', '1033', 'Osaretin Samson', '20001', 'Tea', '17:35', '18:21', 'Kinderminster Single Late Run', '2', '2025-10-26', '#34495e', 'rgba(255, 255, 255,1.0)', '0.00', 'Scheduled', 'rgba(44, 62, 80, 0.5)', '', 'Daily', '14.30', '24.95', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:14:54'),
(16, 'Kerry Kessie', 'Kidderminster', 'Wolverhampton', '2', '1034', 'Osaretin Samson', '20001', 'Bed', '20:05', '21:06', 'Kinderminster Single Late Run', '2', '2025-10-26', '#34495e', 'rgba(255, 255, 255,1.0)', '0.00', 'Scheduled', 'rgba(44, 62, 80, 0.5)', '', 'Daily', '14.30', '24.95', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:16:00'),
(17, 'Destiny Russell', 'Kidderminster', 'Wolverhampton', '2', '1033', 'Osaretin Samson', '20001', 'Bed', '20:20', '21:28', 'Kinderminster Single Late Run', '2', '2025-10-26', '#34495e', 'rgba(255, 255, 255,1.0)', '0.00', 'Scheduled', 'rgba(44, 62, 80, 0.5)', '', 'Daily', '14.30', '24.95', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:14:54'),
(18, 'Kamal Kenneth', 'Codsall', 'Wolverhampton', '1', '1025', 'Cruz Abra', '20003', 'Morning', '06:10', '07:27', 'Codsall Single Run - Only', '2', '2025-10-26', '#34495e', 'rgba(255, 255, 255,1.0)', '0.00', 'Scheduled', 'rgba(44, 62, 80, 0.5)', '', 'Daily', '20.52', '24.95', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:14:10'),
(19, 'Gloria Kyle', 'Codsall', 'Wolverhampton', '1', '1024', 'Cruz Abra', '20003', 'Morning', '07:55', '09:14', 'Codsall Single Run - Only', '2', '2025-10-26', '#34495e', 'rgba(255, 255, 255,1.0)', '0.00', 'Scheduled', 'rgba(44, 62, 80, 0.5)', '', 'Daily', '20.52', '24.95', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:15:32'),
(20, 'Gloria Kyle', 'Codsall', 'Wolverhampton', '1', '1024', 'Cruz Abra', '20003', 'Lunch', '12:25', '13:35', 'Codsall Single Run - Only', '2', '2025-10-26', '#34495e', 'rgba(255, 255, 255,1.0)', '0.00', 'Scheduled', 'rgba(44, 62, 80, 0.5)', '', 'Daily', '20.52', '24.95', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:15:32'),
(21, 'Kamal Kenneth', 'Codsall', 'Wolverhampton', '1', '1025', 'Cruz Abra', '20003', 'Lunch', '12:30', '14:00', 'Codsall Single Run - Only', '2', '2025-10-26', '#34495e', 'rgba(255, 255, 255,1.0)', '0.00', 'Scheduled', 'rgba(44, 62, 80, 0.5)', '', 'Daily', '20.52', '24.95', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:14:10'),
(22, 'Gloria Kyle', 'Codsall', 'Wolverhampton', '1', '1024', 'Cruz Abra', '20003', 'Tea', '16:20', '17:25', 'Codsall Single Run - Only', '2', '2025-10-26', '#34495e', 'rgba(255, 255, 255,1.0)', '0.00', 'Scheduled', 'rgba(44, 62, 80, 0.5)', '', 'Daily', '20.52', '24.95', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:15:32'),
(23, 'Kamal Kenneth', 'Codsall', 'Wolverhampton', '1', '1025', 'Cruz Abra', '20003', 'Tea', '17:40', '18:56', 'Codsall Single Run - Only', '2', '2025-10-26', '#34495e', 'rgba(255, 255, 255,1.0)', '0.00', 'Scheduled', 'rgba(44, 62, 80, 0.5)', '', 'Daily', '20.52', '24.95', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:14:10'),
(24, 'Kamal Kenneth', 'Codsall', 'Wolverhampton', '1', '1025', 'Cruz Abra', '20003', 'Bed', '20:30', '21:37', 'Codsall Single Run - Only', '2', '2025-10-26', '#34495e', 'rgba(255, 255, 255,1.0)', '0.00', 'Scheduled', 'rgba(44, 62, 80, 0.5)', '', 'Daily', '20.52', '24.95', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:14:10'),
(25, 'Gloria Kyle', 'Codsall', 'Wolverhampton', '1', '1024', 'Cruz Abra', '20003', 'Bed', '20:50', '21:38', 'Codsall Single Run - Only', '2', '2025-10-26', '#34495e', 'rgba(255, 255, 255,1.0)', '0.00', 'Scheduled', 'rgba(44, 62, 80, 0.5)', '', 'Daily', '20.52', '24.95', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:15:32'),
(26, 'Taylor Carla', 'Codsall', 'Wolverhampton', '3', '1026', 'Ingrid Orla', '20002', 'Morning', '07:00', '08:22', 'Codsall Double Male Run - Only', '2', '2025-10-27', '#34495e', 'rgba(255, 255, 255,1.0)', '0.00', 'Scheduled', 'rgba(44, 62, 80, 0.5)', '', 'Daily', '13.21', '24.95', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:16:52'),
(27, 'Summer Declan', 'Codsall', 'Wolverhampton', '3', '1027', 'Ingrid Orla', '20002', 'Morning', '07:10', '08:40', 'Codsall Double Male Run - Only', '2', '2025-10-27', '#34495e', 'rgba(255, 255, 255,1.0)', '0.00', 'Scheduled', 'rgba(44, 62, 80, 0.5)', '', 'Daily', '13.21', '24.95', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:16:39'),
(28, 'Summer Declan', 'Codsall', 'Wolverhampton', '3', '1027', 'Ingrid Orla', '20002', 'Lunch', '11:10', '11:55', 'Codsall Double Male Run - Only', '2', '2025-10-27', '#34495e', 'rgba(255, 255, 255,1.0)', '0.00', 'Scheduled', 'rgba(44, 62, 80, 0.5)', '', 'Daily', '13.21', '24.95', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:16:39'),
(29, 'Taylor Carla', 'Codsall', 'Wolverhampton', '3', '1026', 'Ingrid Orla', '20002', 'Lunch', '11:25', '12:43', 'Codsall Double Male Run - Only', '2', '2025-10-27', '#34495e', 'rgba(255, 255, 255,1.0)', '0.00', 'Scheduled', 'rgba(44, 62, 80, 0.5)', '', 'Daily', '13.21', '24.95', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:16:52'),
(30, 'Taylor Carla', 'Codsall', 'Wolverhampton', '3', '1026', 'Ingrid Orla', '20002', 'Tea', '16:50', '17:56', 'Codsall Double Male Run - Only', '2', '2025-10-27', '#34495e', 'rgba(255, 255, 255,1.0)', '0.00', 'Scheduled', 'rgba(44, 62, 80, 0.5)', '', 'Daily', '13.21', '24.95', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:16:52'),
(31, 'Summer Declan', 'Codsall', 'Wolverhampton', '3', '1027', 'Ingrid Orla', '20002', 'Tea', '17:00', '18:09', 'Codsall Double Male Run - Only', '2', '2025-10-27', '#34495e', 'rgba(255, 255, 255,1.0)', '0.00', 'Scheduled', 'rgba(44, 62, 80, 0.5)', '', 'Daily', '13.21', '24.95', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:16:39'),
(32, 'Taylor Carla', 'Codsall', 'Wolverhampton', '3', '1026', 'Ingrid Orla', '20002', 'Bed', '20:35', '22:05', 'Codsall Double Male Run - Only', '2', '2025-10-27', '#34495e', 'rgba(255, 255, 255,1.0)', '0.00', 'Scheduled', 'rgba(44, 62, 80, 0.5)', '', 'Daily', '13.21', '24.95', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:16:52'),
(33, 'Summer Declan', 'Codsall', 'Wolverhampton', '3', '1027', 'Ingrid Orla', '20002', 'Bed', '20:35', '21:28', 'Codsall Double Male Run - Only', '2', '2025-10-27', '#34495e', 'rgba(255, 255, 255,1.0)', '0.00', 'Scheduled', 'rgba(44, 62, 80, 0.5)', '', 'Daily', '13.21', '24.95', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:16:39'),
(34, 'Taylor Carla', 'Codsall', 'Wolverhampton', '4', '1026', 'Osaretin Samson', '20001', 'Morning', '07:00', '08:22', 'Codsall Double Female Run - Only', '2', '2025-10-27', '#34495e', 'rgba(255, 255, 255,1.0)', '0.00', 'Scheduled', 'rgba(44, 62, 80, 0.5)', '', 'Daily', '14.30', '24.95', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:16:52'),
(35, 'Summer Declan', 'Codsall', 'Wolverhampton', '4', '1027', 'Osaretin Samson', '20001', 'Morning', '07:10', '08:40', 'Codsall Double Female Run - Only', '2', '2025-10-27', '#34495e', 'rgba(255, 255, 255,1.0)', '0.00', 'Scheduled', 'rgba(44, 62, 80, 0.5)', '', 'Daily', '14.30', '24.95', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:16:39'),
(36, 'Summer Declan', 'Codsall', 'Wolverhampton', '4', '1027', 'Osaretin Samson', '20001', 'Lunch', '11:10', '11:55', 'Codsall Double Female Run - Only', '2', '2025-10-27', '#34495e', 'rgba(255, 255, 255,1.0)', '0.00', 'Scheduled', 'rgba(44, 62, 80, 0.5)', '', 'Daily', '14.30', '24.95', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:16:39'),
(37, 'Taylor Carla', 'Codsall', 'Wolverhampton', '4', '1026', 'Osaretin Samson', '20001', 'Lunch', '11:25', '12:43', 'Codsall Double Female Run - Only', '2', '2025-10-27', '#34495e', 'rgba(255, 255, 255,1.0)', '0.00', 'Scheduled', 'rgba(44, 62, 80, 0.5)', '', 'Daily', '14.30', '24.95', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:16:52'),
(38, 'Taylor Carla', 'Codsall', 'Wolverhampton', '4', '1026', 'Osaretin Samson', '20001', 'Tea', '16:50', '17:56', 'Codsall Double Female Run - Only', '2', '2025-10-27', '#34495e', 'rgba(255, 255, 255,1.0)', '0.00', 'Scheduled', 'rgba(44, 62, 80, 0.5)', '', 'Daily', '14.30', '24.95', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:16:52'),
(39, 'Summer Declan', 'Codsall', 'Wolverhampton', '4', '1027', 'Osaretin Samson', '20001', 'Tea', '17:00', '18:09', 'Codsall Double Female Run - Only', '2', '2025-10-27', '#34495e', 'rgba(255, 255, 255,1.0)', '0.00', 'Scheduled', 'rgba(44, 62, 80, 0.5)', '', 'Daily', '14.30', '24.95', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:16:39'),
(40, 'Summer Declan', 'Codsall', 'Wolverhampton', '4', '1027', 'Osaretin Samson', '20001', 'Bed', '20:35', '21:28', 'Codsall Double Female Run - Only', '2', '2025-10-27', '#34495e', 'rgba(255, 255, 255,1.0)', '0.00', 'Scheduled', 'rgba(44, 62, 80, 0.5)', '', 'Daily', '14.30', '24.95', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:16:39'),
(41, 'Taylor Carla', 'Codsall', 'Wolverhampton', '4', '1026', 'Osaretin Samson', '20001', 'Bed', '20:35', '22:05', 'Codsall Double Female Run - Only', '2', '2025-10-27', '#34495e', 'rgba(255, 255, 255,1.0)', '0.00', 'Scheduled', 'rgba(44, 62, 80, 0.5)', '', 'Daily', '14.30', '24.95', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:16:52'),
(42, 'Taylor Carla', 'Codsall', 'Wolverhampton', '3', '1026', 'Osaretin Samson', '20001', 'Morning', '07:00', '08:22', 'Codsall Double Male Run - Only', '2', '2025-10-28', '#34495e', 'rgba(255, 255, 255,1.0)', '0.00', 'Scheduled', 'rgba(44, 62, 80, 0.5)', '', 'Daily', '14.30', '24.95', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:16:52'),
(43, 'Summer Declan', 'Codsall', 'Wolverhampton', '3', '1027', 'Osaretin Samson', '20001', 'Morning', '07:10', '08:40', 'Codsall Double Male Run - Only', '2', '2025-10-28', '#34495e', 'rgba(255, 255, 255,1.0)', '0.00', 'Scheduled', 'rgba(44, 62, 80, 0.5)', '', 'Daily', '14.30', '24.95', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:16:39'),
(44, 'Summer Declan', 'Codsall', 'Wolverhampton', '3', '1027', 'Osaretin Samson', '20001', 'Lunch', '11:10', '11:55', 'Codsall Double Male Run - Only', '2', '2025-10-28', '#34495e', 'rgba(255, 255, 255,1.0)', '0.00', 'Scheduled', 'rgba(44, 62, 80, 0.5)', '', 'Daily', '14.30', '24.95', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:16:39'),
(45, 'Taylor Carla', 'Codsall', 'Wolverhampton', '3', '1026', 'Osaretin Samson', '20001', 'Lunch', '11:25', '12:43', 'Codsall Double Male Run - Only', '2', '2025-10-28', '#34495e', 'rgba(255, 255, 255,1.0)', '0.00', 'Scheduled', 'rgba(44, 62, 80, 0.5)', '', 'Daily', '14.30', '24.95', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:16:52'),
(46, 'Taylor Carla', 'Codsall', 'Wolverhampton', '3', '1026', 'Osaretin Samson', '20001', 'Tea', '16:50', '17:56', 'Codsall Double Male Run - Only', '2', '2025-10-28', '#34495e', 'rgba(255, 255, 255,1.0)', '0.00', 'Scheduled', 'rgba(44, 62, 80, 0.5)', '', 'Daily', '14.30', '24.95', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:16:52'),
(47, 'Summer Declan', 'Codsall', 'Wolverhampton', '3', '1027', 'Osaretin Samson', '20001', 'Tea', '17:00', '18:09', 'Codsall Double Male Run - Only', '2', '2025-10-28', '#34495e', 'rgba(255, 255, 255,1.0)', '0.00', 'Scheduled', 'rgba(44, 62, 80, 0.5)', '', 'Daily', '14.30', '24.95', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:16:39'),
(48, 'Taylor Carla', 'Codsall', 'Wolverhampton', '3', '1026', 'Osaretin Samson', '20001', 'Bed', '20:35', '22:05', 'Codsall Double Male Run - Only', '2', '2025-10-28', '#34495e', 'rgba(255, 255, 255,1.0)', '0.00', 'Scheduled', 'rgba(44, 62, 80, 0.5)', '', 'Daily', '14.30', '24.95', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:16:52'),
(49, 'Summer Declan', 'Codsall', 'Wolverhampton', '3', '1027', 'Osaretin Samson', '20001', 'Bed', '20:35', '21:28', 'Codsall Double Male Run - Only', '2', '2025-10-28', '#34495e', 'rgba(255, 255, 255,1.0)', '0.00', 'Scheduled', 'rgba(44, 62, 80, 0.5)', '', 'Daily', '14.30', '24.95', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:16:39'),
(50, 'Galvin Janna', 'Kidderminster', 'Wolverhampton', '2', '1035', 'Osaretin Samson', '20001', 'Morning', '06:15', '07:03', 'Kinderminster Single Late Run', '2', '2025-10-29', '#34495e', 'rgba(255, 255, 255,1.0)', '0.00', 'Scheduled', 'rgba(44, 62, 80, 0.5)', '', 'Daily', '14.30', '24.95', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:15:08'),
(51, 'Kerry Kessie', 'Kidderminster', 'Wolverhampton', '2', '1034', 'Osaretin Samson', '20001', 'Morning', '06:55', '07:41', 'Kinderminster Single Late Run', '2', '2025-10-29', '#34495e', 'rgba(255, 255, 255,1.0)', '0.00', 'Scheduled', 'rgba(44, 62, 80, 0.5)', '', 'Daily', '14.30', '24.95', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:16:00'),
(52, 'Destiny Russell', 'Kidderminster', 'Wolverhampton', '2', '1033', 'Osaretin Samson', '20001', 'Morning', '07:55', '08:55', 'Kinderminster Single Late Run', '2', '2025-10-29', '#34495e', 'rgba(255, 255, 255,1.0)', '0.00', 'Scheduled', 'rgba(44, 62, 80, 0.5)', '', 'Daily', '14.30', '24.95', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:14:54'),
(53, 'Kerry Kessie', 'Kidderminster', 'Wolverhampton', '2', '1034', 'Osaretin Samson', '20001', 'Lunch', '11:05', '12:10', 'Kinderminster Single Late Run', '2', '2025-10-29', '#34495e', 'rgba(255, 255, 255,1.0)', '0.00', 'Scheduled', 'rgba(44, 62, 80, 0.5)', '', 'Daily', '14.30', '24.95', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:16:00'),
(54, 'Destiny Russell', 'Kidderminster', 'Wolverhampton', '2', '1033', 'Osaretin Samson', '20001', 'Lunch', '11:45', '12:54', 'Kinderminster Single Late Run', '2', '2025-10-29', '#34495e', 'rgba(255, 255, 255,1.0)', '0.00', 'Scheduled', 'rgba(44, 62, 80, 0.5)', '', 'Daily', '14.30', '24.95', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:14:54'),
(55, 'Kerry Kessie', 'Kidderminster', 'Wolverhampton', '2', '1034', 'Osaretin Samson', '20001', 'Tea', '17:15', '18:39', 'Kinderminster Single Late Run', '2', '2025-10-29', '#34495e', 'rgba(255, 255, 255,1.0)', '0.00', 'Scheduled', 'rgba(44, 62, 80, 0.5)', '', 'Daily', '14.30', '24.95', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:16:00'),
(56, 'Destiny Russell', 'Kidderminster', 'Wolverhampton', '2', '1033', 'Osaretin Samson', '20001', 'Tea', '17:35', '18:21', 'Kinderminster Single Late Run', '2', '2025-10-29', '#34495e', 'rgba(255, 255, 255,1.0)', '0.00', 'Scheduled', 'rgba(44, 62, 80, 0.5)', '', 'Daily', '14.30', '24.95', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:14:54'),
(57, 'Kerry Kessie', 'Kidderminster', 'Wolverhampton', '2', '1034', 'Osaretin Samson', '20001', 'Bed', '20:05', '21:06', 'Kinderminster Single Late Run', '2', '2025-10-29', '#34495e', 'rgba(255, 255, 255,1.0)', '0.00', 'Scheduled', 'rgba(44, 62, 80, 0.5)', '', 'Daily', '14.30', '24.95', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:16:00'),
(58, 'Destiny Russell', 'Kidderminster', 'Wolverhampton', '2', '1033', 'Osaretin Samson', '20001', 'Bed', '20:20', '21:28', 'Kinderminster Single Late Run', '2', '2025-10-29', '#34495e', 'rgba(255, 255, 255,1.0)', '0.00', 'Scheduled', 'rgba(44, 62, 80, 0.5)', '', 'Daily', '14.30', '24.95', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:14:54'),
(59, 'Peter Ori', 'Cannock', 'Wolverhampton', '9', '1031', 'Osaretin Samson', '20001', 'EM morning call', '08:45', '21:00', 'Peter Ori Sit-In-Call', '1', '2025-10-31', '#34495e', 'rgba(255, 255, 255,1.0)', '0.00', 'Scheduled', 'rgba(44, 62, 80, 0.5)', '', 'Daily', '14.30', '24.95', 'geolocation', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 11:16:20');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_task_list`
--

CREATE TABLE `tbl_task_list` (
  `id` int(11) NOT NULL,
  `task_title` varchar(500) NOT NULL,
  `task_category` varchar(500) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_task_list`
--

INSERT INTO `tbl_task_list` (`id`, `task_title`, `task_category`, `dateTime`) VALUES
(1, 'Assist with personal care', 'Care Services', '2025-10-23 10:17:35'),
(2, 'Assist with change of pad', 'Care Services', '2025-10-23 10:17:35'),
(3, 'Monitor medication', 'Care Services', '2025-10-23 10:17:35'),
(4, 'Assist with bathing', 'Care Services', '2025-10-23 10:17:35'),
(5, 'Assist with dressing', 'Care Services', '2025-10-23 10:17:35'),
(6, 'Support with mobility', 'Care Services', '2025-10-23 10:17:35'),
(7, 'Companionship support', 'Care Services', '2025-10-23 10:17:35'),
(8, 'Monitor mental health', 'Care Services', '2025-10-23 10:17:35'),
(9, 'Support for dementia', 'Care Services', '2025-10-23 10:17:35'),
(10, 'Provide palliative care', 'Care Services', '2025-10-23 10:17:35'),
(11, 'Assist with assisted living tasks', 'Care Services', '2025-10-23 10:17:35'),
(12, 'Support child care', 'Care Services', '2025-10-23 10:17:35'),
(13, 'Residential care support', 'Care Services', '2025-10-23 10:17:35'),
(14, 'Sit-in care', 'Care Services', '2025-10-23 10:17:35'),
(15, 'Community health check', 'Care Services', '2025-10-23 10:17:35'),
(16, 'Provide informal care', 'Care Services', '2025-10-23 10:17:35'),
(17, 'Shared Lives support', 'Care Services', '2025-10-23 10:17:35'),
(18, 'Health care monitoring', 'Care Services', '2025-10-23 10:17:35'),
(19, 'Medical social services', 'Care Services', '2025-10-23 10:17:35'),
(20, 'Help with meal feeding', 'Care Services', '2025-10-23 10:17:35'),
(21, 'Assist with toileting', 'Care Services', '2025-10-23 10:17:35'),
(22, 'Assist with grooming', 'Care Services', '2025-10-23 10:17:35'),
(23, 'Monitor hydration', 'Care Services', '2025-10-23 10:17:35'),
(24, 'Assist with transfers', 'Care Services', '2025-10-23 10:17:35'),
(25, 'Assist with exercise routines', 'Care Services', '2025-10-23 10:17:35'),
(26, 'Emotional support', 'Care Services', '2025-10-23 10:17:35'),
(27, 'Supervise medication intake', 'Care Services', '2025-10-23 10:17:35'),
(28, 'Check vitals', 'Care Services', '2025-10-23 10:17:35'),
(29, 'Support with incontinence', 'Care Services', '2025-10-23 10:17:35'),
(30, 'Monitor sleep patterns', 'Care Services', '2025-10-23 10:17:35'),
(31, 'Assist with wound care', 'Care Services', '2025-10-23 10:17:35'),
(32, 'Support with rehabilitation', 'Care Services', '2025-10-23 10:17:35'),
(33, 'Assist with oxygen therapy', 'Care Services', '2025-10-23 10:17:35'),
(34, 'Monitor blood pressure', 'Care Services', '2025-10-23 10:17:35'),
(35, 'Assist with mobility aids', 'Care Services', '2025-10-23 10:17:35'),
(36, 'Support with chronic conditions', 'Care Services', '2025-10-23 10:17:35'),
(37, 'Assist with feeding tube', 'Care Services', '2025-10-23 10:17:35'),
(38, 'Support for elderly care', 'Care Services', '2025-10-23 10:17:35'),
(39, 'Supervise home exercises', 'Care Services', '2025-10-23 10:17:35'),
(40, 'Assist with daily routine', 'Care Services', '2025-10-23 10:17:35'),
(41, 'Support with hygiene', 'Care Services', '2025-10-23 10:17:35'),
(42, 'Room cleaning', 'Domestic & Support Services', '2025-10-23 10:17:35'),
(43, 'Laundry assistance', 'Domestic & Support Services', '2025-10-23 10:17:35'),
(44, 'Meal preparation', 'Domestic & Support Services', '2025-10-23 10:17:35'),
(45, 'Catering assistance', 'Domestic & Support Services', '2025-10-23 10:17:35'),
(46, 'Housekeeping tasks', 'Domestic & Support Services', '2025-10-23 10:17:35'),
(47, 'Maintenance and repairs', 'Domestic & Support Services', '2025-10-23 10:17:35'),
(48, 'Organize living space', 'Domestic & Support Services', '2025-10-23 10:17:35'),
(49, 'Grocery shopping and delivery', 'Domestic & Support Services', '2025-10-23 10:17:35'),
(50, 'Dishwashing', 'Domestic & Support Services', '2025-10-23 10:17:35'),
(51, 'Vacuuming', 'Domestic & Support Services', '2025-10-23 10:17:35'),
(52, 'Dusting furniture', 'Domestic & Support Services', '2025-10-23 10:17:35'),
(53, 'Window cleaning', 'Domestic & Support Services', '2025-10-23 10:17:35'),
(54, 'Organize pantry', 'Domestic & Support Services', '2025-10-23 10:17:35'),
(55, 'Garden care', 'Domestic & Support Services', '2025-10-23 10:17:35'),
(56, 'Trash removal', 'Domestic & Support Services', '2025-10-23 10:17:35'),
(57, 'Laundry folding', 'Domestic & Support Services', '2025-10-23 10:17:35'),
(58, 'Laundry ironing', 'Domestic & Support Services', '2025-10-23 10:17:35'),
(59, 'Pet care', 'Domestic & Support Services', '2025-10-23 10:17:35'),
(60, 'Stock supplies', 'Domestic & Support Services', '2025-10-23 10:17:35'),
(61, 'Prepare snacks', 'Domestic & Support Services', '2025-10-23 10:17:35'),
(62, 'Assist with meal serving', 'Domestic & Support Services', '2025-10-23 10:17:35'),
(63, 'Organize cupboards', 'Domestic & Support Services', '2025-10-23 10:17:35'),
(64, 'Sanitize surfaces', 'Domestic & Support Services', '2025-10-23 10:17:35'),
(65, 'Restock cleaning supplies', 'Domestic & Support Services', '2025-10-23 10:17:35'),
(66, 'Kitchen cleaning', 'Domestic & Support Services', '2025-10-23 10:17:35'),
(67, 'Bathroom sanitization', 'Domestic & Support Services', '2025-10-23 10:17:35'),
(68, 'Organize closets', 'Domestic & Support Services', '2025-10-23 10:17:35'),
(69, 'Prepare grocery list', 'Domestic & Support Services', '2025-10-23 10:17:35'),
(70, 'Laundry sorting', 'Domestic & Support Services', '2025-10-23 10:17:35'),
(71, 'Recycle management', 'Domestic & Support Services', '2025-10-23 10:17:35'),
(72, 'Assist with shopping online', 'Domestic & Support Services', '2025-10-23 10:17:35'),
(73, 'Assist with pantry inventory', 'Domestic & Support Services', '2025-10-23 10:17:35'),
(74, 'Organize fridge', 'Domestic & Support Services', '2025-10-23 10:17:35'),
(75, 'Floor mopping', 'Domestic & Support Services', '2025-10-23 10:17:35'),
(76, 'Assist with dishwasher loading', 'Domestic & Support Services', '2025-10-23 10:17:35'),
(77, 'Assist with ironing clothes', 'Domestic & Support Services', '2025-10-23 10:17:35'),
(78, 'Laundry folding and storing', 'Domestic & Support Services', '2025-10-23 10:17:35'),
(79, 'Change bed linens', 'Domestic & Support Services', '2025-10-23 10:17:35'),
(80, 'Organize laundry area', 'Domestic & Support Services', '2025-10-23 10:17:35'),
(81, 'Prepare special diet meals', 'Domestic & Support Services', '2025-10-23 10:17:35'),
(82, 'Assist with kitchen inventory', 'Domestic & Support Services', '2025-10-23 10:17:35'),
(83, 'Security patrol', 'Professional & Safety Services', '2025-10-23 10:17:35'),
(84, 'Escort client to appointments', 'Professional & Safety Services', '2025-10-23 10:17:35'),
(85, 'Provide transportation', 'Professional & Safety Services', '2025-10-23 10:17:35'),
(86, 'Run errands', 'Professional & Safety Services', '2025-10-23 10:17:35'),
(87, 'Personal assistant support', 'Professional & Safety Services', '2025-10-23 10:17:35'),
(88, 'Administrative support', 'Professional & Safety Services', '2025-10-23 10:17:35'),
(89, 'Emergency response', 'Professional & Safety Services', '2025-10-23 10:17:35'),
(90, 'Monitor safety compliance', 'Professional & Safety Services', '2025-10-23 10:17:35'),
(91, 'Supervise visitors', 'Professional & Safety Services', '2025-10-23 10:17:35'),
(92, 'Check fire alarms', 'Professional & Safety Services', '2025-10-23 10:17:35'),
(93, 'Monitor CCTV', 'Professional & Safety Services', '2025-10-23 10:17:35'),
(94, 'Lock/unlock premises', 'Professional & Safety Services', '2025-10-23 10:17:35'),
(95, 'Assist with evacuation', 'Professional & Safety Services', '2025-10-23 10:17:35'),
(96, 'Check safety equipment', 'Professional & Safety Services', '2025-10-23 10:17:35'),
(97, 'Escort to transport', 'Professional & Safety Services', '2025-10-23 10:17:35'),
(98, 'Monitor hazard risks', 'Professional & Safety Services', '2025-10-23 10:17:35'),
(99, 'Assist with legal forms', 'Professional & Safety Services', '2025-10-23 10:17:35'),
(100, 'Report incidents', 'Professional & Safety Services', '2025-10-23 10:17:35'),
(101, 'Assist with admin tasks', 'Professional & Safety Services', '2025-10-23 10:17:35'),
(102, 'Ensure PPE compliance', 'Professional & Safety Services', '2025-10-23 10:17:35'),
(103, 'Supervise property security', 'Professional & Safety Services', '2025-10-23 10:17:35'),
(104, 'Monitor visitor log', 'Professional & Safety Services', '2025-10-23 10:17:35'),
(105, 'Assist with compliance reporting', 'Professional & Safety Services', '2025-10-23 10:17:35'),
(106, 'Support emergency drills', 'Professional & Safety Services', '2025-10-23 10:17:35'),
(107, 'Safety checklist verification', 'Professional & Safety Services', '2025-10-23 10:17:35'),
(108, 'Assist with safety audits', 'Professional & Safety Services', '2025-10-23 10:17:35'),
(109, 'Supervise night shifts', 'Professional & Safety Services', '2025-10-23 10:17:35'),
(110, 'Monitor staff adherence', 'Professional & Safety Services', '2025-10-23 10:17:35'),
(111, 'Coordinate transport security', 'Professional & Safety Services', '2025-10-23 10:17:35'),
(112, 'Report hazards', 'Professional & Safety Services', '2025-10-23 10:17:35'),
(113, 'Monitor alarm systems', 'Professional & Safety Services', '2025-10-23 10:17:35'),
(114, 'Assist with emergency planning', 'Professional & Safety Services', '2025-10-23 10:17:35'),
(115, 'Coordinate security schedules', 'Professional & Safety Services', '2025-10-23 10:17:35'),
(116, 'Assist with visitor registration', 'Professional & Safety Services', '2025-10-23 10:17:35'),
(117, 'Inspect safety equipment', 'Professional & Safety Services', '2025-10-23 10:17:35'),
(118, 'Supervise safety drills', 'Professional & Safety Services', '2025-10-23 10:17:35'),
(119, 'Monitor access control', 'Professional & Safety Services', '2025-10-23 10:17:35'),
(120, 'Assist with staff training', 'Professional & Safety Services', '2025-10-23 10:17:35'),
(121, 'Support incident investigation', 'Professional & Safety Services', '2025-10-23 10:17:35'),
(122, 'Physiotherapy session', 'Therapy & Health Appointments', '2025-10-23 10:17:35'),
(123, 'Occupational therapy', 'Therapy & Health Appointments', '2025-10-23 10:17:35'),
(124, 'Speech therapy session', 'Therapy & Health Appointments', '2025-10-23 10:17:35'),
(125, 'Dentist appointment', 'Therapy & Health Appointments', '2025-10-23 10:17:35'),
(126, 'GP visit', 'Therapy & Health Appointments', '2025-10-23 10:17:35'),
(127, 'Hospital appointment', 'Therapy & Health Appointments', '2025-10-23 10:17:35'),
(128, 'Medication management', 'Therapy & Health Appointments', '2025-10-23 10:17:35'),
(129, 'Exercise therapy', 'Therapy & Health Appointments', '2025-10-23 10:17:35'),
(130, 'Rehabilitation exercises', 'Therapy & Health Appointments', '2025-10-23 10:17:35'),
(131, 'Monitor therapy progress', 'Therapy & Health Appointments', '2025-10-23 10:17:35'),
(132, 'Assist with mobility exercises', 'Therapy & Health Appointments', '2025-10-23 10:17:35'),
(133, 'Track therapy schedule', 'Therapy & Health Appointments', '2025-10-23 10:17:35'),
(134, 'Provide therapy equipment', 'Therapy & Health Appointments', '2025-10-23 10:17:35'),
(135, 'Guide therapy routines', 'Therapy & Health Appointments', '2025-10-23 10:17:35'),
(136, 'Therapy progress notes', 'Therapy & Health Appointments', '2025-10-23 10:17:35'),
(137, 'Assist with stretching exercises', 'Therapy & Health Appointments', '2025-10-23 10:17:35'),
(138, 'Monitor pain levels', 'Therapy & Health Appointments', '2025-10-23 10:17:35'),
(139, 'Assist with cognitive exercises', 'Therapy & Health Appointments', '2025-10-23 10:17:35'),
(140, 'Support speech practice', 'Therapy & Health Appointments', '2025-10-23 10:17:35'),
(141, 'Supervise rehabilitation', 'Therapy & Health Appointments', '2025-10-23 10:17:35'),
(142, 'Assist with occupational activities', 'Therapy & Health Appointments', '2025-10-23 10:17:35'),
(143, 'Monitor therapy compliance', 'Therapy & Health Appointments', '2025-10-23 10:17:35'),
(144, 'Assist with range of motion exercises', 'Therapy & Health Appointments', '2025-10-23 10:17:35'),
(145, 'Support therapeutic routines', 'Therapy & Health Appointments', '2025-10-23 10:17:35'),
(146, 'Document therapy progress', 'Therapy & Health Appointments', '2025-10-23 10:17:35'),
(147, 'Assist with adaptive equipment', 'Therapy & Health Appointments', '2025-10-23 10:17:35'),
(148, 'Provide therapy feedback', 'Therapy & Health Appointments', '2025-10-23 10:17:35'),
(149, 'Support post-operative exercises', 'Therapy & Health Appointments', '2025-10-23 10:17:35'),
(150, 'Monitor rehabilitation outcomes', 'Therapy & Health Appointments', '2025-10-23 10:17:35'),
(151, 'Assist with balance exercises', 'Therapy & Health Appointments', '2025-10-23 10:17:35'),
(152, 'Support cognitive rehabilitation', 'Therapy & Health Appointments', '2025-10-23 10:17:35'),
(153, 'Provide therapy reminders', 'Therapy & Health Appointments', '2025-10-23 10:17:35'),
(154, 'Supervise home exercises', 'Therapy & Health Appointments', '2025-10-23 10:17:35'),
(155, 'Assist with pain management', 'Therapy & Health Appointments', '2025-10-23 10:17:35'),
(156, 'Monitor therapy adherence', 'Therapy & Health Appointments', '2025-10-23 10:17:35'),
(157, 'Support mental exercises', 'Therapy & Health Appointments', '2025-10-23 10:17:35'),
(158, 'Assist with daily therapy tasks', 'Therapy & Health Appointments', '2025-10-23 10:17:35'),
(159, 'Provide therapy encouragement', 'Therapy & Health Appointments', '2025-10-23 10:17:35'),
(160, 'Find help when needed', 'Community & Miscellaneous', '2025-10-23 10:17:35'),
(161, 'Rehabilitation services', 'Community & Miscellaneous', '2025-10-23 10:17:35'),
(162, 'Wellbeing programs', 'Community & Miscellaneous', '2025-10-23 10:17:35'),
(163, 'Community engagement activity', 'Community & Miscellaneous', '2025-10-23 10:17:35'),
(164, 'Volunteering support', 'Community & Miscellaneous', '2025-10-23 10:17:35'),
(165, 'Attend social events', 'Community & Miscellaneous', '2025-10-23 10:17:35'),
(166, 'Support group participation', 'Community & Miscellaneous', '2025-10-23 10:17:35'),
(167, 'Organize recreational activities', 'Community & Miscellaneous', '2025-10-23 10:17:35'),
(168, 'Provide transport for community events', 'Community & Miscellaneous', '2025-10-23 10:17:35'),
(169, 'Assist with outings', 'Community & Miscellaneous', '2025-10-23 10:17:35'),
(170, 'Monitor community participation', 'Community & Miscellaneous', '2025-10-23 10:17:35'),
(171, 'Arrange group meetings', 'Community & Miscellaneous', '2025-10-23 10:17:35'),
(172, 'Assist with workshops', 'Community & Miscellaneous', '2025-10-23 10:17:35'),
(173, 'Support local initiatives', 'Community & Miscellaneous', '2025-10-23 10:17:35'),
(174, 'Plan social gatherings', 'Community & Miscellaneous', '2025-10-23 10:17:35'),
(175, 'Coordinate community tasks', 'Community & Miscellaneous', '2025-10-23 10:17:35'),
(176, 'Support wellbeing workshops', 'Community & Miscellaneous', '2025-10-23 10:17:35'),
(177, 'Assist with hobby activities', 'Community & Miscellaneous', '2025-10-23 10:17:35'),
(178, 'Facilitate engagement sessions', 'Community & Miscellaneous', '2025-10-23 10:17:35'),
(179, 'Support recreational programs', 'Community & Miscellaneous', '2025-10-23 10:17:35'),
(180, 'Organize charity events', 'Community & Miscellaneous', '2025-10-23 10:17:35'),
(181, 'Support cultural programs', 'Community & Miscellaneous', '2025-10-23 10:17:35'),
(182, 'Assist with awareness campaigns', 'Community & Miscellaneous', '2025-10-23 10:17:35'),
(183, 'Coordinate volunteering activities', 'Community & Miscellaneous', '2025-10-23 10:17:35'),
(184, 'Support environmental projects', 'Community & Miscellaneous', '2025-10-23 10:17:35'),
(185, 'Assist with mentorship programs', 'Community & Miscellaneous', '2025-10-23 10:17:35'),
(186, 'Support educational workshops', 'Community & Miscellaneous', '2025-10-23 10:17:35'),
(187, 'Organize community drives', 'Community & Miscellaneous', '2025-10-23 10:17:35'),
(188, 'Provide information sessions', 'Community & Miscellaneous', '2025-10-23 10:17:35'),
(189, 'Support fundraising events', 'Community & Miscellaneous', '2025-10-23 10:17:35'),
(190, 'Assist with group fitness', 'Community & Miscellaneous', '2025-10-23 10:17:35'),
(191, 'Coordinate senior activities', 'Community & Miscellaneous', '2025-10-23 10:17:35'),
(192, 'Organize hobby clubs', 'Community & Miscellaneous', '2025-10-23 10:17:35'),
(193, 'Support peer groups', 'Community & Miscellaneous', '2025-10-23 10:17:35'),
(194, 'Assist with social campaigns', 'Community & Miscellaneous', '2025-10-23 10:17:35'),
(195, 'Monitor program outcomes', 'Community & Miscellaneous', '2025-10-23 10:17:35'),
(196, 'Support networking events', 'Community & Miscellaneous', '2025-10-23 10:17:35'),
(197, 'Coordinate public talks', 'Community & Miscellaneous', '2025-10-23 10:17:35'),
(198, 'Assist with leisure activities', 'Community & Miscellaneous', '2025-10-23 10:17:35');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_team_account`
--

CREATE TABLE `tbl_team_account` (
  `id` int(11) NOT NULL,
  `user_fullname` text NOT NULL,
  `user_email_address` varchar(500) NOT NULL,
  `user_phone_number` varchar(500) NOT NULL,
  `user_password` varchar(500) NOT NULL,
  `col_cookies_identifier` varchar(500) NOT NULL,
  `user_special_Id` varchar(500) NOT NULL,
  `status` varchar(500) NOT NULL,
  `carer_deviceId` varchar(500) NOT NULL,
  `col_company_Id` varchar(500) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_team_account`
--

INSERT INTO `tbl_team_account` (`id`, `user_fullname`, `user_email_address`, `user_phone_number`, `user_password`, `col_cookies_identifier`, `user_special_Id`, `status`, `carer_deviceId`, `col_company_Id`, `dateTime`) VALUES
(1, 'Osaretin Samson', 'samsonosaretin@yahoo.com', '+44 (328) 264-7854', 'NULL', 'NULL', '20001', 'active', 'NULL', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 09:27:49'),
(2, 'Ingrid Orla', 'padebyno@mailinator.com', '+44 (228) 264-9990', 'NULL', 'NULL', '20002', 'active', 'NULL', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 09:27:58'),
(3, 'Cruz Abra', 'besyv@mailinator.com', '+44 (398) 264-4138', 'NULL', 'NULL', '20003', 'active', 'NULL', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-25 09:27:37');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_team_certificates`
--

CREATE TABLE `tbl_team_certificates` (
  `userId` int(11) NOT NULL,
  `cert_name` varchar(500) NOT NULL,
  `cert_expire` varchar(500) NOT NULL,
  `dateUpload` varchar(500) NOT NULL,
  `cert_file` varchar(500) NOT NULL,
  `uryyTteamoeSS4` varchar(500) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_team_documents`
--

CREATE TABLE `tbl_team_documents` (
  `userId` int(11) NOT NULL COMMENT 'Id number for team',
  `col_Id_image` varchar(500) NOT NULL COMMENT 'Team Id card doc',
  `col_drivers_licence_image` varchar(500) NOT NULL COMMENT 'Team drivers licence doc',
  `col_bank_statement_image` varchar(500) NOT NULL COMMENT 'Team bank statement doc',
  `col_utility_bill_image` varchar(500) NOT NULL COMMENT 'Team utility bill doc',
  `col_references_image` varchar(500) NOT NULL COMMENT 'Team reference doc',
  `col_dbs_records_image` varchar(500) NOT NULL COMMENT 'Team dbs record doc',
  `uryyTteamoeSS4` varchar(500) NOT NULL COMMENT 'Team special Id',
  `col_company_Id` varchar(500) NOT NULL COMMENT 'Team company Id',
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'Date updated'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_team_documents`
--

INSERT INTO `tbl_team_documents` (`userId`, `col_Id_image`, `col_drivers_licence_image`, `col_bank_statement_image`, `col_utility_bill_image`, `col_references_image`, `col_dbs_records_image`, `uryyTteamoeSS4`, `col_company_Id`, `dateTime`) VALUES
(1, 'Null', 'Null', 'Null', 'Null', 'Null', 'Null', 'e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-23 20:59:55');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_team_employment`
--

CREATE TABLE `tbl_team_employment` (
  `userId` int(11) NOT NULL COMMENT 'Id number for all team',
  `col_first_name` varchar(500) NOT NULL COMMENT 'For team first name',
  `col_last_name` varchar(500) NOT NULL COMMENT 'For team last name',
  `col_employee_no` varchar(500) NOT NULL COMMENT 'Employee number',
  `col_team_role` varchar(500) NOT NULL COMMENT 'Role',
  `col_contract_type` varchar(500) NOT NULL COMMENT 'Contract type',
  `col_contract` varchar(500) NOT NULL COMMENT 'Contract',
  `col_weekly_contract_hour` varchar(500) NOT NULL COMMENT 'Weekly contracted hours',
  `col_covid_vacin` varchar(500) NOT NULL COMMENT 'Covid vaccination status',
  `uryyTteamoeSS4` varchar(500) NOT NULL COMMENT 'Team special id',
  `col_company_Id` varchar(500) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'Date data was updated'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_team_employment`
--

INSERT INTO `tbl_team_employment` (`userId`, `col_first_name`, `col_last_name`, `col_employee_no`, `col_team_role`, `col_contract_type`, `col_contract`, `col_weekly_contract_hour`, `col_covid_vacin`, `uryyTteamoeSS4`, `col_company_Id`, `dateTime`) VALUES
(1, 'Osaretin', 'Samson', 'Null', 'Null', 'Null', 'Null', 'Null', 'Null', 'e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-23 20:59:55');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_team_highlight`
--

CREATE TABLE `tbl_team_highlight` (
  `userId` int(11) NOT NULL,
  `team_highlight` text NOT NULL,
  `uryyTteamoeSS4` varchar(500) NOT NULL,
  `col_company_Id` varchar(500) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_team_notes`
--

CREATE TABLE `tbl_team_notes` (
  `userId` int(11) NOT NULL,
  `team_name` varchar(500) NOT NULL,
  `uryyTteamoeSS4` varchar(500) NOT NULL,
  `team_note` text NOT NULL,
  `dateof_note` varchar(500) NOT NULL,
  `timeof_note` varchar(500) NOT NULL,
  `col_company_Id` varchar(500) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_team_status`
--

CREATE TABLE `tbl_team_status` (
  `userId` int(11) NOT NULL,
  `col_full_name` varchar(500) NOT NULL,
  `col_startDate` varchar(500) NOT NULL,
  `col_endDate` varchar(500) NOT NULL,
  `col_team_condition` varchar(500) NOT NULL,
  `col_note` text NOT NULL,
  `col_approval` varchar(500) NOT NULL,
  `col_is_read` varchar(500) NOT NULL,
  `col_color_code` varchar(500) NOT NULL,
  `uryyTteamoeSS4` varchar(500) NOT NULL,
  `col_company_Id` varchar(500) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_travel_rate`
--

CREATE TABLE `tbl_travel_rate` (
  `userId` int(11) NOT NULL,
  `col_name` varchar(500) NOT NULL,
  `col_hourly_rate` varchar(500) NOT NULL,
  `col_mileage_rate` varchar(500) NOT NULL,
  `col_break` varchar(500) NOT NULL,
  `col_pay_waiting_time` varchar(500) NOT NULL,
  `col_special_Id` varchar(500) NOT NULL,
  `col_company_Id` varchar(500) NOT NULL,
  `col_date` varchar(500) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_travel_rate`
--

INSERT INTO `tbl_travel_rate` (`userId`, `col_name`, `col_hourly_rate`, `col_mileage_rate`, `col_break`, `col_pay_waiting_time`, `col_special_Id`, `col_company_Id`, `col_date`, `dateTime`) VALUES
(1, 'Mileage', '14.30', '0.30', '60', 'No', '1021', 'GE761375-gZb83800-68f8a8e2f3cfb', '2025-10-24', '2025-10-24 09:33:30');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_update_notice`
--

CREATE TABLE `tbl_update_notice` (
  `userId` int(11) NOT NULL,
  `col_notice` text NOT NULL,
  `col_start_date` varchar(500) NOT NULL,
  `col_end_date` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_visit_tasks_plan`
--

CREATE TABLE `tbl_visit_tasks_plan` (
  `userId` int(11) NOT NULL,
  `visit` varchar(500) NOT NULL,
  `ttbc` text NOT NULL,
  `etbuattbao` text NOT NULL,
  `submitedDate` varchar(500) NOT NULL,
  `assessorName` varchar(500) NOT NULL,
  `assessorEmail` varchar(500) NOT NULL,
  `help_tasks` varchar(500) NOT NULL,
  `uryyToeSS4` varchar(500) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `tbl_assessment_entries`
--
ALTER TABLE `tbl_assessment_entries`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `tbl_billing_config`
--
ALTER TABLE `tbl_billing_config`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `tbl_cancelled_call`
--
ALTER TABLE `tbl_cancelled_call`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_care_plan`
--
ALTER TABLE `tbl_care_plan`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `tbl_care_plan_section`
--
ALTER TABLE `tbl_care_plan_section`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `tbl_chat_system`
--
ALTER TABLE `tbl_chat_system`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `tbl_clients_medication_records`
--
ALTER TABLE `tbl_clients_medication_records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_clients_task_records`
--
ALTER TABLE `tbl_clients_task_records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_clienttime_calls`
--
ALTER TABLE `tbl_clienttime_calls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_client_invoice`
--
ALTER TABLE `tbl_client_invoice`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `tbl_client_medical`
--
ALTER TABLE `tbl_client_medical`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_client_nok`
--
ALTER TABLE `tbl_client_nok`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `tbl_client_notes`
--
ALTER TABLE `tbl_client_notes`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `tbl_client_runs`
--
ALTER TABLE `tbl_client_runs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_client_status_records`
--
ALTER TABLE `tbl_client_status_records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_contract`
--
ALTER TABLE `tbl_contract`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `tbl_daily_shift_records`
--
ALTER TABLE `tbl_daily_shift_records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_documents`
--
ALTER TABLE `tbl_documents`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `tbl_finished_meds`
--
ALTER TABLE `tbl_finished_meds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_finished_tasks`
--
ALTER TABLE `tbl_finished_tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_funding`
--
ALTER TABLE `tbl_funding`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `tbl_future_planning`
--
ALTER TABLE `tbl_future_planning`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_general_client_form`
--
ALTER TABLE `tbl_general_client_form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_general_team_form`
--
ALTER TABLE `tbl_general_team_form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_group_list`
--
ALTER TABLE `tbl_group_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_holiday`
--
ALTER TABLE `tbl_holiday`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `tbl_invoices`
--
ALTER TABLE `tbl_invoices`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `tbl_invoice_rate`
--
ALTER TABLE `tbl_invoice_rate`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `tbl_manage_runs`
--
ALTER TABLE `tbl_manage_runs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_medication_list`
--
ALTER TABLE `tbl_medication_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_payer`
--
ALTER TABLE `tbl_payer`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `tbl_pay_rate`
--
ALTER TABLE `tbl_pay_rate`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `tbl_pay_run`
--
ALTER TABLE `tbl_pay_run`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `tbl_position`
--
ALTER TABLE `tbl_position`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_post_updates`
--
ALTER TABLE `tbl_post_updates`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `tbl_purchase_order`
--
ALTER TABLE `tbl_purchase_order`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `tbl_raise_concern`
--
ALTER TABLE `tbl_raise_concern`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `tbl_ratings`
--
ALTER TABLE `tbl_ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_report_issues`
--
ALTER TABLE `tbl_report_issues`
  ADD PRIMARY KEY (`report_Id`);

--
-- Indexes for table `tbl_schedule_calls`
--
ALTER TABLE `tbl_schedule_calls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_task_list`
--
ALTER TABLE `tbl_task_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_team_account`
--
ALTER TABLE `tbl_team_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_team_certificates`
--
ALTER TABLE `tbl_team_certificates`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `tbl_team_documents`
--
ALTER TABLE `tbl_team_documents`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `tbl_team_employment`
--
ALTER TABLE `tbl_team_employment`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `tbl_team_highlight`
--
ALTER TABLE `tbl_team_highlight`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `tbl_team_notes`
--
ALTER TABLE `tbl_team_notes`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `tbl_team_status`
--
ALTER TABLE `tbl_team_status`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `tbl_travel_rate`
--
ALTER TABLE `tbl_travel_rate`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `tbl_update_notice`
--
ALTER TABLE `tbl_update_notice`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `tbl_visit_tasks_plan`
--
ALTER TABLE `tbl_visit_tasks_plan`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_assessment_entries`
--
ALTER TABLE `tbl_assessment_entries`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_billing_config`
--
ALTER TABLE `tbl_billing_config`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_cancelled_call`
--
ALTER TABLE `tbl_cancelled_call`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_care_plan`
--
ALTER TABLE `tbl_care_plan`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_care_plan_section`
--
ALTER TABLE `tbl_care_plan_section`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_chat_system`
--
ALTER TABLE `tbl_chat_system`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_clients_medication_records`
--
ALTER TABLE `tbl_clients_medication_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tbl_clients_task_records`
--
ALTER TABLE `tbl_clients_task_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tbl_clienttime_calls`
--
ALTER TABLE `tbl_clienttime_calls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `tbl_client_invoice`
--
ALTER TABLE `tbl_client_invoice`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_client_medical`
--
ALTER TABLE `tbl_client_medical`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_client_nok`
--
ALTER TABLE `tbl_client_nok`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_client_notes`
--
ALTER TABLE `tbl_client_notes`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_client_runs`
--
ALTER TABLE `tbl_client_runs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_client_status_records`
--
ALTER TABLE `tbl_client_status_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_contract`
--
ALTER TABLE `tbl_contract`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_daily_shift_records`
--
ALTER TABLE `tbl_daily_shift_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_documents`
--
ALTER TABLE `tbl_documents`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_finished_meds`
--
ALTER TABLE `tbl_finished_meds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_finished_tasks`
--
ALTER TABLE `tbl_finished_tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_funding`
--
ALTER TABLE `tbl_funding`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_future_planning`
--
ALTER TABLE `tbl_future_planning`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_general_client_form`
--
ALTER TABLE `tbl_general_client_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_general_team_form`
--
ALTER TABLE `tbl_general_team_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_group_list`
--
ALTER TABLE `tbl_group_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=191;

--
-- AUTO_INCREMENT for table `tbl_holiday`
--
ALTER TABLE `tbl_holiday`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_invoices`
--
ALTER TABLE `tbl_invoices`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_invoice_rate`
--
ALTER TABLE `tbl_invoice_rate`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_manage_runs`
--
ALTER TABLE `tbl_manage_runs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tbl_medication_list`
--
ALTER TABLE `tbl_medication_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT for table `tbl_payer`
--
ALTER TABLE `tbl_payer`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_pay_rate`
--
ALTER TABLE `tbl_pay_rate`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_pay_run`
--
ALTER TABLE `tbl_pay_run`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_position`
--
ALTER TABLE `tbl_position`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `tbl_post_updates`
--
ALTER TABLE `tbl_post_updates`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_purchase_order`
--
ALTER TABLE `tbl_purchase_order`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_raise_concern`
--
ALTER TABLE `tbl_raise_concern`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_ratings`
--
ALTER TABLE `tbl_ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_report_issues`
--
ALTER TABLE `tbl_report_issues`
  MODIFY `report_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_schedule_calls`
--
ALTER TABLE `tbl_schedule_calls`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `tbl_task_list`
--
ALTER TABLE `tbl_task_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=199;

--
-- AUTO_INCREMENT for table `tbl_team_account`
--
ALTER TABLE `tbl_team_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_team_certificates`
--
ALTER TABLE `tbl_team_certificates`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_team_documents`
--
ALTER TABLE `tbl_team_documents`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id number for team', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_team_employment`
--
ALTER TABLE `tbl_team_employment`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id number for all team', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_team_highlight`
--
ALTER TABLE `tbl_team_highlight`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_team_notes`
--
ALTER TABLE `tbl_team_notes`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_team_status`
--
ALTER TABLE `tbl_team_status`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_travel_rate`
--
ALTER TABLE `tbl_travel_rate`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_update_notice`
--
ALTER TABLE `tbl_update_notice`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_visit_tasks_plan`
--
ALTER TABLE `tbl_visit_tasks_plan`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
