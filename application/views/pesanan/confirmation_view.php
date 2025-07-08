<!DOCTYPE html>
<html>
<head>
    <title><?php echo $title; ?></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <h1><?php echo $title; ?></h1>
    <p>Are you sure you want to proceed?</p>
    <button id="confirmYes">Yes</button>
    <button id="confirmNo">No</button>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#confirmYes').click(function() {
                // Redirect to another page or execute your action here when user clicks "Yes"
                alert('Confirmed!'); // For demonstration purposes, you can replace this with your action
            });

            $('#confirmNo').click(function() {
                // Do something else when user clicks "No", or just close the confirmation dialog
                alert('Cancelled!'); // For demonstration purposes, you can replace this with your action
            });
        });
    </script>
</body>
</html>
