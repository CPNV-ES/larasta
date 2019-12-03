
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
    @if($user->getLevel() >= 2)
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
        @foreach ($company as $companie)
            <div class="title row">
                <h3>{{$companie->companyName}}</h3>
            </div>
            <div class="row content-box">
                <div class="row">
                    <div class="col-lg-6 col-sm-6 text-right">
                        Adresse : <br>
                        {{$companie->address1}}@if(isset($companie->address2)), {{$companie->address2}} @endif <br>
                        {{$companie->postalCode}},
                        {{$companie->city}}
                    </div>
                    <div class="col-lg-6 col-sm-6 text-left">
                        <div class="row">
                            Type de contrat : {{$companie->contractType}}
                        </div>
                        @if(isset($companie->website))
                            <div class="row">
                                <a href="{{$companie->website}}">Site web</a>
                            </div>
                        @endif
                        @if($companie->englishSkills > 0)
                            <div class="row">
                                Bon niveau d'anglais souhaité
                            </div>
                        @endif
                        @if($companie->driverLicence > 0)
                            <div class="row">
                                Permis de conduire nécessaire
                            </div>
                        @endif
                        @if($companie->mptOk == 0)
                            <div class="row">
                                Pas de candidat en voie matu
                            </div>
                        @endif
                    </div>
                </div>
                @if(isset($companie->lat))
                    <div class="row">
                        <img style='width:32px;' src='/images/map.png' id="maps" OnClick='window.location="http://maps.google.com/?q={{$companie->lat}},{{$companie->lng}}"'>
                    </div>
                @endif
            </div>
        @endforeach
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
                            @foreach($persons as $person)
                                @if($person->obsolete == 0)
                                    <tr>
                                        <td><a href="/listPeople/{{$person->id}}/info"> {{$person->firstname}} {{$person->lastname}}</a></td>
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
                    @include ('internships.internshipslist',['iships' => $iships])
                </div>
            </div>
            <div class="col-lg-8 col-lg-offset-2 ">
            <br>
            @foreach ($company as $companies)
                <a href="/internships/{{$companies->id}}/new" class="underline-none">
                    <button class="btn-success small text-white" onclick="this.disabled=true">Créer une stage</button>
                </a>
            @endforeach
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
    @if($user->getLevel() >= 2)
        <div class="body simple-box hidden" id="field">
            @foreach ($company as $companie)
                <div class="title row">
                    <h3>{{$companie->companyName}}</h3>
                </div>
                <div class="row content-box">
                    <div class="row">
                        <div class="col-lg-6 text-right">
                            Adresse 1 : <input type="text" name="address1" value="{{$companie->address1}}"><br>
                            Adresse 2 : <input type="text" name="address2" value="{{$companie->address2}}"><br>
                            Code postal : <input type="number" name="npa" value="{{$companie->postalCode}}"><br>
                            Ville : <input type="text" name="city" value="{{$companie->city}}"><input value="{{$companie->location_id}}" name="location_id" hidden>
                        </div>
                        <div class="col-lg-6 col-sm-6 text-left">
                            <div class="row">
                                Type de contrat :
                                <select name="ctype">
                                    @foreach($contracts as $contract)
                                        <option value="{{$contract->id}}" @if($companie->contracts_id == $contract->id) selected @endif>{{$contract->contractType}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">
                                Site web : <input type="text" name="website" value="{{$companie->website}}">
                            </div>
                            <div class="row">
                                <select name="engSkils">
                                    <option value=0 @if($companie->englishSkills == 0) selected @endif>Anglais non requis</option>
                                    <option value=1 @if($companie->englishSkills == 1) selected @endif>Bon niveau d'anglais requis</option>
                                </select>
                            </div>
                            <div class="row">
                                <select name="driverLicence">
                                    <option value=0 @if($companie->driverLicence == 0) selected @endif>Permis de conduire non requis</option>
                                    <option value=1 @if($companie->driverLicence == 1) selected @endif>Permis de conduire requis</option>
                                </select>
                            </div>
                            <div class="row">
                                <select name="mptOk">
                                    <option value=0 @if($companie->mptOk == 0) selected @endif>Matu pas OK</option>
                                    <option value=1 @if($companie->mptOk == 1) selected @endif>Matu OK</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
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
                                @foreach($persons as $person)
                                    @if($person->obsolete == 0)
                                        <tr>
                                            <td><a href="/listPeople/{{$person->id}}/info"> {{$person->firstname}} {{$person->lastname}}</a></td>
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
                            <input value="{{$user->getInitials()}}" id="initials" hidden>
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
@section('page_specific_js')
    <script src="/js/entreprise.js"></script>
@stop

