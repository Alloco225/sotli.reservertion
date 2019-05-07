@extends('layouts.app')
@php
    $action = 'PagesController';    
@endphp
@section('content')
    <section id="cart-info">
        <div class="container">
            Vous avez $plans dans votre cart
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row">
                Reserver pour un itinéraire
            </div>
            <div class="row">
                @if (count($itineraires) > 0)
                    @foreach ($itineraires as $itineraire)
                        <p>
                            <a href="">
                                {{App\Ville::find($itineraire->ville_depart)->name ." -> ". App\Ville::find($itineraire->ville_arrivee)->name}}
                            </a>
                        </p>
                    @endforeach
                @else
                    
                @endif
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            Suggestions
        </div>
    </section>
@endsection
