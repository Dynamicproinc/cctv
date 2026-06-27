@extends('layouts.app')
@section('title', 'New Request -')
@section('title-bar', 'New Request')
@section('alt-link')
    <a href="#"><i class="bi bi-question-circle"></i></a>
@endsection
@section('content')





    <div>
        @livewire('shop.index', ['products' => $products])
    </div>

@endsection
