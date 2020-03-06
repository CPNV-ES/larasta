
@extends ('layout')
@section ('page_specific_css')
    <link rel="stylesheet" href="/css/visits.css">
@stop
@section ('content')
    <div class="container">
        <div class="row">
        <h1 class="float-left">Liste de visite</h1>
        </div>
        <div class="row">
            <div class="col-12">
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
        <h3>Visits à venir</h3>
        <table class="larastable table table-striped">
            <thead class="thead-inverse">
                <tr class="d-flex clickable-row">
                    <th class="col-3">Nom</th>
                    <th class="col-2">Prénom</th>
                    <th class="col-2">Entreprise</th>
                    <th class="col-1">Date de début</th>
                    <th class="col-1">Date de fin</th>
                    <th class="col-1">Etat de la visite</th>
                    <th class="col-1">Email</th>
                    <th class="col-1">Note</th>
                </tr>
            </thead>
            <tbody>
                @foreach($visitsToCome as $visit)
                    <tr class="d-flex clickable-row text-left" data-href="/visits/{{$visit->id}}/manage">
                        <td class="col-3">{{ $visit->internship->student->firstname }}</td>
                        <td class="col-2">{{ $visit->internship->student->lastname }}</td>
                        <td class="col-2">{!! $visit->internship->company->companyName !!}</td>
                        <td class="col-1 text-center">{{ (new DateTime($visit->internship->beginDate))->format('d M Y') }}</td>
                        <td class="col-1 text-center">{{ (new DateTime($visit->internship->endDate))->format('d M Y') }}</td>
                        <td class="col-1">{{ $visit->visitsstate->stateName }}</td>
                        <td class="col-1 text-center">
                            @if($visit->mailstate == 1)
                                <span class="ok glyphicon glyphicon-ok tick"></span>
                            @endif
                        </td>
                        <td class="col-1">
                            @if($visit->getMedia()->isNotEmpty())
                                <a href="{{$visit->getMedia()->first()->getUrl()}}">{{$visit->grade}}</a>
                            @else 
                                {{$visit->grade}}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if (count($visitsPast) != 0)
            <button id="showpastbtn"> Voir les anciennes visites</button>
        @else
            
        @endif
        <div id="past" class="d-none">
        <br>
        <br>
        <h3>Anciennes Visits</h3>
        <table class="larastable table table-striped">
                <thead class="thead-inverse">
                    <tr class="d-flex clickable-row">
                        <th class="col-3">Nom</th>
                        <th class="col-2">Prénom</th>
                        <th class="col-2">Entreprise</th>
                        <th class="col-1">Date de début</th>
                        <th class="col-1">Date de fin</th>
                        <th class="col-1">Etat de la visite</th>
                        <th class="col-1">Email</th>
                        <th class="col-1">Note</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($visitsPast as $visit)
                        <tr class="d-flex clickable-row text-left" data-href="/visits/{{$visit->id}}/manage">
                            <td class="col-3">{{ $visit->internship->student->firstname }}</td>
                            <td class="col-2">{{ $visit->internship->student->lastname }}</td>
                            <td class="col-2">{!! $visit->internship->company->companyName !!}</td>
                            <td class="col-1 text-center">{{ (new DateTime($visit->internship->beginDate))->format('d M Y') }}</td>
                            <td class="col-1 text-center">{{ (new DateTime($visit->internship->endDate))->format('d M Y') }}</td>
                            <td class="col-1">{{ $visit->visitsstate->stateName }}</td>
                            <td class="col-1 text-center">
                                @if($visit->mailstate == 1)
                                    <span class="ok glyphicon glyphicon-ok tick"></span>
                                @endif
                            </td>
                            <td class="col-1">
                                @if($visit->hasMedias())
                                    <a href="{{$visit->getMediaUrl()}}">{{$visit->grade}}</a>
                                @else 
                                    {{$visit->grade}}
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
