<?php
include("auth.php");
include("template.php");
head("進銷存系統");
horizontal_bar();
menu($username);

?>

<div class="row">
  <div class="col-sm-12">
    <table cellpadding="0" cellspacing="0" border="0" id="ListTable"
      class="table table-striped table-bordered dataTable" role="grid" aria-describedby="ListTable_info"
      style="width: 936px;">
      <thead>
      </thead>
      <tbody>
      </tbody>
      <tfoot>
        <tr>
          <th rowspan="1" colspan="1"><b>Seq</b></th>
          <th rowspan="1" colspan="1"><b>訂單編號</b></th>
          <th rowspan="1" colspan="1"><b>採購人員</b></th>
          <th rowspan="1" colspan="1"><b>供應商名稱</b></th>
          <th rowspan="1" colspan="1"><b>採購日期</b></th>
          <th rowspan="1" colspan="1"><b>總金額</b></th>
          <th rowspan="1" colspan="1"><b>編輯(抬頭)</b></th>
          <th rowspan="1" colspan="1"><b>編輯(明細)</b></th>
          <th rowspan="1" colspan="1"><b>刪除</b></th>
        </tr>
      </tfoot>
    </table>
    <div id="ListTable_processing" class="dataTables_processing card" style="display: none;">Processing...</div>
  </div>
</div>






<?php
footer();
?>




<div>
  <div id="DetailModal" class="modal fade">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">*訂單明細管理*</h4>
          <button type="button" class="close btn-link text-white" data-bs-dismiss="modal"><span
              class="fa fa-window-close" style="color:black;"></span></button>
        </div>
        <div class="modal-body">
          <form method="post" id="detail_form" enctype="multipart/form-data">
            <div class="form-group row">
              <label for="fname" class="col-sm-3 text-end control-label col-form-label">產品代號</label>
              <div class="col-sm-6"><select class="form-select" aria-label="show empname to get empid" name="prodid"
                  id="prodid">
                  <option value=""></option>
                  <option value=""></option>
                  <option value="EIDE1RP">EnhanceIDE PCI BUS</option>
                  <option value="EIDE2RP">EnhanceIDE VL BUS</option>
                  <option value="MB486P3R16">486主機板PCI slot *3 16MB RAM</option>
                  <option value="MB486P3R32">486主機板PCI slot *3 32MB RAM</option>
                  <option value="MB486V3R16">486主機板VL slot *3 16MB RAM</option>
                  <option value="MB486V3R32">486主機板VL slot *3 32MB RAM</option>
                  <option value="MB586E3R16">586主機板EISA slot *3 16MB RAM</option>
                  <option value="MB586E3R32">586主機板EISA slot *3 32MB RAM</option>
                  <option value="MB586E7R16">586主機板EISA slot *7 16MB RAM</option>
                  <option value="MB586E7R32">586主機板EISA slot *7 32MB RAM</option>
                  <option value="MB586P3R16">586主機板PCI slot *3 16MB RAM</option>
                  <option value="MB586P3R32">585主機板PCI slot *3 32MB RAM</option>
                  <option value="MB586V3R16">586主機板VL slot *3 16MB RAM</option>
                  <option value="MB586V3R32">586主機板VL slot *3 32MB RAM</option>
                  <option value="SCSIPB">SCSIcard PCI BUS</option>
                  <option value="SCSIVB">SCSIcard VL BUS</option>
                  <option value="SVGAP1M">SuperVGA 1280*1024 PCI BUS 1MB</option>
                  <option value="SVGAP2M">SuperVGA 1280*1024 PCI BUS 2MB</option>
                  <option value="SVGAV1M">SuperVGA 1280*1024 VL BUS 1MB</option>
                  <option value="SVGAV2M">SuperVGA 1280*1024 VL BUS 2MB</option>
                </select></div>
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
                <input type="text" class="form-control" id="purchaseprice" name="purchaseprice" placeholder="單價"
                  value="" required="">
              </div>
            </div>
            <input type="hidden" name="purchaseid" id="_purchaseid" value="1">
            <input type="hidden" name="seq" id="_seq" value="1">
            <input type="hidden" name="op" id="_op" value="13">
            <div align="right">
              <button type="submit" class="btn btn-success text-white" id="addnew"><span
                  class="fa fa-plus-circle"></span> 新增</button>
              <button type="submit" class="btn btn-info" name="confirm" id="modify" disabled=""> <span
                  class="fa fa-save"></span>修改</button>
              <button type="button" class="btn btn-info close" name="cancel" id="cancel" disabled="" "=""><span class="
                fa fa-times">放棄</span></button>



            </div>
          </form>
          <div id="detailtable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
            <div class="row">
              <div class="col-sm-12 col-md-6">
                <div class="dataTables_length" id="detailtable_length"><label>Show <select name="detailtable_length"
                      aria-controls="detailtable" class="form-control form-control-sm">
                      <option value="10">10</option>
                      <option value="25">25</option>
                      <option value="50">50</option>
                      <option value="100">100</option>
                    </select> entries</label></div>
              </div>
              <div class="col-sm-12 col-md-6">
                <div id="detailtable_filter" class="dataTables_filter"><label>Search:<input type="search"
                      class="form-control form-control-sm" placeholder="" aria-controls="detailtable"></label></div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <table cellpadding="0" width="100%" cellspacing="0" border="0" id="detailtable"
                  class="table table-striped table-bordered dataTable no-footer" role="grid"
                  aria-describedby="detailtable_info" style="width: 100%;">
                  <thead>
                    <tr role="row">
                      <th class="sorting_asc" tabindex="0" aria-controls="detailtable" rowspan="1" colspan="1"
                        style="width: 0px;" aria-sort="ascending" aria-label="產品代號: activate to sort column descending">
                        <b>產品代號</b></th>
                      <th class="sorting" tabindex="0" aria-controls="detailtable" rowspan="1" colspan="1"
                        style="width: 0px;" aria-label="數量: activate to sort column ascending"><b>數量</b></th>
                      <th class="sorting" tabindex="0" aria-controls="detailtable" rowspan="1" colspan="1"
                        style="width: 0px;" aria-label="單價: activate to sort column ascending"><b>單價</b></th>
                      <th class="sorting" tabindex="0" aria-controls="detailtable" rowspan="1" colspan="1"
                        style="width: 0px;" aria-label="總價: activate to sort column ascending"><b>總價</b></th>
                      <th class="sorting" tabindex="0" aria-controls="detailtable" rowspan="1" colspan="1"
                        style="width: 0px;" aria-label="Edit: activate to sort column ascending"><b>Edit</b></th>
                      <th class="sorting" tabindex="0" aria-controls="detailtable" rowspan="1" colspan="1"
                        style="width: 0px;" aria-label="Delete: activate to sort column ascending"><b>Delete</b></th>
                    </tr>
                  </thead>
                  <tbody>

                    <tr class="odd">
                      <td valign="top" colspan="6" class="dataTables_empty">No matching records found</td>
                    </tr>
                  </tbody>
                  <tfoot></tfoot>
                </table>
                <div id="detailtable_processing" class="dataTables_processing card" style="display: none;">Processing...
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 col-md-5">
                <div class="dataTables_info" id="detailtable_info" role="status" aria-live="polite">Showing 0 to 0 of 0
                  entries (filtered from 31 total entries)</div>
              </div>
              <div class="col-sm-12 col-md-7">
                <div class="dataTables_paginate paging_simple_numbers" id="detailtable_paginate">
                  <ul class="pagination">
                    <li class="paginate_button page-item previous disabled" id="detailtable_previous"><a href="#"
                        aria-controls="detailtable" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li>
                    <li class="paginate_button page-item next disabled" id="detailtable_next"><a href="#"
                        aria-controls="detailtable" data-dt-idx="1" tabindex="0" class="page-link">Next</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-3" id="totalamt">
          </div>
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
  <div id="MasterModal" class="modal fade">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">*訂單資料管理*</h4>
          <button type="button" class="close btn-link text-white" data-bs-dismiss="modal"><span
              class="fa fa-window-close" style="color:black;"></span></button>
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
                          <input type="text" class="form-control" id="seq" name="seq" placeholder="序號" value=""
                            readonly="">
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
                        <div class="col-sm-6"><select class="form-select" aria-label="show empname to get empid"
                            name="empid" id="empid">
                            <option value=""></option>
                            <option value="00031">林國和</option>
                            <option value="00052">張琪</option>
                            <option value="00060">陳弘昌</option>
                            <option value="00071">黃大倫</option>
                            <option value="00073">黃秋好</option>
                            <option value="00074">黃振清</option>
                          </select></div>
                      </div>
                      <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-end control-label col-form-label">供應商代號</label>
                        <div class="col-sm-6"><select class="form-select" aria-label="show empname to get empid"
                            name="supplierid" id="supplierid">
                            <option value=""></option>
                            <option value="S0001">洽興金屬工業股份有限公司</option>
                            <option value="S0002">新益機械工廠股份有限公司</option>
                            <option value="S0003">天源義記機械股份有限公司</option>
                            <option value="S0004">家鄉事業股份有限公司</option>
                            <option value="S0005">四維企業(股)公司</option>
                            <option value="S0006">永輝興電機工業股份有限公司</option>
                            <option value="S0007">溪泉電器工廠股份有限公司</option>
                            <option value="S0008">善品精機股份有限公司</option>
                            <option value="S0009">佳樂電子股份有限公司</option>
                            <option value="S0010">科隆實業股份有限公司</option>
                            <option value="S0011">永光壓鑄企業公司</option>
                            <option value="S0012">正五傑機械股份有限公司</option>
                            <option value="S0013">集上科技股份有限公司</option>
                            <option value="S0014">強安鋼架工程股份有限公司</option>
                            <option value="S0015">菱生精密工業股份有限公司</option>
                            <option value="S0016">昆信機械工業股份有限公司</option>
                            <option value="S0017">麥柏股份有限公司</option>
                            <option value="S0018">九和汽車股份有限公司</option>
                            <option value="S0019">遠東氣體工業股份有限公司</option>
                            <option value="S0020">諾貝爾生物有限公司</option>
                            <option value="S0021">有萬貿易股份有限公司</option>
                            <option value="S0022">真正精機股份有限公司</option>
                            <option value="S0023">東興振業股份有限公司</option>
                            <option value="S0024">漢寶農畜產企業股份有限公司</option>
                            <option value="S0025">大喬機械公司</option>
                            <option value="S0026">達亞汽車股份有限公司</option>
                            <option value="S0027">台灣航空電子股份有限公司</option>
                            <option value="S0028">鐶琪塑膠股份有限公司</option>
                            <option value="S0029">亞智股份有限公司</option>
                            <option value="S0030">九華營造工程股份有限公司</option>
                            <option value="S0031">台灣保谷光學股份有限公司</option>
                            <option value="S0032">豐興鋼鐵(股)公司</option>
                            <option value="S0033">中友開發建設股份有限公司</option>
                            <option value="S0034">長生營造股份有限公司</option>
                            <option value="S0035">百容電子股份有限公司</option>
                            <option value="S0036">欣中天然氣股份有限公司</option>
                            <option value="S0037">比力機械工業股份有限公司</option>
                            <option value="S0039">台灣釜屋電機股份有限公司</option>
                            <option value="S0040">國光血清疫苗製造股份有限公司</option>
                            <option value="S0041">台灣製罐工業股份有限公司</option>
                            <option value="S0042">雅企科技(股)</option>
                            <option value="S0043">國豐電線工廠股份有限公司</option>
                            <option value="S0044">金興鋼鐵股份有限公司</option>
                            <option value="S0045">原帥電機股份有限公司</option>
                            <option value="S0046">新寶纖維股份有限公司</option>
                            <option value="S0047">太平洋汽門工業股份有限公司</option>
                            <option value="S0048">喬福機械工業股份有限公司</option>
                            <option value="S0049">楓原設計公司</option>
                            <option value="S0050">日南紡織股份有限公司</option>
                            <option value="S0051">台灣勝家實業股份有限公司</option>
                            <option value="S0052">周家合板股份有限公司</option>
                            <option value="S0053">英業達股份有限公司</option>
                            <option value="S0054">羽田機械股份有限公司</option>
                            <option value="S0055">中衛聯合開發公司</option>
                            <option value="S0056">台中精機廠股份有限公司</option>
                            <option value="S0057">東陽實業(股)公司</option>
                            <option value="S0058">金泰成粉廠股份有限公司</option>
                            <option value="S0059">現代農牧股份有限公司</option>
                            <option value="S0060">惠亞工程股份有限公司</option>
                            <option value="S0038">詮讚興業公司</option>
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
                        <button type="submit" class="btn btn-info" name="confirm"> <span
                            class="fa fa-save"></span>儲存</button>
                        <button type="button" class="btn btn-info close" data-bs-dismiss="modal" name="cancel" "="">            
  <span class=" fa fa-times">放棄</span></button>
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
    <script type="text/javascript" charset="utf-8">
      $(document).ready(function () {

        var mastertable = $('#ListTable').DataTable({
          'bProcessing': true,
          'bServerSide': true,
          'sAjaxSource': 'purchase1_master_ajax.php', 
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



        // var detailtable = $('#detailtable').DataTable({
        //   'bProcessing': true,
        //   'bServerSide': true,
        //   'sAjaxSource': 'purchase1_detail_ajax.php',
        //   "fnServerParams": function (aoData) {
        //     aoData.push({ "name": "purchaseid", "value": $('#_purchaseid').val() });
        //   }
        // });



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
          $('#_purchaseid').val(purchaseid);						//Hidden 欄位
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
              $('#detail_form')[0].reset();
              $('#totalamt').html('訂單總金額: <font color=red>' + data.total + '</font>元');
              $('#_op').val('13');  //訂單明細進入修改狀態
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
              $('#_op').val('12');  //進入修改狀態
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
                $('#_op').val('13');  //訂單明細進入修改狀態
                detailtable.ajax.reload(null, false);
              }
            })
          }
        });

        // $(document).on('click', '#addnew', function(){

        //       console.log('add new to order detail');              
        //       //$('#seq').removeAttr("readOnly");
        // 	  $('#cancel').removeAttr("disabled");	
        // 	  $('#modify').attr("disabled","disabled");			  		  
        //       $('.modal-title').text('新增訂單明細');	
        //       $('#detail_form')[0].reset();		
        // 	  $('#op').val('3');  	

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



    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="dist/js/custom.min.js"></script>
    <!-- This Page JS -->
    <script src="assets/libs/inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
    <script src="dist/js/pages/mask/mask.init.js"></script>
    <script src="assets/libs/select2/dist/js/select2.full.min.js"></script>
    <script src="assets/libs/select2/dist/js/select2.min.js"></script>
    <script src="assets/libs/jquery-asColor/dist/jquery-asColor.min.js"></script>
    <script src="assets/libs/jquery-asGradient/dist/jquery-asGradient.js"></script>
    <script src="assets/libs/jquery-asColorPicker/dist/jquery-asColorPicker.min.js"></script>
    <script src="assets/libs/jquery-minicolors/jquery.minicolors.min.js"></script>
    <script src="assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="assets/libs/quill/dist/quill.min.js"></script>
    <script>
      //***********************************//
      // For select 2
      //***********************************//
      $('.select2').select2();

      /*colorpicker*/
      $('.demo').each(function () {
        //
        // Dear reader, it's actually very easy to initialize MiniColors. For example:
        //
        //  $(selector).minicolors();
        //
        // The way I've done it below is just for the demo, so don't get confused
        // by it. Also, data- attributes aren't supported at this time...they're
        // only used for this demo.
        //
        $(this).minicolors({
          control: $(this).attr('data-control') || 'hue',
          position: $(this).attr('data-position') || 'bottom left',

          change: function (value, opacity) {
            if (!value) return;
            if (opacity) value += ', ' + opacity;
            if (typeof console === 'object') {
              console.log(value);
            }
          },
          theme: 'bootstrap',
        });
      });
      /*datwpicker*/
      jQuery('.mydatepicker').datepicker({
        language: 'zh-CN',
        format: 'yyyy-mm-dd',
        showAnim: 'fade',
        minView: 'month',
        todayHighligh: 1,
        yearRange: '2016:2030'
      });
      jQuery('#datepicker-autoclose').datepicker({
        autoclose: true,
        todayHighlight: true,
      });
/*var quill = new Quill('#editor', {
      theme: 'snow',
      });*/
    </script><!-- this page js -->
    <script src="assets/extra-libs/multicheck/datatable-checkbox-init.js"></script>
    <script src="assets/extra-libs/multicheck/jquery.multicheck.js"></script>
    <script src="assets/extra-libs/DataTables/datatables.min.js"></script>
    <script>
      /****************************************
      *       Basic Table                   *
      ****************************************/
      $('#zero_config').DataTable();
    </script>

  </div>
</div>