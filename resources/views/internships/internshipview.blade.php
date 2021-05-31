@extends ('layout')
@push ('page_specific_js')
    <script src="/js/internship.js"></script>
@endpush
@section ('content')
    {{-- Title --}}
    {{-- Display the name of the student, if the internship is attributed --}}
    <h2>Stage
        @if (isset($internship->student))
            de {{ $internship->student->fullName }}
        @else
            non attribué
        @endif
        chez {{ $internship->company->companyName }}
    </h2>

    {{-- Internship information --}}
    <h5 class="titlebar">Détails</h5>
    <table class="larastable w-100">
        <tr>
            <th class="w-25">Du</th>
            <td>{{ strftime("%e %b %g", strtotime($internship->beginDate)) }}</td>
        </tr>
        <tr>
            <th>Au</th>
            <td>{{ strftime("%e %b %g", strtotime($internship->endDate)) }}</td>
        </tr>
        <tr>
            <th>Description</th>
            <td>
                <div id="description">{!! $internship->internshipDescription !!}</div>
            </td>
        </tr>

        <tr>
            <th>Responsable administratif</th>
            <td><a href="{{ route("person.show", $internship->admin) }}">{{ $internship->admin->fullName }}</a></td>
        </tr>
        <tr>
            <th>Responsable</th>
            <td>
                <a href="{{route("person.show", $internship->responsible) }}">{{ $internship->responsible->fullName }}</a>
            </td>
        </tr>
        <tr>
            <th>Maître de classe</th>
            <td>
                {{-- Display the teacher, if the internship is attributed --}}
                @if (isset($internship->student))
                    {{ $internship->student->flock->classMaster->initials }}
                @endif
            </td>
        </tr>
        <tr>
            <th>Etat</th>
            <td>{{ $internship->contractState->stateDescription }}</td>
        </tr>
        <tr>
            <th>Salaire</th>
            <td>{{ $internship->grossSalary }}</td>
        </tr>
        @if (isset($internship->previous_id))
            <tr>
                <td class="col-2"><a href="{{route("internships.show", $internship->previous_id)}}">Stage précédent</a>
                </td>
            </tr>
        @endif
    </table>

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

    {{-- Internship report --}}
    @if (!$internship->report)
        @if (Auth::user()->id == $internship->intern_id)
            <a href="{{route("internshipReport.create", $internship->id)}}">
                <button>Créer le rapport de stage</button>
            </a>
        @endif
    @else
        <a href="{{route("internshipReport.show", $internship->report->id)}}">
            <button>Voir le rapport de stage</button>
        </a>
    @endif

    @include('showFile',["route" => "internship.deleteFile", "id" => $internship->id , "medias" => $medias,"editable"=>false])

    {{-- Visits --}}
    @if (isset($visits) && count($visits) > 0)
        @include('visits.visitsList', ['visits' => $visits])
    @endif

    @include ('remarks.remarkslist',['remarks' => $remarks, 'edit' => false, 'remarkOnId' => $internship->id, 'remarkType' => 5])
@stop