<?php

function closedb()
{
    global $connect;
    $connect->close();
}


function execute_sql($sql)
{
    global $connect;

    if ($connect->query($sql) === TRUE) {
        echo "Transaction 成功";
        } else {
        echo "Error: " . $sql . "<br>" . $connect->error;
        }

}


?>