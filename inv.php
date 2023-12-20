<?php
    include('auth.php');
    include('template.php');
    head('存貨管理');
    horizontal_bar();
    menu($username);

    function display_form($op, $prodid) {
        if ($op == 3) {
            $prodid = '';
            $stock = '';
            $safestock = '';
            $op = 4;

        } else {
            include('connectdb.php');
            $sql = 'SELECT prodid, stock, safestock FROM inv';
            $result = $connect -> query($sql);

            if ($row = $result -> fetch_assoc()) {
                $prodid = $row['prodid'];
                $stock = $row['stock'];
                $safestock = $row['safestock'];
            }
            $op = 2;
        }
        echo "<form action=salesorder.php method=post>";
        echo "<input type=hidden name=op value=$op>";
        echo "
            <div class='mb-3'>
                <label for='exampleFormControlInput1' class='form-label'>訂單代號</label>
                <input type='text' class='form-control' name=prodid id='prodid' placeholder='請輸入訂單代號' value=$prodid>
            </div>
            <div class='mb-3'>
                <label for='exampleFormControlInput1' class='form-label'>員工代號</label>
                <input type='text' class='form-control' name=empid id='empid' placeholder='請輸入員工代號' value=$empid>
            </div>
            <div class='mb-3'>
                <label for='exampleFormControlInput1' class='form-label'>供應商代號</label>
                <input type='text' class='form-control' name=custid id='custid' placeholder='請輸入供應商代號' value=$custid>
            </div>
            <div class='mb-3'>
                <label for='exampleFormControlInput1' class='form-label'>訂單日期</label>
                <input type='text' class='form-control' name=orderdate id='orderdate' placeholder='請輸入訂單日期' value=$orderdate>
            </div>
            <div class='mb-3'>
                <label for='exampleFormControlInput1' class='form-label'>備註</label>
                <input type='text' class='form-control' name=descript id='descript' placeholder='請輸入備註' value=$descript>
            </div>";
        echo " 
            <div class='col-auto'>
                <button type='submit' class='btn btn-primary mb-3'>儲存</button>           
                <button type='reset' class='btn btn-primary mb-3'>reset</button>                            
            </div>";
        echo "</form>";
        
    }

    if (isset($_REQUEST['op'])) {
        $op=$_REQUEST['op'];   

        switch ($op)
        {
            case 1:  //修改
                $prodid = $_REQUEST['prodid']; 
                display_form($op, $prodid);
                break;

            case 2:  //修改資料
                $prodid = $row['prodid'];
                $stock = $row['stock'];
                $safestock = $row['safestock'];

                $sql = "UPDATE salesorder 
                    SET stock='$stock',
                    safestock='$safestock',
                    WHERE prodid='$prodid'";

                include("connectdb.php");
                include('dbutil.php');
                execute_sql($sql);
                break;

            case 3: //新增
                $prodid="";
                display_form($op, $prodid);
                break;

            case 4: //新增資料
                $prodid = $row['prodid'];
                $stock = $row['stock'];
                $safestock = $row['safestock'];
                
                $sql = "INSERT INTO inv (ProdId, Stock, SafeStock) VALUES ('$prodid', '$stock', '$safestock')";
                include("connectdb.php");
                include('dbutil.php');
                execute_sql($sql);
                break;

            case 5: //刪除資料              
                $prodid = $_REQUEST['prodid'];              
                
                $sql = "DELETE FROM inv WHERE prodid='$prodid'";
                include("connectdb.php");
                include('dbutil.php');
                execute_sql($sql);
                break;
        }     
    }
?>

<div class="card">
    <div class="card-body">
        <p align=right>
            <a href=inv.php?op=3><button type='button' class='btn btn-success'>新增<i class='bi bi-alarm'></i></button></a>
        </p>
    </div>
    <table class="table">
        <thead>
            <tr>
                <td>產品代號</td>
                <td>產品庫存</td>
                <td>安全庫存</td>  
                <td>edit</td>			
                <td>delete</td>			
            </tr>

<?php
    include("connectdb.php");
    $sql = 'SELECT inv.prodid, product.prodname, inv.stock, inv.safestock FROM inv, product WHERE inv.ProdId = product.ProdID';

    $result =$connect->query($sql);

    /* fetch associative array */
    while ($row = $result->fetch_assoc()) {
        $prodid = $row['prodid'];
        $stock = $row['stock'];
        $safestock = $row['safestock'];
        $prodname = $row['prodname'];
        
        echo "
            <tr>
                <td>$prodid</td><td>$stock</td><td>$safestock</td>
                <td><a href=inv.php?op=1&prodid=$prodid><button type='button' class='btn btn-primary'>修改 <i class='bi bi-alarm'></i></button></td>
                <td><a href=\"javascript:if(confirm('確實要刪除[$prodname]嗎?'))location='inv.php?prodid=$prodid&op=5'\"><button type='button' class='btn btn-danger'>刪除 <i class='bi bi-trash'></i></button></td>
            </tr>";
    }
?>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<?php
    footer();
?>