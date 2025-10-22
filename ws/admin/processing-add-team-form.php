<?php

if (isset($_POST['btnSubmitAddNewTeam'])) {

    include('dbconnections.php');

    $txtTitle = mysqli_real_escape_string($conn, $_REQUEST['txtTitle']);
    $txtFirstName = mysqli_real_escape_string($conn, $_REQUEST['txtFirstName']);
    $txtLastName = mysqli_real_escape_string($conn, $_REQUEST['txtLastName']);
    $txtMiddleName = mysqli_real_escape_string($conn, $_REQUEST['txtMiddleName']);
    $txtPreferredName = mysqli_real_escape_string($conn, $_REQUEST['txtPreferredName']);
    $txtEmailAddress = mysqli_real_escape_string($conn, $_REQUEST['txtEmailAddress']);
    $txtGenderBased = mysqli_real_escape_string($conn, $_REQUEST['txtGenderBased']);
    $txtDateofBirth = mysqli_real_escape_string($conn, $_REQUEST['txtDateofBirth']);

    $txtNationality = mysqli_real_escape_string($conn, $_REQUEST['txtNationality']);
    $txtPrimaryPhoneNumber = mysqli_real_escape_string($conn, $_REQUEST['txtPrimaryPhoneNumber']);

    $txtCultureReligion = mysqli_real_escape_string($conn, $_REQUEST['txtCultureReligion']);
    $txtSexuality = mysqli_real_escape_string($conn, $_REQUEST['txtSexuality']);
    $txtDBS = mysqli_real_escape_string($conn, $_REQUEST['txtDBS']);
    $txtNIN = mysqli_real_escape_string($conn, $_REQUEST['txtNIN']);
    $txtAddressLine1 = mysqli_real_escape_string($conn, $_REQUEST['txtAddressLine1']);
    $txtAddressLine2 = mysqli_real_escape_string($conn, $_REQUEST['txtAddressLine2']);
    $txtCity = mysqli_real_escape_string($conn, $_REQUEST['txtCity']);
    $txtCounty = mysqli_real_escape_string($conn, $_REQUEST['txtCounty']);
    $txtPosterCode = mysqli_real_escape_string($conn, $_REQUEST['txtPosterCode']);
    $txtCountry = mysqli_real_escape_string($conn, $_REQUEST['txtCountry']);

    $txtClientStatus = "Active";
    $txtClientStatuscolors = "rgba(41, 128, 185,1.0)";

    $mysocialId = mysqli_real_escape_string($conn, $_REQUEST['mysocialId']);
    $mysocialIdEncrypt = mysqli_real_escape_string($conn, $_REQUEST['mysocialIdEncrypt']);
    $myIdentity001 = hash('sha256', $mysocialId);
    $txtTransportMeans = mysqli_real_escape_string($conn, $_REQUEST['txtTransportMeans']);
    $txtEmploymentType = mysqli_real_escape_string($conn, $_REQUEST['txtEmploymentType']);
    $txtCompanyCity = mysqli_real_escape_string($conn, $_REQUEST['txtCompanyCity']);
    $txtStartDate = mysqli_real_escape_string($conn, $_REQUEST['txtStartDate']);
    $txtCompanyId = mysqli_real_escape_string($conn, $_REQUEST['txtCompanyId']);
    $txtTeamResource = mysqli_real_escape_string($conn, $_REQUEST['txtTeamResource']);
    $txtTeamPayRate = "0.00";

    $txtfirstBox = "Null";
    $txtSecondBox = "Null";
    $txtThirdBox = "Null";
    $txtFourthBox = "Null";
    $txtFiftBox = "Null";
    $txtSixthBox = "Null";
    $txtSeventBox = "Null";
    $txtEightBox = "Null";

    $txtfirstDocs = "Null";
    $txtSecondDocs = "Null";
    $txtThirdDocs = "Null";
    $txtFourthDocs = "Null";
    $txtFiftDocs = "Null";
    $txtSixthDocs = "Null";

    $myCheck = "SELECT * FROM tbl_general_team_form WHERE team_email_address = '" . $txtEmailAddress . "' ";
    $myCheckres = mysqli_query($conn, $myCheck);
    $countRes = mysqli_num_rows($myCheckres);

    if ($countRes != 0) {
        echo "
      <script type='text/javascript'>
      $(document).ready(function() {
        $('#popupAlert').show();
      });
    </script>";
    } else {

        //Check if current team social id is already in the database.
        $Client_special_Id_Check = "SELECT * FROM tbl_general_team_form WHERE (uryyTteamoeSS4 = '$myIdentity001' AND col_company_Id = '" . $_SESSION['usr_compId'] . "') ";
        $my_Id_Check_res = mysqli_query($conn, $Client_special_Id_Check);
        $count_Id_Res = mysqli_num_rows($my_Id_Check_res);
        if ($count_Id_Res != 0) {
            //If the current team social id is already in the database, then add new client by adding one integer to the current id.
            $myIdentity = $myIdentity001 . '' . $mysocialIdEncrypt;
            $myResouces001 = $txtTeamResource + 1;

            $queryIns = mysqli_query($conn, "INSERT INTO tbl_general_team_form (team_title, team_first_name, team_last_name, team_middle_name, team_preferred_name, team_email_address, team_referred_to, team_date_of_birth, team_nationality, team_primary_phone, team_culture_religion, team_sexuality, team_dbs, team_nin, team_address_line_1, team_address_line_2, team_city, team_county, team_poster_code, team_country, uryyTteamoeSS4, transportation, employment_type, col_company_city, col_start_date, col_company_Id, col_team_resource, col_pay_rate)
            VALUES('" . $txtTitle . "', '" . $txtFirstName . "', '" . $txtLastName . "', '" . $txtMiddleName . "', '" . $txtPreferredName . "', '" . $txtEmailAddress . "', '" . $txtGenderBased . "', '" . $txtDateofBirth . "', '" . $txtNationality . "', '" . $txtPrimaryPhoneNumber . "', '" . $txtCultureReligion . "', '" . $txtSexuality . "', '" . $txtDBS . "', '" . $txtNIN . "', '" . $txtAddressLine1 . "', '" . $txtAddressLine2 . "', '" . $txtCity . "', '" . $txtCounty . "', '" . $txtPosterCode . "', '" . $txtCountry . "', '" . $myIdentity . "', '" . $txtTransportMeans . "', '" . $txtEmploymentType . "', '" . $txtCompanyCity . "', '" . $txtStartDate . "', '" . $txtCompanyId . "', '" . 'RS' . $myResouces001 . "', '" . $txtTeamPayRate . "' ) ");
            if ($queryIns) {
                ////////////////////////Insert dom data into employee table////////////////////////////////////////
                $insert_employees_data_queryIns = mysqli_query($conn, "INSERT INTO tbl_team_employment (col_first_name, col_last_name, col_employee_no, col_team_role, col_contract_type, col_contract, col_weekly_contract_hour, col_covid_vacin, uryyTteamoeSS4, col_company_Id) 
                VALUES('" . $txtFirstName . "', '" . $txtLastName . "', '" . $txtSecondBox . "', '" . $txtThirdBox . "', '" . $txtFourthBox . "', '" . $txtFiftBox . "', '" . $txtSixthBox . "', '" . $txtSeventBox . "', '" . $myIdentity . "', '" . $txtCompanyId . "' ) ");
                if ($insert_employees_data_queryIns) {
                    $insert_employees_docs_queryIns = mysqli_query($conn, "INSERT INTO tbl_team_documents (col_Id_image, col_drivers_licence_image, col_bank_statement_image, col_utility_bill_image, col_references_image, col_dbs_records_image, uryyTteamoeSS4, col_company_Id) 
                    VALUES('" . $txtfirstDocs . "', '" . $txtSecondDocs . "', '" . $txtThirdDocs . "', '" . $txtFourthDocs . "', '" . $txtFiftDocs . "', '" . $txtSixthDocs . "', '" . $myIdentity . "', '" . $txtCompanyId . "' ) ");
                    if ($insert_employees_docs_queryIns) {
                        header("Location: ./team-list?team_view=$txtCompanyCity");
                    }
                }
            }
        } else {
            //If the current team social id is not already in the database, then add new client without adding one integer to the current id.
            $queryIns = mysqli_query($conn, "INSERT INTO tbl_general_team_form (team_title, team_first_name, team_last_name, team_middle_name, team_preferred_name, team_email_address, team_referred_to, team_date_of_birth, team_nationality, team_primary_phone, team_culture_religion, team_sexuality, team_dbs, team_nin, team_address_line_1, team_address_line_2, team_city, team_county, team_poster_code, team_country, uryyTteamoeSS4, transportation, employment_type, col_company_city, col_start_date, col_company_Id, col_team_resource, col_pay_rate)
            VALUES('" . $txtTitle . "', '" . $txtFirstName . "', '" . $txtLastName . "', '" . $txtMiddleName . "', '" . $txtPreferredName . "', '" . $txtEmailAddress . "', '" . $txtGenderBased . "', '" . $txtDateofBirth . "', '" . $txtNationality . "', '" . $txtPrimaryPhoneNumber . "', '" . $txtCultureReligion . "', '" . $txtSexuality . "', '" . $txtDBS . "', '" . $txtNIN . "', '" . $txtAddressLine1 . "', '" . $txtAddressLine2 . "', '" . $txtCity . "', '" . $txtCounty . "', '" . $txtPosterCode . "', '" . $txtCountry . "', '" . $myIdentity001 . "', '" . $txtTransportMeans . "', '" . $txtEmploymentType . "', '" . $txtCompanyCity . "', '" . $txtStartDate . "', '" . $txtCompanyId . "', '"  . 'RS' . $txtTeamResource . "', '" . $txtTeamPayRate . "' ) ");
            if ($queryIns) {
                ////////////////////////Insert dom data into employee table////////////////////////////////////////
                $insert_employees_data_queryIns = mysqli_query($conn, "INSERT INTO tbl_team_employment (col_first_name, col_last_name, col_employee_no, col_team_role, col_contract_type, col_contract, col_weekly_contract_hour, col_covid_vacin, uryyTteamoeSS4, col_company_Id) 
                VALUES('" . $txtFirstName . "', '" . $txtLastName . "', '" . $txtSecondBox . "', '" . $txtThirdBox . "', '" . $txtFourthBox . "', '" . $txtFiftBox . "', '" . $txtSixthBox . "', '" . $txtSeventBox . "', '" . $myIdentity001 . "', '" . $txtCompanyId . "' ) ");
                if ($insert_employees_data_queryIns) {
                    $insert_employees_docs_queryIns = mysqli_query($conn, "INSERT INTO tbl_team_documents (col_Id_image, col_drivers_licence_image, col_bank_statement_image, col_utility_bill_image, col_references_image, col_dbs_records_image, uryyTteamoeSS4, col_company_Id) 
                    VALUES('" . $txtfirstDocs . "', '" . $txtSecondDocs . "', '" . $txtThirdDocs . "', '" . $txtFourthDocs . "', '" . $txtFiftDocs . "', '" . $txtSixthDocs . "', '" . $myIdentity001 . "', '" . $txtCompanyId . "' ) ");
                    if ($insert_employees_docs_queryIns) {
                        header("Location: ./team-list?team_view=$txtCompanyCity");
                    }
                }
            }
        }
    }
}
