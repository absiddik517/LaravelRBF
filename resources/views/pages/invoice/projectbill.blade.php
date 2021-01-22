@extends('layouts.invoiceMaster')

@section('title')
  <title>Bill</title>
@endsection

@section('billTo')
    <address>
      <strong>{{ $project->owner }}</strong><br>
      Phone: {{ $project->phone }}<br>
      Email: {{ $project->email }}<br>
      Project: {{ $project->title }}<br>
      Location: {{ $project->location }}
    </address>
@endsection

@section('billDetail')
    <b>Invoice #{{ date('ym').'-'.$bill->id }}</b><br>
    <br>
    <b>Created at:</b> {{ Dates::SR($bill->date) }}<br>
    <b>Range:</b> {{ Dates::SR($bill->first_date). ' to '. Dates::SR($bill->last_date) }}<br>
    <b>Account:</b> #{{ 'pid-'. $bill->project_id }}
@endsection

@section('bill_items')
    @php 
        $total = 0;
        $i = 1;
        $due = $bill->total - $paid
    @endphp
    @foreach(json_decode($bill->quantity) as $key)
      @if($key->quantity > 0)
      <tr>
        <td> {{ $i }}</td>
        <td> {{ ProjectHelper::PName($key->product_id) }}</td>
        <td>{{ $key->quantity .' '.ProjectHelper::PUnit($key->product_id) }}</td>
        <td>{{ $key->rate }}</td>
        <td>{{ '৳ '.$key->quantity * $key->rate }}</td>
      </tr>
      
      @php 
          $i++;
          $total += $key->quantity * $key->rate;
      @endphp
      @endif
    @endforeach
@endsection

@section('subtotal')
    {{ '৳ '.$total }}
@endsection

@section('bill_total')

    <tr>
      <th style="width:50%">Subtotal</th>
      <td>{{ '৳ '.$total }}</td>
    </tr>
    @if($bill->previous_due > 0)
    <tr>
      <th>Previous Due</th>
      <td>{{ '৳ '.$bill->previous_due }}</td>
    </tr>
    @endif
    @if($bill->transport > 0)
    <tr>
      <th>Transport</th>
      <td>{{ '৳ '.$bill->transport }}</td>
    </tr>
    @endif
    @if($bill->advance_cutting > 0)
    <tr style="color:red;">
      <th>Advance Payment</th>
      <td>{{ '৳ '.$bill->advance_cutting }}</td>
    </tr>
    @endif
    <tr>
      <th>Total</th>
      <td>{{ '৳ '.$bill->total }}</td>
    </tr>
    
    @if($paid > 0)
    <tr>
      <th>Paid</th>
      <td>{{ '৳ '.$paid }}</td>
    </tr>
    <tr>
      <th>Due</th>
      <td>{{ '৳ '.$due }}</td>
    </tr>
    @endif
    
@endsection

