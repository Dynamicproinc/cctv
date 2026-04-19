<?php

namespace App\Http\Controllers;

use App\Models\CustomerRequirement;
use Illuminate\Http\Request;

class SuppliersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        // Code to list suppliers
        return view('supplier.inbox');
    }

    public function create()
    {
        // supplier registration form
        return view('suppliers.create');
    }

    public function createQuotation($id){

            $customer_requirement = CustomerRequirement::where('id', $id)->first();
            if($customer_requirement){

                return view('supplier.create-quoatation',compact('customer_requirement'));
            }
            
    }

   
}
