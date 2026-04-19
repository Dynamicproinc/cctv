@extends('home')
@section('acc-content')
    <div>
      <div class="">
        <div class="mb-3">
            <div><h4 class="fw-bolder">Ref#: {{$requirement->order_number}}</h4></div>
            <div>Created at: {{$requirement->created_at->format('d F Y')}}</div>
            <div>Deadline : {{$requirement->deadline}}</div>
            <div>Status : {{$requirement->status}}</div>
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
  
   @if(count($requirement->getLineItems()) > 0)
    @foreach($requirement->getLineItems() as $key => $item)
    <tr>
      <th scope="row">{{ $key+1 }}</th>
      <td>{{$item->line_item}}</td>
      <td>{{$item->quantity}}</td>
      
    </tr>
   @endforeach
   @else
   <tr>
    <td colspan="3">{{__('No orders found')}}</td>
   </tr>
   @endif
  </tbody>
</table>
      </div>
    </div>
@endsection
