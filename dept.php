<?php
include("auth.php");
include("template.php");
head("部門管理");
horizontal_bar();
menu($username);

  
function display_form($op,$deptid)
{

    if ($op==3)
    {
      $deptid="";
      $deptname="";
      $managername="";
      $op=4;

    }
    else
    {
      include("connectdb.php");
      $sql = "SELECT deptid,deptname,managername FROM dept where deptid='$deptid'";

      $result =$connect->query($sql);

      // echo $result->fetch_assoc();
      /* fetch associative array */
      if ($row = $result->fetch_assoc()) {
          $deptid=$row['deptid'];
          $deptname=$row['deptname'];
          $managername=$row['managername'];
      }
        $op=2;
    }


    echo "<form action=dept.php method=post>";
    echo "<input type=hidden name=op value=$op>";
    echo "<div class='mb-3'>
            <label for='exampleFormControlInput1' class='form-label'>部門代號</label>
            <input type='text' class='form-control' name=deptid id='deptid' placeholder='請輸入部門代號' value=$deptid>
          </div>
          <div class='mb-3'>
            <label for='exampleFormControlInput1' class='form-label'>部門名稱</label>
            <input type='text' class='form-control' name=deptname id='deptname' placeholder='請輸入部門名稱' value=$deptname>
          </div>
          <div class='mb-3'>
            <label for='exampleFormControlInput1' class='form-label'>主管姓名</label>
            <input type='text' class='form-control' name=managername id='managername' placeholder='請輸入主管姓名' value=$managername>
          </div>";
    echo " <div class='col-auto'>
            <button type='submit' class='btn btn-primary mb-3'>儲存</button>           
            <button type='reset' class='btn btn-primary mb-3'>reset</button>                            
          </div>";
    echo "</form>";

}


if(isset($_REQUEST['op']))
{
  $op=$_REQUEST['op'];   

  
  switch ($op)
  {
    case 1:  //修改
          $deptid=$_REQUEST['deptid']; 
            display_form($op,$deptid);
          break;      
    case 2:  //修改資料
            $deptid=$_REQUEST['deptid'];
          $deptname=$_REQUEST['deptname'];
          $managername=$_REQUEST['managername'];

              $sql="update dept 
                      set deptid='$deptid',
                          deptname='$deptname',
                          managername='$managername'
                    where deptid='$deptid'";
              include("connectdb.php");
              include('dbutil.php');
              execute_sql($sql);
          break;
    case 3: //新增
            $deptid="";
            display_form($op,$deptid);
          break;
    case 4: //新增資料
          $deptid=$_REQUEST['deptid'];
          $deptname=$_REQUEST['deptname'];
          $managername=$_REQUEST['managername'];

          $sql="insert into dept (deptid,deptname,managername) values ('$deptid','$deptname','$managername')";
          include("connectdb.php");
          include('dbutil.php');
          execute_sql($sql);
          break;      
    case 5: //刪除資料              
          $deptid=$_REQUEST['deptid'];              
        
          $sql="delete from dept where deptid='$deptid'";
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
    <a href=dept.php?op=3><button type='button' class='btn btn-success'>新增 <i class='bi bi-alarm'></i></button></a>  </p>
  </div>
  <table class="table">
    <thead>
      <tr>
        <td>部門代號</td>
        <td>部門名稱</td>
        <td>主管姓名</td>  
        <td> edit</td>			
        <td> delete</td>			
      </tr>
    </thead>
    <tbody>

<?php
  include("connectdb.php");
  $sql = "SELECT deptid, deptname, managername FROM dept ORDER BY deptid";

  $result =$connect->query($sql);

  /* fetch associative array */
  while ($row = $result->fetch_assoc()) {
      //printf("%s (%s)\n", $row["Name"], $row["CountryCode"]);
      $deptid=$row['deptid'];
      $deptname=$row['deptname'];
      $managername=$row['managername'];

      echo "<tr><TD>$deptid<td> $deptname<TD>$managername";    
      echo "<TD><a href=dept.php?op=1&deptid=$deptid><button type='button' class='btn btn-primary'>修改 <i class='bi bi-alarm'></i></button></a>";
      echo "<TD><a href=\"javascript:if(confirm('確實要刪除[$deptname]嗎?'))location='dept.php?deptid=$deptid&op=5'\"><button type='button' class='btn btn-danger'>刪除 <i class='bi bi-trash'></i></button>";
  }    
?>


    </tbody>
  </table>
</div>

<script>
	$( ".table" ).DataTable();
</script>

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


