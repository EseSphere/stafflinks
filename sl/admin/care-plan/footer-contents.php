<script>
    function getFile() {
        document.getElementById("upfile").click();
    }

    function sub(obj) {
        var file = obj.value;
        var fileName = file.split("\\");
        document.getElementById("yourBtn").innerHTML = fileName[fileName.length - 1];
        document.myForm.submit();
        event.preventDefault();
    }

    $("#files").change(function() {
        filename = this.files[0].name;
        console.log(filename);
    });

    function printDiv(divId) {
        var originalContent = document.getElementById(divId).innerHTML;
        var tempDiv = document.createElement('div');
        tempDiv.innerHTML = originalContent;

        // Split tables if columns > 8
        var tables = tempDiv.querySelectorAll('table');
        tables.forEach(table => {
            var headers = table.querySelectorAll('thead th');
            if (headers.length > 8) {
                var rows = Array.from(table.querySelectorAll('tr'));
                var newTables = [];
                for (let start = 0; start < headers.length; start += 8) {
                    let end = Math.min(start + 8, headers.length);
                    let newTable = document.createElement('table');
                    newTable.className = table.className;

                    // Clone the header slice
                    let thead = document.createElement('thead');
                    let headerRow = document.createElement('tr');
                    for (let i = start; i < end; i++) {
                        headerRow.appendChild(headers[i].cloneNode(true));
                    }
                    thead.appendChild(headerRow);
                    newTable.appendChild(thead);

                    // Clone each row slice
                    let tbody = document.createElement('tbody');
                    rows.slice(1).forEach(row => { // skip original header
                        let newRow = document.createElement('tr');
                        let cells = row.querySelectorAll('td');
                        for (let i = start; i < end; i++) {
                            if (cells[i]) newRow.appendChild(cells[i].cloneNode(true));
                        }
                        tbody.appendChild(newRow);
                    });
                    newTable.appendChild(tbody);
                    newTables.push(newTable);
                }
                // Replace original table with split tables
                table.replaceWith(...newTables);
            }
        });

        var printWindow = window.open('', '', 'width=1200,height=800');
        printWindow.document.write('<html><head><title>Print</title>');

        // Bootstrap for styling
        printWindow.document.write('<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">');

        // Print-specific CSS
        printWindow.document.write('<style>');
        printWindow.document.write(`
        body {
            font-family: Arial, sans-serif;
            margin: 12px;
            font-size: 16px !important;
        }
        table {
            width: 100% !important;
            border-collapse: collapse !important;
            margin-bottom: 12px !important;
        }
        th, td {
            border: 1px solid #000 !important;
            padding: 6px !important;
            text-align: left !important;
            font-size: 14px;
        }
        thead {
            background-color: #f8f9fa !important;
            display: table-row-group; /* ✅ header prints only once */
        }
        tfoot {
            display: table-row-group;
        }
        @page {
            size: A4 landscape;
            margin: 10mm;
        }
        @media print {
            button, .btn {
                display: none !important;
            }
            /* ✅ allow rows to break naturally */
            table, tr, td, th {
                page-break-inside: auto !important;
            }
            tr {
                page-break-after: auto !important;
            }
            body {
                margin: 10mm !important;
            }
        }
    `);
        printWindow.document.write('</style>');

        printWindow.document.write('</head><body>');
        printWindow.document.write(tempDiv.innerHTML);
        printWindow.document.write('</body></html>');

        printWindow.document.close();

        printWindow.onload = function() {
            printWindow.focus();
            printWindow.print();
            printWindow.close();
        };
    }


    $(document).ready(function() {
        display_events();
    });
</script>
<script src="//code.tidio.co/zypfthde44m6lunlki6ohfmh3darewkf.js" async></script>
<script src="assets/js/vendor-all.min.js"></script>
<script src="assets/js/plugins/bootstrap.min.js"></script>
<script src="assets/js/pcoded.min.js"></script>
<script src="assets/js/plugins/apexcharts.min.js"></script>
<script src="assets/js/pages/dashboard-main.js"></script>
</body>

</html>