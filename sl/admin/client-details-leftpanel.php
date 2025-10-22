<section class="sticky-filter" style="position: sticky; top: 20px; background-color: #eee;">
    <div class="container-fluid">
        <div class="row" style="font-size: 18px;">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <img src="assets/images/user/profile-icon.jpg" alt="avatar" class="rounded-circle img-fluid" style="width: 120px;">
                        <h5 class="my-3"><?php print $client_fullName; ?></h5>
                    </div>
                </div>

                <div class="card mb-4 mb-lg-0">
                    <div class="card-body p-4">
                        <div class="alert alert-info">
                            <h6>Current visit settings</h6>
                        </div>
                        <?php
                        // Prepare and execute query
                        $stmt = $conn->prepare("SELECT * FROM tbl_clienttime_calls 
                        WHERE uryyToeSS4 = ? AND care_calls = ? AND col_company_Id = ?");
                        $stmt->bind_param("sss", $uryyToeSS4, $carecall, $_SESSION['usr_compId']);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $row = $result->fetch_assoc();

                        // Define day columns and gradient colors
                        $days = [
                            'Monday'    => ['col' => 'col_monday', 'class' => 'btn-gradient-monday'],
                            'Tuesday'   => ['col' => 'col_tuesday', 'class' => 'btn-gradient-tuesday'],
                            'Wednesday' => ['col' => 'col_wednesday', 'class' => 'btn-gradient-wednesday'],
                            'Thursday'  => ['col' => 'col_thursday', 'class' => 'btn-gradient-thursday'],
                            'Friday'    => ['col' => 'col_friday', 'class' => 'btn-gradient-friday'],
                            'Saturday'  => ['col' => 'col_saturday', 'class' => 'btn-gradient-saturday'],
                            'Sunday'    => ['col' => 'col_sunday', 'class' => 'btn-gradient-sunday']
                        ];

                        // Loop through each day and display button if value exists
                        foreach ($days as $day => $info) {
                            if (!empty($row[$info['col']])) {
                                echo "<button id='btnGradient' class='btn mt-2 {$info['class']}'>{$row[$info['col']]}</button> ";
                            }
                        }
                        $stmt->close();
                        ?>

                        <style>
                            #btnGradient {
                                padding: 12px 25px;
                                font-size: 16px;
                                font-weight: 500;
                                border-radius: 50px;
                                color: #fff;
                                border: none;
                                transition: all 0.3s ease;
                                margin-right: 5px;
                            }

                            #btnGradient:hover {
                                transform: translateY(-3px);
                                box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
                            }

                            /* Cool gradient colors for each day */
                            .btn-gradient-monday {
                                background: linear-gradient(45deg, #1e3c72, #2a5298);
                            }

                            /* deep blue */
                            .btn-gradient-tuesday {
                                background: linear-gradient(45deg, #2980b9, #6dd5fa);
                            }

                            /* blue/cyan */
                            .btn-gradient-wednesday {
                                background: linear-gradient(45deg, #56ccf2, #2f80ed);
                            }

                            /* bright blue */
                            .btn-gradient-thursday {
                                background: linear-gradient(45deg, #43cea2, #185a9d);
                            }

                            /* teal/blue */
                            .btn-gradient-friday {
                                background: linear-gradient(45deg, #00c6ff, #0072ff);
                            }

                            /* cyan/blue */
                            .btn-gradient-saturday {
                                background: linear-gradient(45deg, #7f7fd5, #86a8e7, #91eae4);
                            }

                            /* purple/cyan */
                            .btn-gradient-sunday {
                                background: linear-gradient(45deg, #00d2ff, #3a7bd5);
                            }

                            /* light cyan/blue */
                        </style>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>