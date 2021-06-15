<!--
/**
 * Created by PhpStorm.
 * User: Davide
 * Date: 14/01/2018
 * Time: 18:56

 * !!!! IMPORTANT !!!!
 * ONLY FOR TEACHER ROLE
 * If you want have all contacts informations for teacher -> do nothing
 * If you want have nothing information for teacher so go to the STEP by STEP procedure
 * STEP by STEP: folow the step procedure starting in the Step 1
 * After finished go to PeopleController and follow the same procedure
 */
-->

@extends ('layout')

@section ('content')
    <link rel="stylesheet" href="/css/people.css"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <!--------------------->
    <!-- Section Header --->
    <!--------------------->

    <div class="body simple-box text-left" id="view">
        <!-- FirstName and LastName -->

        <div id="people_Name">
            <span>{{ $person->fullName }}</span>
        @if ((Auth::user()->role >= 2))  <!-- View button only for teacher -->
            <button id="btn-add-section" name="btn-add-section" data-toggle="modal" data-target="#peopleModal" class="btn-warning people-btn_desactive">Modifier</button>
            @endif
        </div>

        <div class="row">
            @if (isset($person->company->companyName))
                <h5 class="titlebar">Entreprise / Etablissement</h5>
                <div>{{ $person->company->companyName }}</div>
                <form id="frmCompany" method="post" action="/people/changeCompany" class="popupfield">
                    {{ csrf_field() }}
                    <input type="hidden" name="peopleid" value="{{ $person->id }}">
                    <label for="dpdCompany">Changer à </label>
                    <select id="dpdCompany" name="dpdCompany" value="$person->company->id">
                        @foreach($companies as $company)
                            @if($company->id == $person->company->id)
                                <option value="{{ $company->id }}" selected>{{ $company->companyName }}</option>
                            @else
                                <option value="{{ $company->id }}">{{ $company->companyName }}</option>
                            @endif
                        @endforeach
                    </select>
                </form>
            @endif
        </div>

        <h5 class="titlebar">Contact</h5>

        <div id="people_Info" class="row text-left">

            @if (isset($adress->address1))
                <div>
                    <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
                    <span>{{ $adress->address1 }}</span>
                    @if ($adress->address2 != null)
                        <span>{{ $adress->address2 }} - </span>
                    @endif
                    <span>{{ $adress->postalCode }} - </span>
                    <span>{{ $adress->city }}</span>
                    <!-- If google maps lat and long is not available do not display link -->
                    @if( ($adress->lat != null) && ($adress->lng != null))
                        <a href="http://maps.google.com/?q={{$adress->lat}},{{$adress->lng}}">[Google Maps]</a>
                    @endif
                </div>
            @endif

        <!-- Contacts -->

            @foreach($contacts as $contact)      <!-- View all contacts for one people -->
            <div class="fa fa-{{ $contact->icon }} col-md-1 text-right smallpadding"></div>
            <div class="col-md-3 text-left smallpadding">{{ $contact->value }}</div>
            <div class="col-md-8 text-left smallpadding">&nbsp;
                <form method="post" action="/contact/delete" class="popupfield col-md-2">
                    {{ csrf_field() }}
                    <input type="hidden" name="peopleid" value="{{ $person->id }}">
                    <input type="hidden" name="delid" value="{{ $contact->id }}">
                    <button class="btn-danger" type="submit">Supprimer</button>
                </form>
            </div>
            <br>
            @endforeach
            <form method="post" action="/contact/add" class="col-md-10 text-left popupfield">
                {{ csrf_field() }}
                <input type="hidden" name="peopleid" value="{{ $person->id }}">
                <fieldset>
                    <input type="text" name="newcontact" id="newcontact"/>
                    @foreach($contacttypes as $contacttype)
                        <label for="ctype{{ $contacttype->id }}">{{ $contacttype->contactTypeDescription }}</label>
                        <input id="ctype{{ $contacttype->id }}" type="radio" name="contacttype" value="{{ $contacttype->id }}">
                    @endforeach
                    <button id="cmdAdd" class="btn-success hidden" type="submit">Ajouter</button>
                </fieldset>
            </form>

        </div>

        <h5 class="titlebar">Stages</h5>
        @include ('internships._internshipslist',['iships' => $iships])

        @include ('remarks.remarkslist',['remarks' => $remarks, 'edit' => true, 'remarkOnId' => $person->id, 'remarkType' => 2])

    </div>
@stop

@section ('page_specific_js')
    <script src="/js/people.js"></script>
@stop