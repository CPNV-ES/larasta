@extends ('layout')
@section ('page_specific_css')
    <link rel="stylesheet" href="/css/visits.css">
@stop
@section ('content')
<div class="container-fluid">
    <div class="body simple-box" id="view">
        <div class="title row">
            <h3>Création d'un nouveau stage pour l'entreprise {{$company->companyName}}</h3>
        </div>
<div>
@stop
@section ('page_specific_js')
    <script src="/js/remark.js"></script>
    <script src="/js/visit.js"></script>
@stop
