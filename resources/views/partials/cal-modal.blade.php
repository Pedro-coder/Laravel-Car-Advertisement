<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
            <i class="fas fa-user-friends"></i>
        Referral Calculator</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-6 pt-2">
                <label for="price">My price</label>
            </div>
            <div class="col-md-6">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="price">
                            <i class="fas fa-dollar-sign"></i>
                        </span>
                    </div>
                    <input type="text" id="price" name="price" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 pt-2">
                <label for="ref-comission">Referral comission(%):</label>
            </div>
            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" id="ref-comission" name="ref-comission" class="form-control">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="ref-comission">
                            <i class="fas fa-percentage"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 pt-2">
                <label for="ref-comission">Referral Will get:</label>
            </div>
            <div class="col-md-6">
                <p class="mt-1">(Show Calculated %) - (4.65%)</p>
            </div>
            <p class="ml-3">(after close successfully, 1/3 deductable by this site and payment method may charge apply)</p>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <p class="ml-3 text-italic">***referral comission have to pay after any successfull sell, otherwise account may block</p>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success">Save changes</button>
      </div>
    </div>
  </div>
</div>
