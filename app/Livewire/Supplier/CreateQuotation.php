<?php

namespace App\Livewire\Supplier;

use Livewire\Component;

class CreateQuotation extends Component
{

    public $customer_requirement;
    public $line_item = [];

    public function render()
    {
        return view('livewire.supplier.create-quotation');
    }

    public function mount($customer_requirement){
        $this->customer_requirement = $customer_requirement;
    }

    public function save(){
        dd($this->line_item);
    }

}
