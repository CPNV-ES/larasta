@extends('layout')
@section('content')
    <h1>Grille d'évaluation</h1>
    <h2>Sections</h2>
    <table class="larastable">
        <tr>
            <th class="text-success text-center">Sections</th>
            <th class="text-success text-center">Critères</th>
            <th class="text-success text-center">Colonnes</th>
        </tr>
        @forelse ($evaluationSections as $evaluationSection)
            <tr>
                <td>{{ $evaluationSection->sectionName }}</td>
                <td>
                    @forelse ($evaluationSection->criterias as $criteria)
                        - {{ $criteria->criteriaName }} <br>
                    @empty
                        Aucun critère.
                    @endforelse
                </td>        
            </tr>        
        @empty
        <h2>Aucune section.</h2>
        @endforelse 
    </table>
@endsection
