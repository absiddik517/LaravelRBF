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
    <li class="active"><a href="#">Products</a></li>
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

              <h3 class="box-title">Products</h3>

              <div class="box-tools pull-right">
                <button id="create_product" class="btn btn-info btn-sm">Add New Product</button>
                <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
            </div>

            <div class="box-body border-radius-none">
              <div class="table-responsive">
                <table id="ProductsTable" class="table table-striped table-hover table-bordered">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Product Name</th>
                      <th>Unite</th>
                      <th>Price Per Unit</th>
                      <th>Transport Rate</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td colspan="6" style="text-align: center;">Loading <img src="{{ asset('images/system/spinner.gif') }}" alt=""></td>
                    </tr>
                  </tbody>
                </table>
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

              <div class="form-group" id="update_transport_rate_group">
                <label for="update_product_rate">Transport Rate *</label>
                <input type="text" data-intype="number" class="form-control" id="update_transport_rate" name="product_rate">
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
            <h4 class="modal-title">Create New Product</h4>
          </div>
          <form id="CreateProductFrom" action="" method="post">

          <div class="modal-body">
            <div class="form-group" id="create_name_group">
              <label for="create_product_name">Product Name *</label>
              <input type="text" class="form-control" id="create_product_name" name="product_name">
              <div class="invalid-feedback"></div>
            </div>

            <div class="form-group" id="create_unit_group">
              <label for="create_product_unit">Product Unit (Optional)</label>
              <input type="text" class="form-control" id="create_product_unit" name="product_unit">
              <div class="invalid-feedback"></div>
            </div>

            <div class="form-group" id="create_rate_group">
              <label for="create_product_rate">Product Rate *</label>
              <input type="text" data-intype="number" class="form-control" id="create_product_rate" name="product_rate">
              <div class="invalid-feedback"></div>
            </div>

            <div class="form-group" id="create_transport_rate_group">
              <label for="create_product_rate">Transport Rate *</label>
              <input type="text" data-intype="number" class="form-control" id="create_transport_rate" name="product_rate">
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

      $('#CreateProductFrom').submit(function(e) {
        e.preventDefault();
        let _data = {
          name : $('#create_product_name').val(),
          unit : $('#create_product_unit').val(),
          rate : $('#create_product_rate').val(),
          transport_rate : $('#create_transport_rate').val()
        };

        $.ajax({
          url : "{{ route('product.create') }}",
          method : "POST",
          dataType : "JSON",
          data : _data,
          beforeSend : function() {
            $('#create_name_group, #create_unit_group, #create_rate_group').removeClass('has-error has-feedback');
            $('#create_name_group .invalid-feedback, #create_unit_group .invalid-feedback, #create_rate_group .invalid-feedback').text('');

          },
          success: function(res) {
            Swal(res.t, res.m, res.s);
            if(res.s == 'success'){
              $('#create_product_name').val('');
              $('#create_product_unit').val('');
              $('#create_product_rate').val('');
              $('#create_transport_rate').val('');
              $('#create_modal').modal('hide');
              getProducts();
            }
          },
          error: function(xhr, status, error) {
            let errors = xhr.responseJSON.errors;
            $.each(errors, function(key, item) {
                let group = 'create_' + key + '_group';
                  $('#'+group).addClass('has-error has-feedback');
                  $('#'+group +' .invalid-feedback').text(item);
              });
          }
        });
      });
      getProducts();
      function getProducts() {
        $.ajax({
          url : "{{ route('product.list') }}",
          method: "GET",
          dataType : "JSON",
          beforeSend : function() {
            
          },
          success : function(res) {
            let content = '';
            if(res.length > 0){
              $.each(res, function(key, item) {
                content += '<tr>';
                content += "<td>" + item.id + "</td>";
                content += "<td>" + item.name + "</td>";
                content += "<td>" + item.unit + "</td>";
                content += "<td>" + item.rate + "</td>";
                content += "<td>" + item.transport_rate + "</td>";
                content += "<td> <button class='btn-edit btn btn-success btn-sm' data-id='"+item.id+"'>Edit</button> <button class='btn-delete btn btn-danger btn-sm' data-id='"+item.id+"'>Delete</button> </td>";
                content += '</tr>';
              });
            }else{
              content += '<tr>';
              content += "<td colspan='6' style='text-align: center;'> No Data Found </td>";
              content += '</tr>';
            }

            $('#ProductsTable tbody').html(content);
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
            $('#update_transport_rate').val(res.transport_rate);
          }
        });
      });

      $('#UpdateProductForm').submit(function(e) {
        e.preventDefault();
        let _data = {
          id   : $('#update_product_id').val(),
          name : $('#update_product_name').val(),
          unit : $('#update_product_unit').val(),
          rate : $('#update_product_rate').val(),
          transport_rate : $('#update_transport_rate').val()
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

