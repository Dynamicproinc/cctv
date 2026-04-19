@extends('layouts.app')
@section('title', 'Shop')
@section('content')

   
    

    
  <div>
      @livewire('shop.index', ['products' => $products])
  </div>
    
@endsection
