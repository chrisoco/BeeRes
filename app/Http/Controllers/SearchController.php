<?php

namespace App\Http\Controllers;

use App\Models\Beekeeper;
use App\Models\Postcode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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

        $validator = Validator::make($request->all(), [
            'postcode_id' => ['required', 'exists:App\Models\Postcode,id'],
        ]);

        if(! $validator->fails()) {

            $validated = $validator->validated();
            $postcode  = Postcode::find($validated['postcode_id']);

            $beekeepers = self::findClosestBeekeeper($postcode->postcode);

            return Response($beekeepers->take(5)->map->only(['fullName', 'reverseFormattedPhone', 'jurisdictionsToString']));

        }

        return null;

    }


    public static function findClosestBeekeeper($postcode)
    {
        $data = DB::table('beekeepers')
            ->join('beekeeper_postcode', 'beekeeper_postcode.beekeeper_id', '=', 'beekeepers.id')
            ->join('postcodes', 'beekeeper_postcode.postcode_id', '=', 'postcodes.id')
            ->selectRaw('beekeepers.id, min(abs('.$postcode.' - postcodes.postcode)) AS mindiff')
            ->groupBy('beekeepers.id')
            ->orderBy('mindiff')
            ->pluck('beekeepers.id');

        $beekeepers = Beekeeper::all();

        return $data->map(function($id) use($beekeepers) {
            return $beekeepers->where('id', $id)->first();
        });

    }

}


