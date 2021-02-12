@extends ('layout')
@push ('page_specific_css')
    <link rel="stylesheet" href="/css/visits.css">
@endpush
@section ('content')
    {{-- Link to intern's profile--}}
    <h3 class="test">
        <a href="/visits/" class="btn btn-success"><span class="arrow">&lt;</span></a> Visite de stage n°{{$visit->id}} de <a href="#">{{$visit->internship->student->lastname}}, {{$visit->internship->student->firstname}}</a></h3>
    <br>
    <form method="post" action="/visits/{{$visit->id}}/update" class="text-left">
        {{ csrf_field() }}
        <table class="larastable table table-bordered">
            <tr>
                <th>Prénom de l'élève</th>
                <th>Nom de l'élève</th>
                <th>Entreprise</th>
                <th>Date de la visite</th>
                <th>Heure de la visite</th>
                <th>Note</th>
                <th>Date de début de stage</th>
                <th>Date de fin de stage</th>
                <th>Email</th>
                <th>Etat de la visite</th>
            </tr>
            <tr>
                <td id="studentFirstName">{!! $visit->internship->student->firstname !!}</td>
                <td id="studentLastName">{!! $visit->internship->student->lastname !!}</td>
                <td id="companyName">{!! $visit->internship->company->companyName !!}</td>
                <td>
                    <div id="vdate" class="hideb">
                        {{ (new DateTime($visit->moment))->format('d.m.Y') }}
                    </div>
                    <fieldset>
                        <div id="dateedit" class="hidden hidea">
                            <?php
                                //TODO: ok alors
                                $today = date('Y-m-d');
                                $last = (new DateTime($visit->internship->endDate))->format('Y-m-d');
                            ?>
                            <input type="date" name="upddate" min="{{$today}}" value="{{ (new DateTime($visit->moment))->format('Y-m-d') }}">
                        </div>
                    </fieldset>
                </td>
                <td>
                    <div id="vhour" class="hideb">
                        {{ (new DateTime($visit->moment))->format('H:i:s') }}
                    </div>
                    <div id="houredit" class="hidden hidea">
                        <input type="time" name="updtime" value="{{ (new DateTime($visit->moment))->format('H:i') }}">
                    </div>
                </td>
                <td>
                    {{ $visit->grade }}
                    <input type="number" step="0.5" name="grade" max="6" min="1" value="{{ $visit->grade }}">
                </td>
                <td>{{ (new DateTime($visit->internship->beginDate))->format('d.m.Y') }}</td>
                <td>{{ (new DateTime($visit->internship->endDate))->format('d.m.Y') }}</td>
                <td>
                    @if($visit->mailstate == 1)
                        <button id="mailbutton" type="button" hidden>Envoyer un email</button>
                        <div id="mailcheckbox">Envoyé <input id="checkm" type="checkbox" name="checkm" checked></div>
                    @else
                        <button id="mailbutton" type="button">Envoyer un email</button>
                        <div id="mailcheckbox" hidden>Envoyé <input id="checkm" type="checkbox" name="checkm"></div>
                    @endif     
                </td>
                <td>
                    <span id="staid" class="hideb">{{ $visit->visitsstate->stateName }}</span>
                    <select id='sel' name="state" class="hidden hidea">
                        @foreach($visitstate as $state)
                            <option value="{{$state->id}}">
                                {{$state->stateName}}
                            </option>
                        @endforeach
                    </select>
                </td>
            </tr>
        </table>
        <div>
            <p id="info" class="hidden hidea"><span class="text-danger">Veuillez vérifier les données que vous entrez avant de valider la sélection !</span></p>
            <button id="up" class="btn-info hidden hidea" type="submit">Enregistrer</button>
            <button id="cancel_a" type="button" class="btn-info hidden hidea">Annuler</button>
        </div>
    </form>

    @if($visit->visitsstates_id <= 2 || $visit->visitsstates_id == 4)
        <button id="edit" class="btn-info hideb">Editer</button>
        <button id="bmail" class="btn-success hideb">Envoyer un e-mail</button>{{-- Link to evaluation--}}
    @endif
    <div class="text-left">
        <p id="pdone" class="hidden done hidea">Supprimer la visite de stage <span class="text-danger">Irréversible !</span></p>
        <a id="del" class="hidden hidea" href="/visits/{{ $visit->id }}/delete">
            <button class="btn-danger">Supprimer</button>
        </a>
    </div>
    <br><br>
    <div>
        {{-- Responsible table info --}}
        <table class="larastable table table-bordered col-md-12">
            <tr>
                <th class="col-md-5">email du responsable</th>
                <th class="col-md-3">numéro de téléphone direct</th>
                <th class="col-md-4">numéro de téléphone portable</th>
            </tr>
            <tr class="text-left">
                <td class="col-md-5">
                    <span id="mailto">
                        {{ $responsible['email'][0]->value }} | {{ $responsible['phone'][1]->value }}
                    </span>
                </td>
                <td class="col-md-3">
                    <span>

                    </span>
                </td>
                <td class="col-md-4">
                    <span>

                    </span>
                </td>
            </tr>
        </table>
        @include('uploadFile',["route" => route("visit.storeFile", ["id" => $visit->id])])
        @include('showFile',["route" => "visit.deleteFile", "id" => $visit->id , "medias" => $medias])
            <form method="post" action="/visits/remarks" class="col-md-12 text-left">
                {{ csrf_field() }}
                <fieldset>
                    <legend>Ajouter une remarque</legend>
                    <textarea type="text" name="remark"></textarea>
                    <input type="hidden" name="id" value="{{$visit->id}}"/>
                    <input type="submit" value="Ok"/>
                </fieldset>
            </form>
        <br>
        <h3>Remarques</h3>
        <table class="larastable table table-striped text-left">
            <thead class="thead-inverse">
            <tr>
                <th>Date</th>
                <th>Créateur</th>
                <th>Description</th>
            </tr>
            </thead>
            <tbody>
                @foreach($history as $his)
                    <tr>
                        <td class="col-md-1">
                            {{ (new DateTime($his->remarkDate))->format('d M Y') }}<br>
                            {{ (new DateTime($his->remarkDate))->format('H:i:s')  }}
                        </td>
                        <td class="col-md-1 text-center">{{ $his->author }}</td>
                        <td class="col-md-8">{{ $his->remarkText }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop
@push ('page_specific_js')
    <script src="/js/remark.js"></script>
    <script src="/js/visit.js"></script>
@endpush
