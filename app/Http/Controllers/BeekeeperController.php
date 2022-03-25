<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BeekeeperController extends Controller
{

    public function profile()
    {
        return view('models.beekeeper.profile', [
            'beekeeper' => auth()->user()->beekeeper,
        ]);
    }


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

}
