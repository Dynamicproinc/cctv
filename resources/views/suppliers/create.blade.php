@extends('layouts.app')
@section('title', __('Supplier registration -'))
@section('content')
    <div class="mb-5">
       
        
        @livewire('supplier.create')
        
    </div>
@endsection