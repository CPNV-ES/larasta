@extends ('layout')

@section ('content')
    <h2 class="text-left">Stage de {{ $iship->studentfirstname }} {{ $iship->studentlastname }} chez {{ $iship->companyName }}</h2>
    <form action="/internships/{{$iship->id}}/update" method="get">
    <table class="table text-left larastable">
        <tr>
            <td class="col-md-2" colspan="2">Du</td>
            <td>
                <input type="date" name="beginDate" value="{{ strftime("%G-%m-%d", strtotime($iship->beginDate)) }}" required/>
            </td>
        </tr>
        <tr>
            <td class="col-md-2" colspan="2">Au</td>
            <td>
                <input type="date" name="endDate" value="{{ strftime("%G-%m-%d", strtotime($iship->endDate)) }}" required/>
            </td>
        </tr>
        <tr>
            <td class="col-md-2" colspan="2">Description</td>
            <td>
                <div id="description">{!! $iship->internshipDescription !!}</div>
                <script>
                    BalloonEditor
                        .create( document.querySelector( '#description' ) )
                        .then( editor => {
                            console.log( editor );
                        } )
                        .catch( error => {
                            console.error( error );
                        } );
                </script>
                <textarea style="display: none" name="description" id="txtDescription"></textarea>
            </td>
        </tr>
        <tr>
            <td class="col-md-2" colspan="2">Responsable administratif</td>
            <td>
                <select name="aresp">
                    @foreach($resp->get()->toArray() as $value)
                        <option value="{{ $value->id }}" @if ($iship->arespid == $value->id) selected @endif>{{$value->firstname}} {{$value->lastname}}</option>
                    @endforeach
                </select>
            </td>
        </tr>
        <tr>
            <td class="col-md-2" colspan="2">Responsable</td>
            <td>
                <select name="intresp">
                    @foreach($resp->get()->toArray() as $value)
                        <option value="{{ $value->id }}" @if ($iship->intrespid == $value->id) selected @endif>{{$value->firstname}} {{$value->lastname}}</option>
                    @endforeach
                </select>
            </td>
        </tr>
        <tr>
            <td class="col-md-2" colspan="2">Maître de classe</td>
            <td>{{ $iship->initials }}</td>
        </tr>
        <tr>
            <td class="col-md-2" colspan="2">Etat</td>
            <td>
                <select name="stateDescription">
                    @foreach($states->get()->toArray() as $value)
                        <option value="{{ $value->id }}" @if ($iship->contractstate_id == $value->id) selected @endif>{{ $value->state }}</option>
                    @endforeach
                </select>
            </td>
        </tr>
        <tr>
            <td class="col-md-2" colspan="2">Salaire</td>
            <td><input type="number" name="grossSalary" value="{{$iship->grossSalary}}"/></td>
        </tr>
        @if (isset($remarks))
            <tr>
                <th colspan="3">Remarques</th>
            </tr>
            <tr>
                <td>Date</td>
                <td>Auteur</td>
                <td>Remarque</td>
            </tr>
            <tr id="addRemark">
                <td colspan="3">
                    <button class="btn btn-primary" type="button" onclick="remarks();">Ajouter une remarque</button>
                    <script type="text/javascript">
                        function remarks(){
                            var tr = document.getElementById("addRemark");
                            tr.innerHTML = "<td><input name='remarkDate' type='date' value='{{ date("Y-m-d") }}' required/></td><td><input name='remarkAuthor' type='text' required/></td><td><textarea name='remark'></textarea></td>";
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
                    <td>
                        {{ $value->remarkText }}
                    </td>
                </tr>
            @endforeach
        @endif
        @if (isset($iship->previous_id))
            <tr>
                <td class="col-md-2" colspan="3"><a href="/internships/{{ $iship->previous_id }}/edit">Stage précédent</a></td>
            </tr>
        @endif
    </table>
    {{-- Action buttons --}}
        <a href="/internships/{{$iship->id}}/view">
            <button class="btn btn-danger" type="button">Annuler les modifications</button>
        </a>
        <button class="formSend btn btn-warning" type="submit" onclick="transferDiv();">Valider les modifications</button>
        <script type="text/javascript">
            function transferDiv(){
                var divHtml = document.getElementById("description");
                var txtHtml = document.getElementById("txtDescription");
                txtHtml.value = divHtml.innerHTML;
            }
        </script>
    </form>
@stop