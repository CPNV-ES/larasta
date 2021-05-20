@push ('page_specific_js')
    <script src="/js/visitsList.js"></script>
@endpush
<table class="table table-bordered col-md-12 larastable">
    <tr>
        <th>N°</th>
        <th>Date et heure</th>
        <th>Etat</th>
        <th>Note</th>
    </tr>
    @foreach ($visits as $visit)
        <tr class="visit-details in_place_click" data-visitid="{{$visit->id}}">
            <td class="w-25">{{ $visit->number }}</td>
            <td class="w-25">{{ strftime("%e %b %g %R", strtotime($visit->moment)) }}</td>
            <td class="w-25">{{ $visit->visitsstate->stateName }}</td>
            <td class="w-25">{{ $visit->grade == "" ? "Pas de note" : $visit->grade }}</td>
        </tr>
    @endforeach
</table>