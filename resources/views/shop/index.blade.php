@extends('layouts.app')
@section('title', 'Your quotation -')
@section('title-bar', 'Your quotation')
@section('content')

   
    

    
  <div>
      @livewire('shop.index', ['products' => $products])
  </div>
    
@endsection
