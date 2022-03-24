<?php

namespace App\Http\Controllers;

use App\Models\Beekeeper;
use App\Models\Postcode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public static function searchPLZ(Request $request)
    {

        if($request->input('search')) {

            $column = is_numeric($request->input('search')) ? 'postcode' : 'name';

            $data = DB::table('postcodes')
                ->where($column, 'LIKE', '%' . $request->input('search') . "%")
                ->whereNotIn('id', auth()->user()->beekeeper->postcodes->pluck('id'))
                ->limit(10)->get();

            return Response($data);

        }

        return Response(Postcode::all()->take(10));

    }

    public static function guestSearchPLZ(Request $request)
    {

        if($request->input('search')) {

            $column = is_numeric($request->input('search')) ? 'postcode' : 'name';

            $data = DB::table('postcodes')
                ->where($column, 'LIKE', '%' . $request->input('search') . "%")
                ->limit(5)->get();

            return Response($data);

        }

        return Response(Postcode::all()->take(5));

    }

    public static function guestSearchBeekeeper(Request $request)
    {

        if($request->input('postcode_id')) {


            // return Response($data);

        }

        return Response(Beekeeper::all()->take(5)->map->only('fullName', 'formattedPhone', 'jurisdictionsToString'));

    }
}


