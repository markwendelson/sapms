<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Http\Requests\ItemRequest;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();
        return view('pages.item.index', compact('items'));
    }

    public function create()
    {
        $items = Item::whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', date('m'))->get();
        $item_code = config('constants.item_code').str_pad($items->count() +  1,5,0,STR_PAD_LEFT);

        return view('pages.item.create')->with('item_code', $item_code);
    }

    public function store(ItemRequest $request)
    {
        $item = new Item;
        $item->code = $request->code;
        $item->name = $request->name;
        $item->description = $request->description;
        $item->quantity = $request->quantity;
        $item->unit_of_measure = $request->unit_of_measure;
        $item->price = $request->price;
        $item->category = $request->category;
        $item->useful_life = $request->useful_life;
        $item->fixed_asset = $request->fixed_asset;
        $item->date_acquired = $request->date_acquired;
        $item->save();

        return redirect()->route('item.show', $item->id)->with('message', 'Item successfuly saved.');
    }

    public function show($id)
    {
        $item = Item::findOrFail($id);
        return view('pages.item.show', compact('item'));
    }

    public function edit(Request $request, $id)
    {
        $item = Item::findOrFail($id);
        return view('pages.item.edit', compact('item'));
    }

    public function update(ItemRequest $request, $id)
    {
        $item = Item::find($id);
        $item->code = $request->code;
        $item->name = $request->name;
        $item->description = $request->description;
        $item->quantity = $request->quantity;
        $item->unit_of_measure = $request->unit_of_measure;
        $item->price = $request->price;
        $item->category = $request->category;
        $item->save();

        return redirect()->route('item.show', $item)->with('message', 'Item successfuly updated.');
    }

}
