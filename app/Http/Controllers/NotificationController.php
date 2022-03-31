<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Notifications\ContractApplicableNotification;
use App\Notifications\ContractAssignedNotification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{

    /**
     * Find the closest Beekeepers and notify about the newly created contract.
     *
     * @param Contract $contract
     * @return void
     */
    public static function notifyBeekeeperNewContract(Contract $contract)
    {

        // Find all beekeepers from specific region
        $beekeepers = $contract->postcode->beekeepers;

        // If no beekeepers could be found, find the closest Beekeepers
        if(count($beekeepers) == 0) {
            $beekeepers = SearchController::findClosestBeekeeper($contract->postcode->postcode)->take(1);
        }

        foreach ($beekeepers as $beekeeper) {

            // Add beekeeper to be applicable to contract
            $beekeeper->contracts_applicable()->attach($contract);
            // Notify beekeeper about the new applicable contract
            $beekeeper->notify(new ContractApplicableNotification($contract));

        }

    }

    /**
     * Notify the beekeeper about all the Detailinformation of the accepted contract.
     *
     * @param Contract $contract
     * @return void
     */
    public static function notifyBeekeeperContractAssigned(Contract $contract)
    {
        $contract->beekeeper->notify(new ContractAssignedNotification($contract));
    }
}
