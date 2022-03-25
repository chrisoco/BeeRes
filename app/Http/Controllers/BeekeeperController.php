<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BeekeeperController extends Controller
{

    /**
     * Show the form to edit Beekeeper (Profile).
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
     * Show the form to edit Jurisdictions.
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
     * Update jurisdictions of Beekeeper in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateJurisdiction(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'delJur'   => ['array'],
            'addJur'   => ['array'],
            'delJur.*' => ['integer', 'exists:App\Models\Postcode,id'], // Validate each content of Array
            'addJur.*' => ['integer', 'exists:App\Models\Postcode,id'], // Validate each content of Array
        ]);

        if(!$validator->fails()) {

            // Get Relation of Postcodes from Authenticated Beekeeper
            $postcodes = auth()->user()->beekeeper->postcodes();

            if(isset($validator->validated()['addJur'])) $postcodes->attach($validator->validated()['addJur']);
            if(isset($validator->validated()['delJur'])) $postcodes->detach($validator->validated()['delJur']);

        }

        return redirect(route('jurisdiction'));

    }

}
