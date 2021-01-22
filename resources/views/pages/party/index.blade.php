@extends('layouts.master')

@section('title')
  <title>Party</title>
@endsection


@section('body')
  <section class="content-header">
      <h1>
        Party
        <small>View All Party</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/party">Party</a></li>
        <li class="active"><a href="/party/mail-party">Mail Party</a></li>
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

              <h3 class="box-title">Sardar List</h3>

              <div class="box-tools pull-right">
                <button type="button" id="btn_add_party" class="btn bg-teal">Add Party
                </button>
                <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
            </div>

            <div class="box-body border-radius-none">
              <div id="console"></div>
              <div class="table-responsive">
                <div id="party_table"></div>
              </div>

            </div>


        </section>

      </div>
      <!-- /.row (main row) -->
    </section>
  
<div id="create_party_modal" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lg">
        <!-- modal content -->
        <div class="modal-content">
          <div class="modal-header">
            <button class="close closeBtn" type="button" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add New Party</h4>
          </div>
          <form id="AddPartyForm" action="" method="post">
            <div class="overlay"><img src="{{ asset('images/system/spinner.gif') }}" alt=""></div>

          <div class="modal-body">
            
            <div class="party_type_group form-group">
              <label for="">Party Type *</label>
              <select class="party_type form-control">
                <option value="">-------------</option>
                @foreach(App\Model\PartyType::get() as $t)
                  <option value="{{ $t['id'] }}">{{ $t['name'] }}</option>
                @endforeach
              </select>
              <div class="invalid-feedback"></div>
            </div>
            
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
            
            <div class="rate_group form-group">
              <label for="">Rate *</label>
              <input type="text" data-intype="number" class="rate form-control" data-intype="number">
              <div class="invalid-feedback"></div>
            </div>
            
            <div class="deal_group form-group">
              <label for="">Deal</label>
              <input type="text" data-intype="number" class="deal form-control" data-intype="number">
              <div class="invalid-feedback"></div>
            </div>
            
            <div class="advance_group form-group">
              <label for="">Advance </label>
              <input type="text" data-intype="number" class="advance form-control" data-intype="number">
              <div class="invalid-feedback"></div>
            </div>
            
            
            <div class="cutting_rate_group form-group">
              <label for="">Cutting Rate </label>
              <input type="text" data-intype="number" class="cutting_rate form-control" data-intype="number">
              <div class="invalid-feedback"></div>
            </div>
            
            
            
            <div class="billing_day_group form-group">
              <label for="">Billing Day *</label>
              <input type="text" data-intype="number" class="billing_day form-control" data-intype="number">
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
    
      
      
      $('#btn_add_party').click(function(){
        init_party_form();
        $('#create_party_modal').modal('show');
      });
      
      $('#AddPartyForm .party_type').change(function(){
        let type = $(this).val();
        if(type == ''){ 
          init_party_form();
        }else{
          $.ajax({
            url : "{{ route('partytype.data') }}",
            method : 'post',
            dataType : 'json',
            data: {
              id : type
            },
            success: function(res){
              $('#console').text(res.billing_system);
              let form = "#AddPartyForm";
              let advance_rel = ['deal', 'advance', 'cutting_rate'];
              if(res.allow_advance == 'true'){
                for(let i = 0; i < advance_rel.length; i++){
                  $(form + ' .' + advance_rel[i]).removeAttr('disabled');
                  $(form + ' .' + advance_rel[i] + '_group').slideDown(300);
                }
              }else{
                for(let i = 0; i < advance_rel.length; i++){
                  $(form + ' .' + advance_rel[i]).attr('disabled', 'disabled');
                  $(form + ' .' + advance_rel[i] + '_group').slideUp(300);
                }
              }
              
              if(res.billing_system == "undefine" || res.billing_system == 'daily'){
                $(form + ' .billing_day').attr('disabled', 'disabled');
                $(form + ' .billing_day_group').slideUp(300);
              }
              else if(res.billing_system == 'monthly' || res.billing_system == 'weekly'){
                $(form + ' .billing_day').removeAttr('disabled');
                $(form + ' .billing_day_group').slideDown(300);
                
              }
            },
            error: function(xhr, status, error){
              $('#console').html(xhr.responseText);
            }
          });
        }
      });
      $('#AddPartyForm').submit(function(e){
        e.preventDefault();
        StoreNewDealer();
      });
      
      function init_party_form(){
        let form = "#AddPartyForm";
        let hides = ['deal', 'advance', 'cutting_rate', 'billing_day'];
        for(let i = 0; i < hides.length; i++){
          $(form + ' .' + hides[i]).attr('disabled', 'disabled');
          $(form + ' .' + hides[i] + '_group').hide();
        }
      }
      
      
      function StoreNewDealer(){
        let form = "#AddPartyForm";
        let _data = {
          party_type   : $(form + ' select.party_type').val(),
          name         : $(form + ' input.name').val(),
          address      : $(form + ' input.address').val(),
          phone        : $(form + ' input.phone').val(),
          rate         : $(form + ' input.rate').val(),
          deal         : $(form + ' input.deal').val(),
          advance      : $(form + ' input.advance').val(),
          cutting_rate : $(form + ' input.cutting_rate').val(),
          billing_day  : $(form + ' input.billing_day').val()
        };
        
        
        $.ajax({
          url : "{{ route('party.store') }}",
          method : 'post', 
          dataType : 'json',
          data : _data,
          beforeSend : function(){
            //$(form + ' .overlay').show();
            $(form + ' .form-group').removeClass('has-error has-feedback');
            $(form + ' .invalid-feedback').text('');
          }, 
          success : function(res){
            getPartyList();
            //$(form + ' .overlay').hide();
            Swal(res.t, res.m, res.s);
            $(form)[0].reset();
            $('#create_dealer_modal').modal('hide');
            
          },
          error : function(xhr, status, error){
            //$(form + ' .overlay').hide();
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
      
      getPartyList();
      
      function getPartyList(){
        $.ajax({
          url : "{{ route('party.list') }}",
          method : 'get',
          dataType : 'json',
          beforeSend : function(){
            
          }, 
          success : function(res){
            $('#party_table').html(res);
          },
          error: function (xhr, status, error){
            $('#console').html(xhr.responseText);
          }
        });
      }
      
      
    });
  </script>

@endsection