@extends('layouts.master')

@section('title')
  <title>Party Payment</title>
@endsection


@section('body')
  <section class="content-header">
      <h1>
        Party Payment
        <small>View Party Payment</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/party">Party</a></li>
        <li>Payments</li>
        <li class="active">{{ str_shuffle('Party Name') }}</li>
      </ol>
    </section>

    <!-- Main content -->
    <style>
      .overlay{
        display: none;
      }
    </style>

    



@endsection