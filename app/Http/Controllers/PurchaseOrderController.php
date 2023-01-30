<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PurchaseOrder;
use App\Models\PurchaseRequest;
use App\Models\Office;
use App\Models\Item;
use App\Http\Requests\PurchaseOrderRequest;

class PurchaseOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $po = PurchaseOrder::orderByDesc('created_at')->paginate(10);
        return view('pages.purchase-order.index', compact('po'));
    }

    public function show($id)
    {
        $po = PurchaseOrder::with(['details','createdBy'])->where('id',$id)->first();
        return view('pages.purchase-order.show', compact('po'));
    }

    public function create(Request $request)
    {
        $po = PurchaseOrder::whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', date('m'))->get();
        $po_no = config('constants.po_number').str_pad($po->count() +  1,5,0,STR_PAD_LEFT);

        $offices = Office::all();
        $items = Item::all();
        $po_items = session('po_items', []);


        $pr_ids = PurchaseOrder::where('status',0)->pluck('pr_id')->toArray();
        $prs = PurchaseRequest::whereNotIn('id',$pr_ids)->get(['id','pr_no']);

        return view('pages.purchase-order.create',
                    compact('offices','items','po_items','prs','po_no')
                );
    }

    // add to list
    public function add(Request $request)
    {
        $item = Item::findOrFail($request->item_id);
        $id = $item->id;

        $po_items = $request->session()->get('po_items');

        if ($po_items) {
            // check if this item exist then increment quantity
            if (isset($po_items[$id])) {
                $po_items[$id]['quantity'] += $request->qty_requested;
            } else {
                // if item not exist in po_items then add to po_items with quantity requested
                $po_items[$id] = [
                    'item' => $item,
                    'quantity' => $request->qty_requested,
                ];
            }

            $request->session()->put('po_items', $po_items);
        } else {
            // po_items empty add first item
            $itemx = [
                $id => [
                    'item' => $item,
                    'quantity' => $request->qty_requested,
                ]
            ];

            $request->session()->put('po_items', $itemx);
        }

        $po_items = $request->session()->get('po_items');

        return view('pages.purchase-order.po-items', compact('po_items'));

        // return response()->json([
        //     'message' => 'Item added to purchase request items successfully!',
        //     'po_items' => $request->session()->get('po_items'),
        // ]);
    }

    public function remove(Request $request)
    {
        if ($request->id) {
            $po_items = $request->session()->get('po_items');
            if (isset($po_items[$request->id])) {
                unset($po_items[$request->id]);
                $request->session()->put('po_items', $po_items);
            }

            // clear if last item
            if (count($request->session()->get('po_items')) <= 0) {
                $request->session()->forget(['po_items']);

                return response()->json([
                    'message' => 'Your purchase request items is empty!',
                    'po_items' => [],
                ]);
            }

            // $po_items = $request->session()->get('po_items');

            // return view('pages.purchase-order.po-items', compact('po_items'));

            return response()->json([
                'message' => 'PR item has been removed!',
                'po_items' => $request->session()->get('po_items'),
            ]);
        }
    }

    public function store(PurchaseOrderRequest $request)
    {

        $unit_cost = $request->unit_cost;
        $pr = PurchaseRequest::with('details')->find($request->pr_id);

        $po = new PurchaseOrder;
        $po->pr_id = $request->pr_id;
        $po->po_no = $request->po_no;
        $po->office_id = $pr->office_id;
        $po->section = $pr->section;
        $po->supplier_name = $request->supplier_name;
        $po->supplier_address = $request->supplier_address;
        $po->place_of_delivery = $request->place_of_delivery;
        $po->date_of_delivery = $request->date_of_delivery;
        $po->delivery_time = $request->delivery_time;
        $po->payment_term = $request->payment_term;
        $po->mode_of_procurement = $request->mode_of_procurement;
        $po->created_by = \Auth::id();
        $po->created_at = $request->po_date;
        $po->save();

        // iterate pr_items
        $po_details = [];
        foreach ($pr->details as $key => $item) {
            $po_details[$key]['po_id'] = $po->id;
            $po_details[$key]['item_id'] = $item->item_id;
            $po_details[$key]['item_name'] = $item->item_name;
            $po_details[$key]['item_description'] = $item->item_description;
            $po_details[$key]['quantity'] = $item->quantity;
            $po_details[$key]['unit_cost'] = $unit_cost[$key];
            $po_details[$key]['unit_of_measure'] = $item->unit_of_measure;
        }

        \DB::table('purchase_order_details')->insert($po_details);

        return redirect()->route('purchase-order.show', $po->id)->with('message', 'Purchase Order successfuly saved.');

    }

    public function print($id)
    {
        $po = PurchaseOrder::with(['details'])->where('id',$id)->first();
        return view('pages.purchase-order.print', compact('po'));
    }
}
