<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public static function notifyBeekeeperNewContract(Contract $contract)
    {



        // Find all Beekeepers from Region:
        $beekeepers = $contract->postcode->beekeepers;

        if(count($beekeepers) == 0) {

            // Search nearest Beekeepers and add to $beekeepers.

        }

        $failed = [];

        foreach ($beekeepers as $beekeeper) {

            $msg = 'Dear ' . $beekeeper->fullName . ', ' .
                'You have been selected for a new Beekeeper job! Apply here: ' .
                route('contract.accept', $contract->id);

            $beekeeper->contracts_applicable()->attach($contract);
            // $success = SmsController::sendSmsNotification($beekeeper->phone, $msg);
            $success = true;

            if(! $success) {
                $failed[] = $beekeeper;
            }

        }

        if(count($failed) > 0) {
            // Notify E-Mail $contract->created_by_user
        }



    }
}
