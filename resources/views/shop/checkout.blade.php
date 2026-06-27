@extends('layouts.app')
@section('title', __('Finalize Quotation -'))
@section('title-bar', __('Finalize Quotation'))
@section('alt-link')
<a href="#"><i class="bi bi-question-circle"></i></a>
@endsection
@section('content')
    <div class="mb-5">
       
        
        @livewire('shop.checkout')
        
    </div>
@endsection
