@extends('layouts.app')
@section('title', 'New Request -')
@section('title-bar', 'New Request')
@section('content')

   
    

    
  <div>
      @livewire('shop.index', ['products' => $products])
  </div>
    
@endsection
