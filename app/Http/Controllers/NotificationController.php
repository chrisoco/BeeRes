<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Notifications\ContractApplicableNotification;
use App\Notifications\ContractAssignedNotification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public static function notifyBeekeeperNewContract(Contract $contract)
    {

        // Find all Beekeepers from specific Region
        $beekeepers = $contract->postcode->beekeepers;

        if(count($beekeepers) == 0) {
            $beekeepers = SearchController::findClosestBeekeeper($contract->postcode->postcode)->take(2);
        }

        foreach ($beekeepers as $beekeeper) {

            $beekeeper->contracts_applicable()->attach($contract);
            $beekeeper->notify(new ContractApplicableNotification($contract));

        }


    }

    public static function notifyBeekeeperContractAssigned(Contract $contract)
    {
        $contract->beekeeper->notify(new ContractAssignedNotification($contract));
    }
}
