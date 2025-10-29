<?php
session_start();
session_unset();
session_destroy();
echo"<script>window.open('./indexatmin.php','_self')</script>";
