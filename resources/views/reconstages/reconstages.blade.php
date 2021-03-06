<!--
// Nicolas Henry
// SI-T1a
// reconmade.blade.php
-->
@extends ('layout')

@push ('page_specific_css')
    <link rel="stylesheet" type="text/css" href="/css/documents.css">
    <link rel="stylesheet" type="text/css" href="/css/recon.css">
@endpush

@section ('content')
    <h1>Stages à reconduire</h1>

    <form method="POST" action="{{route('reconstage.reconducted')}}">
        {{ csrf_field() }}
        <table class="reconduction">
            <thead>
                <tr>
                    <th>Entreprise</th>
                    <th>Début</th>
                    <th>Fin</th>
                    <th>Responsable administratif</th>
                    <th>Responsable</th>
                    <th>Stagiaire</th>
                    <th>Salaire</th>
                    <th>Etat</th>
                    <th data-toggle="tooltip" data-placement="top" title="stage à reconduire?">reconduire</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($internships as $internship)
                    <tr>
                        <td><input name="company" value="{{ $internship->company->id }}" type="hidden">{{ $internship->company->companyName }}</td>
                        <td>{{ $internship->beginDate->toFormattedDateString() }}</td>
                        <td>{{ $internship->endDate->toFormattedDateString() }}</td>
                        <td>{{ $internship->responsible->fullName ?? 'n/a' }}</td>
                        <td>{{ $internship->admin->fullName ?? 'n/a' }}</td>
                        <td>{{ @$internship->student->fullName ?? 'n/a' }}</td>
                        <td>{{ $internship->grossSalary ?? 'n/a' }}</td>
                        <td>{{ $internship->contractstate->stateDescription ?? 'n/a' }}</td>
                        <td><input class="checkList" name="internships[]" value="{{ $internship->id }}" type="checkbox"></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <button class="btn btn-primary none" id="reconduire" type="submit">Reconduire</button>

        <label for="beginDate">Début du prochain stage :</label>
        <input type="date" name="beginDate" value="{{array_first($datesOfNextInternship)}}"/> |
        <label for="endDate">Fin du prochain stage :</label>
        <input type="date" name="endDate" value="{{array_last($datesOfNextInternship)}}"/>

        <div class="checkBox"><input type="checkbox" id="check">Tout sélectionner</div>
    </form>


@stop

@push ('page_specific_js')
    <script src="/js/reconstages.js"></script>
@endpush
