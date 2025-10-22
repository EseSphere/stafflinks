<?php include('header-contents.php'); ?>
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
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Team</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./dashboard.php"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Team board</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- table card-1 start -->
            <div class="col-md-12 col-xl-4">

                <!-- widget primary card start -->
                <div class="card flat-card widget-primary-card">
                    <div class="row-table">
                        <div class="col-sm-3 card-body">
                            <i class="feather icon-list"></i>
                        </div>
                        <div class="col-sm-9">
                            <h4><?php

                                $sql = "SELECT * FROM tbl_goesoft_carers_account";

                                if ($result = mysqli_query($conn, $sql)) {
                                    $rowcount = mysqli_num_rows($result);
                                    printf($rowcount);
                                    mysqli_free_result($result);
                                }

                                ?></h4>
                            <h6>Team</h6>
                        </div>
                    </div>
                </div>
                <!-- widget primary card end -->
            </div>
            <!-- table card-1 end -->


            <!-- table card-2 start -->
            <div class="col-md-12 col-xl-4">

                <!-- widget-success-card start -->
                <div class="card flat-card widget-purple-card">
                    <div class="row-table">
                        <div class="col-sm-3 card-body">
                            <i class="feather icon-activity"></i>
                        </div>
                        <div class="col-sm-9">
                            <h4><?php

                                $sql = "SELECT * FROM tbl_goesoft_carers_account WHERE verification_code = 'Verified' ";

                                if ($result = mysqli_query($conn, $sql)) {
                                    $rowcount = mysqli_num_rows($result);
                                    printf($rowcount);
                                    mysqli_free_result($result);
                                }

                                ?></h4>
                            <h6>Active</h6>
                        </div>
                    </div>
                </div>
                <!-- widget-success-card end -->
            </div>
            <!-- table card-2 end -->


            <!-- table card-1 start -->
            <div class="col-md-12 col-xl-4">

                <!-- widget primary card start -->
                <div class="card flat-card widget-info-card" style="background-color: rgba(231, 76, 60,1.0); color:white;">
                    <div class="row-table">
                        <div class="col-sm-3 card-body" style="background-color: rgba(192, 57, 43,1.0); color:white;">
                            <i class="feather icon-alert-triangle"></i>
                        </div>
                        <div class="col-sm-9" style="color: white;">
                            <h4 style="color: white;"><?php

                                                        $sql = "SELECT * FROM tbl_goesoft_carers_account WHERE verification_code = 'Not Verified' ";

                                                        if ($result = mysqli_query($conn, $sql)) {
                                                            $rowcount = mysqli_num_rows($result);
                                                            printf($rowcount);
                                                            mysqli_free_result($result);
                                                        }

                                                        ?></h4>
                            <h6 style="color: white;">In-active</h6>
                        </div>
                    </div>
                </div>
                <!-- widget primary card end -->
            </div>
            <!-- table card-1 end -->

            <!-- prject ,team member start -->
            <div class="col-xl-12 col-md-12">
                <div class="card table-card">
                    <div class="card-header">
                        <h5>Team</h5>

                        <div class="card-header-right">

                            <div class="btn-group card-option">
                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="feather icon-more-horizontal"></i>
                                </button>
                                <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                    <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a></li>
                                    <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a></li>
                                    <li class="dropdown-item reload-card"><a href="#!"><i class="feather icon-refresh-cw"></i> reload</a></li>
                                    <li class="dropdown-item close-card"><a href="#!"><i class="feather icon-trash"></i> remove</a></li>
                                </ul>
                            </div>
                        </div>

                        <div style="margin-top: 15px;" class="row">
                            <br>
                            <div style="padding: 0;" class="col-sm-1 col-7">
                            </div>
                            <div style="padding: 0;" class="col-sm-7 col-7">
                                <div>
                                    <input type="text" required class="form-control" id="input" placeholder="Search carer here..." />
                                </div>
                                <ul class="list"></ul>
                            </div>
                            <div style="padding: 0;" class="col-sm-4 col-5">
                                <a href="./add-new-team">
                                    <button style="height: 48px;" type="button" class="btn btn-outline-info"><i class="feather mr-2 icon-plus"></i>Add team member</button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email Address</th>
                                        <th>Phone</th>
                                        <th>Status</th>
                                        <th>Decision</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php

                                    //change this line in your query as well
                                    $result = mysqli_query($conn, "SELECT * FROM tbl_goesoft_carers_account ORDER BY userId DESC ");
                                    while ($trans = mysqli_fetch_array($result)) {
                                        echo "

                                    <tr>
                                        <td>
                                           
                                            <div class='d-inline-block align-middle'>
                                                <img src='assets/images/profile/profile-icon.jpg' alt='user image' class='img-radius wid-40 align-top m-r-15'>
                                                <div class='d-inline-block'>
                                                    <h6> " . $trans['user_fullname'] . "</h6>
                                                    <p class='m-b-0' style='padding:3px 10px 3px 10px; border-radius:50px; color:#27ae60;'>" . $trans['verification_code'] . "</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>" . $trans['user_email_address'] . "</td>
                                        <td>" . $trans['user_phone_number'] . "</td>
                                        <td>" . $trans['verification_code'] . "</td>
                                        <td>
                                        <a href='./team-profile-view?user_special_Id=" . $trans['user_special_Id'] . "'><button type='button' class='btn btn-info btn-sm'><i class='feather mr-2 icon-eye'></i> View profile</button></a>
                                        </td>

                                    </tr>
                                    ";
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


            <?php include('bottom-panel-block.php'); ?>


        </div>
        <!-- Latest Customers end -->
    </div>
    <!-- [ Main Content ] end -->
</div>
</div>

<script type="text/javascript">
    /**/
    let names = [
        <?php
        include('dbconnect.php');
        //change this line in your query as well
        $result = mysqli_query($myConnection, "SELECT * FROM tbl_goesoft_carers_account ");
        while ($trans = mysqli_fetch_array($result)) {
            echo "
            '" . $trans['user_fullname'] . "',
                ";
        } ?>



    ];
    //Sort names in ascending order
    let sortedNames = names.sort();

    //reference
    let input = document.getElementById("input");

    //Execute function on keyup
    input.addEventListener("keyup", (e) => {
        //loop through above array
        //Initially remove all elements ( so if user erases a letter or adds new letter then clean previous outputs)
        removeElements();
        for (let i of sortedNames) {
            //convert input to lowercase and compare with each string

            if (
                i.toLowerCase().startsWith(input.value.toLowerCase()) &&
                input.value != ""
            ) {
                //create li element
                let listItem = document.createElement("li");
                //One common class name
                listItem.classList.add("list-items");
                listItem.style.cursor = "pointer";
                listItem.setAttribute("onclick", "displayNames('" + i + "')");
                //Display matched part in bold
                let word = "<b>" + i.substr(0, input.value.length) + "</b>";
                word += i.substr(input.value.length);
                //display the value in array
                listItem.innerHTML = word;
                document.querySelector(".list").appendChild(listItem);
            }
        }
    });

    function displayNames(value) {
        input.value = value;
        removeElements();
    }

    function removeElements() {
        //clear all the item
        let items = document.querySelectorAll(".list-items");
        items.forEach((item) => {
            item.remove();
        });
    }
</script>

<?php include('footer-contents.php'); ?>