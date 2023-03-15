<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ReportController extends Controller
{
    public function inspection_acceptance(Request $request){
        $ia = DB::table('inspection_and_acceptances as a')
        ->leftjoin('purchase_orders as b','b.id','a.po_id')
        ->leftjoin('offices as c','c.id','a.office_id')
        ->selectraw('a.*,b.po_no,c.name')
        ->where('a.id', $request->id)
        ->first();

        $ia_details = DB::table('inspection_and_acceptance_details')
        ->where('iar_id',$ia->id)
        ->get();
        // $applications_chunk = array_chunk($ia_details, "10");
        // dd($applications_chunk);
        return view('reports.inspection_acceptance',compact('ia','ia_details'));
    }

    public function purchase_request(Request $request){
        $pr = DB::table('purchase_requests as a')
        ->leftjoin('offices as b','b.id','a.office_id')
        ->leftjoin('users as u','u.id','a.requested_by')
        ->where('a.id', $request->id)
        ->selectraw('a.*,b.name as office,u.name as requisitioner')
        ->first();

        $pr_details = DB::table('purchase_request_details')
        ->where('pr_id',$pr->id)
        ->get();
        return view('reports.purchase_request',compact('pr','pr_details'));
    }

    public function purchase_order(Request $request){
        $po = DB::table('purchase_orders as a')
        ->leftjoin('offices as b','b.id','a.office_id')
        ->leftjoin('purchase_requests as c','c.id','a.pr_id')
        ->where('a.id', $request->id)
        ->selectraw('a.*,b.name,c.pr_no')
        ->first();
        $po_details = DB::table('purchase_order_details')
        ->where('po_id',$po->id)
        ->get();
        return view('reports.purchase_order',compact('po','po_details'));
    }

    public function property_card(Request $request){
        $property = DB::table('items')
                    ->where('id', $request->id)
                    ->first();

        $details  = DB::table('purchase_request_details')
                    ->where('item_id', $request->id)
                    ->get();
        return view('reports.property_card',compact('property', 'details'));
    }

    public function property_acknowledge_receipt(Request $request){
        $ia = DB::table('inspection_and_acceptances as a')
            ->leftjoin('purchase_orders as b','b.id','a.po_id')
            ->leftjoin('offices as c','c.id','a.office_id')
            ->where('a.id', $request->id)
            ->selectraw('a.*,b.po_no,c.name')
            ->first();
        $ia_details = DB::table('inspection_and_acceptance_details')
            ->where('iar_id',$ia->id)
            ->get();

        return view('reports.property_acknowledge_receipt',compact('ia','ia_details'));
    }

    public function inventory_custodian_slip(Request $request){
        $ia = DB::table('inspection_and_acceptances as a')
            ->leftjoin('purchase_orders as b','b.id','a.po_id')
            ->leftjoin('offices as c','c.id','a.office_id')
            ->leftjoin('purchase_order_details as d','b.id','d.po_id')
            ->where('a.id', $request->id)
            ->selectraw('a.*,b.po_no,c.name, d.unit_cost')
            ->first();
        $ia_details = DB::table('inspection_and_acceptance_details')
            ->where('iar_id',$ia->id)
            ->get();

        return view('reports.inventory_custodian_slip',compact('ia','ia_details'));
    }

    public function requisition_issue_slip(Request $request){
        $ris = DB::table('requisitions as a')
        ->leftjoin('offices as b','b.id','a.office_id')
        ->where('a.id', $request->id)
        ->selectraw('a.*,b.name')
        ->first();
        $ris_details = DB::table('requisition_details')
        ->where('ris_id',$ris->id)
        ->get();
        return view('reports.requisition_issue_slip',compact('ris','ris_details'));
    }

    public function inspection_acceptance_report(Request $request){
        $ia = DB::table('inspection_and_acceptances as a')
        ->leftjoin('purchase_orders as b','b.id','a.po_id')
        ->leftjoin('offices as c','c.id','a.office_id')
        ->where('a.id', $request->id)
        ->selectraw('a.*,b.po_no,c.name')
        ->first();
        $ia_details = DB::table('inspection_and_acceptance_details')
        ->where('iar_id',$ia->id)
        ->get();
        return view('reports.inspection_acceptance_report',compact('ia','ia_details'));
    }

    public static function convert_number_to_words($number)
    {

        $hyphen      = '-';
        $conjunction = ' and ';
        $separator   = ', ';
        $negative    = 'negative ';
        $decimal     = ' point ';
        $dictionary  = array(
            0                   => 'zero',
            1                   => 'one',
            2                   => 'two',
            3                   => 'three',
            4                   => 'four',
            5                   => 'five',
            6                   => 'six',
            7                   => 'seven',
            8                   => 'eight',
            9                   => 'nine',
            10                  => 'ten',
            11                  => 'eleven',
            12                  => 'twelve',
            13                  => 'thirteen',
            14                  => 'fourteen',
            15                  => 'fifteen',
            16                  => 'sixteen',
            17                  => 'seventeen',
            18                  => 'eighteen',
            19                  => 'nineteen',
            20                  => 'twenty',
            30                  => 'thirty',
            40                  => 'fourty',
            50                  => 'fifty',
            60                  => 'sixty',
            70                  => 'seventy',
            80                  => 'eighty',
            90                  => 'ninety',
            100                 => 'hundred',
            1000                => 'thousand',
            1000000             => 'million',
            1000000000          => 'billion',
            1000000000000       => 'trillion',
            1000000000000000    => 'quadrillion',
            1000000000000000000 => 'quintillion'
        );

        if (!is_numeric($number)) {
            return false;
        }

        if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
            // overflow
            trigger_error(
                'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
                E_USER_WARNING
            );
            return false;
        }

        if ($number < 0) {
            return $negative . Self::convert_number_to_words(abs($number));
        }

        $string = $fraction = null;

        if (strpos($number, '.') !== false) {
            list($number, $fraction) = explode('.', $number);
        }

        switch (true) {
            case $number < 21:
                $string = $dictionary[$number];
                break;
            case $number < 100:
                $tens   = ((int) ($number / 10)) * 10;
                $units  = $number % 10;
                $string = $dictionary[$tens];
                if ($units) {
                    $string .= $hyphen . $dictionary[$units];
                }
                break;
            case $number < 1000:
                $hundreds  = $number / 100;
                $remainder = $number % 100;
                $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
                if ($remainder) {
                    $string .= $conjunction . Self::convert_number_to_words($remainder);
                }
                break;
            default:
                $baseUnit = pow(1000, floor(log($number, 1000)));
                $numBaseUnits = (int) ($number / $baseUnit);
                $remainder = $number % $baseUnit;
                $string = Self::convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
                if ($remainder) {
                    $string .= $remainder < 100 ? $conjunction : $separator;
                    $string .= Self::convert_number_to_words($remainder);
                }
                break;
        }

        if (null !== $fraction && is_numeric($fraction)) {
            $string .= $decimal;
            $words = array();
            foreach (str_split((string) $fraction) as $number) {
                $words[] = $dictionary[$number];
            }
            $string .= implode(' ', $words);
        }

        return $string;
    }
}
