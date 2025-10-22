<?php
include('client-header-contents.php');
$stmt = $conn->prepare("SELECT * FROM tbl_general_client_form WHERE uryyToeSS4 = ? 
AND col_company_Id = ? ORDER BY userId DESC LIMIT 1");
$stmt->bind_param("ss", $uryyToeSS4, $_SESSION['usr_compId']);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$clientName = $row['client_first_name'] . ' ' . $row['client_last_name'] ?? null;
$stmt->close();
$uryyToeSS4 = isset($_GET['uryyToeSS4']) ? $_GET['uryyToeSS4'] : '';
if (isset($_POST['btnSaveNoK'])) {
    $txtFirstName = trim($_POST['txtFirstName']);
    $txtLastName = trim($_POST['txtLastName']);
    $txtRelationship = trim($_POST['txtRelationship']);
    $txtPhonenumber = trim($_POST['txtPhonenumber']);
    $txtTypeofcontact = trim($_POST['txtTypeofcontact']);
    $txtEamilAddress = trim($_POST['txtEamilAddress']);
    $txtStatement = trim($_POST['txtStatement']);
    $txtClientId = trim($_POST['txtClientId']);
    $lpa_file = basename($_FILES['file']['name']);
    $target = "lpa_documents/" . $lpa_file;

    $stmt = $conn->prepare("
        INSERT INTO tbl_client_nok 
        (col_first_name, col_last_name, col_relationship, col_phone_number, col_type_ofContact, nok_emailaddress, col_client_statement, lpa_documents, uryyToeSS4, col_company_Id) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

    if ($stmt) {
        $stmt->bind_param(
            "ssssssssss",
            $txtFirstName,
            $txtLastName,
            $txtRelationship,
            $txtPhonenumber,
            $txtTypeofcontact,
            $txtEamilAddress,
            $txtStatement,
            $lpa_file,
            $txtClientId,
            $_SESSION['usr_compId']
        );

        if ($stmt->execute()) {

            if (!empty($lpa_file) && is_uploaded_file($_FILES['file']['tmp_name'])) {

                if (move_uploaded_file($_FILES['file']['tmp_name'], $target)) {
                    header("Location: ./next-of-kin?uryyToeSS4=" . urlencode($txtClientId));
                    exit;
                } else {
                    echo "File upload failed.";
                }
            } else {
                header("Location: ./next-of-kin?uryyToeSS4=" . urlencode($txtClientId));
                exit;
            }
        } else {
            echo "Error inserting record.";
        }
        $stmt->close();
    } else {
        echo "Database error.";
    }
}

if (!empty($uryyToeSS4)) {
    $stmt = $conn->prepare("SELECT * FROM tbl_general_client_form 
    WHERE uryyToeSS4 = ? ORDER BY userId DESC LIMIT 1");

    if ($stmt) {
        $stmt->bind_param("s", $uryyToeSS4);
        $stmt->execute();
        $result = $stmt->get_result();
        $trans = $result->fetch_assoc();
        $stmt->close();
    } else {
        echo "Database error.";
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

<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="page-header-title">
                            <h5 class="m-b-10"><?= $clientName; ?>
                                <p class="text-muted">View <?= $clientName; ?>'s medical details.</p>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div style="width: 100%; height:auto; text-align:right;">
                        <a href="./next-of-kin?<?php echo "uryyToeSS4=$uryyToeSS4"; ?>" style="text-decoration: none; color:#000;">
                            <button class="btn btn-info">View details</button>
                        </a>
                    </div>
                    <form action="./more-next-of-kin?uryyToeSS4=<?php echo $uryyToeSS4; ?>" method="post" enctype="multipart/form-data" autocomplete="off">
                        <div class="row">
                            <div class="col-lg-6 col-6">
                                <div class="form-group">
                                    <label for="First name">First name</label>
                                    <input type="text" class="form-control" placeholder="First name" required name="txtFirstName" />
                                </div>
                            </div>
                            <div class="col-lg-6 col-6">
                                <div class="form-group">
                                    <label for="Last name">Last name</label>
                                    <input type="text" class="form-control" placeholder="Last name" required name="txtLastName" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-6">
                                <div class="form-group">
                                    <label for="Relationship">Relationship</label>
                                    <select name="txtRelationship" required class="form-control" id="exampleFormControlSelect1">
                                        <option value="Null" selected="selected" disabled="disabled">--Select Option--</option>
                                        <option value="Family">Family</option>
                                        <option value="Wife">Wife</option>
                                        <option value="Husband">Husband</option>
                                        <option value="Child">Child</option>
                                        <option value="Son">Son</option>
                                        <option value="Daughter">Daughter</option>
                                        <option value="Sister">Sister</option>
                                        <option value="Brother">Brother</option>
                                        <option value="Father">Father</option>
                                        <option value="Mother">Mother</option>
                                        <option value="Uncle">Uncle</option>
                                        <option value="Auntie">Auntie</option>
                                        <option value="Relatives">Relatives</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-6">
                                <div class="form-group">
                                    <label for="Phone number">Phone number</label>
                                    <input type="text" class="form-control" placeholder="Phone number" required name="txtPhonenumber" />
                                </div>
                            </div>

                            <div class="col-lg-12 col-12">
                                <div class="form-group">
                                    <label for="Type of contact">Type of contact</label>
                                    <select name="txtTypeofcontact" required class="form-control" id="exampleFormControlSelect1">
                                        <option value="Null" selected="selected" disabled="disabled">--Select Option--</option>
                                        <option value="Emergency">Emergency</option>
                                        <option value="Friendly">Friendly</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12 col-12">
                                <div class="form-group">
                                    <label for="Type of contact">Email address</label>
                                    <input type="text" class="form-control" placeholder="Email address" name="txtEamilAddress" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="My need">Does the client or their appointee consent to discusing routine care matters with this key contact.</label>
                            <select name="txtStatement" required class="form-control" id="exampleFormControlSelect1">
                                <option value="Null" selected="selected" disabled="disabled">--Select Option--</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>

                        <input type="hidden" value="<?php echo "" . $trans['uryyToeSS4'] . ""; ?>" name="txtClientId" />
                        <div class="form-group">
                            <div class="btn btn-info" id="yourBtn" onclick="getFile()">Upload LPA Document</div>
                            <div style='height: 0px;width: 0px; overflow:hidden;'><input id="upfile" name="file" type="file" onchange="sub(this)" /></div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <input type="submit" value="Save details" class="btn btn-primary" name="btnSaveNoK" />
                        </div>
                    </form>
                </div>
                <div class="col-md-4"></div>
            </div>
            <br>
        </div>
    </div>





</div>
<!-- Latest Customers end -->
</div>
<!-- [ Main Content ] end -->
</div>
</div>


<?php include('footer-contents.php'); ?>