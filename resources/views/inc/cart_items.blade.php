<div class="mb-3">
                    <div>
                        <h2 class="form-title">
                            {{ __('Your requirement') }}
                        </h2>
                    </div>
                    <div class="mb-3">
                        <ol class="list-group list-group-numbered">
                               @foreach (session('cart', []) as $index => $item)
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">{{ \App\Models\Product::where('id', $item['product_id'])->first()->title }}</div>
                                    <div>
                                          @if (!empty($item['variants']))
                                        @foreach ($item['variants'] as $v_id => $variant)
                                            <div class="d-flex flex-wrap">
                                                <p class="text-muted small mb-0">
                                                    {{ \App\Models\Variant::where('id', $variant)->first()?->value }}
                                                   
                                                </p>
                                                
                                            </div>
                                        @endforeach
                                    @endif
                                    </div>
                                </div>
                                <span class="badge text-bg-primary rounded-pill">  {{ $item['quantity'] }}</span>
                            </li>
                            @endforeach
                            
                        </ol>
                    </div>
                </div>