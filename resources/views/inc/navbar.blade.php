<nav class="fixed-top black-navbar">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="d-flex justify-content-between dark-1 text-white">
                            <div>
                                <a href="{{ route('shop.index')}}">
                                    <img src="{{ asset('images/logo.jpg') }}" alt="MBrothers-food.com"
                                    style="width: 50px; height:auto;">
                                </a>
                            </div>
                            <div>

                            </div>
                            <div>
                               @guest
                                <a href="{{ route('login')}}" type="button" class="btn btn-outline-light">
                                    <i class="bi bi-person"></i>
                                    {{__('My Account')}}
                                </a>
                                @endguest
{{-- 
                                <a type="button" href="{{ route('shop.cart') }}" class="btn btn-warning">
                                    @livewire('shop.carbutton')

                                </a> --}}
                                 @auth
                                <a href="{{route('myaccount')}}" class="btn btn-default text-capitalize">
                                    @if (\App\Models\User::find(auth()->user()->id)->avatar)
                                    <img class="xs-avatar" src="{{\App\Models\User::find(auth()->user()->id)->avatar}}" alt="">
                                       @else 
                                       <span class="xs-avatar-letter">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }} </span>
                                    @endif
                                    {{-- <i class="bi bi-person"></i> --}}
                                    {{-- {{__('Hi')}} {{ substr(auth()->user()->name, 0, 10) }} --}}
                                </a>
                                @endauth
                                <div class="btn">
                                     {{-- @livewire('shop.carbutton') --}}
                                </div>
                                 {{-- @auth
                                <a href="{{route('myaccount')}}" class="btn btn-default text-capitalize">
                                    @if (\App\Models\User::find(auth()->user()->id)->avatar)
                                    <img class="xs-avatar" src="{{\App\Models\User::find(auth()->user()->id)->avatar}}" alt="">
                                       @else 
                                       <span class="xs-avatar-letter">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }} </span>
                                    @endif
                                    
                                </a>
                                @endauth
                                 --}}


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>