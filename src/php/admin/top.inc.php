<?php
require('connection.inc.php');
require('functions.inc.php');
if(isset($_SESSION['ADMIN_LOGIN']) && $_SESSION['ADMIN_LOGIN']!=''){

}else{
   header('location:login.php');
   die();
}
?>
<!doctype html>
<html class="no-js" lang="">
   <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Admin Dashboard</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="assets/css/normalize.css">
      <link rel="stylesheet" href="assets/css/bootstrap.min.css">
      <link rel="stylesheet" href="assets/css/font-awesome.min.css">
      <link rel="stylesheet" href="assets/css/themify-icons.css">
      <link rel="stylesheet" href="assets/css/pe-icon-7-filled.css">
      <link rel="stylesheet" href="assets/css/flag-icon.min.css">
      <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
      <link rel="stylesheet" href="assets/css/style.css">
      <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
   </head>
   <body>
      <aside id="left-panel" class="left-panel">
         <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
               <ul class="nav navbar-nav">
                  <li class="menu-title">ADMIN MENU</li>
                  <?php if($_SESSION['ADMIN_ROLE']!=1){?>
				   <li class="menu-item-has-children dropdown">
                     <a href="user_management.php" > User Management </a>
                  </li>
				  <li class="menu-item-has-children dropdown">
                     <a href="courses.php" > Courses </a>
                  </li>
				
                  
				  <li class="menu-item-has-children dropdown">
                     <a href="reports.php" > Report Management </a>
                  </li>
				  <li class="menu-item-has-children dropdown">
                     <a href="modules.php" > Modules </a>
                  </li>
                      <li class="menu-item dropdown">
                          <a href="../logout.php" > Logout </a>
                      </li>
				  <?php } ?>
               </ul>
            </div>
         </nav>
      </aside>
      <div id="right-panel" class="right-panel" >
         <header id="header" class="header" style="background-color: #784794;">
             <a class="navbar-brand" href="admin_index.php" style="color: white; font-weight: bold;">Student Engagement</a>
             <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                     aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                 <span class="navbar-toggler-icon"></span>
             </button>

            <div class="top-right">
               <div class="header-menu">
                  <div class="user-area dropdown float-right">
                     <div class="user-menu dropdown-menu">
                        <a class="nav-link" href="../logout.php"><i class="fa fa-power-off"></i>LOGOUT</a>
                     </div>
                  </div>
               </div>
            </div>
         </header>