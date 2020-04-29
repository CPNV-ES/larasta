@push('page_specific_css')    
    <link rel="stylesheet" href="/css/internships.css">
@endpush
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
    <form action="{{route('updateInternships',$internship->id)}}" method="get">
        <input type="hidden" name="id" value="{{ $internship->id }}">
        <table class="table text-left larastable">
            <tr>
                <td class="col-md-2">Du</td>
                <td>
                    <input type="date" name="beginDate"
                           value="{{ strftime("%G-%m-%d", strtotime($internship->beginDate)) }}"
                           required/>
                </td>
            </tr>
            <tr>
                <td class="col-md-2">Au</td>
                <td>
                    <input type="date" name="endDate"
                           value="{{ strftime("%G-%m-%d", strtotime($internship->endDate)) }}"
                           required/>
                </td>
            </tr>
            <tr>
                <td class="col-md-2">Description</td>
                <td>
                    <div id="description">{!! $internship->internshipDescription !!}</div>
                    <textarea style="display: none" name="description" id="txtDescription"></textarea>
                </td>
            </tr>
            <tr>
                <td class="col-md-2">Responsable administratif</td>
                <td>
                    <select name="aresp">
                        @foreach($responsibles->get()->toArray() as $admin)
                            <option value="{{ $admin->id }}"
                                    @if ($internship->admin->id == $admin->id) selected @endif>
                                {{$admin->firstname}} {{$admin->lastname}}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td class="col-md-2">Responsable</td>
                <td>
                    <select name="intresp">
                        @foreach($responsibles->get()->toArray() as $responsible)
                            <option value="{{ $responsible->id }}"
                                    @if ($internship->responsible->id == $responsible->id) selected @endif>
                                {{$responsible->firstname}} {{$responsible->lastname}}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td class="col-md-2">Maître de classe</td>
                <td>
                    {{-- Display the teacher, if the internship is attributed --}}
                    @if (isset($internship->student))
                        {{ $internship->student->flock->classMaster->initials }}
                    @endif
                </td>
            </tr>
            <tr>
                <td class="col-md-2">Etat</td>
                <td>
                    <select name="stateDescription">
                        <option selected="selected" value="{{ $actualState->id }}">
                            {{$actualState->stateDescription}}
                        </option>
                        @foreach($contractStates as $state)
                            <option value="{{ $state->id }}">
                                {{ $state->stateDescription }}
                            </option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td class="col-md-2">Salaire</td>
                <td><input type="number" name="grossSalary" value="{{$internship->grossSalary}}"/></td>
            </tr>
            @if (isset($internship->previous_id))
                <tr>
                    <td class="col-md-2" colspan="3">
                        <a href="/internships/{{ $internship->previous_id }}/edit">Stage précédent</a>
                    </td>
                </tr>
            @endif
        </table>

        {{-- Action buttons --}}
        <a href="/internships/{{$internship->id}}/view">
            <button class="btn btn-danger" type="button">Annuler les modifications</button>
        </a>
        <button class="formSend btn btn-warning" type="submit" onclick="transferDiv();">Valider les modifications</button>
        
        <script type="text/javascript">
            function transferDiv() {
                var divHtml = document.getElementById("description");
                var txtHtml = document.getElementById("txtDescription");
                txtHtml.value = divHtml.innerHTML;
            }
        </script>
    </form>
    
    <hr/>
    @if (Auth::user()->role > 1)
        @include('uploadFile',["route" => route("internship.storeFile", ["id" => $internship])])
    @endif
    @include('showFile',["route" => "internship.deleteFile", "id" => $internship , "medias" => $medias])
    @include('visits.add',compact('internship','visitsStates'))
    {{-- Visits --}}
    @if (isset($visits))
        <hr/>
        <h1>Visite(s)</h1>
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