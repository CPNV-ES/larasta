<!--
// Nicolas Henry
// SI-T1a
// reconmade.blade.php
-->
@extends ('layout')

@section ('page_specific_css')
    <link rel="stylesheet" type="text/css" href="/css/documents.css">
@stop

@section ('content')
    <h1>Eleves à reconduire</h1>
    <form method="POST" action="reconstages/reconmade">
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
                    <th>puces</th>
                </tr>
            </thead>
            
            <tbody>
                @foreach ($internships as $internship)
                    <tr class="{{ strtolower($internship->student->initials) }}">
                        <td><input name="company" value="{{ $internship->company->id }}" type="hidden">{{ $internship->company->companyName }}</td>
                        <td>{{ $internship->beginDate->toFormattedDateString() }}</td>
                        <td>{{ $internship->endDate->toFormattedDateString() }}</td>
                        <td>{{ $internship->responsible->firstname }} {{ $internship->responsible->lastname }}</td>
                        <td>{{ $internship->admin->firstname }} {{ $internship->admin->lastname }}</td>
                        <td>{{ $internship->student->firstname }} {{ $internship->student->lastname }}</td>
                        <td>{{ $internship->grossSalary }}</td>
                        <td>{{ $internship->contractstate->stateDescription }}</td>
                        <td><input class="checkList" name="internships[]" value="{{ $internship->id }}" type="checkbox"></td>
                    </tr>
                @endforeach
            </tbody>
        
        </table>
        <button class="btn btn-primary" id="reconduire" type="submit">Reconduire</button>
        <div class="checkBox"><input type="checkbox" id="check">Select All</div>
    </form>
    

@stop

@section ('page_specific_js')
    <script src="js/reconstages.js"></script>
@stop