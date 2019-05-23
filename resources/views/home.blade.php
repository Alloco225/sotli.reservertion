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
            </div>
            
            Reserver pour un itinéraire
            <div class="row">
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            Suggestions
        </div>
    </section>
@endsection
