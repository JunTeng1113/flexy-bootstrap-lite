<?php
$op = $_REQUEST['op'];
switch ($op) {
  case 1:
    $purchaseid = $_REQUEST['purchaseid'];
    include('connectdb.php');
    $sql = "SELECT purchaseorder.seq, 
              purchaseorder.purchaseid, 
              purchaseorder.empid, 
              supplier.supplierid, 
              purchaseorder.purchasedate, 
              employee.empname
            FROM purchaseorder, supplier, employee
            WHERE purchaseorder.supplierid = supplier.supplierid
            AND purchaseorder.EmpId = employee.EmpId
            AND purchaseid = '$purchaseid'";
  
    $result =$connect->query($sql);
  
    if ($row = $result -> fetch_assoc()) {
      echo json_encode(array(
        'seq' => $row['seq'],
        'purchaseid' => $row['purchaseid'],
        'empid' => $row['empid'],
        'supplierid' => $row['supplierid'],
        'purchasedate' => $row['purchasedate']
      ));
    }
    break;
  
  case 2:
    $empid = $_REQUEST['empid'];
    $supplierid = $_REQUEST['supplierid'];
    $purchaseid = $_REQUEST['purchaseid'];
    $purchasedate = $_REQUEST['purchasedate'];

    $sql = "UPDATE purchaseorder
            SET purchaseorder.EmpId = '$empid', 
            purchaseorder.SupplierId = '$supplierid',
            purchaseorder.PurchaseDate = '$purchasedate'
            WHERE purchaseorder.PurchaseId = '$purchaseid'";

    include("connectdb.php");
    $result =$connect->query($sql);
    $data = array('op' => $op);
    echo json_encode($data);
    break;

  case 3:
    $purchaseid = $_REQUEST['purchaseid'];
    $empid = $_REQUEST['empid'];
    $supplierid = $_REQUEST['supplierid'];
    $purchasedate = $_REQUEST['purchasedate'];
    $sql = "INSERT INTO purchaseorder (PurchaseId, EmpId, SupplierId, PurchaseDate) 
            VALUES ('$purchaseid', '$empid', '$supplierid', '$purchasedate')";
            
    include("connectdb.php");
    $result =$connect->query($sql);
    $data = array('op' => $op);
    echo json_encode($data);
    break;

  case 6:
    $sql = "SELECT AUTO_INCREMENT AS ai, purchaseorder.PurchaseId+1 AS purchaseid
            FROM INFORMATION_SCHEMA.TABLES, purchaseorder
            WHERE TABLE_NAME = 'purchaseorder'
            ORDER BY purchaseorder.PurchaseId DESC
            LIMIT 0, 1";
            
    include("connectdb.php");
    $result =$connect->query($sql);
    $row = $result -> fetch_assoc();
    $data = array('seq' => $row['ai'],
      'purchaseid' => $row['purchaseid']);
    echo json_encode($data);
    break;

  case 4:
    $seq = $_REQUEST['seq'];
    
    $sql = "DELETE FROM purchaseorder WHERE purchaseid='$purchaseid'";
    include("connectdb.php");
    include('dbutil.php');
    execute_sql($sql);
    break;

  case 11:
    $seq = $_REQUEST['seq'];              
    
    $sql = "SELECT purchasedetail.seq, purchasedetail.PurchaseId, purchasedetail.ProdId, purchasedetail.Qty, purchasedetail.PurchasePrice
            FROM purchasedetail
            WHERE purchasedetail.seq = '$seq'";
    include("connectdb.php");
    $result =$connect->query($sql);
    $row = $result -> fetch_assoc();
    $row = array('seq' => $row['seq'],
          'purchaseid' => $row['PurchaseId'], 
          'prodid' => $row['ProdId'],
          'qty' => $row['Qty'], 
          'purchaseprice' => $row['PurchasePrice']);
    echo json_encode($row);
    break;

  case 12:
    $ProdId = $_REQUEST['prodid'];
    $Qty = $_REQUEST['qty'];
    $PurchasePrice = $_REQUEST['purchaseprice'];
    $seq = $_REQUEST['seq'];
    $sql = "UPDATE purchasedetail
            SET purchasedetail.ProdId = '$ProdId', 
            purchasedetail.Qty = '$Qty', 
            purchasedetail.PurchasePrice = '$PurchasePrice' 
            WHERE purchasedetail.seq = '$seq'";
    include('connectdb.php');
    $result =$connect->query($sql);
    $data = array('op' => $op);
    echo json_encode($data);
    break;
  
  case 13:
    $purchaseid = $_REQUEST['purchaseid'];
    $prodid = $_REQUEST['prodid'];
    $qty = $_REQUEST['qty'];
    $purchaseprice = $_REQUEST['purchaseprice'];
    $sql = "INSERT INTO purchasedetail (PurchaseId, ProdId, Qty, PurchasePrice) 
            VALUES ('$purchaseid', '$prodid', '$qty', '$purchaseprice')";
            
    include("connectdb.php");
    $result =$connect->query($sql);
    echo $op;
    break;

  case 14:
    $seq = $_REQUEST['seq'];
    
    $sql = "DELETE FROM purchasedetail WHERE purchasedetail.seq = '$seq'";
    include("connectdb.php");
    include('dbutil.php');
    execute_sql($sql);
    break;

  case 15:
    $purchaseid = $_REQUEST['purchaseid'];
    $sql = "SELECT purchasedetail.PurchaseId, product.ProdName, purchasedetail.Qty, purchasedetail.PurchasePrice, SUM(purchasedetail.Qty * purchasedetail.PurchasePrice) AS total
            FROM purchasedetail, product
            WHERE purchasedetail.ProdId = product.ProdID
            AND purchasedetail.PurchaseId = '$purchaseid'
            GROUP BY purchasedetail.PurchaseId";
  
    include('connectdb.php');
    $result =$connect->query($sql);
    
    if ($row = $result -> fetch_assoc()) {
      echo json_encode($row);
    }
    break;
  default:
    # code...
    break;
}

// if ($op == 3) {
//   $seq = '';
//   $purchaseid = '';
//   $empname = '';
//   $suppliername = '';
//   $purchasedate = '';
//   $op = 4;

// } else {
//   include('connectdb.php');
//   $sql = "SELECT purchaseorder.seq, 
//             purchaseorder.purchaseid, 
//             purchaseorder.empid, 
//             supplier.suppliername, 
//             purchaseorder.purchasedate, 
//             employee.empname
//           FROM purchaseorder, supplier, employee
//           WHERE purchaseorder.supplierid = supplier.supplierid
//           AND purchaseorder.EmpId = employee.EmpId
//           AND purchaseid = '$purchaseid'";

//   $result =$connect->query($sql);

//   if ($row = $result -> fetch_assoc()) {
//     $seq = $row['seq'];
//     $purchaseid = $row['purchaseid'];
//     $empname = $row['empname'];
//     $suppliername = $row['suppliername'];
//     $purchasedate = $row['purchasedate'];
//   }
//   $op = 2;
// }
?>