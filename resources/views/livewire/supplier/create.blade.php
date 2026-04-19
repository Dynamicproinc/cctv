<div>
    <div>
       <div class="container mt-5">
    <div class="card shadow">
        <div class="card-header">
            <h4>Supplier Registration</h4>
        </div>

        <div class="card-body">

            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form wire:submit.prevent="submit">

                <div class="mb-3">
                    <label class="form-label">Company Name</label>
                    <input type="text" class="form-control form-control-lg" wire:model="company_name">
                    @error('company_name') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Contact Person</label>
                    <input type="text" class="form-control form-control-lg" wire:model="contact_person">
                    @error('contact_person') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control form-control-lg" wire:model="email">
                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Phone Number</label>
                    <input type="text" class="form-control form-control-lg" wire:model="phone_number">
                    @error('phone_number') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Address</label>
                    <input type="text" class="form-control form-control-lg" wire:model="address">
                    @error('address') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Website</label>
                    <input type="text" class="form-control form-control-lg" wire:model="website">
                    @error('website') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- <div class="mb-3">
                    <label class="form-label">Category ID</label>
                    <input type="number" class="form-control" wire:model="category_id">
                    @error('category_id') <small class="text-danger">{{ $message }}</small> @enderror
                </div> --}}
                <div>
                    <p>{{__('By registering, you agree to our Terms and Conditions.')}}</p>
                </div>

                <button type="submit" class="btn btn-primary btn-lg w-100">
                    Register Supplier
                </button>

            </form>
        </div>
    </div>
</div>
    </div>
</div>
