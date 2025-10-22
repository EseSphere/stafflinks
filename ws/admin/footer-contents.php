<div id="notification-container"></div>
<!-- Footer Start -->
<footer style="background-color: #2c3e50;" class="text-light pt-5 pb-4 mt-5">
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <p class="mb-0">&copy; <?= date('Y'); ?> Geosoft Care. All Rights Reserved.</p>
            </div>
        </div>
    </div>
</footer>
<!-- Footer End -->


<script>
    let names = [
        <?php
        include('dbconnect.php');
        $result = mysqli_query($myConnection, "SELECT * FROM tbl_medication_list ");
        while ($trans = mysqli_fetch_array($result)) {
            echo "
                '" . $trans['med_name'] . "',
                ";
        } ?>
    ];

    let sortedNames = names.sort();
    let input = document.getElementById("input");
    input.addEventListener("keyup", (e) => {
        removeElements();
        for (let i of sortedNames) {

            if (
                i.toLowerCase().startsWith(input.value.toLowerCase()) &&
                input.value != ""
            ) {
                let listItem = document.createElement("li");
                listItem.classList.add("list-items");
                listItem.style.cursor = "pointer";
                listItem.setAttribute("onclick", "displayNames('" + i + "')");
                let word = "<b>" + i.substr(0, input.value.length) + "</b>";
                word += i.substr(input.value.length);
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
        let items = document.querySelectorAll(".list-items");
        items.forEach((item) => {
            item.remove();
        });
    }

    $('button').on("click", function() {
        $(this).toggleClass('active');

    });
    $(".cost-box").hide();
    $(".item").click(function() {
        if ($(this).is(":checked")) {
            $(this).parent().siblings().find(".cost-box").show();
        } else {
            $(this).parent().siblings().find(".cost-box").hide();
        }
    });
    $('#SelectAllLunch').click(function() {
        $("input[id^='customswitchLunch']").prop('checked', $(this).prop("checked"));
    });


    function GetFileSizeNameAndType() {
        var fi = document.getElementById('files');
        var totalFileSize = 0;
        if (fi.files.length > 0) {
            for (var i = 0; i <= fi.files.length - 1; i++) {
                var fsize = fi.files.item(i).size;
                totalFileSize = totalFileSize + fsize;
                document.getElementById('fp').innerHTML =
                    document.getElementById('fp').innerHTML +
                    'File Name is <b>' + fi.files.item(i).name +
                    '</b> <br /> Size is <b>' + Math.round((fsize / 1024)) +
                    '</b> KB <br /> File Type is <b>' + fi.files.item(i).type + "</b>.";
            }
        }
        document.getElementById('divTotalSize').innerHTML = "Total File(s) Size is <b>" + Math.round(totalFileSize / 1024) + "</b> KB";
    }

    const alertKey = 'alertShownToday';
    const lastShownDate = localStorage.getItem(alertKey);

    if (lastShownDate && new Date(lastShownDate).toDateString() === new Date().toDateString()) {
        document.getElementById('dailyAlert').style.display = 'none';
    }

    function closeAlert() {
        localStorage.setItem(alertKey, new Date().toString());
        document.getElementById('dailyAlert').style.display = 'none';
    }

    $(document).ready(function() {
        fetchNotifications();
        setInterval(fetchNotifications, 30000);
    });
    $(document).ready(function() {
        display_events();
    });
</script>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="assets/js/vendor-all.min.js"></script>
<script src="assets/js/plugins/bootstrap.min.js"></script>
<script src="assets/js/pcoded.min.js"></script>
<script src="assets/js/plugins/apexcharts.min.js"></script>
<script src="assets/js/pages/dashboard-main.js"></script>
</body>

</html>