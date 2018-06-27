<?php

namespace App\Http\Controllers;

use App\Site;
use Auth;
use Illuminate\Http\Request;
use Prologue\Alerts\Facades\Alert;
use Event;
use App\Events\NewSiteAdded;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('site.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $site = new Site();

        $input = $request->all();

        // Sanitize url - Scheme and host is all we need
        if (array_key_exists('url', $input) && ! empty($input['url'])) {
            $parsedUrl = $site->sanitizeUrl($input['url']);

            if (! empty($parsedUrl)) {
                $input['url'] = $parsedUrl;

                $request->replace($input);
            }
        }

        $this->validate($request, [
            'url' => 'required|url|active_url|unique:sites,url'
        ]);

        $site = new Site();
        $site->url = $input['url'];

        if (! $site->urlReachable()) {
            return redirect()->back()->withErrors(['url' => 'URL is not reachable'])->withInput($input);
        }

        $site->user_id = Auth::user()->id;
        Event::fire(new NewSiteAdded($site)); // Notifies the Admin
        $site->save();

        Alert::success('Site created.')->flash();

        return redirect()->route('site.show', $site);
    }

    /**
     * Show the resource.
     *
     * @param Site $site
     * @return \Illuminate\Http\Response
     */
    public function show(Site $site)
    {
        if (Auth::user()->id != $site->user_id) {
            return redirect('/');
        }

        return view('site.show', compact('site'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Site $site
     * @return \Illuminate\Http\Response
     */
    public function destroy(Site $site)
    {
        if (Auth::user()->id != $site->user_id) {
            return redirect('/');
        }

        $site->delete();

        Alert::success('Site deleted.')->flash();

        return redirect('/');
    }
}
