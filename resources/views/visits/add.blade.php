
<h1>Nouvelle visite</h1>
@if($errors->any())
    @foreach ($errors->all() as $error)
        {{ $error }}
    @endforeach
@endif
<div class="col-12">
    <form method="post" action="{{ route( 'visit.create' , [ 'id' => $internship ]) }}">
        {{ csrf_field() }}
        <table class="table text-center larastable">
            <thead>
                <th>N° visite</th>
                <th>Jour</th>
                <th>Heure</th>
            </thead>
            <tbody>
                <tr>
                    <td><input type="number" min="1" name="number" value="1" required/></td>
                    <td><input type="date" name="day"/></td>
                    <td><input type="time" name="hour"/></td>
                </tr>
            </tbody>
        </table>
        <button type="submit">créer</button>
    </form>
</div>