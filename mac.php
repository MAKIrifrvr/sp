<!DOCTYPE html>
<html>
<body>
UPDATE `clients` SET `rates`='monthly',`date_of_promos`='2017-03-18' WHERE `username`='z'
UPDATE `clients` SET `membership`='member',`date_of_membership`='2016-04-14' WHERE `username`='quiboy'
<?php
date_default_timezone_set("Asia/Manila");
$t = date("H");

if ($t >"10") {
    echo "Have a good day!";
} else {
    echo "Have a good night!";
}
?>
 
</body>
</html>