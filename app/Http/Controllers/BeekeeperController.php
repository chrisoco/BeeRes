<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BeekeeperController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        return view('models.beekeeper.profile', [
            'beekeeper' => auth()->user()->beekeeper,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function jurisdiction()
    {
        return view('models.beekeeper.jurisdiction', [
            'postcodes' => auth()->user()->beekeeper->postcodes
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateJurisdiction(Request $request)
    {
        // https://laravel.com/docs/9.x/validation#rule-exists

        $validator = Validator::make($request->all(), [
            'delJur'   => ['array'],
            'delJur.*' => ['integer', 'exists:App\Models\Postcode,id'],
            'addJur'   => ['array'],
            'addJur.*' => ['integer', 'exists:App\Models\Postcode,id'],
        ]);



        if(!$validator->fails()) {

            $postcodes = auth()->user()->beekeeper->postcodes();

            if(isset($validator->validated()['addJur'])) $postcodes->attach($validator->validated()['addJur']);
            if(isset($validator->validated()['delJur'])) $postcodes->detach($validator->validated()['delJur']);

        }

        return redirect(route('jurisdiction'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
