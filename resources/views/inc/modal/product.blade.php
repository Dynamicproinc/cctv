<div class="light-modal" wire:transition>
    <div class="light-modal-content">
        <div class="">
            <div class="product-display">
                <div class="close-btn">
                    <button class="btn btn-opacity" wire:click="closeModal"> <i class="bi bi-x-lg"></i> </button>
                </div>
                <div class="scroll-content">
                    <div class="product-md">
                        <div class="thumb-md">
                            <img src="{{ asset($selected_product->image_path) }}" alt="" class="img-fluid">

                        </div>

                        <div class="p-3">
                            <h5 class="title-md">{{ $selected_product->title }}</h5>

                           {{-- @if ($selected_product->rating)
                               <div>
                             <div class="d-flex star-rating mb-2">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $selected_product->getRatingScore()['integer_part'])
                                        <i class="bi bi-star-fill"></i>
                                    @else
                                        <i class="bi bi-star"></i>
                                    @endif
                                @endfor
                                
                                
                               
                                <span> ({{$selected_product->getRatingScore()['average_score']}}) | <a href="{{route('product.reviews', $selected_product->slug)}}"> {{$selected_product->getRatingScore()['total_ratings']}} {{__('Reviews')}}</a></span>
                            </div>
                           </div>
                           @endif --}}
                           
                            
                            
                              {{-- <div class="mb-3 d-flex">
                                <h5 class="fw-bold mb-0">{{ number_format($selected_product->discounted_price, 2, ',', ' ') }} €</h5>
                                <div class="mx-3">
                                   @if($selected_product->points > 0)
                                 <span class="badge bg-success-subtle border border-success-subtle text-success-emphasis rounded-pill">{{__('Coupon applied')}}</span>
                                @else
                                 <span class="badge bg-dark-subtle border border-dark-subtle text-dark-emphasis rounded-pill">{{__('Coupon not applied')}}</span>
                                @endif
                               </div>
                              </div> --}}
                            
                            <p>{{ $selected_product->description }}</p>



                        </div>


                        <div class="p-3 mb-3">

                            <div>

                                <div class="mb-3 variants-sections">
                                    @php
                                        $grouped_options = $selected_product->getGroupedOption();
                                    @endphp

                                    @if ($grouped_options->count() > 0)
                                        @foreach ($grouped_options as $option_id => $variants)
                                            <h6 class="fw-bold mb-3 text-capitalize">
                                                {{ App\Models\Options::where('id', $option_id)->first()->option_name }}
                                            </h6>

                                            @foreach ($variants as $key => $item)
                                                <div class="row align-items-center mb-2">
                                                    <div class="col-6">
                                                        <div class="form-check d-flex">
                                                            <input class="form-check-input" type="radio"
                                                                name="radioDefault_{{ $option_id }}"
                                                                id="rd{{ $item->id }}" value="{{ $item->id }}"
                                                                wire:model.live="variant.{{ $option_id }}"
                                                                @if ($loop->first) checked @endif>
                                                            <label class="form-check-label" for="rd{{ $item->id }}">
                                                                <div>{{ $item->value }}</div>
                                                                <p class="text-muted txt-xs" style="line-height: 1.2;">
                                                                    {{ $item->description ?? $item->description }}</p>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="d-flex justify-content-end">
                                                            <span>{{ number_format($item->price, 2, ',', ' ') }}
                                                                €</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endforeach
                                        @error('variant')
                                            <small class="text-danger fw-bold">{{ $message }}</small>
                                        @enderror
                                    @endif
                                    {{-- @foreach ($variant as $option_id => $item)
                                        Key: {{$option_id}} <br>
                                        Value: {{$item}} <br>
                                    @endforeach
                                   <button wire:click="calculateTotal">test</button> --}}
                                </div>
                                {{-- <hr class="my-3"> --}}


                                <div class="mb-3">
                                    @if (count($selected_product->getChoices()) > 0)
                                        <h6 class="fw-bold mb-3">{{ __('Add-ons') }}</h6>
                                        @foreach ($selected_product->getChoices() as $item)
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-check mb-3">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="{{ $item->id }}" id="chk{{ $item->id }}"
                                                            wire:model.live="choices">
                                                        <label class="form-check-label" for="chk{{ $item->id }}">
                                                            {{ $item->getChoiceName()->Choice_name }}
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="d-flex flex-row-reverse">
                                                        <span>{{ number_format($item->price, 2, ',', ' ') }}
                                                            €</span>

                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif










                                </div>

                            </div>

                        </div>

                        <div>

                        </div>
                    </div>
                </div>
                <div class="add-bar">
                    <div class="add-bar-wrap">
                        <div class="row">
                            <div class="col-4">
                                {{-- <div class="btn-content p-2">
                                    <div class="d-flex justify-content-between">
                                        <div class="">
                                            <button class="btn-rounded" wire:click="decrement"><i
                                                    class="bi bi-dash"></i></button>
                                        </div>
                                        <div class="qty">{{ $quantity }}</div>
                                        <div class="">
                                            <button class="btn-rounded" wire:click="increment"><i
                                                    class="bi bi-plus"></i></button>
                                        </div>
                                    </div>
                                </div> --}}
                                <div x-data="{ qty: @entangle('quantity').live }" class="btn-content p-2">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <button class="btn-rounded" @click="qty--"><i class="bi bi-dash"></i></button>

                                        <div class="qty" x-text="qty"></div>

                                        <button class="btn-rounded" @click="qty++"><i class="bi bi-plus"></i></button>
                                    </div>
                                </div>

                            </div>
                            <div class="col-8">
                                <button class="btn-add-cart" wire:click="addCart"
                                    wire:loading.attr="disabled">{{ __('ADD') }}

                                    
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
