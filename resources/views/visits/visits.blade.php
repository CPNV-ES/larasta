@extends ('layout')
@push ('page_specific_css')
    <link rel="stylesheet" href="/css/visits.css">
@endpush
@section ('content')
    <h1>Liste des visites</h1>
    <form method="post" action="/visits">
        {{ csrf_field() }}
        <select name="teacher" onchange="this.form.submit()">
            @foreach ($persons as $person)
                @if ($person->id == $id)
                    <option selected value="{{$person->id}}">{{$person->fullName}}</option>
                @else
                    <option value="{{$person->id}}">{{$person->fullName}}</option>
                @endif
            @endforeach
        </select>
    </form>
    <h5 class="titlebar mt-2">Visites à venir</h5>
    <table class="larastable w-100">
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Entreprise</th>
            <th>Date</th>
            <th>Heure</th>
            <th>Etat de la visite</th>
            <th>Email</th>
            <th>Note</th>
        </tr>
        @foreach($visitsToCome as $visit)
            <tr class="fake-link" data-href="/visits/{{$visit->id}}/manage">
                <td>{{ $visit->internship->student->firstname }}</td>
                <td>{{ $visit->internship->student->lastname }}</td>
                <td>{!! $visit->internship->company->companyName !!}</td>
                <td>{{ (new DateTime($visit->moment))->format('d M Y') }}</td>
                <td>{{ (new DateTime($visit->moment))->format('H:i:s') }}</td>
                <td>{{ $visit->visitsstate->stateName }}</td>
                <td>
                    @if($visit->mailstate == 1)
                        <span class="ok glyphicon glyphicon-ok tick"></span>
                    @endif
                </td>
                <td>
                    @if($visit->grade)
                        {{$visit->grade}}
                    @endif
                </td>
            </tr>
        @endforeach
    </table>

    @if (count($visitsPast) != 0)
        <button id="showpastbtn" class="my-4"> Voir les anciennes visites</button>
    @else

    @endif
    <div id="past" class="d-none">
        <h5 class="titlebar mt-2">Anciennes Visites</h5>
        <table class="larastable w-100">
            <tr class="fake-link">
                <th>Nom</th>
                <th>Prénom</th>
                <th>Entreprise</th>
                <th>Date</th>
                <th>Heure</th>
                <th>Etat de la visite</th>
                <th>Email</th>
                <th>Note</th>
            </tr>
            @foreach($visitsPast as $visit)
                <tr class="fake-link" data-href="/visits/{{$visit->id}}/manage">
                    <td>{{ $visit->internship->student->firstname }}</td>
                    <td>{{ $visit->internship->student->lastname }}</td>
                    <td>{!! $visit->internship->company->companyName !!}</td>
                    <td>{{ (new DateTime($visit->moment))->format('d M Y') }}</td>
                    <td>{{ (new DateTime($visit->moment))->format('H:i:s') }}</td>
                    <td>{{ $visit->visitsstate->stateName }}</td>
                    <td>
                        @if($visit->mailstate == 1)
                            <span class="ok glyphicon glyphicon-ok tick"></span>
                        @endif
                    </td>
                    <td>
                        {{$visit->grade}}
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@stop
@push ('page_specific_js')
    <script src="js/visits.js"></script>
    <script src="js/visit.js"></script>
@endpush
