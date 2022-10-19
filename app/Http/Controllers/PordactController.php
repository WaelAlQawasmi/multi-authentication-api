<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProdactResource;
use App\Models\pordact;
use Illuminate\Http\Request;

class PordactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $allProdact=  ProdactResource::collection(pordact::get());
        return response($allProdact,200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)

    {
        $data=$request->validate(['name' => 'required',
        'price' => 'required',
        'provider' => 'required',
        'expire_date' => 'required'
               ]);

        pordact::create($data);
        return response()->json(['info' => ['product successfully created.']], 200);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pordact  $pordact
     * @return \Illuminate\Http\Response
     */
    public function show($name)
    {
       $prod=new ProdactResource(  pordact::where('name', $name)->first());
        return response($prod,200);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pordact  $pordact
     * @return \Illuminate\Http\Response
     */
    public function edit(pordact $pordact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\pordact  $pordact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, pordact $pordact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pordact  $pordact
     * @return \Illuminate\Http\Response
     */
    public function destroy(pordact $pordact)
    {
        //
    }
}
