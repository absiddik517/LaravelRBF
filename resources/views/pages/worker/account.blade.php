@extends('layouts.master')

@section('title')
  <title>Worker Account</title>
@endsection


@section('body')
  <section class="content-header">
      <h1>
        Worker
        <small>View Worker Account</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/staff">Worker</a></li>
        <li class="active"><a href="/staff/account/2">{{ $worker->name }}</a></li>
      </ol>
    </section>
    <pre id="console"></pre>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <section class="col-lg-6 connectedSortable">
          <div class="box box-solid ">
            <div class="box-header bg-teal-gradient">
              <i class="fa fa-th"></i>

              <h3 class="box-title">Worker Detail</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
            </div>

            <div class="box-body border-radius-none">
                <div class="panel panel-success">
                  <div class="panel-heading">
                      <b>Worker Detail</b>
                  </div>

                  <div class="panel-body">
                      <div class="form-horizontal">
                          <div class="form-group">
                              <label for="name" class="col-xs-3">Name</label>
                              <span class="col-xs-1">:</span>
                              <div class="col-xs-7">
                                <span><b>{{ $worker->name }}</b></span>
                              </div>
                          </div>

                          <div class="form-group">
                              <label for="name" class="col-xs-3">Address</label>
                              <span class="col-xs-1">:</span>
                              <div class="col-xs-7">
                                <span><b>{{ $worker->address }}</b></span>
                              </div>
                          </div>

                          <div class="form-group">
                              <label for="name" class="col-xs-3">Designation</label>
                              <span class="col-xs-1">:</span>
                              <div class="col-xs-7">
                                <span><b>{{ $worker->designation }}</b></span>
                              </div>
                          </div>

                          <div class="form-group">
                              <label for="name" class="col-xs-3">Phone</label>
                              <span class="col-xs-1">:</span>
                              <div class="col-xs-7">
                                <span><b>{{ $worker->phone }}</b></span>
                              </div>
                          </div>

                          <div class="form-group">
                              <label for="name" class="col-xs-3">Selery</label>
                              <span class="col-xs-1">:</span>
                              <div class="col-xs-7">
                                <span><b>{{ $worker->selery }}</b></span>
                              </div>
                          </div>
                      </div>
                  </div>
                </div>
            </div>
        </section>



        <section class="col-lg-6 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="box box-solid ">
            <div class="box-header bg-teal-gradient">
              <i class="fa fa-th"></i>

              <h3 class="box-title">Account Details</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
            </div>

            <div class="box-body border-radius-none">
                <div class="panel panel-warning" style="position: relative;">
                  <div class="overlay" id="ad_overlay"><img src="images/spinner.gif"></div>
                  <div class="panel-heading">
                      <b>Account details</b>
                  </div>

                  <div class="panel-body">
                      <div class="form-horizontal">
                          <div class="form-group">
                              <label for="name" class="col-xs-3">Working days</label>
                              <span class="col-xs-1">:</span>
                              <div class="col-xs-7">
                                <span><b id="ad_month"></b></span>
                              </div>
                          </div>

                          <div class="form-group">
                              <label for="name" class="col-xs-3">Total Selery</label>
                              <span class="col-xs-1">:</span>
                              <div class="col-xs-7">
                                <span><b id="ad_selery"></b></span>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="name" class="col-xs-3 text-danger">Paid</label>
                              <span class="col-xs-1">:</span>
                              <div class="col-xs-7">
                                <span class="text-danger"><b id="ad_paid"></b></span>
                              </div>
                          </div>

                          <div class="form-group">
                              <label for="name" class="col-xs-3 text-success">Balance</label>
                              <span class="col-xs-1">:</span>
                              <div class="col-xs-7">
                                <span class="text-success"><b id="ad_balance"></b></span>
                              </div>
                          </div>
                      </div>
                  </div>
                </div>
            </div>


        </section>



        <section class="col-lg-6 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="box box-solid ">
            <div class="box-header bg-teal-gradient">
              <i class="fa fa-th"></i>

              <h3 class="box-title">Worker Payments</h3>

              <div class="box-tools pull-right">
                <button 
                class="btn btn-info btn-sm"
                data-id="{{ $id }}"
                id="takeAttendance"
                ><b>Attendance</b></button>
                <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
            </div>

            <div class="box-body border-radius-none">
                <div class="table-responsive">
                  <table id="selery_table" class="table table-border table-hover table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Month</th>
                        <th>Amount</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @for ($i = 1; $i < 16; $i++)
                        <tr>
                          <td>{{ $i }}</td>
                          <td>{{ date('d-m-Y') }}</td>
                          <td>{{ random_int(01, 12) }}</td>
                          <td>{{ random_int(6000, 15000) }}</td>
                          <td>{{ 'Update' }}</td>
                        </tr>

                      @endfor
                    </tbody>
                    <tfoot>
                      <tr>
                        <th colspan="3">Total</th>
                        <th colspan="2">{{ 12000 }}</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
            </div>


        </section>


        <section class="col-lg-6 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="box box-solid ">
            <div class="box-header bg-teal-gradient">
              <i class="fa fa-th"></i>

              <h3 class="box-title">Worker Attendance</h3>

              <div class="box-tools pull-right">
                <button 
                class="btn btn-danger btn-sm" 
                id="paySelery"
                data-id="{{ $id }}"
                ><b>Pay Selery</b></button>
                <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
            </div>

            <div class="box-body border-radius-none">
                <div class="table-responsive">
                  <table id="payment_table" class="table table-border table-hover table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @for ($i = 1; $i < 16; $i++)
                        <tr>
                          <td>{{ $i }}</td>
                          <td>{{ date('d-m-Y') }}</td>
                          <td>{{ random_int(6000, 15000) }}</td>
                          <td>{{ 'Update' }}</td>
                        </tr>
                      @endfor
                    </tbody>
                    <tfoot>
                      <tr>
                        <th colspan="2">Total</th>
                        <th colspan="2">{{ 12000 }}</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
            </div>
        </section>

      </div>
      <!-- /.row (main row) -->

    </section>
    
    
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



@endsection


@section('script')
  <script>
  	$(document).ready(function() {
      $.ajaxSetup({
        headers : { 'X-CSRF-Token' : '{{ csrf_token() }}'}
      });
      let obj = {
          id : {{ $id }}
      }
      accountDetail();
      function accountDetail(){
          $.ajax({
              url : "{{ route('worker.accountDetail') }}",
              method : 'post',
              dataType : 'json',
              data : {
                  id : obj.id
              },
              beforeSend : function(){
                  
              },
              success : function(res){
                  $('#ad_selery').text(res.selery);
                  $('#ad_month').text(res.days);
                  $('#ad_paid').text(res.paid);
                  $('#ad_balance').text(res.balance);
              },
              error: function (xhr, status, error){
                $('#console').html(xhr.responseText);
              }
          });
      }
      
      $('#paySelery').on('click', function(e){
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
            accountDetail();
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
      
      // new 
      
      $('#takeAttendance').on('click', function(e){
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
                  $('#attendance').modal('hide');
                  Swal(res.t, res.m, res.s);
                  accountDetail();
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
      
  	});
  </script>
@endsection