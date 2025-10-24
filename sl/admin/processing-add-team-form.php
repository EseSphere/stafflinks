<?php
include('dbconnections.php');
// Enable full error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['btnSubmitAddNewTeam'])) {

    if (!$conn) {
        die("❌ Database connection failed: " . mysqli_connect_error());
    }

    // Safe input helper
    function safe_input($conn, $key)
    {
        return isset($_REQUEST[$key]) ? mysqli_real_escape_string($conn, $_REQUEST[$key]) : '';
    }

    // Collect form inputs safely
    $txtTitle = safe_input($conn, 'txtTitle');
    $txtFirstName = safe_input($conn, 'txtFirstName');
    $txtLastName = safe_input($conn, 'txtLastName');
    $txtMiddleName = safe_input($conn, 'txtMiddleName');
    $txtPreferredName = safe_input($conn, 'txtPreferredName');
    $txtEmailAddress = safe_input($conn, 'txtEmailAddress');
    $txtGenderBased = safe_input($conn, 'txtGenderBased');
    $txtDateofBirth = safe_input($conn, 'txtDateofBirth');
    $txtNationality = safe_input($conn, 'txtNationality');
    $txtPrimaryPhoneNumber = safe_input($conn, 'txtPrimaryPhoneNumber');
    $txtCultureReligion = safe_input($conn, 'txtCultureReligion');
    $txtSexuality = safe_input($conn, 'txtSexuality');
    $txtDBS = safe_input($conn, 'txtDBS');
    $txtNIN = safe_input($conn, 'txtNIN');
    $txtAddressLine1 = safe_input($conn, 'txtAddressLine1');
    $txtAddressLine2 = safe_input($conn, 'txtAddressLine2');
    $txtCity = safe_input($conn, 'txtCity');
    $txtCounty = safe_input($conn, 'txtCounty');
    $txtPosterCode = safe_input($conn, 'txtPosterCode');
    $txtCountry = safe_input($conn, 'txtCountry');
    $txtTransportMeans = safe_input($conn, 'txtTransportMeans');
    $txtEmploymentType = safe_input($conn, 'txtEmploymentType');
    $txtCompanyCity = safe_input($conn, 'txtCompanyCity');
    $txtStartDate = safe_input($conn, 'txtStartDate');
    $txtCompanyId = safe_input($conn, 'txtCompanyId');
    $mysocialId = safe_input($conn, 'mysocialId');
    $mysocialIdEncrypt = safe_input($conn, 'mysocialIdEncrypt');

    $txtTeamPayRate = "0.00";
    $compId = $_SESSION['usr_compId'] ?? '';

    // Generate a unique hash ID
    $myIdentity001 = hash('sha256', $mysocialId);

    // ✅ Check if email already exists
    $checkEmailSQL = "SELECT * FROM tbl_general_team_form WHERE team_email_address = '$txtEmailAddress'";
    $resEmail = mysqli_query($conn, $checkEmailSQL);
    if (!$resEmail) die("❌ Email check failed: " . mysqli_error($conn));

    if (mysqli_num_rows($resEmail) > 0) {
        echo "<script>alert('Email already exists!');</script>";
        exit;
    }

    // ✅ Check if social ID already exists for this company
    $checkSocialSQL = "SELECT * FROM tbl_general_team_form WHERE uryyTteamoeSS4 = '$myIdentity001' AND col_company_Id = '$compId'";
    $resSocial = mysqli_query($conn, $checkSocialSQL);
    if (!$resSocial) die("❌ Social ID check failed: " . mysqli_error($conn));

    $identityToUse = $myIdentity001;
    if (mysqli_num_rows($resSocial) > 0) {
        $identityToUse = $myIdentity001 . $mysocialIdEncrypt;
    }

    // ✅ Insert into main team table (privilege, team_info, col_team_resource removed)
    $sqlInsertTeam = "
        INSERT INTO tbl_general_team_form (
            team_title, team_first_name, team_last_name, team_middle_name, team_preferred_name,
            team_email_address, team_referred_to, team_date_of_birth, team_nationality, team_primary_phone,
            team_culture_religion, team_sexuality, team_dbs, team_nin, team_address_line_1,
            team_address_line_2, team_city, team_county, team_poster_code, team_country,
            uryyTteamoeSS4, transportation, employment_type, col_company_city, col_start_date,
            col_company_Id, col_pay_rate
        ) VALUES (
            '$txtTitle', '$txtFirstName', '$txtLastName', '$txtMiddleName', '$txtPreferredName',
            '$txtEmailAddress', '$txtGenderBased', '$txtDateofBirth', '$txtNationality', '$txtPrimaryPhoneNumber',
            '$txtCultureReligion', '$txtSexuality', '$txtDBS', '$txtNIN', '$txtAddressLine1',
            '$txtAddressLine2', '$txtCity', '$txtCounty', '$txtPosterCode', '$txtCountry',
            '$identityToUse', '$txtTransportMeans', '$txtEmploymentType', '$txtCompanyCity', '$txtStartDate',
            '$txtCompanyId', '$txtTeamPayRate'
        )
    ";

    if (!mysqli_query($conn, $sqlInsertTeam)) {
        header("Location: ./add-new-team");
    }

    // ✅ Insert into employment table (col_team_role removed)
    $sqlInsertEmployment = "
        INSERT INTO tbl_team_employment (
            col_first_name, col_last_name,
            col_contract_type, col_contract, col_weekly_contract_hour, col_covid_vacin,
            uryyTteamoeSS4, col_company_Id
        ) VALUES (
            '$txtFirstName', '$txtLastName',
            NULL, NULL, NULL, NULL,
            '$identityToUse', '$txtCompanyId'
        )
    ";

    if (!mysqli_query($conn, $sqlInsertEmployment)) {
        header("Location: ./add-new-team");
    }

    // ✅ Insert into documents table
    $sqlInsertDocs = "
        INSERT INTO tbl_team_documents (
            col_Id_image, col_drivers_licence_image, col_bank_statement_image, col_utility_bill_image,
            col_references_image, col_dbs_records_image, uryyTteamoeSS4, col_company_Id
        ) VALUES (
            NULL, NULL, NULL, NULL,
            NULL, NULL, '$identityToUse', '$txtCompanyId'
        )
    ";

    if (!mysqli_query($conn, $sqlInsertDocs)) {
        header("Location: ./add-new-team");
    }

    // ✅ Redirect after success
    header("Location: ./team-list");
    exit;
}
