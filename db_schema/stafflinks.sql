-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2025 at 11:07 AM
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
  `userId` int(11) NOT NULL,
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
  `userId` int(11) NOT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `tbl_clients_task_records`
--

CREATE TABLE `tbl_clients_task_records` (
  `userId` int(11) NOT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `tbl_clienttime_calls`
--

CREATE TABLE `tbl_clienttime_calls` (
  `userId` int(11) NOT NULL,
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
  `userId` int(11) NOT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `tbl_client_runs`
--

CREATE TABLE `tbl_client_runs` (
  `userId` int(11) NOT NULL,
  `run_name` varchar(500) NOT NULL,
  `run_town` varchar(500) NOT NULL,
  `col_run_city` varchar(500) NOT NULL,
  `run_ids` varchar(500) NOT NULL,
  `comp_location_view` varchar(500) NOT NULL,
  `col_company_Id` varchar(500) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_client_status_records`
--

CREATE TABLE `tbl_client_status_records` (
  `userId` int(11) NOT NULL,
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
  `userId` int(11) NOT NULL,
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
-- Table structure for table `tbl_equipment_risk_assessment`
--

CREATE TABLE `tbl_equipment_risk_assessment` (
  `userId` int(11) NOT NULL,
  `equipment_details` varchar(500) NOT NULL,
  `to_be_use_to` varchar(500) NOT NULL,
  `col_how` text NOT NULL,
  `last_serviced` varchar(500) NOT NULL,
  `next_service` varchar(500) NOT NULL,
  `submitedDate` varchar(500) NOT NULL,
  `assessorName` varchar(500) NOT NULL,
  `assessorEmail` varchar(500) NOT NULL,
  `help_tasks` varchar(500) NOT NULL,
  `uryyToeSS4` varchar(500) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_finished_meds`
--

CREATE TABLE `tbl_finished_meds` (
  `userId` int(11) NOT NULL,
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
  `userId` int(11) NOT NULL,
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
-- Table structure for table `tbl_fire_action_plan`
--

CREATE TABLE `tbl_fire_action_plan` (
  `userId` int(11) NOT NULL,
  `emergency_exit1` varchar(500) NOT NULL,
  `emergency_exit2` varchar(500) NOT NULL,
  `refuge_room_details` varchar(500) NOT NULL,
  `locality_of_window` varchar(500) NOT NULL,
  `assessor` varchar(500) NOT NULL,
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
  `userId` int(11) NOT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `tbl_general_client_form`
--

CREATE TABLE `tbl_general_client_form` (
  `userId` int(11) NOT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `tbl_general_team_form`
--

CREATE TABLE `tbl_general_team_form` (
  `userId` int(11) NOT NULL,
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
  `privilege` varchar(500) NOT NULL,
  `team_info` text NOT NULL,
  `transportation` varchar(500) NOT NULL,
  `col_pay_rate` varchar(500) NOT NULL,
  `col_rate_type` varchar(500) NOT NULL,
  `col_mileage` text NOT NULL,
  `employment_type` varchar(500) NOT NULL,
  `col_company_city` varchar(500) NOT NULL,
  `col_start_date` varchar(500) NOT NULL,
  `col_company_Id` varchar(500) NOT NULL,
  `col_team_resource` varchar(500) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_goesoft_carers_account`
--

CREATE TABLE `tbl_goesoft_carers_account` (
  `userId` int(11) NOT NULL,
  `user_fullname` text NOT NULL,
  `user_email_address` varchar(500) NOT NULL,
  `user_phone_number` varchar(500) NOT NULL,
  `user_password` varchar(500) NOT NULL,
  `col_cookies_identifier` varchar(500) NOT NULL,
  `user_special_Id` varchar(500) NOT NULL,
  `status1` varchar(500) NOT NULL,
  `status2` varchar(500) NOT NULL,
  `carer_deviceId` varchar(500) NOT NULL,
  `col_company_Id` varchar(500) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_goesoft_users`
--

CREATE TABLE `tbl_goesoft_users` (
  `userId` int(11) NOT NULL,
  `user_fullname` varchar(500) NOT NULL,
  `user_email_address` varchar(500) NOT NULL,
  `company_name` varchar(500) NOT NULL,
  `user_password` varchar(500) NOT NULL,
  `date_registered` varchar(500) NOT NULL,
  `time_registered` varchar(500) NOT NULL,
  `user_special_Id` varchar(500) NOT NULL,
  `VNumber` varchar(100) NOT NULL,
  `verification_code` varchar(500) NOT NULL,
  `status1` varchar(500) NOT NULL,
  `status2` varchar(500) NOT NULL,
  `myviewArea` varchar(500) NOT NULL,
  `client_view` varchar(500) NOT NULL,
  `team_view` varchar(500) NOT NULL,
  `my_city` varchar(500) NOT NULL,
  `my_ip` varchar(500) NOT NULL,
  `my_country` varchar(500) NOT NULL,
  `finance_access` varchar(500) NOT NULL,
  `finance_access2` varchar(500) NOT NULL,
  `admin_access` varchar(500) NOT NULL,
  `col_finance_status_color` varchar(500) NOT NULL,
  `col_company_compliment` varchar(500) NOT NULL,
  `col_company_Id` varchar(500) NOT NULL,
  `col_qrcode` varchar(500) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_group_list`
--

CREATE TABLE `tbl_group_list` (
  `group_id` int(11) NOT NULL,
  `group_area` varchar(500) NOT NULL,
  `group_city` varchar(500) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `tbl_manage_runs`
--

CREATE TABLE `tbl_manage_runs` (
  `userId` int(11) NOT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `tbl_medication_list`
--

CREATE TABLE `tbl_medication_list` (
  `med_Id` int(11) NOT NULL,
  `med_name` varchar(500) NOT NULL,
  `med_dosage` varchar(500) NOT NULL,
  `med_type` varchar(500) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mental_health_assessment_tool`
--

CREATE TABLE `tbl_mental_health_assessment_tool` (
  `userId` int(11) NOT NULL,
  `assess_name` varchar(500) NOT NULL,
  `digit_zerro` varchar(500) NOT NULL,
  `digit_one` varchar(500) NOT NULL,
  `digit_two` varchar(500) NOT NULL,
  `digit_three` varchar(500) NOT NULL,
  `comments` varchar(500) NOT NULL,
  `submitedDate` varchar(500) NOT NULL,
  `assessorName` varchar(500) NOT NULL,
  `assessorEmail` varchar(500) NOT NULL,
  `help_tasks` varchar(500) NOT NULL,
  `uryyToeSS4` varchar(500) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_moving_and_handling`
--

CREATE TABLE `tbl_moving_and_handling` (
  `userId` int(11) NOT NULL,
  `actions` varchar(500) NOT NULL,
  `assistance_required` varchar(500) NOT NULL,
  `empty_col` varchar(500) NOT NULL,
  `submitedDate` varchar(500) NOT NULL,
  `assessorName` varchar(500) NOT NULL,
  `assessorEmail` varchar(500) NOT NULL,
  `help_tasks` varchar(500) NOT NULL,
  `uryyToeSS4` varchar(500) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_needs_assessment`
--

CREATE TABLE `tbl_needs_assessment` (
  `userId` int(11) NOT NULL,
  `my_needs` varchar(500) NOT NULL,
  `outcome_i_want` text NOT NULL,
  `wshthmat` text NOT NULL,
  `crthmamdo` text NOT NULL,
  `submitedDate` varchar(500) NOT NULL,
  `assessorName` varchar(500) NOT NULL,
  `assessorEmail` varchar(500) NOT NULL,
  `help_tasks` text NOT NULL,
  `uryyToeSS4` varchar(500) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_outcome_of_assessment`
--

CREATE TABLE `tbl_outcome_of_assessment` (
  `userId` int(11) NOT NULL,
  `my_description` varchar(500) NOT NULL,
  `col_yes` varchar(500) NOT NULL,
  `col_no` varchar(500) NOT NULL,
  `not_capable` varchar(500) NOT NULL,
  `unable_to_assist` varchar(500) NOT NULL,
  `able_to_assist` varchar(500) NOT NULL,
  `fully_capable` varchar(500) NOT NULL,
  `comments` text NOT NULL,
  `submitedDate` varchar(500) NOT NULL,
  `assessorName` varchar(500) NOT NULL,
  `assessorEmail` varchar(500) NOT NULL,
  `help_tasks` varchar(500) NOT NULL,
  `assessment_type` varchar(500) NOT NULL,
  `uryyToeSS4` varchar(500) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Table structure for table `tbl_personalised_risk_assessment`
--

CREATE TABLE `tbl_personalised_risk_assessment` (
  `userId` int(11) NOT NULL,
  `identified_hazard` varchar(500) NOT NULL,
  `risk_level` varchar(500) NOT NULL,
  `wiarahmtbh` text NOT NULL,
  `hitrmom` text NOT NULL,
  `wshwho` text NOT NULL,
  `submitedDate` varchar(500) NOT NULL,
  `assessorName` varchar(500) NOT NULL,
  `assessorEmail` varchar(500) NOT NULL,
  `help_tasks` varchar(500) NOT NULL,
  `uryyToeSS4` varchar(500) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_position`
--

CREATE TABLE `tbl_position` (
  `position_Id` int(11) NOT NULL,
  `position_name` varchar(500) NOT NULL,
  `position_details` varchar(500) NOT NULL,
  `col_company_Id` varchar(500) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Table structure for table `tbl_recent_search`
--

CREATE TABLE `tbl_recent_search` (
  `search_id` int(11) NOT NULL,
  `search_query` varchar(300) NOT NULL,
  `ip_address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
  `userId` int(100) NOT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sensory_impairment_plan`
--

CREATE TABLE `tbl_sensory_impairment_plan` (
  `userId` int(11) NOT NULL,
  `impairment_need` varchar(500) NOT NULL,
  `interventions` text NOT NULL,
  `submitedDate` varchar(500) NOT NULL,
  `assessorName` varchar(500) NOT NULL,
  `assessorEmail` varchar(500) NOT NULL,
  `help_tasks` varchar(500) NOT NULL,
  `uryyToeSS4` varchar(500) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_task_list`
--

CREATE TABLE `tbl_task_list` (
  `task_id` int(11) NOT NULL,
  `task_title` varchar(500) NOT NULL,
  `task_category` varchar(500) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `userId` int(11) NOT NULL,
  `fullName` varchar(500) DEFAULT NULL,
  `email` varchar(500) DEFAULT NULL,
  `password` varchar(500) DEFAULT NULL,
  `verific_code` varchar(500) DEFAULT NULL,
  `uYtey9U8` varchar(500) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
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
  ADD PRIMARY KEY (`userId`);

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
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `tbl_clients_task_records`
--
ALTER TABLE `tbl_clients_task_records`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `tbl_clienttime_calls`
--
ALTER TABLE `tbl_clienttime_calls`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `tbl_client_invoice`
--
ALTER TABLE `tbl_client_invoice`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `tbl_client_medical`
--
ALTER TABLE `tbl_client_medical`
  ADD PRIMARY KEY (`userId`);

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
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `tbl_client_status_records`
--
ALTER TABLE `tbl_client_status_records`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `tbl_contract`
--
ALTER TABLE `tbl_contract`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `tbl_daily_shift_records`
--
ALTER TABLE `tbl_daily_shift_records`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `tbl_documents`
--
ALTER TABLE `tbl_documents`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `tbl_equipment_risk_assessment`
--
ALTER TABLE `tbl_equipment_risk_assessment`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `tbl_finished_meds`
--
ALTER TABLE `tbl_finished_meds`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `tbl_finished_tasks`
--
ALTER TABLE `tbl_finished_tasks`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `tbl_fire_action_plan`
--
ALTER TABLE `tbl_fire_action_plan`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `tbl_funding`
--
ALTER TABLE `tbl_funding`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `tbl_future_planning`
--
ALTER TABLE `tbl_future_planning`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `tbl_general_client_form`
--
ALTER TABLE `tbl_general_client_form`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `tbl_general_team_form`
--
ALTER TABLE `tbl_general_team_form`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `tbl_goesoft_carers_account`
--
ALTER TABLE `tbl_goesoft_carers_account`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `tbl_goesoft_users`
--
ALTER TABLE `tbl_goesoft_users`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `tbl_group_list`
--
ALTER TABLE `tbl_group_list`
  ADD PRIMARY KEY (`group_id`);

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
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `tbl_medication_list`
--
ALTER TABLE `tbl_medication_list`
  ADD PRIMARY KEY (`med_Id`);

--
-- Indexes for table `tbl_mental_health_assessment_tool`
--
ALTER TABLE `tbl_mental_health_assessment_tool`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `tbl_moving_and_handling`
--
ALTER TABLE `tbl_moving_and_handling`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `tbl_needs_assessment`
--
ALTER TABLE `tbl_needs_assessment`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `tbl_outcome_of_assessment`
--
ALTER TABLE `tbl_outcome_of_assessment`
  ADD PRIMARY KEY (`userId`);

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
-- Indexes for table `tbl_personalised_risk_assessment`
--
ALTER TABLE `tbl_personalised_risk_assessment`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `tbl_position`
--
ALTER TABLE `tbl_position`
  ADD PRIMARY KEY (`position_Id`);

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
-- Indexes for table `tbl_recent_search`
--
ALTER TABLE `tbl_recent_search`
  ADD PRIMARY KEY (`search_id`);

--
-- Indexes for table `tbl_report_issues`
--
ALTER TABLE `tbl_report_issues`
  ADD PRIMARY KEY (`report_Id`);

--
-- Indexes for table `tbl_schedule_calls`
--
ALTER TABLE `tbl_schedule_calls`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `tbl_sensory_impairment_plan`
--
ALTER TABLE `tbl_sensory_impairment_plan`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `tbl_task_list`
--
ALTER TABLE `tbl_task_list`
  ADD PRIMARY KEY (`task_id`);

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
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
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
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_clients_task_records`
--
ALTER TABLE `tbl_clients_task_records`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_clienttime_calls`
--
ALTER TABLE `tbl_clienttime_calls`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_client_invoice`
--
ALTER TABLE `tbl_client_invoice`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_client_medical`
--
ALTER TABLE `tbl_client_medical`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_client_nok`
--
ALTER TABLE `tbl_client_nok`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_client_notes`
--
ALTER TABLE `tbl_client_notes`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_client_runs`
--
ALTER TABLE `tbl_client_runs`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_client_status_records`
--
ALTER TABLE `tbl_client_status_records`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_contract`
--
ALTER TABLE `tbl_contract`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_daily_shift_records`
--
ALTER TABLE `tbl_daily_shift_records`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_documents`
--
ALTER TABLE `tbl_documents`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_equipment_risk_assessment`
--
ALTER TABLE `tbl_equipment_risk_assessment`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_finished_meds`
--
ALTER TABLE `tbl_finished_meds`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_finished_tasks`
--
ALTER TABLE `tbl_finished_tasks`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_fire_action_plan`
--
ALTER TABLE `tbl_fire_action_plan`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_funding`
--
ALTER TABLE `tbl_funding`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_future_planning`
--
ALTER TABLE `tbl_future_planning`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_general_client_form`
--
ALTER TABLE `tbl_general_client_form`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_general_team_form`
--
ALTER TABLE `tbl_general_team_form`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_goesoft_carers_account`
--
ALTER TABLE `tbl_goesoft_carers_account`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_goesoft_users`
--
ALTER TABLE `tbl_goesoft_users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_group_list`
--
ALTER TABLE `tbl_group_list`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_holiday`
--
ALTER TABLE `tbl_holiday`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_invoices`
--
ALTER TABLE `tbl_invoices`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_invoice_rate`
--
ALTER TABLE `tbl_invoice_rate`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_manage_runs`
--
ALTER TABLE `tbl_manage_runs`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_medication_list`
--
ALTER TABLE `tbl_medication_list`
  MODIFY `med_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_mental_health_assessment_tool`
--
ALTER TABLE `tbl_mental_health_assessment_tool`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_moving_and_handling`
--
ALTER TABLE `tbl_moving_and_handling`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_needs_assessment`
--
ALTER TABLE `tbl_needs_assessment`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_outcome_of_assessment`
--
ALTER TABLE `tbl_outcome_of_assessment`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_payer`
--
ALTER TABLE `tbl_payer`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_pay_rate`
--
ALTER TABLE `tbl_pay_rate`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_pay_run`
--
ALTER TABLE `tbl_pay_run`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_personalised_risk_assessment`
--
ALTER TABLE `tbl_personalised_risk_assessment`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_position`
--
ALTER TABLE `tbl_position`
  MODIFY `position_Id` int(11) NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `tbl_recent_search`
--
ALTER TABLE `tbl_recent_search`
  MODIFY `search_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_report_issues`
--
ALTER TABLE `tbl_report_issues`
  MODIFY `report_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_schedule_calls`
--
ALTER TABLE `tbl_schedule_calls`
  MODIFY `userId` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_sensory_impairment_plan`
--
ALTER TABLE `tbl_sensory_impairment_plan`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_task_list`
--
ALTER TABLE `tbl_task_list`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_team_certificates`
--
ALTER TABLE `tbl_team_certificates`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_team_documents`
--
ALTER TABLE `tbl_team_documents`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id number for team';

--
-- AUTO_INCREMENT for table `tbl_team_employment`
--
ALTER TABLE `tbl_team_employment`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id number for all team';

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
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_update_notice`
--
ALTER TABLE `tbl_update_notice`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
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
