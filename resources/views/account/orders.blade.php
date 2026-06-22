@extends('home')

@section('title', __('Your Quotation -'))
@section('title-bar', __('Your Quotation'))

@section('acc-content')
<div class="container">

    <!-- HEADER CARD -->
    <div class="card shadow-sm mb-4">
        <div class="card-body d-flex justify-content-between align-items-start">

            <div>
                <h4 class="mb-1 fw-bold">
                    Ref#: {{ $requirement->order_number }}
                </h4>

                <div class="text-muted small">
                    Created: {{ $requirement->created_at->format('d M Y') }}
                </div>

                <div class="mt-2 d-flex gap-2 flex-wrap">
                    <span class="badge bg-secondary">
                        Status: {{ ucfirst($requirement->status) }}
                    </span>

                    <span class="badge bg-warning text-dark">
                        Deadline: {{ $requirement->deadline }}
                    </span>

                    <span class="badge bg-info text-dark">
                        Items: {{ count($requirement->getLineItems()) }}
                    </span>

                    <span class="badge bg-success">
                        Quotations: 0
                    </span>
                </div>
            </div>

            <!-- ACTION -->
            <form action="{{ route('request.delete', $requirement->id) }}"
                  method="POST"
                  onsubmit="return confirm('Are you sure you want to delete this request?');">
                @csrf
                @method('DELETE')

                <button class="btn btn-outline-danger btn-sm">
                    Delete request
                </button>
            </form>

        </div>
    </div>

    <!-- LINE ITEMS CARD -->
    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h5 class="mb-0 fw-semibold">Line Items</h5>
        </div>

        <div class="card-body p-0">

            @php $items = $requirement->getLineItems(); @endphp

            @if(count($items) > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 80px;">#</th>
                                <th>Item Description</th>
                                <th style="width: 150px;">Quantity</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($items as $key => $item)
                                <tr>
                                    <td class="text-muted">{{ $key + 1 }}</td>
                                    <td class="fw-medium">{{ $item->line_item }}</td>
                                    <td>
                                        <span class="badge bg-primary">
                                            {{$item->is_priced ? $item->price : ''}}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="p-4 text-center text-muted">
                    No line items found
                </div>
            @endif

        </div>
    </div>

</div>
@endsection