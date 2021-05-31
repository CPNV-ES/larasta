
@extends ('layout')
@push ('page_specific_css')
    <link rel="stylesheet" href="/css/visits.css">
@endpush
@section ('content')
        <form method="post" action="/visits">
        <div class="row justify-content-md-center">
            <div class="col-3">

                {{ csrf_field() }}
                <h3 for="teacher">Résponsable</h3>
                <select name="teacher" class="form-control form-control-sm" onchange="this.form.submit()">
                    @foreach ($persons as $person)
                            <option {{ $person->id == $id ? 'selected' : '' }} value="{{$person->id}}">{{$person->fullName}}</option>
                    @endforeach
            </select>

            </div>
        </div>
        <br>
        <div class="row justify-content-md-center">
            @foreach($states as $state)
                <span class="onefilter">
                    <input
                            type="radio"
                            name="state"
                            id="state-{{$state->slug}}"
                            value="{{ $state->id }}"
                            onchange="this.form.submit()"
                            {{ $selectedStateId == $state->id ? 'checked' : '' }}
                    />
                    <label for="state-{{$state->slug}}">{{ ucfirst($state->stateName) }}</label>
                </span>
            @endforeach
        </div>
        </form>
        <br>
        <br>
        <h3>Visites à Venir</h3>
        <table class="larastable table table-striped">
            <thead class="thead-inverse">
                <tr class="d-flex fake-link">
                    <th class="col-3">Nom</th>
                    <th class="col-2">Prénom</th>
                    <th class="col-2">Entreprise</th>
                    <th class="col-1">Date</th>
                    <th class="col-1">Heure</th>
                    <th class="col-1">Etat de la visite</th>
                    <th class="col-1">Email</th>
                    <th class="col-1">Note</th>
                </tr>
            </thead>
            <tbody>
                @foreach($visitsToCome as $visit)
                    <tr class="d-flex fake-link text-left" data-href="/visits/{{$visit->id}}/manage">
                        <td class="col-3">{{ $visit->internship->student->firstname }}</td>
                        <td class="col-2">{{ $visit->internship->student->lastname }}</td>
                        <td class="col-2">{!! $visit->internship->company->companyName !!}</td>
                        <td class="col-1 text-center">{{ (new DateTime($visit->moment))->format('d M Y') }}</td>
                        <td class="col-1 text-center">{{ (new DateTime($visit->moment))->format('H:i:s') }}</td>
                        <td class="col-1">{{ $visit->visitsstate->stateName }}</td>
                        <td class="col-1 text-center">
                            @if($visit->mailstate == 1)
                                <span class="ok glyphicon glyphicon-ok tick"></span>
                            @endif
                        </td>
                        <td class="col-1">
                            {{$visit->grade}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div id="past">
        <br>
        <br>
        <h3>Visites Passées</h3>
        <table class="larastable table table-striped">
                <thead class="thead-inverse">
                    <tr class="d-flex fake-link">
                        <th class="col-3">Nom</th>
                        <th class="col-2">Prénom</th>
                        <th class="col-2">Entreprise</th>
                        <th class="col-1">Date</th>
                        <th class="col-1">Heure</th>
                        <th class="col-1">Etat de la visite</th>
                        <th class="col-1">Email</th>
                        <th class="col-1">Note</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($visitsPast as $visit)
                        <tr class="d-flex fake-link text-left" data-href="/visits/{{$visit->id}}/manage">
                            <td class="col-3">{{ $visit->internship->student->firstname }}</td>
                            <td class="col-2">{{ $visit->internship->student->lastname }}</td>
                            <td class="col-2">{!! $visit->internship->company->companyName !!}</td>
                            <td class="col-1 text-center">{{ (new DateTime($visit->moment))->format('d M Y') }}</td>
                            <td class="col-1 text-center">{{ (new DateTime($visit->moment))->format('H:i:s') }}</td>
                            <td class="col-1">{{ $visit->visitsstate->stateName }}</td>
                            <td class="col-1 text-center">
                                @if($visit->mailstate == 1)
                                    <span class="ok glyphicon glyphicon-ok tick"></span>
                                @endif
                            </td>
                            <td class="col-1">
                                {{$visit->grade}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
@stop
@push ('page_specific_js')
    <script src="js/visits.js"></script>
    <script src="js/visit.js"></script>
@endpush
