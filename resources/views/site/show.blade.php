@extends('layouts.app')

@section('content')
    <div>
        <div class="content-box-header">
            <div class="panel-title">{{ $site->name }}</div>
        </div>
        <div class="content-box-large box-with-header">
            {{-- URL --}}
            <div class="form-group">
                <label for="url" class="control-label">URL</label>
                <input type="text" class="form-control" name="url" value="{{ $site->url }}" readonly>
            </div>

            {{-- API Token --}}
            <div class="form-group">
                <label for="api_token" class="control-label">API Token</label>
                <input type="text" class="form-control" name="api_token" value="{{ $site->api_token }}" readonly>
            </div>
        </div>
    </div>


    <div>
        <div class="content-box-header">
            <div class="panel-title">Delete {{ $site->name }}</div>
        </div>
        <div class="content-box-large box-with-header">
            <form action="{{ route('site.destroy', $site) }}" method="POST">
                {!! csrf_field() !!}
                {!! method_field('DELETE') !!}

                <button class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this site?');">Delete Site</button>
            </form>
        </div>
    </div>
@endsection
