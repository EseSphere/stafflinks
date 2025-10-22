<?php
include('client-header-contents.php');
$stmt = $conn->prepare("SELECT * FROM tbl_general_client_form 
WHERE uryyToeSS4 = ?");
$stmt->bind_param("s", $uryyToeSS4);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$clientName = trim(($row['client_first_name'] ?? '') . ' ' . ($row['client_last_name'] ?? ''));
$_SESSION['clientId'] = $row['uryyToeSS4'] ?? '';
$varCompanyId = $row['col_company_Id'] ?? '';
?>

<style>
    .stars {
        display: inline-flex;
        flex-direction: row-reverse;
        justify-content: center;
    }

    .stars input {
        display: none;
    }

    .stars label {
        font-size: 2em;
        color: #ccc;
        cursor: pointer;
        transition: color 0.2s;
    }

    .stars input:checked~label,
    .stars label:hover,
    .stars label:hover~label {
        color: gold;
    }

    .message {
        margin-top: 15px;
        font-weight: bold;
    }

    #textArea {
        width: 100%;
        height: 100px;
        margin-top: 10px;
        padding: 10px;
        border-radius: 5px;
        resize: none;
        border: 1px solid #ccc;
    }
</style>
<link rel="stylesheet" type="text/css" href="./css/daily_visits.css" />
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="container-fluid">
            <h5>Rate us</h5>
            <div class="page-header-title">
                Take a moment to rate us
            </div>
            <hr class="mb-3">
            <div class="row ">
                <div style=" border-radius: 8px; box-shadow: rgba(17, 12, 46, 0.15) 0px 48px 100px 0px; "
                    class=" col-md-3">
                    <div id="visitsBox" class="mt-4">
                        <h5 id="dayTitle"></h5>
                        <div class="message" style="text-align: center; color:#16a085;" id="message"></div>
                        <form id="rateForm">
                            <div class="stars">
                                <input type="radio" name="stars" id="star5" value="5" required>
                                <label for="star5">&#9733;</label>

                                <input type="radio" name="stars" id="star4" value="4">
                                <label for="star4">&#9733;</label>

                                <input type="radio" name="stars" id="star3" value="3">
                                <label for="star3">&#9733;</label>

                                <input type="radio" name="stars" id="star2" value="2">
                                <label for="star2">&#9733;</label>

                                <input type="radio" name="stars" id="star1" value="1">
                                <label for="star1">&#9733;</label>
                            </div>
                            <div>
                                <input type="text" class="form-control mb-2" id="clientName" name="clientName"
                                    value="<?php echo htmlspecialchars($clientName); ?>" readonly>
                            </div>
                            <div>
                                <textarea class="form-control mb-2" id="textArea" name="feedback"
                                    placeholder="Leave your feedback here..." required></textarea>
                                <input hidden name="clientId"
                                    value="<?php echo htmlspecialchars($_SESSION['clientId']); ?>">
                                <input hidden name="companyId" value="<?php echo htmlspecialchars($varCompanyId); ?>">
                            </div>
                            <div class="mb-3 mt-1">
                                <button onclick="location.reload()" class="btn btn-danger block"
                                    type="button">Reset</button>
                                <button class="btn btn-info block" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-5 mt-3">
                    Thank you for choosing our services. We are committed to providing you with reliable, high-quality
                    service and ensuring your satisfaction every step of the way. Your trust and support mean the world
                    to us.
                    <br><br>
                    If you are happy with the services we’ve provided, we would greatly appreciate it if you could take
                    a moment to rate us. Your feedback not only motivates our team but also helps others make informed
                    decisions about choosing us.
                    <br><br>
                    We are always looking for ways to improve. If you have any suggestions or concerns, please don’t
                    hesitate to share them. Your input helps us grow and ensures we continue to meet your expectations.
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('rateForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(this);

        fetch('submit-rating.php', {
                method: 'POST',
                body: formData
            })
            .then(res => res.text())
            .then(data => {
                document.getElementById('message').innerText = data;
                document.getElementById('rateForm').reset();
            })
            .catch(err => {
                document.getElementById('message').innerText = 'Something went wrong.';
            });
    });
</script>

<?php include('footer-contents.php'); ?>