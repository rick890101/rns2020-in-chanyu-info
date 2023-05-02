<?php
    setcookie("StaffAccount", "", time()-3600);
    setcookie("StaffPassword", "", time()-3600);
    setcookie("StaffID", "", time()-3600);
    header("Location: ./index.php?eid=900"); 
    exit;
?>