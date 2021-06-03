@push ('page_specific_css')
    <link rel="stylesheet" href="/css/visits.css">
@endpush
<table class="larastable table table-striped">
    <thead class="thead-inverse">
    <tr class="d-flex fake-link">
        <th class="col-3">Nom</th>
        <th class="col-2">Prénom</th>
        <th class="col-2">Entreprise</th>
        <th class="col-1">Date</th>
        <th class="col-1">Heure</th>
        <th class="col-1">Etat de la visite</th>
        <th class="col-1">Email</th>
        <th class="col-1">Note</th>
    </tr>
    </thead>
    <tbody>
    @foreach($visits as $visit)
        <tr class="d-flex fake-link text-left" data-href="/visits/{{$visit->id}}/manage">
            <td class="col-3">{{ $visit->internship->student->firstname }}</td>
            <td class="col-2">{{ $visit->internship->student->lastname }}</td>
            <td class="col-2">{!! $visit->internship->company->companyName !!}</td>
            <td class="col-1 text-center">{{ (new DateTime($visit->moment))->format('d M Y') }}</td>
            <td class="col-1 text-center">{{ (new DateTime($visit->moment))->format('H:i:s') }}</td>
            <td class="col-1">{{ $visit->visitsstate->stateName }}</td>
            <td class="col-1 text-center">
                @if($visit->mailstate == 1)
                    <span class="ok glyphicon glyphicon-ok tick"></span>
                @endif
            </td>
            <td class="col-1">
                {{$visit->grade}}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>