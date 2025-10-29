<?php

$con=mysqli_connect("localhost","root","","kevinscollection");
if(!$con){
//     echo"connection success";
// }else{
    die(mysqli_error($con));
}
