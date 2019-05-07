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
        <h3 class="" style="">Table des {{ count($roles)." roles"}}</h3>
        <span class="d-flex justify-content-around">
            <a href="#" class="btn btn-success mx-2" data-toggle="modal" data-target="#create_modal"><i class="fa fa-plus"></i>Ajouter</a>
            {!! Form::open(['action' => 'RolesController@store', 'method' => 'POST']) !!}
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
            @if(count($roles) > 0)
                <?php $i=1; ?>
                <div class="h-100" style="height:100%!important;">
                    <table class="table table-bordered table-hover">
                        <tr class="bg-normal sticky-top">
                            <th></th>
                            <th>Role</th>
                            <th class="text-center">Opérations</th>
                        </tr>
                        @foreach($roles as $role)
                            <!-- Modals-->
                                {{-- View Modal --}}
                                <div class="modal fade" id="{{'view_modal_'.$role->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content bg-normal">
                                            <div class="modal-header bg-sombre">
                                                <h4 class="modal-title">{{$role->role}}</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="container">
                                                    <div class="row">
                                                        <a href="{{url('/dashboard/users/')}}" title="Voir tous les {{$role->role}}s">
                                                            <h5>{{$role->role}}s</h5>
                                                        </a>
                                                    </div>
                                                    <div class="container-fluid" style="overflow-y:scroll;height:300px;">
                                                        @php
                                                            $persons = App\User::where('role_id', $role->id)->orderBy('name')->get();
                                                        @endphp
                                                        @if (count($persons)>0)
                                                            @foreach ($persons as $person)
                                                                <ul class="nav flex-column">
                                                                    <li class="nav-item">
                                                                        <a href="/dashboard/users/{{$person->id}}" class="nav-link">
                                                                            {{$person->role}}
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            @endforeach
                                                        @else
                                                            {{"Aucun ".$role->role." dans la base"}}
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer bg-sombre">
                                                <div class="container d-flex justify-content-between">
                                                    <span>
                                                        <a href="#" class="btn btn-warning" data-toggle="modal" data-target="{{'#edit_modal_'.$role->id}}" data-dismiss="modal">Editer</a>
                                                        <a href="#" class="btn btn-danger" data-toggle="modal" data-target="{{'#delete_modal_'.$role->id}}" data-dismiss="modal">
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
                                <div class="modal fade" id="{{'edit_modal_'.$role->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content bg-normal">
                                            <div class="modal-header bg-sombre">
                                                <h4 class="modal-title">{{$role->role}}</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                {!!Form::open(['action' => ['RolesController@update', $role->id], 'method' => 'POST'])!!}
                                                    <div class="form-group">
                                                        {{Form::label('role', 'Nom du role')}}
                                                        {{Form::text('role', $role->role, ['class' => 'form-control', 'required'])}}
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
                                <div class="modal fade" id="{{'delete_modal_'.$role->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content bg-normal">
                                            <div class="modal-header bg-sombre">
                                                <div class="modal-title">
                                                    Suppression
                                                </div>
                                            </div>
                                            <div class="modal-body">
                                                Vous allez <span class="delete">supprimer</span> le role {{$role->role}}
                                            </div>
                                            <div class="modal-footer bg-sombre">
                                                <div class="container d-flex justify-content-between">
                                                    <a href="#">
                                                        {!! Form::open(['action' => ['RolesController@destroy', $role->id], 'method'=>'POST', 'style' => 'display:inline']) !!}
                                                            {{Form::hidden('_method', 'DELETE')}}
                                                            {{Form::submit('Supprimer', ["class" => "btn btn-danger"])}}
                                                        {!! Form::close() !!}
                                                    </a>
                                                    <a href="{{url('/dashboard/roles')}}" class="btn btn-success" data-dismiss="modal">Non</a>
                                                    <a href="#" class="btn bg-warning" data-toggle="modal" data-dismiss="modal" data-target="{{'#edit_modal_'.$role->id}}">
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
                                <a href="/dashboard/roles/{{$role->id}}" data-toggle="modal" data-target="{{'#view_modal_'.$role->id}}" class="link_">
                                    {{-- <script>
                                        $('.link_').on('dblclick', function(){
                                            var id = $(this).attr('data-target');
                                            $('#create_modal').modal('toggle';)
                                        });
                                    </script> --}}
                                    {{$role->role}}
                                </a>
                            </td>
                            <td colspan="" class="text-right">
                                <!-- <div class="d-flex justify-content-around"> -->
                                        <a href="/dashboard/roles/{{$role->id}}" class="btn btn-success" data-toggle="modal" data-target="{{'#view_modal_'.$role->id}}">
                                            <i class="fa fa-eye"></i>Voir
                                        </a>
                                    <span>
                                        <a href="/dashboard/roles/{{$role->id}}/edit" class="btn btn-warning" data-toggle="modal" data-target="{{'#edit_modal_'.$role->id}}">
                                            <i class="fa fa-pencil"></i>Modifier
                                        </a>
                                        <a href="#" class="btn btn-danger" data-dismiss="modal" data-toggle="modal" data-target="{{'#delete_modal_'.$role->id}}">
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
                    <p>Il n'y a aucun role dans la base <a href="#" data-toggle="modal" data-target="#create_modal">Ajouter un role</a></p>
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
                        <span>Ajouter un nouveau role</span>
                        <button type="button" class="close" data-dismiss="modal">X</button>
                    </h2>
                </div>
                <div class="modal-body">
                    {!! Form::open(['action' => 'RolesController@store', 'method' => 'POST']) !!}
                        <div class="form-group">
                            {{Form::label('role', 'Nom du role')}}
                            {{Form::text('role', '', ['class' => 'form-control', 'placeholder' => 'Nom du role', 'required'])}}
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