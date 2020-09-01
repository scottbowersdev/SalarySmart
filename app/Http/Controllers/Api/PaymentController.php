<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Payment;
use Illuminate\Http\Request;

class PaymentController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = Payment::all();

        return $this->showAll($payments);
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
            'month_id' => 'required|numeric', 
            'day' => 'required|numeric', 
            'name' => 'required', 
            'price' => 'required|numeric', 
            'paid' => 'numeric'
        ];

        $this->validate($request, $rules);

        $data = $request->all();

        $payment = Payment::create($data);

        return $this->showOne($payment, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        return $this->showOne($payment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        $rules = [
            'day' => 'numeric', 
            'price' => 'numeric', 
            'paid' => 'numeric'
        ];

        $this->validate($request, $rules);

        $payment->update($request->input());

        return $this->showOne($payment, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();

        return $this->showOne($payment);
    }
}
