<?php

namespace App\Livewire\Supplier;

use Livewire\Component;
use App\Models\Supplier;
class Create extends Component
{
      public $company_name;
    public $contact_person;
    public $email;
    public $phone_number;
    public $address;
    public $website;
    public $category_id;

     protected $rules = [
        'company_name'   => 'required|string|max:255',
        'contact_person' => 'required|string|max:255',
        'email'          => 'required|email|unique:suppliers,email',
        'phone_number'   => 'nullable|string|max:20',
        'address'        => 'nullable|string|max:255',
        'website'        => 'nullable|url',
        // 'category_id'    => 'required|integer'
    ];

    public function render()
    {
        return view('livewire.supplier.create');
    }

     public function submit()
    {
        $this->validate();

        Supplier::create([
            'user_id'       => auth()->id(),
            'company_name'  => $this->company_name,
            'contact_person'=> $this->contact_person,
            'email'         => $this->email,
            'phone_number'  => $this->phone_number,
            'address'       => $this->address,
            'website'       => $this->website,
            'category_id'   => 1,
            'status'        => 'pending',
        ]);

        session()->flash('success', 'Supplier registered successfully!');

        $this->reset();
    }


}
