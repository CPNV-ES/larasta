
<h1>Créer une nouvelle visite</h1>
<div class="container">
    <div class="col-md-4 col-md-offset-4">
        <form method="post" action="{{ route( 'InternshipsAddVisit' , [ 'iid' => $internship ]) }}">
            {{ csrf_field() }}
            <table>
                <thead>
                    <th>N° visite</th>
                    <th>Mail envoyé?</th>
                    <th>Confirmé?</th>
                    <th>Note</th>
                    <th>État de la visite</th>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="number" min="1" name="number"/></td>
                        <td><input type="checkbox" name="mailstate" /></td>
                        <td><input type="checkbox" name="confirmed" /></td>
                        <td><input type="number" min="1" max="6" name="grade"/></td>
                        <td>
                            <select name="visitestate_id">
                                @foreach ($visitsStates as $visitstate)
                                    <option value="{{$visitstate->id}}">{{ $visitstate->stateName }}</option>                                    
                                @endforeach
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
</div>