@extends('admin.layouts.master')

@section('content-header')
    <h1>
        Edit Price Point
    </h1>
@stop

@push('breadcrumbs')
<li><a href="{{ route('admin.pricepoint.index') }}">PricePoints</a></li>
<li class="active"><a href="{{ route('admin.pricepoint.edit', $pricepoint) }}">Edit: {{ $pricepoint->name }}</a></li>
@endpush

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <div class="box">
                <div class="box-body ">
                    <form action="{{ route('admin.pricepoint.update', $pricepoint) }}" method="POST">
                        {{ method_field('PATCH') }}
                        {{ csrf_field() }}

                        {{-- From --}}
                        <div class="form-group{{ $errors->has('from') ? ' has-error' : '' }}">
                            <label for="from">From</label>
                            <input type="text" class="form-control" name="from" value="{{ old('from', $pricepoint->from) }}">

                            @if ($errors->has('from'))
                                <div class="help-block">
                                    <strong>{{ $errors->first('from') }}</strong>
                                </div>
                            @endif
                        </div>

                        {{-- To --}}
                        <div class="form-group{{ $errors->has('to') ? ' has-error' : '' }}">
                            <label for="to">To</label>
                            <input type="text" class="form-control" name="to" value="{{ old('to', $pricepoint->to) }}">

                            @if ($errors->has('to'))
                                <div class="help-block">
                                    <strong>{{ $errors->first('to') }}</strong>
                                </div>
                            @endif
                        </div>

                        {{-- Price --}}
                        <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                            <label for="price">Price</label>

                            <div class="input-group">
                                <div class="input-group-addon">$</div>
                                <input class="form-control" type="text" name="price" value="{{ old('price', $pricepoint->price) }}">
                            </div>

                            @if ($errors->has('price'))
                                <div class="help-block">
                                    <strong>{{ $errors->first('price') }}</strong>
                                </div>
                            @endif
                        </div>

                        <div class="form-group text-right">
                            <a href="{{ route('admin.pricepoint.confirm-delete', $pricepoint) }}" class="btn btn-danger">Delete</a>
                            <button class="btn btn-success">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
