@extends('admin.layouts.master')

@section('content-header')
    <h1>
        Edit Site: {{ $site->name }}
    </h1>
@stop

@push('breadcrumbs')
<li><a href="{{ route('admin.site.index') }}">Sites</a></li>
<li class="active"><a href="{{ route('admin.site.edit', $site) }}">Edit: {{ $site->name }}</a></li>
@endpush

@section('content')
    <div class="box">
        <div class="box-body">
            <form action="{{ route('admin.site.update', $site) }}" method="POST">
                {{ method_field('PATCH') }}
                {{ csrf_field() }}

                {{-- User --}}
                <div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }}">
                    <label for="user_id" class="control-label">User</label>
                    <select name="user_id" class="form-control">
                        <option value=""></option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}"{{ old('user_id', $user->id) == $site->user_id ? ' selected' : '' }}>{{ $user->name }} ({{ $user->email }})</option>
                        @endforeach
                    </select>

                    @if ($errors->has('user_id'))
                        <div class="help-block">{{ $errors->first('user_id') }}</div>
                    @endif
                </div>

                {{-- URL --}}
                <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                    <label for="url" class="control-label">URL</label>
                    <input type="text" class="form-control" name="url" value="{{ old('url', $site->url) }}">

                    @if ($errors->has('url'))
                        <div class="help-block">{{ $errors->first('url') }}</div>
                    @endif
                </div>

                <div class="form-group text-right">
                    <a href="{{ route('admin.site.confirm-delete', $site) }}" class="btn btn-danger">Delete</a>
                    <button class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">API Token</h3>
        </div>
        <div class="box-body">
            {{-- API Token --}}
            <div class="form-group">
                <label for="api_token" class="control-label">API Token</label>
                <input type="text" class="form-control" name="api_token" value="{{ $site->api_token }}" readonly>
            </div>

            <form action="{{ route('admin.site.new-token', $site) }}" method="POST">
                {!! csrf_field() !!}
                <button class="btn btn-primary" onclick="return confirm('Are you sure you want to generate a new API token?');">Generate New API Token</button>
            </form>
        </div>
    </div>
@stop
