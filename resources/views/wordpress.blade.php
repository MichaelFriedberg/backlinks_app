@extends('layouts.app')

@section('content')
    <div class="content-box-header">
        <div class="panel-title">WordPress Integration</div>
    </div>
    <div class="content-box-large box-with-header">
        <h4>Download Plugin</h4>
        <p>Download, install and activate the plugin.</p>
        <p>
            <a class="btn btn-primary" href="/bloggerbucks.zip" target="_blank">Download Plugin</a>
        </p>
        <p>&nbsp;</p>

        <h4>Set your API key</h4>
        <p>In your WordPress dashboard, go to "BloggerBucks" under Settings and set your API token. You will see your site's API token once you've set up a site here.</p>
        <p>&nbsp;</p>

        <h4>Add a widget</h4>
        <p>Attach a "BloggerBucks Widget" wherever you would like the links to show. You can set a title for the widget or just leave it blank.</p>
        <p>&nbsp;</p>

        <h4>Cache</h4>
        <p>Links are cached for 60 minutes. You can clear the cache manually on the "BloggerBucks" settings page in your WordPress dashboard.</p>
    </div>
@endsection