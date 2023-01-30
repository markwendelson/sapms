<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PurchaseRequest;
use App\Models\Office;
use App\Models\Item;
use App\Http\Requests\PurchaseRequestRequest;

class PurchaseRequestController extends Controller
{
    public function index()
    {
        $pr = PurchaseRequest::orderByDesc('requested_at')->paginate(10);
        return view('pages.purchase-request.index', compact('pr'));
    }

    public function show($id)
    {
        $pr = PurchaseRequest::with(['details','office','requisitioner'])->where('id',$id)->first();
        return view('pages.purchase-request.show', compact('pr'));
    }

    public function create(Request $request)
    {
        $pr = PurchaseRequest::whereYear('requested_at', '=', date('Y'))->whereMonth('requested_at', '=', date('m'))->get();
        $pr_no = config('constants.pr_number').str_pad($pr->count() +  1,5,0,STR_PAD_LEFT);

        $offices = Office::all();
        $items = Item::all();
        $pr_items = session('pr_items', []);

        return view('pages.purchase-request.create', compact('offices','items','pr_items'))->with('pr_no', $pr_no);;
    }

    // add to list
    public function add(Request $request)
    {
        $item = Item::find($request->item_id);

        $pr_items = $request->session()->get('pr_items');

        if(!$item)
        {
            $id = $request->item_id;

            $item = [
                'id' => null,
                'unit_of_measure' => $request->unit_of_measure,
                'name' => $request->item_id,
                'description' => $request->description,
                'quantity' => $request->qty_requested,
            ];

            if ($pr_items) {
                // check if this item exist then increment quantity
                if (isset($pr_items[$id])) {
                    $pr_items[$id]['quantity'] += $request->qty_requested;
                } else {
                    // if item not exist in pr_items then add to pr_items with quantity requested
                    $pr_items[$id] = [
                        'item' => $item,
                        'quantity' => $request->qty_requested,
                    ];
                }

                $request->session()->put('pr_items', $pr_items);
            } else {
                // pr_items empty add first item
                $itemx = [
                    $id => [
                        'item' => $item,
                        'quantity' => $request->qty_requested,
                    ]
                ];

                $request->session()->put('pr_items', $itemx);
            }
        } else {

            $id = $item->id;

            if ($pr_items) {
                // check if this item exist then increment quantity
                if (isset($pr_items[$id])) {
                    $pr_items[$id]['quantity'] += $request->qty_requested;
                } else {
                    // if item not exist in pr_items then add to pr_items with quantity requested
                    $pr_items[$id] = [
                        'item' => $item,
                        'quantity' => $request->qty_requested,
                    ];
                }

                $request->session()->put('pr_items', $pr_items);
            } else {
                // pr_items empty add first item
                $itemx = [
                    $id => [
                        'item' => $item,
                        'quantity' => $request->qty_requested,
                    ]
                ];

                $request->session()->put('pr_items', $itemx);
            }

        }


        $pr_items = $request->session()->get('pr_items');

        // return view('pages.purchase-request.pr-items', compact('pr_items'));

        return response()->json([
            'message' => 'Item added to purchase request items successfully!',
            'pr_items' => $request->session()->get('pr_items'),
        ]);
    }

    public function remove(Request $request)
    {
        if ($request->id) {
            $pr_items = $request->session()->get('pr_items');
            if (isset($pr_items[$request->id])) {
                unset($pr_items[$request->id]);
                $request->session()->put('pr_items', $pr_items);
            }

            // clear if last item
            if (count($request->session()->get('pr_items')) <= 0) {
                $request->session()->forget(['pr_items']);

                return response()->json([
                    'message' => 'Your purchase request items is empty!',
                    'pr_items' => [],
                ]);
            }

            // $pr_items = $request->session()->get('pr_items');

            // return view('pages.purchase-request.pr-items', compact('pr_items'));

            return response()->json([
                'message' => 'PR item has been removed!',
                'pr_items' => $request->session()->get('pr_items'),
                // 'entity_name' => $request->entity_name,
                // 'division' => $request->division,
                // 'purpose' => $request->purpose,
                // 'office_id' => $request->office_id,
                // 'responsibility_code' => $request->responsibility_code
            ]);
        }
    }

    public function store(PurchaseRequestRequest $request)
    {
        // dd($request->all());
        // get cart session
        $pr_items = $request->session()->get('pr_items', []);

        $office = Office::findOrFail($request->office_id);

        $pr = new PurchaseRequest;
        $pr->pr_no = $request->pr_no;
        $pr->office_id = $office->id;
        $pr->section = $request->section;
        $pr->purpose = $request->purpose;
        $pr->charges_for = $request->charges_for    ;
        $pr->requested_by = $office->officer_in_charge;
        $pr->requested_at = $request->pr_date;
        $pr->created_by = \Auth::id();
        $pr->created_at = $request->pr_date;
        $pr->save();

        // iterate pr_items
        $pr_details = [];
        foreach ($pr_items as $key => $item) {
            $pr_details[$key]['pr_id'] = $pr->id;
            $pr_details[$key]['item_id'] = $item['item']['id'];
            $pr_details[$key]['item_name'] = $item['item']['name'];
            $pr_details[$key]['item_description'] = $item['item']['description'];
            $pr_details[$key]['quantity'] = $item['quantity'];
            $pr_details[$key]['unit_of_measure'] = $item['item']['unit_of_measure'];
        }

        \DB::table('purchase_request_details')->insert($pr_details);

        // clear session pr_items
        $request->session()->forget(['pr_items']);

        return redirect()->route('purchase-request.show', $pr->id)->with('message', 'Purchase Request successfuly saved.');

    }

    public function print($id)
    {
        $pr = PurchaseRequest::with(['details','office','requisitioner'])->where('id',$id)->first();
        return view('pages.purchase-request.print', compact('pr'));
    }

}
