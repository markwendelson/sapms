<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PurchaseOrder;
use App\Models\InspectionAcceptance;
use App\Http\Requests\InspectionAcceptanceRequest;
use App\Functions\Helpers;

class InspectionAcceptanceController extends Controller
{
    public function index()
    {
        $iar = InspectionAcceptance::orderByDesc('created_at')->paginate(10);
        return view('pages.inspection-acceptance.index', compact('iar'));
    }

    public function show($id)
    {
        $iar = InspectionAcceptance::with(['details','createdBy'])->where('id',$id)->firstOrFail();
        // dd($iar->purchase_order);
        return view('pages.inspection-acceptance.show', compact('iar'));
    }

    public function create(Request $request)
    {
        $iar = InspectionAcceptance::whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', date('m'))->get();
        $iar_no = config('constants.iar_number').str_pad($iar->count() +  1,5,0,STR_PAD_LEFT);

        $iar_items = session('iar_items', []);


        $po_ids = InspectionAcceptance::where('status',0)->pluck('po_id')->toArray();
        $pos = PurchaseOrder::whereNotIn('id',$po_ids)->get(['id','po_no']);

        return view('pages.inspection-acceptance.create',
                    compact('iar_items','pos','iar_no')
                );
    }

    public function store(InspectionAcceptanceRequest $request)
    {

        $quantity_received = $request->qty_received;

        $remarks = $request->input('complete') ?? $request->input('partial');
        $po = PurchaseOrder::with('details')->find($request->po_id);

        $iar = new InspectionAcceptance;
        $iar->po_id = $request->po_id;
        $iar->iar_date = $request->iar_date;
        $iar->iar_no = $request->iar_no;
        $iar->office_id = $po->office_id;
        $iar->invoice_no = $request->invoice_no;
        $iar->supplier_name = $request->supplier_name;
        $iar->created_by = \Auth::id();
        $iar->created_at = $request->iar_date;
        $iar->inspection_date = $request->inspection_date;
        $iar->observation = $request->observation;
        $iar->date_received = $request->date_received;
        $iar->remarks = $remarks;
        $iar->remarks_text = $request->remarks_text;
        $iar->save();


        // iterate iar_items
        $iar_details = [];
        $new_items_arr = [];
        foreach ($po->details as $key => $item) {
            $iar_details[$key]['iar_id'] = $iar->id;
            $iar_details[$key]['item_id'] = $item->item_id;
            $iar_details[$key]['item_name'] = $item->item_name;
            $iar_details[$key]['item_description'] = $item->item_description;
            $iar_details[$key]['quantity_ordered'] = $item->quantity;
            $iar_details[$key]['quantity_received'] = $quantity_received[$key];
            $iar_details[$key]['unit_cost'] = $item->unit_cost;
            $iar_details[$key]['unit_of_measure'] = $item->unit_of_measure;

            // if ($item->item_id == '' && $item->quantity == 1) {
            //     $new_items_arr[$key]['code'] = Helpers::generateItemCode();
            //     $new_items_arr[$key]['name'] = $item->name;
            //     $new_items_arr[$key]['description'] = $item->item_description;
            //     $new_items_arr[$key]['quantity'] = $item->quantity;
            //     $new_items_arr[$key]['unit_of_measure'] = $item->unit_of_measure;
            //     $new_items_arr[$key]['price'] = $item->unit_cost;
            //     // $new_items_arr[$key]['category'] = $request->category;
            //     // $new_items_arr[$key]['useful_life'] = $request->useful_life;
            //     // $new_items_arr[$key]['fixed_asset'] = $request->fixed_asset;
            //     $new_items_arr[$key]['date_acquired'] = $request->date_received;
            //     $new_items_arr[$key]['type'] = $item->type;
            //     $new_items_arr[$key]['brand'] = $item->brand;
            //     $new_items_arr[$key]['model'] = $item->model;
            //     $new_items_arr[$key]['serial_no'] = $item->serial_no;

            // } elseif ($item->item_id == '' && $item->quantity > 1) {
            //     if()
            // }
        }

        \DB::table('inspection_and_acceptance_details')->insert($iar_details);

        return redirect()->route('inspection-and-acceptance.show', $iar->id)->with('message', 'Inspection and Acceptance successfuly saved.');
    }

}
