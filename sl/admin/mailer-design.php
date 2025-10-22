<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Document</title>
</head>
<style>
    body {
        margin: 0;
        padding: 0;
        font-family: 'Roboto', sans-serif;
        font-size: 16px;
        font-weight: 400;
        line-height: 1.5;
        color: #212529;
        text-align: left;
        overflow: hidden;
    }
</style>

<body>

    <div style='width: 100%; height:auto; position:absolute; right:0; left:0; bottom:0; top:0;'>
        <div style='width: 100%; height:auto; padding:18px; background-color:rgba(39, 174, 96,1.0); color:#fff; text-align:center;'>
            <strong style='font-size: 22px;'>Access Care Calls</strong>
        </div>
        <div style='width: 100%; height:auto; padding:18px; background-color:rgba(189, 195, 199,.4);'>
            <div style='padding:22px;overflow-wrap: break-word;'>
                Alan Jones care calls.
                <br>
                Use the access code and website link to share client basic info, medical
                details and care log. When sharing this code with a third party, please inform them that their
                data will be shared with your agency for auditing purposes.

                <hr>

                https://geosoftcare.co.uk/page/geosoft/files/admin-control-panel/control-panel/shared-access/shared/access/client-visit?uryyToeSS4=27c614a46d54234eb402b6d53e84999b7b678fa31daa24ef299208bf161b1dce

                <br><br>

                <a href='' . $txtShareUrl . '' style='text-decoration: none; color:white; cursor:pointer;'>
                    <button style='width:150px; font-size:15px; font-weight:400; height:45px; border:none; 
                    background-color:rgba(39, 174, 96,1.0); color:#fff; cursor:pointer; border-radius: 5px;'>
                        View care call
                    </button>
                </a>
            </div>
        </div>
        <div style='width: 100%; height:auto; padding:12px; background-color:rgba(22, 160, 133,1.0); color:#fff; text-align:center;'>
            <?php print date('Y'); ?> &copy; Geosoft Care
        </div>
    </div>

</body>

</html>