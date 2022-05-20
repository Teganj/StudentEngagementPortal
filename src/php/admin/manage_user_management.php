<?php
require('top.inc.php');
$user_name = '';
$name = '';
$password = '';
$email = '';
$role = '';

$msg = '';
if (isset($_GET['id']) && $_GET['id'] != '') {
    $id = get_safe_value($con, $_GET['id']);
    $res = mysqli_query($con, "select * from users where id='$id'");
    $check = mysqli_num_rows($res);
    if ($check > 0) {
        $row = mysqli_fetch_assoc($res);
        $user_name = $row['user_name'];
        $name = $row['name'];
        $email = $row['email'];
        $password = $row['password'];
        $role = $row['role'];

    } else {
        header('location:user_management.php');
        die();
    }
}

if (isset($_POST['submit'])) {
    $user_name = get_safe_value($con, $_POST['user_name']);
    $name = get_safe_value($con, $_POST['name']);
    $email = get_safe_value($con, $_POST['email']);
    $password = get_safe_value($con, $_POST['password']);
    $role = get_safe_value($con, $_POST['role']);


    $res = mysqli_query($con, "select * from users where user_name='$user_name'");
    $check = mysqli_num_rows($res);
    if ($check > 0) {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            $getData = mysqli_fetch_assoc($res);
            if ($id == $getData['id']) {

            } else {
                $msg = "Username already exist";
            }
        } else {
            $msg = "Username already exist";
        }
    }


    if ($msg == '') {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            $update_sql = "update users set user_name='$user_name', name='$name', password='$password',email='$email',role='$role' where id='$id'";
            mysqli_query($con, $update_sql);
        } else {
            mysqli_query($con, "insert into users(user_name, name, password, email, role, status) values('$user_name', '$name', '$password','$email','$role',1)");
        }
        header('location:user_management.php');
        die();
    }
}
?>
<div class="content pb-0">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><strong>User Management Update</strong><small> </small></div>
                    <form method="post" enctype="multipart/form-data">
                        <div class="card-body card-block">


                            <div class="form-group">
                                <label for="user_name" class=" form-control-label">Username</label>
                                <input type="text" name="user_name" placeholder="Enter username" class="form-control"
                                       required value="<?php echo $user_name ?>">
                            </div>

                            <div class="form-group">
                                <label for="name" class=" form-control-label">Name</label>
                                <input type="text" name="name" placeholder="Enter Name" class="form-control"
                                       required value="<?php echo $name ?>">
                            </div>


                            <div class="form-group">
                                <label for="password" class=" form-control-label">Password</label>
                                <input type="text" name="password" placeholder="Enter password" class="form-control"
                                       required value="<?php echo $password ?>">
                            </div>

                            <div class="form-group">
                                <label for="email" class=" form-control-label">Email</label>
                                <input type="email" name="email" placeholder="Enter email" class="form-control" required
                                       value="<?php echo $email ?>">
                            </div>
                            <div class="form-group">
                                <label for="role" class=" form-control-label">Role</label>
                                <select id="role" name="role" value="<?php echo $role ?>">
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                </select>
                            </div>


                            <button id="payment-button" name="submit" type="submit"
                                    class="btn btn-lg btn-info btn-block">
                                <span id="payment-button-amount">SUBMIT</span>
                            </button>
                            <div class="field_error"><?php echo $msg ?></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
