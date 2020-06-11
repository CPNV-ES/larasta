{{-- Subview to list remarks --}}
{{-- Usage:     @include ('remarks.remarkslist',['remarks' => $your_array_of_remarks])  --}}
<table class="table table-bordered col-md-10 larastable remarksTable">
    <tr>
        <th class="col-md-1">Date</th>
        <th class="col-md-1">Auteur</th>
        <th class="col-md-8">Contenu</th>
    </tr>
    <tbody>
    @foreach($remarks as $remark)
        <tr class="fake-link" data-href="/remarks/{{ $remark->id }}/edit">
            <td class="col-md-1">{{ (new DateTime($remark->remarkDate))->format('d.M.y') }}</td>
            <td class="col-md-1">{{ $remark->author }}</td>
            <td class="col-md-8 text-left">{{ $remark->remarkText }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
