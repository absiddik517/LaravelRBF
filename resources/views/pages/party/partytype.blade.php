@extends('layouts.master')

@section('title')
  <title>Products</title>
@endsection


@section('body')
  
<section class="content-header">
  <h1>
    Products
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Party</a></li>
    <li class="active"><a href="#">Party Type</a></li>
  </ol>
</section>

<section class="content">
	<div class="row">
        <!-- Left col -->
        <section class="col-lg-12">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="box box-solid">
            <div class="box-header">
              <i class="fa fa-th"></i>

              <h3 class="box-title">Party Types</h3>

              <div class="box-tools pull-right">
                <button id="create_product" class="btn btn-info btn-sm">Add New Party Type</button>
                <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
            </div>

            <div class="box-body border-radius-none">
              <pre id="console"></pre>
              <div class="table-responsive">
                 <div id="listTable"></div>
              </div>

            </div>
        </section>
    </div>

</section>


<div id="UpdateModal" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lg">
      <div class="overlay"><img src="{{ asset('images/system/spinner.gif') }}"></div>
      	<div class="modal-content">
      		<div class="modal-header">
      			<button class="close closeBtn" type="button" data-dismiss="modal">&times;</button>
      			<h4 class="modal-title">Update Product</h4>
      		</div>
      		<form id="UpdateProductForm">
      		<div class="modal-body">
      				<input type="hidden" id="update_product_id" name="id">

      				<div class="form-group" id="update_name_group">
                <label for="update_product_name">Product Name *</label>
                <input type="text" class="form-control" id="update_product_name" name="product_name">
                <div class="invalid-feedback"></div>
              </div>

              <div class="form-group" id="update_unit_group">
                <label for="update_product_unit">Product Unit (Optional)</label>
                <input type="text" class="form-control" id="update_product_unit" name="product_unit">
                <div class="invalid-feedback"></div>
              </div>

              <div class="form-group" id="update_rate_group">
                <label for="update_product_rate">Product Rate *</label>
                <input type="text" data-intype="number" class="form-control" id="update_product_rate" name="product_rate">
                <div class="invalid-feedback"></div>
              </div>

      		</div>
      		<div class="modal-footer">
				    <button type="submit" class="btn btn-primary">Submit</button>
      			<button class="btn btn-danger" data-dismiss="modal">Close</button>
      		</div>
      		</form>
      	</div>
      </div>
</div>

<div id="create_modal" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lg">
        <!-- modal content -->
        <div class="modal-content">
          <div class="modal-header">
            <button class="close closeBtn" type="button" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Create New Party Type</h4>
          </div>
          <form id="CreatePartyTypeFrom" action="" method="post">

          <div class="modal-body">
            <div class="form-group name_group">
              <label for="create_product_name">Name *</label>
              <input type="text" class="name form-control" id="create__name" name="product_name">
              <div class="invalid-feedback"></div>
            </div>

            <div class="form-group billing_system_group">
              <label for="create_product_unit">Billing System *</label>
              <select class="billing_system form-control" id="create_unit" name="product_unit">
                <option value="">Select One</option>
                <option value="Daily">Daily</option>
                <option value="Weekly">Weekly</option>
                <option value="Monthly">Monthly</option>
              </select>
              <div class="invalid-feedback"></div>
            </div>

            <div class="form-group task_group">
              <label for="create_rate">Task *</label>
              <input type="text" class="task form-control" id="create_rate" name="product_rate">
              <div class="invalid-feedback"></div>
            </div>
            
            <div class="form-group allow_advance_group">
              <label for="create_rate">Allow Advance *</label>
              <select class="allow_advance form-control" id="create_rate" name="product_rate">
                <option value="">Select One</option>
                <option value="true">Yes</option>
                <option value="false">no</option>
              </select>
              <div class="invalid-feedback"></div>
            </div>
            
            <div class="form-group allow_daily_advance_group">
              <label for="allow_daily_advance">Allow Daily Advance *</label>
              <select class="allow_daily_advance form-control" id="allow_daily_advance" name="allow_daily_advance">
                <option value="">Select One</option>
                <option value="true">Yes</option>
                <option value="false">no</option>
              </select>
              <div class="invalid-feedback"></div>
            </div>
            
            
            <div class="form-group allow_preload_group">
              <label for="allow_preload">Allow Preload *</label>
              <select class="allow_preload form-control" id="allow_daily_advance" name="allow_daily_advance">
                <option value="">Select One</option>
                <option value="true">Yes</option>
                <option value="false">no</option>
              </select>
              <div class="invalid-feedback"></div>
            </div>

          </div>

          <div class="modal-footer">
            <button class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
          </form>
        </div>
      </div>
</div>

@endsection

@section('script')
  <script>
  	$(document).ready(function() {
  		$('#create_product').click(function(e) {
        e.preventDefault();
        $('#create_modal').modal('show');
      });

      $.ajaxSetup({
        headers : { 'X-CSRF-Token' : '{{ csrf_token() }}'}
      });

      $('#CreatePartyTypeFrom').submit(function(e) {
        e.preventDefault();
        StoreNewType();
      });
      
      
      function StoreNewType(){
        let form = "#CreatePartyTypeFrom";
        let _data = {
          name                  : $(form + ' input.name').val(),
          billing_system        : $(form + ' select.billing_system').val(),
          task                  : $(form + ' input.task').val(),
          allow_advance         : $(form + ' select.allow_advance').val(),
          allow_daily_advance   : $(form + ' select.allow_daily_advance').val(),
          allow_preload         : $(form + ' select.allow_preload').val()
        };
        
        $("#console").text(_data);
        
        
        $.ajax({
          url : "{{ route('partytype.store') }}",
          method : 'post', 
          dataType : 'json',
          data : _data,
          beforeSend : function(){
            $(form + ' .overlay').show();;
            $(form + ' .form-group').removeClass('has-error has-feedback');
            $(form + ' .invalid-feedback').text('');
          }, 
          success : function(res){
            getTypes();
            $(form + ' .overlay').hide();
            Swal(res.t, res.m, res.s);
            $(form)[0].reset();
            $('#create_modal').modal('hide');
            
          },
          error : function(xhr, status, error){
            $(form + ' .overlay').hide();
            $('#console').html(xhr.responseText);
            
            let errors = xhr.responseJSON.errors;
            $.each(errors, function(key, item) {
              let group = form + ' .'+ key + '_group';
                $(group).addClass('has-error has-feedback');
                $(group +' .invalid-feedback').text(item);
            });
          }
        });
      }
      
      
      getTypes();
      function getTypes() {
        $.ajax({
          url : "{{ route('partytype.list') }}",
          method: "GET",
          dataType : "JSON",
          beforeSend : function() {
            
          },
          success : function(res) {
            $('#listTable').html(res);
          },
          error : function(xhr, status, error){
            $('#console').html(xhr.responseText);
          }
        });
      }

      $('#ProductsTable').on('click', '.btn-edit', function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        $('#UpdateModal').modal('show');
        $('#update_product_id').val(id);

        $.ajax({
          url : "{{ route('ProductDetails') }}",
          method : "POST",
          dataType : "JSON",
          data : { id : id },
          beforeSend : function() {
            $('#UpdateModal .overlay').show();
          }, 
          success : function(res) {
            $('#UpdateModal .overlay').hide();
            console.log(res);
            $('#update_product_name').val(res.name);
            $('#update_product_unit').val(res.unit);
            $('#update_product_rate').val(res.rate);
          }
        });
      });

      $('#UpdateProductForm').submit(function(e) {
        e.preventDefault();
        let _data = {
          id   : $('#update_product_id').val(),
          name : $('#update_product_name').val(),
          unit : $('#update_product_unit').val(),
          rate : $('#update_product_rate').val()
        }

        $.ajax({
          url : "{{ route('UpdateProduct') }}",
          method : "POST",
          dataType : "JSON",
          data : _data,
          beforeSend : function() {
            $('#UpdateModal .overlay').show();
          }, 
          success : function(res) {
            $('#UpdateModal .overlay').hide();
            getProducts();
            Swal(res.t, res.m, res.s);
            console.log(res);
          }, 
          error: function(xhr, status, error) {
            let errors = xhr.responseJSON.errors;
            $.each(errors, function(key, item) {
              let group = 'update_' + key + '_group';
              $('#'+group).addClass('has-error has-feedback');
              $('#'+group +' .invalid-feedback').text(item);
            });
          }
        });
      })



      $('#ProductsTable').on('click', '.btn-delete', function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        deleteProduct(id);
      });

      function deleteProduct(id){
        swal({
            title: 'Are you sure?',
            text: "It will be deleted permanently!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            showLoaderOnConfirm: true,
              
            preConfirm: function() {
              return new Promise(function(resolve){
                   
                 $.ajax({
                    url: '{{ route('DeleteProduct') }}',
                    type: 'delete',
                    data: {id : id},
                    dataType: 'json'
                 })
                 .done(function(response){
                    swal(response.t, response.m, response.s);
                    getProducts();
                 })
                 .fail(function(){
                    swal('Oops...', 'Something went wrong with ajax !', 'error');
                 });
              });
            },
            allowOutsideClick: false              
        });  
    }

  	});
  </script>
@endsection

