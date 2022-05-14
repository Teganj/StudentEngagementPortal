<?php
include_once 'connection.php';
require "mailer.php";
$error = array();

$query = "select * from reports";
$statement = $con->prepare($query);
$statement->execute();
$result = $statement->fetch();
?>
<script scr="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">
<div class="container">
    <h3 class="box-title" align="center">Email Students</h3>
    <br/>
    <div class="table-responsive" style="width: 100%">
        <table class="table table-bordered table-striped">
            <tr>
                <th>Student Name</th>
                <th>Email</th>
                <th>Select</th>
                <th>Action</th>
            </tr>

            <?php
            $count = 0;
            if (is_array($result) || is_object($result)) {
                foreach ($result as $row) {
                    $count = $count + 1;
                    ?>
                    <tr>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td>
                            <input type="checkbox" name="single_select" class="single_select" data-email="$row['email']"
                            data-name="$row['name']"/>
                        </td>
                        <td>
                            <button type="button" name="email_button" class="btn btn-info btn-xs email_button"
                                    id="'.$count.'" data-email="$row['email']" data-name="$row['name']" data-action="single">Send Single</button></td>

                    </tr>
                    <?php
                }

            }

            ?>
            <tr>
                <td colspan="3"></td>
                <td>
                    <button type="button" name="bulk_email" class="btn btn-info" id="bulk_email" data-action="bulk">Send
                        Bulk
                    </button>
                </td>
            </tr>
        </table>
    </div>


</div>
<script>
    $(document).ready(function () {

        $(".email_button").click(function () {
            $(this).attr('disabled', 'disabled');
            var id = $(this).attr("id");
            var action = $(this).attr("action");
            var email_data = [];
            if (action == 'single') {
                email_data.push({
                    email: $(this).data("email"),
                    name: $(this).data("name")
                });
            } else {
                $('.single_select').each(function ())
                {
                    if ($(this).prop("checked") == true) {
                        email_data.push({
                            email: $(this).data("email"),
                            name: $(this).data("name")
                        });
                    }
                }
            )
                ;
            }
            $.ajax({
                url: "send_reminder.php",
                method: "POST",
                data: {email_data: email_data},
                beforeSend: function () {
                    $('#' + id).html('Sending...');
                    $('#' + id).addClass('btn-danger');
                },
                success: function (data) {
                    if (data == 'ok') {
                        $('#' + id).text('Success');
                        $('#' + id).removeClass('btn-danger');
                        $('#' + id).removeClass('btn-info');
                        $('#' + id).addClass('btn-success');
                    } else {
                        $('#' + id).text(data);
                    }
                    $('#' + id).attr('disabled', false);
                }
            })
        });
    });
</script>