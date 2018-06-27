@extends('admin.layouts.master')

@section('content-header')
    <h1>
        New Link
    </h1>
@stop

@push('breadcrumbs')
<li><a href="{{ route('admin.link.index') }}">Links</a></li>
<li class="active"><a href="{{ route('admin.link.create') }}">New Link</a></li>
@endpush

@section('content')
<div class="row">
    <div class="col-sm-6">
        <div class="box">
            <div class="box-body ">
                <form action="{{ route('admin.link.store') }}" method="POST">
                    {{ csrf_field() }}

                    {{-- Name --}}
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}">

                        @if ($errors->has('name'))
                            <div class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </div>
                        @endif
                    </div>

                    {{-- Url--}}
                    <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                        <label for="name">Url</label>
                        <input type="text" class="form-control" name="url" value="{{ old('url') }}">

                        @if ($errors->has('url'))
                            <div class="help-block">
                                <strong>{{ $errors->first('url') }}</strong>
                            </div>
                        @endif
                    </div>

                    <div class="form-group text-right">
                        <button class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop