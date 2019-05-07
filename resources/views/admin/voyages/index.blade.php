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
        <h3 class="" style="">Table des {{ count($voyages)." voyages"}}</h3>
        <span class="d-flex justify-content-around">
            <a href="#" class="btn btn-success mx-2" data-toggle="modal" data-target="#create_modal"><i class="fa fa-plus"></i>Ajouter</a>
            {!! Form::open(['action' => 'VoyagesController@store', 'method' => 'POST']) !!}
                <div class="input-group">
                    {{Form::search('search', '', ['class' => 'form-control', 'placeholder' => 'Chercher'])}}
                        <div class="input-group-append">
                            {{Form::submit('Recherche', ['class' => 'btn bg-side text-light'])}}
                        </div>
                </div>
            {!! Form::close() !!}
        </span>
    </div>
</div>
<div class="container bg-sombre py-1 py-md-2 my-1 my-md-2 h-100" style="position:relative;">
    <div class="row" style="height:80vh;overflow-y:scroll!important;">
        <div class="container">
            @if(count($voyages) > 0)
                <?php $i=1; ?>
                <div class="h-100" style="height:100%!important;">
                    <table class="table table-bordered table-hover">
                        <tr class="bg-normal sticky-top">
                            <th></th>
                            <th>Itineraire</th>
                            <th>Prix</th>
                            <th>Date de départ</th>
                            <th>Heure de départ</th>
                            <th>Voyageur</th>
                            <th class="text-center">Opérations</th>
                        </tr>
                        @foreach($voyages as $voyage)
                            <!-- Modals-->
                                {{-- View Modal --}}
                                <div class="modal fade" id="{{'view_modal_'.$voyage->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content bg-normal">
                                            <div class="modal-header bg-sombre justify-content-between align-items-center">
                                                <span class="container d-flex justify-content-between">
                                                    <span class="modal-title h4">Voyage #{{$voyage->id}}</span>
                                                    <a href="" class="btn btn-primary" data-toggle="modal" data-target="#add_voyageur_modal">
                                                        Ajouter des voyageurs
                                                    </a>
                                                </span>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="lead">
                                                    Itineraire :
                                                    {{App\Ville::find(App\Itineraire::find($voyage->itineraire_id)->ville_depart)->name ." -> ". App\Ville::find(App\Itineraire::find($voyage->itineraire_id)->ville_arrivee)->name}}
                                                </p>
                                                <div class="container">
                                                        <p>
                                                            Prix :
                                                            {{App\Itineraire::find($voyage->itineraire_id)->prix}}
                                                        </p>
                                                        <p>
                                                            Date Départ :
                                                            {{$voyage->date}}
                                                        </p>
                                                        <p>
                                                            Heure départ :
                                                            {{$voyage->depart}}
                                                        </p>
                                                </div>
                                                <div class="container">
                                                    <h2>
                                                        Liste des voyageurs
                                                    </h2>
                                                    <div class="container-fluid">
                                                        <ul class="nav flex-column">
                                                            @foreach (App\Voyage::where('itineraire_id', $voyage->itineraire_id)->get() as $voyage)
                                                                <li class="nav-item d-flex justify-content-between">
                                                                    <span>
                                                                        {{App\User::find($voyage->user_id)->first()->name}}
                                                                    </span>
                                                                    <span>
                                                                        {{App\User::find($voyage->user_id)->first()->email}}
                                                                    </span>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer bg-sombre">
                                                <div class="container d-flex justify-content-between">
                                                    <span>
                                                        <a href="#" class="btn btn-warning" data-toggle="modal" data-target="{{'#edit_modal_'.$voyage->id}}" data-dismiss="modal">Editer</a>
                                                        <a href="#" class="btn btn-danger" data-toggle="modal" data-target="{{'#delete_modal_'.$voyage->id}}" data-dismiss="modal">
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
                            {{-- Add User Modal --}}
                            <div class="modal fade" id="{{'add_user_modal_'.$voyage->id}}">
                                <div class="modal-dialog">
                                    <div class="modal-content bg-normal">
                                        <div class="modal-header bg-sombre">
                                            Ajouter un voyageur
                                        </div>
                                        <div class="modal-body">
                                            {{-- {!!Form::open(['action' => ['VoyagesController@addVoyageur', $voyage->id], 'method' => 'POST'])!!}
                                                <div class="form-group">
                                                    @foreach ($voyageurs as $voyageur)
                                                        @if ($voyageur->id !== $voyage->user_id)
                                                            <label for="{{'Voyageur'.$voyageur->id}}">
                                                                <input required type="checkbox" value="{{$voyageur->id}}" name="{{'Voyageur'.$voyageur->id}}">
                                                            </label>
                                                        @endif
                                                    @endforeach
                                                </div>
                                                {{Form::submit('Envoyer', ['class'=>'btn btn-sucess'])}}
                                            {!!Form::close()!!} --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Delete confirmation --}}
                                <div class="modal fade" id="{{'delete_modal_'.$voyage->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content bg-normal">
                                            <div class="modal-header bg-sombre">
                                                <div class="modal-title">
                                                    Suppression
                                                </div>
                                            </div>
                                            <div class="modal-body">
                                                Vous allez supprimer le voyage {{$voyage->name}}
                                            </div>
                                            <div cless="modal-footer bg-sombre">
                                                <div class="container d-flex justify-content-between">
                                                    <a href="#">
                                                        {!! Form::open(['action' => ['VoyagesController@destroy', $voyage->id], 'method'=>'POST', 'style' => 'display:inline']) !!}
                                                            {{Form::hidden('_method', 'DELETE')}}
                                                            {{Form::submit('Supprimer', ["class" => "btn btn-danger"])}}
                                                        {!! Form::close() !!}
                                                    </a>
                                                    <a href="{{url('/dashboard/voyages')}}" class="btn btn-success" data-dismiss="modal">Non</a>
                                                    <a href="#" class="btn bg-warning" data-toggle="modal" data-dismiss="modal" data-target="{{'#edit_modal_'.$voyage->id}}">
                                                        Modifier
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Data Row --}}
                        <tr>
                            <td><?= $i ?><?php $i++; ?></td>
                            <td>
                                <a href="/dashboard/voyages/{{$voyage->id}}" data-toggle="modal" data-target="{{'#view_modal_'.$voyage->id}}" class="link_">
                                    {{App\Ville::find(App\Itineraire::find($voyage->itineraire_id)->ville_depart)->name ." -> ". App\Ville::find(App\Itineraire::find($voyage->itineraire_id)->ville_arrivee)->name}}
                                </a>
                            </td>
                            <td>
                                {{App\Itineraire::find($voyage->itineraire_id)->prix}}
                            </td>
                            <td>
                                {{$voyage->date}}
                            </td>
                            <td>
                                {{$voyage->depart}}
                            </td>
                            <td>
                                {{App\User::find($voyage->user_id)->name}}
                            </td>
                            <td colspan="" class="text-right">
                                <!-- <div class="d-flex justify-content-around"> -->
                                        <a href="/dashboard/voyages/{{$voyage->id}}" class="btn btn-success" data-toggle="modal" data-target="{{'#view_modal_'.$voyage->id}}">
                                            <i class="fa fa-eye"></i>Voir
                                        </a>
                                    <span>
                                        <a href="/dashboard/voyages/{{$voyage->id}}/edit" class="btn btn-warning" data-toggle="modal" data-target="{{'#edit_modal_'.$voyage->id}}">
                                            <i class="fa fa-pencil"></i>Modifier
                                        </a>
                                        <a href="#" class="btn btn-danger" data-dismiss="modal" data-toggle="modal" data-target="{{'#delete_modal_'.$voyage->id}}">
                                            Supprimer
                                        </a>
                                    </span>
                                <!-- </div> -->
                            </td>
                        </tr>
                        {{-- Edit Modal --}}
                                <div class="modal fade" id="{{'edit_modal_'.$voyage->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content bg-normal">
                                            <div class="modal-header bg-sombre">
                                                <h4 class="modal-title">{{$voyage->name}}</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                {!! Form::open(['action' => ['VoyagesController@update', $voyage->id], 'method' => 'POST']) !!}
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-md">
                                                                {{Form::label('itineraire_id', 'Itineraire')}}
                                                                    <select class="form-control" name="itineraire_id" id="itineraire_id">
                                                                        <option value="{{$voyage->itineraire_id}}" selected>
                                                                            {{
                                                                                App\Ville::find(App\Itineraire::find($voyage->itineraire_id)->ville_depart)->name ." -> ". App\Ville::find(App\Itineraire::find($voyage->itineraire_id)->ville_arrivee)->name
                                                                            }}
                                                                        </option>
                                                                        @if (count($itineraires)>0)
                                                                            @foreach ($itineraires as $i)
                                                                                <option value="{{$i->id}}">
                                                                                    {{App\Ville::find($i->ville_depart)->name ." -> ". App\Ville::find($i->ville_arrivee)->name ." | ".$i->prix ."Francs"}}
                                                                                </option>
                                                                            @endforeach
                                                                        @else
                                                                            <option value="" disabled selected>--Aucun itineraire--</option>
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md">
                                                                    {{Form::label('depart', 'Choississez votre départ')}}
                                                                    <input class="form-control" type="time" name="depart" value="{{$voyage->depart}}">
                                                                </div>
                                                                <div class="col-md">
                                                                    {{Form::label('date', 'Date de départ')}}
                                                                    <input class="form-control" type="date" name="date" id="date" value="{{$voyage->date}}">
                                                                </div>
                                                            </div>
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
                        @endforeach
                    </table>
                </div>
            @else
                <div class="container d-flex justify-content-between bg-normal my-1 my-md-2">
                    Voyages Vide
                </div>
            @endif
            
        </div>
    </div>
</div>
<!-- Create /*and edit*/ modals -->
    <!-- Create -->
    <div class="modal fade" id="create_modal">
        <div class="modal-dialog">
            <div class="modal-content bg-normal">
                <div class="modal-header bg-sombre">
                    <h2 class="modal-title d-flex justify-content-between">
                        <span>Ajouter un nouveau voyage</span>
                        <button type="button" class="close" data-dismiss="modal">X</button>
                    </h2>
                </div>
                <div class="modal-body">
                    {!! Form::open(['action' => 'VoyagesController@store', 'method' => 'POST']) !!}
                        <div class="container">
                            <div class="row">
                                <div class="col-md">
                                    {{Form::label('itineraire_id', 'Itineraire')}}
                                    <select class="form-control" name="itineraire_id" id="itineraire_id">
                                        @if (count($itineraires)>0)
                                            <option value="" disabled selected>--Choisissez un itineraire--</option>
                                            @foreach ($itineraires as $itineraire)
                                                <option value="{{$itineraire->id}}">
                                                    {{App\Ville::find($itineraire->ville_depart)->name ." -> ". App\Ville::find($itineraire->ville_arrivee)->name ." | ".$itineraire->prix ."Francs"}}
                                                </option>
                                            @endforeach
                                        @else
                                            <option value="" disabled selected>--Aucun itineraire--</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                    {{Form::label('depart', 'Choississez votre départ')}}
                                    <input class="form-control" type="time" name="depart">
                                </div>
                                <div class="col-md">
                                    {{Form::label('date', 'Date de départ')}}
                                    <input class="form-control" type="date" name="date" id="date">
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer bg-sombre">
                    <div class="container d-flex justify-content-between">
                        {{Form::submit('Submit', ['class' => 'btn btn-success'])}}
                        <button type="cancel" class="btn bg-normal text-light" data-dismiss="modal">Annuler</button>
                    </div>
                </div>
                    {!! Form::close() !!}
            </div>
        </div>
    </div>{{-- / --}}
@endsection