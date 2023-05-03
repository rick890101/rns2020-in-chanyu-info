<?php
    setcookie("StaffAccount", "", time()-99900, "/");
    setcookie("StaffPassword", "", time()-99900, "/");
    setcookie("StaffID", "", time()-3600);
    header("Location: ./index.php?eid=900"); 
    exit;
?>