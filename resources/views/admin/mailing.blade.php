{{-- Menu for admin functions --}}
@extends ('layout')

@section ('content')
    <div class="enterprises">
        <div class="enterprise">
            <span class="delete">x</span> Enterprise mars 2019
            <div class="responsibles">
                <div class="responsible">Responsable n°1 <span class="delete">x</span></div>
                <div class="responsible">Responsable n°2 <span class="delete">x</span></div>
                <div class="showDeletedResponsibles d-none">()</div>
            </div>
        </div>
        <div class="enterprise">
            <span class="delete">x</span> Enterprise Septembre 2019
            <div class="responsibles">
                <div class="responsible">Responsable n°1 <span class="delete">x</span></div>
                <div class="responsible">Responsable n°2 <span class="delete">x</span></div>
                <div class="showDeletedResponsibles d-none"></div>
            </div>
        </div>
        <div class="showDeletedEnterprises d-none"></div>
    </div>
@stop

@section('page_specific_css')
    <link rel="stylesheet" href="/css/mpmenu.css">
    <link rel="stylesheet" href="/css/mailing.css">
@stop
@section('page_specific_js')
    <script src="/js/mailing.js"></script>
@stop
