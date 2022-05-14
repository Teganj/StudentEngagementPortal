<?php
function check_uploads($con)
{
    if (isset($_SESSION['user_id'])) {
        $id = $_SESSION['user_id'];
        $query = "select * from uploads where id = '$id' limit 1";

        $result = mysqli_query($con, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
            $result = mysqli_query($con, $query);

            $_SESSION['$file_name'] = $row['file_name'];
            $_SESSION['$uploaded_on'] = $row['uploaded_on'];

        }
        }
    die;
}
?>