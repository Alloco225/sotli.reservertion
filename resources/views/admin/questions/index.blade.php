@extends('admin.layout')
@section('content_')
@include('inc.alert')
<div class="container bg-sombre py-1 py-md-2">
    <div class="row d-flex justify-content-around px-1 sticky-top">
        <h3 class="" style="">Table des {{ count($questions)." questions"}}</h3>
        {{-- <span class="d-flex justify-content-around">
            {!! Form::open(['action' => 'QuestionsController@store', 'method' => 'POST']) !!}
                <div class="input-group">
                    {{Form::search('search', '', ['class' => 'form-control', 'placeholder' => 'Chercher'])}}
                        <div class="input-group-append">
                            {{Form::submit('Recherche', ['class' => 'btn bg-side text-light'])}}
                        </div>
                </div>
            {!! Form::close() !!}
        </span> --}}
    </div>
</div>
<div class="container bg-sombre py-1 py-md-2 my-1 my-md-2 h-100" style="position:relative;">
    <div class="row" style="height:80vh;overflow-y:scroll!important;">
        <div class="container">
            @if(count($questions) > 0)
                <?php $i=1; ?>
                <div class="h-100" style="height:100%!important;">
                    <table class="table table-bordered table-hover">
                        <tr class="bg-normal sticky-top">
                            <th></th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th>Compagnie</th>
                            <th>Question</th>
                            <th class="text-center">Opérations</th>
                        </tr>
                        @foreach($questions as $question)
                            <!-- Modals-->
                                {{-- View Modal --}}
                                <div class="modal fade" id="{{'view_modal_'.$question->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content bg-normal">
                                            <div class="modal-header bg-sombre">
                                                <h4 class="modal-title">Question #{{$question->id}}</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="font-weight-bold">
                                                    {{$question->name}}
                                                </p>
                                                <a class="" href="">
                                                    {{$question->email}}
                                                </a>
                                                <p>
                                                    {{$question->phone}}
                                                </p>
                                                <p>
                                                    {{$question->company ?? "Pas de compagnie"}}
                                                </p>
                                                <p class="lead">
                                                    {{$question->question}}
                                                </p>
                                            </div>
                                            <div class="modal-footer bg-sombre">
                                                <div class="container d-flex justify-content-between">
                                                    <span>
                                                        <a href="#" class="btn btn-warning" data-toggle="modal" data-target="{{'#edit_modal_'.$question->id}}" data-dismiss="modal">Editer</a>
                                                        <a href="#" class="btn btn-danger" data-toggle="modal" data-target="{{'#delete_modal_'.$question->id}}" data-dismiss="modal">
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
                                <!-- You can't edit ppl's questions you dummy !-->
                            {{-- Delete confirmation --}}
                                <div class="modal fade" id="{{'delete_modal_'.$question->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content bg-normal">
                                            <div class="modal-header bg-sombre">
                                                <div class="modal-title">
                                                    Suppression
                                                </div>
                                            </div>
                                            <div class="modal-body">
                                                Vous allez supprimer la question #{{$question->id}}
                                            </div>
                                            <div class="modal-footer bg-sombre">
                                                <div class="container d-flex justify-content-between">
                                                    <a href="#">
                                                        {!! Form::open(['action' => ['QuestionsController@destroy', $question->id], 'method'=>'POST', 'style' => 'display:inline']) !!}
                                                            {{Form::hidden('_method', 'DELETE')}}
                                                            {{Form::submit('Supprimer', ["class" => "btn btn-danger"])}}
                                                        {!! Form::close() !!}
                                                    </a>
                                                    <a href="{{url('/dashboard/questions')}}" class="btn btn-success" data-dismiss="modal">Non</a>
                                                    <a href="#" class="btn bg-warning" data-toggle="modal" data-dismiss="modal" data-target="{{'#edit_modal_'.$question->id}}">
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
                                <a href="/dashboard/questions/{{$question->id}}" data-toggle="modal" data-target="{{'#view_modal_'.$question->id}}" class="link_">
                                    {{-- <script>
                                        $('.link_').on('dblclick', function(){
                                            var id = $(this).attr('data-target');
                                            $('#create_modal').modal('toggle';)
                                        });
                                    </script> --}}
                                    {{$question->name}}
                                </a>
                            </td>
                            <td>
                                <a href="mailto:{{$question->mail}}" target="_blank">
                                        {{$question->email}}
                                </a>
                            </td>
                            <td>
                                {{$question->telephone}}
                            </td>
                            <td>
                                {{$question->compagny ?? "Pas de compagnie"}}
                            </td>
                            <td>
                                {{$question->message}}
                            </td>
                            <td colspan="" class="text-right">
                                <!-- <div class="d-flex justify-content-around"> -->
                                        <a href="/dashboard/questions/{{$question->id}}" class="btn btn-success" data-toggle="modal" data-target="{{'#view_modal_'.$question->id}}">
                                            <i class="fa fa-eye"></i>Voir
                                        </a>
                                    <span>
                                        <a href="/dashboard/questions/{{$question->id}}/edit" class="btn btn-warning" data-toggle="modal" data-target="{{'#edit_modal_'.$question->id}}">
                                            <i class="fa fa-pencil"></i>Modifier
                                        </a>
                                        <a href="#" class="btn btn-danger" data-dismiss="modal" data-toggle="modal" data-target="{{'#delete_modal_'.$question->id}}">
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
                    Questions Vide
                </div>
            @endif
            
        </div>
    </div>
</div>
<!-- Create /*and edit*/ modals -->
    <!-- Create -->
    {{-- / --}}
@endsection