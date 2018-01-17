
<!--
 * Created by PhpStorm.
 * User: antonio.giordano
 * Date: 09.01.2018
 * Time: 09:11
 -->

@extends ('layout')

@section ('content')
    <div class="container-fluid">
        @if($user->getLevel() >= 2)
            <form method="post" action="/entreprise/{{Request::segment(2)}}/save">
                {{ csrf_field() }}

                <div class="col-lg-offset-10" id="edit">
                    <button type="button" class="btn btn-primary" onclick="edit()">Modification</button>
                    <button type="button" class="btn btn-danger" onclick="remove({{Request::segment(2)}})">Supprimer</button>
                </div>
            <div class="col-lg-offset-10 hidden" id="save">
                <button type="button" class="btn btn-primary" onclick="cancel()">Annuler</button>
                <input type="submit" class="btn btn-primary" onclick="save()" value="Sauvegarder">
                </input>
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
                            <div class="col-lg-6 text-right">
                                Adresse : <br>
                                {{$companie->address1}}
                                {{$companie->address2}}<br>
                                {{$companie->postalCode}},
                                {{$companie->city}}
                            </div>
                            <div class="col-lg-6 text-left">
                                Type de contrat : <br>
                                {{$companie->contractType}}
                            </div>
                            </div>
                            <div class="row">
                                <img style='width:32px;' src='/images/map.png' OnClick='window.location="http://maps.google.com/?q={{$companie->lat}},{{$companie->lng}}"'>
                            </div>
                        </div>
                    @endforeach
                    <div class="row content-box">
                        <div class="col-lg-6 col-lg-offset-3">
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
                    <div class="row content-box text-center">
                        <div class="col-lg-6 col-lg-offset-3">
                            <div class="container-fluid">
                                <div class="table-responsive">
                                    @include ('internships.internshipslist',['iships' => $iships])
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row content-box text-center">
                        <div class="col-lg-6 col-lg-offset-3">
                            <div class="container-fluid">
                                <div class="table-responsive">
                                    @include ('remarks.remarkslist',['remarks' => $remarks])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="body simple-box hidden" id="field">
                    @foreach ($company as $companie)
                        <div class="title row">
                            <h3>{{$companie->companyName}}</h3>
                        </div>
                        <div class="row content-box">
                            <div class="col-lg-6 text-right">
                                Adresse 1 : <input type="text" name="address1" value="{{$companie->address1}}"><br>
                                Adresse 2 : <input type="text" name="address2" value="{{$companie->address2}}"><br>
                                Code postal : <input type="number" name="npa" value="{{$companie->postalCode}}"><br>
                                Ville : <input type="text" name="city" value="{{$companie->city}}">
                            </div>
                            <div class="col-lg-6 text-left">
                                Type de contrat :
                                <select name="ctype">
                                    <option value="3" @if($companie->contracts_id == 3) selected @endif>Entreprise</option>
                                    <option value="4" @if($companie->contracts_id == 4) selected @endif>Etat de Vaud</option>
                                </select>
                            </div>
                        </div>
                    @endforeach
                    <div class="row content-box">
                        <div class="col-lg-6 col-lg-offset-3">
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
                    <div class="row content-box text-center">
                        <div class="col-lg-6 col-lg-offset-3">
                            <div class="container-fluid">
                                <div class="table-responsive">
                                @include ('internships.internshipslist',['iships' => $iships])
                                </div>
                                <div class="row">
                                    <div class="" id="remarkBtn">
                                        <button type="button" value="Ajouter" id="remark" onclick="newRemark()">Nouvelle remarque</button>
                                    </div>
                                    <div class="hidden" id="newRemark">
                                        <input type="text" name="newOne"/><button type="button" value="Ajouter" id="remark" onclick="remarkAdd()">Ajouter</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        @if($user->getLevel() >= 2)
            </form>
        @endif
    </div>


@stop
@section('page_specific_js')
    <script src="/js/entreprise.js"></script>
@stop

