
<!--
 * User: antonio.giordano
 * Date: 09.01.2018
 -->
<meta name="csrf-token" content="{{ csrf_token() }}">

@extends ('layout')

@section ('content')
@if(session('message'))
    <div class="alert alert-success">
      {{session('message')}}
    </div>
@endif
<div class="container-fluid">
    @if(Auth::user()->role >= 2)
    <form method="post" action="/entreprise/{{Request::segment(2)}}/save">
        {{ csrf_field() }}

        <div class="col-lg-offset-10" id="edit">
            <button type="button" class="btn btn-primary" onclick="edit()">Modification</button>
            <!--<button type="button" class="btn btn-danger" onclick="remove(Request::segment(2))">Supprimer</button> -->
        </div>
        <div class="col-lg-offset-10 hidden" id="save">
            <button type="button" class="btn btn-primary" onclick="cancel()">Annuler</button>
            <button type="submit" class="btn btn-success" onclick="save()">Sauvegarder</button>
        </div>
        <br>
    @endif
    <div class="body simple-box" id="view">
        <div class="title row">
            <h3>{{$company->companyName}}</h3>
        </div>
        <div class="row content-box">
            <div class="row">
                <div class="col-lg-12 col-sm-6 text-left">
                    Adresse : <br>
                    {{$company->location->address1}}@if(isset($company->location->address2)), {{$company->location->address2}} @endif <br>
                    {{$company->location->postalCode}},
                    {{$company->location->city}}
                </div>
                <div class="col-lg-6 col-sm-6 text-left">
                    <div class="row">
                        Type de contrat : {{$company->contract->contractType}}
                    </div>
                    @if(isset($company->website))
                        <div class="row">
                            <a href="{{$company->website}}">Site web</a>
                        </div>
                    @endif
                    @if($company->englishSkills > 0)
                        <div class="row">
                            Bon niveau d'anglais souhaité
                        </div>
                    @endif
                    @if($company->driverLicence > 0)
                        <div class="row">
                            Permis de conduire nécessaire
                        </div>
                    @endif
                    @if($company->mptOk == 0)
                        <div class="row">
                            Pas de candidat en voie matu
                        </div>
                    @endif
                </div>
            </div>
            @if(isset($company->lat))
                <div class="row">
                    <img style='width:32px;' src='/images/map.png' id="maps" OnClick='window.location="http://maps.google.com/?q={{$company->lat}},{{$company->lng}}"'>
                </div>
            @endif
        </div>
        <div class="row content-box">
            <div class="col-lg-8 col-lg-offset-2">
                <h3>Contact</h3>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover text-left larastable">
                        @if(count($contacts) > 0)
                            <tr>
                                <th class="text-center">Personne</th>
                                <th class="text-center">Contact</th>
                            </tr>
                            @foreach($company->people as $person)
                                @if($person->obsolete == 0)
                                    <tr>
                                        <td><a href="{{route("person.show", $person->id)}}"> {{$person->fullName}}</a></td>
                                        <td>
                                            @foreach($contacts as $contact)
                                                @if($contact->firstname == $person->firstname and $contact->lastname == $person->lastname)
                                                    @switch($contact->contacttypes_id)
                                                    @case(1)
                                                    <a href="mailto:{{$contact->value}}"> <img class='icon' src='/Images/mail.png'/>
                                                        {{$contact->value}}<br></a>
                                                    @break
                                                    @case(2)
                                                    <img class='icon' src='/Images/phone.png'/>
                                                    {{$contact->value}}<br>
                                                    @break
                                                    @case(3)
                                                    <img class='icon' src='/Images/smartphone.png'/>
                                                    {{$contact->value}}<br>
                                                    @break
                                                    @endswitch
                                                @endif
                                            @endforeach

                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @else
                            <p>Aucun contact</p>
                        @endif
                    </table>
                </div>
            </div>
        </div>
        <div class="row content-box">
            <div class="col-lg-8 col-lg-offset-2">
                <h3>Stages</h3>
                <div class="table-responsive">
                    @include ('internships._internshipslist',['iships' => $iships]) <br />
                    <br>
                    <a href="/internships/{{$company->id}}/new" class="underline-none">
                        <button type="button" class="btn-success small text-white">Créer un stage</button>
                    </a>
                </div>
            </div>
        </div>
        <div class="row content-box">
            <div class="col-lg-8 col-lg-offset-2">
                <h3>Remarques</h3>
                <div class="table-responsive">
                    @include ('remarks.remarkslist',['remarks' => $remarks])
                </div>
            </div>
        </div>
    </div>
    @if(Auth::user()->role >= 2)
        <div class="body simple-box hidden" id="field">
            <div class="title row">
                <h3>{{$company->companyName}}</h3>
            </div>
            <div class="row content-box">
                <div class="row">
                    <div class="col-lg-6 text-right">
                        Adresse 1 : <input type="text" name="address1" value="{{$company->address1}}"><br>
                        Adresse 2 : <input type="text" name="address2" value="{{$company->address2}}"><br>
                        Code postal : <input type="number" name="npa" value="{{$company->postalCode}}"><br>
                        Ville : <input type="text" name="city" value="{{$company->city}}"><input value="{{$company->location_id}}" name="location_id" hidden>
                    </div>
                    <div class="col-lg-6 col-sm-6 text-left">
                        <div class="row">
                            Type de contrat :
                            <select name="ctype">
                                @foreach($contracts as $contract)
                                    <option value="{{$contract->id}}" @if($company->contracts_id == $contract->id) selected @endif>{{$contract->contractType}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            Site web : <input type="text" name="website" value="{{$company->website}}">
                        </div>
                        <div class="row">
                            <select name="engSkils">
                                <option value=0 @if($company->englishSkills == 0) selected @endif>Anglais non requis</option>
                                <option value=1 @if($company->englishSkills == 1) selected @endif>Bon niveau d'anglais requis</option>
                            </select>
                        </div>
                        <div class="row">
                            <select name="driverLicence">
                                <option value=0 @if($company->driverLicence == 0) selected @endif>Permis de conduire non requis</option>
                                <option value=1 @if($company->driverLicence == 1) selected @endif>Permis de conduire requis</option>
                            </select>
                        </div>
                        <div class="row">
                            <select name="mptOk">
                                <option value=0 @if($company->mptOk == 0) selected @endif>Matu pas OK</option>
                                <option value=1 @if($company->mptOk == 1) selected @endif>Matu OK</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row content-box">
                <div class="col-lg-8 col-lg-offset-2">
                    <h3>Contact</h3>
                    <div class="tab-content">
                        <table class="table table-bordered table-hover text-left larastable">
                            @if(count($contacts) > 0)
                                <tr>
                                    <th class="text-center">Personne</th>
                                    <th class="text-center">Contact</th>
                                </tr>
                                @foreach($company->people as $person)
                                    @if($person->obsolete == 0)
                                        <tr>
                                            <td><a href="{{route("person.show", $person->id)}}"> {{$person->fullName}}</a></td>
                                            <td>
                                                @foreach($contacts as $contact)
                                                    @if($contact->firstname == $person->firstname and $contact->lastname == $person->lastname)
                                                        @switch($contact->contacttypes_id)
                                                            @case(1)
                                                                <a href="mailto:{{$contact->value}}"> <img class='icon' src='/Images/mail.png'/>
                                                                {{$contact->value}}<br></a>
                                                            @break
                                                            @case(2)
                                                                <img class='icon' src='/Images/phone.png'/>
                                                                {{$contact->value}}<br>
                                                            @break
                                                            @case(3)
                                                                <img class='icon' src='/Images/smartphone.png'/>
                                                                {{$contact->value}}<br>
                                                            @break
                                                        @endswitch
                                                    @endif
                                                @endforeach
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @else
                                 <p>Aucun contact</p>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
            <div class="row content-box">
                <div class="col-lg-8 col-lg-offset-2">
                    <h3>Remarques</h3>
                    <div class="table-responsive">
                        @include ('remarks.remarkslist',['remarks' => $remarks])
                    </div>
                    <div class="row">
                        <div class="" id="remarkBtn">
                            <button type="button" value="Ajouter" id="remark">Nouvelle remarque</button>
                        </div>
                        <div class="hidden" id="newRemark">
                            <input value="{{Request::segment(2)}}" id="id" hidden>
                            <input value="{{$user->initials}}" id="initials" hidden>
                            <input value="{{(new DateTime(now()))->format('d.M.y')}}" id="date" hidden>
                            <input type="text" name="newOne" id="remarksText"/>
                            <button type="button" value="Ajouter"  onclick="remarkAdd()">Ajouter</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
     @endif
</div>

@stop
@push('page_specific_js')
    <script src="/js/entreprise.js"></script>
@endpush

