<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Month;
use Illuminate\Http\Request;

class MonthController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $months = Month::all();

        return $this->showAll($months);
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
            'user_id' => 'required', 
            'date' => 'required|date', 
            'income' => 'required|numeric'
        ];

        $this->validate($request, $rules);

        $data = $request->all();

        $month = Month::create($data);

        return $this->showOne($month, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Month $month)
    {
        return $this->showOne($month);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Month $month)
    {
        $rules = [
            'income' => 'required|numeric'
        ];

        $this->validate($request, $rules);

        if($request->has('income')) {
            $month->income = $request->income;
        }

        if($month->isClean()) {
            return response()->json(['error' => 'You need to specify different values to update.', 'code' => 422], 422);
        }

        $month->save();

        return $this->showOne($month, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Month $month)
    {
        $month->delete();

        return $this->showOne($month);
    }
}
