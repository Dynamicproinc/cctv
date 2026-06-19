<?php

namespace App\Livewire\Shop;

use Livewire\Component;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductChoice;
use App\Models\Variant;
use App\Models\InfoCollection;
use Illuminate\Support\Facades\Session;

use function Pest\Laravel\session;

class Index extends Component
{
    public $categories;
    public $selected_category_id = 1;
    public $category;
    public $product_modal = false;
    public $selected_product;
    public $variants = [];
    public $variant = [];
    public $grand_total;
    public $choices = [];
    public $quantity = 1;
    public $cart_items = [];
    public $cart_modal = false;
    public $products;
    public $cat_id;
    public $success_message;
    public $error_message;
    public $questions;
    public $answers = [];
    public $multiple_choices = [];
    public $m_choices = [];

    protected $queryString = [
        'category' => ['except' => ''] // optional, removes empty category from URL
    ];


    public function render()
    {

        return view('livewire.shop.index');
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



    public function mount($products)
    {
        // Session::forget('user_choices');
        $this->questions = InfoCollection::where('type', 'radio')->get();
        $this->multiple_choices = InfoCollection::where('type', 'checkbox')->get();

        $this->products = $products;

        $this->categories = Category::all();
        $this->variant = [];
    }

    public function save()
    {


        // dd($this->m_choices);
        $this->validate();

        Session::put('user_choices', $this->answers);
        Session::put('user_choices_collection', $this->m_choices);
        return redirect()->to(route('checkout'));
    }
    public function refreshCart()
    {
        $this->cart_items = session('cart', []);
        //   $this->calculateTotal();


    }





    public function selectProduct($id)
    {
        //open the model

        // load the product details
        $this->selected_product = Product::where('id', $id)->first();
        $this->grand_total = $this->selected_product->discounted_price;
        $this->quantity = 1;
        // $this->selected_product_image = $product->image_path;
        // set first item as checked
        //    $this->resetVariant();
        if (count($this->selected_product->getGroupedOption()) > 0) {

            foreach ($this->selected_product->getGroupedOption() as $option_id => $variants) {
                $this->variant[$option_id] = $variants->first()->id;
            }
        }

        // $this->calculateTotal();
        $this->openModal();
    }

    public function resetVariant()
    {

        $this->variant = [];
        $this->choices = [];
    }

    public function openModal()
    {
        $this->product_modal = true;
    }

    public function closeModal()
    {

        $this->product_modal = false;
        // $this->resetVariant();
        $this->variant = [];
        $this->choices = [];
        $this->selected_product = null;
    }

    public function increment()
    {
        $this->quantity++;
    }


    public function decrement()
    {
        $this->quantity--;
        if ($this->quantity < 1) {
            $this->quantity = 1;

            return null;
        }
    }
    private function sortRecursive(&$array)
    {
        if (!is_array($array)) {
            return;
        }

        // Check if array is associative or numeric
        $isAssoc = array_keys($array) !== range(0, count($array) - 1);

        if ($isAssoc) {
            ksort($array);
        } else {
            sort($array);
        }

        foreach ($array as &$value) {
            if (is_array($value)) {
                $this->sortRecursive($value);
            }
        }
    }


    public function addCart()
    {

        if (count($this->selected_product->getVariants())) {
            $this->validate([
                'variant' => 'required',
            ]);
        }

        $this->validate([
            'quantity' => 'required|integer|min:1|max:100',
        ]);

        $product_id = $this->selected_product->id;
        $cart = Session::get('cart', []);


        $this->variant = array_map(fn($v) => (int) $v, $this->variant);
        $variant = $this->variant;
        $choices = $this->choices;

        // sortRecursive($choices);

        $this->sortRecursive($choices);
        $this->sortRecursive($variant);



        // Create a unique key based on product + variant + choices
        $unique_key = $product_id . '-' . md5(json_encode($variant) . json_encode($choices));


        if (isset($cart[$unique_key])) {
            // If same combination exists, increase quantity
            $cart[$unique_key]['quantity'] += $this->quantity;
        } else {
            // Add as new item
            $cart[$unique_key] = [
                'product_id' => $product_id,
                'quantity' => $this->quantity,

                'variants' => $this->variant,
                'choices' => $choices,
            ];
        }
        $this->variant = [];
        $this->choices = [];

        Session::put('cart', $cart);

        $this->dispatch('pop');

        $this->closeModal();

        $this->dispatch('cartMessage', title: 'Cart item has been updated');
    }

    public function openCartModal()
    {
        $this->cart_modal = true;
    }

    public function closeCartModal()
    {
        $this->cart_modal = false;
    }
    public function removeCartItem($index)
    {



        unset($this->cart_items[$index]);
        $cart = array_values($this->cart_items); // reindex array
        $this->cart_items = $cart;
        session()->put('cart', $this->cart_items);
        $this->dispatch('cartUpdated');
    }

    public function add($index)
    {
       
        $cart = Session::get('cart', []);

        if (isset($cart[$index])) {
            $cart[$index]['quantity']++;
        }

        Session::put('cart', $cart);
    }

    public function subs($index)
{
    $cart = Session::get('cart', []);

    if (isset($cart[$index])) {

        if ($cart[$index]['quantity'] > 1) {
            $cart[$index]['quantity']--;
        } else {
            $cart[$index]['quantity'] = 1;
        }

        Session::put('cart', $cart);
    }
}

public function remove($index)
{
    $cart = Session::get('cart', []);

    if (isset($cart[$index])) {
        unset($cart[$index]);
        Session::put('cart', $cart);
    }
}

}
