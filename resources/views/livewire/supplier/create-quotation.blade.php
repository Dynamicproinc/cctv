<div>
<div class="p-3">
    <div>
        <button class="btn btn-link text-secondary">
            {{__('Back to inbox')}}
        </button>
    </div>
    <div class="quote-area">
        <div>
            <div class="p-3">
                    @if ($customer_requirement)
                        <div>
                            <div class="">
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between mb-3">
                                        <h4 class="fw-bolder text-uppercase">Ref#: {{ $customer_requirement->order_number }}</h4>
                                        {{-- <a href="{{route('supplier.create-quoatation', $customer_requirement->id)}}" class="btn btn-primary">{{__('Send Quotation')}}</a> --}}
                                    </div>
                                   <div class="d-flex small bg-light justify-content-between align-items-center p-2 mb-3 rounded">
                                     <div class="mx-2 cz-text"><strong class="fw-bolder">Created at:</strong> {{ $customer_requirement->created_at->format('d F Y') }}</div>
                                    <div class="mx-2 cz-text"><strong class="fw-bolder">Deadline:</strong> {{ $customer_requirement->deadline }}</div>
                                    <div class="mx-2 cz-text"><strong class="fw-bolder">Status:</strong> {{ $customer_requirement->status }}</div>
                                   </div>
                                   
                                </div>
                                <button wire:click="save">save</button>
                                <table class="table table-lg">
                                    <thead>
                                        <tr>

                                            {{-- <th scope="col">#</th> --}}
                                            <th scope="col">Line Item</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Description(item name, Model no and specifiaction)</th>
                                            <th scope="col">warranty</th>
                                            <th scope="col">Price</th>
                                            {{-- <th scope="col">Last</th>
      <th scope="col">Handle</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @if (count($customer_requirement->getLineItems()) > 0)
                                            @foreach ($customer_requirement->getLineItems()->where('is_price', true) as $key => $item)
                                           
                                                <tr  @if(!$item->is_price) style="background: #EBEBE4" @endif>

                                                    {{-- <th scope="row">{{ $key + 1 }}</th> --}}
                                                    <td>{{ $item->line_item }}</td>
                                                    <td>{{ $item->quantity }}</td>
                                                    @if($item->is_price)
                                                    <td>
                                                        <input type="text" class="form-control" wire:model="line_item.{{$item->id}}.description">
                                                    </td>
                                                    <td>
                                                         <select name="" class="form-control" id="" wire:model="line_item.{{$item->id}}.warranty">
                                                            <option value="">1</option>
                                                            <option value="">2</option>
                                                            <option value="">3</option>
                                                         </select>
                                                    </td>
                                                    <td>
                                                         <input type="number" class="form-control" wire:model="line_item.{{$item->id}}.price">
                                                    </td>
                                                    @else
                                                    <td colspan="3" style="background: #EBEBE4">
                                                       This is just system specifiaction, no need price
                                                    </td>
                                                    @endif

                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="3">{{ __('No items') }}</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                                {{--  --}}
                                 @if (count($customer_requirement->getLineItems()) > 0)
                                            @foreach ($customer_requirement->getLineItems()->where('is_price', false) as $key => $item)
                                                <ul>
                                                <li>{{ $item->line_item }}</li>
                                            </ul>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="3">{{ __('No items') }}</td>
                                            </tr>
                                        @endif
                                {{--  --}}
                            </div>
                        </div>
                    @else
                        <h6 class="text-muted text-center">
                            {{ __('Nothing to show') }}
                        </h6>
                    @endif
                </div>
        </div>
    </div>
</div>
</div>
