@extends ('layout')

@section ('content')
    <h1>Remarque</h1>
    <form id='textedit' method="post" action="/remarks/update">
        {{ csrf_field() }}
        <table class="table table-bordered col-md-8">
            <tr>
                <th class="col-md-2">Date</th>
                <td class="col-md-6 text-left">{{ (new DateTime($remark->remarkDate))->format('d.M.y') }}</td>
            </tr>
            <tr>
                <th class="col-md-2">Auteur</th>
                <td class="col-md-6 text-left">{{ $remark->author }}</td>
            </tr>
            <tr>
                <td class="col-md-8 text-left" colspan="2">
                    <div id="remdisplay">{{ $remark->remarkText }}</div>
                    <div id="remedit" class="hidden">
                        <input type="hidden" name="updid" value="{{ $remark->id }}">
                        <input type="text" name="updtext" value="{{ $remark->remarkText }}">
                        <button class="btn-info" type="submit">Enregistrer</button>
                    </div>
                </td>
            </tr>
        </table>
    </form>
    <form method="post" action="/remarks/delete" class="col-md-2">
        {{ csrf_field() }}
        <input type="hidden" name="delid" value="{{ $remark->id }}">
        <button class="btn-danger" type="submit">Supprimer</button>
    </form>
    <button id="cmdedit" class="btn-info col-md-2">Editer</button>
@stop

@push ('page_specific_js')
    <script src="/js/remark.js"></script>
@endpush