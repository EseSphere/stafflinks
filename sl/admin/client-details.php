<?php
include('client-header-contents.php');
$stmt = $conn->prepare("SELECT * FROM tbl_general_client_form 
WHERE uryyToeSS4 = ? AND col_company_Id = ?");
$stmt->bind_param("si", $uryyToeSS4, $_SESSION['usr_compId']);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_array();
$clientFullName = $row['client_first_name'] . ' ' . $row['client_last_name'];
$_SESSION['clientNames'] = $clientFullName;
$clientDOB = date('d M, Y', strtotime("" . $row['client_date_of_birth'] . ""));
$clientStartDate = date('d M, Y', strtotime("" . $row['clientStart_date'] . ""));
?>

<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="row">
            <section style="background-color: #eee; margin-bottom:50px;">
                <div class="container-fluid mt-3">
                    <div class="row">
                        <div class="col">
                            <nav aria-label="breadcrumb" class="bg-light rounded-3 p-6 mb-4">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item"><a href="#">User</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">User Profile</li>
                                </ol>
                                <div
                                    style="width: 100%; height:auto; padding:7px; text-align:right; background-color:none;">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a type="button"
                                            href="./about-me?<?php echo "uryyToeSS4=" . $row['uryyToeSS4'] . "" ?>"
                                            class="btn btn-outline-success btn-sm">About Me</a>
                                        <a type="button"
                                            href="./client-funding?<?php echo "uryyToeSS4=" . $row['uryyToeSS4'] . "" ?>"
                                            class="btn btn-outline-secondary btn-sm">Funding</a>
                                        <a type="button"
                                            href="./next-of-kin?<?php echo "uryyToeSS4=" . $row['uryyToeSS4'] . "" ?>"
                                            class="btn btn-outline-primary btn-sm">Next of kin</a>
                                        <a type="button"
                                            href="./medical-details?<?php echo "uryyToeSS4=" . $row['uryyToeSS4'] . "" ?>"
                                            class="btn btn-outline-danger btn-sm">Medical Details</a>
                                    </div>
                                </div>

                                <?php require_once('client-status-notice.php'); ?>
                            </nav>
                        </div>
                    </div>

                    <div class="row" style="font-size: 18px;">
                        <div class="col-lg-4">
                            <div class="card mb-4">
                                <div class="card-body text-center">
                                    <img src="assets/images/user/profile-icon.jpg" alt="avatar"
                                        class="rounded-circle img-fluid" style="width: 120px;">
                                    <h5 class="my-3">
                                        <?php echo "" . $row['client_first_name'] . "&nbsp;" . $row['client_last_name'] . "&nbsp;" . $row['client_middle_name'] . "" ?>
                                    </h5>
                                    <p style="font-size: 16px;" class="text-muted mb-1">
                                        <?php echo "" . $row['client_sexuality'] . " | " . $row['client_area'] . "," ?>
                                    </p>
                                    <p style="font-size: 16px;" class="text-muted mb-4">
                                        <?php echo "" . $row['client_city'] . ", " . $row['client_county'] . "" ?></p>
                                    <div class="d-flex justify-content-center mb-2">
                                        <a href="./client-status?uryyToeSS4=<?= $uryyToeSS4 ?>&u7ye=<?= $crackEncryptedbinary ?>"
                                            style="text-decoration: none;">
                                            <button type="button" class="btn btn-outline-secondary" data-toggle="modal"
                                                data-target="#exampleModal" data-whatever="@mdo"><i
                                                    class="fas fa-user"></i> Status</button>
                                        </a>
                                        &nbsp;&nbsp;
                                        <a href="./delete-client-details<?php echo "?uryyToeSS4=" . $row['uryyToeSS4'] . ""; ?>"
                                            style=" text-decoration: none;"></a>
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-4 mb-lg-0">
                                <div class="card-body p-0" style="font-size: 18px;">
                                    <h5 style="padding: 22px;">Care calls</h5>
                                    <a href="./setup-visits<?php echo "?uryyToeSS4=$uryyToeSS4"; ?>" class="btn btn-xs text-white text-decoration-none btn-info">Plan visits</a>
                                    <?php
                                    function fetchCareCalls($conn, $uryyToeSS4, $careCall, $compId, $limit = null)
                                    {
                                        $sql = "SELECT dateTime_in, dateTime_out, uryyToeSS4 FROM tbl_clienttime_calls 
                                        WHERE uryyToeSS4 = ? AND care_calls = ? AND col_company_Id = ?";
                                        if ($limit !== null) {
                                            $sql .= " ORDER BY userId DESC LIMIT ?";
                                        }

                                        if ($limit !== null) {
                                            $stmt = $conn->prepare($sql);
                                            $stmt->bind_param("sssi", $uryyToeSS4, $careCall, $compId, $limit);
                                        } else {
                                            $stmt = $conn->prepare($sql);
                                            $stmt->bind_param("sss", $uryyToeSS4, $careCall, $compId);
                                        }

                                        $stmt->execute();
                                        $result = $stmt->get_result();
                                        $calls = $result->fetch_all(MYSQLI_ASSOC);
                                        $stmt->close();
                                        return $calls;
                                    }

                                    $careCalls = [
                                        ['label' => 'Morning', 'care_calls' => 'Morning' ?: '<a href="morning-care-calls">Next</a>', 'url' => 'morning-care-calls', 'extra' => false],
                                        ['label' => 'Extra Morning', 'care_calls' => 'EM morning call' ?: '<a href="extra-care-call1-46657-587768-0059876">Next</a>', 'url' => 'extra-care-call1-46657-587768-0059876', 'extra' => true],
                                        ['label' => 'Lunch', 'care_calls' => 'Lunch' ?: '<a href="lunch-care-calls">Next</a>', 'url' => 'lunch-care-calls', 'extra' => false],
                                        ['label' => 'Extra Lunch', 'care_calls' => 'EL lunch call' ?: '<a href="extra-care-call2-46657-587768-0059876">Next</a>', 'url' => 'extra-care-call2-46657-587768-0059876', 'extra' => true, 'limit' => 1],
                                        ['label' => 'Tea', 'care_calls' => 'Tea' ?: '<a href="tea-care-calls">Next</a>', 'url' => 'tea-care-calls', 'extra' => false],
                                        ['label' => 'Extra Tea', 'care_calls' => 'ET tea call' ?: '<a href="extra-care-call3-46657-587768-0059876">Next</a>', 'url' => 'extra-care-call3-46657-587768-0059876', 'extra' => true, 'limit' => 1],
                                        ['label' => 'Bed', 'care_calls' => 'Bed' ?: '<a href="bed-care-calls">Next</a>', 'url' => 'bed-care-calls', 'extra' => false],
                                        ['label' => 'Extra Bed', 'care_calls' => 'EB bed call' ?: '<a href="extra-care-call4-46657-587768-0059876">Next</a>', 'url' => 'extra-care-call4-46657-587768-0059876', 'extra' => true, 'limit' => 1],
                                    ];
                                    ?>
                                    <div
                                        style="width: 100%; height:auto; margin-top:12px; padding:12px; border-top:2px solid rgba(39, 174, 96,1.0); ">
                                        <table class="table table-striped">
                                            <tr>
                                                <td style="font-size:15px; font-weight:600;">Care call</td>
                                                <td style="font-size:15px; font-weight:600;">Time</td>
                                                <td style="font-size:15px; font-weight:600;"><i class="feather icon-edit"></i> Extra call</td>
                                            </tr>
                                            <?php foreach ($careCalls as $call):
                                                $limit = $call['limit'] ?? null;
                                                $calls = fetchCareCalls($conn, $uryyToeSS4, $call['care_calls'], $_SESSION['usr_compId'], $limit);
                                            ?>
                                                <tr>
                                                    <td style="font-size:16px;"><?= htmlspecialchars($call['label']) ?></td>
                                                    <td>
                                                        <?php if (!empty($calls)): ?>
                                                            <?php foreach ($calls as $row): ?>
                                                                <a href="./<?= htmlspecialchars($call['url']) ?>?uryyToeSS4=<?= urlencode($row['uryyToeSS4']) ?>"
                                                                    style="text-decoration: none; color:#000;">
                                                                    <p style="font-size: 14px;" class="mb-0">
                                                                        <?= htmlspecialchars($row['dateTime_in']) ?> -
                                                                        <?= htmlspecialchars($row['dateTime_out']) ?>
                                                                    </p>
                                                                </a>
                                                            <?php endforeach; ?>
                                                        <?php else: ?>
                                                            <a href="./<?= htmlspecialchars($call['url']) ?>?uryyToeSS4=<?= urlencode($uryyToeSS4) ?>"
                                                                style="text-decoration: none; color:rgba(44, 62, 80,.4);">
                                                                <i class="feather icon-plus"></i> Add
                                                            </a>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td style="font-size:16px; font-weight:600;">
                                                        <?php if ($call['extra']): ?>
                                                            <a href="./<?= htmlspecialchars($call['url']) ?>?uryyToeSS4=<?= urlencode($uryyToeSS4) ?>"
                                                                style="text-decoration: none; color:rgba(44, 62, 80,.4);">
                                                                <i class="feather icon-plus"></i> Add
                                                            </a>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        $stmt = $conn->prepare("SELECT * FROM tbl_general_client_form 
                        WHERE uryyToeSS4 = ? AND col_company_Id = ?");
                        $stmt->bind_param("ss", $uryyToeSS4, $_SESSION['usr_compId']);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $row = $result->fetch_array();
                        $clientDOB = date('d M, Y', strtotime("" . $row['client_date_of_birth'] . ""));
                        $clientStartDate = date('d M, Y', strtotime("" . $row['clientStart_date'] . ""));
                        ?>
                        <div class="col-lg-8">
                            <div class="card mb-4">
                                <div style="width: 100%; height:auto; text-align:right;">
                                    <a href="./edit-client-details-220059-958847-488950<?php echo "?uryyToeSS4=$uryyToeSS4"; ?>" class="btn btn-sm text-white text-decoration-none btn-info"><i class="fas fa-edit"></i></button></a>
                                </div>
                                <div class="card-body" style="font-size: 16px;">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p style="font-size: 16px;" class="mb-0">Full Name</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p style="font-size: 16px;" class="text-muted mb-0">
                                                <?php echo "" . $row['client_title'] . " " . $row['client_first_name'] . " | <span>Prefered name: </span> " . $row['client_preferred_name'] . "" ?>
                                            </p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p style="font-size: 16px;" class="mb-0">Email</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p style="font-size: 16px;" class="text-muted mb-0">
                                                <?php echo "" . $row['client_email_address'] . "" ?></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p style="font-size: 16px;" class="mb-0">Phone</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p style="font-size: 16px;" class="text-muted mb-0">
                                                <?php echo "+44 " . $row['client_primary_phone'] . " &nbsp; | &nbsp; " . '+44 ' . $row['col_second_phone'] . "" ?>
                                            </p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p style="font-size: 16px;" class="mb-0">Date of birth</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p style="font-size: 16px;" class="text-muted mb-0"><?php echo $clientDOB ?>
                                                &nbsp; | &nbsp; <span style="">UI Number
                                                    <strong><?php echo "" . $row['col_swn_number'] . "" ?></strong></span>
                                            </p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p style="font-size: 16px;" class="mb-0">Address</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <a class="text-decoration-none" href="https://www.google.com/maps?q=<?php echo urlencode($row['client_address_line_1'] . ' ' . $row['client_address_line_2'] . ', ' . $row['client_city'] . ', ' . $row['client_county'] . ', ' . $row['client_poster_code']); ?>" target="_blank">
                                                <p style="font-size: 16px;" class="text-muted mb-0 text-decoration-none">
                                                    <?php echo $row['client_address_line_1'] . " " . $row['client_address_line_2'] . ", " . $row['client_city'] . ", " . $row['client_county'] . ", " . $row['client_poster_code']; ?>
                                                </p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card mb-4">
                                        <div style="width: 100%; height:auto; text-align:right;">
                                            <a href="./edit-client-details-220059-958847-4854550<?php echo "?uryyToeSS4=$uryyToeSS4"; ?>" class="btn btn-sm text-white text-decoration-none btn-info"><i class="fas fa-edit"></i></a>
                                        </div>
                                        <div class="card-body" style="font-size: 16px;">
                                            <div class="row">
                                                <div class="col-sm-5">
                                                    <p style="font-size: 16px;" class="mb-0">Referred to</p>
                                                </div>
                                                <div class="col-sm-7">
                                                    <p style="font-size: 16px;" class="text-muted mb-0">
                                                        <?php echo "" . $row['client_referred_to'] . "" ?></p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <p style="font-size: 16px;" class="mb-0">Medical condition</p>
                                                    <p style="font-size: 16px;" class="text-muted mb-0">
                                                        <?php echo "" . $row['client_ailment'] . "" ?></p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-5">
                                                    <p style="font-size: 16px;" class="mb-0">Religion</p>
                                                </div>
                                                <div class="col-sm-7">
                                                    <p style="font-size: 16px;" class="text-muted mb-0">
                                                        <?php echo "" . $row['client_culture_religion'] . "" ?></p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-5">
                                                    <p style="font-size: 16px;" class="mb-0">Gender</p>
                                                </div>
                                                <div class="col-sm-7">
                                                    <p style="font-size: 16px;" class="text-muted mb-0">
                                                        <?php echo "" . $row['client_sexuality'] . "" ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card mb-4">
                                        <div style="width: 100%; height:auto; text-align:right;">
                                            <a href="./edit-client-details-220059-958847-4854550<?php echo "?uryyToeSS4=$uryyToeSS4"; ?>" class="btn btn-sm text-white text-decoration-none btn-info"><i class="fas fa-edit"></i></a>
                                        </div>
                                        <div class="card-body" style="font-size: 16px;">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <p style="font-size: 16px;" class="mb-0">Key safe</p>
                                                    <p style="font-size: 16px;" class="text-muted mb-0">
                                                        <?php echo "" . $row['client_access_details'] . "" ?></p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class=" row">
                                                <div class="col-sm-5">
                                                    <p style="font-size: 16px;" class="mb-0">Start date</p>
                                                </div>
                                                <div class="col-sm-7">
                                                    <p style="font-size: 16px;" class="text-muted mb-0">
                                                        <?php echo $clientStartDate; ?></p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-5">
                                                    <p style="font-size: 16px;" class="mb-0">End date</p>
                                                </div>
                                                <div class="col-sm-7">
                                                    <p style="font-size: 16px;" class="text-muted mb-0">
                                                        <?php echo "" . $row['clientEnd_date'] . "" ?></p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-5">
                                                    <p style="font-size: 16px;" class="mb-0">Group</p>
                                                </div>
                                                <div class="col-sm-7">
                                                    <p style="font-size: 16px;" class="text-muted mb-0">
                                                        <?php echo "" . $row['client_area'] . ""; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>


<?php include('footer-contents.php'); ?>