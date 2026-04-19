@extends('layouts.app')
@section('title', __('My Account') . ' -')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                {{--  --}}
                {{-- <div class="point-board p-4 overflow-hidden rounded-4">
                    <div class="row">
                        <div class="col-8">
                            <div class="">
                                <h3 class="fw-bold mb-0">{{ __('Hello!') }}</h3>
                                <h5 class="fw-bold text-capitalize">{{ auth()->user()->name }}</h5>
                                <p>{{ __('Your available coupon balance') }}</p>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mid-text">
                                <div class="rounded bg-dark p-3">
                                    <h1 class="fw-bolder">{{number_format(auth()->user()->getPointBalance()?->balance ?? 0, 0)}}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}


                <div class="p-3">
                    <ul class="nav nav-underline">

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('myaccount') ? 'active' : '' }}"
                                href="{{ route('myaccount') }}">{{ __('Requests') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled">{{ __('Setting') }}</a>
                        </li>
                    </ul>
                </div>
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="card p-3">
                    @yield('acc-content')
                </div>
                {{--  --}}


                <div class="mt-3 d-flex justify-content-center">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-outline-dark">
                            <i class="bi bi-power"></i> {{ __('Logout') }}
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
