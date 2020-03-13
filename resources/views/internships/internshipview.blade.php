@extends ('layout')

@section ('content')
    {{-- Title --}}
    {{-- Display the name of the student, if the internship is attributed --}}
    <h2 class="text-left">Stage
        @if (isset($internship->student))
            de {{ $internship->student->firstname }} {{ $internship->student->lastname }}
        @else
            non attribué
        @endif
        chez {{ $internship->company->companyName }}
    </h2>

    {{-- Internship information --}}
    <div class="container text-left border">
        <div class="row p-1 border">
            <div class="col-2">Du</div>
            <div class="col-10">{{ strftime("%e %b %g", strtotime($internship->beginDate)) }}</div>
        </div>
        <div class="row p-1 border">
            <div class="col-2">Au</div>
            <div class="col-10">{{ strftime("%e %b %g", strtotime($internship->endDate)) }}</div>
        </div>
        <div class="row p-1 border">
            <div class="col-2">Description</div>
            <div class="col-10">
                <div id="description">{!! $internship->internshipDescription !!}</div>
            </div>
        </div>
        <div class="row p-1 border clickable-row" data-href="/listPeople/{{ $internship->admin->id }}/info">
            <div class="col-2">Responsable administratif</div>
            <div class="col-10">{{ $internship->admin->firstname }} {{ $internship->admin->lastname }}</div>
        </div>
        <div class="row p-1 border clickable-row" data-href="/listPeople/{{ $internship->responsible->id }}/info">
            <div class="col-2">Responsable</div>
            <div class="col-10">{{ $internship->responsible->firstname }} {{ $internship->responsible->lastname }}</div>
        </div>
        <div class="row p-1 border">
            <div class="col-2">Maître de classe</div>
            <div class="col-10">
                {{-- Display the teacher, if the internship is attributed --}}
                @if (isset($internship->student))
                    {{ $internship->student->flock->classMaster->initials }}
                @endif
            </div>
        </div>
        <div class="row p-1 border">
            <div class="col-2">Etat</div>
            <div class="col-10">
                {{ $internship->contractState->stateDescription }}
            </div>
        </div>
        <div class="row p-1 border">
            <div class="col-2">Salaire</div>
            <div class="col-10">{{ $internship->grossSalary }}</div>
        </div>
        @if (isset($internship->previous_id))
            <div class="row p-1 border">
                <div class="col-2">
                    <a href="/internships/{{ $internship->previous_id }}/view">Stage précédent</a>
                </div>
            </div>
        @endif
    </div>

    {{-- Action buttons --}}
    {{-- Generate contract button --}}
    @if(substr($internship->contractGenerated,0,4) == "0000" || $internship->contractGenerated == null)
        {{-- We can only generate the contract if there is an attibuted student --}}
        @if (isset($internship->student))
            <a href="/contract/{{ $internship->id }}">
                <button>Générer le contrat</button>
            </a>
        @endif
    @else
        {{-- Reset contract button --}}
        <br> Contrat généré le : {{$internship->contractGenerated}}<br>
        <a href="/contract/{{$internship->id}}/cancel">
            <button>Réinitialiser</button>
        </a>
    @endif
    {{-- Modify button --}}
    @if (env('USER_LEVEL') > 1)
        <a href="/internships/{{$internship->id}}/edit">
            <button>Modifier</button>
        </a>   
    @endif

    {{-- logbook button --}}
    <a href="{{route('logbookIndex', ['internshipId' => $internship->id])}}">
        <button class="">Journal de travail</button>
    </a>

    @include('showFile',["route" => "internship.deleteFile", "id" => $internship->id , "medias" => $medias,"editable"=>false])
    
    {{-- Visits --}}
    @if (isset($visits) && count($visits) > 0)
        <hr/>
        <h4>Visites</h4>
        <div class="container text-left">
            <div class="row border bg-header">
                <div class="col-1">N°</div>
                <div class="col-2">Date et heure</div>
                <div class="col-2">Etat</div>
                <div class="col-1">Note</div>
            </div>
            @foreach ($visits->toArray() as $value)
                <div class="row border">
                    <div class="col-1">
                        {{ $value->number }}
                    </div>
                    <div class="col-2">
                        {{ strftime("%e %b %g %R", strtotime($value->moment)) }}
                    </div>
                    <div class="col-2">
                        {{ $value->confirmed ? "Confirmé" : "Non-confirmé" }}
                    </div>
                    <div class="col-1">
                        {{ $value->grade == "" ? "Pas de note" : $value->grade }}
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    {{-- Remarks --}}
    @if (isset($remarks)) @if (count($remarks) > 0)
        <hr/>
        <h4>Remarques</h4>
        <div class="container text-left">
            <div class="row border bg-header">
                <div class="col-1">Date</div>
                <div class="col-1">Auteur</div>
                <div class="col-10">Remarque</div>
            </div>
            @foreach ($remarks->toArray() as $value)
                <div class="row border">
                    <div class="col-1">
                        {{ strftime("%e %b %g", strtotime($value->remarkDate)) }}
                    </div>
                    <div class="col-1">
                        {{ $value->author }}
                    </div>
                    <div class="col-10">
                        {{ $value->remarkText }}
                    </div>
                </div>
            @endforeach
        </div>
    @endif @endif
@stop
