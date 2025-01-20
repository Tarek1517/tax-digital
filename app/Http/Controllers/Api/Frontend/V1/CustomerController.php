<?php

namespace App\Http\Controllers\Api\Frontend\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\V1\CustomerShowResource;
use App\Http\Resources\V1\OrderListResource;
use App\Http\Resources\V1\customerMailResource;
use App\Models\User;
use App\Models\Order;
use App\Models\CustomerMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\V1\CustomerMailRequest;
use Illuminate\Support\Facades\Mail;
use \App\Mail\CustomQuoteMail;


class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {

        $orders = Order::query()->where('user_id', $id)->with('packages')->get();

        return OrderListResource::collection($orders);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerMailRequest $request)
    {
        $data = $request->validated();
        $Maildatas = CustomerMail::query()->create($data);

        return customerMailResource::make($Maildatas);

    }

    public function storeQuote(CustomerMailRequest $request)
    {
        $mailData = $request->validated();
        $mailDatas = CustomerMail::query()->create($mailData);
        Mail::to('tarek.hasan041517@gmail.com')->send(new CustomQuoteMail($mailData));
        return customerMailResource::make($mailDatas);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $customer = User::query()
            ->where('id', $id)
            ->first();

        return new CustomerShowResource($customer);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        $data = $request->validate([
            'name' => 'nullable|string',
            'mobile' => 'nullable|numeric',
            'email' => 'required|email',
            // 'email' => [
            //     'nullable',
            //     'email',
            //     function ($value, $fail) use ($id) {

            //         $userExists = User::where('email', $value)->where('id', '!=', $id)->exists();

            //         $AdminExists = Admin::where('email', $value)->exists();

            //         if ($AdminExists || $userExists) {
            //             $fail('The email is already taken in either customers or users!');
            //         }
            //     },
            // ],
            'old_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable',
            'new_password_confirmation' => 'nullable|same:new_password',
        ]);

        if ($request->hasFile('image')) {
            if ($user->image) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $user->image));

                $path = '/storage/' . $request->file('image')->store('uploads', 'public');
                $data['image'] = $path;
            }
        }

        if ($request->filled('new_password')) {
            if (!Hash::check($request->old_password, $user->password)) {
                return redirect()->route('account.details', ['id' => $id])
                    ->with('error', 'Failed to update details. Incorrect old password.');
            }

            $data['password'] = bcrypt($request->new_password);
        }

        $user->update($data);

        return CustomerShowResource::make($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }



}
