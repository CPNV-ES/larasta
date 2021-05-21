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
            <h2>Bonjour {{Auth::user()->firstname}}</h2>
        </div>
    </div>

    @if (Auth::user()->role = 1)
        <div class="row ml-4 mt-2">
            <div class="col-12">
                <h2 class="text-left">Vos visites</h2>
                <div class="row text-center"> 
                    <div class="col-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Stagiaire</th>
                                    <th scope="col">Entreprise</th>
                                    <th scope="col">Date et heure</th>
                                    <th scope="col">État de la visite</th>
                                    <th scope="col">Note</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($visits as $data)
                                dd($data->id);
                                <tr class="fake-link text-left" data-href="{{route("visit.manage"), $data->id}}">
                                    <td>{{ $data->internship->student->firstname }} {{ $data->internship->student->lastname}}</td>
                                    <td>{{ $data->internship->company->companyName }}</td>
                                    <td>{{ (new DateTime($data->moment))->format('d M Y') }} / {{ (new DateTime($data->moment))->format('H:i:s') }} </td>
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
        
        <div class="row ml-4 mt-2">
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
                                    <th scope="col">Responsable</th>
                                    <th scope="col">MC</th>
                                    <th scope="col">État</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($internships as $data)
                                    <tr class="fake-link" data-href="{{route("internships.show", $data->id)}}">
                                        <td>{{ $iship->company->companyName}}</td>   
                                    </tr>
                    

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