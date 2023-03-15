<?php

namespace App\Functions;

use App\Models\Item;

class Helpers
{
    function generate($module_name, $item_count)
    {

    }

    function generateItemCode()
    {
        $count = Item::whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', date('m'))->count();
        $item_code = config('constants.item_code').str_pad($count +  1,5,0,STR_PAD_LEFT);

        return $item_code;
    }
}
