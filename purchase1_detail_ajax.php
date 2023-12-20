<?php
    $purchaseid = $_REQUEST['purchaseid'];
    $sql = "SELECT purchasedetail.seq, product.ProdName, purchasedetail.Qty, purchasedetail.PurchasePrice, purchasedetail.Qty * purchasedetail.PurchasePrice AS total
            FROM product, purchasedetail
            WHERE product.ProdID = purchasedetail.ProdId
            AND purchasedetail.PurchaseId = '$purchaseid'";

    include("connectdb.php");
    $result =$connect->query($sql);
    $array = array();
    while ($rows = $result->fetch_assoc()) {
        array_push($rows, "<button type='button' class='btn btn-link text-white _update' name='_update' id='" . $rows['seq'] . "'><span class='fa fa-edit' style='color:rgb(0,0, 188);'></span> </button>");
        array_push($rows, "<button type='button' class='btn btn-link text-white _delete' name='_delete' id='" . $rows['seq'] . "'><span class='fa fa-trash' style='color:rgb(188,0, 0);'></span></button>");
        
        array_push($array, $rows);
    }
    echo json_encode(array('aaData' => $array));
?>