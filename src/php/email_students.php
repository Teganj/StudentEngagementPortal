<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css?ver=0.6" rel="stylesheet">
    <link href="plugins/trumbowyg/trumbowyg.min.css" rel="stylesheet" type="text/css"/>
    <style>
        .msg_container {
            position: fixed;
            width: 470px;
            right: 0;
            bottom: 0;
            background: #f7efef;
            padding: 15px;
            border-radius: 2px;
            color: #000;
            box-shadow: -2px -5px 20px 0px #00000040;


        }

        .msg_container h4{
            margin-top: 0;

        }

        .trumbowyg-editor, .trumbowyg-textarea {
            min-height: 200px;
        }

    </style>
</head>
<body>
<?php
include 'connection.php';
include 'vendor/autoload.php';
// Get count of data set first
$sql = "SELECT * FROM reports";
$count = $con->query($sql)->num_rows;

// Initialize a Data Pagination with previous count number
$pagination = new \yidas\data\Pagination([
    'totalCount' => $count,
    'pergpage' => 10,
]);

// Get range data for the current page
$sql = "SELECT * FROM reports LIMIT {$pagination->offset}, {$pagination->limit}";
$users = $con->query($sql);
?>


<table class="table table-striped">
    <thead>
    <tr>
        <th>
            <input type="checkbox" id="mcheck"> Check All
        </th>
        <th>Name</th>
        <th>Email</th>
    </tr>
    </thead>
    <tbody id="alluser">
    <?php while ($user = $users->fetch_assoc()): ?>



        <tr>
            <td>
                <input type="checkbox" value="<?php echo $user['email']; ?>" onclick="updateTextArea();">
            </td>
            <td><?php echo $user['name']; ?></td>
            <td><?php  echo $user['email']; ?>
            </td>
        </tr>

    <?php endwhile; ?>
    </tbody>
</table>
<div>
    <?php
    \yidas\widgets\Pagination::widget([
        'pagination' => $pagination
    ])
    ?>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="plugins/trumbowyg/trumbowyg.min.js" type="text/javascript"></script>
<script src="main.js" type="text/javascript"></script>


<form action="" method="post" class="msg_container">
    <h4>Compose Email</h4>
    <p id="multi-responce"></p>
    <div class="form-group">
        <textarea class="form-control" id="emails" name="emails" placeholder="Email list" style="height: 120px;"></textarea>
    </div>
    <div class="form-group">
        <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" required>
    </div>
    <div class="form-group">
        <textarea style="height: 220px;" id="message" name="message" class="form-control" placeholder="Your Message" rows="5" required></textarea>
    </div>
    <button type="button" onclick="multi_email();" class="btn btn-primary btn-lg col-lg-12" id="send">Send Now </button>

</form>

</body>
</html>

<script>
    $(document).ready(function() {

        $('#message').trumbowyg();

        $("#mcheck").on('click', function() {
            $('input:checkbox').not(this).prop('checked', this.checked);

        });

    });

    function updateTextArea() {
        var allVals = [];
        $('#alluser tr td :checked').each(function() {
            allVals.push($(this).val());
        });
        $('#emails').val(allVals);
    }
    $(function() {
        $('#mcheck').click(updateTextArea);
        updateTextArea();
    });


    function multi_email() {

        $('#multi-responce').html("Sending to <span id='curent-email'></span>");
        var emails = $('#emails').val();
        var subject = $('#subject').val();
        var message = $('#message').val();

        var path_uri =  "send_reminder.php";

        var email = emails.split(',');



        $.ajax({
            type: "POST",
            url: path_uri,
            data: {
                emails: email_loop(email),
                subject: subject,
                message: message
            },
            success: function(data) {
                if (data == "success") {
                    $('#multi-responce').html("Successfully sent");

                } else {
                    $('#multi-responce').html(data);
                }
            }
        });
    }




    var i = 0;
    function email_loop(emails) {
        var email = emails[i];
        $("#curent-email").html(email);
        if (++i < emails.length) {
            setTimeout(multi_email, 1000);
        }

        return email;
    }
</script>