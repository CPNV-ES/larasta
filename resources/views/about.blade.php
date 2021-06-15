{{-- Author: Xavier Carrel --}}
@extends ('layout')

@section ('content')
    <h1>
        Larasta
    </h1>
    <p>L'application de gestion des stages des élèves de la filière informatique du CPNV - réécrite et "améliorée" sous Laravel</p>
    <div class="version">Version: {{ config('app.version') }}</div>
    <div class="col-md-4 col-md-offset-4 text-left">
        <h2>Contributeurs</h2>
        <h3>2021</h3>
        <p>Dimitri Imfeld</p>
        <p>Dylan Oliveira-Ramos</p>
        <p>Yvann Butticaz</p>
        <h3>2020</h3>
        <p>Diogo VIEIRA-FERREIRA</p>
        <p onclick="alert('salut :)')">Nicolas MAITRE</p>
        <p>Killian ViQuErAt</p>
        <h3>2019 et avant</h3>
        <p>Steven AVELINO</p>
        <p>Davide CARBONI</p>
        <p>Xavier CARREL</p>
        <p>Benjamin DELACOMBAZ</p>
        <p>Antonio GIORDANO</p>
        <p>Nicolas HENRY</p>
        <p>Kevin JORDIL</p>
        <p>Jean-Yves LE</p>
        <p>Quentin NEVES</p>
        <p>Bastien NICOUD</p>
        <p>Julien RICHOZ</p>
    </div>
@stop