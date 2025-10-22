$(document).ready(function() {
    $('#popupAlert').hide();
    $('#popupAlertFrequency').hide();
    $('#displayDailyCheckbox').hide();
    $('#displayOneTimeCheckBox').hide();
    $('#displayCustomCheckBox').hide();
    $('#popupAlertSuccess').hide();
    $('#ExtraCareCall').hide();

    $('#clickDisplayDaily').click(function() {
        $("#clickDisplayOneTime").prop('checked', false)
        $("#clickDisplayCustom").prop('checked', false)
        $('#displayDailyCheckbox').slideToggle();
        $('#displayOneTimeCheckBox').hide();
        $('#displayCustomCheckBox').hide();
    });
    $('#clickDisplayOneTime').click(function() {
        $("#clickDisplayDaily").prop('checked', false)
        $("#clickDisplayCustom").prop('checked', false)
        $('#displayOneTimeCheckBox').slideToggle();
        $('#displayDailyCheckbox').hide();
        $('#displayCustomCheckBox').hide();
    });
    $('#clickDisplayCustom').click(function() {
        $("#clickDisplayDaily").prop('checked', false)
        $("#clickDisplayOneTime").prop('checked', false)
        $('#displayCustomCheckBox').slideToggle();
        $('#displayDailyCheckbox').hide();
        $('#displayOneTimeCheckBox').hide();
    });


    $('#showExtraCareCall').click(function() {
        $('#ExtraCareCall').slideToggle();
    });

    // Listen for click on toggle checkbox
    $('#select-all').click(function(event) {
        if (this.checked) {
            // Iterate each checkbox
            $('#checkboxarea1').each(function() {
                this.checked = true;
            });
            $('#checkboxarea2').each(function() {
                this.checked = true;
            });
            $('#checkboxarea3').each(function() {
                this.checked = true;
            });
            $('#checkboxarea4').each(function() {
                this.checked = true;
            });
        } else {
            $('#checkboxarea1').each(function() {
                this.checked = false;
            });
            $('#checkboxarea2').each(function() {
                this.checked = false;
            });
            $('#checkboxarea3').each(function() {
                this.checked = false;
            });
            $('#checkboxarea4').each(function() {
                this.checked = false;
            });
        }
    });

    $('#select-alldays').click(function(event) {
        if (this.checked) {
            // Iterate each checkbox
            $('#customswitch5').each(function() {
                this.checked = true;
            });
            $('#customswitch6').each(function() {
                this.checked = true;
            });
            $('#customswitch7').each(function() {
                this.checked = true;
            });
            $('#customswitch8').each(function() {
                this.checked = true;
            });
            $('#customswitch9').each(function() {
                this.checked = true;
            });
            $('#customswitch10').each(function() {
                this.checked = true;
            });
            $('#customswitch11').each(function() {
                this.checked = true;
            });
        } else {
            $('#customswitch5').each(function() {
                this.checked = false;
            });
            $('#customswitch6').each(function() {
                this.checked = false;
            });
            $('#customswitch7').each(function() {
                this.checked = false;
            });
            $('#customswitch8').each(function() {
                this.checked = false;
            });
            $('#customswitch9').each(function() {
                this.checked = false;
            });
            $('#customswitch10').each(function() {
                this.checked = false;
            });
            $('#customswitch11').each(function() {
                this.checked = false;
            });
        }
    });

    $('#selectAllCheckbox').change(function() {
        $('.checkboxes').prop('checked', $(this).prop('checked'));
    });
});

function PrintElem(elem) {
    Popup($(elem).html());
}

function Popup(data) {
    var mywindow = window.open('', 'new div', 'height=700,width=1200');
    mywindow.document.write('<html><head><title></title>');
    mywindow.document.write('<link rel="stylesheet" href="assets/css/style.css" type="text/css" media="print" />');
    mywindow.document.write('<link rel="stylesheet" media="print" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" type="text/css" />');
    mywindow.document.write('<link rel="stylesheet" media="print" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" type="text/css" />');
    mywindow.document.write('</head><body>');
    mywindow.document.write('<br><br><br> <h3>Invoice</h3><br><br>');
    mywindow.document.write(data);
    mywindow.document.write('</body></html>');

    mywindow.print();
    mywindow.close();

    return true;
}