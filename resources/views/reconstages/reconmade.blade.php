<!--
// Nicolas Henry
// SI-T1a
// reconmade.blade.php
-->
@extends ('layout')

@push ('page_specific_css')
    <link rel="stylesheet" type="text/css" href="/css/documents.css">
@endpush

@section ('content')
    <a href="/reconstages">Reconduction page</a>
    <h1>Nouvelles données :</h1>

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
            </tr>
        </thead>
        <tbody>

            @foreach ($last as $value)
            <!-- Les données sont reprises tel que sur la page précédentes mais on y affiche uniquement ceux qui on été traité sur la page précédente. -->
                <tr class="{{ strtolower($value->student->initials) }}">
                    <td>{{ $value->company->companyName }}</td>
                    <td>{{ $value->beginDate->toFormattedDateString() }}</td>
                    <td>{{ $value->endDate->toFormattedDateString() }}</td>
                    <td>{{ $value->responsible->firstname }} {{ $value->responsible->lastname }}</td>
                    <td>{{ $value->admin->firstname }} {{ $value->admin->lastname }}</td>
                    <td>{{ $value->student->firstname }} {{ $value->student->lastname }}</td>
                    <td>{{ $value->grossSalary }}</td>
                    <td>{{ $value->contractstate->stateDescription }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="/"><button class="btn btn-default">Retour à la page d'accueil</button></a>
@stop
