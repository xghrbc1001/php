<?php
unset($_SESSION['username']); 
unset($_SESSION['userid']); 
header("Location:login.html");
?> 
