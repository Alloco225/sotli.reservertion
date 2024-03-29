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
        <h3 class="" style="">Table des {{ count($voyageurs)." voyageurs"}}</h3>
        <span class="d-flex justify-content-around">
            <a href="#" class="btn btn-success mx-2" data-toggle="modal" data-target="#create_modal"><i class="fa fa-plus"></i>Ajouter</a>
            {!! Form::open(['action' => 'VoyageursController@store', 'method' => 'POST']) !!}
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
            @if(count($voyageurs) > 0)
                <?php $i=1; ?>
                <div class="h-100" style="height:100%!important;">
                    <table class="table table-bordered table-hover">
                        <tr class="bg-normal sticky-top">
                            <th></th>
                            <th>Nom du Voyageur</th>
                            <th class="text-center">Opérations</th>
                        </tr>
                        @foreach($voyageurs as $voyageur)
                            <!-- Modals-->
                                {{-- View Modal --}}
                                <div class="modal fade" id="{{'view_modal_'.$voyageur->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content bg-normal">
                                            <div class="modal-header bg-sombre">
                                                <h4 class="modal-title">{{$voyageur->name}}</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="lead">
                                                    {{$voyageur->email}}
                                                </p>
                                                <div class="container">
                                                    <div class="row">
                                                        <a href="{{url('/dashboard/plans/')}}" title="Voir tous les plans du voyageur {{$voyageur->name}}">
                                                            <h5>Voyages effectués par ce voyageur</h5>
                                                        </a>
                                                    </div>
                                                    <div class="container-fluid">
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer bg-sombre">
                                                <div class="container d-flex justify-content-between">
                                                    <span>
                                                        <a href="#" class="btn btn-warning" data-toggle="modal" data-target="{{'#edit_modal_'.$voyageur->id}}" data-dismiss="modal">Editer</a>
                                                        <a href="#" class="btn btn-danger" data-toggle="modal" data-target="{{'#delete_modal_'.$voyageur->id}}" data-dismiss="modal">
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
                                <div class="modal fade" id="{{'edit_modal_'.$voyageur->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content bg-normal">
                                            <div class="modal-header bg-sombre">
                                                <h4 class="modal-title">{{$voyageur->name}}</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                {!!Form::open(['action' => ['VoyageursController@update', $voyageur->id], 'method' => 'POST'])!!}
                                                    <div class="form-group">
                                                        {{Form::label('name', 'Nom du voyageur')}}
                                                        {{Form::text('name', $voyageur->name, ['class' => 'form-control'])}}
                                                    </div>
                                                    <div class="form-group">
                                                        {{Form::label('email', 'Email du voyageur')}}
                                                        {{Form::textarea('email', $voyageur->email, ['class' => 'form-control'])}}
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
                                <div class="modal fade" id="{{'delete_modal_'.$voyageur->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content bg-normal">
                                            <div class="modal-header bg-sombre">
                                                <div class="modal-title">
                                                    Suppression
                                                </div>
                                            </div>
                                            <div class="modal-body">
                                                Vous allez supprimer la voyageur {{$voyageur->name}}
                                            </div>
                                            <div class="modal-footer bg-sombre">
                                                <div class="container d-flex justify-content-between">
                                                    <a href="#">
                                                        {!! Form::open(['action' => ['VoyageursController@destroy', $voyageur->id], 'method'=>'POST', 'style' => 'display:inline']) !!}
                                                            {{Form::hidden('_method', 'DELETE')}}
                                                            {{Form::submit('Supprimer', ["class" => "btn btn-danger"])}}
                                                        {!! Form::close() !!}
                                                    </a>
                                                    <a href="{{url('/dashboard/voyageurs')}}" class="btn btn-success" data-dismiss="modal">Non</a>
                                                    <a href="#" class="btn bg-warning" data-toggle="modal" data-dismiss="modal" data-target="{{'#edit_modal_'.$voyageur->id}}">
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
                                <a href="/dashboard/voyageurs/{{$voyageur->id}}" data-toggle="modal" data-target="{{'#view_modal_'.$voyageur->id}}" class="link_">
                                    {{-- <script>
                                        $('.link_').on('dblclick', function(){
                                            var id = $(this).attr('data-target');
                                            $('#create_modal').modal('toggle';)
                                        });
                                    </script> --}}
                                    {{$voyageur->name}}
                                </a>
                            </td>
                            <td colspan="" class="text-right">
                                <!-- <div class="d-flex justify-content-around"> -->
                                        <a href="/dashboard/voyageurs/{{$voyageur->id}}" class="btn btn-success" data-toggle="modal" data-target="{{'#view_modal_'.$voyageur->id}}">
                                            <i class="fa fa-eye"></i>Voir
                                        </a>
                                    <span>
                                        <a href="/dashboard/voyageurs/{{$voyageur->id}}/edit" class="btn btn-warning" data-toggle="modal" data-target="{{'#edit_modal_'.$voyageur->id}}">
                                            <i class="fa fa-pencil"></i>Modifier
                                        </a>
                                        <a href="#" class="btn btn-danger" data-dismiss="modal" data-toggle="modal" data-target="{{'#delete_modal_'.$voyageur->id}}">
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
                    Voyageurs Vide
                </div>
            @endif
            
        </div>
    </div>
</div>
<!-- Create /*and edit*/ modals -->
    <!-- Create -->
    {{-- / --}}
@endsection