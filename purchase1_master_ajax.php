<?php
    $sql = "SELECT purchaseorder.seq, purchaseorder.purchaseid, employee.empname, supplier.suppliername, purchaseorder.purchasedate, sum(purchasedetail.Qty * purchasedetail.PurchasePrice) AS total
            FROM purchaseorder, supplier, employee, purchasedetail
            WHERE purchaseorder.supplierid = supplier.supplierid
            AND purchaseorder.EmpId = employee.EmpId
            AND purchaseorder.PurchaseId = purchasedetail.PurchaseId
            GROUP BY purchaseorder.purchaseid";
            
    include("connectdb.php");
    $result =$connect->query($sql);
    $array = [];
    while ($rows = $result->fetch_assoc()) {
        array_push($rows, "<button type='button' class='btn btn-primary text-white master' name='master' id='" . $rows['purchaseid'] . "'><span class='fa fa-edit'></span> 訂單抬頭</button>");
        array_push($rows, "<button type='button' class='btn btn-warning text-white detail' name='detail' id='" . $rows['purchaseid'] . "'><span class='fa fa-edit'></span> 訂單明細</button>");
        array_push($rows, "<button type='button' class='btn btn-danger text-white delete' name='delete' id='" . $rows['purchaseid'] . "'><span class='fa fa-trash'></span>刪除</button>");
        // $rows = array_values($rows);
        array_push($array, $rows);
    }
    echo json_encode(array('aaData' => $array));
?>
