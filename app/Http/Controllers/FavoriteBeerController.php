<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth, DB;
use App\{FavoriteBeer};


class FavoriteBeerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        return view('favorites');
    }

    public function setAsFavorite(Request $request)
    {
        $beer_id = $request['id'];

        DB::beginTransaction();

        try {

            $record = FavoriteBeer::where('user_id', Auth::user()->id)->where('beer_id', $beer_id);

            if($record->count() == 0) {
                FavoriteBeer::create([
                    'beer_id' => $beer_id,
                    'user_id' => Auth::user()->id
                ]);

                DB::commit();
                return 'add';
            } else {
                $record->delete();

                DB::commit();
                return 'remove';
            }

        } catch(\Exception $e) {
            DB::rollback();
            return $e;
        }
    }

    public function verifyFavorites()
    {
        return Auth::user()->favoriteBeers->pluck('beer_id');
    }
}