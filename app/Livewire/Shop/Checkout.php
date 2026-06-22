<?php

namespace App\Livewire\Shop;

use Livewire\Component;
use App\Models\CustomerRequirement;
use App\Models\CRItems;
use App\Models\InfoCollection;
use App\Models\CollectionOption;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;


class Checkout extends Component
{

    public $first_name;
    public $last_name;
    public $email;
    public $phone_number;
    public $location_id;
    public $address;
    public $quotation_deadline;
    public $c_requirement_id;
    

    public function render()
    {
        return view('livewire.shop.checkout');
    }

    public function mount()
    {
        if (!session()->has('cart')) {

            return redirect()->route('shop.index');
        }
        if (!session()->has('user_choices')) {

            return redirect()->route('shop.index');
        }
    }

    public function placeOrder()
    {
        // Validate the form data
        $validatedData = $this->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',

            'phone_number' => 'nullable|string|max:20',
            'location_id' => 'nullable|integer',
            'address' => 'nullable|string|max:500',
            'quotation_deadline' => 'required|date|after:today',
        ]);

       try {
        DB::transaction(function () use ($validatedData) {
        // Create a new customer requirement record
        $customerRequirement = CustomerRequirement::create([
            'customer_id' => auth()->id(),
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'email' => auth()->user()->email, // Assuming the email is taken from the authenticated user
            'phone_number' => $validatedData['phone_number'] ?? null,
            'location_id' => $validatedData['location_id'] ?? null,
            'address' => $validatedData['address'] ?? null,
            'deadline' => $validatedData['quotation_deadline'] ?? null,
            'status'=> 'active',
        ]);
        $this->c_requirement_id = $customerRequirement->id;

        // save line items to c_r_items table
        $cartItems = session()->get('cart', []);

        foreach ($cartItems as $index => $item) {

            $product = \App\Models\Product::where('id', $item['product_id'])->first();

            $product_line_item = $product?->title ? $product?->title.': ' : '';

            if (!empty($item['variants'])) {
                foreach ($item['variants'] as $v_id => $variant) {

                    $variantModel = \App\Models\Variant::where('id', $variant)->first();

                    if ($variantModel) {
                        $product_line_item .= $variantModel->value . ", ";
                    }
                }
            }
            if (!empty($item['choices'])) {
                foreach ($item['choices'] as $c_id => $choice) {

                    $choiceModel = \App\Models\Choice::where('id', $choice)->first();

                    if ($choiceModel) {
                        $product_line_item .= $choiceModel->Choice_name . ", ";
                    }
                }
            }

            CRItems::create([
                'customer_requirement_id' => $customerRequirement->id,
                'line_item' => $product_line_item,
                'quantity' => $item['quantity'],
                 'is_price' => true
            ]);
        }

        // user choices collection
        $userChoices = session()->get('user_choices', []);

        foreach ($userChoices as $questionId => $choice) {
            $question = InfoCollection::where('id', $questionId)->first() ?? 'Unknown Question';
            $q_user_choice = CollectionOption::find($choice)->option_name;
            $line_item_choice = $question->title . " : " . $q_user_choice;
            
            $is_price = false;

            if($question->question_type === 'price'){
                $is_price = true;
            }

            CRItems::create([
                'customer_requirement_id' => $customerRequirement->id,
                'line_item' => $line_item_choice,
                'quantity' => 1, 
                'is_price' => $is_price,
            ]);
        }


        //user choices collection
        $user_choices_collection = session()->get('user_choices_collection', []);
        foreach (session('user_choices_collection') as $question_id => $choices_collection) {
            if (is_array($choices_collection)) {
                foreach ($choices_collection as $oid => $selected) {

                    if ($selected) {
                            CRItems::create([
                                'customer_requirement_id' => $customerRequirement->id,
                                'line_item' => CollectionOption::find($oid)->option_name, // Assuming your user choices have a 'name' attribute
                                'quantity' => 1, // Assuming user choices are single items
                                'is_price' => true,
                            ]);
                    }
                }
            }
        }

        session()->forget('cart');
        session()->forget('user_choices');
        session()->forget('user_choices_collection');

        // 
    });


  



} catch (\Exception $e) {
    // Log error or return response
    // return back()->with('error', 'Something went wrong!');
    dd($e);
}

  // send email
// $userName = $this->first_name. ' ' .$this->last_name;
// $recipient = auth()->user()->email;

// $body = "
// <h3>Dear {$userName},</h3>

// <p>Thank you for using our platform. This email confirms that we have received your request.</p>

// <p>We are now forwarding your requirements to our professional CCTV experts to provide the best possible solutions. You will receive multiple quotations for your request, allowing you to compare options and choose the one that best suits your needs.</p>

// <p>Once you select a preferred option, we will connect you with the relevant service providers, and you can continue the process directly with them. You can manage everything conveniently through your account.</p>

// <p>Please note that our platform serves as a marketplace connecting CCTV customers with service providers. We are not responsible for any financial transactions or agreements you make with service providers. Our role is solely to facilitate the connection between customers and suppliers.</p>

// <p>Thank you for choosing our platform. We look forward to helping you find the best CCTV solution.</p>

// <p>Best regards,<br>
// [Your Company Name]<br>
// [Contact Information]</p>
// ";

// Mail::send([], [], function ($message) use ($recipient, $body) {
//     $message->to($recipient)
//             ->subject('Confirmation of Your CCTV Service Request')
//             ->html($body, 'text/html'); // send as raw HTML
// });

//send email with template
// get requirement details
$customerRequirement = CustomerRequirement::find($this->c_requirement_id);
if (!$customerRequirement) {
    // Handle the case where the customer requirement is not found
    return redirect()->route('shop.index')->with('error', 'Customer requirement not found.');
}
$recipient = auth()->user()->email;
Mail::send('emails.e-quotation', ['customer_requirement' => $customerRequirement], function ($message) use ($recipient) {
    $message->to($recipient)
            ->subject('Confirmation of Your CCTV Service Request');
});





    // Clear session AFTER success
    session()->forget(['cart', 'user_choices', 'user_choices_collection']);
     return redirect()->route('myaccount')
            ->with('success', __('We have received your request and will provide updates on the quotation via email. Please stay in touch.'));



     
        // return redirect()->route('shop.confirmation')->with('success', 'Your order has been placed successfully!');
    }
}
