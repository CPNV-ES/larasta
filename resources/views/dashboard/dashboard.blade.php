@extends ('layout')

@section ('content')

<div class="row">
    <div class="col-12 pt-3">
        <h1>Dashboard</h1>
    </div>
</div>


@if (Auth::check())
    
    <div class="row text-left ml-2"> 
        <div class="col pt-4">
            <h2>Bonjour {{Auth::user()->firstname}} !</h2>
        </div>
    </div>

    @if (Auth::user()->role = 1)
        <div class="row ml-4 mt-4">
            <div class="col-12">
                <h2 class="text-left">Vos visites</h2>
                <div class="row text-center"> 
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
        
        <div class="row ml-4 mt-4">
            <div class="col-12">
                <h2 class="text-left">Les stages en cours</h2>
                <div class="row text-center"> 
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
                                            <td>{{ strftime("%b %g", strtotime($data->beginDate)) }}</td>
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

        
        <div class="row ml-4 mt-4">
            <div class="col-12">
                <button id="showpastbtn"> Voir les stages passés</button>
            </div>
        </div>

        <div class="row ml-4 mt-4">
            <div class="col-12">
                <h2 class="text-left">Les stages passés</h2>
                <div class="row text-center"> 
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
                                            <td>{{ strftime("%b %g", strtotime($data->beginDate)) }}</td>
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


    @elseif (Auth::user()->role = 0)
    

    @endif

@else
    <div class="row text-left"> 
        <div class="col-12 pt-4">
            <h2>Bienvenue !</h2>
            <h4>Connectez-vous pour accèder à votre dashboard<h4>
        </div>   
    </div>
       
@endif


@stop