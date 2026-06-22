<div class="mb-3">
 

     
    

    <div>
       @if (session('cart', []))
            <div class="d-flex justify-content-between mb-3">
        <div>
            <h2 class="form-title">
            {{ __('My Cameras') }}
        </h2>
        </div>
        <div>

            <a class="form-title" href="#">Clear</a>
        </div>
    </div>
       @endif
    <div class="mb-3">


        <ol class="list-group list-group-numbered">
            @foreach (session('cart', []) as $index => $item)
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold">{{ \App\Models\Product::where('id', $item['product_id'])->first()->title }}
                        </div>
                        <div>
                            @if (!empty($item['variants']))
                                <div class="d-flex flex-wrap">
                                    @foreach ($item['variants'] as $v_id => $variant)
                                        <span
                                            class="me-2 badge bg-light-subtle border border-light-subtle text-light-emphasis rounded-pill mb-2">
                                            {{ \App\Models\Variant::where('id', $variant)->first()?->value }}
                                        </span>
                                    @endforeach
                                    @foreach ($item['choices'] as $c_id => $choice)
                                        <span
                                            class="me-2 badge bg-light-subtle border border-light-subtle text-light-emphasis rounded-pill mb-2">
                                            {{ \App\Models\Choice::where('id', $choice)->first()?->Choice_name }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                    <div>
                        <div class="btn-content p-2">
                            <div class="d-flex">
                                <div class="d-flex justify-content-between align-items-center me-2">
                                    <button class="btn-rounded" wire:click="subs('{{ $index }}')"><i
                                            class="bi bi-dash"></i></button>

                                    <div class="qty">{{ $item['quantity'] }}</div>

                                    <button class="btn-rounded" wire:click="add('{{ $index }}')"><i
                                            class="bi bi-plus"></i></button>
                                </div>
                                <button class="btn-rounded-danger" wire:click="remove('{{ $index }}')"><i
                                        class="bi bi-trash"></i></button>
                            </div>
                        </div>

                    </div>

                    {{-- <span class="badge text-bg-primary rounded-pill">  {{ $item['quantity'] }}</span> --}}
                </li>
            @endforeach

        </ol>
    </div>
    </div>
    @if(empty(request()->session()->get('cart', [])))
<div class="d-flex justify-content-center">
             <h2 class="not-found">
            {{ __('Start building your security system by adding a camera') }}
        </h2>
    </div>
@endif

   
    
</div>
