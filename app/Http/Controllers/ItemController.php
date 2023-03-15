<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Http\Requests\ItemRequest;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::orderByDesc('created_at')->get();
        return view('pages.item.index', compact('items'));
    }

    public function create()
    {
        $count = Item::whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', date('m'))->count();
        $item_code = config('constants.item_code').str_pad($count +  1,5,0,STR_PAD_LEFT);

        $autocomplete = Item::distinct('name')->pluck('name')->toArray();

        return view('pages.item.create', compact('item_code', 'autocomplete'));
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
        $item->type = $request->type;
        $item->brand = $request->brand;
        $item->model = $request->model;
        $item->serial_no = $request->serial_no;
        $item->save();

        return redirect()->route('item.show', $item->id)->with('message', 'Item successfuly saved.');
    }

    public function show($id)
    {
        $item = Item::findOrFail($id);

        $details = \DB::table('purchase_requests as pr')
                        ->leftJoin('purchase_request_details as pr_det', 'pr_det.pr_id', 'pr.id')
                        ->leftJoin('purchase_orders as po', 'po.pr_id', 'pr.id')
                        ->leftJoin('purchase_order_details as po_det', 'po_det.po_id', 'po.id')
                        ->leftJoin('inspection_and_acceptances as iar', 'iar.po_id', 'po.id')
                        ->leftJoin('inspection_and_acceptance_details as iar_det', 'iar_det.iar_id', 'iar.id')
                        ->leftJoin('offices', 'offices.id', 'po.office_id')
                        ->where('pr_det.item_id', $id)
                        ->get(['po.*','iar_det.quantity_received', 'offices.name as office_name', 'po_det.unit_cost']);

        return view('pages.item.show', compact('item', 'details'));
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
