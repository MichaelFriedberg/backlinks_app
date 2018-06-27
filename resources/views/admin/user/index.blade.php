@extends('admin.layouts.master')

@section('content-header')
    <h1>
        Users
    </h1>
@stop

@push('breadcrumbs')
<li class="active"><a href="{{ route('admin.user.index') }}">Users</a></li>
@endpush

@section('content')
    <div class="box">
        <div class="box-header clearfix">
            <h3 class="box-title">All Users</h3>
        </div>

        <div class="box-body">
            @if (count($users))
                <table class="table table-striped table-hover">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th width="100"></th>
                    </tr>

                    @foreach ($users as $user)
                        <tr>
                            <td><a href="{{ route('admin.user.edit', $user) }}">{{ $user->name }}</a></td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <div class="row-actions">
                                    <a href="{{ route('admin.user.edit', $user) }}">Edit</a>
                                    |
                                    <a href="{{ route('admin.user.confirm-delete', $user) }}" class="text-danger">Delete</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </table>
            @else
                <p>No users found.</p>
            @endif
        </div>
    </div>
@stop