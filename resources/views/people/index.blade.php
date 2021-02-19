<!--
/**
 * Created by PhpStorm.
 * User: Davide.CARBONI
 * Date: 18.12.2017
 * Time: 09:02
 */
-->
@extends ('layout')

@section ('content')
    <link rel="stylesheet" href="/css/people.css" />

    <!-------------------->
    <!-- Header Filters -->
    <!-------------------->
    <div id="filtersBoxButton">
        Filtres <i class="arrow 
        @if(!in_array(-1, $filterCategory))
            up 
        @else
            down
        @endif
        "></i>
    </div>
    <div id="expandedfilters" class="simple-box filters
        @if(in_array(-1, $filterCategory)) d-none  @endif
    ">
        <form class="filterPeoples" action="/people/category" method="post" id="people_form">
            {{ csrf_field() }}
            <span class="onefilter">
                <input type="checkbox" value="1" name = "filterCategory[]" id="teacher"  @if (isset($filterCategory) && in_array(1, $filterCategory)) checked="checked" @endif>
                <label for="teacher">Professeur</label>
            </span>

            <span class="onefilter">
                <input type="checkbox" value="0" name = "filterCategory[]" id="student" @if (isset($filterCategory) && in_array(0, $filterCategory)) checked="checked" @endif>
                <label for="student">Elève</label>
            </span>

            <span class="onefilter">
                <input type="checkbox" value="2" name = "filterCategory[]" id="company" @if (isset($filterCategory) && in_array(2, $filterCategory)) checked="checked" @endif>
                <label for="company">Company</label>
            </span>

            <span class="onefilter">
                <input type="checkbox" value="1" name = "filterObsolete" id="obsolete" @if ($filterObsolete == 1) checked="checked" @endif>
                <label for="obsolete">Désactivée</label>
            </span>

            <div class="form-group nameInputGroup">
                <label for="people_inputName">Recherche par nom</label>
                @if (isset($filterName))
                    <input id ="people_inputName" type="text" class="form-control" placeholder="{{ $filterName }}" name = "filterName" value="{{ $filterName }}" >
                @else
                    <input id ="people_inputName" type="text" class="form-control" placeholder="Nom / Prenom" name = "filterName">
                @endif
            </div>
            <div></div>
            <button type="submit">Ok</button>
        </form>
    </div>

    <!----------------------->
    <!-- Tables of Peoples -->
    <!----------------------->

    <div id="people_container" class="row">

        <table class="table table-responsive" id="people_table">

            <thead>
                <tr>
                    <th scope="col">Personne</th>
                    <th scope="col">Rôle</th>
                </tr>
            </thead>

            <tbody id = "people_tbody">
            @if (count($persons) < 1)                      <!-- No filters selected or no users found -->
                <td colspan="2"> Pas des filtres </td>
            @else
                @foreach($persons as $person)                        <!-- View all persons -->
                    <tr class="fake-link" data-href="{{ route("person.edit", $person->id) }}">
                        <td>{{ $person->fullName}}</td>
                        <td>{{ $person->roles}}</td>
                    </tr>
                @endforeach
            @endif
            </tbody>

        </table>

    </div>

    <!----------------------->
    <!---- Button to Top ---->
    <!----------------------->

    <div class = "row">
        <a href="#" id ="btn-return" class="btn btn-success">Top Page</a>
    </div>
@stop

@push ('page_specific_js')
    <script src="/js/people.js"></script>
@endpush
