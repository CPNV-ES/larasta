@push ('page_specific_css')
    <link rel="stylesheet" href="/css/visits.css">
@endpush
<table class="larastable w-100">
    <thead class="thead-inverse">
    <tr>
        <th class="small-col"></th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Entreprise</th>
        <th>Date</th>
        <th>Heure</th>
        @if($displayState)
        <th>Etat de la visite</th>
        @endif
        <th>Email</th>
        <th>Note</th>
    </tr>
    </thead>
    <tbody>
    @foreach($visits as $visit)
        <tr class="fake-link text-left {{ $visit->needs_attention ? 'attention_needed' : '' }}" title="{{$visit->needed_attention_reason}}" data-href="/visits/{{$visit->id}}/manage">
            <td class="small-col">
                @if($visit->needs_attention)
                    <img class='icon' src='/images/alert.svg'/>
                @endif
            </td>
            <td>{{ $visit->internship->student->firstname }}</td>
            <td>{{ $visit->internship->student->lastname }}</td>
            <td>{!! $visit->internship->company->companyName !!}</td>
            <td>{{ (new DateTime($visit->moment))->format('d M Y') }}</td>
            <td>{{ (new DateTime($visit->moment))->format('H:i:s') }}</td>
            @if($displayState)
            <td>{{ $visit->visitsstate->stateName }}</td>
            @endif
            <td >
                @if($visit->mailstate == 1)
                    <span class="ok glyphicon glyphicon-ok tick"></span>
                @endif
            </td>
            <td>
                {{$visit->grade}}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>