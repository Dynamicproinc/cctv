<div>

<div>
    @include('inc.simple-cart')
</div>

<div class="bg-white p-3 rounded">
    <ul class="list-group list-group-flush">
     @if(session()->has('user_choices'))
        @foreach (session('user_choices') as $questionId => $choice)
         <li class="list-group-item">

            {{App\Models\InfoCollection::find($questionId)->title}}:
            <span class="text-muted"> {{App\Models\CollectionOption::find($choice)->option_name}}</span>
         </li>
        @endforeach
    
    @endif
     @if(session()->has('user_choices_collection'))
    @foreach(session('user_choices_collection') as $questionId => $choices)
        {{-- Only process if $choices is an array (checkboxes) --}}
        @if(is_array($choices))
         
             @foreach($choices as $optionId => $selected)
              <li class="list-group-item">
                @if($selected)
                    <span>  {{App\Models\CollectionOption::find($optionId)->option_name}} </span><br/>
                @endif
              </li>
            @endforeach
          
            {{-- <p>Question ID: {{ App\Models\InfoCollection::find($questionId)->title }}</p> --}}
           
        @endif
    @endforeach

@endif


  
</div>
</ul>

<div class="mt-3">
    <div class="form-floating mb-3">
  <input type="date" class="form-control" id="floatingInput" wire:model="quotation_deadline">
  <label for="floatingInput">{{__('Quotation Deadline (Date by which quotations are required)')}}</label>
  @error('quotation_deadline')
    <div class="text-danger">{{ $message }}</div>
  @enderror
</div>
<div class="row mb-3">
    <div class="col-6">
         <div class="form-floating">
  <input type="text" class="form-control" id="floatingInput" placeholder="" wire:model="first_name">
  <label for="floatingInput">{{__('First Name')}}</label>
  @error('first_name')
    <div class="text-danger">{{ $message }}</div>
  @enderror
</div>
    </div>
    <div class="col-6">
         <div class="form-floating">
  <input type="text" class="form-control" id="floatingInput" placeholder="" wire:model="last_name">
  <label for="floatingInput">{{__('Last Name')}}</label>
  @error('last_name')
    <div class="text-danger">{{ $message }}</div>
  @enderror
         </div>
    </div>
</div>
<div class="mb-3">
    <div class="form-floating">
  <select class="form-select" id="floatingSelect" aria-label="Floating label select example" wire:model="location_id">
    <option selected>Open this select menu</option>
    <option value="1">One</option>
    <option value="2">Two</option>
    <option value="3">Three</option>
  </select>
  <label for="floatingSelect">{{__('Location')}}</label>
  @error('location_id')
    <div class="text-danger">{{ $message }}</div>
  @enderror
</div>
</div>
 <div class="mb-3">
    <div class="form-floating">
  <input type="text" class="form-control" id="floatingInput" placeholder="" wire:model="address">
  <label for="floatingInput">{{__('Address')}}</label>
  @error('address')
    <div class="text-danger">{{ $message }}</div>
  @enderror
  
</div>
 </div>
 <div class="mb-3 p-3 notice">
    <p class=""><strong>{{__('Important!')}} </strong>{{__('We do not share your personal information until you confirm a quotation. Once you select the most suitable quotation, your details will be shared with the relevant service providers.')}}</p>
 </div>
<div class="mb-3">
   <div class="py-2">
     <small class="form-text text-muted">
        {{__('By submitting this form, you agree to our terms and conditions.')}}
    </small>
   </div>
    <button class="btn btn-warning btn-lg w-100" wire:click="placeOrder">
      <span class="spinner-border  spinner-border-sm" role="status" wire:loading wire:target="placeOrder">
 
</span>
      {{__('Submit')}}
    </button>
</div>

    
</div>