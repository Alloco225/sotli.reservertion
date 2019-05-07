@extends('admin.layout')
@section('content_')
{{-- --}}
<style> 
.delete {
    font-style: italic !important;
    text-decoration: underline !important;
    text-decoration-color: red !important;
}
.separator {
    content: "" !important;
    width: 25% !important;
    margin: auto !important;
    border-top: 2px solid var(--bright) !important;
}
</style>
{{-- / --}}
@include('inc.alert')
<div class="container bg-sombre py-1 py-md-2">
    <div class="row d-flex justify-content-around px-1 sticky-top">
        <h3 class="" style="">Table des {{ count($itineraires)." Itineraires"}}</h3>
        <span class="d-flex justify-content-around">
            <a href="#" class="btn btn-success mx-2" data-toggle="modal" data-target="#create_modal"><i class="fa fa-plus"></i>Ajouter</a>
            {{-- {!! Form::open(['action' => 'ItinerairesController@store', 'method' => 'POST']) !!}
                <div class="input-group">
                    {{Form::search('search', '', ['class' => 'form-control', 'placeholder' => 'Chercher'])}}
                        <div class="input-group-append">
                            {{Form::submit('Recherche', ['class' => 'btn bg-side text-light'])}}
                        </div>
                </div>
            {!! Form::close() !!} --}}
        </span>
    </div>
</div>
<div class="container bg-sombre py-1 py-md-2 my-1 my-md-2 h-100" style="position:relative;">
    <div class="row" style="height:80vh;overflow-y:scroll!important;">
        <div class="container">
            @if(count($itineraires) > 0)
                <?php $i=1; ?>
                <div class="h-100" style="height:100%!important;">
                    <table class="table table-bordered table-hover">
                        <tr class="bg-normal sticky-top">
                            <th></th>
                            <th>Départ</th>
                            <th>Arrivée</th>
                            <th>Tarif</th>
                            <th colspan="3">Départs</th>
                            <th class="text-center">Opérations</th>
                        </tr>
                        @foreach($itineraires as $itineraire)
                            <!-- Modals-->
                                {{-- View Modal --}}
                                <div class="modal fade" id="{{'view_modal_'.$itineraire->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content bg-normal">
                                            <div class="modal-header bg-sombre">
                                                <h4 class="modal-title">
                                                    Itineraire {{App\Ville::find($itineraire->ville_depart)->name." -> ". App\Ville::find($itineraire->ville_arrivee)->name }}
                                                </h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="container">
                                                    <div class="container-fluid">
                                                        <div class="row justify-content-between my-1">
                                                            <span>Ville Départ : </span>
                                                            <span>{{App\Ville::find($itineraire->ville_depart)->name}}</span>
                                                        </div>
                                                        <div class="row justify-content-between my-1">
                                                            <span>Ville Arrivée : </span>
                                                            <span>
                                                                {{App\Ville::find($itineraire->ville_arrivee)->name}}
                                                            </span>
                                                        </div>
                                                        <div class="row justify-content-between my-1">
                                                            <span>Prix : </span>
                                                            <span>
                                                                {{$itineraire->prix ." Francs"}}
                                                            </span>
                                                        </div>
                                                        <div class="row justify-content-between my-1">
                                                            <span>{{ App\Depart::where('itineraire_id', $itineraire->id)->count() }} Départs :</span>
                                                            <span>
                                                                @if (App\Depart::where('itineraire_id', $itineraire->id)->count() == 0)
                                                                    <a href="" class="btn bg-sombre">ajouter</a>
                                                                @else
                                                                    @foreach (App\Depart::where('itineraire_id', $itineraire->id)->get() as $depart)
                                                                        <p>
                                                                            {{$depart->heure ?? "---"}}
                                                                        </p>
                                                                    @endforeach
                                                                @endif
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer bg-sombre">
                                                <div class="container d-flex justify-content-between">
                                                    <span>
                                                        <a href="#" class="btn btn-warning" data-toggle="modal" data-target="{{'#edit_modal_'.$itineraire->id}}" data-dismiss="modal">Editer</a>
                                                        <a href="#" class="btn btn-danger" data-toggle="modal" data-target="{{'#delete_modal_'.$itineraire->id}}" data-dismiss="modal">
                                                            Supprimer
                                                        </a>
                                                    </span>
                                                    <span>
                                                        <button type="button" class="btn bg-normal text-light" data-dismiss="modal">Fermer</button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            {{--  --}}
                            {{-- Edit Modal --}}
                                <div class="modal fade" id="{{'edit_modal_'.$itineraire->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content bg-normal">
                                            <div class="modal-header bg-sombre">
                                                <h4 class="modal-title container d-flex justify-content-between">
                                                    <span>
                                                        {{App\Ville::find($itineraire->ville_depart )->name." -> ". App\Ville::find($itineraire->ville_arrivee)->name}}
                                                    </span>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </h4>
                                            </div>
                                            <div class="modal-body">
                                                {!!Form::open(['action' => ['ItinerairesController@update', $itineraire->id], 'method' => 'POST'])!!}
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-md">
                                                            {{-- Ville départ --}}
                                                            {{Form::label('ville_depart', 'Départ')}}
                                                            <select  class="form-control" name="ville_depart" id="ville_depart">
                                                                @if (count($villes) > 0)
                                                                        <option value="{{$itineraire->ville_depart}}" disaled selected>
                                                                            {{App\Ville::find($itineraire->ville_depart)->name}}
                                                                        </option>
                                                                    @foreach ($villes as $ville)
                                                                        <option value="{{$ville->id}}" title="{{$ville->description}}">
                                                                            {{$ville->name}}
                                                                        </option>
                                                                    @endforeach
                                                                @else
                                                                        <option value="" disaled selected>
                                                                            <a href="/dashboard/villes#create_modal">--0 Ville dans la base--</a>
                                                                        </option>
                                                                @endif
                                                            </select>
                                                        </div>
                                                        {{-- Ville arrivée --}}
                                                        <div class="col-md">
                                                            {{Form::label('ville_arrivee', 'Arrivée')}}
                                                            <select  class="form-control" name="ville_arrivee" id="ville_arrivee">
                                                                @if (count($villes) > 0)
                                                                        <option value="{{$itineraire->ville_arrivee}}" disaled selected>
                                                                            {{App\Ville::find($itineraire->ville_arrivee)->name}}
                                                                        </option>
                                                                    @foreach ($villes as $ville)
                                                                        <option value="{{$ville->id}}" title="{{$ville->description}}">
                                                                            {{$ville->name}}
                                                                        </option>
                                                                    @endforeach
                                                                @else
                                                                        <option value="" disaled selected>
                                                                            <a href="/dashboard/villes#create_modal">--0 Ville dans la base--</a>
                                                                        </option>
                                                                @endif
                                                            </select>
                                                            {{-- Prix --}}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <label for="prix" class="col-md">
                                                            Tarif
                                                            <input class="form-control" type="number" name="prix" value="{{$itineraire->prix}}">
                                                        </label>
                                                    </div>
                                                    <div class="row">
                                                        {{-- 1er Départ --}}
                                                        <label for="depart_1" class="col-md">
                                                            1er Départ
                                                            <input class="form-control" type="time" name="depart_1" value="{{$itineraire->depart_1}}">
                                                        </label>
                                                        {{-- 2e Départ --}}
                                                        <label for="depart_2" class="col-md">
                                                            2e Départ
                                                            <input class="form-control" type="time" name="depart_2" value="{{$itineraire->depart_2}}">
                                                        </label>
                                                        {{-- 3e Départ --}}
                                                        <label for="depart_3" class="col-md">
                                                            3e Départ
                                                            <input class="form-control" type="time" name="depart_3" value="{{$itineraire->depart_3}}">
                                                        </label>
                                                        {{-- Dernier Départ --}}
                                                        <label for="depart_dernier" class="col-md">
                                                            Dernier Départ
                                                            <input class="form-control" type="time" name="depart_dernier" value="{{$itineraire->depart_dernier}}">
                                                        </label>
                                                    </div>
                                                </div>
                                                    {{Form::hidden('_method', 'PUT')}}
                                            </div>
                                            <div class="modal-footer bg-sombre">
                                                <div class="container d-flex justify-content-between">
                                                    {{Form::submit('Sauvegarder', ['class' => 'btn btn-success'])}}
                                                </div>
                                                <button type="button" class="btn bg-normal text-light" data-dismiss="modal">Close</button>
                                            </div>
                                                {!!Form::close()!!}
                                        </div>
                                    </div>
                                </div>{{--  --}}
                            {{-- Delete confirmation --}}
                                <div class="modal fade" id="{{'delete_modal_'.$itineraire->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content bg-normal">
                                            <div class="modal-header bg-sombre">
                                                <div class="modal-title">
                                                    Suppression
                                                </div>
                                            </div>
                                            <div class="modal-body">
                                                Vous allez <span class="delete">supprimer</span> l'itineraire {{App\Ville::find($itineraire->ville_depart )->name." -> ". App\Ville::find($itineraire->ville_arrivee)->name}}
                                            </div>
                                            <div class="modal-footer bg-sombre">
                                                <div class="container d-flex justify-content-between">
                                                    <a href="#">
                                                        {!! Form::open(['action' => ['ItinerairesController@destroy', $itineraire->id], 'method'=>'POST', 'style' => 'display:inline']) !!}
                                                            {{Form::hidden('_method', 'DELETE')}}
                                                            {{Form::submit('Supprimer', ["class" => "btn btn-danger"])}}
                                                        {!! Form::close() !!}
                                                    </a>
                                                    <a href="{{url('/dashboard/itineraires')}}" class="btn btn-success" data-dismiss="modal">Non</a>
                                                    <a href="#" class="btn bg-warning" data-toggle="modal" data-dismiss="modal" data-target="{{'#edit_modal_'.$itineraire->id}}">
                                                        Modifier
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <tr>
                            <td><?= $i ?><?php $i++; ?></td>
                            <td>
                                <a href="/dashboard/ville/{{$itineraire->ville_arrivee}}" data-toggle="modal" data-target="{{'#view_modal_'.$itineraire->id}}" class="link_">
                                    {{-- <script>
                                        $('.link_').on('dblclick', function(){
                                            var id = $(this).attr('data-target');
                                            $('#create_modal').modal('toggle';)
                                        });
                                    </script> --}}
                                    {{App\Ville::find($itineraire->ville_depart)->name}}
                                </a>
                            </td>
                            <td>
                                <a href="/dashboard/ville/{{$itineraire->ville_arrivee}}" data-toggle="modal" data-target="{{'#view_modal_'.$itineraire->id}}" class="link_">
                                    {{-- <script>
                                        $('.link_').on('dblclick', function(){
                                            var id = $(this).attr('data-target');
                                            $('#create_modal').modal('toggle';)
                                        });
                                    </script> --}}
                                    {{App\Ville::find($itineraire->ville_arrivee)->name}}
                                </a>
                            </td>
                            <td>
                                {{$itineraire->prix}}
                            </td>
                            {{-- Departs --}}
                            @php
                                $departs = App\Depart::where('itineraire_id', $itineraire->id)->get();
                            @endphp
                            @if (count($departs) >= 3)
                                @foreach ($departs->take(3) as $depart)
                                    <td style="overflow-x:s">{{$depart->heure ?? "Pas de départ"}}</td>
                                @endforeach
                            @else
                                <td colspan="3" class="text-center">--Aucun depart-- {{--<a href="" class="btn btn-success">Ajouter</a>--}}</td>
                            @endif

                            {{-- Operations --}}
                            <td colspan="" class="text-right">
                                <!-- <div class="d-flex justify-content-around"> -->
                                        <a href="/dashboard/itineraires/{{$itineraire->id}}" class="btn btn-success" data-toggle="modal" data-target="{{'#view_modal_'.$itineraire->id}}">
                                            <i class="fa fa-eye"></i>Voir
                                        </a>
                                    <span>
                                        <a href="/dashboard/itineraires/{{$itineraire->id}}/edit" class="btn btn-warning" data-toggle="modal" data-target="{{'#edit_modal_'.$itineraire->id}}">
                                            <i class="fa fa-pencil"></i>Modifier
                                        </a>
                                        <a href="#" class="btn btn-danger" data-dismiss="modal" data-toggle="modal" data-target="{{'#delete_modal_'.$itineraire->id}}">
                                            Supprimer
                                        </a>
                                    </span>
                                <!-- </div> -->
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            @else
                <div class="container d-flex justify-content-between bg-normal my-1 my-md-2">
                    <p>
                        Wow -such empty-
                    </p>
                    <p>Il n'y a aucun itineraire dans la base <a href="#" data-toggle="modal" data-target="#create_modal">Ajouter un itineraire</a></p>
                </div>
            @endif
            
        </div>
    </div>
</div>
{{-- Create Modal --}}
    <div class="modal fade" id="create_modal">
        <div class="modal-dialog">
            <div class="modal-content bg-normal">
                <div class="modal-header bg-sombre">
                    <h4 class="modal-title container d-flex justify-content-between">
                        <span>
                            Ajouter un nouvel itineraire
                        </span>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </h4>
                </div>
                <div class="modal-body">
                    {!!Form::open(['action' => 'ItinerairesController@store', 'method' => 'POST'])!!}
                        <div class="container">
                            <div class="row">
                                {{-- Ville départ --}}
                                <div class="form-group col-md">
                                    {{Form::label('ville_depart', 'Départ')}}
                                    <select  class="form-control" name="ville_depart" id="ville_depart">
                                        @if (count($villes) > 0)
                                                <option value="" disaled selected>--Ville de départ--</option>
                                            @foreach ($villes as $ville)
                                                <option value="{{$ville->id}}" title="{{$ville->description}}">
                                                    {{$ville->name}}
                                                </option>
                                            @endforeach
                                        @else
                                                <option value="" disaled selected>
                                                    <a href="/dashboard/villes#create_modal">--0 Ville dans la base--</a>
                                                </option>
                                        @endif
                                    </select>
                                </div>
                                {{-- Ville arrivée --}}
                                <div class="col-md">
                                    {{Form::label('ville_arrivee', 'Arrivée')}}
                                    <select  class="form-control" name="ville_arrivee" id="ville_arrivee">
                                        @if (count($villes) > 0)
                                                <option value="" disabled selected>--Ville d'arrivée--</option>
                                            @foreach ($villes as $ville)
                                                <option value="{{$ville->id}}" title="{{$ville->description}}">
                                                    {{$ville->name}}
                                                </option>
                                            @endforeach
                                        @else
                                                <option value="" disaled selected>
                                                    <a href="/dashboard/villes#create_modal">--0 Ville dans la base--</a>
                                                </option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                {{-- Prix --}}
                                <label for="prix" class="col-md">
                                    Tarif
                                    <input  class="form-control" type="number" name="prix">
                                </label>
                            </div>
                            <div class="row">
                                {{-- 1er Départ --}}
                                <label for="depart_1" class="col-md">
                                    1er Départ
                                    <input  class="form-control" type="time" name="depart_1">
                                </label>
                                {{-- 2e Départ --}}
                                <label for="depart_2" class="col-md">
                                    2e Départ
                                    <input class="form-control" type="time" name="depart_2">
                                </label>
                                {{-- 3e Départ --}}
                                <label for="depart_3" class="col-md">
                                    3e Départ
                                    <input class="form-control" type="time" name="depart_3">
                                </label>
                                {{-- Dernier Départ --}}
                                <label for="depart_dernier" class="col-md">
                                    Dernier Départ
                                    <input class="form-control" type="time" name="depart_dernier">
                                </label>
                            </div>
                        </div>
                </div>
                <div class="modal-footer bg-sombre">
                    <div class="container d-flex justify-content-between">
                        {{Form::submit('Sauvegarder', ['class' => 'btn btn-success'])}}
                    </div>
                    <button type="button" class="btn bg-normal text-light" data-dismiss="modal">Close</button>
                </div>
                    {!!Form::close()!!}
            </div>
        </div>
    </div>{{--  --}}
@endsection