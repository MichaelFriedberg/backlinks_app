@extends('admin.layouts.master')

@section('content-header')
    <h1>
        Price Points
    </h1>
@stop

@push('breadcrumbs')
<li class="active"><a href="{{ route('admin.pricepoint.index') }}">PricePoints</a></li>
@endpush

@section('content')
    <div class="box">
        <div class="box-header clearfix">
            <h3 class="box-title">All Price Points</h3>

            <div class="box-tools">
                <a href="{{ route('admin.pricepoint.create') }}" class="btn btn-primary btn-sm">New Price Point</a>
            </div>
        </div>

        <div class="box-body">
            @if (count($pricepoints))
                <table class="table table-striped table-hover">
                    <tr>
                        <th width="100">From</th>
                        <th width="100">To</th>
                        <th width="100">Price</th>
                        <th></th>
                    </tr>

                    @foreach ($pricepoints as $pricepoint)
                        <tr>
                            <td><a href="{{ route('admin.pricepoint.edit', $pricepoint) }}">{{ $pricepoint->from }}</a></td>
                            <td><a href="{{ route('admin.pricepoint.edit', $pricepoint) }}">{{ $pricepoint->to }}</a></td>
                            <td><a href="{{ route('admin.pricepoint.edit', $pricepoint) }}">{{ $pricepoint->price }}</a></td>
                            <td>
                                <div class="row-actions">
                                    <a href="{{ route('admin.pricepoint.edit', $pricepoint) }}">Edit</a>
                                    |
                                    <a href="{{ route('admin.pricepoint.confirm-delete', $pricepoint) }}" class="text-danger">Delete</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </table>
            @else
                <p>No price points found.</p>
            @endif
        </div>
    </div>
@stop