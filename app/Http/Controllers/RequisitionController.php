<?php

namespace App\Http\Controllers;
use App\Models\Requisition;
use App\Models\Office;
use App\Models\Item;

use Illuminate\Http\Request;

class RequisitionController extends Controller
{
    public function index()
    {
        return view('pages.requisition.index');
    }

    public function show(Request $request)
    {
        return view('pages.requisition.show');
    }

    public function create()
    {
        $ris = Requisition::whereYear('requested_at', '=', date('Y'))->whereMonth('requested_at', '=', date('m'))->get();
        $ris_no = config('constants.ris_number').str_pad($ris->count() +  1,5,0,STR_PAD_LEFT);

        $offices = Office::all();
        $items = Item::all();
        $requisition_items = session('requisition_items', []);

        return view('pages.requisition.create', compact('offices','items','requisition_items'))->with('ris_no', $ris_no);;
    }

    public function store()
    {

    }

    // add to list
    public function add(Request $request)
    {
        $item = Item::findOrfail($request->item_id);
        $id = $item->id;

        $requisition_items = $request->session()->get('requisition_items');

        if ($requisition_items) {
            // check if this item exist then increment quantity
            if (isset($requisition_items[$id])) {

                // check if quantity exceed
                if($requisition_items[$id]['item']['quantity'] < $requisition_items[$id]['quantity'] + $request->qty_requested) {
                    return response()->json([
                        'message' => 'Insufficient quantity!',
                        'requisition_items' => $request->session()->get('requisition_items'),
                    ],405);
                }

                $requisition_items[$id]['quantity'] += $request->qty_requested;
            } else {

                // check if quantity exceed
                if($item->quantity < $request->qty_requested) {
                    return response()->json([
                        'message' => 'Insufficient quantity!',
                        'requisition_items' => $request->session()->get('requisition_items'),
                    ],405);
                }

                // if item not exist in requisition_items then add to requisition_items with quantity requested
                $requisition_items[$id] = [
                    'item' => $item,
                    'quantity' => $request->qty_requested,
                ];
            }

            $request->session()->put('requisition_items', $requisition_items);
        } else {

            // check if quantity exceed
            if($item->quantity < $request->qty_requested) {
                return response()->json([
                    'message' => 'Insufficient quantity!',
                    'requisition_items' => $request->session()->get('requisition_items'),
                ],405);
            }

            // requisition_items empty add first item
            $itemx = [
                $id => [
                    'item' => $item,
                    'quantity' => $request->qty_requested,
                ]
            ];

            $request->session()->put('requisition_items', $itemx);
        }

        return response()->json([
            'message' => 'Item added to requisition items successfully!',
            'requisition_items' => $request->session()->get('requisition_items'),
        ]);
    }

    public function remove(Request $request)
    {
        if ($request->id) {
            $requisition_items = $request->session()->get('requisition_items');
            if (isset($requisition_items[$request->id])) {
                unset($requisition_items[$request->id]);
                $request->session()->put('requisition_items', $requisition_items);
            }

            // clear if last item
            if (count($request->session()->get('requisition_items')) <= 0) {
                $request->session()->forget(['requisition_items']);

                return response()->json([
                    'message' => 'Your requisition items is empty!',
                    'requisition_items' => [],
                ]);
            }

            return response()->json([
                'message' => 'Requisition item has been removed!',
                'requisition_items' => $request->session()->get('requisition_items'),
            ]);
        }
    }
}
