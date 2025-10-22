<?php
include('client-header-contents.php');
if (isset($_GET['userId'])) {
    $userId = $_GET['userId'];
}
$uryyToeSS4 = $_SESSION['nav_session'];
if (isset($_POST['btnUpdateClientInfo'])) {
    $txtSecondBox = mysqli_real_escape_string($conn, $_POST['txtSecondBox']);
    $txtThirdBox = mysqli_real_escape_string($conn, $_POST['txtThirdBox']);
    $txtFourthBox = mysqli_real_escape_string($conn, $_POST['txtFourthBox']);
    $txtFifthBox = mysqli_real_escape_string($conn, $_POST['txtFifthBox']);
    $txtSixthBox = mysqli_real_escape_string($conn, $_POST['txtSixthBox']);
    $txtSeventhBox = mysqli_real_escape_string($conn, $_POST['txtSeventhBox']);
    $txtEighthBox = mysqli_real_escape_string($conn, $_POST['txtEighthBox']);
    $txtNinthBox = mysqli_real_escape_string($conn, $_POST['txtNinthBox']);
    $txtRowDataId = mysqli_real_escape_string($conn, $_POST['txtRowDataId']);
    $txtcompanyClientId = mysqli_real_escape_string($conn, $_POST['txtcompanyClientId']);
    $txtCompanyId = mysqli_real_escape_string($conn, $_POST['txtCompanyId']);

    $query = "UPDATE tbl_client_nok SET col_first_name = '$txtSecondBox', col_last_name = '$txtThirdBox', 
    col_relationship = '$txtFourthBox', col_phone_number = '$txtFifthBox', col_type_ofContact = '$txtSixthBox', 
    nok_emailaddress = '$txtSeventhBox', col_client_statement = '$txtEighthBox', lpa_documents = '$txtNinthBox' 
    WHERE userId = '$txtRowDataId' AND col_company_Id = '$txtCompanyId'";

    $updateResult = mysqli_query($conn, $query);
    if ($updateResult) {
        header("Location: ./next-of-kin?uryyToeSS4=$txtcompanyClientId");
        exit();
    } else {
        header("Location: ./next-of-kin?uryyToeSS4=$txtcompanyClientId");
        exit();
    }
}
?>

<style>
    ul {
        list-style: none;
    }

    .list {
        width: 100%;
        background-color: #ffffff;
        border-radius: 0 0 5px 5px;
    }

    .list-items {
        padding: 10px 5px;
    }

    .list-items:hover {
        background-color: #dddddd;
    }
</style>

<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Edit next of kin</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div style="width: 100%; height:auto; text-align:right;">
                        <a href="./next-of-kin?<?php echo "uryyToeSS4=$uryyToeSS4"; ?>" style="text-decoration: none; color:#000;">
                            <button class="btn btn-info">View details</button>
                        </a>
                    </div>
                    <?php
                    // Use prepared statement for secure SQL query
                    $stmt = $conn->prepare("SELECT * FROM tbl_client_nok 
                    WHERE userId = ? AND col_company_Id = ?");
                    $stmt->bind_param("is", $userId, $_SESSION['usr_compId']);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $get_team_row = $result->fetch_assoc();
                    ?>

                    <form action="./edit-next-of-kin?uryyToeSS4=<?php echo urlencode($uryyToeSS4); ?>" method="post" enctype="multipart/form-data" autocomplete="off">
                        <input type="hidden" name="txtCompanyId" value="<?php echo htmlspecialchars($_SESSION['usr_compId']); ?>" />
                        <input type="hidden" name="txtcompanyClientId" value="<?php echo htmlspecialchars($uryyToeSS4); ?>" />
                        <div class="row">
                            <div class="col-lg-6 col-6">
                                <div class="form-group">
                                    <label for="first_name">First name</label>
                                    <input type="text" class="form-control" name="txtSecondBox" value="<?php echo htmlspecialchars($get_team_row['col_first_name']); ?>" />
                                </div>
                            </div>
                            <div class="col-lg-6 col-6">
                                <div class="form-group">
                                    <label for="last_name">Last name</label>
                                    <input type="text" class="form-control" name="txtThirdBox" value="<?php echo htmlspecialchars($get_team_row['col_last_name']); ?>" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="relationship">Relationship</label>
                                    <input type="text" class="form-control" name="txtFourthBox" value="<?php echo htmlspecialchars($get_team_row['col_relationship']); ?>" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="phone_number">Phone number</label>
                                    <input type="tel" class="form-control" name="txtFifthBox" value="<?php echo htmlspecialchars($get_team_row['col_phone_number']); ?>" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="type_of_contact">Type of contact</label>
                                    <input type="text" class="form-control" name="txtSixthBox" value="<?php echo htmlspecialchars($get_team_row['col_type_ofContact']); ?>" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="txtSeventhBox" value="<?php echo htmlspecialchars($get_team_row['nok_emailaddress']); ?>" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="statement">Statement</label>
                                    <input type="text" class="form-control" name="txtEighthBox" value="<?php echo htmlspecialchars($get_team_row['col_client_statement']); ?>" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="lpa_document">LPA Document</label>
                                    <input type="number" class="form-control" name="txtNinethBox" value="<?php echo htmlspecialchars($get_team_row['lpa_documents']); ?>" />
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="txtRowDataId" value="<?php echo htmlspecialchars($get_team_row['userId']); ?>" />

                        <div class="row">
                            <div class="form-group">
                                <input type="submit" name="btnUpdateClientInfo" class="btn btn-primary" value="Update details" style="height: 45px;" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
        <br>
    </div>
</div>


</div>
</div>
</div>
</div>


<?php include('footer-contents.php'); ?>