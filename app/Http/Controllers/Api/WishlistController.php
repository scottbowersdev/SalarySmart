<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wishlists = Wishlist::all();

        return $this->showAll($wishlists);
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
            'priority' => 'numeric', 
            'name' => 'required', 
            'price' => 'required|numeric', 
        ];

        $this->validate($request, $rules);

        $data = $request->all();

        $wishlist = Wishlist::create($data);

        return $this->showOne($wishlist, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Wishlist $wishlist)
    {
        return $this->showOne($wishlist);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Wishlist $wishlist)
    {
        $rules = [
            'priority' => 'numeric', 
            'name' => 'required', 
            'price' => 'required|numeric', 
        ];

        $this->validate($request, $rules);

        $wishlist->update($request->input());

        return $this->showOne($wishlist, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Wishlist $wishlist)
    {
        $wishlist->delete();

        return $this->showOne($wishlist);
    }
}
