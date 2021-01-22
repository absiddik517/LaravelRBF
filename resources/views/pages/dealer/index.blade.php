@extends('layouts.master')

@section('title')
  <title>Dealers</title>
@endsection


@section('body')
  <section class="content-header">
      <h1>
        Dealer
        <small>View All Dealer</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="/dealers">Dealer</a></li>
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

              <h3 class="box-title">Dealer List</h3>

              <div class="box-tools pull-right">
                <button type="button" data-toggle="modal" data-target="#create_dealer_modal" class="btn bg-teal">Add Dealer
                </button>
                <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
            </div>

            <div class="box-body border-radius-none">
              <div class="table-responsive">
                <div id="dealerTable"></div>
              </div>

            </div>


        </section>

      </div>
      <!-- /.row (main row) -->
    </section>
   
<div id="create_dealer_modal" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lg">
        <!-- modal content -->
        <div class="modal-content">
          <div class="modal-header">
            <button class="close closeBtn" type="button" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add New Dealer</h4>
          </div>
          <form id="AddDealerForm" action="" method="post">
            <div class="overlay"><img src="{{ asset('images/system/spinner.gif') }}" alt=""></div>

          <div class="modal-body">
            
            <div class="name_group form-group">
              <label for="">Name *</label>
              <input type="text" class="name form-control">
              <div class="invalid-feedback"></div>
            </div>
            
            <div class="title_group form-group">
              <label for="">Title *</label>
              <input type="text" class="title form-control">
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
      
      $('#AddDealerForm').submit(function(e){
        e.preventDefault();
        StoreNewDealer();
      });
      
      function StoreNewDealer(){
        let form = "#AddDealerForm";
        let _data = {
          name         : $(form + ' input.name').val(),
          title        : $(form + ' input.title').val(),
          address      : $(form + ' input.address').val(),
          phone        : $(form + ' input.phone').val()
        };
        
        
        $.ajax({
          url : "{{ route('dealer.store') }}",
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
            $('#create_dealer_modal').modal('hide');
            
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
          url : "{{ route('dealer.table') }}",
          method : 'get',
          dataType : 'json',
          beforeSend : function(){
            
          }, 
          success : function(res){
            $("#console").text(res);
            $('#dealerTable').html(res);
          },
          error: function (xhr, status, error){
            $('#console').html(xhr.responseText);
          }
        });
      }
      
      
    });
  </script>

@endsection