@extends('layout')
@section('content')
    <h1>Grille d'évaluation</h1>
    <h2>Sections</h2>
    <table class="larastable">
        <tr>
            @forelse ($evaluationSections as $evaluationSection)
                <th>{{ $evaluationSection->sectionName }}</th>
                @forelse ($evaluationSection->criterias as $criteria)
                <tr>
                    <td>{{ $criteria->criteriaName }}</td>
                </tr>
                @empty 
                <tr>
                    <td>Aucun critère.</td>
                </tr>
            @endforelse 
            @empty
                <th>Aucune section.</th>
            @endforelse  
        </tr>
    </table>
@endsection
