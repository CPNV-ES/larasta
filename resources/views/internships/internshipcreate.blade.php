@extends ('layout')
@section ('page_specific_css')
    <link rel="stylesheet" href="/css/interships.css">
@stop
@section ('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="container-fluid">
    <div class="body simple-box" id="view">
        <div class="title row">
            <h3>Création d'un nouveau stage pour l'entreprise {{$company->companyName}}</h3>
        </div>
    </div>
    <div class="row content-box" id="view">
    <form method="post" action="/internships/{{$company->id}}/create">
    {{ csrf_field() }}
        <div class="col-lg-8 col-lg-offset-2">
        <div>
            <label >Date de début</label>
            <input type="date" id="beginDate" name="beginDate" value="{{$datebegin}}">
        </div>
        <div>
                <label >Date de fin</label>
                <input type="date" id="endDate" name="endDate" value="{{$dateend}}">
        </div>
        <div>
                <label>Responsable</label>
                <select name="responsible">
                        @foreach ($persons as $person)
                            @if ($person->id == $interships->responsible_id)
                                <option value="{{$person->id}}" selected>{{$person->firstname}} {{$person->lastname}}</option>
                            @else          
                                <option value="{{$person->id}}">{{$person->firstname}} {{$person->lastname}}</option>
                            @endif
                            
                        @endforeach
                </select>
        </div>
        <div>
                <label>Responsable Admin</label>
                <select name="admin">
                        @foreach ($persons as $person)
                            @if ($person->id == $interships->admin_id)
                                <option value="{{$person->id}}" selected>{{$person->firstname}} {{$person->lastname}}</option>
                            @else          
                                <option value="{{$person->id}}">{{$person->firstname}} {{$person->lastname}}</option>
                            @endif
                        @endforeach
                </select>
        </div>
        <br>
            <button type="submit" class="btn-success small text-white">Créer</button>
    </form>
</div>
<div>
@stop
@section ('page_specific_js')
    <script src="/js/remark.js"></script>
    <script src="/js/visit.js"></script>
@stop
