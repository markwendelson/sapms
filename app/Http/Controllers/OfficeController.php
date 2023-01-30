<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Office;
use App\Models\User;

class OfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offices = Office::with('officer')->paginate();
        return view('pages.office.index', compact('offices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $officers_in_charge = User::all();
        return view('pages.office.create', compact('officers_in_charge'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $office = new Office;
        $office->code = $request->code;
        $office->name = $request->name;
        $office->officer_in_charge = $request->officer_in_charge;
        $office->save();

        return redirect()->route('office.show', $office->id)->with('message', 'Office successfuly saved.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Office $office)
    {
        return view('pages.office.show', compact('office'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Office $office)
    {
        $officers_in_charge = User::all();
        return view('pages.office.edit', compact('office', 'officers_in_charge'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $office = Office::find($id);
        $office->code = $request->code;
        $office->name = $request->name;
        $office->officer_in_charge = $request->officer_in_charge;
        $office->save();

        return redirect()->route('office.show', $office->id)->with('message', 'Office successfuly updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
