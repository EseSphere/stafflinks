<?php
include('dbconnect.php');
isset($_COOKIE['companyCity']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="HTML, CSS, JavaScript, AJAX, PHP mySQL, Restful API" />
    <meta name="author" content="Geocare Services Limited" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Geosoft Care | Software For Care Settings</title>
    <meta property="og:image" content="../assets/images/gsLogo.png" />
    <meta name="twitter:image" content="../assets/images/gsLogo.png" />
    <link rel="icon" href="../assets/images/gsLogo.png" />
    <link rel="icon" href="../assets/images/gsLogo.png" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/fontawesome.min.css" />
    <link rel="stylesheet" href="css/mobiscroll.javascript.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="js/mobiscroll.javascript.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#popaction").hide();
            $('#popupclientBox').click(function() {
                $('#popaction').slideToggle();
            });
            $('#popupClose').click(function() {
                $('#popaction').slideToggle();
            });
            //change selectboxes to selectize mode to be searchable
            $("select").select2();

        });
    </script>

    <style type="text/css">
        body,
        html {
            overflow-y: auto;
            overflow-x: hidden;
        }

        .content-header {
            background-color: rgba(189, 195, 199, .3);
            color: #000;
            padding: 10px;
            text-align: center;
            width: 100%;
            box-shadow: rgba(50, 50, 93, 0.25) 0px 30px 60px -12px, rgba(0, 0, 0, 0.3) 0px 18px 36px -18px;
        }

        #txtSelectArea {
            width: 200px;
            border: none;
            box-shadow: rgba(50, 50, 93, 0.25) 0px 30px 60px -12px, rgba(0, 0, 0, 0.3) 0px 18px 36px -18px;
        }

        .date-display {
            font-size: 1.5rem;
            margin: 20px;
        }

        .icon-button {
            font-size: 24px;
            cursor: pointer;
            margin: 0 10px;
            box-shadow: #fff 0px 30px 60px -12px, #fff 0px 18px 36px -18px;
        }

        #item-list {
            margin-bottom: 10px;
            border-bottom: 5px solid #fff;
        }

        #item-list ul {
            width: 100%;
        }

        #item-list li {
            list-style: none;
            padding: 5px;
            margin: 3px 10px 0px 0px;
            background-color: #fff;
            border-radius: 5px;
            display: inline-block;
            width: 150px;
            font-size: 14px;
            font-weight: 600;
            text-align: center;
            box-shadow: rgba(50, 50, 93, 0.25) 0px 30px 60px -12px, rgba(0, 0, 0, 0.3) 0px 18px 36px -18px;
        }

        .scrolling-wrapper {
            overflow-x: scroll;
            overflow-y: scroll;
            white-space: nowrap;
            background-color: rgba(189, 195, 199, .3);
            height: 70vh;
        }

        .card {
            display: inline-block;
            height: 100vh;
            padding: 5px;
            width: 100%;
            background-color: #000;
        }

        .content-footer {
            background-color: rgba(189, 195, 199, .3);
            color: #000;
            padding: 10px;
            text-align: center;
            width: 100%;
        }

        #left-panel-items {
            background-color: rgba(52, 73, 94, 1.0);
            height: 80px;
            color: rgba(236, 240, 241, 1.0);
            padding: 8px 0px 0px 22px;
            font-size: 16px;
            width: 100%;
            white-space: normal;
        }

        .md-work-order-checkbox-label.mbsc-checkbox {
            padding-top: 5px;
            padding-bottom: 5px;
        }

        .md-work-order-date {
            font-size: 14px;
            border-bottom: 1px solid #ccc;
            padding: 5px 10px;
        }

        .md-work-order-date-title {
            font-size: 13px;
            color: #959595;
            padding: 5px 10px;
            line-height: 18px;
        }

        .md-work-order-price-tag {
            display: inline-block;
            font-size: 11px;
            line-height: 16px;
            vertical-align: middle;
            border: 1px solid #959595;
            color: #959595;
            border-radius: 5px;
            margin: 0 10px;
            padding: 0px 5px;
        }

        .md-work-order-scheduling .mbsc-timeline-parent {
            height: 32px;
        }

        .multipleSelection {
            width: 200px;
            background-color: rgba(189, 195, 199, 1.0);
            font-size: 16px;
        }

        .selectBox {
            position: relative;
        }

        .selectBox select {
            width: 100%;
            padding: 5px;
            font-weight: bold;
            font-size: 16px;
        }

        .overSelect {
            position: absolute;
            left: 0;
            right: 0;
            top: 0px;
            bottom: 0;
        }

        #checkBoxes {
            display: none;
            border: 1px #8DF5E4 solid;
            height: auto;
            padding: 8px;
        }

        #checkBoxes label {
            display: block;
            padding: 5px;
        }

        #checkBoxes label:hover {
            background-color: #4F615E;
            color: white;

            /* Added text color for better visibility */
        }

        /*Carer version */
        .CmultipleSelection {
            width: 200px;
            background-color: rgba(189, 195, 199, 1.0);
            font-size: 16px;
        }

        .CselectBox {
            position: relative;
        }

        .CselectBox select {
            width: 100%;
            padding: 5px;
            font-weight: bold;
            font-size: 16px;
        }

        .CoverSelect {
            position: absolute;
            left: 0;
            right: 0;
            top: 0px;
            bottom: 0;
        }

        #CcheckBoxes {
            display: none;
            border: 1px #8DF5E4 solid;
            height: auto;
            padding: 8px;
        }

        #CcheckBoxes label {
            display: block;
            padding: 5px;
        }

        #CcheckBoxes label:hover {
            background-color: #4F615E;
            color: white;

            /* Added text color for better visibility */
        }

        #btnRunName {
            width: auto;
            height: auto;
            padding: 5px 12px 5px 12px;
            background-color: rgba(39, 174, 96, .8);
            color: white;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            border: none;
            border-radius: 3px;
        }
    </style>

</head>

<body>