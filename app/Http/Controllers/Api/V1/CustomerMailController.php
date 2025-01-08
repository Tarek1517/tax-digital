<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\V1\customerMailResource;
use App\Models\CustomerMail;

class CustomerMailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cusMail = CustomerMail::query()->get();

        return customerMailResource::collection($cusMail);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $mail_details = CustomerMail::findOrFail($id);
        return customerMailResource::make($mail_details);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $CusMail = CustomerMail::query()->findOrFail($id);
        $CusMail->delete();

        return customerMailResource::make($CusMail);
    }
}
