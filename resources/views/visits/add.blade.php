
<h1>Créer une nouvelle visite</h1>
@if($errors->any())
    @foreach ($errors->all() as $error)
        {{ $error }}
    @endforeach
@endif
<div class="container">
    <div class="col-md-4 col-md-offset-4">
        <form method="post" action="{{ route( 'visite.create' , [ 'id' => $internship ]) }}">
            {{ csrf_field() }}
            <table>
                <thead>
                    <th>N° visite</th>
                    <th>Jour</th>
                    <th>Heure</th>
                    <th>Mail envoyé?</th>
                    <th>Confirmé?</th>
                    <th>Note</th>
                    <th>État de la visite</th>
                    <th>Créer</th>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="number" min="1" name="number" value="1" required/></td>
                        <td><input type="date" name="day"/></td>
                        <td><input type="time" name="hour"/></td>
                        <td><input type="checkbox" name="mailstate"/></td>
                        <td><input type="checkbox" name="confirmed"/></td>
                        <td><input type="number" min="1" max="6" step="0.5" name="grade" value="1" required/></td>
                        <td>
                            <select name="visitsstates_id" required>
                                @foreach ($visitsStates as $visitstate)
                                    <option value="{{$visitstate->id}}">{{ $visitstate->stateName }}</option>                                    
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <button type="submit">créer</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
</div>