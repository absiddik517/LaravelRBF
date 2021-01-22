@extends('layouts.master')

@section('title')
  <title>Notes</title>
@endsection


@section('body')
  <section class="content-header">
      <h1>
        Notes
        <small>Your Notes</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{{ route('project.index') }}">Notes</a></li>
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

              <h3 class="box-title">Your Notes</h3>

              <div class="box-tools pull-right">
                <button type="button" data-toggle="modal" data-target="#create_staff_modal" class="btn bg-teal">Add Note
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
            <h4 class="modal-title">Add New Note</h4>
          </div>
          <form id="AddStaffForm" action="" method="post">
            <div class="overlay"><img src="{{ asset('images/system/spinner.gif') }}" alt=""></div>

          <div class="modal-body">
            
            <div class="title_group form-group">
              <label for="">Note *</label>
              <textarea class="note form-control"></textarea>
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
            <h4 class="modal-title">Edit note</h4>
          </div>
          <form id="editProjectForm" action="" method="post">
            <div class="overlay"><img src="{{ asset('images/system/spinner.gif') }}" alt=""></div>

          <div class="modal-body">
            <input type="hidden" class="id">
            <div class="title_group form-group">
              <label for="">Note *</label>
              <textarea class="note form-control"></textarea>
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
          note         : $(form + ' textarea.note').val()
        };
        
        
        $.ajax({
          url : "{{ route('note.store') }}",
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
          url : "{{ route('note.list') }}",
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
              url : "{{ route('note.detail') }}",
              method : 'post', 
              dataType : 'json',
              data : {
                  id : id
              },
              beforeSend : function(){
                  
              },
              success : function(res){
                  $(form + 'textarea.note').val(res.note);
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
              note         : $(form + ' textarea.note').val(),
            };
            
          $.ajax({
              url : "{{ route('note.update') }}",
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