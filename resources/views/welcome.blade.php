@extends('layouts.app')
@php
    $action = 'PagesController';    
@endphp
@section('content')
            <section id="showcase">
                <div id="carousel-slider" class="carousel slide"
                    data-ride="carousel" data-pause="hover">
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-slider" data-slide-to="0"
                            class="active"></li>
                        <li data-target="#carousel-slider" data-slide-to="1"></li>
                        <li data-target="#carousel-slider" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="img/slide1.jpg"
                                alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="img/slide2.jpg"
                                alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="img/slide3.jpg"
                                alt="Third slide">
                        </div>
                    </div>
                <!-- <a class="carousel-control-prev" href="#carousel-slider" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carousel-slider" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a> -->
                </div><!-- /Carousel -->
                <!-- Show case text -->
                <div id="showcase-overlay" class="container d-flex
                    justify-content-between">
                    <div class="col-md-5 py-1 bg-light_orange">
                        <!-- Header -->
                        <div class="row my-2">
                            <div class="col-md-6">
                                <h4>Acheter un billet</h4>
                            </div>
                            <!-- Aller-Retour | Aller-Simple -->
                            <div class="col-md-6">
                                <div class="btn-group btn-group-sm">
                                    <!-- <button type="button" class="btn bg-orange">Aller-Retour</button> -->
                                    <button type="button" class="btn bg-orange">Aller
                                        Simple</button>
                                </div>
                            </div>
                        </div>

                        <!-- Formulaire -->
                        <form action="/search" role="form" class="form">

                            <!-- Depart | Arrivée -->
                            <div class="row form-group">
                                <!-- Depart -->
                                <div class="col-sm-6 input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-flag"></i>
                                        </span>
                                    </div>
                                    <select name="depart" id="" class="form-control">
                                        @if ($villes->count()>0)
                                            <option value="1" disabled selected>--Depart--</option>
                                            @foreach ($villes as $ville)
                                                <option value="{{$ville->id}}">{{$ville->name}}</option>
                                            @endforeach
                                        @else
                                            <option value="" disabled selected>--Aucune ville à selectionner--</option>
                                        @endif
                                    </select>
                                </div>
                                <!-- destination -->
                                <div class="col-sm-6 input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-flag"></i>
                                        </span>
                                    </div>
                                    <select name="destination" id="" class="form-control">
                                        @if ($villes->count()>0)
                                            <option value="1" disabled selected>--Destination--</option>
                                            @foreach ($villes as $ville)
                                                <option value="{{$ville->id}}">{{$ville->name}}</option>
                                            @endforeach
                                        @else
                                            <option value="" disabled selected>--Aucune ville à selectionner--</option>
                                        @endif
                                    </select>
                                </div>
                            </div> <!--  -->
                            <!-- Date Range -->
                            <div class="row form-group">
                                <div class="col-sm-6">
                                    Date:
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                        </div>
                                        <input type="date" name="date" class="form-control"
                                            placeholder="" required>
                                    </div>
                                </div>
                            </div>
                            <input type="submit" class="btn bg-orange w-100"
                                value="Reserver un car">
                        </form>
                    </div> <!-- col-md-5 -->
                    <div class="col-md-5 bg-light py-2 bg-light_orange">
                        <h5>Un peu de texte en fonction de l'image du slide</h5>
                        <p>Ca peut parler de la rapidité du service de
                            libraison, du suivi en temps réel de la position du
                            car,
                            de la sécurité du transport, du professionalisme des
                            employés, des services à bord, bref
                        </p>
                        <a href="" class="btn bg-orange w-100 text-light">Découvrir</a>
                    </div> <!-- col-md-5 -->
                </div> <!-- Row -->
            </section><!-- /#Showcase -->
            <!-- Promotions -->
            <section id="promotions">
                {{-- <div class="container col-md-10 mx-auto">
                    <h3 class="display-4 text-uppercase text-center orange">Promotions</h3>
                    <div class="row">
                        <div class="col-9">
                            <h4 class="display-4">Nom de la promotion</h4>
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-4 font-weight-bold
                                        display-2">
                                        -90%
                                    </div>
                                    <div class="col">
                                        <h2 class="">Sur <span>$destination</span></h2>
                                        <div class="row">
                                            <p>Lorem ipsum dolor sit amet
                                                consectetur adipisicing elit.
                                                Vero alias molestias
                                                a repellendus qui quaerat totam
                                                tempore nam, quia ab dicta
                                                maiores in dolore
                                                veritatis?
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <img src="img/bouake.jpg" alt="">
                        </div>
                    </div>
                </div><!--  --> --}}
            </section><!-- /#Promotions -->
            <!-- Promo Destinations -->
            <section id="destinations-promo" class="container-fluid pt-2 my-2
                bg-corail text-dark">
                <div class="row d-flex justify-content-around">
                    @foreach ($destinations as $destination)
                        <div class="col-3 bg-light">
                            <h5 class="display-4 orange">{{$destination->name}}</h5>
                            <div class="row">
                                <div class="display-2">-50%</div>
                            </div>
                            <div class="row">
                                <p class="text-center">
                                    {{$destination->description}}
                                </p>
                            </div>
                            <div class="row justify-content-center my-1">
                                <a href="" class="btn bg-orange text-light w-80">J'en
                                    profite</a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row justify-content-center my-2 bg-light">
                    <a href="/destinations" class="orange h4">Voir toutes les promotions</a>
                </div>
            </section>
            <!-- Meilleures Destinations -->
            <section id="destinations" class="container-fluid pt-2 my-2
                bg-light">
                <div class="row d-flex justify-content-around">
                    @foreach ($promotions as $promotion)
                        <div class="col-md-3">
                            <div class="card">
                                <img src="img/{{$promotion->ville_depart->image }}" alt=""
                                    class="card-img-top">
                                <div class="card-footer">
                                    <p>A partir de {{$promotion->tarif}} Francs</p>
                                    <p>{{$promotion->ville_destination->name}}, Cote d'Ivoire</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row justify-content-center my-2 bg-light">
                    <a href="" class="orange h4" id="hover-link-destinations">Voir
                        toutes les destinations</a>
                </div>
                <div class="destinations" id="hidden-destinations"
                    style="display:none;">
                    <div class="row d-flex justify-content-around">
                        <div class="col-md-3">
                            <div class="card">
                                <img src="img/city-day.jpeg" alt=""
                                    class="card-img-top">
                                <div class="card-footer">
                                    <p>A partir de 6000F</p>
                                    <p>Daloa, Cote d'Ivoire</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <img src="img/city-dark-lights-8047.jpg" alt=""
                                    class="card-img-top">
                                <div class="card-footer">
                                    <p>A partir de 6000F</p>
                                    <p>Daloa, Cote d'Ivoire</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <img src="img/city-buildings.jpeg" alt=""
                                    class="card-img-top">
                                <div class="card-footer">
                                    <p>A partir de 6000F</p>
                                    <p>Daloa, Cote d'Ivoire</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            @include('inc.forms.newsletter')
            <section id="message" class="container">
                <div class="container my-md-3">
                    <div class="col-md">
                        @include('inc.forms.message')
                    </div>
                </div>
            </section>
@endsection
