@extends('supplier.dashboard-layout')
@section('title', 'Create quoatation')
@section('content')
    <div>
      @livewire('supplier.create-quotation',['customer_requirement' => $customer_requirement])
    </div>
@endsection
