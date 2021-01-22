<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  @yield('title')
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('css/bootstrap/dist/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/AdminLTE.min.css') }}">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body onload="window.print();">
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    
    @php
    
        $cName = App\Model\Company::where('init', 'Compani_Title')->first()->config;
        $short = App\Model\Company::where('init', 'Short_Title')->first()->config;
        $address = App\Model\Company::where('init', 'Address')->first()->config;
        $phone = App\Model\Company::where('init', 'Phone')->first()->config;
        $email = App\Model\Company::where('init', 'Email')->first()->config;
    
    @endphp
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          <i class="fa fa-globe"></i> {{ $cName . ' ('. $short . ')' }}
          <small class="pull-right">Date: {{ Dates::SR(Dates::Today()) }}</small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        From
        <address>
          <strong>{{ $cName . ' ('. $short . ')' }}</strong><br>
          Addrese: {{ $address }}<br>
          Phone: {{ $phone }}<br>
          Email: {{ $email }}
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        To
        @yield('billTo')
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        @yield('billDetail')
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
            <th>Qty</th>
            <th>Product</th>
            <th>Quantity</th>
            <th>Rate</th>
            <th>Subtotal</th>
          </tr>
          </thead>
          <tbody>
              @yield('bill_items')
          </tbody>
          <tfoot>
            <tr>
              <th colspan="4">Total Amount</th>
              <th>@yield('subtotal')</th>
            </tr>
          </tfoot>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <!-- accepted payments column -->
      <div class="col-xs-6">
        <p class="lead">Payment Methods:</p>
        <i class="fa fa-doller"></i> <span class="btn btn-info">Cash</span>
        <i class="fa fa-doller"></i> <span class="btn btn-info">Bank Transfer</span>
        <i class="fa fa-doller"></i> <span class="btn btn-info">bKash</span>
        <i class="fa fa-doller"></i> <span class="btn btn-info">Nagad</span>
        <i class="fa fa-doller"></i> <span class="btn btn-info">Rocket</span>

        <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
          @if($due > 0)
           Please pay the due amount as soon as possible.
          @else
           Thank you for deal with us. You are really a nice person and have outstanding personality.
          @endif
        </p>
      </div>
      <!-- /.col -->
      <div class="col-xs-6">
        <p class="lead">Amount Due 2/22/2014</p>

        <div class="table-responsive">
          <table class="table">
              @yield('bill_total')
          </table>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>
