<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\RecurringPayment;
use Illuminate\Http\Request;

class RecurringPaymentController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recurringPayment = RecurringPayment::all();

        return $this->showAll($recurringPayment);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'user_id' => 'required|numeric', 
            'category_id' => 'numeric', 
            'date' => 'required|numeric', 
            'name' => 'required', 
            'price' => 'required|numeric'
        ];

        $this->validate($request, $rules);

        $data = $request->all();

        $recurringPayment = RecurringPayment::create($data);

        return $this->showOne($recurringPayment, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(RecurringPayment $recurringPayment)
    {
        return $this->showOne($recurringPayment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RecurringPayment $recurringPayment)
    {
        $rules = [
            'date' => 'numeric', 
            'name' => 'required',
            'price' => 'required|numeric'
        ];

        $this->validate($request, $rules);

        $recurringPayment->update($request->input());

        return $this->showOne($recurringPayment, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(RecurringPayment $recurringPayment)
    {
        $recurringPayment->delete();

        return $this->showOne($recurringPayment);
    }
}
