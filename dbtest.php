<?php

include("connectdb.php");

// $sql="insert into dept (deptid,deptname,managername)
//         values ('Z02','Playing','Mary')" ;

// $sql="update Dept
//         set deptname='Hello'
//         where deptid='Z01'";

// $sql="DELETE from dept
//         where deptid='Z02'";
// execute_sql($sql);

$sql = "SELECT deptid,deptname,managername FROM dept";

$result =$connect->query($sql);

/* fetch associative array */
while ($row = $result->fetch_assoc()) {
    //printf("%s (%s)\n", $row["Name"], $row["CountryCode"]);
    $deptid=$row['deptid'];
    $deptname=$row['deptname'];
    $managername=$row['managername'];

    echo "$deptid  $deptname  $managername";
    echo "<BR>";
}




?>