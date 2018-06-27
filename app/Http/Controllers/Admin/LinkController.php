<?php

namespace App\Http\Controllers\Admin;

use Alert;
use App\Http\Controllers\Controller;
use App\Link;
use Illuminate\Http\Request;

use App\Http\Requests;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $links = Link::orderBy('name')->get();

        return view('admin.link.index', compact('links'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.link.create');
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
            'name' => 'required',
            'url' => 'required|url'
        ]);

        $link = new Link([
            'name' => trim($request->input('name')),
            'url' => trim($request->input('url'))
        ]);

        $link->save();

        Alert::success('Link created.')->flash();

        return redirect()->route('admin.link.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Link $link
     * @return \Illuminate\Http\Response
     */
    public function edit(Link $link)
    {
        return view('admin.link.edit', compact('link'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Link $link
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Link $link)
    {
        $this->validate($request, [
            'name' => 'required',
            'url' => 'required|url'
        ]);

        $link->fill([
            'name' => trim($request->input('name')),
            'url' => trim($request->input('url'))
        ]);

        $link->save();

        Alert::success('Link updated.')->flash();

        return redirect()->route('admin.link.edit', $link);
    }

    /**
     * Confirm before deleting resource
     *
     * @param Link $link
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function confirmDelete(Link $link)
    {
        return view('admin.link.confirm-delete', compact('link'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Link $link
     * @return \Illuminate\Http\Response
     */
    public function destroy(Link $link)
    {
        $link->delete();

        Alert::success('Link deleted.')->flash();

        return redirect()->route('admin.link.index');
    }
}
