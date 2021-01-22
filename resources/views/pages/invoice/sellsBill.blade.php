@extends('layouts.invoiceMaster')

@section('title')
  <title>Bill</title>
@endsection

@section('billTo')
    <address>
      <strong>{{ $sell->name }}</strong><br>
      Address: {{ $sell->address }}<br>
      Phone: {{ $sell->phone }}
    </address>
@endsection

@section('billDetail')
    <b>Invoice #{{ date('ym').'-'.$sell->id }}</b><br>
    <br>
    <b>Reference:</b> {{ $sell->ref }} <br>
    <b>Date:</b> {{ Dates::SR($sell->date) }}<br>
@endsection

@section('bill_items')
    @php 
        $duePay = 0;
        foreach($sell->duePay as $key){
            $duePay += $key->amount;
        }
        
        $total = $sell->total;
        $paid = $sell->paid;
        
        $due = $total - $paid - $duePay;
    @endphp
    
      <tr>
        <td> {{ 1 }}</td>
        <td> {{ ProjectHelper::PName($sell->product_id) }}</td>
        <td>{{ $sell->quantity .' '.ProjectHelper::PUnit($sell->product_id) }}</td>
        <td>{{ $sell->rate }}</td>
        <td>{{ '৳ '.$sell->quantity * $sell->rate }}</td>
      </tr>
      
      @if($sell->transport_rate > 0)
          <tr>
              <td>2</td>
              <td>Transport</td>
              <td>{{ $sell->quantity .' '.ProjectHelper::PUnit($sell->product_id) }}</td>
              <td>{{ $sell->transport_rate }}</td>
              <td>{{ '৳ '.$sell->transport_rate * $sell->quantity }}</td>
          </tr>
      @endif
      
@endsection

@section('subtotal')
    {{ '৳ '.$total }}
@endsection

@section('bill_total')

    
    <tr>
      <th>Total</th>
      <td>{{ '৳ '.$total }}</td>
    </tr>
    
    @if($paid > 0 || $duePay > 0)
    <tr>
      <th>Paid</th>
      <td>{{ '৳ '.$paid }}</td>
    </tr>
    @if($duePay > 0)
    <tr>
        <td>Due Payment</td>
        <td>{{ '৳ '.$duePay }}</td>
    </tr>
    @endif
    <tr>
      <th>Due</th>
      <td>{{ '৳ '.$due }}</td>
    </tr>
    @endif
    
@endsection

