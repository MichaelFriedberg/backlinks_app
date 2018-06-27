@extends('admin.layouts.master')

@section('content-header')
    <h1>
        Delete Link: {{ $link->name }}
    </h1>
@stop

@push('breadcrumbs')
<li><a href="{{ route('admin.link.index') }}">Links</a></li>
<li class="active"><a href="{{ route('admin.link.edit', $link) }}">Edit: {{ $link->name }}</a></li>
<li class="active"><a href="{{ route('admin.link.confirm-delete', $link) }}">Delete</a></li>
@endpush

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <div class="box">
                <div class="box-body">
                    <form action="{{ route('admin.link.destroy', $link) }}" method="POST">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}

                        <p>Are you sure you want to delete this link?</p>

                        <div class="form-group">
                            <button class="btn btn-danger">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop