@extends('layout')
@section('content')
    <h1>Grille d'évaluation</h1>
    <h2>{{ $templateName }}</h2>
    @forelse ($evaluationSections as $evaluationSection)
        <table class="larastable w-100 mb-3">
            <tr>
                <th colspan="5" class="text-success">{{ $evaluationSection->sectionName }}</th>
            </tr>
            <tr>
                <th class="text-center w-25">Critères</th>

                @if ($evaluationSection->sectionType == 2)
                    <th class="text-center">Tâches</th>
                @endif

                @if ($evaluationSection->sectionType == 1)
                    <th class="text-center">Observations attendues</th>
                @endif

                @if ($evaluationSection->hasGrade)
                    <th class="text-center">Points Max</th>
                @endif

                <th class="text-center">Remarques du responsable de stage</th>
                <th class="text-center">Remarques du stagiaire</th>
            </tr>
            @forelse ($evaluationSection->criterias as $criteria)
                <tr>
                    <td>
                        {{ $criteria->criteriaName }}
                    </td>     
                    
                    @switch ($evaluationSection->sectionType)
                        @case (1)
                            <td>{{ $criteria->criteriaDetails  }}</td>
                            @if ($evaluationSection->hasGrade)
                                <td>{{ $criteria->maxPoints  }}</td>
                            @endif
                            <td></td>
                            <td></td>
                            @break
                        @case (2)
                            <td></td>
                            @if ($evaluationSection->hasGrade)
                                <td>{{ $criteria->maxPoints  }}</td>
                            @endif
                            <td></td>
                            <td></td>                      
                            @break
                        @case (3)
                            <td></td>
                            @if ($evaluationSection->hasGrade)
                                <td>{{ $criteria->maxPoints  }}</td>
                            @endif
                            <td></td>
                            @break
                    @endswitch
                </tr>    
            @empty
                <h2>Aucun critère.</h2>
            @endforelse 
        </table>
    @empty
        <h2>Aucune section.</h2>
    @endforelse
    <a href="{{ route('evaluationgrid.create') }}" class="btn btn-primary text-white">Nouvelle grille d'évaluation</a>
@endsection