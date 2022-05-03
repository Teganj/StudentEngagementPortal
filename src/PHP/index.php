<?php 
    session_start();
	include("connection.php");
	include("check_login.php");
    include 'upload.php';

    if(!empty($_GET['status'])){
        switch($_GET['status']){
            case 'succ':
                $statusType = 'Alert-Success';
                $statusMsg = "Report Information has been imported successfully";
                break;
            case 'err':
                $statusType = 'Alert-danger';
                $statusMsg = "Problem occurred, please try again";
                break;
            case 'invalid_file':
                $statusType = 'Alert-danger';
                $statusMsg = "Please upload a csv file.";
                break;
            default:
                $statusType = '';
                $statusMsg = '';
        }
    }
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Student Engagement Portal</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" href="../CSS/upload_style.css">
        <link rel="javascrip" href="../JavaScript/upload.js">
        <link rel="stylesheet" href="../CSS/login_style.css">
        <link rel="stylesheet" href="../CSS/style.css">
        <script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
        <link rel="functions" href="../functions.php">

        <script>
            function formToggle(ID){
                var element = document.getElementById(ID);
                if(element.style.display === "none"){
                    element.style.display = "block";
                }else{
                    element.style.display = "none";
                }
            }
        </script>
    </head>
    <body>
    <?php include 'navbar.php'?>
    <h2>Student Retention Portal</h2>
        <div class="shadow-lg p-3 mb-5 bg-white rounded" style="margin-top: 0px; margin-bottom: 0px; width: 50%; margin: auto;">

            <div class="container">
                <div class="upfrm">
                    <?php if(!empty($statusMsg)){ ?>
                        <p class = "status-msg"><?php echo $statusMsg; ?> </p>
                    <?php } ?>
                    <form action="" method="post" enctype="multipart/form-data">
                        Select File to Upload:
                        <input type="file" name="file">
                        <input type="submit" name="submit" value="Upload">
                    </form>
                </div>
            </div>
        </div>



    <div class="container">

        <h2>List</h2>

        <!-- Display Status Message-->

        <?php if(!empty($statusMsg)){ ?>
        <div class="col-xs-12">
            <div class="alert <?php echo $statusType; ?>"><?php echo $statusMsg; ?></div>
        </div>

        <?php } ?>

        <div class="row">
        <!--Import Link-->
            <div class="col-md-12 head">
                <div class="float-right">
                    <a href="javascript:void(0);" class="btn btn-success" onclick="formToggle('importFrm');"><i class="plus"></i>Import</a>
                </div>
            </div>

            <!-- CSV file Upload -->
            <div class="col-md-12" id="importFrm" style="display: none;">
                <form action="importData.php" method="post" enctype="multipart/form-data">
                    <input type="file" name="file">
                    <input type="submit" class="btn btn-primary" name="importSubmit" value="IMPORT">
                </form>
            </div>

            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                <tr>
                    <th>#ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Week 1</th>
                    <th>Week 2</th>
                    <th>Week 3</th>
                    <th>Week 4</th>
                    <th>Week 5</th>
                    <th>Week 6</th>

                </tr>
                </thead>
                <tbody>
                    <?php
                        $result = $con->query("SELECT * FROM reports ORDER BY id DESC");
                        if($result->num_rows > 0){
                            while($row = $result ->fetch_assoc()){
                            ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['week1']; ?></td>
                                <td><?php echo $row['week2']; ?></td>
                                <td><?php echo $row['week3']; ?></td>
                                <td><?php echo $row['week4']; ?></td>
                                <td><?php echo $row['week5']; ?></td>
                                <td><?php echo $row['week6']; ?></td>
                            </tr>
                                <?php
                            }
                        }else{

                        ?>
                    <tr><td colspan="5">No Member(s)... found</td></tr>
                    <?php
                        }
                        ?>
                </tbody>
            </table>


        </div>
    </div>


        <h2>View Previously Accessed Dashboards</h2>
        <div class="row">
            <div class="column">
                <h3>HDip in Computing - Databases</h3>
                <br>
                <button type="submit">View</button>
                <br>
            </div>
            <div class="column">
                <h3>HDip in Computing - Multimedia</h3>
                <br>
                <button type="submit">View</button>
                <br>
            </div>
            <div class="column">
                <h3>MSC in Cyber - PenTesting</h3>
                <br>
                <button type="submit">View</button>
                <br>
            </div>
        </div>
    </body>
</html>