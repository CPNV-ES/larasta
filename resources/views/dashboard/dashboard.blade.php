@extends ('layout')

@section ('content')


@if (Auth::check())
    
    <div class="row text-left ml-2"> 
        <div class="col pt-4">
            <h2>Bonjour {{Auth::user()->firstname}} !</h2>
        </div>
    </div>

    
    {{-- If user is a teacher --}}
    @if (Auth::user()->role == 1)
        @if($internships == null || $visits == null)
            <div class="row text-left ml-2"> 
                <div class="col pt-4">
                    <h4 class="ml-4 pt-2">Vous n'avez pas de stage ou de visite vous concernant<h4>
                </div>
            </div>
        @else
            @if (!$visits->isEmpty())
                <div class="row ml-4 mt-4 mr-2">
                    <div class="col-12">
                        <h2 class="text-left">Vos visites</h2>
                        <div class="row text-center mt-1"> 
                            <div class="col-12">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Date et heure</th>
                                            <th scope="col">Stagiaire</th>
                                            <th scope="col">Entreprise</th>
                                            <th scope="col">État de la visite</th>
                                            <th scope="col">Note</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($visits as $data)
                                            <tr class="fake-link text-left" data-href="/visits/{{$data->id}}/manage">
                                                <td>{{ (new DateTime($data->moment))->format('d M Y') }} / {{ (new DateTime($data->moment))->format('H:i:s') }} </td>
                                                <td>{{ $data->internship->student->firstname }} {{ $data->internship->student->lastname}}</td>
                                                <td>{{ $data->internship->company->companyName }}</td>
                                                <td class="text-center">{{ $data->visitsstate->stateName }}</td>
                                                <td class="text-center">{{ $data->grade }}</td>
                                            </tr>
                                        @endforeach 
                                    </tbody>
                                </table>
                            </div>
                        </div> 
                    </div>
                </div>
            @endif

            @if (!$internships->isEmpty())
                <div class="row ml-4 mt-4 mr-2">
                    <div class="col-12">
                        <h2 class="text-left">Les stages en cours</h2>
                        <div class="row text-center mt-1"> 
                            <div class="col-12">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Stagiaire</th>
                                            <th scope="col">Début</th>
                                            <th scope="col">Entreprise</th>
                                            <th scope="col">Responsable administratif</th>
                                            <th scope="col">MC</th>
                                            <th scope="col">État</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($internships as $data)
                                            {{-- If the internship state is not Effectué --}}
                                            @if ($data->contractstate->id != 13)
                                                <tr class="fake-link" data-href="{{route("internships.show", $data->id)}}">
                                                    <td>{{ $data->student->fullName ?? '' }}</td>
                                                    <td>{{ strftime("%e %b %g", strtotime($data->beginDate)) }}</td>
                                                    <td>{{ $data->company->companyName}}</td>   
                                                    <td>{{ $data->admin->fullName ?? ''}}</td> 
                                                    <td title="{{ $data->student->flock->classMaster->fullName ?? ''}}">{{ $data->student->flock->classMaster->initials ?? ''}}</td>
                                                    <td>{{ $data->contractstate->stateDescription}}</td>
                                                </tr>
                                            @endif
                                        @endforeach  
                                    </tbody>
                                </table> 
                            </div>
                        </div>
                    </div>  
                </div>

                
                {{-- Btn show passed internships --}}
                <div class="row ml-4 mt-4 mr-2">
                    <div class="col-12">
                        <button id="showPastBtn"> Voir les stages passés</button>
                    </div>
                </div>

                <div id="pastInternships" class="row ml-4 mt-4 mr-2 d-none">
                    <div class="col-12">
                        <h2 class="text-left">Les stages passés</h2>
                        <div class="row text-center mt-1"> 
                            <div class="col-12">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Stagiaire</th>
                                            <th scope="col">Début</th>
                                            <th scope="col">Entreprise</th>
                                            <th scope="col">Responsable administratif</th>
                                            <th scope="col">MC</th>
                                            <th scope="col">État</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($internships as $data)
                                            {{-- If the internship state is Effectué --}}
                                            @if ($data->contractstate->id == 13)
                                                <tr class="fake-link" data-href="{{route("internships.show", $data->id)}}">
                                                    <td>{{ $data->student->fullName ?? '' }}</td>
                                                    <td>{{ strftime("%e %b %g", strtotime($data->beginDate)) }}</td>
                                                    <td>{{ $data->company->companyName}}</td>   
                                                    <td>{{ $data->admin->fullName ?? ''}}</td> 
                                                    <td title="{{ $data->student->flock->classMaster->fullName ?? ''}}">{{ $data->student->flock->classMaster->initials ?? ''}}</td>
                                                    <td>{{ $data->contractstate->stateDescription}}</td>
                                                </tr>
                                            @endif
                                        @endforeach  
                                    </tbody>
                                </table> 
                            </div>
                        </div>
                    </div>  
                </div>
            @endif
        @endif


    {{-- If user is a student --}}
    @elseif (Auth::user()->role == 0)
        @if($internships == null)
            <div class="row text-left ml-2"> 
                <div class="col pt-4">
                    <h4 class="ml-4 pt-2">Vous n'avez pas encore effectuer de stage<h4>
                </div>
            </div>

        @else

            <div class="row text-left ml-5 mt-3">
                <h3 class="text-left">Vos stages chez :</h3>
            </div>

            @foreach ($internships as $data)
                <div class="row text-left ml-5 mt-3">
                
                    <h4 class="text-left">{!! $data->company->companyName !!}</h4>

                    <div class="col-12 pt-4">
                        {{-- Internship information --}}
                        <div class="container text-left border">
                            <div class="row p-1 border">
                                <div class="col-2">Du</div>
                                <div class="col-10">{{ strftime("%e %b %g", strtotime($data->beginDate)) }}</div>
                            </div>
                            <div class="row p-1 border">
                                <div class="col-2">Au</div>
                                <div class="col-10">{{ strftime("%e %b %g", strtotime($data->endDate)) }}</div>
                            </div>
                            <div class="row p-1 border">
                                <div class="col-2">Description</div>
                                <div class="col-10">
                                    <div id="description">{!! $data->internshipDescription !!}</div>
                                </div>
                            </div>
                            <div class="row p-1 border fake-link" data-href="{{ route("person.show", $data->admin) }}">
                                <div class="col-2">Responsable administratif</div>
                                <div class="col-10">{{ $data->admin->fullName }}</div>
                            </div>
                            <div class="row p-1 border fake-link" data-href="{{route("person.show", $data->responsible) }}">
                                <div class="col-2">Responsable</div>
                                <div class="col-10">{{ $data->responsible->fullName }}</div>
                            </div>
                            <div class="row p-1 border">
                                <div class="col-2">Maître de classe</div>
                                <div class="col-10">
                                    {{-- Display the teacher, if the internship is attributed --}}
                                    @if (isset($data->student))
                                        {{ $data->student->flock->classMaster->initials }}
                                    @endif
                                </div>
                            </div>
                            <div class="row p-1 border">
                                <div class="col-2">Etat</div>
                                <div class="col-10">
                                    {{ $data->contractState->stateDescription }}
                                </div>
                            </div>
                            <div class="row p-1 border">
                                <div class="col-2">Salaire</div>
                                <div class="col-10">{{ $data->grossSalary }}</div>
                            </div>
                            @if (isset($data->previous_id))
                                <div class="row p-1 border">
                                    <div class="col-2">
                                    <a href="{{route("internships.show", $data->previous_id)}}">Stage précédent</a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="row justify-content-center mt-4">
                    <div class="col-7">
                        <div class="row">
                            <h4>Visites</h4>
                        </div>

                        {{-- Visits --}}
                        @if (isset($data->visits) && count($data->visits) > 0)
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">N°</th>
                                        <th scope="col">Date et heure</th>
                                        <th scope="col">État de la visite</th>
                                        <th scope="col">Note</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data->visits as $value)
                                        <tr class="fake-link text-left" data-href="/visits/{{$value->id}}/manage">
                                            <td class="text-center">{{ $value->number }}</td>
                                            <td>{{ (new DateTime($value->moment))->format('d M Y') }} / {{ (new DateTime($value->moment))->format('H:i:s') }} </td>
                                            <td class="text-center">{{ $value->visitsstate->stateName }}</td>
                                            <td class="text-center">{{ $value->grade }}</td>
                                        </tr>
                                    @endforeach 
                                </tbody>
                            </table>
                        @endif   
                    </div>
                </div>
                <hr/>
            @endforeach
        @endif
    @endif

@else
    <div class="row text-left"> 
        <div class="col-12 pt-4 ml-2">
            <h2>Bienvenue !</h2>
            <h4 class="ml-4 pt-2">Connectez-vous pour accèder à votre dashboard<h4>
        </div>   
    </div>
@endif

<script>
    showPastBtn.addEventListener("click",function(event){
        pastInternships.classList.toggle("d-none")
    })
</script>

@stop