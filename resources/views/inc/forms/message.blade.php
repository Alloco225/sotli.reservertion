                {!!Form::open(['action' => 'QuestionsController@store', 'method' => 'POST'])!!}
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Nom', 'required'])}}
                            </div>
                            <div class="col-md-6">
                                {{Form::text('email', '', ['class' => 'form-control', 'placeholder' => 'Email', 'type' => 'email', 'required'])}}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                {{Form::text('telephone', '', ['class' => 'form-control', 'placeholder' => 'Numéro Téléphone', 'required'])}}
                            </div>
                            <div class="col-md-6">
                                {{Form::text('company', '', ['class' => 'form-control', 'placeholder' => 'Compagnie'])}}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::textarea('message', '', ['class' => 'form-control', 'placeholder' => 'Message', 'required'])}}
                    </div>
                    <div class="form-group">
                        {{Form::submit('Envoyer un message', ['class' => 'btn text-blanc bg-orange'])}}
                    </div>
                    {!!Form::close()!!}