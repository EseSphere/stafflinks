<script src="https://cdn.jsdelivr.net/npm/litepicker/dist/litepicker.js"></script>
<script>
    let input = document.getElementById('litepicker');
    let now = new Date();
    let picker = new Litepicker({
        element: input,
        format: 'DD MMM YYYY',
        singleMode: false,
        numberOfMonths: 2,
        numberOfColumns: 2,
        showTooltip: true,
        scrollToDate: true,
        startDate: new Date(now).setDate(now.getDate() - 1),
        endDate: new Date(now),
        setup: function(picker) {
            picker.on('selected', function(date1, date2) {
                console.log(`${date1.toDateString()}, ${date2.toDateString()}`)
            })
        }
    });
    $(document).ready(function() {
        display_events();
    }); //end document.ready block
</script>
<script src="assets/js/vendor-all.min.js"></script>
<script src="assets/js/plugins/bootstrap.min.js"></script>
<script src="assets/js/pcoded.min.js"></script>
<script src="assets/js/plugins/apexcharts.min.js"></script>
<script src="assets/js/pages/dashboard-main.js"></script>
</body>

</html>