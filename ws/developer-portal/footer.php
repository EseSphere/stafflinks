<script>
    save_btn = document.querySelector("#save-btn");
    save_btn.onclick = function() {
        this.innerHTML = "<div class='loader'>Loading...</div>";
        setTimeout(() => {
            this.innerHTML = "Sign up";
            this.style = "color: #fff; pointer-event:none;";
        }, 7000);
    }

    document.getElementById('start_date').addEventListener('change', function() {
        const startDate = new Date(this.value);
        if (startDate != "Invalid Date") {
            const endDate = new Date(startDate);
            endDate.setDate(endDate.getDate() + 7); // add 7 days
            const yyyy = endDate.getFullYear();
            const mm = String(endDate.getMonth() + 1).padStart(2, '0');
            const dd = String(endDate.getDate()).padStart(2, '0');
            document.getElementById('end_date').value = `${yyyy}-${mm}-${dd}`;
        }
    });
</script>

<script src="assets/js/vendor-all.min.js"></script>
<script src="assets/js/plugins/bootstrap.min.js"></script>