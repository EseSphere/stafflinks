<?php
if (isset($_POST['btnDeletePurchase'])) {

    include('dbconnections.php');

    $user_special_Id = mysqli_real_escape_string($conn, $_POST['purchaseSpecialId']);

    $sql = mysqli_query($conn, "DELETE FROM tbl_purchase_order WHERE col_special_Id = '" . $user_special_Id . "' ");

    if ($sql) {
        header('Location: ./purchase-orders');
    } else {
    }
}
