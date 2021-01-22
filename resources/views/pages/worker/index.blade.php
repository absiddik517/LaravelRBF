@extends('layouts.master')

@section('title')
  <title>Workers</title>
@endsection


@section('body')
  <section class="content-header">
      <h1>
        Worker
        <small>View All Workers</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="/workers">Workers</a></li>
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

              <h3 class="box-title">Worker List</h3>

              <div class="box-tools pull-right">
                <button type="button" data-toggle="modal" data-target="#create_worker_modal" class="btn bg-teal">Add Worker
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
                <div id="worker_table"></div>
            </div>

            </div>


        </section>

      </div>
   
<div id="create_worker_modal" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lg">
        <!-- modal content -->
        <div class="modal-content">
          <div class="modal-header">
            <button class="close closeBtn" type="button" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add New Worker</h4>
          </div>
          <form id="AddStaffForm" action="" method="post">
            <div class="overlay"><img src="{{ asset('images/system/spinner.gif') }}" alt=""></div>

          <div class="modal-body">
            
            <div class="name_group form-group">
              <label for="">Name *</label>
              <input type="text" class="name form-control">
              <div class="invalid-feedback"></div>
            </div>
            
            <div class="address_group form-group">
              <label for="">Address *</label>
              <input type="text" class="address form-control">
              <div class="invalid-feedback"></div>
            </div>
            
            <div class="phone_group form-group">
              <label for="">Phone *</label>
              <input type="text" class="phone form-control" data-intype="number">
              <div class="invalid-feedback"></div>
            </div>
            
            <div class="designation_group form-group">
              <label for="">Designation *</label>
              <input type="text" class="designation form-control">
              <div class="invalid-feedback"></div>
            </div>
      
            <div class="selery_group form-group">
              <label for="">Selery *</label>
              <input type="text" class="selery form-control">
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

<div id="edit_worker_modal" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lg">
        <!-- modal content -->
        <div class="modal-content">
          <div class="modal-header">
            <button class="close closeBtn" type="button" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Edit New Worker</h4>
          </div>
          <form id="edit_worker_form" action="" method="post">
            <div class="overlay"><img src="{{ asset('images/system/spinner.gif') }}" alt=""></div>

          <div class="modal-body">
            <input type="hidden" class="editId" id="editId">
            <div class="name_group form-group">
              <label for="">Name *</label>
              <input type="text" class="name form-control">
              <div class="invalid-feedback"></div>
            </div>
            
            <div class="address_group form-group">
              <label for="">Address *</label>
              <input type="text" class="address form-control">
              <div class="invalid-feedback"></div>
            </div>
            
            <div class="phone_group form-group">
              <label for="">Phone *</label>
              <input type="text" class="phone form-control" data-intype="number">
              <div class="invalid-feedback"></div>
            </div>
            
            <div class="designation_group form-group">
              <label for="">Designation *</label>
              <input type="text" class="designation form-control">
              <div class="invalid-feedback"></div>
            </div>
      
            <div class="selery_group form-group">
              <label for="">Selery *</label>
              <input type="text" class="selery form-control">
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


<div id="attendance" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lg">
            <div class="overlay"><img src="{{ asset('images/system/spinner.gif') }}"></div>
            <div class="modal-content">
                <form action="" class="form-horizontal">
                  <div class="modal-header">
                        <button class="close closeBtn" type="button" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Worker Attendance</h4>
                  </div>
                  <!-- modal Body -->
                  <div class="modal-body">
                        
                        <div id="workerTitle" class="alert alert-danger"></div>
                        <div id="workerMsg" class="alert text-center text-danger"></div>
                              <input type="hidden" name="" id="workerId">
                              <div class="form-group">
                                    <label for="workerNameAttend" class="col-md-3">Worker Name</label>
                                    <div class="col-md-9">
                                          <input type="text" id="workerName" placeholder="Worker Name" disabled class="form-control">
                                    </div>
                              </div>

                              <div class="form-group">
                                    <label for="workerSeleryAttend" class="col-md-3">Selery</label>
                                    <div class="col-md-9">
                                          <input type="text" data-intype="number" id="workerSelery" placeholder="Selery" class="form-control">
                                    </div>
                              </div>

                  </div>
                  <!-- modal footer -->
                  <div class="modal-footer">
                        <button class="btn btn-danger pull-left" id="workerAbsent">Absent</button>
                        <button class="btn btn-success" id="workerPresent">Present</button>
                  </div>
                </form>
            </div>
      </div>
</div>


<div id="payment" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="" class="form-horizontal">
                  <div class="overlay"><img src="{{ asset('images/system/spinner.gif') }}"></div>
                  <div class="modal-header">
                        <button class="close closeBtn" type="button" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Worker Payment</h4>
                  </div>
                  <!-- modal Body -->
                  <div class="modal-body">
                        
                      <input type="hidden" name="" id="workerIdp">
                      <div class="form-group worker_id_group">
                            <label for="workerNameAttend" class="col-md-3">Worker Name</label>
                            <div class="col-md-9">
                                  <input type="text"  placeholder="Worker Name" disabled class="form-control workerName">
                                  <span class="invalid-feedback"></span>
                            </div>
                      </div>
                      
                      <div class="form-group">
                            <label for="workerNameAttend" class="col-md-3">Balance</label>
                            <div class="col-md-9">
                                  <input type="text"  placeholder="Balance" disabled class="form-control balance">
                                  <span class="invalid-feedback"></span>
                            </div>
                      </div>

                      <div class="form-group amount_group">
                            <label for="workerSeleryAttend" class="col-md-3">amount</label>
                            <div class="col-md-9">
                                  <input type="text" data-intype="number" placeholder="Selery" class="form-control amount">
                                  <span class="invalid-feedback"></span>
                            </div>
                      </div>

                  </div>
                  <!-- modal footer -->
                  <div class="modal-footer">
                        <button class="btn btn-danger pull-left" id="submit">Submit</button>
                  </div>
                </form>
            </div>
      </div>
</div>


    </section>

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
          name         : $(form + ' input.name').val(),
          address      : $(form + ' input.address').val(),
          phone        : $(form + ' input.phone').val(),
          selery       : $(form + ' input.selery').val(),
          designation  : $(form + ' input.designation').val()
        };
        
        
        $.ajax({
          url : "{{ route('worker.store') }}",
          method : 'post', 
          dataType : 'json',
          data : _data,
          beforeSend : function(){
            $(form + ' .overlay').show();;
            $(form + ' .form-group').removeClass('has-error has-feedback');
            $(form + ' .invalid-feedback').text('');
          }, 
          success : function(res){
            getWorkers();
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
      
      getWorkers();
      
      function getWorkers(){
        $.ajax({
          url : "{{ route('worker.table') }}",
          method : 'get',
          dataType : 'json',
          beforeSend : function(){
            
          }, 
          success : function(res){
            //$("#console").text(res);
            $('#worker_table').html(res);
          },
          error: function (xhr, status, error){
            $('#console').html(xhr.responseText);
          }
        });
      }
      
      $('#worker_table').on('click', 'a.attendance', function(e){
          e.preventDefault();
          $('#workerTitle').text('');
          $('#workerTitle').hide();
          $('#workerMsg').text('');
          $('#workerMsg').hide();
          let id = $(this).data('id');
          $('#workerId').val(id);
          $.ajax({
              url : "{{ route('worker.detail') }}",
              method : 'post',
              dataType : 'json',
              data : {
                  id : id
              },
              beforeSend : function(){
                $('#attendance div.overlay').show();
              }, 
              success : function(res){
                $('#attendance div.overlay').hide();
                //$("#console").text(res);
                $('#workerName').val(res.name);
                $('#workerSelery').val(res.selery);
              },
              error: function (xhr, status, error){
                $('#console').html(xhr.responseText);
              }
          });
          $('#attendance').modal('show');
          getAttendanceStatus(id);
      });
      
      function getAttendanceStatus(id){
          $.ajax({
              url : "{{ route('worker.attendaneStatus') }}",
              method : 'post',
              dataType : 'json',
              data : {
                  id : id
              },
              success : function(res){
                  if(res.available === true){
                      $('#workerTitle').show();
                      $('#workerTitle').text(res.title);
                      $('#workerMsg').show();
                      $('#workerMsg').text(res.msg);
                  }else{
                      $('#workerTitle').hide();
                      $('#workerMsg').hide();
                  }
                  
                  if(res.statuss == 'Present'){
                      $('#workerSelery').val(res.selery);
                  }
              },
              error: function (xhr, status, error){
                $('#console').html(xhr.responseText);
              }
          });
      }
      
      function submitAttendance(status){
          let _data = {
              worker_id : $('#workerId').val(),
              selery : $('#workerSelery').val(),
              status : status
          };
          
          $.ajax({
              url : "{{ route('worker.storeAttendance') }}",
              method : "post",
              dataType : "json",
              data : _data,
              beforeSend : function(){
                  $('#attendance div.overlay').show();
              }, 
              success : function(res){
                  $('#attendance div.overlay').hide();
                  Swal(res.t, res.m, res.s);
              },
              error: function (xhr, status, error){
                $('#console').html(xhr.responseText);
              }
          });
      }
      
      $('#workerPresent').click(function(e){
          e.preventDefault();
          submitAttendance('Present');
      });
      
      $('#workerAbsent').click(function(e){
          e.preventDefault();
          submitAttendance('Absent');
      });
      
      let x = {
          old : {},
          neu : {}
      };
      $('#worker_table').on('click', 'a.edit_worker', function(e){
          x.old, x.neu = {};
          x.old.name, x.neu.name, x.old.address, x.neu.address, x.old.phone, x.neu.phone, x.old.designation, x.neu.designation = undefined;
          e.preventDefault();
          let form = '#edit_worker_form';
          let id = $(this).data('id');
          $('#editId').val(id);
          $.ajax({
              url : "{{ route('worker.detail') }}",
              method : 'post',
              dataType : 'json',
              data : {
                  id : id
              },
              beforeSend : function(){
                $('#attendance div.overlay').show();
              }, 
              success : function(res){
                $('#attendance div.overlay').hide();
                $(form + ' input.name').val(res.name);
                $(form + ' input.address').val(res.address);
                $(form + ' input.phone').val(res.phone);
                $(form + ' input.selery').val(res.selery);
                $(form + ' input.designation').val(res.designation);
                x.old.name = res.name;
                x.old.address = res.address;
                x.old.phone = res.phone;
                x.old.selery = res.selery;
                x.old.designation = res.designation;
              },
              error: function (xhr, status, error){
                $('#console').html(xhr.responseText);
              }
          });
          $('#edit_worker_modal').modal('show');
      });
      
      $('#edit_worker_form').submit(function(e){
          e.preventDefault();
          let f = '#edit_worker_form ';
          x.neu.name = $(f + 'input.name').val();
          x.neu.address = $(f + 'input.address').val();
          x.neu.phone = $(f + 'input.phone').val();
          x.neu.selery = $(f + 'input.selery').val();
          x.neu.id = $(f + 'input.editId').val();
          x.neu.designation = $(f + 'input.designation').val();
          
          if(checkUpdateValue(x)){
              
              $.ajax({
                  url : "{{ route('worker.edit') }}",
                  method : 'post',
                  dataType : 'json',
                  data : x.neu,
                  beforeSend : function(){
                      
                  }, 
                  success : function(res){
                      Swal(res.t, res.m, res.s);
                  },
                  error: function (xhr, status, error){
                    $('#console').html(xhr.responseText);
                  }
              });
          }
      });
      
      function checkUpdateValue(x){
          let count = 0;
          if(x.old.name != x.neu.name){
              count++;
          }
          if(x.old.address != x.neu.address){
              count++;
          }
          
          if(x.old.phone != x.neu.phone){
              count++;
          }
          if(x.old.selery != x.neu.selery){
              count++;
          }
          
          if(x.old.designation != x.neu.designation){
              count++;
          }
          
          if(count === 0){
              Swal('Error', 'Change something to perform update operation.', 'warning');
              return false;
          }else{
              return true;
          }
      }
      
      $('#worker_table').on('click', 'a.payment', function(e){
          e.preventDefault();
          $('#payment form')[0].reset();
          $('#payment .form-group').removeClass('has-error has-feedback');
          $('#payment .invalid-feedback').text('');
          let id = $(this).data('id');
          $('#workerIdp').val(id);
          $.ajax({
              url : "{{ route('worker.detail') }}",
              method : 'post',
              dataType : 'json',
              data : {
                  id : id
              },
              beforeSend : function(){
                $('#payment div.overlay').show();
              }, 
              success : function(res){
                $('#payment div.overlay').hide();
                $('#payment input.balance').val(res.balance);
                $('#payment input.workerName').val(res.name);
              },
              error: function (xhr, status, error){
                $('#console').html(xhr.responseText);
              }
          });
          $('#payment').modal('show');
      });
      
      function StoreWorkerPayment(){
        let form = "#payment";
        let _data = {
          worker_id : $(form + ' input#workerIdp').val(),
          amount : $(form + ' input.amount').val()
        };
        
        $.ajax({
          url : "{{ route('workerPayment.store') }}",
          method : 'post', 
          dataType : 'json',
          data : _data,
          beforeSend : function(){
            $(form + ' .overlay').show();
            $(form + ' .form-group').removeClass('has-error has-feedback');
            $(form + ' .invalid-feedback').text('');
          }, 
          success : function(res){
            $(form + ' .overlay').hide();
            Swal(res.t, res.m, res.s);
            $(form + ' form')[0].reset();
            $(form).modal('hide');
            
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
      
      $('#payment').submit(function(e){
          e.preventDefault();
          StoreWorkerPayment();
      });
      
      
      
  });
  
</script>

@endsection

