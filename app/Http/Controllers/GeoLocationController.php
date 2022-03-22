<?php

namespace App\Http\Controllers;

use App\Models\Postcode;
use Illuminate\Support\Facades\Http;

class GeoLocationController extends Controller
{
    public static function getPlzFromLatLon($lat, $lon)
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

    public static function generateGoogleMapsPin($lat, $lon):string
    {
        return 'https://www.google.com/maps/search/?api=1&query='.$lat.'%2C'.$lon;
    }
}
