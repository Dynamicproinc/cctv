@extends('layouts.app')
@section('title', __('Checkout -'))
@section('content')
    <div class="mb-5">
       
        
        @livewire('shop.checkout')
        
    </div>
@endsection
