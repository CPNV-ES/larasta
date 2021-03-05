@extends ('layout')
@push ('page_specific_css')
    <link rel="stylesheet" href="/css/visits.css">
@endpush
@section ('content')
    
    <div class="row">
        <div class="col-12">
            <h2>
                <a href="/visits/" class="btn btn-success"><span class="arrow">&lt;</span></a>
                Stage de <a href="#">{{$visit->internship->student->firstname}} {{$visit->internship->student->lastname}}</a> @ {!! $visit->internship->company->companyName !!}
            </h2>
        </div>
    </div>
    
    <div class="row mt-4">
        <div class="col-6 text-right">
            <h3>Première visite de: <a href="#">?</a></h3>

        </div>
        
        <div class="col-6 text-left">
            <h3>Responsable de stage: <a href="#">{{$visit->internship->responsible->firstname}} {{$visit->internship->responsible->lastname}}</a></h3>

        </div>
    </div>
    <br>


    <div class="row pt-3 ml-md-2 text-left">
        <div class="col-6">
            <h2 class="ml-2 pb-1">Détails</h2>
            <form method="post" action="/visits/{{$visit->id}}/update">
                {{ csrf_field() }}
                <input type="hidden" name="studentemail" value="{{ $student['email'] }}">
                <input type="hidden" name="studentfirstname" value="{{ $visit->internship->student->firstname }}">
                <input type="hidden" name="studentlastname" value="{{ $visit->internship->student->lastname }}">
                <input type="hidden" name="responsibleemail" value="{{ $responsible['email'] }}">
                <input type="hidden" name="adminemail" value="{{ $admin['email'] }}">
        
                <div class="form-group col-md-5">
                        <?php
                            //TODO: ok alors
                            $today = date('Y-m-d');
                            $last = (new DateTime($visit->internship->endDate))->format('Y-m-d');
                        ?>
                        <label for="upddate">Date</label>
                        <input disabled id="upddate" name="upddate" class="form-control" type="date" width="50%" min="{{$today}}" value="{{ (new DateTime($visit->moment))->format('Y-m-d') }}">

                </div>

                <div class="form-group col-md-5">
                    <label for="updtime">Heure</label>
                    <input disabled id="updtime" name="updtime" class="form-control" type="time" value="{{ (new DateTime($visit->moment))->format('H:i') }}">
                </div>

                <div class="form-group col-md-5">
                    <label for="grade">Note</label>
                    <input disabled id="grade" name="grade" class="form-control" type="number" step="0.5" max="6" min="1" value="{{ $visit->grade }}">
                </div>

                <div class="form-group col-md-5">
                    <label for="sel">État</label>
                    <select disabled id='sel' name="state" class="form-control" class="hidden hidea">
                        @foreach($visitstate as $state)
                            <option value="{{$state->id}}">
                                {{$state->stateName}}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="row">
                    <div class="col">
                        <p id="info" class="edit" style="display: none;"><span class="text-danger">Veuillez vérifier les données que vous entrez avant de valider la sélection !</span></p>  
                        <button id="up" class="btn-success ml-3 edit" style="display: none;" type="submit">Enregistrer</button>
                        <button id="cancel" class="ml-3 btn-secondary edit" style="display: none;">Annuler</button>
                        <button id="editMode" type="button" class="ml-3 btn-warning show">Editer</button>
                        <button id="edit" class="ml-3 btn-warning edit" style="display: none;">Editer</button>
                        <button class="ml-3 btn-danger edit" style="display: none;">Supprimer</button>
                    </div>
                </div>
            </form>
        </div>

        
        <div class="col-6">
            <h2>Contacts</h2>
            <table class="larastable table table-bordered col-md-12 mt-4">
                <thead>
                    <tr>
                        <td></td>
                        <td>Email</td>
                        <td>Fixe</td>
                        <td>Portable</td>
                    </tr>
                </thead>
                    <tr>
                        <td>
                            {{$visit->internship->responsible->firstname}} {{$visit->internship->responsible->lastname}}
                        </td>
                        <td>
                            <span id="mailto">
                                {{ $responsible['email'] }}
                            </span>
                        </td>
                        <td>
                            <span>
                                {{ $responsible['phone'] }}
                            </span>
                        </td>
                        <td>
                            <span>
                                {{ $responsible['mobilePhone'] }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{$visit->internship->admin->firstname}} {{$visit->internship->admin->lastname}}
                        </td>
                        <td>
                            <span id="mailto">
                                {{ $admin['email'] }}
                            </span>
                        </td>
                        <td>
                            <span>
                                {{ $admin['phone'] }}
                            </span>
                        </td>
                        <td>
                            <span>
                                {{ $admin['mobilePhone'] }}
                            </span>
                        </td>
                    </tr>
                
            </table>
            <div class="row">
                <div class="col-12 ml-5">
                    @if($visit->visitsstates_id <= 2 || $visit->visitsstates_id == 4)
                        <button id="mailbutton" type="button" class="ml-3 mr-5 btn-success hideb" hidden>Envoyer un email</button>
                        <div id="mailcheckbox">Email envoyé le {{$visit->moment->format('d-m-Y')}} <input id="checkm" type="checkbox" name="checkm" checked></div>
                    @else
                        <button id="mailbutton" type="button">Envoyer un email</button>
                        <div id="mailcheckbox" hidden>Envoyé <input id="checkm" type="checkbox" name="checkm"></div>
                    @endif  
                </div> 
            </div>

            <div class="row mt-5">
                <div class="col-12 text-left">
                    @include('uploadFile',["route" => route("visit.storeFile", ["id" => $visit->id])])
                    @include('showFile',["route" => "visit.deleteFile", "id" => $visit->id , "medias" => $medias])
                </div>
            </div>
        </div>


        
    </div>   
    

    <div class="row">
        <div class="col-12">
            
            <h3>Remarques</h3>
            <table class="larastable table table-striped text-left">
                <tbody>
                    <tr>
                        <th colspan="4">Remarques</th>
                    </tr>

                    <tr id="addRemark" hidden="hidden">
                        <td colspan="4">
                            <button id="addNewRemark" class="btn-info" type="button">Ajouter une remarque</button>     
                        </td>  
                    </tr>

                    <tr id="newRemarkForm" style="display: none;">    
                        <form method='post' action='/visits/remarks' class='col-md-12 text-left'> 
                            {{ csrf_field() }}
                            <input type='hidden' name='id' value='{{$visit->id}}'/>
                                <td>
                                    <input type='date' min='{{$today}}' value='{{$today}}' readonly/>
                                </td>
                                <td>
                                    <input type='text' value='{{Auth::user()->initials}}' readonly/>
                                </td>
                                <td>
                                    <textarea name='remark' required cols='100'></textarea>
                                    <button class="btn-success ml-5" type='submit'>Enregister</button>
                                </td>
                        </form>
                    </tr>

                    @foreach($history as $his)
                        <tr>
                            <td>
                                {{ (new DateTime($his->remarkDate))->format('d M Y') }}<br>
                                {{ (new DateTime($his->remarkDate))->format('H:i:s')  }}
                            </td>
                            <td class="text-center">{{ $his->author }}</td>
                            <td>{{ $his->remarkText }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@stop
@push ('page_specific_js')
    <script src="/js/remark.js"></script>
    <script src="/js/visit.js"></script>
@endpush
