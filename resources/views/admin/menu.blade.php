{{-- Menu for admin functions --}}
@extends ('layout')

@section ('content')
    <div class="text-left">
        <a href="/admin/snapshot">
            <button class="btn btn-default btn-tile">Snapshots</button>
        </a>
        <a href="/synchro">
            <button class="btn btn-default btn-tile">Synchroniser avec l'Intranet</button>
        </a>
        <a href="/reconstages">
            <button class="btn btn-default btn-tile">Renouveler les stages en cours</button>
        </a>
        <a href="/about">
            <button class="btn btn-default btn-tile">Editer les contrats</button>
        </a><br>
        <a href="/editGrid">
            <button class="btn btn-default btn-tile">Editer la grille d'évaluation</button>
        </a>
        <a href="/editlifecycle">
            <button class="btn btn-default btn-tile">Editer le cycle de vie</button>
        </a>
    </div>
@stop

@section('page_specific_css')
    <link rel="stylesheet" href="/css/mpmenu.css">
@stop