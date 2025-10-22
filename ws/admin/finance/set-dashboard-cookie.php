
<?php
include_once('dbconnections.php');

if (isset($_POST['btnFetchPayDashData'])) {
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $txtPeriodStart = mysqli_real_escape_string($conn, $_REQUEST['txtPeriodStart']);
    $txtPeriodEnd = mysqli_real_escape_string($conn, $_REQUEST['txtPDPeriodEnd']);
    $txtCareGiver = mysqli_real_escape_string($conn, $_REQUEST['txtCareGiver']);
    $txtCompanyId = mysqli_real_escape_string($conn, $_REQUEST['txtCompanyId']);

    $cookie_startDate = '' . $txtPeriodStart;
    $cookie_endDate = '' . $txtPeriodEnd;
    $cookie_careGiver = '' . $txtCareGiver;
    $cookie_compId = '' . $txtCompanyId;

    $cookie_name = "StartDate";
    $cookie_value = "" . $cookie_startDate;
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

    $cookie_name = "EndDate";
    $cookie_value = "" . $cookie_endDate;
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

    $cookie_name = "CareGiver";
    $cookie_value = "" . $cookie_careGiver;
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

    $cookie_name = "CompanyId";
    $cookie_value = "" . $cookie_compId;
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

    header("Location: ./pay-dashboard-657464i-77rf6646-8ui4746");
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
} else if (isset($_POST['btnFetchConfirmVisitData'])) {
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $txtPeriodStart = mysqli_real_escape_string($conn, $_REQUEST['txtPeriodStart']);
    $txtPeriodEnd = mysqli_real_escape_string($conn, $_REQUEST['txtCVPeriodEnd']);
    $txtCareRecipient = mysqli_real_escape_string($conn, $_REQUEST['txtCareRecipient']);
    $txtCareGiver = mysqli_real_escape_string($conn, $_REQUEST['txtCareGiver']);
    $txtCompanyId = mysqli_real_escape_string($conn, $_REQUEST['txtCompanyId']);

    $cookie_startDate = '' . $txtPeriodStart;
    $cookie_endDate = '' . $txtPeriodEnd;
    $cookie_careGiver = '' . $txtCareGiver;
    $cookie_careRecipient = '' . $txtCareRecipient;
    $cookie_compId = '' . $txtCompanyId;

    $cookie_name = "StartDate";
    $cookie_value = "" . $cookie_startDate;
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

    $cookie_name = "EndDate";
    $cookie_value = "" . $cookie_endDate;
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

    $cookie_name = "CareGiver";
    $cookie_value = "" . $cookie_careGiver;
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

    $cookie_name = "CareRecipient";
    $cookie_value = "" . $cookie_careRecipient;
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

    $cookie_name = "CompanyId";
    $cookie_value = "" . $cookie_compId;
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

    header("Location: ./dashboard-009475-i93544-88847-11264");
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
} else if (isset($_POST['btnFetchPlannedVisitData'])) {
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $txtPeriodStart = mysqli_real_escape_string($conn, $_REQUEST['txtPeriodStart']);
    $txtPeriodEnd = mysqli_real_escape_string($conn, $_REQUEST['txtPeriodEnd']);
    $txtCareRecipient = mysqli_real_escape_string($conn, $_REQUEST['txtCareRecipient']);
    $txtCareGiver = mysqli_real_escape_string($conn, $_REQUEST['txtCareGiver']);
    $txtCompanyId = mysqli_real_escape_string($conn, $_REQUEST['txtCompanyId']);

    $cookie_startDate = '' . $txtPeriodStart;
    $cookie_endDate = '' . $txtPeriodEnd;
    $cookie_careGiver = '' . $txtCareGiver;
    $cookie_careRecipient = '' . $txtCareRecipient;
    $cookie_compId = '' . $txtCompanyId;

    $cookie_name = "StartDate";
    $cookie_value = "" . $cookie_startDate;
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

    $cookie_name = "EndDate";
    $cookie_value = "" . $cookie_endDate;
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

    $cookie_name = "CareGiver";
    $cookie_value = "" . $cookie_careGiver;
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

    $cookie_name = "CareRecipient";
    $cookie_value = "" . $cookie_careRecipient;
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

    $cookie_name = "CompanyId";
    $cookie_value = "" . $cookie_compId;
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

    echo "<script>
                window.history.go(-1);
            </script>";
    //header("Location: ./finance-planned-hour-775899-388364-0059578");
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
} else if (isset($_POST['btnFetchActualVisitData'])) {
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $txtPeriodStart = mysqli_real_escape_string($conn, $_REQUEST['txtPeriodStart']);
    $txtPeriodEnd = mysqli_real_escape_string($conn, $_REQUEST['txtPeriodEnd']);
    $txtCareRecipient = mysqli_real_escape_string($conn, $_REQUEST['txtCareRecipient']);
    $txtCareGiver = mysqli_real_escape_string($conn, $_REQUEST['txtCareGiver']);
    $txtCompanyId = mysqli_real_escape_string($conn, $_REQUEST['txtCompanyId']);

    $cookie_startDate = '' . $txtPeriodStart;
    $cookie_endDate = '' . $txtPeriodEnd;
    $cookie_careGiver = '' . $txtCareGiver;
    $cookie_careRecipient = '' . $txtCareRecipient;
    $cookie_compId = '' . $txtCompanyId;

    $cookie_name = "StartDate";
    $cookie_value = "" . $cookie_startDate;
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

    $cookie_name = "EndDate";
    $cookie_value = "" . $cookie_endDate;
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

    $cookie_name = "CareGiver";
    $cookie_value = "" . $cookie_careGiver;
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

    $cookie_name = "CareRecipient";
    $cookie_value = "" . $cookie_careRecipient;
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

    $cookie_name = "CompanyId";
    $cookie_value = "" . $cookie_compId;
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

    header("Location: ./finance-actual-hour-778477-994009-du4664799");
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
} else if (isset($_POST['btnFetchDiscardedInvoiceData'])) {
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $txtPeriodStart = mysqli_real_escape_string($conn, $_REQUEST['txtPeriodStart']);
    $txtPeriodEnd = mysqli_real_escape_string($conn, $_REQUEST['txtPeriodEnd']);
    $txtCareRecipient = mysqli_real_escape_string($conn, $_REQUEST['txtCareRecipient']);
    $txtCareGiver = mysqli_real_escape_string($conn, $_REQUEST['txtCareGiver']);
    $txtCompanyId = mysqli_real_escape_string($conn, $_REQUEST['txtCompanyId']);

    $cookie_startDate = '' . $txtPeriodStart;
    $cookie_endDate = '' . $txtPeriodEnd;
    $cookie_careGiver = '' . $txtCareGiver;
    $cookie_careRecipient = '' . $txtCareRecipient;
    $cookie_compId = '' . $txtCompanyId;

    $cookie_name = "StartDate";
    $cookie_value = "" . $cookie_startDate;
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

    $cookie_name = "EndDate";
    $cookie_value = "" . $cookie_endDate;
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

    $cookie_name = "CareGiver";
    $cookie_value = "" . $cookie_careGiver;
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

    $cookie_name = "CareRecipient";
    $cookie_value = "" . $cookie_careRecipient;
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

    $cookie_name = "CompanyId";
    $cookie_value = "" . $cookie_compId;
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

    header("Location: ./discarded-invoicing");
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
} else if (isset($_POST['btnFetchDiscardedPayrollData'])) {
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $txtPeriodStart = mysqli_real_escape_string($conn, $_REQUEST['txtPeriodStart']);
    $txtPeriodEnd = mysqli_real_escape_string($conn, $_REQUEST['txtPeriodEnd']);
    $txtCareRecipient = mysqli_real_escape_string($conn, $_REQUEST['txtCareRecipient']);
    $txtCareGiver = mysqli_real_escape_string($conn, $_REQUEST['txtCareGiver']);
    $txtCompanyId = mysqli_real_escape_string($conn, $_REQUEST['txtCompanyId']);

    $cookie_startDate = '' . $txtPeriodStart;
    $cookie_endDate = '' . $txtPeriodEnd;
    $cookie_careGiver = '' . $txtCareGiver;
    $cookie_careRecipient = '' . $txtCareRecipient;
    $cookie_compId = '' . $txtCompanyId;

    $cookie_name = "StartDate";
    $cookie_value = "" . $cookie_startDate;
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

    $cookie_name = "EndDate";
    $cookie_value = "" . $cookie_endDate;
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

    $cookie_name = "CareGiver";
    $cookie_value = "" . $cookie_careGiver;
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

    $cookie_name = "CareRecipient";
    $cookie_value = "" . $cookie_careRecipient;
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

    $cookie_name = "CompanyId";
    $cookie_value = "" . $cookie_compId;
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

    header("Location: ./discarded-payroll");
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
} else if (isset($_POST['btnFetchInvoiceData'])) {
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $txtPeriodStart = mysqli_real_escape_string($conn, $_REQUEST['txtPeriodStart']);
    $txtPeriodEnd = mysqli_real_escape_string($conn, $_REQUEST['txtIDPeriodEnd']);
    $txtClientContract = mysqli_real_escape_string($conn, $_REQUEST['txtClientContract']);
    $txtCareRecipient = mysqli_real_escape_string($conn, $_REQUEST['txtCareRecipient']);
    $txtCompanyId = mysqli_real_escape_string($conn, $_REQUEST['txtCompanyId']);

    $cookie_startDate = '' . $txtPeriodStart;
    $cookie_endDate = '' . $txtPeriodEnd;
    $cookie_contract = '' . $txtClientContract;
    $cookie_careRecipient = '' . $txtCareRecipient;
    $cookie_compId = '' . $txtCompanyId;

    $cookie_name = "StartDate";
    $cookie_value = "" . $cookie_startDate;
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

    $cookie_name = "EndDate";
    $cookie_value = "" . $cookie_endDate;
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

    $cookie_name = "CareRecipient";
    $cookie_value = "" . $cookie_careRecipient;
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

    $cookie_name = "Contract";
    $cookie_value = "" . $cookie_contract;
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

    $cookie_name = "CompanyId";
    $cookie_value = "" . $cookie_compId;
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

    header("Location: ./invoice-dashboard-455365-7748665-ik664gh");
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
} else if (isset($_POST['txtCVPeriodEnd'])) {
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $txtPeriodStart = mysqli_real_escape_string($conn, $_REQUEST['txtPeriodStart']);
    $txtPeriodEnd = mysqli_real_escape_string($conn, $_REQUEST['txtCVPeriodEnd']);

    $cookie_startDate = '' . $txtPeriodStart;
    $cookie_endDate = '' . $txtPeriodEnd;

    $cookie_name = "StartDate";
    $cookie_value = "" . $cookie_startDate;
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

    $cookie_name = "EndDate";
    $cookie_value = "" . $cookie_endDate;
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

    header("Location: ./dashboard-009475-i93544-88847-11264");
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
} else if (isset($_POST['txtPDPeriodEnd'])) {
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $txtPeriodStart = mysqli_real_escape_string($conn, $_REQUEST['txtPeriodStart']);
    $txtPeriodEnd = mysqli_real_escape_string($conn, $_REQUEST['txtPDPeriodEnd']);

    $cookie_startDate = '' . $txtPeriodStart;
    $cookie_endDate = '' . $txtPeriodEnd;

    $cookie_name = "StartDate";
    $cookie_value = "" . $cookie_startDate;
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

    $cookie_name = "EndDate";
    $cookie_value = "" . $cookie_endDate;
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

    header("Location: ./pay-dashboard-657464i-77rf6646-8ui4746");
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
} else if (isset($_POST['txtIDPeriodEnd'])) {
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $txtPeriodStart = mysqli_real_escape_string($conn, $_REQUEST['txtPeriodStart']);
    $txtPeriodEnd = mysqli_real_escape_string($conn, $_REQUEST['txtIDPeriodEnd']);

    $cookie_startDate = '' . $txtPeriodStart;
    $cookie_endDate = '' . $txtPeriodEnd;

    $cookie_name = "StartDate";
    $cookie_value = "" . $cookie_startDate;
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

    $cookie_name = "EndDate";
    $cookie_value = "" . $cookie_endDate;
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

    header("Location: ./invoice-dashboard-455365-7748665-ik664gh");
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
} else {
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $cookie_startDate = '' . $first_day_this_month;
    $cookie_endDate = '' . $last_day_this_month;
    $cookie_careGiver = '' . $txtAllCarer;
    $cookie_careRecipient = '' . $txtCarerRecipient;
    $cookie_compId = '' . $companyId;
    $cookie_contract = '' . $txtContract;

    $cookie_name = "StartDate";
    $cookie_value = "" . $cookie_startDate;
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

    $cookie_name = "EndDate";
    $cookie_value = "" . $cookie_endDate;
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

    $cookie_name = "CareGiver";
    $cookie_value = "" . $cookie_careGiver;
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

    $cookie_name = "CareRecipient";
    $cookie_value = "" . $cookie_careRecipient;
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

    $cookie_name = "Contract";
    $cookie_value = "" . $cookie_contract;
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

    $cookie_name = "CompanyId";
    $cookie_value = "" . $cookie_compId;
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

    //echo "Start date '" . $cookie_startDate . "' is set!<br>";
    //echo "End date '" . $cookie_endDate . "' is set!<br>";
    //echo "Care giver '" . $cookie_careGiver . "' is set!<br>";
    //echo "Company Id '" . $cookie_compId . "' is set!<br>";

    header("Location: ./pay-rates");
}
