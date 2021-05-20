@push('page_specific_css')    
    <link rel="stylesheet" href="/css/internships.css">
@endpush
@extends ('layout')
@section ('content')
    <script>
        const getPeopleRoute = "{{route("getPeople")}}";
        var selectedInternId = {{isset($internship->student)?$internship->student->id:"false"}};
    </script>
    {{-- Title --}}
    {{-- Display the name of the student, if the internship is attributed --}}
    <form action="{{route('internships.update',$internship->id)}}" method="post">
        @method("PUT")
        @csrf
        <h2 class="text-left internshipTitle">Stage
            @if(in_array($internship->contractstate->stateDescription, ["Reconduit", "Confirmé"]))
            de
                @php
                    if(isset($internship->student)){
                        $selectedYear = $internship->student->flock->startYear;
                    } else if (isset($_COOKIE["lastSelectedYear"])){
                        $selectedYear = $_COOKIE["lastSelectedYear"];
                    } else {
                        $selectedYear = end($years);
                    }
                @endphp
                <select id="internYearSelector" autocomplete="off">
                    @foreach ($years as $indYear => $year)
                        <option {{($year == $selectedYear)?"selected":""}} value="{{$year}}">20{{$year}}</option>
                    @endforeach
                </select>
                <select id="internSelector" name="internId" autocomplete="off" value={{$internship->student->id??"0"}}></select>
                <input id="internRemark" class="none" data-name="remark_internId" placeholder="Pourquoi?"/>
            @elseif (isset($internship->student))
                de {{ $internship->student->fullName}}
            @else
                non attribué
            @endif
            chez {{ $internship->company->companyName }}
        </h2>

    {{-- Internship information --}}
        <input type="hidden" name="id" value="{{ $internship->id }}">
        <table class="table text-left larastable">
            <tr scope="row">
                <td scope="col-md-2">Du</td>
                <td>
                    <input type="date" name="beginDate" class="remark"
                           value="{{ strftime("%G-%m-%d", strtotime($internship->beginDate)) }}"
                           required/>
                </td>
            </tr>
            <tr scope="row">
                <td>Au</td>
                <td>
                    <input type="date" name="endDate" class="remark"
                           value="{{ strftime("%G-%m-%d", strtotime($internship->endDate)) }}"
                           required/>
                </td>
            </tr>
            <tr scope="row">
                <td>Description</td>
                <td class="Description">
                    <textarea name="internshipDescription" id="description" class="remark">{!! $internship->internshipDescription !!}</textarea>
                </td>
            </tr>
            <tr scope="row">
                <td>Responsable administratif</td>
                <td>
                    <select name="admin_id" class="remark">
                        @foreach($responsibles as $admin)
                            <option value="{{ $admin->id }}" @if ($internship->admin->id == $admin->id) selected @endif>
                                {{$admin->fullName}}
                            </option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr scope="row">
                <td>Responsable</td>
                <td>
                    <select name="responsible_id" class="remark">
                        @foreach($responsibles as $responsible)
                            <option value="{{ $responsible->id }}" @if ($internship->responsible->id == $responsible->id) selected @endif>
                                {{$responsible->fullName}}
                            </option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr scope="row">
                <td>Maître de classe</td>
                <td>
                    {{-- Display the teacher, if the internship is attributed --}}
                    @if (isset($internship->student))
                        {{ $internship->student->flock->classMaster->initials }}
                    @endif
                </td>
            </tr>
            <tr scope="row">
                <td>Etat</td>
                <td>
                    <select name="contractstate_id" class="remark">
                        <option selected="selected" value="{{ $internship->contractstate->id }}">
                            {{$internship->contractstate->stateDescription}}
                        </option>
                        @foreach($contractStates as $state)
                            <option value="{{ $state->id }}">
                                {{ $state->stateDescription }}
                            </option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr scope="row">
                <td>Salaire</td>
                <td><input type="number" name="grossSalary" class="remark" value="{{$internship->grossSalary}}"/></td>
            </tr>
            <tr scope="row">
                <td><label for="externalLogbookCheckbox">Journal de bord externe<label></td>
                <td><input id="externalLogbookCheckbox" type="checkbox" name="externalLogbook" class="remark" autocomplete="off" {{$internship->externalLogbook ? "checked":""}} /></td>
            </tr>
            @if (isset($internship->previous_id))
                <tr>
                    <td>
                    <a href="{{route("internships.edit", $internship->previous_id)}}">Stage précédent</a>
                    </td>
                </tr>
            @endif
        </table>

        {{-- Action buttons --}}
        <a href="{{route("internships.show", $internship->id)}}">
            <button class="btn btn-danger" type="button">Retour</button>
        </a>
        <button class="btn btn-success" type="submit">Valider</button>
    </form>
    
    <hr/>
    @if (Auth::user()->role > 1)
        @include('uploadFile',["route" => route("internship.storeFile", ["id" => $internship])])
    @endif
    @include('showFile',["route" => "internship.deleteFile", "id" => $internship , "medias" => $medias])
    {{-- Visits --}}
    <hr/>
    <h1>Visite(s)</h1>
    <div class="col-12 {{$internship->visits->isEmpty()?"none":""}}">
        <div class='error none'>
            Une erreur inconnue est survenue, veuillez raffraîchir la page...
        </div>
        @if (isset($internship->visits) && count($internship->visits) > 0)
            @include('visits.visitsList', ['visits' => $internship->visits])
        @endif
        <div class="d-flex justify-content-end">
            <button id="newVisit" type="button" class="btn-success">Ajouter une visite</button>
        </div>
        <div id="showNewVisit" class="pointer none">
            <div class="focus">
                @include('visits.add', ['internship' => $internship, 'visitsNumber' => $visitsNumber])
            </div>
            <div class="darken-background"></div>
        </div>
    </div>
    
    {{-- Remarks --}}
    <hr/>
    <div class="col-12">
        @include ('remarks.remarkslist',['remarks' => $remarks, 'edit' => true, 'remarkOnId' => $internship->id, 'remarkType' => 5])
    </div>
@endsection
@push ('page_specific_js')
    <script src="/js/internshipsEdit.js"></script>
@endpush