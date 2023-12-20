<?php
  include('auth.php');
  include('template.php');
  head('進貨管理');
  horizontal_bar();
  menu($username);

?>
<div class="row">
  <div class="card">
    <div class="card-body">
      <div align="right">
        <button type="button" class="btn btn-success text-white" id="AddNew"><span class="fa fa-plus-circle"></span> 新增</button>
      </div>
      <h5 class="card-title"></h5>
      <div class="table-responsive">
        <table id="ListTable" class="table-striped table-bordered dataTable" role="grid" aria-describedby="ListTable_info">
        </table>
      </div>
    </div>
  </div>
</div>

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
<div>
  <div id="MasterModal" class="modal fade">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">*訂單資料管理*</h4>
          <button type="button" class="close btn-link text-white" data-bs-dismiss="modal"><span class="fa fa-window-close"
              style="color:black;"></span></button>
        </div>
        <div class="modal-body">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-2"> </div>
              <div class="col-md-8">
                <div class="card">
                  <form method="post" id="master_form" enctype="multipart/form-data">
                    <div class="modal-content">
                      <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-end control-label col-form-label">序號</label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" id="seq" name="seq" placeholder="序號" value="" readonly="">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-end control-label col-form-label">訂單代號</label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" id="purchaseid" name="purchaseid" placeholder="訂單代號"
                            value="" required="">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-end control-label col-form-label">採購人員代號</label>
                        <div class="col-sm-6">
                          <select class="form-select" aria-label="show empname to get empid"
                            name="empid" id="empid">
                            <option value=""></option>
                            <?php
                              include('connectdb.php');
                              $sql = "SELECT employee.EmpId, employee.EmpName
                                      FROM employee
                                      WHERE employee.JobTitle LIKE '%採購%'";

                              $result =$connect->query($sql);

                              while ($rows = $result -> fetch_array()) {
                                echo "<option value=" . $rows['EmpId'] . ">" . $rows['EmpName'] . "</option>";
                              }
                            ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-end control-label col-form-label">供應商代號</label>
                        <div class="col-sm-6"><select class="form-select" aria-label="show empname to get empid"
                            name="supplierid" id="supplierid">
                            <option value=""></option>
                            <?php
                              include('connectdb.php');
                              $sql = "SELECT supplier.SupplierId, supplier.SupplierName
                                      FROM supplier";

                              $result =$connect->query($sql);
                              
                              while ($rows = $result -> fetch_array()) {
                                echo "<option value=" . $rows['SupplierId'] . ">" . $rows['SupplierName'] . "</option>";
                              }
                            ?>
                          </select></div>
                      </div>
                      <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-end control-label col-form-label">採購日期</label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control mydatepicker" id="purchasedate" name="purchasedate"
                            placeholder="採購日期" value="" required="">
                        </div>
                      </div>

                      <input type="hidden" name="op" id="op">

                      <div class="card-body" align="center">
                        <button type="submit" class="btn btn-info" name="confirm">
                          <span class="fa fa-save"></span>儲存</button>
                        <button type="button" class="btn btn-info close" data-bs-dismiss="modal" name="cancel" "="">
                          <span class=" fa fa-times">放棄</span>
                        </button>
                      </div>

                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="DetailModal" class="modal fade">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">編輯訂單明細</h4>
          <button type="button" class="close btn-link text-white" data-bs-dismiss="modal"><span class="fa fa-window-close"
              style="color:black;"></span></button>
        </div>
        <div class="modal-body">
          <form method="post" id="detail_form" enctype="multipart/form-data">
            <div class="form-group row">
              <label for="fname" class="col-sm-3 text-end control-label col-form-label">產品代號</label>
              <div class="col-sm-6"><select class="form-select" aria-label="show empname to get empid" name="prodid"
                  id="prodid">
                  <option value=""></option>
                  <?php
                    include('connectdb.php');
                    $sql = "SELECT DISTINCT product.ProdName, product.ProdId
                            FROM product";

                    $result =$connect->query($sql);

                    while ($rows = $result -> fetch_array()) {
                      echo "<option value=" . $rows['ProdId'] . ">" . $rows['ProdName'] . "</option>";
                    }
                  ?>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="fname" class="col-sm-3 text-end control-label col-form-label">數量</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" id="qty" name="qty" placeholder="數量" value="" required="">
              </div>
            </div>
            <div class="form-group row">
              <label for="fname" class="col-sm-3 text-end control-label col-form-label">單價</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" id="purchaseprice" name="purchaseprice" placeholder="單價" value=""
                  required="">
              </div>
            </div>
            <input type="hidden" name="purchaseid" id="_purchaseid" value="">
            <input type="hidden" name="seq" id="_seq" value="">
            <input type="hidden" name="op" id="_op" value="">
            <div align="right">
              <button type="submit" class="btn btn-success text-white" id="addnew"><span class="fa fa-plus-circle"></span>
                新增</button>
              <button type="submit" class="btn btn-info" name="confirm" id="modify" disabled=""> <span
                  class="fa fa-save"></span>修改</button>
              <button type="button" class="btn btn-info close" name="cancel" id="cancel" disabled="" "=""><span class=" fa
                fa-times">放棄</span></button>
            </div>
          </form>

          <div class="row">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title"></h5>
                <div class="table-responsive">
                  <table id="detailtable" class="table table-striped table-bordered dataTable" role="grid" aria-describedby="detailtable_info">
                    <thead></thead>
                    <tbody></tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-3" id="totalamt"></div>
      </div>
    </div>
  </div>
  <script>
      $(document).ready(function () {
        var mastertable = $('#ListTable').DataTable({
          'bProcessing': true,
          'bServerSide': false,
          'sAjaxSource': 'purchase1_master_ajax.php', 
          "language": {
              "processing": "處理中...",
              "loadingRecords": "載入中...",
              "lengthMenu": "顯示 _MENU_ 項結果",
              "zeroRecords": "沒有符合的結果",
              "info": "顯示第 _START_ 至 _END_ 項結果，共 _TOTAL_ 項",
              "infoEmpty": "顯示第 0 至 0 項結果，共 0 項",
              "infoFiltered": "(從 _MAX_ 項結果中過濾)",
              "infoPostFix": "",
              "search": "搜尋:",
              "paginate": {
                  "first": "第一頁",
                  "previous": "上一頁",
                  "next": "下一頁",
                  "last": "最後一頁"
              },
              "aria": {
                  "sortAscending": ": 升冪排列",
                  "sortDescending": ": 降冪排列"
              }
          }, 
          "columns": [
            { data: "seq", title: "序號" },
            { data: "purchaseid", title: "採購代號" },
            { data: "empname", title: "採購人員名稱" },
            { data: "suppliername", title: "供應商名稱" },
            { data: "purchasedate", title: "日期" },
            { data: "total", title: "總金額" },
            { data: "0", title: "編輯（Title）"},
            { data: "1", title: "編輯（Detail）" },
            { data: "2", title: "刪除" }
          ]
        });

        var detailtable = $('#detailtable').DataTable({
          'bProcessing': true,
          'bServerSide': false,
          'sAjaxSource': 'purchase1_detail_ajax.php',
          "fnServerParams": function (aoData) {
              aoData.push({ "name": "purchaseid", "value": $('#_purchaseid').val() });
          },
          "language": {
              "processing": "處理中...",
              "loadingRecords": "載入中...",
              "lengthMenu": "顯示 _MENU_ 項結果",
              "zeroRecords": "沒有符合的結果",
              "info": "顯示第 _START_ 至 _END_ 項結果，共 _TOTAL_ 項",
              "infoEmpty": "顯示第 0 至 0 項結果，共 0 項",
              "infoFiltered": "(從 _MAX_ 項結果中過濾)",
              "infoPostFix": "",
              "search": "搜尋:",
              "paginate": {
                  "first": "第一頁",
                  "previous": "上一頁",
                  "next": "下一頁",
                  "last": "最後一頁"
              },
              "aria": {
                  "sortAscending": ": 升冪排列",
                  "sortDescending": ": 降冪排列"
              }
          }, 
          "columns": [
            { data: "ProdName", title: "產品代號" },
            { data: "Qty", title: "數量" },
            { data: "PurchasePrice", title: "單價" },
            { data: "total", title: "總價" },
            { data: "0", title: "Edit" },
            { data: "1", title: "Delete" }
          ]
        });

        $(document).on('click', '.master', function () {
            var purchaseid = $(this).attr('id');
            console.log('master form function purchaseid=' + purchaseid);
            $.ajax({
                url: 'purchase1_ajax.php',
                method: 'POST',
                data: {
                    purchaseid: purchaseid,
                    op: 1
                },
                dataType: 'json',
                success: function (data) {
                    $('#MasterModal').modal('show');
                    $('#master_form')[0].reset();
                    $('#seq').attr("readonly", " readonly");
                    $('#purchaseid').attr("readonly", " readonly");
                    $('#seq').val(data.seq);
                    $('#purchaseid').val(data.purchaseid);
                    $('#empid').val(data.empid);
                    $('#supplierid').val(data.supplierid);
                    $('#purchasedate').val(data.purchasedate);
                    $('.modal-title').text('Edit Purchase Order');
                    $('#op').val('2');
                }
            })
        });

        $(document).on('click', '.detail', function () {
            var purchaseid = $(this).attr('id');
            console.log('detail form function purchaseid=' + purchaseid);
            $('#DetailModal').modal('show');
            $('#detail_form')[0].reset();
            $('.modal-title').text('編輯訂單明細');
            $('#_purchaseid').val(purchaseid); //Hidden 欄位
            detailtable.ajax.reload(null, false);
            //$('#op').val('2');
            $.ajax({
                url: 'purchase1_ajax.php',
                method: 'POST',
                data: {
                    op: 15,
                    purchaseid: purchaseid
                },
                dataType: 'json',
                success: function (data) {
                  console.log(123);
                  $('#detail_form')[0].reset();
                  $('#totalamt').html('訂單總金額: <font color=red>' + data.total + '</font>元');
                  $('#_op').val('13'); //訂單明細進入修改狀態
                  detailtable.ajax.reload(null, false);
                }
            })
        });

        //Detail Form update
        $(document).on('click', '._update', function () {
            var seq = $(this).attr('id');
            console.log('detail form update function seq=' + seq);

            $('#detail_form')[0].reset();
            $('.modal-title').text('修改訂單明細');
            $('#_seq').val(seq);
            $.ajax({
              url: 'purchase1_ajax.php',
              method: 'POST',
              data: {
                  op: 11,
                  seq: seq
              },
              dataType: 'json',
              success: function (data) {
                $('#detail_form')[0].reset();
                $('#seq').val(data.seq);
                $('#_purchaseid').val(data.purchaseid);
                $('#prodid').val(data.prodid);
                $('#qty').val(data.qty);
                $('#purchaseprice').val(data.purchaseprice);
                $('#modify').removeAttr("disabled");
                $('#cancel').removeAttr("disabled");
                $('#addnew').attr("disabled", "disabled");
                $('#_op').val('12'); //進入修改狀態
              }
            })
            //$('#op').val('2');
        });

        //點下刪除明細
        $(document).on('click', '._delete', function () {
            var seq = $(this).attr('id');
            if (confirm("確定要刪除?" + seq)) {
                console.log('detail form update function seq=' + seq);

                $('#detail_form')[0].reset();
                $('.modal-title').text('刪除訂單明細');
                //$('#_seq').val(seq);
                $.ajax({
                    url: 'purchase1_ajax.php',
                    method: 'POST',
                    data: {
                        op: 14,
                        seq: seq
                    },
                    dataType: 'json',
                    success: function (data) {
                        $('#detail_form')[0].reset();
                        $('#_op').val('13'); //訂單明細進入修改狀態
                        detailtable.ajax.reload(null, false);
                    }
                })
            }
        });

        // $(document).on('click', '#addnew', function(){

        // console.log('add new to order detail');
        // //$('#seq').removeAttr("readOnly");
        // $('#cancel').removeAttr("disabled");
        // $('#modify').attr("disabled","disabled");
        // $('.modal-title').text('新增訂單明細');
        // $('#detail_form')[0].reset();
        // $('#op').val('3');

        // });

        //刪除訂單
        $(document).on('click', '.delete', function () {
            var purchaseid = $(this).attr('id');
            if (confirm("確定要刪除編號(" + purchaseid + ")的訂單?")) {
                console.log('detail form update function seq=' + seq);

                $('#master_form')[0].reset();
                $('.modal-title').text('刪除訂單');
                //$('#seq').val(seq);
                $.ajax({
                    url: 'purchase1_ajax.php',
                    method: 'POST',
                    data: {
                        op: 4,
                        purchaseid: purchaseid
                    },
                    dataType: 'json',
                    success: function (data) {
                      $('#master_form')[0].reset();
                      mastertable.ajax.reload(null, false);
                    }
                })
            }
        });

        $(document).on('click', '#AddNew', function () {

            console.log('insert function');
            //$('#seq').removeAttr("readOnly");
            $('#purchaseid').removeAttr("readOnly");
            $('.modal-title').text('新增訂單');
            $('#master_form')[0].reset();

            $.ajax({
                url: 'purchase1_ajax.php',
                method: 'POST',
                data: { op: 6 },
                dataType: 'json',
                success: function (data) {
                    $('#MasterModal').modal('show');
                    $('#master_form')[0].reset();
                    $('#seq').val(data.seq);
                    $('#purchaseid').val(data.purchaseid);
                    //$('#purchasedate').val(data.purchasedate);
                    $('#op').val('3');
                }
            })
        });

        $(document).on('click', '#cancel', function () {

            console.log('cancel current operation');

            $('#addnew').removeAttr("disabled");
            $('#modify').attr("disabled", "disabled");
            $('#cancel').attr("disabled", "disabled");
            $('#_op').val('13');
            $('#detail_form')[0].reset();
            detailtable.ajax.reload(null, false);

        });

        $(document).on('submit', '#master_form', function (event) {
            event.preventDefault();
            var seq = $('#seq').val();
            var purchaseid = $('#purchaseid').val();
            var purchasedate = $('#purchasedate').val();

            if (seq != '' && purchaseid != '') {
                console.log("master data transaction=" + purchaseid + "seq=" + seq);

                $('#seq').focus();
                $.ajax({
                    url: "purchase1_ajax.php",
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'JSON', 
                    success: function (data) {
                        console.log("update purchaseorder data success!! ok=" + data.op);
                        if (op == 2)
                            $('#master_form')[0].reset();
                        else $('#MasterModal').modal('hide');
                        mastertable.ajax.reload(null, false);

                    }
                });
            }
            else {
                alert("姓名, 部門代號為必要欄位!");
            }
        });

        $(document).on('submit', '#detail_form', function (event) {
            event.preventDefault();
            var purchaseid = $('#_purchaseid').val();
            var seq = $('#_seq').val();

            console.log("detail data transaction" + purchaseid);

            if (_seq != '') {
                $.ajax({
                    url: "purchase1_ajax.php",
                    method: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    dataType: 'JSON', 
                    success: function (data) {
                      console.log("update purchaseorder data success!! ok=" + data.op);
                      $('#detail_form')[0].reset();

                      $('#addnew').removeAttr("disabled");
                      $('#modify').attr("disabled", "disabled");
                      $('#cancel').attr("disabled", "disabled");

                      $('#_op').val('13');
                      detailtable.ajax.reload(null, false);
                      $('#totalamt').html('訂單總金額: <font color=red>' + data.total + '</font>元');

                    }
                });
            }
            else {
                alert("姓名, 部門代號為必要欄位!");
            }
        });

        $('#DetailModal').on('hide.bs.modal', function (e) {
            console.log("hide bs modal");
            mastertable.ajax.reload(null, false);
        });

        $('#DetailModal').on('show.bs.modal', function (e) {
            console.log("show bs modal");
            mastertable.ajax.reload(null, false);
        });
      });
    </script>
</div>

