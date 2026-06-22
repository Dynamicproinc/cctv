<?php

namespace App\Livewire\Shop;

use Livewire\Component;
use App\Models\InfoCollection;
use Illuminate\Support\Facades\Session;

class ExtraInfo extends Component
{
    public $questions;
    public $answers = [];
    public $multiple_choices = [];
    public $m_choices = [];

    public function render()
    {
        return view('livewire.shop.extra-info');
    }

    public function mount(){
         $this->questions = InfoCollection::where('type', 'radio')->get();
        $this->multiple_choices = InfoCollection::where('type', 'checkbox')->get();
    }
    public function rules()
    {
        $rules = [];

        foreach ($this->questions as $question) {
            if ($question->type === 'radio') {
                // Require at least one selected option
                $rules["answers.{$question->id}"] = 'required';
            }
        }

        return $rules;
    }
     public function save()
    {


        // dd($this->m_choices);
        $this->validate();

        Session::put('user_choices', $this->answers);
        Session::put('user_choices_collection', $this->m_choices);
        return redirect()->to(route('checkout'));
    }
}
