
@extends ('layout')
@section ('page_specific_css')
    <link rel="stylesheet" href="/css/visits.css">
@stop
@section ('content')
    <div class="container">
        <h1>Visits list</h1>
        <div class="row">
            <div class="col-6">
                    <a href="/visits/#" class="underline-none">
                        <button class="btn-success small text-white" disabled>Créer une visite</button>
                    </a>
            </div>
            <div class="col-6">
            <form method="post" action="/visits">
                {{ csrf_field() }}
                <select name="teacher" onchange="this.form.submit()">      
                    @foreach ($persons as $person)
                        @if ($person->id == $id)
                            <option selected value="{{$person->id}}">{{$person->firstname}} {{$person->lastname}}</option>
                        @else 
                            <option value="{{$person->id}}">{{$person->firstname}} {{$person->lastname}}</option>
                        @endif        
                    @endforeach
            </select>
            </form>
            </div>
        </div>
        
        
        <br>
        <br>
        <h3>Visits to come</h3>
        <table class="larastable table table-striped">
            <thead class="thead-inverse">
                <tr class="clickable-row">
                    <th class="col-md-2">Nom</th>
                    <th class="col-md-2">Prénom</th>
                    <th class="col-md-3">Entreprise</th>
                    <th class="col-md-1">Date de début</th>
                    <th class="col-md-1">Date de fin</th>
                    <th class="col-md-1">Etat de la visite</th>
                    <th class="col-md-1">Email</th>
                </tr>
            </thead>
            <tbody>
                
                {{-- @foreach($internships as $iship) --}}
                @foreach($visitsToCome as $iship)
                    <tr class="clickable-row text-left" data-href="/visits/{{$iship->id}}/manage">
                        <td class="col-md-2">{{ $iship->internship->student->firstname }}</td>
                        <td class="col-md-2">{{ $iship->internship->student->lastname }}</td>
                        <td class="col-md-3">{!! $iship->internship->company->companyName !!}</td>
                        <td class="col-md-1 text-center">{{ (new DateTime($iship->internship->beginDate))->format('d M Y') }}</td>
                        <td class="col-md-1 text-center">{{ (new DateTime($iship->internship->endDate))->format('d M Y') }}</td>
                        <td class="col-md-1">{{ $iship->visitsstate->stateName }}</td>
                        <td class="col-md-1 text-center">
                            @if($iship->mailstate == 1)
                                <span class="ok glyphicon glyphicon-ok tick"></span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <button id="showpastbtn"> Voir les anciennes visites</button>
        <div id="past" class="d-none">
        <br>
        <br>
        <h3>Past Visits</h3>
        <table class="larastable table table-striped">
            <thead class="thead-inverse">
                <tr class="clickable-row">
                    <th class="col-md-2">Nom</th>
                    <th class="col-md-2">Prénom</th>
                    <th class="col-md-3">Entreprise</th>
                    <th class="col-md-1">Date de début</th>
                    <th class="col-md-1">Date de fin</th>
                    <th class="col-md-1">Etat de la visite</th>
                    <th class="col-md-1">Email</th>
                </tr>
            </thead>
            <tbody>
                
                {{-- @foreach($internships as $iship) --}}
                @foreach($visitPast as $iship)
                    <tr class="clickable-row text-left" data-href="/visits/{{$iship->id}}/manage">
                        <td class="col-md-2">{{ $iship->internship->student->firstname }}</td>
                        <td class="col-md-2">{{ $iship->internship->student->lastname }}</td>
                        <td class="col-md-3">{!! $iship->internship->company->companyName !!}</td>
                        <td class="col-md-1 text-center">{{ (new DateTime($iship->internship->beginDate))->format('d M Y') }}</td>
                        <td class="col-md-1 text-center">{{ (new DateTime($iship->internship->endDate))->format('d M Y') }}</td>
                        <td class="col-md-1">{{ $iship->visitsstate->stateName }}</td>
                        <td class="col-md-1 text-center">
                            @if($iship->mailstate == 1)
                                <span class="ok glyphicon glyphicon-ok tick"></span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
@stop
@section ('page_specific_js')
    <script src="js/visits.js"></script>
    <script src="js/visit.js"></script>
@stop
