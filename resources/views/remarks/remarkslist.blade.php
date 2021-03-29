{{-- Subview to list remarks --}}
{{-- Usage:     @include ('remarks.remarkslist',['remarks' => $your_array_of_remarks])  --}}
@if(Auth::user()->role >= 1)
<form action="/remarks/create" method="get">
@endif
@csrf
<input type="hidden" name="remarkType" value="{{ $remarkType ?? ''  }}" />
<input type="hidden" name="remarkOn_id" value="{{ $remarkOnId ?? '' }}" />
<table class="table table-bordered col-md-12 larastable remarksTable">
    <tr>
        <th colspan="4">Remarques</th>
    </tr>
    <tbody>
    @if(Auth::user()->role >= 1)
    @if($edit ?? false)
    <tr id="newRemarkBtnRow" hidden>
        <td colspan="4">
            <button class="btn btn-primary" id="addRemarkBtn" type="button">Ajouter une remarque</button>
        </td>
    </tr>
    <tr id="newRemarkFormRow" hidden>
        <td>
            <input name='remarkDate' type='date' value='{{ date("Y-m-d") }}' readonly required/>
        </td>
        <td>
            <input name='remarkAuthor' type='text' value='{{ Auth::user()->initials }}' readonly required/>
        </td>
        <td>
            <textarea name='remarkBody' required cols='100'></textarea>
        </td>
        <td>
            <button class='btn btn-warning' type='submit'>Valider la remarque</button>
        </td>
    </tr>
    @endif
    @endif

    @foreach($remarks as $remark)
            <td style="white-space: nowrap">{{ (new DateTime($remark->remarkDate))->format('d M y') }}</td>
            <td style="white-space: nowrap">{{ $remark->author }}</td>
            <td colspan="2">{{ $remark->remarkText }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

</form>

@push('page_specific_js')
    <script src="/js/remarkslist.js"></script>
@endpush

@if(Auth::user()->role >= 1)
</form>
@endif
