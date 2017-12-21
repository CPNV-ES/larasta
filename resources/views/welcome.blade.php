@extends ('layout')

@section ('content')
    <h1>
        Larasta
    </h1>
    <p>L'application de gestion des stages des élèves de la filière informatique du CPNV - réécrite et améliorée sous Laravel</p>
    <div class="version">Version: {{ config('app.version') }}, décembre 2017</div>
    <div class="col-md-4 col-md-offset-4 text-left">
        <h3>Contributeurs</h3>
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
        <p>Quentin ROSSIER</p>
        <p>Xavier SCHWAB</p>
    </div>
@stop