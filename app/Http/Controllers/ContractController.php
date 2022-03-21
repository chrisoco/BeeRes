<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Postcode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContractController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('models.contract.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if(array_key_exists('contact_phone', $request->all())) {
            $request->merge([
                'contact_phone' => replaceEmptyChars($request->all()['contact_phone']),
                'created_by' => auth()->user()->id,
            ]);
        }

        $validator = Validator::make($request->all(), [
            'lat'               => ['required', 'numeric'], // , 'min:47', 'max:48'
            'lon'               => ['required', 'numeric'], // , 'min:8', 'max:9'
            'plz'               => ['nullable', 'numeric', 'min:8000', 'max:9000', 'exists:App\Models\Postcode,postcode'],
            'contact_firstname' => ['nullable', 'string'],
            'contact_lastname'  => ['nullable', 'string'],
            'contact_phone'     => ['nullable', 'regex:/^(?:00[1-9]{2}|0|\+[1-9]{2})(\d{9})$/'],
            'info'              => ['nullable', 'string'],
            'created_by'        => ['required', 'exists:App\Models\User,id']
        ]);


        if($validator->fails()) {

            if(array_key_exists('plz', $request->all())) {
                $validator->errors()->add('plz-api', 'Something went wrong with Nominatim');
            }

            return back()
                ->withErrors($validator)
                ->withInput();

        }

        $validated = $validator->validated();

        if(array_key_exists('plz', $validated) && !is_null($validated['plz'])) {

            $validated['postcode_id'] = Postcode::where('postcode', $validated['plz'])->first()->id;

        } else {

            // GET PLZ NOMINATIM
            $postcode = NominatimController::getPLZ($validated['lat'], $validated['lon']);

            if (is_null($postcode)) {
                // Add validation failed.
                $validator->errors()->add('plz-api','Something went wrong with Nominatim');
                $validator->errors()->add('lat', ' ');
                $validator->errors()->add('lon', ' ');
                $validator->errors()->add('plz','Please Enter Postcode manually or change Latitude/Longitude.');

                return back()
                    ->withErrors($validator)
                    ->withInput();

            }

            $validated['postcode_id'] = $postcode->id;

        }

        Contract::create($validated);

        // return view with contract created successful and overview of contract.
        return redirect(route('contract.create'));

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
