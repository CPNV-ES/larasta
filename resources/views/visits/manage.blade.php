@extends ('layout')
@push ('page_specific_css')
    <link rel="stylesheet" href="/css/visits.css">
@endpush
@section ('content')

    <!-- Page title -->
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
            <h3>Première visite de: <a href="#">{{$classMaster}}</a></h3>
        </div>
        
        <div class="col-6 text-left">
            <h3>Responsable de stage: <a href="#">{{$visit->internship->responsible->firstname}} {{$visit->internship->responsible->lastname}}</a></h3>
        </div>
    </div>
    <br>

    <!-- Evaluation button for the student -->
    <div class="row">
        <div class="col-12 text-left ml-md-4">
            @if (Auth::user()->role == 0 && $visit->visitsstates_id == 2)
                <a href="{{route('visit.evaluation', $visit->id)}}">
                    <button type="button" class="btn btn-warning">Evaluation</button>
                </a>
            @endif
        </div>
    </div>
    <br>

    <!-- Evaluation details & form -->
    <div class="row pt-3 ml-md-2 text-left">
        <div class="col-6">
            <h2 class="ml-2 pb-1">Détails</h2>
            @if (Auth::user()->role >= 1)
                <form method="post" action="/visits/{{$visit->id}}/update">
                {{ csrf_field() }}
                <input type="hidden" name="studentemail" value="{{ $student['email'] }}">
                <input type="hidden" name="studentfirstname" value="{{ $visit->internship->student->firstname }}">
                <input type="hidden" name="studentlastname" value="{{ $visit->internship->student->lastname }}">
                <input type="hidden" name="responsibleemail" value="{{ $responsible['email'] }}">
                <input type="hidden" name="adminemail" value="{{ $admin['email'] }}">
            @endif
            
                <div class="form-group col-md-5">
                        <?php
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
                
            @if (Auth::user()->role >= 1)   
                <div class="row">
                    <p id="info" class="edit" style="display: none;"><span class="text-danger">Veuillez vérifier les données que vous entrez avant de valider la sélection !</span></p>  
                    <div class="col-5"> 
                        <button id="editMode" type="button" class="ml-3 btn-warning show">Editer la visite</button>
                        <button id="up" class="btn-success ml-3 edit" style="display: none;" type="submit">Enregistrer</button>
                        <button id="cancel" name="cancel" type="reset" class="ml-3 btn-secondary edit" onClick="window.location.reload();" style="display: none;">Annuler</button>
                       
                    </div>
            </form>
                    <div class="col-2" style="margin-left: -45px;"> 
                        <form method="post" action="/visits/{{$visit->id}}/delete">
                            {{ csrf_field() }}
                            <button type="delete" class="ml-3 btn-danger edit" style="display: none;">Supprimer</button>
                        </form>
                    </div>
                </div>
            @endif
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
            
            @if (Auth::user()->role >= 1)   
            <div class="row">
                <div class="col-12 ml-5">
                    <form method="post" action="/visits/{{$visit->id}}/sendMail">
                        {{ csrf_field() }}
                        @if($visit->visitsstates_id <= 2 || $visit->visitsstates_id == 4)
                            @if($visit->mailstate == 1)
                                <button id="mailbutton" type="submit" hidden>Envoyer un email</button>
                                <div id="mailcheckbox">Email envoyé le {{$visit->maildate->format('d-m-Y')}} <input id="checkm" type="checkbox" name="checkm" checked></div>
                            @else
                                <button id="mailbutton" type="submit">Envoyer un email</button>
                                <div id="mailcheckbox" hidden>Envoyé <input id="checkm" type="checkbox" name="checkm"></div>
                            @endif  
                        @endif  
                    </form>
                </div> 
            </div>
            @endif

            @if (Auth::user()->role >= 1)
            <div class="row mt-5">
                <div class="col-12 text-left" id="fileUpload" hidden>
                    @include('uploadFile',["route" => route("visit.storeFile", ["id" => $visit->id])])
                    @include('showFile',["route" => "visit.deleteFile", "id" => $visit->id , "medias" => $medias])
                </div>
            </div>
            @endif
        </div>


        
    </div>
    <br><br>
    <div class="row">
        <div class="col-12">
            @include ('remarks.remarkslist',['remarks' => $remarks, 'edit' => true, 'remarkOnId' => $visit->id, 'remarkType' => 4])
        </div>
    </div>

@stop
@push ('page_specific_js')
    <script src="/js/remark.js"></script>
    <script src="/js/visit.js"></script>
@endpush
