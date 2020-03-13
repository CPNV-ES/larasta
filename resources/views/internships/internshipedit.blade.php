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
                        @foreach($contractStates as $state)
                            <option value="{{ $state->id }}"
                                    @if ($internship->contractstate_id == $state->id) selected @endif>
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
    @if (env('USER_LEVEL') > 1)
        @include('uploadFile',["route" => route("internship.storeFile", ["id" => $internship->id])])
    @endif
    @include('showFile',["route" => "internship.deleteFile", "id" => $internship->id , "medias" => $medias])
    {{-- Visits --}}
    @if (isset($visits))
        <hr/>
        <form id="visitsForm" action="/internships/{{$internship->id}}/updateVisit" method="get">
            <table class="table text-left larastable">
                <tr>
                    <th colspan="5">Visites</th>
                </tr>
                <tr>
                    <td>Date et heure</td>
                    <td>Etat</td>
                    <td>N°</td>
                    <td colspan="2">Note</td>
                </tr>
                <tr id="addVisit">
                    <td colspan="5">
                        <button class="btn btn-primary" type="button" onclick="visits();">Ajouter une visite</button>
                        <script type="text/javascript">
                            function visits() {
                                var tr = document.getElementById("addVisit");
                                tr.innerHTML = "<td><input name='visitDate' type='date' value='{{ date("Y-m-d") }}' required/><input name='visitTime' type='time' value='{{ date("H:i") }}' required/></td><td><select name='visitState'><option value='0' selected>Non-confirmé</option><option value='1'>Confirmé</option></select></td><td><input name='visitNumber' type='number' required/></td><td><input name='grade' type='number' min='1' max='6' step='0.5'/></td><td><button class='btn btn-warning' onclick='addVisits();' type='submit'>Valider la visite</button></td>";
                            }
                        </script>
                    </td>
                </tr>
                <script type="text/javascript">
                    function addVisits() {
                        var form = document.getElementById("visitsForm");
                        form.setAttribute("action", "/internships/{{$internship->id}}/addVisit");
                    }
                </script>
                @foreach ($visits->toArray() as $row=>$value)
                    <tr>
                        <input name="visitID{{ $row }}" type="hidden" value="{{ $value->id }}"/>
                        <td>
                            <input name="visitDate{{ $row }}" type="date"
                                   value="{{ strftime("%G-%m-%d", strtotime($value->moment)) }}" required/>
                            <input name="visitTime{{ $row }}" type="time"
                                   value="{{ strftime("%H:%M", strtotime($value->moment)) }}" required/>
                        </td>
                        <td>
                            <select name='visitState{{ $row }}'>
                                <option value='0' {{ $value->confirmed == 0 ? "selected" : "" }}>Non-confirmé</option>
                                <option value='1' {{ $value->confirmed == 1 ? "selected" : "" }}>Confirmé</option>
                            </select>
                        </td>
                        <td>
                            <input name='visitNumber{{ $row }}' type='number' value="{{ $value->number }}" required/>
                        </td>
                        <td colspan="2">
                            <input name='grade{{ $row }}' type='number' min='1' max='6' step='0.5'
                                   value="{{ $value->grade }}"/>
                        </td>
                    </tr>
                @endforeach
            </table>
            <button class="btn btn-warning" type="submit">Valider toutes les visites</button>
        </form>
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