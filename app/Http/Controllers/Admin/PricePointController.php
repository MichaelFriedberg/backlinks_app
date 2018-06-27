<?php

namespace App\Http\Controllers\Admin;

use Alert;
use App\Http\Controllers\Controller;
use App\PricePoint;
use Illuminate\Http\Request;

use App\Http\Requests;

class PricePointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pricepoints = PricePoint::orderBy('from')->get();

        return view('admin.pricepoint.index', compact('pricepoints'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pricepoint.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'from' => 'required|numeric',
            'to' => 'required|numeric',
            'price' => 'required|numeric'
        ]);

        $pricepoint = new PricePoint([
            'from' => trim($request->input('from')),
            'to' => trim($request->input('to')),
            'price' => trim($request->input('price'))
        ]);

        $pricepoint->save();

        Alert::success('Price point created.')->flash();

        return redirect()->route('admin.pricepoint.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param PricePoint $pricepoint
     * @return \Illuminate\Http\Response
     */
    public function edit(PricePoint $pricepoint)
    {
        return view('admin.pricepoint.edit', compact('pricepoint'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param PricePoint $pricepoint
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PricePoint $pricepoint)
    {
        $this->validate($request, [
            'from' => 'required|numeric',
            'to' => 'required|numeric',
            'price' => 'required|numeric'
        ]);

        $pricepoint->fill([
            'from' => trim($request->input('from')),
            'to' => trim($request->input('to')),
            'price' => trim($request->input('price'))
        ]);

        $pricepoint->save();

        Alert::success('Price point updated.')->flash();

        return redirect()->route('admin.pricepoint.edit', $pricepoint);
    }

    /**
     * Confirm before deleting resource
     *
     * @param PricePoint $pricepoint
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function confirmDelete(PricePoint $pricepoint)
    {
        return view('admin.pricepoint.confirm-delete', compact('pricepoint'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PricePoint $pricepoint
     * @return \Illuminate\Http\Response
     */
    public function destroy(PricePoint $pricepoint)
    {
        $pricepoint->delete();

        Alert::success('Price point deleted.')->flash();

        return redirect()->route('admin.pricepoint.index');
    }
}
