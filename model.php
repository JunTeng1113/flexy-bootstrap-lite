<?php
function model() {
  echo '
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Purchase Order</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="seg" class="col-form-label">序號：</label>
              <input type="text" class="form-control" id="seg">
            </div>
            <div class="form-group">
              <label for="purchaseid" class="col-form-label">訂單代號：</label>
              <input type="text" class="form-control" id="purchaseid">
            </div>
            <div class="form-group">
              <label for="purchaseid" class="col-form-label">採購人員代號：</label>
              <input type="text" class="form-control" id="purchaseid">
            </div>
            <div class="form-group">
              <label for="purchaseid" class="col-form-label">供應商代號：</label>
              <input type="text" class="form-control" id="purchaseid">
            </div>
            <div class="form-group">
              <label for="purchaseid" class="col-form-label">採購日期：</label>
              <input type="text" class="form-control" id="purchaseid">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Send message</button>
        </div>
      </div>
    </div>
  </div>
  ';
}
?>