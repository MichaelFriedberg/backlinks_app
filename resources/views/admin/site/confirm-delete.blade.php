@extends('admin.layouts.master')

@section('content-header')
    <h1>
        Delete Sites: {{ $site->name }}
    </h1>
@stop

@push('breadcrumbs')
<li><a href="{{ route('admin.site.index') }}">Sites</a></li>
<li class="active"><a href="{{ route('admin.site.edit', $site) }}">Edit: {{ $site->name }}</a></li>
<li class="active"><a href="{{ route('admin.site.confirm-delete', $site) }}">Delete</a></li>
@endpush

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <div class="box">
                <div class="box-body">
                    <form action="{{ route('admin.site.destroy', $site) }}" method="POST">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}

                        <p>Are you sure you want to delete this site?</p>

                        <div class="form-group">
                            <button class="btn btn-danger">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop