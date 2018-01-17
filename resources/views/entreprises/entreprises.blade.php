<!--
 * last update : 09.01.2018
 * Update by : antonio.giordano
 * -->

@extends ('layout')

@section ('content')

<div class="container-fluid">
    @if($user->getLevel() >= 2)


            <div class="header">
                <div class="row">
                    <div class="col-md-1 text-left" id="insert">
                        <img id='plusicon' style='width:16px' alt='+' src='Images/plus.png' onMouseOver='document.body.style.cursor="pointer"' onMouseOut='document.body.style.cursor="default"' OnClick='addE()'/>
                    </div>
                </div>
                <div class="row">
                    <form method="post" action="/entreprises/add">
                        {{ csrf_field() }}
                        <br>
                        <div id="input" class="hidden text-left">
                            <div class="col-md-1">
                                Nom de l'entreprise :
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control" name="nameE">
                            </div>
                            <div class="col-md-1">
                                <input type="submit" class="form-control">
                                <br>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

     @endif
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
                <tr class="clickable-row" data-href="/entreprise/{{$company->id}}">
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
</div>



@stop
@section('page_specific_js')
    <script src="/js/entreprises.js"></script>
@stop
