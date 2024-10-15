<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerStoreRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $customers = Customer::when($request->has('search'), function ($customer) use ($request) {
            return $customer->where('first_name', 'LIKE', '%'. $request->search. '%')
                ->orWhere('last_name', 'LIKE', '%'. $request->search. '%')
                ->orWhere('email', 'LIKE', '%'. $request->search. '%')
                ->orWhere('phone_number', 'LIKE', '%'. $request->search. '%')
                ->orWhere('card_number', 'LIKE', '%'. $request->search. '%')
                ->orWhere('date_of_birth', 'LIKE' , "%$request->search%");
        })->orderBy('id', $request->order && $request->order == 'asc' ? 'ASC' : 'DESC')->get();
        return view('customers.index', ['customers' => $customers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customers.create-customer');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerStoreRequest $request)
    {

        $customer = new Customer();

        // save image to local storage
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time(). '.'. $request->image->getClientOriginalExtension();
            $image->storeAs('/', $imageName, 'public');    
            
            $customer->image_path = '/storage/'.  $imageName;
        }
        
        $customer->first_name = $request->first_name;
        $customer->last_name = $request->last_name;
        $customer->date_of_birth = $request->date_of_birth;
        $customer->phone_number = $request->phone_number;
        $customer->email = $request->email;
        $customer->card_number = $request->card_number;
        $customer->save();

        return redirect()->route('customers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $customer = Customer::find($id);

        return view('customers.details-customer', ['customer' => $customer]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $customer = Customer::find($id);

        return view('customers.edit-customer', ['customer' => $customer]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerStoreRequest $request, string $id)
    {

        $customer = Customer::find($id);

        if($request->hasFile('image')) {
            if ($customer->image_path && File::exists(public_path($customer->image_path))) {
                File::delete(public_path($customer->image_path));
            }

            $image = $request->file('image');
            $imageName = time(). '.'. $request->image->getClientOriginalExtension();
            $image->storeAs('/', $imageName, 'public');

            $customer->image_path = '/storage/'.  $imageName;

        }

        $customer->first_name = $request->first_name;
        $customer->last_name = $request->last_name;
        $customer->phone_number = $request->phone_number;
        $customer->email = $request->email;
        $customer->card_number = $request->card_number;
        $customer->save();

        return redirect()->route('customers.index', ['id' => $customer->id]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customer = Customer::find($id);

        // if ($customer->image_path && File::exists(public_path($customer->image_path))) {
        //     File::delete(public_path($customer->image_path));
        // }

        $customer->delete();

        return redirect()->route('customers.index');
    }

    public function trash(Request $request){
        $customers = Customer::when($request->has('search'), function ($customer) use ($request) {
            return $customer->where('first_name', 'LIKE', '%'. $request->search. '%')
                ->orWhere('last_name', 'LIKE', '%'. $request->search. '%')
                ->orWhere('email', 'LIKE', '%'. $request->search. '%')
                ->orWhere('phone_number', 'LIKE', '%'. $request->search. '%')
                ->orWhere('card_number', 'LIKE', '%'. $request->search. '%')
                ->orWhere('date_of_birth', 'LIKE' , "%$request->search%");
        })->orderBy('id', $request->order && $request->order == 'asc' ? 'ASC' : 'DESC')->onlyTrashed()->get();

        // return ($customers);
        return view('customers.trash', ['customers' => $customers]);
    }

    public function restore($id){
        Customer::withTrashed()->where('id', $id)->restore();
        return redirect()->back();
    }

    public function forceDestroy($id){
        // dd($id);
        $customer = Customer::withTrashed()->findOrFail($id);
        // dd($customer->id);
        if($customer->image_path && File::exists(public_path($customer->image_path))){
            File::delete(public_path($customer->image_path));
        }
        
        $customer->forceDelete();

        return redirect()->back();
    }
}
