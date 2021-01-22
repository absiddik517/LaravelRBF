@extends('layouts.master')

@section('title')
  <title>RBF - Dashboard</title>
@endsection


@section('body')
    <section class="content-header">
      <h1>
        {{ __('str.dashboard') }}
        <small>{{ __('str.cpanel') }}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> {{ __('str.home') }} </a></li>
        <li class="active">{{ __('str.dashboard') }}</li>
      </ol>
    </section>
    
    <pre id="console"></pre>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
      <style>
        .init img{
          position: absolute;
          top: 50%;
          left: 50%;
          transform: translate(-50%, -50%);
          display: none;
        }
      </style>
        <div class="col-lg-3 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-aqua init">
            <div class="inner">
              <img data-role="loader" src="{{ asset('images/system/spinner.gif') }}" alt="">
              <h3 id="cash">{{ Money::Cash() }}</h3>

              <p>{{ __('str.cash') }}</p>
              
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a id="cashDetails" href="#" class="small-box-footer">{{ __('str.more_info') }}<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <!-- ./col -->
        <div class="col-lg-3 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-green init">
            <div class="inner">
              <img data-role="loader" src="images/spinner.gif" alt="">
              <h3 id="paid_sell">{{ Money::PaidSell() }}</h3>

              <p>{{ __('str.paid_sell') }}</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" id="paidSellDetail" class="small-box-footer">{{ __('str.more_info') }}<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-green init">
            <div class="inner">
              <img data-role="loader" src="images/spinner.gif" alt="">
              <h3 id="deu_pay">{{ Money::DuePay() }}</h3>

              <p>{{ __('str.due_pay') }}</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" id="duePayDetail" data-toggle="modal" data-target="#duePayModal" class="small-box-footer">{{ __('str.more_info') }}<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-green init">
            <div class="inner">
              <img data-role="loader" src="images/spinner.gif" alt="">
              <h3 id="outcash">{{ Money::Outcash() }}</h3>

              <p>{{ __('str.outcash') }}</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer" id="outcashDetail">{{ __('str.more_info') }}<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->

        <div class="col-lg-4 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-red init">
            <div class="inner">
              <img data-role="loader" src="images/spinner.gif" alt="">
              <h3 id="cost">{{ Money::Cost() + Money::WorkerPayment() + Money::StaffPayment() + Money::DealerPayment() +  Money::PartyDailyAdvance() }}</h3>

              <p>{{ __('str.cost') }}</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" id="costDetail" class="small-box-footer" data-toggle="modal" data-target="#costModal">{{ __('str.more_info') }}<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-4 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-red init">
            <div class="inner">
              <img data-role="loader" src="images/spinner.gif" alt="">
              <h3 id="submit_cash">{{ Money::SubmitCash() }}</h3>

              <p>{{ __('str.submit_cash') }}</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" id="submitCashDetail" class="small-box-footer" data-toggle="modal" data-target="#submitCashModal">{{ __('str.more_info') }}<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-4 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-red init">
            <div class="inner">
              <img data-role="loader" src="images/spinner.gif" alt="">
              <h3 id="pay_loan">0</h3>

              <p>{{ __('str.outcash_pay') }}</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" id="loanPayDetail" data-toggle="modal" data-target="#loanPayModal" class="small-box-footer">{{ __('str.more_info') }}<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <style>
            .unit{
                font-size: 10px;
            }
        </style>
        
        @php 
        $delevery = array();
        @endphp
        @foreach(App\Model\Products::all() as $prod)
        @php 
            $del = DB::table('delevery_products')
            ->join('sells', 'delevery_products.ref', '=', 'sells.ref')
            ->join('products', 'sells.product_id', '=', 'products.id')
            ->select('delevery_products.quantity as quantity', 'sells.product_id')
            ->where('sells.product_id', $prod->id)
            ->where('delevery_products.date', Dates::Today())
            ->sum('delevery_products.quantity');
            
            $delevery[$prod['id']] = $del;
            
        
        @endphp
        
        <div class="col-lg-4 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-yellow init">
            <div class="inner">
              <img data-role="loader" src="images/spinner.gif" alt="">
              <h3 id="delevery_product">{{ $del }} <span class="unit">{{ $prod->unit }}</span></h3>

              <p>{{ $prod['name'] }}</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="deleveryDetail small-box-footer" data-id="{{ $prod['id'] }}">{{ __('str.more_info') }}<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        @endforeach
        
        @php var_dump($delevery); @endphp

      </div>







      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right">
              <li class="active"><a href="#revenue-chart" data-toggle="tab">{{ __('str.sells') }}</a></li>
              <li><a href="#sales-chart" data-toggle="tab">{{ __('str.delevery') }}</a></li>
              <li><a href="#cash-chart" data-toggle="tab">{{ __('str.cash') }}</a></li>
              <li class="pull-left header"><i class="fa fa-inbox"></i>{{ __('str.last_seven_day') }}</li>
            </ul>
            <div class="tab-content no-padding">
              <!-- Morris chart - Sales -->
              <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 670px;">
                
                <canvas id="sellsChart"></canvas>

              </div>
              <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 670px;">
                <canvas id="deleveryChart"></canvas>
              </div>

              <div class="chart tab-pane" id="cash-chart" style="position: relative; height: 670px;">
                <canvas id="cashChart"></canvas>
              </div>

            </div>
          </div>
        </section>


      </div>
      <!-- /.row (main row) -->

      <div class="row">
        <div class="col-lg-3 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-aqua init">
            <div class="inner">
              <img data-role="loader" src="images/spinner.gif" alt="">
              <h3 id="all_brick">0</h3>

              <p>Brick Sell</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-aqua init">
            <div class="inner">
              <img data-role="loader" src="images/spinner.gif" alt="">
              <h3 id='all_khuwa'>0</h3>

              <p>Khuwa Sell</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-aqua init">
            <div class="inner">
              <img data-role="loader" src="images/spinner.gif" alt="">
              <h3 id="all_adla">0</h3>

              <p>Adla Sell</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-aqua init">
            <div class="inner">
              <img data-role="loader" src="images/spinner.gif" alt="">
              <h3 id="all_cash">0</h3>

              <p>{{ __('str.total_cash') }}</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->

        <div class="col-lg-3 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-aqua init">
            <div class="inner">
              <img data-role="loader" src="images/spinner.gif" alt="">
              <h3 id="all_del_brick">0</h3>

              <p>Delevery Brick</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-aqua init">
            <div class="inner">
              <img data-role="loader" src="images/spinner.gif" alt="">
              <h3 id="all_del_khuwa">0</h3>

              <p>Delevery Khuwa</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-aqua init">
            <div class="inner">
              <img data-role="loader" src="images/spinner.gif" alt="">
              <h3 id="all_del_adla">0</h3>

              <p>Delevery Adla</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-aqua init">
            <div class="inner">
              <img data-role="loader" src="images/spinner.gif" alt="">
              <h3 id="all_cost">0</h3>

              <p>{{ __('str.total_cost') }}</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
          </div>
        </div>

      </div>

    </section>
    @include('pages.dashboard.model')
@endsection

@section('script')
  <script>
    $(document).ready(function() {
      $.ajaxSetup({
        headers : { 'X-CSRF-Token' : '{{ csrf_token() }}'}
      });

      const c = {
        m : {
            modal : $('#cashDetailsModal'),
            overlay : $('#cashDetailsModal .overlay'),
            content : $('#cashDetailsModal .modal-body'),
            title : $('#cashDetailsModal .modal-title'),
        },
        
        s : {
            cash : $('#cashDetails'),
            paid_sell : $('#paidSellDetail'),
            due_pay : $('#duePayDetail'),
            outcash : $('#outcashDetail'),
            cost : $('#costDetail'),
            submit_cash : $('#submitCashDetail'),
            outcash_pay : $('#loanPayDetail'),
            delevery : $('.deleveryDetail'),
        }
      };
      
      c.s.cash.click(function(e){
          e.preventDefault();
          let config = {
              title : '{{ __('str.cash_detail') }}',
              route : "{{ route('dash.detail') }}",
              method : 'get',
              data : {}
          };
          SendRequest(config);
      });
      
      c.s.paid_sell.click(function(e){
         e.preventDefault();
         let config = {
              title : '{{ __('str.sells_history') }}', 
              route : "{{ route('dash.detail') }}",
              method : 'post',
              data : {query : 'paid_sell'}
          };
          SendRequest(config);
      });
      
      c.s.due_pay.click(function(e){
         e.preventDefault();
         let config = {
              title : '{{ __('str.due_pay_history') }}',
              route : "{{ route('dash.detail') }}",
              method : 'post',
              data : {query : 'due_pay'}
          };
          SendRequest(config);
      });
      
      c.s.outcash.click(function(e){
         e.preventDefault();
         let config = {
              title : '{{ __('str.outcash_history') }}',
              route : "{{ route('dash.detail') }}",
              method : 'post',
              data : {query : 'outcash'}
          };
          SendRequest(config);
      });
      
      c.s.outcash_pay.click(function(e){
         e.preventDefault();
         let config = {
              title : '{{ __('str.outcash_pay_history') }}',
              route : "{{ route('dash.detail') }}",
              method : 'post',
              data : {query : 'outcash_pay'}
          };
          SendRequest(config);
      });
      
      c.s.cost.click(function(e){
         e.preventDefault();
         let config = {
              title : '{{ __('str.cost_history') }}',
              route : "{{ route('dash.detail') }}",
              method : 'post',
              data : {query : 'cost'}
          };
          SendRequest(config);
      });
      
      c.s.submit_cash.click(function(e){
         e.preventDefault();
         let config = {
              title : '{{ __('str.submit_cash_history') }}',
              route : "{{ route('dash.detail') }}",
              method : 'post',
              data : {query : 'submit_cash'}
          };
          SendRequest(config);
      });
      
      c.s.delevery.click(function(e){
         e.preventDefault();
         let config = {
              title : '{{ __('str.delevery_history') }}',
              route : "{{ route('dash.detail') }}",
              method : 'post',
              data : {
                  query : 'delevery',
                  id : $(this).data('id')
              }
          };
          SendRequest(config);
          //alert(config.data.id);
      });
      
      
      
      function SendRequest(config){
          c.m.title.text(config.title);
          c.m.modal.modal('show');
          $.ajax({
              url : config.route,
              method : config.method,
              data : config.data,
              beforeSend : function(){
                  c.m.content.html('');
                  c.m.overlay.show();
              },
              success: function(res){
                  c.m.overlay.hide();
                  c.m.content.html(res);
                  $('#console').text(res);
              },
              error: function(xhr, status, error){
                  c.m.overlay.hide();
                  $('#console').html(xhr.responseText);
              }
          });
      }
      
      

    });

  </script>
@endsection