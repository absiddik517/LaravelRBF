@extends('layouts.master')



@section('title')
  <title>Project</title>
@endsection


@section('body')
  <section class="content-header">
      <h1>
        Project
        <small>Project List</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('project.index') }}">Project</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="box box-solid ">
            <div class="box-header bg-teal-gradient">
              <i class="fa fa-th"></i>

              <h3 class="box-title">Project List</h3>

              <div class="box-tools pull-right">
                <button type="button" data-toggle="modal" data-target="#create_staff_modal" class="btn bg-teal">Add Project
                </button>
                <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
            </div>

            <div class="box-body border-radius-none">
              <pre id="console"></pre>
              <div class="table-responsive">
                <div id="ProjectTable">
                </div>
            </div>

            </div>


        </section>

      </div>
      <!-- /.row (main row) -->
    </section>
    
    
<div id="create_staff_modal" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lg">
        <!-- modal content -->
        <div class="modal-content">
          <div class="modal-header">
            <button class="close closeBtn" type="button" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add New Staff</h4>
          </div>
          <form id="AddStaffForm" action="" method="post">
            <div class="overlay"><img src="{{ asset('images/system/spinner.gif') }}" alt=""></div>

          <div class="modal-body">
            
            <div class="title_group form-group">
              <label for="">Title *</label>
              <input type="text" class="title form-control">
              <div class="invalid-feedback"></div>
            </div>
            
            <div class="location_group form-group">
              <label for="">Location *</label>
              <input type="text" class="location form-control">
              <div class="invalid-feedback"></div>
            </div>
            
            <div class="owner_group form-group">
              <label for="">Owner *</label>
              <input type="text" class="owner form-control">
              <div class="invalid-feedback"></div>
            </div>
            
            <div class="phone_group form-group">
              <label for="">Phone *</label>
              <input type="text" class="phone form-control">
              <div class="invalid-feedback"></div>
            </div>
            
            <div class="email_group form-group">
              <label for="">Email *</label>
              <input type="text" class="email form-control">
              <div class="invalid-feedback"></div>
            </div>
            
            <div class="advance_group form-group">
              <label for="">Advance *</label>
              <input type="text" class="advance form-control">
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

<div id="edit_project_modal" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lg">
        <!-- modal content -->
        <div class="modal-content">
          <div class="modal-header">
            <button class="close closeBtn" type="button" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Edit Project Detail</h4>
          </div>
          <form id="editProjectForm" action="" method="post">
            <div class="overlay"><img src="{{ asset('images/system/spinner.gif') }}" alt=""></div>

          <div class="modal-body">
            <input type="hidden" class="id">
            <div class="title_group form-group">
              <label for="">Title *</label>
              <input type="text" class="title form-control">
              <div class="invalid-feedback"></div>
            </div>
            
            <div class="location_group form-group">
              <label for="">Location *</label>
              <input type="text" class="location form-control">
              <div class="invalid-feedback"></div>
            </div>
            
            <div class="owner_group form-group">
              <label for="">Owner *</label>
              <input type="text" class="owner form-control">
              <div class="invalid-feedback"></div>
            </div>
            
            <div class="phone_group form-group">
              <label for="">Phone *</label>
              <input type="text" class="phone form-control">
              <div class="invalid-feedback"></div>
            </div>
            
            <div class="email_group form-group">
              <label for="">Email *</label>
              <input type="text" class="email form-control">
              <div class="invalid-feedback"></div>
            </div>
            
            <div class="advance_group form-group">
              <label for="">Advance *</label>
              <input type="text" class="advance form-control">
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

<div id="sell_project_modal" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lg">
        <!-- modal content -->
        <div class="modal-content">
          <div class="modal-header">
            <button class="close closeBtn" type="button" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Sell Product</h4>
          </div>
          <form id="sellProductModel" action="" method="post">
            <div class="overlay"><img src="{{ asset('images/system/spinner.gif') }}" alt=""></div>

          <div class="modal-body">
            <input type="hidden" class="id">
            <div class="product_id_group form-group">
              <label for="">Product *</label>
              <select class="product_id form-control">
                  @php
                     $products = App\Model\Products::all();
                  @endphp
                    <option value="">Select Product</option>
                  @foreach ($products as $product)
                    <option value="{{ $product['id'] }}">{{ $product['name']." - ". $product['unit']  }}</option>
                  @endforeach
              </select>
              <div class="invalid-feedback"></div>
            </div>
            
                <div class="rate_group form-group">
                  <label for="rate" class="control-label">Rate *</label>
                  <!--<div class="col-sm-9">-->
                    <div class="input-group">
                      <input type="text" data-intype="number" class="rate form-control" name="rate" placeholder="Rate" autocomplete="off">
                      <span class="input-group-addon"><i class="fa fa-times"></i></span>
                    </div>

                    <div class="invalid-feedback"></div>
                  <!--</div>-->
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
    $(document).ready(function(){
      $.ajaxSetup({
        headers : { 'X-CSRF-Token' : '{{ csrf_token() }}'}
      });
      
      $('#AddStaffForm').submit(function(e){
        e.preventDefault();
        StoreNewStaff();
      });
      
      function StoreNewStaff(){
        let form = "#AddStaffForm";
        let _data = {
          title         : $(form + ' input.title').val(),
          location      : $(form + ' input.location').val(),
          owner         : $(form + ' input.owner').val(),
          phone         : $(form + ' input.phone').val(),
          email         : $(form + ' input.email').val(),
          advance       : $(form + ' input.advance').val()
        };
        
        
        $.ajax({
          url : "{{ route('project.store') }}",
          method : 'post', 
          dataType : 'json',
          data : _data,
          beforeSend : function(){
            $(form + ' .overlay').show();;
            $(form + ' .form-group').removeClass('has-error has-feedback');
            $(form + ' .invalid-feedback').text('');
          }, 
          success : function(res){
            getStaffList();
            $(form + ' .overlay').hide();
            Swal(res.t, res.m, res.s);
            $(form)[0].reset();
            $('#create_staff_modal').modal('hide');
            
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
      
      getStaffList();
      
      function getStaffList(){
        $.ajax({
          url : "{{ route('project.list') }}",
          method : 'get',
          dataType : 'json',
          beforeSend : function(){
            
          }, 
          success : function(res){
            $("#console").text(res);
            $('#ProjectTable').html(res);
          },
          error: function (xhr, status, error){
            $('#console').html(xhr.responseText);
          }
        });
      }
      
      $('#ProjectTable').on('click', 'a.edit', function(e){
          e.preventDefault();
          let id = $(this).data('id');
          let form = '#editProjectForm ';
          $(form + 'input.id').val(id);
          $.ajax({
              url : "{{ route('project.details') }}",
              method : 'post', 
              dataType : 'json',
              data : {
                  id : id
              },
              beforeSend : function(){
                  
              },
              success : function(res){
                  $(form + 'input.title').val(res.title);
                  $(form + 'input.location').val(res.location);
                  $(form + 'input.owner').val(res.owner);
                  $(form + 'input.phone').val(res.phone);
                  $(form + 'input.email').val(res.email);
                  $(form + 'input.advance').val(res.advance);
              },
              error: function (xhr, status, error){
                $('#console').html(xhr.responseText);
              }
          });
          $('#edit_project_modal').modal('show');
      });
      
      $('#editProjectForm').submit(function(e){
          e.preventDefault();
         
          let form = '#editProjectForm';
          let _data = {
              id            : $(form + ' input.id').val(),
              title         : $(form + ' input.title').val(),
              location      : $(form + ' input.location').val(),
              owner         : $(form + ' input.owner').val(),
              phone         : $(form + ' input.phone').val(),
              email         : $(form + ' input.email').val(),
              advance       : $(form + ' input.advance').val()
            };
            
          $.ajax({
              url : "{{ route('project.update') }}",
              method : 'post',
              dataType : 'json',
              data : _data,
              beforeSend : function(){
                  
              },
              success : function(res){
                  Swal(res.t, res.m, res.s);
                  if(res.s == 'success'){
                      $('#edit_project_modal').modal('hide');
                      getStaffList();
                  }
              },
              error: function (xhr, status, error){
                $('#console').html(xhr.responseText);
              }
          }); 
        
      });
      
      $('#ProjectTable').on('click', 'a.sell', function(e){
          e.preventDefault();
          $('#sellProductModel')[0].reset();
          let id = $(this).data('id');
          $('#sellProductModel input.id').val(id);
          $('#sell_project_modal').modal('show');
      });
      
      function getRate(value) {
        let form = '#sellProductModel ';
        if(value > 0){
          $.ajax({
            url : "{{ route('product.rate') }}",
            method : "POST",
            dataType : "JSON",
            data: {
              product_id : value
            },
            beforeSend : function() {
              $(form + '.input-group-addon').html('<img src="{{ asset('images/system/spinner.gif') }}"/>');
              $(form + 'input.rate').val('');
            },
            success : function(res) {
              $(form + 'input.rate').val(res);
              console.log(res);

              if(res.length > 0){
                $(form + '.rate_group .input-group-addon').html('<i class="fa fa-check"></i>');
              }else{
                $(form + '.rate_group .input-group-addon').html('<i class="fa fa-times"></i>');
              }
            },
              error: function (xhr, status, error){
                $('#console').html(xhr.responseText);
              }
          });
        }else{
          $(form + 'input.rate').val('');
          $(form + 'div.rate_group .input-group-addon').html('<i class="fa fa-times"></i>');
        }
      }
      
      $('#sellProductModel select.product_id').change(function(){
          let product_id = $('#sellProductModel select.product_id').val();
          getRate(product_id);
      });
      
      $('#sellProductModel').submit(function(e){
          e.preventDefault();
          let form = '#sellProductModel ';
          let _data = {
              project_id : $(form + 'input.id').val(),
              product_id : $(form + 'select.product_id').val(),
              rate       : $(form + 'input.rate').val(),
          };
          
          $.ajax({
              url : "{{ route('project.sell') }}",
              method : 'post',
              dataType : 'json',
              data : _data,
              beforeSend : function(){
                  
              },
              success : function(res){
                  Swal(res.t, res.m, res.s);
                  if(res.s == 'success'){
                      $(form)[0].reset();
                      $('#sell_project_modal').modal('hide');
                  }
              },
              error: function (xhr, status, error){
                $('#console').html(xhr.responseText);
              }
          });
      });
      
      

      
    });
  </script>

@endsection