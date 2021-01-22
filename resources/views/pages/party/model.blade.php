<div id="add_party_entry_modal" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lg">
            <div class="overlay"><img src="images/spinner.gif"></div>
            <div class="modal-content">
                  <div class="modal-header">
                        <button class="close closeBtn" type="button" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add Party Entry</h4>
                  </div>
                  <!-- modal Body -->
                  <div class="modal-body">
                        <form id="entry_form" action="" class="form-horizontal">
                              <input type="hidden" class="party_id">
                              <div class="form-group name-group">
                                    <label for="entry_name" class="col-md-3">Sardar Name</label>
                                    <div class="col-md-9">
                                          <input type="text" class="form-control name" disabled>
                                    </div>
                              </div>

                              <div class="form-group description_group">
                                    <label for="entry_description" class="col-md-3">Description</label>
                                    <div class="col-md-9">
                                          <input type="text" id="entry_description" placeholder="Description" class="form-control description" autocomplete="off">
                                          <div class="invalid-feedback"></div>
                                    </div>
                              </div>

                              <div class="form-group quantity_group">
                                    <label for="entry_quantity" class="col-md-3">Quantity</label>
                                    <div class="col-md-9">
                                          <input type="text" data-intype="number" id="entry_quantity" placeholder="Quantity" class="form-control quantity" maxlength="7" autocomplete="off">
                                          <div class="invalid-feedback"></div>
                                    </div>
                              </div>

                              
                  </div>
                  <!-- modal footer -->
                  <div class="modal-footer">
                        <button class="btn btn-success" type='submit' id="entry_submit">Confirm</button>
                  </div>
                        </form>
            </div>
      </div>
</div>
