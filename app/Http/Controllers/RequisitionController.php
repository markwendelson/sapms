<?php

namespace App\Http\Controllers;
use App\Models\Requisition;
use App\Models\Office;
use App\Models\Item;
use App\Models\User;

use Illuminate\Http\Request;

class RequisitionController extends Controller
{
    public function index()
    {
        $ris = Requisition::orderByDesc('requested_at')->paginate(10);
        return view('pages.requisition.index', compact('ris'));
    }

    public function show($id)
    {
        $requisition = Requisition::with('details','requisitioner','approvedBy','issuedBy','receivedBy')->where('id', $id)->first();
        return view('pages.requisition.show', compact('requisition'));
    }

    public function create()
    {
        $ris = Requisition::whereYear('requested_at', '=', date('Y'))->whereMonth('requested_at', '=', date('m'))->get();
        $ris_no = config('constants.ris_number').str_pad($ris->count() +  1,5,0,STR_PAD_LEFT);

        $offices = Office::all();
        $items = Item::all();
        $requisition_items = session('requisition_items', []);
        $users = User::all();

        return view('pages.requisition.create', compact('offices','items','requisition_items','users'))->with('ris_no', $ris_no);;
    }

    public function store(Request $request)
    {

        $requisition_items = $request->session()->get('requisition_items', []);

        $office = Office::findOrFail($request->office_id);

        $requistion = new Requisition;
        $requistion->entity_name = $request->entity_name;
        $requistion->division = $request->division;
        $requistion->office_id = $request->office_id;
        $requistion->purpose = $request->purpose;
        $requistion->fund_cluster = $request->fund_cluster;
        $requistion->responsibility_code = $request->responsibility_code;
        $requistion->ris_no = $request->ris_no;
        $requistion->requested_at = $request->ris_date;
        $requistion->requested_by = $request->requested_by;
        $requistion->approved_by = $request->approved_by;
        $requistion->issued_by = $request->issued_by;
        $requistion->issued_at = $request->issued_at;
        $requistion->received_by = $request->received_by;
        $requistion->received_at = $request->received_at;
        $requistion->save();

        // iterate requisition_items
        $ris_details = [];
        foreach ($requisition_items as $key => $item) {
            $ris_details[$key]['ris_id'] = $requistion->id;
            $ris_details[$key]['item_id'] = $item['item']['id'];
            $ris_details[$key]['item_name'] = $item['item']['name'];
            $ris_details[$key]['item_description'] = $item['item']['description'];
            $ris_details[$key]['quantity'] = $item['quantity'];
            $ris_details[$key]['unit_of_measure'] = $item['item']['unit_of_measure'];
        }

        \DB::table('requisition_details')->insert($ris_details);

        // clear session requisitions_details
        $request->session()->forget(['requisition_items']);

        return redirect()->route('requisition-and-issuance.show', $requistion->id)->with('message', 'Requisition and Issuance successfuly saved.');

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
