@extends ('layout')

@section ('content')

@push ('page_specific_css')
    <link rel="stylesheet" href="/css/dashboard.css">
@endpush

@if (Auth::check())
    
    <div class="row text-left ml-2"> 
        <div class="col pt-4">
            <h1>Bonjour {{Auth::user()->firstname}} !</h1>
        </div>
    </div>

    
    {{-- If user is a TEACHER --}}
    @if (Auth::user()->role == 1)
        @if($internships == null || $visits == null)
            <div class="row text-left ml-2"> 
                <div class="col pt-4">
                    <h4 class="ml-4 pt-2">Vous n'avez pas de stage ou de visite vous concernant<h4>
                </div>
            </div>
        @else
            {{-- Visits table --}}
            @if (!$visits->isEmpty())
                <div class="row ml-4 mt-4 mr-2">
                    <div class="col-12">
                        <h2 class="titlebar mt-1 text-left">Vos visites</h2>
                        <div class="row text-center mt-2"> 
                            <div class="col-12">
                                <table class="larastable w-100">
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

            {{-- Internships table --}}
            @if (!$internships->isEmpty())
                <div class="row ml-4 mt-4 mr-2">
                    <div class="col-12">
                        <h2 class="titlebar mt-2 text-left">Les stages en cours</h2>
                        <div class="row text-center mt-2"> 
                            <div class="col-12">
                                <table class="larstable w-100">
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
                        <h2 class="titlebar mt-1 text-left">Les stages passés</h2>
                        <div class="row text-center mt-2"> 
                            <div class="col-12">
                                <table class="larastable w-100">
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


    {{-- If user is a STUDENT --}}
    @elseif (Auth::user()->role == 0)
        @if($internships == null)
            <div class="row text-left ml-2"> 
                <div class="col pt-4">
                    <h3 class="ml-4 pt-2">Vous n'avez pas encore effectué de stage<h3>
                </div>
            </div>

        @else

            <div class="row ml-4 mt-4 mr-2">  
                <div class="col-12">             
                    <h2 class="titlebar mt-2 text-left">Vos stages</h2>
                </div> 
            </div>            
            <hr/>

            @foreach ($internships as $data)
                <div class="row text-left ml-3 mt-3">
                    <div class="col-12">
                        <a href="{{route("internships.show", $data->id)}}">
                            <h3 class="text-left pl-3 internshipTitle">
                                @ {!! $data->company->companyName !!}
                            </h3>
                        </a>
                    </div>
                </div>
                
                <div class="row justify-content-center">
                    <div class="col-11 pt-2">
                        {{-- Internship information --}}
                        <table class="larastable w-100">
                            <tr>
                                <th class="w-25">Du</th>
                                <td>{{ strftime("%e %b %g", strtotime($data->beginDate)) }}</td>
                            </tr>
                            <tr>
                                <th>Au</th>
                                <td>{{ strftime("%e %b %g", strtotime($data->endDate)) }}</td>
                            </tr>
                            <tr>
                                <th>Description</th>
                                <td>
                                    <div id="description">{!! $data->internshipDescription !!}</div>
                                </td>
                            </tr>
                    
                            <tr>
                                <th>Responsable administratif</th>
                                <td><a href="{{ route("person.show", $data->admin) }}">{{ $data->admin->fullName }}</a></td>
                            </tr>
                            <tr>
                                <th>Responsable</th>
                                <td>
                                    <a href="{{route("person.show", $data->responsible) }}">{{ $data->responsible->fullName }}</a>
                                </td>
                            </tr>
                            <tr>
                                <th>Maître de classe</th>
                                <td>
                                    {{-- Display the teacher, if the internship is attributed --}}
                                    @if (isset($data->student))
                                        {{ $data->student->flock->classMaster->initials }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Etat</th>
                                <td>{{ $data->contractState->stateDescription }}</td>
                            </tr>
                            <tr>
                                <th>Salaire</th>
                                <td>{{ $data->grossSalary }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                
                <div class="row justify-content-center mt-4 pb-1">
                    <div class="col-11">
                        @if (isset($data->visits) && count($data->visits) > 0)
                            <h4 class="titlebar mt-1 text-left">Visites</h4>
                            @include('visits.visitsList', ['visits' => $data->visits])
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
            <h1>Bienvenue !</h1>
            <h3 class="ml-4 pt-2">Connectez-vous pour accèder à votre dashboard</h3>
        </div>   
    </div>
@endif

<script>
    showPastBtn.addEventListener("click",function(event){
        pastInternships.classList.toggle("d-none")
    })
</script>

@stop