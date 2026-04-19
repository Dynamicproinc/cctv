<?php

namespace App\Livewire\Supplier;

use App\Models\CustomerRequirement;
use App\Models\ReadItem;
use Carbon\Carbon;
use Livewire\Component;

class Inbox extends Component
{

    public $customer_requirement;

    public function render()
    {
        $requirements = CustomerRequirement::latest()

            ->where('status', 'active')
            ->where('deadline', '>=', Carbon::today())
            ->paginate(20);
        return view('livewire.supplier.inbox', [
            'requirements' => $requirements,
        ]);
    }

    public function mount() {}

    public function openItem($id)
    {

        $read = ReadItem::create([
            'user_id' => auth()->id(),
            'item_id' => $id

        ]);


        $cr =  CustomerRequirement::latest()
            ->where('id', $id)
            ->where('status', 'active')
            ->where('deadline', '>=', Carbon::today())
            ->first();

            if($cr){
                $this->customer_requirement = $cr;
            }


        // fetch the requirement details and show in a modalq

        // wether user id and custoemr requirment id opened

    }
}
