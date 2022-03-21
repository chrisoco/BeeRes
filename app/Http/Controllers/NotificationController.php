<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public static function notifyBeekeeperNewContract(Contract $contract)
    {

        // Find all Beekeepers from Region:
        $beekeepersFromRegion = $contract->postcode->beekeepers;

        foreach ($beekeepersFromRegion as $beekeeper) {

            $msg = 'Dear '.$beekeeper->fullName .', '.
                   'You have been selected for a new Beekeeper job! Apply here: '.
                    route('contract.accept', $contract->id);

            $beekeeper->contracts_applicable()->attach($contract);
            // SmsController::sendSmsNotification($beekeeper->phone, $msg);

        }


    }
}
