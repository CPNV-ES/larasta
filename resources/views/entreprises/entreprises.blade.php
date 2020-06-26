<!--
 * last update : 09.01.2018
 * Update by : antonio.giordano
 * -->

@extends ('layout')

@section ('content')
    <link rel="stylesheet" href="/css/entreprises.css" />
    @if(Auth::user()->role >= 2)
        <br>
        <div class="header container text-left">
            <!--<div class="row">
                <div class="col-md-1 text-left" id="insert">
                    <i class="fa fa-plus-square-o"  id="addCompany"></i>
                </div>
            </div>-->
            <form method="post" class="entrepriseForm" action="/entreprises/add">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="entrepriseName"> Nom de l'entreprise :</label>
                    <input id="entrepriseName" required type="text" class="form-control" name="nameE" placeholder="Entreprise">
                </div>
                <div class="text-right">
                    <button class="btn btn-primary" type="submit">Créer</button>
                </div>
            </form>
        </div>
    @endif
    <div class="row">
        <div class="col-md-1">
            <form method="post" id="ctype" action="/entreprises/filter">
                {{ csrf_field() }}
                <select name="type" id="Ctype">
                    <option value="0">Tous</option>
                    @foreach($contracts as $contract)
                        <option value="{{$contract->id}}" @if(isset($filtr) and $filtr==$contract->id) selected @endif>{{$contract->contractType}}</option>
                    @endforeach
                </select>
            </form>
        </div>
    </div>
    <div class="body">
        <div class="tab-content">
            <table class="table table-bordered table-hover text-left larastable" >
                <tr>
                    <th class="text-center">Entreprises</th>
                    <th class="text-center">Adresse 1</th>
                    <th class="text-center">Adresse 2</th>
                    <th class="text-center">NPA</th>
                    <th class="text-center">Localité</th>
                </tr>
                @foreach ($companies as $company)
                    <tr class="fake-link" data-href="/entreprise/{{$company->id}}">
                        <td>{{ $company->companyName }}</td>
                        <td>{{ $company->address1 }}</td>
                        <td>{{ $company->address2 }}</td>
                        <td>{{ $company->postalCode }}</td>
                        <td>{{ $company->city }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

@stop

@push('page_specific_js')
    <script src="/js/entreprises.js"></script>
@endpush
