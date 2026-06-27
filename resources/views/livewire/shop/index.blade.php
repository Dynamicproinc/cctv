<div>
    <div class="mb-5">

        <div class="">
            {{-- <div class="mb-5 p-3 border">

                <h5 class="fw-bold mb-1">
                    {{ __('Create your quotaion') }}
                </h5>
                <p class="text-muted small mb-2">
                    {{ __('Please select the cameras types you want to install your locations') }}
                </p>
                <a href="#" class="small text-decoration-none">{{ __('Learn more') }}</a>

            </div> --}}


            {{--  --}}
            <div>
                @if (!$show_products)
                    <div class="add-camera mb-3">
                        <button class="btn btn-dark rounded-pill" wire:click="showProducts">
                            {{ __('Add camera') }}
                        </button>
                    </div>
                @else
                    @if (count($products) > 0)
                        <div>
                            <div class="mb-3">
                                <h6 class="">{{__('Choose the installation location')}}</h6>
                            </div>
                            <div class="row g-4 justify-content-center mb-4" wire:transition>

                                @foreach ($products as $item)
                                    <div class="col-12 col-lg-6">
                                        <div class="p-card bg-white shadow-sm d-flex no-select"
                                            wire:click="selectProduct({{ $item->id }})" style="cursor: pointer;">
                                            <div class="p-card-img">
                                                <img src="{{ $item->image_path }}" alt="{{ $item->title }}">
                                            </div>
                                            <div class="px-3 py-2">
                                                <h5 class="fw-semibold">
                                                    {{ $item->title }}
                                                </h5>
                                                <p class="text-muted small">
                                                    {{ Str::limit($item->description, 50) }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <h5 class="text-muted">
                                😢 {{ __('No product found!') }}
                            </h5>
                        </div>
                    @endif
                @endif


                {{--  --}}

                {{-- --}}
            </div>
            <div class="mb-5">
                @include('inc.cart_items')

            </div>
            <div class="fixed-bottom">
                <button class="btn btn-lg btn-dark form-control rounded-0" wire:click="nextStep"
                    wire:loading.attr="disabled" @if (empty(session('cart', []))) disabled @endif>
                    <span class="spinner-border spinner-border-sm" role="status" wire:loading wire:target="nextStep">
                        <span class="visually-hidden">Loading...</span>
                    </span>
                    {{ __('Next step') }}
                </button>
            </div>

            {{-- --}}
        </div>


        {{-- show product modal --}}
        @if ($product_modal)
            @include('inc.modal.product')
        @endif

        {{-- cart modal --}}
        {{-- @if ($cart_modal)

        @include('inc.modal.cartmodal')
        @endif --}}
        {{-- --}}
        {{-- --}}
    </div>
