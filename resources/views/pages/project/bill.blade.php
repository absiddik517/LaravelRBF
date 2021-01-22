@extends('layouts.master')



@section('title')
  <title>Bill Detail</title>
@endsection


@section('body')
  <section class="content-header">
      <h1>
        Project Bill
        <small>Detail</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ route('project.index') }}">Project</a></li>
        <li><a href="{{ route('project.index') }}">Bill</a></li>
        <li class="active"><a href="/">Details</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        

      <div class="row">

        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="box box-solid" style="">
            <div class="box-header">
              <i class="fa fa-th"></i>

              <h3 class="box-title">Project Details</h3>

            </div>

            <div class="box-body border-radius-none">
                
                <table class="table">
                    
                    <tr>
                        <td>Project</td>
                        <td><b>{{ $project->title }}</b></td>
                    </tr>
                    
                    <tr>
                        <td>Owner</td>
                        <td><b>{{ $project->owner }}</b></td>
                    </tr>
                    
                    <tr>
                        <td>Phone</td>
                        <td><b>{{ $project->phone }}</b></td>
                    </tr>
                    
                    <tr>
                        <td>Email</td>
                        <td><b>{{ $project->email }}</b></td>
                    </tr>
                    
                    <tr>
                        <td>Start at</td>
                        <td><b>{{ Dates::SR($project->date) }}</b></td>
                    </tr>
                </table>
                
                <div class="box-footer">
                    <a href="{{ route('invoice.project', $bill->id) }}" class="pull-right btn btn-info">Print</a>
                </div>
              
            </div>
            
          </div>


          <div class="box box-solid" style="position: relative;">
            <div class="box-header">
              <i class="fa fa-th"></i>

              <h3 class="box-title">Bill Details</h3>
            </div>

            <div class="box-body border-radius-none" id="deleveryProductBody">
                <table class="table">
                    
                    <tr>
                        <td>Create at</td>
                        <td><b>{{ Dates::SR($bill->date) }}</b></td>
                    </tr>
                    
                    <tr>
                        <td>Range</td>
                        <td><b>{{ Dates::SR($bill->first_date) }} to {{ Dates::SR($bill->last_date) }}</b></td>
                    </tr>
                    
                    <tr>
                        <td>Product Price</td>
                        <td><b>{{ $bill->sub_total }}</b></td>
                    </tr>
                    @if($bill->previous_due > 0)
                    <tr>
                        <td>Previous Due</td>
                        <td><b>{{ $bill->previous_due }}</b></td>
                    </tr>
                    @endif
                    @if($bill->transport > 0) 
                    <tr>
                        <td>Transport</td>
                        <td><b>{{ $bill->transport }}</b></td>
                    </tr>
                    @endif
                    
                    @if($bill->advance_cutting > 0)
                    <tr style="color : red;">
                        <td>Advance</td>
                        <td><b>{{ $bill->advance_cutting }}</b></td>
                    </tr>
                    @endif
                    
                    <tr>
                        <td>Total Amount</td>
                        <td><b>{{ $bill->total }}</b></td>
                    </tr>
                    @if($total_payment > 0)
                    <tr>
                        <td>Total Paid</td>
                        <td><b>{{ $total_payment }}</b></td>
                    </tr>
                    @endif
                    @if($bill->total - $total_payment > 0 && $bill->total != $bill->total - $total_payment)
                    <tr>
                        <td>Due</td>
                        <td><b>{{ $bill->total - $total_payment }}</b></td>
                    </tr>
                    @endif
                </table>
                
                <table class="table table-border table-hover table-striped">
                    <caption>Delivery Summery</caption>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Rate</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @php
                            function PName($id){
                                $product = App\Model\Products::where('id', $id)->first();
                                return $product['name'];
                            }
                            function Unit($id){
                                $product = App\Model\Products::where('id', $id)->first();
                                return $product['unit'];
                            }
                            $total = 0;
                            $i = 1;
                        @endphp
                        @foreach(json_decode($bill->quantity) as $key)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ PName($key->product_id) }}</td>
                                <td>{{ $key->quantity.' '.Unit($key->product_id) }}</td>
                                <td>{{ $key->rate }}</td>
                                <td>{{ $key->rate * $key->quantity }}</td>
                            </tr>
                            @php
                                $total += $key->rate * $key->quantity;
                                $i++;
                            @endphp
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="4">Total</th>
                            <th>{{ $total }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>

          </div>
          
          <div class="box box-solid" style="position: relative;">
            <div class="box-header">
              <i class="fa fa-th"></i>

              <h3 class="box-title">Payment Detail</h3>
            </div>

            <div class="box-body border-radius-none" id="deleveryProductBody">
                <div class="table-responsive">
                <table class="table table-border table-hover table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Description</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php 
                            $i = 1;
                            $total = 0;
                        @endphp
                        @foreach($bill->Payment as $key)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ Dates::SR($key->date) }}</td>
                            <td>{{ $key->description }}</td>
                            <td>{{ $key->amount }}</td>
                        </tr>
                        @php
                            $i++;
                            $total += $key->amount;
                        @endphp
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3">Total</th>
                            <th>{{ $total }}</th>
                        </tr>
                    </tfoot>
                </table>
                </div>
            </div>

          </div>
          
          <div class="box box-solid" style="position: relative;">
            <div class="box-header">
              <i class="fa fa-th"></i>

              <h3 class="box-title">Delivery Details</h3>
            </div>

            <div class="box-body border-radius-none" id="deleveryProductBody">
                <div class="table-responsive">
                <table class="table table-border table-hover table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Delivery No</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Driver</th>
                            <th>Destination</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php 
                            $i = 1;
                        @endphp
                        @foreach($delevery as $key)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ Dates::SR($key->date) }}</td>
                            <td>{{ $key->dref }}</td>
                            <td>{{ PName($key->product_id) }}</td>
                            <td>{{ $key->quantity . ' ' . Unit($key->product_id) }}</td>
                            <td>{{ $key->driver }}</td>
                            <td>{{ $key->destination }}</td>
                        </tr>
                        @php
                            $i++;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>

          </div>

        </section>
        <!-- /.Left col -->
       </div>
    </section>    

@endsection


    
@section('script')
  <script>
    $(document).ready(function() {
      
      
    });
  </script>

@endsection