<?php

namespace App\Http\Controllers;

use App\Models\Postcode;
use Illuminate\Support\Facades\Http;

class NominatimController extends Controller
{
    public static function getPLZ($lat, $lon)
    {

        $res = Http::get('https://nominatim.openstreetmap.org/reverse?lat='. $lat .'&lon='. $lon .'&format=json');

        $place = json_decode($res->body());

        if(array_key_exists('address', $place) && array_key_exists('postcode', $place->address)) {

            $postcode_nom = $place->address->postcode;

            $postcode = Postcode::where('postcode', $postcode_nom)->first();

            if($postcode) return $postcode;

        }

        return null;

    }
}
