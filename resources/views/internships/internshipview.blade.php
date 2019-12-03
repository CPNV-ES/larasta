@extends ('layout')

@section ('content')
    <!-- Display the name of the student, if the internship is attributed-->
    <h2 class="text-left">Stage
        @if (isset($internship->student))
            de {{ $internship->student->firstname }} {{ $internship->student->lastname }}
        @else
            non attribué
        @endif
        chez {{ $internship->company->companyName }}
    </h2>

    <!-- Internship information-->
    <table class="table text-left larastable">
        <tr>
            <td class="col-md-2" colspan="2">Du</td>
            <td>{{ strftime("%e %b %g", strtotime($internship->beginDate)) }}</td>
        </tr>
        <tr>
            <td class="col-md-2" colspan="2">Au</td>
            <td>{{ strftime("%e %b %g", strtotime($internship->endDate)) }}</td>
        </tr>
        <tr>
            <td class="col-md-2" colspan="2">Description</td>
            <td>
                <div id="description">{!! $internship->internshipDescription !!}</div>
            </td>
        </tr>
        <tr class="clickable-row" data-href="/listPeople/{{ $internship->admin->id }}/info">
            <td class="col-md-2" colspan="2">Responsable administratif</td>
            <td>{{ $internship->admin->firstname }} {{ $internship->admin->lastname }}</td>
        </tr>
        <tr class="clickable-row" data-href="/listPeople/{{ $internship->responsible->id }}/info">
            <td class="col-md-2" colspan="2">Responsable</td>
            <td>{{ $internship->responsible->firstname }} {{ $internship->responsible->lastname }}</td>
        </tr>
        <tr>
            <td class="col-md-2" colspan="2">Maître de classe</td>
            <td>
                <!-- Display the teacher, if the internship is attributed-->
                @if (isset($internship->student))
                    {{ $internship->student->flock->classMaster->initials }}
                @endif
            </td>
        </tr>
        <tr>
            <td class="col-md-2" colspan="2">Etat</td>
            <td>
                {{ $internship->contractState->stateDescription }}
            </td>
        </tr>
        <tr>
            <td class="col-md-2" colspan="2">Salaire</td>
            <td>{{ $internship->grossSalary }}</td>
        </tr>
        @if (isset($internship->previous_id))
            <tr>
                <td class="col-md-2" colspan="3">
                    <a href="/internships/{{ $internship->previous_id }}/view">Stage précédent</a>
                </td>
            </tr>
        @endif
    </table>

    {{-- Action buttons --}}
    @if(substr($iship->contractGenerated,0,4) == "0000" || $iship->contractGenerated == null)
        <a href="/contract/{{ $iship->id }}">
            <button class="btn btn-primary">Générer le contrat</button>
        </a>
    @else
        <br> Contrat généré le : {{$iship->contractGenerated}}<br>
        <a href="/contract/{{$iship->id}}/cancel">
            <button class="btn btn-danger">Réinitialiser</button>
        </a>
    @endif
    @if (env('USER_LEVEL') >= 1)
        <a href="/internships/{{$iship->id}}/edit">
            <button class="btn btn-warning">Modifier</button>
        </a>
    @endif
    @if (isset($visits)) @if (count($visits) > 0)
        <hr/>
        <table class="table text-left larastable">
            <tr>
                <th colspan="4">Visites</th>
            </tr>
            <tr>
                <td>Date et heure</td>
                <td>Etat</td>
                <td>N°</td>
                <td>Note</td>
            </tr>
            @foreach ($visits->toArray() as $value)
                <tr>
                    <td>
                        {{ strftime("%e %b %g %R", strtotime($value->moment)) }}
                    </td>
                    <td>
                        @if ($value->confirmed)
                            {{ "Confirmé" }}
                        @else
                            {{ "Non-confirmé" }}
                        @endif
                    </td>
                    <td>
                        {{ $value->number }}
                    </td>
                    <td>
                        {{ $value->grade == "" ? "Pas de note" : $value->grade }}
                    </td>
                </tr>
            @endforeach
        </table>
    @endif @endif
    @if (isset($remarks)) @if (count($remarks) > 0)
        <hr/>
        <table class="table text-left larastable">
            <tr>
                <th colspan="3">Remarques</th>
            </tr>
            <tr>
                <td>Date</td>
                <td>Auteur</td>
                <td>Remarque</td>
            </tr>
            @foreach ($remarks->toArray() as $value)
                <tr>
                    <td>
                        {{ strftime("%e %b %g", strtotime($value->remarkDate)) }}
                    </td>
                    <td>
                        {{ $value->author }}
                    </td>
                    <td>
                        {{ $value->remarkText }}
                    </td>
                </tr>
            @endforeach
        </table>
    @endif @endif
@stop