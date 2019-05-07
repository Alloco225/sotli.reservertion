@extends('layouts.app')
@section('content')
    <h1>Liste des itineraires</h1>
    <div class="jumbotron">
        @if (count($itineraires) >0)
            @foreach ($itineraires as $i)
                <p>
                    {{App\Ville::find($i->ville_depart)->name ." -> ". App\Ville::find($i->ville_arrivee)->name}}

                    {{$i->prix}}

                    {{$i->depart_1}}
                    {{$i->depart_2}}
                    {{$i->depart_3}}
                    {{$i->depart_dernier}}
                </p>
            @endforeach
        @endif
    </div>
@endsection