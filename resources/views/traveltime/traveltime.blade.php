{{--
Author : Kevin Jordil
Last update : 23.01.18 by Kevin Jordil

If this view get :
    $persons
    $companies
    $times
    $colors

Display an array with all elements
--}}

<!-- Author : Kevin Jordil -->
<!--    TravelTime page    -->

@extends ('../layout')

@push ('page_specific_css')
    <link rel="stylesheet" href="/css/travelTime.css">
@endpush

@section ('content')

    <h1>
        TravelTime
    </h1>
    <form action="/wishesMatrix" method="get" class="backForm">
        {{ csrf_field() }}
        <button type="submit" class="btn">Retour</button>
    </form>
    @if ($error) {{-- If error is true display the message --}}

        <div class="alert alert-danger"><h4>Erreur : {{ $message }}</h4></div>

    @elseif (isset($persons) & isset($companies) & isset($times)) {{-- if persons, companies and times are define, display the table with information --}}

        <div class="row">
            <table class="table-bordered col-md-9">
                <tr>
                    <th></th>
                    @foreach ($persons as $person)
                        <th>{{ $person->initials }}</th>
                    @endforeach
                </tr>

                @foreach ($companies as $key => $company)
                    <tr>
                        <td>{{ $company->companyName }}</td>
                        @for($i = $key*count($persons) ; $i < ($key*count($persons))+count($persons); $i++) {{-- take the id of actual company multiple by the number of persons to the same number plus the number of persons --}}
                            <td class="{{ $colors[$i] }}">{{ $times[$i] }}</td> {{-- color have same index of times array --}}
                        @endfor
                    </tr>
                @endforeach

            </table>
        </div>

        <br/>
        <br/>

        <div class="row">
            <form action="/traveltime/{{ $flockId }}/calculate" method="get">
                {{ csrf_field() }}
                <button type="submit" class="btn">(Re)Calculer</button>
            </form>
        </div>

    @else

        <h4>L'url n'est pas valide</h4>


    @endif


@stop

@push ('page_specific_js')
    <script src="/js/travelTime.js"></script>
@endpush
