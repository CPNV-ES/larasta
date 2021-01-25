{{-- Menu for admin functions --}}
@extends ('layout')

@section ('content')
    <div class="text-left">
        <a href="/admin/snapshot">
            <button class="btn btn-default btn-tile">Snapshots</button>
        </a>
        <a href="{{route("synchro.index")}}">
            <button class="btn btn-default btn-tile">Synchroniser avec l'Intranet</button>
        </a>
        <a href="/reconstages">
            <button class="btn btn-default btn-tile">Renouveler les stages en cours</button>
        </a>
        <a href="/about">
            <button class="btn btn-default btn-tile">Editer les contrats</button>
        </a>
        <a href="/editlifecycle">
            <button class="btn btn-default btn-tile">Editer le cycle de vie</button>
        </a>
        <a href="/mailing">
            <button class="btn btn-default btn-tile">Mailing</button>
        </a>
    </div>
@stop

@push('page_specific_css')
    <link rel="stylesheet" href="/css/mpmenu.css">
@endpush
