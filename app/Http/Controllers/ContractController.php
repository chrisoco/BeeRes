<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Postcode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContractController extends Controller
{

    /**
     * Show the form for creating a new contract.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('models.contract.create');
    }

    /**
     * Store a newly created contract in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // Prepare Request for Validation: Format phone and add created_by
        $request->merge([
            'contact_phone' => replaceEmptyChars($request->all()['contact_phone']),
            'created_by'    => auth()->user()->id,
        ]);

        $validator = Validator::make($request->all(), [
            'lat'               => ['required', 'numeric', 'min:47', 'max:48'],
            'lon'               => ['required', 'numeric', 'min:8', 'max:9'],
            'plz'               => ['nullable', 'numeric', 'min:8000', 'max:9000', 'exists:App\Models\Postcode,postcode'],
            'contact_firstname' => ['nullable', 'string'],
            'contact_lastname'  => ['nullable', 'string'],
            'contact_phone'     => ['nullable', 'regex:/^(?:00[1-9]{2}|0|\+[1-9]{2})(\d{9})$/'],
            'info'              => ['nullable', 'string'],
            'created_by'        => ['required', 'exists:App\Models\User,id']
        ]);


        if($validator->fails()) {

            // If Key exists:
            // 1st Validation Nominatim Failed to find PLZ & input PLZ was shwon
            // 2nd Validation either Nominatim Failed again or PLZ failed and input PLZ needs to be shown again
            if(array_key_exists('plz', $request->all())) {
                $validator->errors()->add('plz-api', 'Something went wrong with Nominatim');
            }

            return back()->withErrors($validator)->withInput();

        }

        $validated = $validator->validated();

        // If Key exists:
        // 1st Validation Nominatim Failed to find PLZ
        // 2nd Validation PLZ was entered manually and needs to be added to Contract
        if(array_key_exists('plz', $validated) && !is_null($validated['plz'])) {

            $validated['postcode_id'] = Postcode::where('postcode', $validated['plz'])->first()->id;

        } else {

            // Try to get PLZ from Nominatim
            $postcode = GeoLocationController::getPlzFromLatLon($validated['lat'], $validated['lon']);

            // If Nominatim Failed to provide a PLZ
            if (is_null($postcode)) {
                // Add validation failed keys + messages.
                $validator->errors()->add('plz-api', 'Please Enter Postcode manually or change Latitude/Longitude.');
                $validator->errors()->add('lat', ' ');
                $validator->errors()->add('lon', ' ');
                $validator->errors()->add('plz', 'Please Enter Postcode manually or change Latitude/Longitude.');

                return back()->withErrors($validator)->withInput();

            }

            $validated['postcode_id'] = $postcode->id;

        }

        // Create new Contract with Validated Data
        $contract = Contract::create($validated);

        // Notify applicable imker
        NotificationController::notifyBeekeeperNewContract($contract);

        return redirect(route('contract.show', $contract->id));

    }

    /**
     * Display the specified contract for Admins.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contract = Contract::findOrFail($id);

        return view('models.contract.show', ['contract' => $contract]);
    }

    /**
     * Display the form to accept a contract as beekeeper.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function accept($id)
    {
        $contract = Contract::findOrFail($id);

        // Validate if contract has already been taken by a beekeeper
        if($contract->beekeeper) {
            // If contract belongs to this beekeeper show detail information
            if($contract->beekeeper->id == auth()->user()->beekeeper->id) {
                return redirect(route('contract.accept.success', $contract));
            }
            // If contract belongs to another beekeeper show contract taken
            return redirect(route('contract.taken'));
        }

        // Validate if beekeeper is applicable to accept this contract
        if(! $contract->beekeepers->pluck('id')->contains(auth()->user()->beekeeper->id)) return redirect(route('index'));

        return view('models.contract.accept', ['contract' => $contract]);

    }

    /**
     * Display the form if a contract already has a beekeeper.
     *
     * @return \Illuminate\Http\Response
     */
    public function taken()
    {
        return view('models.contract.taken');
    }

    /**
     * Display the successfully accepted specified contract for Beekeeper.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function success($id)
    {
        $contract = Contract::findOrFail($id);

        // Validate if contract already has a beekeeper and if it is the authenticated beekeeper
        if($contract->beekeeper && $contract->beekeeper->id == auth()->user()->beekeeper->id) {
            return view('models.contract.success', ['contract' => $contract]);
        }
        return redirect(route('contract.taken'));
    }

    /**
     * Update specified contract with Beekeeper.
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function acceptContract(Request $request, $id)
    {
        $contract = Contract::findOrFail($id);

        // Validate if contract already has a beekeeper
        if($contract->beekeeper) return redirect(route('contract.taken'));

        // Validate if beekeeper is applicable to accept this contract
        if(! $contract->beekeepers->pluck('id')->contains(auth()->user()->beekeeper->id)) return redirect(route('index'));

        $request->validate([
            'acc' => ['required']
        ], [
            'required' => 'The terms and conditions are required!'
        ]);

        // Add beekeeper to contract
        $contract->beekeeper()->associate(auth()->user()->beekeeper)->save();


        // Notify detail Info per SMS.
        NotificationController::notifyBeekeeperContractAssigned($contract);

        return redirect(route('contract.accept.success', $contract));

    }

}
