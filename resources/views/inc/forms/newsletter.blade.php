            <!-- Newsletter -->
            <section id="newsletter" class="container-fluid bg-corail px-5
                justify-content-center">
                <div class="row container-fluid align-items-center">
                    <div class="col-8">
                        <h4>Souscrivez à notre boite aux lettre</h4>
                        <p>Et restez au parfum de nos toutes dernières
                            promotions !</p>
                    </div>
                    <div class="col">
                        {!!Form::open(['action' => 'NewsletterController@store', 'method' => 'POST', 'class' => ''])!!}
                            <div class="input-group">
                                <input class="form-control" type="email" name="email" placeholder="Email..." required>
                                <div class="input-group-prepend">
                                    {{Form::submit('Souscrire', ['class' => 'btn text-blanc bg-orange'])}}
                                </div>
                            </div>
                        {!!Form::close()!!}
                    </div>
                </div>
            </section>
                            