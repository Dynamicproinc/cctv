<div>
    <div>
        <div class="row">
            <div class="col-lg-4">
                <div class="side-2">
                    @if (count($requirements) > 0)
                        <div class="list-group list-group-flush">
                            @foreach ($requirements as $item)
                                <a href="#"
                                    class="list-group-item list-group-item-action {{ $item->isRead() ?? 'inbox-new' }}"
                                    aria-current="true" wire:click="openItem({{ $item->id }})">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1 h6">{{ $item->order_number }}</h5>
                                        <small class="c-date">{{ $item->created_at->format('d F Y') }}</small>
                                    </div>

                                    <small class="small">Deadline: {{ $item->deadline }} </small>
                                </a>
                            @endforeach




                        </div>
                    @else
                        <h5 class="text-center-text-muted">{{ __('Empty inbox') }}</h5>
                    @endif
                </div>
            </div>
            <div class="col-lg-8">
                <div wire:loading>
                    <div class="spinner-grow spinner-grow-sm" role="status">
                        {{-- <span class="visually-hidden">Loading...</span> --}}
                    </div>
                </div>
                <div class="p-3 details-bar">
                    @if ($customer_requirement)
                        <div>
                            <div class="">
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between mb-3">
                                        <h4 class="fw-bolder text-uppercase">Ref#: {{ $customer_requirement->order_number }}</h4>
                                        <a href="{{route('supplier.create-quoatation', $customer_requirement->id)}}" class="btn btn-primary">{{__('Send Quotation')}}</a>
                                    </div>
                                   <div class="d-flex small bg-light justify-content-between align-items-center p-2 mb-3 rounded">
                                     <div class="mx-2 cz-text"><strong class="fw-bolder">Created at:</strong> {{ $customer_requirement->created_at->format('d F Y') }}</div>
                                    <div class="mx-2 cz-text"><strong class="fw-bolder">Deadline:</strong> {{ $customer_requirement->deadline }}</div>
                                    <div class="mx-2 cz-text"><strong class="fw-bolder">Status:</strong> {{ $customer_requirement->status }}</div>
                                   </div>
                                   
                                </div>
                                <table class="table table-striped table-lg">
                                    <thead>
                                        <tr>

                                            <th scope="col">#</th>
                                            <th scope="col">Line Item</th>
                                            <th scope="col">Quantity</th>
                                            {{-- <th scope="col">Last</th>
      <th scope="col">Handle</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @if (count($customer_requirement->getLineItems()) > 0)
                                            @foreach ($customer_requirement->getLineItems() as $key => $item)
                                                <tr>
                                                    <th scope="row">{{ $key + 1 }}</th>
                                                    <td>{{ $item->line_item }}</td>
                                                    <td>{{ $item->quantity }}</td>

                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="3">{{ __('No items') }}</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
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
