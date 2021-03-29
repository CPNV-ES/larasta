@extends ('layout')
@push ('page_specific_js')
    <script src="/js/internship.js"></script>
@endpush
@section ('content')
    {{-- Title --}}
    {{-- Display the name of the student, if the internship is attributed --}}
    <h2 class="text-left">Stage
        @if (isset($internship->student))
            de {{ $internship->student->fullName }}
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
        <div class="row p-1 border fake-link" data-href="{{ route("person.show", $internship->admin) }}">
            <div class="col-2">Responsable administratif</div>
            <div class="col-10">{{ $internship->admin->fullName }}</div>
        </div>
        <div class="row p-1 border fake-link" data-href="{{route("person.show", $internship->responsible) }}">
            <div class="col-2">Responsable</div>
            <div class="col-10">{{ $internship->responsible->fullName }}</div>
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
                <a href="{{route("internships.show", $internship->previous_id)}}">Stage précédent</a>
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
    @if (Auth::user()->role > 1)
        <a href="{{route("internships.edit", $internship)}}">
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
            @foreach ($visits->toArray() as $visit)
                <div class="row border" onclick="window.location='/visits/{{$visit->id}}/manage';">
                    <div class="col-1">
                        {{ $visit->number }}
                    </div>
                    <div class="col-2">
                        {{ strftime("%e %b %g %R", strtotime($visit->moment)) }}
                    </div>
                    <div class="col-2">
                        {{ $visit->confirmed ? "Confirmé" : "Non-confirmé" }}
                    </div>
                    <div class="col-1">
                        {{ $visit->grade == "" ? "Pas de note" : $visit->grade }}
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <hr/>
    <div class="container text-left" style="padding:0;">
        <div class="table-responsive">
            @include ('remarks.remarkslist',['remarks' => $remarks, 'edit' => false, 'remarkOnId' => $internship->id, 'remarkType' => 5])
        </div>
    </div>
@stop