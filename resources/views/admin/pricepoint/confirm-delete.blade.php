@extends('admin.layouts.master')

@section('content-header')
    <h1>
        Delete Price Point: {{ $pricepoint->name }}
    </h1>
@stop

@push('breadcrumbs')
<li><a href="{{ route('admin.pricepoint.index') }}">Price Points</a></li>
<li class="active"><a href="{{ route('admin.pricepoint.edit', $pricepoint) }}">Edit: {{ $pricepoint->name }}</a></li>
<li class="active"><a href="{{ route('admin.pricepoint.confirm-delete', $pricepoint) }}">Delete</a></li>
@endpush

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <div class="box">
                <div class="box-body">
                    <form action="{{ route('admin.pricepoint.destroy', $pricepoint) }}" method="POST">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}

                        <p>Are you sure you want to delete this price point?</p>

                        <div class="form-group">
                            <button class="btn btn-danger">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop