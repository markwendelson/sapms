<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public function autoCompleteSupplies()
    {
        $autocomplete = Item::distinct('name')->pluck('name');

        return $autocomplete;
    }

    public function autoCompleteBrands()
    {
        $autocomplete = Item::whereNotNull('brand')->distinct('brand')->pluck('brand');

        return $autocomplete;
    }

    public function autoCompleteModels()
    {
        $autocomplete = Item::whereNotNull('model')->distinct('model')->pluck('model');

        return $autocomplete;
    }
}
