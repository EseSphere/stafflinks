<?php include('team-header-contents.php'); ?>
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
                            <h5 class="m-b-10">Care recipients</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./dashboard.php"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Clients board</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- table card-1 start -->

            <!-- prject ,team member start -->
            <div class="col-xl-12 col-md-12">
                <div class="card table-card">
                    <div class="card-header">
                        <h5>Care recipients</h5>
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
                                    <input type="text" required class="form-control" id="input" placeholder="Search client here..." />
                                </div>
                                <ul class="list"></ul>
                            </div>
                        </div>

                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Area</th>
                                        <th class="text-left">City</th>
                                        <th>Role</th>
                                        <th>Decision</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    //change this line in your query as well
                                    if (isset($_GET['uryyTteamoeSS4'])) {
                                        $uryyTteamoeSS4 = $_GET['uryyTteamoeSS4'];
                                        $result = mysqli_query($conn, "SELECT * FROM tbl_schedule_calls WHERE first_carer_Id = '$uryyTteamoeSS4' OR second_carer_Id = '$uryyTteamoeSS4' ORDER BY userId DESC ");
                                        while ($trans = mysqli_fetch_array($result)) {
                                            echo "
                                            <tr>
                                                <td>
                                                    <div class='d-inline-block align-middle'>
                                                        <img src='assets/images/profile/profile-icon.jpg' alt='user image' class='img-radius wid-40 align-top m-r-15'>
                                                        <div class='d-inline-block'>
                                                            <h6> " . $trans['client_name'] . "</h6>
                                                            <p class=' m-b-0' style='padding:3px 0px 3px 10px; border-radius:50px; color:" . $trans['call_status'] . ";'>Currently active</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>" . $trans['client_area'] . "</td>
                                                <td>" . $trans['col_area_city'] . "</td>
                                                <td>Not yet</td>
                                                <td>
                                                <a style='text-decoration:none;' href='./client-task?uryyToeSS4=" . $trans['uryyToeSS4'] . "'> <button title='add/view client task' type='button' class='btn  btn-primary btn-sm'>View my task</button> </a>
                                                <a style='text-decoration:none;' href='./client-medication?uryyToeSS4=" . $trans['uryyToeSS4'] . "'> <button title='add/view client medication' type='button' class='btn  btn-danger btn-sm'>View my meds</button> </a>
                                                <a style='text-decoration:none;' href='./client-details?uryyToeSS4=" . $trans['uryyToeSS4'] . "'><button title='View client details' type='button' class='btn btn-info btn-sm'><i class='feather mr-2 icon-eye'></i></button></a>
                                                </td>

                                            </tr>
                                            ";
                                        }
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
        $result = mysqli_query($myConnection, "SELECT * FROM tbl_general_client_form ");
        while ($trans = mysqli_fetch_array($result)) {
            echo "
            '" . $trans['client_first_name'] . " " . $trans['client_last_name'] . "',
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