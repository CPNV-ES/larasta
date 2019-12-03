{{--
Bastien Nicoud
Evaluation grid layout

This view loop over all the evaluation sections and display it
Then he loop over the section criterias and display the right fields dependig of your role or your mode

This view requires :
$gridID
$evaluationContext
$evalGrid
$mode
$level
(see the controller for more infos)
--}}


@extends ('layout')

@section ('page_specific_css')
    <link rel="stylesheet" href="/css/evalgrid.css">
@stop

@section ('content')

<div id="evaluation-grid" class="container">

    <h1>Grille d'évaluation de stage :</h1>

    {{--  Contains all the grid  --}}
    <div class="grid">

        {{--  Display the eventual validation errors  --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{--  This first table display the context of the evaluation (Internsip dates and actors)  --}}
        <table class="table table-responsive table-bordered">
            <thead>
                <tr>
                    <th colspan="6">Informations générales</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="gridform w25">Dates du stage</td>
                    <td class="gridform w25">Du {{ $evaluationContext->visit->internship->beginDate->format('d-m-Y') }} au {{ $evaluationContext->visit->internship->endDate->format('d-m-Y') }}</td>
                    <td class="gridform w12">Date de la visite</td>
                    <td class="gridform w12">{{ $evaluationContext->visit->moment->format('d-m-Y H:i') }}</td>
                    <td class="gridform w12">Numéro de visite</td>
                    <td class="gridform w12">{{ $evaluationContext->visit->number }}</td>
                </tr>
                <tr>
                    <td>Nom et prénom du stagiaire</td>
                    <td>{{ $evaluationContext->visit->internship->student->full_name }}</td>
                    <td colspan="2">Nom du responsable de suivi du stagiaire (interne)</td>
                    <td colspan="2">{{ $evaluationContext->visit->internship->student->flock->classMaster->full_name }}</td>
                </tr>
                <tr>
                    <td>Nom de la companie</td>
                    <td>{{ $evaluationContext->visit->internship->company->companyName }}</td>
                    <td colspan="2">Nom du responsable de suivi du stagiaire (externe)</td>
                    <td colspan="2">{{ $evaluationContext->visit->internship->responsible->full_name }}</td>
                </tr>
                <tr>
                    <td colspan="6">L’ensemble de la procédure d’évaluation se fait en présence de toutes les parties prenantes ! (stagiaire & responsables interne et externe du suivi)</td>
                </tr>
            </tbody>
        </table>



        {{--  ---------------------------------------  --}}
        {{--  List all the sections of the evaluation  --}}
        <form action="/evalgrid/grid/save/{{ $gridID }}" method="POST">

            {{ csrf_field() }}

            @foreach ($evalGrid as $evalSection)

                <table class="table table-responsive table-bordered">

                    {{--  Generates the right layout according to the sectionType  --}}



                    {{--  --------------  --}}
                    {{--  SECTION TYPE 1  --}}
                    @if ($evalSection->sectionType == 1)

                        <thead>

                            <tr>
                                <th class="gridform w20"><p>{{ $evalSection->sectionName }} :</p></th>
                                <th class="gridform w20">Observations attendues</th>
                                <th class="gridform w10">Points</th>
                                <th class="gridform w50">Remarques personnalisées</th>
                            </tr>

                        </thead>

                        <tbody>

                            {{--  Display all the section criterias  --}}
                            @foreach ($evalSection->criterias as $criteria)

                                <tr>
                                    <td>{{ $criteria->criteriaName }}</td>
                                    <td>{{ $criteria->criteriaDetails }}</td>

                                    @if ($mode == 'readonly')

                                        <td>
                                            <p
                                                class="gradeinput"
                                                data-max-grade="{{ $criteria->maxPoints }}"
                                                data-section-id="{{ $criteria->evaluationSection_id }}">
                                                {{ $criteria->criteriaValue->points }}
                                            </p>
                                            <small> / {{ $criteria->maxPoints }}</small>
                                        </td>
                                        <td>{{ $criteria->criteriaValue->managerComments }}</td>

                                    @elseif ($mode == 'edit')

                                        {{--  Display the inputs depending the user level  --}}
                                        @if ($level >= 0)

                                            {{--  For each fiels we create a name with the criteria id, and fill the value from the DB or from the old inpuf if the form is reloaded (after a validation fails)  --}}
                                            {{--  The data-max is used by the js to verifiy and display a live average of the grades  --}}
                                            <td>
                                                <input
                                                    class="evalgrid input gradeinput"
                                                    type="number"
                                                    step="0.05"
                                                    max="{{ $criteria->maxPoints }}"
                                                    data-max-grade="{{ $criteria->maxPoints }}"
                                                    data-section-id="{{ $criteria->evaluationSection_id }}"
                                                    name="{{ $criteria->criteriaValue->id }}[grade]"
                                                    value="{{ old($criteria->criteriaValue->id . '.grade') ? old($criteria->criteriaValue->id . '.grade') : $criteria->criteriaValue->points }}">
                                                <p><small> / {{ $criteria->maxPoints }}</small></p>
                                            </td>
                                            <td>
                                                <textarea class="evalgrid textarea" name="{{ $criteria->criteriaValue->id }}[mComm]">
                                                    {{ old($criteria->criteriaValue->id . '.mComm') ? old($criteria->criteriaValue->id . '.mComm') : $criteria->criteriaValue->managerComments }}
                                                </textarea>
                                            </td>

                                        @else

                                            <td>
                                                <p
                                                    class="gradeinput"
                                                    data-max-grade="{{ $criteria->maxPoints }}"
                                                    data-section-id="{{ $criteria->evaluationSection_id }}">
                                                    {{ $criteria->criteriaValue->points }}
                                                </p>
                                                <small> / {{ $criteria->maxPoints }}</small>
                                            </td>
                                            <td>{{ $criteria->criteriaValue->managerComments }}</td>

                                        @endif
                                        
                                    @endif
                                </tr>

                            @endforeach

                            <tr>
                                <td colspan="2"><strong>Note pour les {{ $evalSection->sectionName }} :</strong></td>
                                {{--  data-grades is used to transmit to the js the number of grades in the section (to calculate the avg)  --}}
                                <td><p class="evalgrid"><strong class="evalgrid-grade" data-section-id="{{ $evalSection->id }}"></strong><small> / 6</small></p></td>
                                <td></td>
                            </tr>

                        </tbody>




                    {{--  --------------  --}}
                    {{--  SECTION TYPE 2  --}}
                    @elseif ($evalSection->sectionType == 2)

                        <thead>

                            <tr>
                                <th class="gridform w25">{{ $evalSection->sectionName }} :</th>
                                <th class="gridform w25">Taches :</th>
                                <th class="gridform w25">Remarque du responsable de stage</th>
                                <th class="gridform w25">Remarque du stagiaire</th>
                            </tr>

                        </thead>

                        <tbody>

                            {{--  Display all the section criterias  --}}
                            @foreach ($evalSection->criterias as $criteria)

                                <tr>
                                    <td>{{ $criteria->criteriaName }}</td>

                                    @if ($mode == 'readonly')

                                        <td>{{ $criteria->criteriaValue->contextSpecifics }}</td>
                                        <td>{{ $criteria->criteriaValue->managerComments }}</td>
                                        <td>{{ $criteria->criteriaValue->studentComments }}</td>

                                    @elseif ($mode == 'edit')

                                        {{--  Display the inputs depending the user level  --}}
                                        @if ($level > 0)
                                            <td>
                                                <textarea class="evalgrid textarea" name="{{ $criteria->criteriaValue->id }}[specs]">
                                                    {{ old($criteria->criteriaValue->id . '.specs') ? old($criteria->criteriaValue->id . '.specs') : $criteria->criteriaValue->contextSpecifics }}
                                                </textarea>
                                            </td>
                                            <td>
                                                <textarea class="evalgrid textarea" name="{{ $criteria->criteriaValue->id }}[mComm]">
                                                    {{ old($criteria->criteriaValue->id . '.mComm') ? old($criteria->criteriaValue->id . '.mComm') : $criteria->criteriaValue->managerComments }}
                                                </textarea>
                                            </td>
                                            <td>
                                                <textarea class="evalgrid textarea" name="{{ $criteria->criteriaValue->id }}[sComm]">
                                                    {{ old($criteria->criteriaValue->id . '.sComm') ? old($criteria->criteriaValue->id . '.sComm') : $criteria->criteriaValue->studentComments }}
                                                </textarea>
                                            </td>
                                        @else
                                            <td>{{ $criteria->criteriaValue->contextSpecifics }}</td>
                                            <td>{{ $criteria->criteriaValue->managerComments }}</td>
                                            <td>
                                                <textarea class="evalgrid textarea" name="{{ $criteria->criteriaValue->id }}[sComm]">
                                                    {{ old($criteria->criteriaValue->id . '.sComm') ? old($criteria->criteriaValue->id . '.sComm') : $criteria->criteriaValue->studentComments }}
                                                </textarea>
                                            </td>
                                        @endif

                                    @endif
                                </tr>

                            @endforeach

                        </tbody>




                    {{--  --------------  --}}
                    {{--  SECTION TYPE 3  --}}
                    @elseif ($evalSection->sectionType == 3)

                        <thead>

                            <tr>
                                <th class="gridform w20">{{ $evalSection->sectionName }} :</th>
                                <th class="gridform w40">Remarque du responsable de stage</th>
                                <th class="gridform w40">Remarque du stagiaire</th>
                            </tr>
        
                        </thead>
        
                        <tbody>

                            {{--  Display all the section criterias  --}}
                            @foreach ($evalSection->criterias as $criteria)

                                <tr>
                                    <td>{{ $criteria->criteriaName }}</td>

                                    @if ($mode == 'readonly')

                                        <td>{{ $criteria->criteriaValue->managerComments }}</td>
                                        <td>{{ $criteria->criteriaValue->studentComments }}</td>

                                    @elseif ($mode == 'edit')

                                        {{--  Display the inputs depending the user level  --}}
                                        @if ($level > 0)

                                            <td>
                                                <textarea class="evalgrid textarea" name="{{ $criteria->criteriaValue->id }}[mComm]">
                                                    {{ old($criteria->criteriaValue->id . '.mComm') ? old($criteria->criteriaValue->id . '.mComm') : $criteria->criteriaValue->managerComments }}
                                                </textarea>
                                            </td>
                                            <td>
                                                <textarea class="evalgrid textarea" name="{{ $criteria->criteriaValue->id }}[sComm]">
                                                    {{ old($criteria->criteriaValue->id . '.sComm') ? old($criteria->criteriaValue->id . '.sComm') : $criteria->criteriaValue->studentComments }}
                                                </textarea>
                                            </td>

                                        @else
                                        
                                            <td>{{ $criteria->criteriaValue->managerComments }}</td>
                                            <td>
                                                <textarea class="evalgrid textarea" name="{{ $criteria->criteriaValue->id }}[sComm]">
                                                    {{ old($criteria->criteriaValue->id . '.sComm') ? old($criteria->criteriaValue->id . '.sComm') : $criteria->criteriaValue->studentComments }}
                                                </textarea>
                                            </td>

                                        @endif
                                        
                                    @endif

                                </tr>

                            @endforeach

                        </tbody>

                    @endif

                </table>

            @endforeach


            {{--  Display the save buttons depending the user  --}}
            @if ($mode == 'edit')

                @if ($level > 0)

                    {{--  Admin and teacher buttons  --}}

                    <button class="btn btn-lg btn-info" type="submit" name="submit" value="save">Enregistrer la grille</button>
                    <button class="btn btn-lg btn-danger" type="submit" name="submit" value="checkout">Valider définitivement la grille</button>
                
                @elseif ($level == 0)

                    {{--  Student buttons  --}}
                    <button class="btn btn-info" type="submit" name="submit" value="save">Enregistrer la grille</button>

                @endif

            @endif

        </form>

    </div>

</div>

@stop

@section ('page_specific_js')
    <script src="/js/evalgrid.js"></script>
@stop