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
    <h1>Nouvelles données :</h1>

    <table id="summary" class="reconduction">
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

            @foreach ($internships as $internship)
            <!-- Les données sont reprises tel que sur la page précédentes mais on y affiche uniquement ceux qui on été traité sur la page précédente. -->
                <tr data-internship="{{route('internship',$internship->id)}}"> 
                    <td>{{ $internship->company->companyName }}</td>
                    <td>{{ $internship->beginDate->toFormattedDateString() }}</td>
                    <td>{{ $internship->endDate->toFormattedDateString() }}</td>
                    <td>@isset($internship->responsible){{ $internship->responsible->fullName }}@endisset</td>
                    <td>{{ $internship->admin->fullName }}</td>
                    <td>@isset($internship->student){{ $internship->student->fullName }}@endisset</td>
                    <td>{{ $internship->grossSalary }}</td>
                    <td>{{ $internship->contractstate->stateDescription }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{route('reconstage.index')}}" class="btn btn-light"> Retour </a>
    <a href="{{route('index')}}" class="btn btn-light">Accueil</a>
@stop

@push ('page_specific_js')
    <script src="/js/reconmade.js"></script>
@endpush