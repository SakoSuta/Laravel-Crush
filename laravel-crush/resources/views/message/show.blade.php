@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>Message secret</h1>

            <p>{{ $message }}</p>

            <p>Ce message sera supprimé une fois que vous aurez fermé cette page.</p>
        </div>
    </div>
@endsection
