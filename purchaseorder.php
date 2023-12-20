<?php
    include('auth.php');
    include('template.php');
    head('進貨管理');
    horizontal_bar();
    menu($username);

    function display_form($op, $purchaseid) {
        if ($op == 3) {
            $purchaseid = '';
            $empid = '';
            $supplierid = '';
            $op = 4;

        } else {
            include('connectdb.php');
            $sql = 'SELECT purchaseid, empid, supplierid FROM purchaseorder';
            $result = $connect -> query($sql);

            if ($row = $result -> fetch_assoc()) {
                $purchaseid = $row['purchaseid'];
                $empid = $row['empid'];
                $supplierid = $row['supplierid'];
            }
            $op = 2;
        }
        echo "<form action=salesorder.php method=post>";
        echo "<input type=hidden name=op value=$op>";
        echo "
            <div class='mb-3'>
                <label for='exampleFormControlInput1' class='form-label'>訂單代號</label>
                <input type='text' class='form-control' name=purchaseid id='purchaseid' placeholder='請輸入訂單代號' value=$purchaseid>
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
                $purchaseid = $_REQUEST['purchaseid']; 
                display_form($op, $purchaseid);
                break;

            case 2:  //修改資料
                $purchaseid = $row['purchaseid'];
                $empid = $row['empid'];
                $supplierid = $row['supplierid'];

                $sql = "UPDATE salesorder 
                    SET empid='$empid',
                    supplierid='$supplierid',
                    WHERE purchaseid='$purchaseid'";

                include("connectdb.php");
                include('dbutil.php');
                execute_sql($sql);
                break;

            case 3: //新增
                $purchaseid="";
                display_form($op, $purchaseid);
                break;

            case 4: //新增資料
                $purchaseid = $row['purchaseid'];
                $empid = $row['empid'];
                $supplierid = $row['supplierid'];
                
                $sql = "INSERT INTO purchaseorder (purchaseid, empid, supplierid) VALUES ('$purchaseid', '$empid', '$supplierid')";
                include("connectdb.php");
                include('dbutil.php');
                execute_sql($sql);
                break;

            case 5: //刪除資料              
                $purchaseid = $_REQUEST['purchaseid'];              
                
                $sql = "DELETE FROM purchaseorder WHERE purchaseid='$purchaseid'";
                include("connectdb.php");
                include('dbutil.php');
                execute_sql($sql);
                break;
        }     
    }
?>
<div class="row">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title"></h5>
      <div class="table-responsive">
        <table id="zero_config" class="table table-striped table-bordered dataTable" role="grid" aria-describedby="zero_config_info">
          <thead>
            <tr role="row">
              <th scope="col">採購代號</th>
              <th scope="col">員工名稱</th>
              <th scope="col">供應商名稱</th>
              <th scope="col">日期</th>
              <th scope="col">edit</th>
              <th scope="col">delete</th>
            </tr>
          </thead>
          <tbody>
            <?php
              include("connectdb.php");
              $sql = 'SELECT purchaseorder.purchaseid, purchaseorder.empid, supplier.suppliername, purchaseorder.purchasedate, employee.empname
                      FROM purchaseorder, supplier, employee
                      WHERE purchaseorder.supplierid = supplier.supplierid
                      AND purchaseorder.EmpId = employee.EmpId';

              $result =$connect->query($sql);

              /* fetch associative array */
              while ($row = $result->fetch_assoc()) {
                  //printf("%s (%s)\n", $row["Name"], $row["CountryCode"]);
                $purchaseid = $row['purchaseid'];
                $suppliername = $row['suppliername'];
                $purchasedate = $row['purchasedate'];
                $empname = $row['empname'];

                echo "
                <tr>
                    <td>$purchaseid</td><td>$empname</td><td>$suppliername</td><td>$purchasedate</td>
                    <td><a href=purchaseorder.php?op=1&purchaseid=$purchaseid><button type='button' class='btn btn-primary'>修改 <i class='bi bi-alarm'></i></button></td>
                    <td><a href=\"javascript:if(confirm('確實要刪除[$purchaseid]嗎?'))location='purchaseorder.php?purchaseid=$purchaseid&op=5'\"><button type='button' class='btn btn-danger'>刪除 <i class='bi bi-trash'></i></button></td>
                </tr>";
              }    
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script>$(".table").DataTable();</script>

<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
-->
<?php
footer();
?>