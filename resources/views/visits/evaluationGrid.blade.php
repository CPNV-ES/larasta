@extends('layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <h2>Évaluation de <a href="#">{{$visit->internship->student->firstname}} {{$visit->internship->student->lastname}}</a></h2>
            <h4>Stage chez {{$visit->internship->company->companyName}}</h4>
            <h4>Encadré par <a href="#">{{$visit->internship->responsible->firstname}} {{$visit->internship->responsible->lastname}}</a></h4>
            <h3>Visite #{{$visit->number}} de <a href="#">{{$visit->internship->student->flock->classMaster->fullname}}</a> le {{(new DateTime($visit->moment))->format('d-m-Y')}}</h3>
        </div>
    </div>
    
    <br><br>

    <h2>Sections</h2>
    <form action="{{ route("visit.updateEvaluation", ["id" => $visit->id]) }}" method="post">
    {{ csrf_field() }}
    @forelse ($evaluationSections as $evaluationSection)
        <table class="larastable w-100 mb-3 evalgrid-fill">
            <tr>
                <th colspan="5" class="text-success">{{ $evaluationSection->sectionName }}</th>
            </tr>
            <tr>
                <th class="text-center w-25">Critères</th>

                @if ($evaluationSection->sectionType == 1)
                    <th class="text-center">Observations attendues</th>
                @endif

                @if ($evaluationSection->sectionType == 2)
                    <th class="text-center">Tâches</th>
                @endif

                @if ($evaluationSection->hasGrade)
                    <th class="text-center">Points</th>
                @endif

                <th class="text-center">Remarques du responsable de stage</th>
                <th class="text-center">Remarques du stagiaire</th>
            </tr>
            @forelse ($criteriaValueBySection[$evaluationSection->id] as $criteriaValue)
                <tr>
                    <td>
                        {{ $criteriaValue->criteria->criteriaName }}
                    </td>     
                    
                    @if ($evaluationSection->sectionType == 1 || $evaluationSection->sectionType == 2)
                        <td>
                            <textarea name="cv[{{$criteriaValue->id}}][contextSpecifics]" maxlength="1000">{{ $criteriaValue->contextSpecifics }}</textarea>
                        </td>
                    @endif

                    @if($evaluationSection->hasGrade)
                        <td class="numberinput-col">
                            @if($isResponsible)
                                <input
                                        name="cv[{{$criteriaValue->id}}][points]"
                                        type="number"
                                        min="0" max="{{ $criteriaValue->criteria->maxPoints }}"
                                        value="{{ $criteriaValue->points == '-1' ? '' : $criteriaValue->points }}"
                                />
                                <br>
                                <span>/{{ $criteriaValue->criteria->maxPoints }}</span>
                            @endif
                        </td>
                    @endif
                    <td>
                        @if($isResponsible)
                            <textarea name="cv[{{$criteriaValue->id}}][managerComments]" maxlength="1000">{{ $criteriaValue->managerComments }}</textarea>
                        @endif
                    </td>
                    <td>
                        <textarea name="cv[{{$criteriaValue->id}}][studentComments]" maxlength="1000">{{ $criteriaValue->studentComments }}</textarea>
                    </td>
                </tr>    
            @empty
                <h2>Aucun critère.</h2>
            @endforelse 
        </table>
    @empty
        <h2>Aucune section.</h2>
    @endforelse
    <button class="btn btn-primary" type="submit">Enregistrer</button>
    </form>
@endsection

@push ('page_specific_css')
    <link rel="stylesheet" href="/css/evalGrid.css">
@endpush