                            {!!Form::open(['action' => $action.'@search', 'method' => 'GET', 'class' => 'bg-danger'])!!}
                                <div class="input-group">
                                    {{Form::text('number','', ['class' => 'form-control', 'placeholder' => "Chercher le # d'un plan", 'required'])}}
                                    <div class="input-group-prepend">
                                        {{Form::submit('Chercher', ['class' => 'btn btn-primary'])}}
                                    </div>
                                </div>
                            {!!Form::close()!!}