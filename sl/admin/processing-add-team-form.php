<?php
include('dbconnections.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['btnSubmitAddNewTeam'])) {

    function safe_input($field_name)
    {
        return trim($_POST[$field_name] ?? '');
    }

    $txtTitle = safe_input('txtTitle');
    $txtFirstName = safe_input('txtFirstName');
    $txtLastName = safe_input('txtLastName');
    $txtMiddleName = safe_input('txtMiddleName');
    $txtPreferredName = safe_input('txtPreferredName');
    $txtEmailAddress = safe_input('txtEmailAddress');
    $txtGenderBased = safe_input('txtGenderBased');
    $txtDateofBirth = safe_input('txtDateofBirth');
    $txtNationality = safe_input('txtNationality');
    $txtPrimaryPhoneNumber = safe_input('txtPrimaryPhoneNumber');
    $txtCultureReligion = safe_input('txtCultureReligion');
    $txtSexuality = safe_input('txtSexuality');
    $txtDBS = safe_input('txtDBS');
    $txtNIN = safe_input('txtNIN');
    $txtAddressLine1 = safe_input('txtAddressLine1');
    $txtAddressLine2 = safe_input('txtAddressLine2');
    $txtCity = safe_input('txtCity');
    $txtCounty = safe_input('txtCounty');
    $txtPosterCode = safe_input('txtPosterCode');
    $txtCountry = safe_input('txtCountry');
    $txtTransportMeans = safe_input('txtTransportMeans');
    $txtEmploymentType = safe_input('txtEmploymentType');
    $txtJobRoleId = safe_input('txtJobRole');
    $txtCompanyCity = safe_input('txtCompanyCity');
    $txtStartDate = safe_input('txtStartDate');
    $mysocialId = safe_input('mysocialId');
    $mysocialIdEncrypt = safe_input('mysocialIdEncrypt');
    $compId = $_SESSION['usr_compId'] ?? '';

    $check_email_query = "SELECT team_email_address FROM tbl_general_team_form WHERE team_email_address = ?";
    $stmt = $conn->prepare($check_email_query);
    $stmt->bind_param("s", $txtEmailAddress);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        header("Location: ./team-email-exists");
    } else {
        echo "Email is available.";
    }

    $stmt->close();

    $sql = "SELECT * FROM tbl_pay_rate WHERE col_special_Id = ? AND col_company_Id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $txtJobRoleId, $compId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $teamPayRate = $row["col_rates"];
        $teamJobRole = $row["col_name"];
    }
    $select_last_row_query = "SELECT * FROM tbl_general_team_form ORDER BY userId DESC LIMIT 1";
    $select_last_row_result = $conn->query($select_last_row_query);

    if ($select_last_row_result && $select_last_row_result->num_rows > 0) {
        $output_row = $select_last_row_result->fetch_assoc();
        $recentTeamId = $output_row["uryyTteamoeSS4"];
        $teamId = $recentTeamId + 1;
    } else {
        $teamId = 20001;
    }

    $sqlInsertTeam = mysqli_query($conn, "
        INSERT INTO tbl_general_team_form (
            team_title, team_first_name, team_last_name, team_middle_name, team_preferred_name,
            team_email_address, team_referred_to, team_date_of_birth, team_nationality, team_primary_phone,
            team_culture_religion, team_sexuality, team_dbs, team_nin, team_address_line_1,
            team_address_line_2, team_city, team_county, team_poster_code, team_country,
            uryyTteamoeSS4, transportation, col_pay_rate, col_rate_type, col_mileage, employment_type, 
            col_company_city, col_start_date, col_company_Id
        ) VALUES (
            '$txtTitle', '$txtFirstName', '$txtLastName', '$txtMiddleName', '$txtPreferredName',
            '$txtEmailAddress', '$txtGenderBased', '$txtDateofBirth', '$txtNationality', '$txtPrimaryPhoneNumber',
            '$txtCultureReligion', '$txtSexuality', '$txtDBS', '$txtNIN', '$txtAddressLine1',
            '$txtAddressLine2', '$txtCity', '$txtCounty', '$txtPosterCode', '$txtCountry',
            '$teamId', '$txtTransportMeans', '$teamPayRate', '$teamJobRole', '0.00', '$txtEmploymentType', 
            '$txtCompanyCity', '$txtStartDate', '$compId'
        )
    ");

    if ($sqlInsertTeam == true) {
        // Insert into tbl_team_account
        $user_fullname = trim("$txtFirstName $txtLastName");
        $user_email_address = $txtEmailAddress;
        $user_phone_number = $txtPrimaryPhoneNumber;
        $user_password = 'NULL';
        $col_cookies_identifier = 'NULL';
        $user_special_Id = $teamId;
        $status = 'active';
        $carer_deviceId = 'NULL';
        $col_company_Id = $compId;

        $sql = "INSERT INTO tbl_team_account (
    user_fullname, user_email_address, user_phone_number, user_password, 
    col_cookies_identifier, user_special_Id, status, carer_deviceId, col_company_Id
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "sssssssss",
            $user_fullname,
            $user_email_address,
            $user_phone_number,
            $user_password,
            $col_cookies_identifier,
            $user_special_Id,
            $status,
            $carer_deviceId,
            $col_company_Id
        );

        if ($stmt->execute()) {
            header("Location: team-list");
            exit();
        } else {
            die("❌ Error inserting team account: " . $stmt->error);
        }
    } else {
        header("Location: ./team-list");
    }

    $stmt->close();
    $conn->close();
}
