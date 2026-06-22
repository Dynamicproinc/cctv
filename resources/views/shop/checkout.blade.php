@extends('layouts.app')
@section('title', __('Finalize Quotation -'))
@section('title-bar', __('Finalize Quotation'))
@section('content')
    <div class="mb-5">
       
        
        @livewire('shop.checkout')
        
    </div>
@endsection
