@extends ('layout')

@section ('content')
    <h1>Remarques</h1>
    <h3 class="alert-warning">Cette page n'a aucune utilité pratique, mais elle sert de vitrine pour l'ergonomie désirée</h3>
    <button id="btnTest" class="btn-primary">Test Ajax</button>
    @include ('remarks.remarkslist',['remarks' => $remarks])
    <table class="table table-borderless col-md-10">
        <tr>
            <td class="col-md-1">&nbsp;</td>
            <td class="col-md-1">&nbsp;</td>
            <td class="col-md-8 text-left">
                <form method="post" action="/remarks/filter">
                    {{ csrf_field() }}
                    <input type="text" name="needle"/>
                    <input type="submit" value="Rechercher"/>
                </form>
            </td>
        </tr>
    </table>
    <form method="post" action="/remarks/add" class="col-md-10 text-left">
        {{ csrf_field() }}
        <fieldset>
            <legend>Ajouter une remarque</legend>
            <input type="text" name="newremtext"/>
            <input type="submit" value="Ok"/>
        </fieldset>
    </form>
    </div>
@stop

@push('page_specific_js')
    <script src="/js/remarks.js"></script>
@endpush