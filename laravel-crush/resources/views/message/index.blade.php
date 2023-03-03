@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>Envoyer un message secret</h1>

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form action="{{ route('messages.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="email">Adresse e-mail du destinataire :</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                </div>

                <div class="form-group">
                    <label for="message">Message :</label>
                    <textarea name="message" id="message" class="form-control" rows="5" required>{{ old('message') }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Envoyer le message</button>
            </form>
        </div>
    </div>
@endsection
