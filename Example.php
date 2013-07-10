<?php

$con = mysqli_connect('localhost', 'root', '', 'timecheck');

$uid =1;
/*mysqli_query($con, "
INSERT INTO start_class (uid, date_created)
SELECT $uid, current_timestamp
FROM start_class
WHERE NOT EXISTS (
        SELECT id
        FROM start_class
        WHERE uid = 1
   )
   OR (
         uid = 1
        AND date_created   < current_timestamp - 1*60
   )
LIMIT 1

") or die( mysqli_error($con));*/

$sql =  mysqli_query($con,
	"SELECT 
	*
	  FROM start_class WHERE uid=2 and DATE_SUB(NOW(), INTERVAL 1 MINUTE) < DATE_ADD(date_created, INTERVAL 1 MINUTE)"
);
$check = mysqli_fetch_array( $sql) or die( mysqli_error($con));
 
$row = mysqli_num_rows( $sql) ;

print_r($check);

if( $row )
{
	echo $check['uid'];
}
else {
	mysqli_query($con, "INSERT INTO start_class VALUES('', 1, NOW() ) ") or die( mysqli_error($con));
	//
}