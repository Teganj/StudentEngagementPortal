<?php

if($prevResult-> num_rows > 0){
    //Updating member data
    $con->query("UPDATE reports SET name = '".$name."'");
}