<?php 
    session_start();
	include("connection.php");
	include("functions.php");

    $statusMsg = '';

    //File upload Dir
    $targetDir = "../uploads/";

    if(isset($_POST["submit"])){
        if(!empty($_FILES["file"]["name"])){
            $fileName = basename($_FILES["file"]["name"]);
            $targetFilePath = $targetDir . $fileName;
            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

            //Only allow certain file types
            $allowTypes = array('csv', 'xlsx');
            if(in_array($fileType, $allowTypes)){
                //Uploading file to server
                if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
                    //Insert file to DB
                    $insert = $con->query("Insert into files (file_name, uploaded_on) values('".$fileName."', NOW())");
                    if($insert){
                        $statusMsg = "The file ".$fileName. " has been uploaded successfully.";
                    }else{
                        $statusMsg = "File upload failed, please try again.";
                    }
                }else{
                    $statusMsg = "Sorry, there was an error uploading your file.";
                }
            }else{
                $statusMsg = "Sorry, only CSV XLSX files are allowed up be uploaded.";
            }
        }else{
            $statusMsg = "Please select a file to upload.";
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
    </head>
    <body>
    <?php include 'navbar.php'?>
    <h2>Student Retention Portal</h2>
        <div class="shadow-lg p-3 mb-5 bg-white rounded" style="margin-top: 0px; margin-bottom: 0px; width: 50%; margin: auto;">

            <div class="container">
                <div class="upfrm">
                    <?php if(!empty($statusMsg)){ ?>
                        <p class = "status-msg><?php echo $statusMsg; ?> </p>"
                    <?php } ?>
                    <form action="" method="post" enctype="multipart/form-data">
                        Select File to Upload:
                        <input type="file" name="file">
                        <input type="submit" name="submit" value="Upload">
                    </form>
                </div>

                <div class="gallery">
                    <div class="gcon">
                        <h2>Uploaded File</h2>
                        <?php
                        include 'connection.php';
                        $query = $con->query("SELECT * FROM files ORDER BY uploaded_on DESC");

                        if($query->num_rows >0){
                            while($row = $query->fetch_assoc()){
                                $fileURL = 'uploaded/'.$row["file_name"];
                        ?>
                        <img scr="<?php echo $fileURL; ?>" alt""/>
                        <?php }
                            }else{
                            ?>
                        <p>No Files Found...
                            <?php
                        }
                        ?>
                    </div>
                </div>


            </div>
<!--            <form class="modal-content" action="dashboard.php" method="post" style="margin-bottom: 20px; margin-top: 20px;">-->
<!--                <div class="container">-->
<!--                    <h4>Select file to upload:</h4>-->
<!--                    <br>-->
<!--                    <input type="file" id="actual-btn" hidden/>-->
<!--                    <input type="file" name="fileToUpload" id="fileToUpload">-->
<!--                    <br><br><br>-->
<!--                    <input type="submit" value="Submit" name="submit" id="submitbtnupload">-->
<!--                </div>-->
<!--            </form>-->
        </div>



    <div class="container">

        <h2>List</h2>

        <div class="row">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                <tr>
                    <th>#ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Week 1 Lesson</th>
                    <th>Week 1 Lab</th>
                    <th>Week 2 Lesson</th>
                    <th>Week 2 Lab</th>
                    <th>Week 3 Lesson</th>
                    <th>Week 3 Lab</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                        $result = $db->query("SELECT * FROM members ORDER BY id DESC");
                        if($result->num_rows > 0){
                            while($row = $result ->fetch_assoc()){
                            ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['week1lesson']; ?></td>
                                <td><?php echo $row['week1lab']; ?></td>
                                <td><?php echo $row['week2lesson']; ?></td>
                                <td><?php echo $row['week2lab']; ?></td>
                                <td><?php echo $row['week3lesson']; ?></td>
                                <td><?php echo $row['week3lab']; ?></td>

                            </tr>
                                <?php
                            }
                        }else{

                        ?>
                    <tr><td colspan="5">No Members... found</td></tr>
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