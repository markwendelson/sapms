<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class SupplyAvailabilityController extends Controller
{
    public function index(Request $request)
    {
        if($request->search) {
            $items = Item::where('name','LIKE','%'.$request->search.'%')
                        ->orWhere('code','LIKE','%'.$request->search.'%')
                        ->limit(10)
                        ->get();
        } else {
            $items = Item::all()->random(10);
        }

        return view('pages.supply-availability.index', compact('items'));
    }

}
