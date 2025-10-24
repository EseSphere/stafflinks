<?php
if (isset($_POST['btnSubmitClient'])) {
    $txtTitle = mysqli_real_escape_string($conn, trim($_REQUEST['txtTitle']));
    $txtFirstName = mysqli_real_escape_string($conn, trim($_REQUEST['txtFirstName']));
    $txtLastName = mysqli_real_escape_string($conn, trim($_REQUEST['txtLastName']));
    $txtMiddleName = mysqli_real_escape_string($conn, trim($_REQUEST['txtMiddleName']));
    $txtPreferredName = mysqli_real_escape_string($conn, trim($_REQUEST['txtPreferredName']));
    $txtEmailAddress = mysqli_real_escape_string($conn, trim($_REQUEST['txtEmailAddress']));
    $txtGenderBased = mysqli_real_escape_string($conn, trim($_REQUEST['txtGenderBased']));
    $txtDateofBirth = mysqli_real_escape_string($conn, trim($_REQUEST['txtDateofBirth']));
    $txtClientailment = mysqli_real_escape_string($conn, $_REQUEST['txtClientailment']);
    $txtPrimaryPhoneNumber = mysqli_real_escape_string($conn, $_REQUEST['txtPrimaryPhoneNumber']);
    $txtCultureReligion = mysqli_real_escape_string($conn, $_REQUEST['txtCultureReligion']);
    $txtSexuality = mysqli_real_escape_string($conn, $_REQUEST['txtSexuality']);
    $txtclientArea = mysqli_real_escape_string($conn, $_REQUEST['txtclientArea']);
    $txtCareServices = mysqli_real_escape_string($conn, $_REQUEST['txtCareServices']);
    $txtSupportCare = 'Support Care';
    $txtAddressLine1 = mysqli_real_escape_string($conn, $_REQUEST['txtAddressLine1']);
    $txtAddressLine2 = mysqli_real_escape_string($conn, $_REQUEST['txtAddressLine2']);
    $txtCity = mysqli_real_escape_string($conn, $_REQUEST['txtCity']);
    $txtCounty = mysqli_real_escape_string($conn, $_REQUEST['txtCounty']);
    $txtPostalCode = mysqli_real_escape_string($conn, $_REQUEST['txtPostalCode']);
    $txtCountry = mysqli_real_escape_string($conn, $_REQUEST['txtCountry']);
    $txtAccessDetails = mysqli_real_escape_string($conn, $_REQUEST['txtAccessDetails']);
    $txtHighlights = mysqli_real_escape_string($conn, $_REQUEST['txtHighlights']);
    $txtOfficeIncharge = mysqli_real_escape_string($conn, $_REQUEST['txtOfficeIncharge']);
    $mysocialId = mysqli_real_escape_string($conn, $_REQUEST['mysocialId']);
    $txtStartDate = mysqli_real_escape_string($conn, $_REQUEST['txtStartDate']);
    $txtEndDate = mysqli_real_escape_string($conn, $_REQUEST['txtEndDate']);
    $txtCompanyId = mysqli_real_escape_string($conn, $_REQUEST['txtCompanyId']);

    $GOOGLE_API_KEY = 'AIzaSyBTWuN9VC9BLvvy2dLJTSlW_AijYf5DIN4';
    $address = $txtAddressLine1 . ', ' . $txtAddressLine2 . ', ' . $txtCity;
    $formatted_address = str_replace(' ', '+', $address);
    $geocodeFromAddr = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address={$formatted_address}&key={$GOOGLE_API_KEY}");
    $apiResponse = json_decode($geocodeFromAddr);
    $latitude = $apiResponse->results[0]->geometry->location->lat;
    $longitude = $apiResponse->results[0]->geometry->location->lng;

    $myIdentity001 = hash('sha256', $mysocialId);

    $lcientCareCallsMorn = "Morning";
    $lcientCareCallsLunch = "Lunch";
    $lcientCareCallsTea = "Tea";
    $lcientCareCallsBed = "Bed";
    $supportWorker = "Support-work";
    $clientDateTimeIn = "Null";
    $clientDateTimeOut = "Null";
    $today = date('Y-m-d');

    $myCheck = "SELECT * FROM tbl_general_client_form WHERE client_first_name = '$txtFirstName' 
    AND client_last_name = '$txtLastName' AND client_poster_code = '$txtPostalCode' AND col_company_Id = '$txtCompanyId'";
    $myCheckres = mysqli_query($conn, $myCheck);
    if (mysqli_num_rows($myCheckres) != 0) {
        echo "<script>$(document).ready(function(){ $('#popupAlert').show(); });</script>";
    } else {
        $sql_get_client_Id = mysqli_query($conn, "SELECT uryyToeSS4 FROM tbl_general_client_form ORDER BY userId DESC LIMIT 1");
        $row_get_client_Id = mysqli_fetch_array($sql_get_client_Id);
        $myIdentity = $row_get_client_Id ? $row_get_client_Id['uryyToeSS4'] + 1 : 1023;

        $insertClient = "INSERT INTO tbl_general_client_form 
            (client_title, client_first_name, client_last_name, client_middle_name, client_preferred_name, client_email_address, client_referred_to, client_date_of_birth, client_ailment, client_primary_phone, client_culture_religion, client_sexuality, client_area, client_address_line_1, client_address_line_2, client_city, client_county, client_poster_code, client_country, client_access_details, client_highlights, col_Office_Incharge, clientStart_date, clientEnd_date, uryyToeSS4, client_latitude, client_longitude, col_company_Id) 
            VALUES 
            ('$txtTitle','$txtFirstName','$txtLastName','$txtMiddleName','$txtPreferredName','$txtEmailAddress','$txtGenderBased','$txtDateofBirth','$txtClientailment','$txtPrimaryPhoneNumber','$txtCultureReligion','$txtSexuality','$txtclientArea','$txtAddressLine1','$txtAddressLine2','$txtCity','$txtCounty','$txtPostalCode','$txtCountry','$txtAccessDetails','$txtHighlights','$txtOfficeIncharge','$txtStartDate','$txtEndDate','$myIdentity','$latitude','$longitude','$txtCompanyId')";

        if (mysqli_query($conn, $insertClient)) {
            $service = $txtCareServices ?: $txtSupportCare;
            mysqli_query($conn, "UPDATE tbl_general_client_form SET client_service='$service' WHERE uryyToeSS4='$myIdentity'");

            if ($txtCareServices) {
                $careCalls = [$lcientCareCallsMorn, $lcientCareCallsLunch, $lcientCareCallsTea, $lcientCareCallsBed];
                foreach ($careCalls as $call) {
                    mysqli_query($conn, "INSERT INTO tbl_clienttime_calls (client_name, client_area, client_city, uryyToeSS4, care_calls, dateTime_in, dateTime_out, col_occurence, col_period_two, col_right_to_display, col_company_Id) VALUES ('$txtFirstName $txtLastName','$txtclientArea','$txtOfficeIncharge','$myIdentity','$call','$clientDateTimeIn','$clientDateTimeOut','$today','Daily','True','$txtCompanyId')");
                }
            } else {
                mysqli_query($conn, "INSERT INTO tbl_clienttime_calls (client_name, client_area, uryyToeSS4, care_calls, dateTime_in, dateTime_out, col_company_Id) VALUES ('$txtFirstName $txtLastName','$txtclientArea','$myIdentity','$supportWorker','$clientDateTimeIn','$clientDateTimeOut','$txtCompanyId')");
            }

            mysqli_query($conn, "INSERT INTO tbl_client_notes (uryyToeSS4, client_note, col_company_Id) VALUES ('$myIdentity','Upload client latest update.','$txtCompanyId')");
            header("Location: ./client-task?uryyToeSS4=$myIdentity");
            exit;
        } else {
            echo "ERROR: Could not execute query. " . mysqli_error($conn);
        }
    }
}
