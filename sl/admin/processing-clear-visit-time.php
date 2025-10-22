<?php
include('dbconnections.php');
if (isset($_POST['btnClear'])) {

    $txtClientId = mysqli_real_escape_string($conn, $_POST['txtClientId']);
    $txtClearVisitTime = mysqli_real_escape_string($conn, $_POST['txtClearVisitTime']);

    if ($txtClearVisitTime == 'Morning-call') {
        $sql = "UPDATE tbl_clienttime_calls SET dateTime_in = 'Null', dateTime_out = 'Null' 
        WHERE (uryyToeSS4='$txtClientId' AND care_calls = 'Morning')";
        if ($conn->query($sql) === TRUE) {
            $sqlDelManRun = "DELETE FROM tbl_manage_runs WHERE (uryyToeSS4='$txtClientId' AND care_calls = 'Morning')";
            if ($conn->query($sqlDelManRun) === TRUE) {
                $sqlDelScheldRun = "DELETE FROM tbl_schedule_calls WHERE (uryyToeSS4='$txtClientId' AND care_calls = 'Morning')";
                if ($conn->query($sqlDelScheldRun) === TRUE) {
                    header("Location: ./client-details?uryyToeSS4=$txtClientId");
                } else {
                    echo "Error deleting record: " . $conn->error;
                }
            } else {
                echo "Error deleting record: " . $conn->error;
            }
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else if ($txtClearVisitTime == 'Lunch-call') {
        $sql = "UPDATE tbl_clienttime_calls SET dateTime_in = 'Null', dateTime_out = 'Null' 
        WHERE (uryyToeSS4='$txtClientId' AND care_calls = 'Lunch')";
        if ($conn->query($sql) === TRUE) {
            $sqlDelManRun = "DELETE FROM tbl_manage_runs WHERE (uryyToeSS4='$txtClientId' AND care_calls = 'Lunch')";
            if ($conn->query($sqlDelManRun) === TRUE) {
                $sqlDelScheldRun = "DELETE FROM tbl_schedule_calls WHERE (uryyToeSS4='$txtClientId' AND care_calls = 'Lunch')";
                if ($conn->query($sqlDelScheldRun) === TRUE) {
                    header("Location: ./client-details?uryyToeSS4=$txtClientId");
                } else {
                    echo "Error deleting record: " . $conn->error;
                }
            } else {
                echo "Error deleting record: " . $conn->error;
            }
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else if ($txtClearVisitTime == 'Tea-call') {
        $sql = "UPDATE tbl_clienttime_calls SET dateTime_in = 'Null', dateTime_out = 'Null' 
        WHERE (uryyToeSS4='$txtClientId' AND care_calls = 'Tea')";
        if ($conn->query($sql) === TRUE) {
            $sqlDelManRun = "DELETE FROM tbl_manage_runs WHERE (uryyToeSS4='$txtClientId' AND care_calls = 'Tea')";
            if ($conn->query($sqlDelManRun) === TRUE) {
                $sqlDelScheldRun = "DELETE FROM tbl_schedule_calls WHERE (uryyToeSS4='$txtClientId' AND care_calls = 'Tea')";
                if ($conn->query($sqlDelScheldRun) === TRUE) {
                    header("Location: ./client-details?uryyToeSS4=$txtClientId");
                } else {
                    echo "Error deleting record: " . $conn->error;
                }
            } else {
                echo "Error deleting record: " . $conn->error;
            }
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else if ($txtClearVisitTime == 'Bed-call') {
        $sql = "UPDATE tbl_clienttime_calls SET dateTime_in = 'Null', dateTime_out = 'Null' 
        WHERE (uryyToeSS4='$txtClientId' AND care_calls = 'Bed')";
        if ($conn->query($sql) === TRUE) {
            $sqlDelManRun = "DELETE FROM tbl_manage_runs WHERE (uryyToeSS4='$txtClientId' AND care_calls = 'Bed')";
            if ($conn->query($sqlDelManRun) === TRUE) {
                $sqlDelScheldRun = "DELETE FROM tbl_schedule_calls WHERE (uryyToeSS4='$txtClientId' AND care_calls = 'Bed')";
                if ($conn->query($sqlDelScheldRun) === TRUE) {
                    header("Location: ./client-details?uryyToeSS4=$txtClientId");
                } else {
                    echo "Error deleting record: " . $conn->error;
                }
            } else {
                echo "Error deleting record: " . $conn->error;
            }
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else if ($txtClearVisitTime == 'Extra-Morning-call') {
        $sql = "UPDATE tbl_clienttime_calls SET dateTime_in = '', dateTime_out = '' 
        WHERE (uryyToeSS4='$txtClientId' AND care_calls = 'EM morning call')";
        if ($conn->query($sql) === TRUE) {
            $sqlDelManRun = "DELETE FROM tbl_manage_runs WHERE (uryyToeSS4='$txtClientId' AND care_calls = 'EM morning call')";
            if ($conn->query($sqlDelManRun) === TRUE) {
                $sqlDelScheldRun = "DELETE FROM tbl_schedule_calls WHERE (uryyToeSS4='$txtClientId' AND care_calls = 'EM morning call')";
                if ($conn->query($sqlDelScheldRun) === TRUE) {
                    header("Location: ./client-details?uryyToeSS4=$txtClientId");
                } else {
                    echo "Error deleting record: " . $conn->error;
                }
            } else {
                echo "Error deleting record: " . $conn->error;
            }
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else if ($txtClearVisitTime == 'Extra-Lunch-call') {
        $sql = "UPDATE tbl_clienttime_calls SET dateTime_in = '', dateTime_out = '' 
        WHERE (uryyToeSS4='$txtClientId' AND care_calls = 'EL lunch call')";
        if ($conn->query($sql) === TRUE) {
            $sqlDelManRun = "DELETE FROM tbl_manage_runs WHERE (uryyToeSS4='$txtClientId' AND care_calls = 'EL lunch call')";
            if ($conn->query($sqlDelManRun) === TRUE) {
                $sqlDelScheldRun = "DELETE FROM tbl_schedule_calls WHERE (uryyToeSS4='$txtClientId' AND care_calls = 'EL lunch call')";
                if ($conn->query($sqlDelScheldRun) === TRUE) {
                    header("Location: ./client-details?uryyToeSS4=$txtClientId");
                } else {
                    echo "Error deleting record: " . $conn->error;
                }
            } else {
                echo "Error deleting record: " . $conn->error;
            }
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else if ($txtClearVisitTime == 'Extra-Tea-call') {
        $sql = "UPDATE tbl_clienttime_calls SET dateTime_in = '', dateTime_out = '' 
        WHERE (uryyToeSS4='$txtClientId' AND care_calls = 'ET tea call')";
        if ($conn->query($sql) === TRUE) {
            $sqlDelManRun = "DELETE FROM tbl_manage_runs WHERE (uryyToeSS4='$txtClientId' AND care_calls = 'ET tea call')";
            if ($conn->query($sqlDelManRun) === TRUE) {
                $sqlDelScheldRun = "DELETE FROM tbl_schedule_calls WHERE (uryyToeSS4='$txtClientId' AND care_calls = 'ET tea call')";
                if ($conn->query($sqlDelScheldRun) === TRUE) {
                    header("Location: ./client-details?uryyToeSS4=$txtClientId");
                } else {
                    echo "Error deleting record: " . $conn->error;
                }
            } else {
                echo "Error deleting record: " . $conn->error;
            }
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else if ($txtClearVisitTime == 'Extra-Bed-call') {
        $sql = "UPDATE tbl_clienttime_calls SET dateTime_in = '', dateTime_out = '' 
        WHERE (uryyToeSS4='$txtClientId' AND care_calls = 'EB bed call')";
        if ($conn->query($sql) === TRUE) {
            $sqlDelManRun = "DELETE FROM tbl_manage_runs WHERE (uryyToeSS4='$txtClientId' AND care_calls = 'EB bed call')";
            if ($conn->query($sqlDelManRun) === TRUE) {
                $sqlDelScheldRun = "DELETE FROM tbl_schedule_calls WHERE (uryyToeSS4='$txtClientId' AND care_calls = 'EB bed call')";
                if ($conn->query($sqlDelScheldRun) === TRUE) {
                    header("Location: ./client-details?uryyToeSS4=$txtClientId");
                } else {
                    echo "Error deleting record: " . $conn->error;
                }
            } else {
                echo "Error deleting record: " . $conn->error;
            }
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        echo "No call";
    }
}
