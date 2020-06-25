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
    <form action="{{route('updateInternships',$internship->id)}}" method="post">
        @method("PUT")
        @csrf
    <h2 class="text-left internshipTitle">Stage
        @if(in_array($currentState->stateDescription, ["Reconduit", "Confirmé"]))
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
                        <option selected="selected" value="{{ $currentState->id }}">
                            {{$currentState->stateDescription}}
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
                    <a href="{{route("editInternships", $internship->previous_id)}}">Stage précédent</a>
                    </td>
                </tr>
            @endif
        </table>

        {{-- Action buttons --}}
        <a href="{{route("internship", $internship->id)}}">
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
    <h1>Visite(s) <span class="buttonNewVisit pointer">+</span></h1> 
    <div id="showNewVisit" class="pointer none">
        <div class="focus">
            @include('visits.add',compact('internship','visitsStates'))
        </div>
        <div class="darken-background"></div>
    </div>
    @if (isset($visits))
        <div class="col-12">
            <div class='error none'>
                Une erreur inconnue est survenue, veuillez raffraîchir la page...
            </div>
            <table id="visitsForm" class="table larastable">
                <thead>
                    <th>N° visite</th>
                    <th>Jour</th>
                    <th>Heure</th>
                    <th>Mail envoyé?</th>
                    <th>Confirmé?</th>
                    <th>Note</th>
                    <th>État de la visite</th>
                </thead>
                <tbody>
                    @foreach ($visits as $key => $visit)
                        <tr>
                            <input type="hidden" name="route" value="{{ route('visit.update', ['id' => $internship]) }}"/>
                            <input type="hidden" name="id" value="{{$visit->id}}"/>
                            <td><input type="number" min="1" name="number" value="{{$visit->number}}" required/></td>
                            <td><input type="date" name="day" value="{{ strftime("%G-%m-%d", strtotime($visit->moment)) }}"/></td>
                            <td><input type="time" name="hour" value="{{ strftime("%H:%M", strtotime($visit->moment)) }}" /></td>
                            <td><input type="checkbox" name="mailstate" {{ $visit->mailstate ? "checked" : "" }}/></td>
                            <td><input type="checkbox" name="confirmed" {{ $visit->confirmed ? "checked" : "" }}/></td>
                            <td><input type="number" min="1" max="6" step="0.5" name="grade" value="{{ $visit->grade }}" required/></td>
                            <td>
                                <select name="visitsstates_id" required>
                                    @foreach ($visitsStates as $visitstate)
                                        <option value="{{$visitstate->id}}" {{ $visit->visitsstates_id == $visitstate->id ? "selected" : "" }}>{{ $visitstate->stateName }}</option>                                    
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    {{-- Remarks --}}
    @if (isset($remarks))
        <hr/>
        <form action="/internships/{{$internship->id}}/addRemark" method="get">
            <table class="table text-left larastable">
                <tr>
                    <th colspan="4">Remarques</th>
                </tr>
                <tr>
                    <td>Date</td>
                    <td>Auteur</td>
                    <td colspan="2">Remarque</td>
                    <input type="hidden" name="id" value="{{ $internship->id }}">
                </tr>
                <tr id="addRemark">
                    <td colspan="4">
                        <button class="btn btn-primary" type="button" onclick="remarks();">Ajouter une remarque</button>
                        <script type="text/javascript">
                            function remarks() {
                                var tr = document.getElementById("addRemark");
                                tr.innerHTML = "<td><input name='remarkDate' type='date' value='{{ date("Y-m-d") }}' readonly required/></td><td><input name='remarkAuthor' type='text' value='{{ env("USER_INITIALS") }}' readonly required/></td><td><textarea name='remark' required cols='100'></textarea></td><td><button class='btn btn-warning' type='submit'>Valider la remarque</button></td>";
                            }
                        </script>
                    </td>
                </tr>
                @foreach ($remarks->toArray() as $value)
                    <tr>
                        <td>
                            {{ strftime("%e %b %g", strtotime($value->remarkDate)) }}
                        </td>
                        <td>
                            {{ $value->author }}
                        </td>
                        <td colspan="2">
                            {{ $value->remarkText }}
                        </td>
                    </tr>
                @endforeach
            </table>
        </form>
    @endif

@endsection
@push ('page_specific_js')
    <script src="/js/internshipsEdit.js"></script>
@endpush