<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Site;
use App\User;
use Illuminate\Http\Request;
use Prologue\Alerts\Facades\Alert;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sites = Site::orderBy('name')->get();

        return view('admin.site.index', compact('sites'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Site $site
     * @return \Illuminate\Http\Response
     */
    public function edit(Site $site)
    {
        $users = User::orderBy('name')->get();

        return view('admin.site.edit', compact('site', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Site $site
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Site $site)
    {
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
            'user_id' => 'required|exists:users,id',
            'url' => "required|url|active_url|unique:sites,url,{$site->id}"
        ]);

        $site->url = $input['url'];

        if (! $site->urlReachable()) {
            return redirect()->back()->withErrors(['url' => 'URL is not reachable'])->withInput($input);
        }

        $site->user_id = $request->input('user_id');

        $site->save();

        Alert::success('Site updated.')->flash();

        return redirect()->route('admin.site.edit', $site);
    }

    /**
     * Confirm before deleting resource
     *
     * @param Site $site
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function confirmDelete(Site $site)
    {
        return view('admin.site.confirm-delete', compact('site'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Site $site
     * @return \Illuminate\Http\Response
     */
    public function destroy(Site $site)
    {
        $site->delete();

        Alert::success('Site deleted.')->flash();

        return redirect()->route('admin.site.index');
    }

    /**
     * Generate a new api token
     *
     * @param Site $site
     * @return \Illuminate\Http\RedirectResponse
     */
    public function newToken(Site $site)
    {
        $site->generateApiToken();
        $site->save();

        Alert::success('Generated new API token.')->flash();

        return redirect()->route('admin.site.edit', $site);
    }
}
