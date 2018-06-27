@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="content-box-header">
                <div class="panel-title">Add a New Site</div>

            </div>
            <div class="content-box-large box-with-header">
                <form action="{{ route('site.store') }}" method="POST">
                    {!! csrf_field() !!}

                    <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                        <label for="url" class="control-label">URL</label>
                        <input type="text" class="form-control" name="url" value="{{ old('url') }}" placeholder="http://yoursite.com">

                        @if ($errors->has('url'))
                            <div class="help-block">{{ $errors->first('url') }}</div>
                        @endif
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
