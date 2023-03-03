@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>Message envoyé</h1>

            <p>Votre message a été envoyé avec succès à l'adresse e-mail suivante :</p>
            <p><strong>{{ $email }}</strong></p>

            <p>Le destinataire pourra lire votre message en cliquant sur le lien suivant :</p>
            <p><a href="{{ $link }}">{{ $link }}</a></p>
        </div>
    </div>
@endsection
