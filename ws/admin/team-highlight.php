<?php include('team_highlight_backend.php'); ?>
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h5>Team highlight <br> <small>View and update <?php print $varCarerNames; ?>'s biography,
                                professional statement will be nice.</small>
                        </h5>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div style="border-radius: 8px; box-shadow: rgba(17, 12, 46, 0.15) 0px 48px 100px 0px;" class="col-md-5">
                    <div class="col-lg-12 col-md-12 mt-2">
                        <form method="POST" action="./team-highlight?uryyTteamoeSS4=<?= $uryyTteamoeSS4 ?>" enctype="multipart/form-data" autocomplete="off">
                            <input type="hidden" name="txtcompanyTeamId" value="<?php echo htmlspecialchars($teamId); ?>">
                            <div class="form-group">
                                <label for="txtHighlight"><strong>Highlight</strong></label>
                                <textarea style="resize: none;" name="txtHighlight" id="txtHighlight" rows="5" class="form-control" placeholder="Write the team member's highlight here..." required><?php echo htmlspecialchars($row['team_highlight']) . "" ?></textarea>
                            </div>
                            <div class="form-group mt-3">
                                <button type="submit" name="btnUpdateHighlight" class="btn btn-primary">Update</button>
                                <button onclick="location.reload()" class="btn btn-danger ml-2">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-5 col-md-5 mt-2">
                    <h5>Team Highlight</h5>
                    <p>Your dedicated space to get to know the incredible individuals behind our organization. This page showcases detailed biographies of each team member, giving you insights into their backgrounds, expertise, and roles within the team. Whether you're curious about who’s supporting your care or just want to put a face to the name, this is the place to learn more about the people that make a difference every day.
                        <br><br>
                        We believe in transparency and collaboration, which is why the Team Highlight page isn't just for viewing — it's also interactive. Authorized users can easily update or edit biography details to ensure the information remains current and accurate. This feature helps maintain up-to-date records and allows the team to present their most authentic selves.
                        <br><br>
                        Take a moment to explore the page and get familiar with your colleagues or team members. Whether you’re a new staff member or part of the management team, the Team Highlight page helps foster a sense of connection and belonging within the organization.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <?php include('footer-contents.php'); ?>