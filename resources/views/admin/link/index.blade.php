@extends('admin.layouts.master')

@section('content-header')
    <h1>
        Links
    </h1>
@stop

@push('breadcrumbs')
<li class="active"><a href="{{ route('admin.link.index') }}">Links</a></li>
@endpush

@section('content')
    <div class="box">
        <div class="box-header clearfix">
            <h3 class="box-title">All Links</h3>

            <div class="box-tools">
                <a href="{{ route('admin.link.create') }}" class="btn btn-primary btn-sm">New Link</a>
            </div>
        </div>

        <div class="box-body">
            @if (count($links))
                <table class="table table-striped table-hover">
                    <tr>
                        <th>Name</th>
                        <th>Url</th>
                        <th width="100"></th>
                    </tr>

                    @foreach ($links as $link)
                        <tr>
                            <td><a href="{{ route('admin.link.edit', $link) }}">{{ $link->name }}</a></td>
                            <td>{{ $link->url }}</td>
                            <td>
                                <div class="row-actions">
                                    <a href="{{ route('admin.link.edit', $link) }}">Edit</a>
                                    |
                                    <a href="{{ route('admin.link.confirm-delete', $link) }}" class="text-danger">Delete</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </table>
            @else
                <p>No links found.</p>
            @endif
        </div>
    </div>
@stop