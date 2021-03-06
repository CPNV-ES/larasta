@extends ('layout')
@push ('page_specific_css')
    <link rel="stylesheet" href="/css/visits.css">
@endpush
@section ('content')

    <!-- Page title -->
    <div class="row">
        <div class="col-12">
            <h2>
                Stage de <a
                        href="#">{{$visit->internship->student->firstname}} {{$visit->internship->student->lastname}}</a>
                @ {!! $visit->internship->company->companyName !!}
            </h2>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-6 text-right">
            <h3>Première visite de: <a href="#">{{$classMaster}}</a></h3>
        </div>

        <div class="col-6 text-left">
            <h3>Responsable de stage: <a
                        href="#">{{$visit->internship->responsible->firstname}} {{$visit->internship->responsible->lastname}}</a>
            </h3>
        </div>
    </div>
    <br>

    <!-- Evaluation button for the student and responsible -->
    <div class="row">
        <div class="col-12 text-left ml-md-4">
            @if ($showEvalButton)
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
                        <input disabled id="upddate" name="upddate" class="form-control" type="date" width="50%"
                               value="{{ (new DateTime($visit->moment))->format('Y-m-d') }}"
                               @if($disableDate) readonly @endif>
                    </div>

                    <div class="form-group col-md-5">
                        <label for="updtime">Heure</label>
                        <input disabled id="updtime" name="updtime" class="form-control" type="time"
                               value="{{ (new DateTime($visit->moment))->format('H:i') }}"
                               @if($disableDate) readonly @endif>
                    </div>

                    <div class="form-group col-md-5">
                        <label for="sel">État</label>
                        <select disabled id='sel' name="state" class="form-control" class="hidden hidea">
                            @foreach($visitstates as $state)
                                @if($visitActualStateId == $state->id)
                                    <option value="{{$state->id}}" selected>
                                        {{$state->stateName}}
                                    </option>
                                @else
                                    <option value="{{$state->id}}">
                                        {{$state->stateName}}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    @if($displayGrade)
                        <div class="form-group col-md-5">
                            <label for="grade">Note</label>
                            <input disabled id="grade" name="grade" class="form-control" type="number" step="0.5"
                                   max="6" min="1" @if($visit->grade)value="{{$visit->grade}}" @else value="1"
                                   @endif @if($visitClosed) readonly @endif>
                        </div>
                    @endif

                    <div class="row">
                        @if (Auth::user()->role >= 1)
                            <div class="col-5">
                                <button id="editMode" type="button" class="ml-3 btn-warning show">Editer la visite
                                </button>
                                <button id="up" class="btn-success ml-3 edit" style="display: none;" type="submit">
                                    Enregistrer
                                </button>
                                <button id="cancel" name="cancel" type="reset" class="ml-3 btn-warning edit"
                                        onClick="window.location.reload();" style="display: none;">Annuler
                                </button>
                            </div>
                </form>
            @endif
            <div class="col-2">
                <form method="post" action="/visits/{{$visit->id}}/delete">
                    {{ csrf_field() }}
                    <button type="delete" class="m-1 btn-danger edit" style="display: none;">Supprimer</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-6">
        <h2>Contacts</h2>
        <table class="larastable w-100 my-4">
            <tr>
                <th>Responsable</th>
                <th>Email</th>
                <th>Fixe</th>
                <th>Portable</th>
            </tr>
            <tr>
                <td>
                    Encadrement: <a
                            href="{{ route("person.edit", $visit->internship->responsible->id) }}">{{$visit->internship->responsible->fullname}}</a>
                </td>
                <td id="mailto">{{ $responsible['email'] }}</td>
                <td>{{ $responsible['phone'] }}</td>
                <td>{{ $responsible['mobilePhone'] }}</td>
            </tr>
            <tr>
                <td>RH:
                    <a href="{{ route("person.edit", $visit->internship->admin->id) }}">{{$visit->internship->admin->fullname}}</a>
                </td>
                <td id="mailto">{{ $admin['email'] }}</td>
                <td><span>{{ $admin['phone'] }}</span></td>
                <td><span>{{ $admin['mobilePhone'] }}</span></td>
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
                                <div id="mailcheckbox">Email envoyé le {{$visit->maildate->format('d-m-Y')}} <input
                                            id="checkm" type="checkbox" name="checkm" checked></div>
                            @else
                                <button id="mailbutton" type="submit">Envoyer un email</button>
                                <div id="mailcheckbox" hidden>Envoyé <input id="checkm" type="checkbox" name="checkm">
                                </div>
                            @endif
                        @endif
                    </form>
                </div>
            </div>
        @endif
    </div>

    <br><br>
    <div class="col-12">
        @include ('remarks.remarkslist',['remarks' => $remarks, 'edit' => true, 'remarkOnId' => $visit->id, 'remarkType' => 4])
    </div>

@stop
@push ('page_specific_js')
    <script src="/js/visit.js"></script>
@endpush
