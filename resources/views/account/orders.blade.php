@extends('home')
@section('title', __('Your Quotation -'))
@section('title-bar', __('Your Quotation'))
@section('acc-content')
    <div>
        <div class="">
            <div class="d-flex justify-content-between mb-3">
                <h4 class="fw-bolder"></h4>
                <div>
                    {{-- also need confirm before delete --}}
                    <form action="{{ route('request.delete', $requirement->id) }}" method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this item?');">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-sm btn-outline-danger">
                            {{ __('Delete') }}
                        </button>
                    </form>

                </div>
            </div>
            <div class="mb-3">
                <div>
                    <h4 class="fw-bolder">Ref#: {{ $requirement->order_number }}</h4>
                </div>
                <div>Created at: {{ $requirement->created_at->format('d F Y') }}</div>
                <div>Deadline : {{ $requirement->deadline }}</div>
                <div>Status : {{ $requirement->status }}</div>
                <div>Quotations received: 0</div>
            </div>
            <table class="table table-striped">
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

                    @if (count($requirement->getLineItems()) > 0)
                        @foreach ($requirement->getLineItems() as $key => $item)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>{{ $item->line_item }}</td>
                                <td>{{ $item->quantity }}</td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3">{{ __('No orders found') }}</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
