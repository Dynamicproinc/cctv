@extends('layouts.app')
@section('title', __('Additional details -'))
@section('title-bar',__('Additional details'))
@section('content')
    <div class="mb-5">
        {{-- @if(session('cart') && count(session('cart')> 0)) --}}
        
        {{-- @livewire('shop.cart') --}}
        <div style="height: 32px;"></div>
        @livewire('shop.extra-info')
        {{-- @else
        @endif --}}
    </div>
