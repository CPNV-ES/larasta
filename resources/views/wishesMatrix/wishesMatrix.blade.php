<!-- ///////////////////////////////////              -->
<!-- Benjamin Delacombaz                              -->
<!-- Wishes Matrix layout                             -->
<!-- Version 0.8                                      -->
<!-- Created 18.12.2017                               -->
<!-- Last edit 07.11.2019 by Damien Jakob             -->

@extends ('layout')
@section ('page_specific_css')
    <link rel="stylesheet" href="/css/wishesMatrix.css"/>
@stop
@section ('content')
    <!-- Display messages if the user doesn't have the correct rights -->
    <div class="alert-info hidden"></div>

    <h1>Matrice des souhaits</h1>
    <div class="col-md-9">
        <table id="WishesMatrixTable" class="table-bordered col-md-11">
            <tr>
                <th></th>
                <!-- Display flocks -->
            @foreach ($flocks as $flock)
                <!-- The colspan of a flock is the number of students of the flock -->
                    <th class="" colspan="{{ $flock->students->count() }}">{{ $flock->flockName }}</th>
                @endforeach
            </tr>

            <tr>
                <th></th>

                <!-- Display the students from the flocks -->
            @foreach ($flocks as $flock)
                @foreach($flock->students as $person)
                    <!-- Display the initials of the student -->
                    @if ($person->initials!="")
                        <!-- Add the class access to cases of belonging to the user -->
                            <th
                                    @if ($person->initials == $currentUser->getInitials())
                                    class="access"
                                    @endif
                                    value="{{ $person->id }}">
                                {{ $person->initials }}
                            </th>
                    @else
                        <!-- Default initials : ??? -->
                            <th value="{{ $person->id }}">???</th>
                        @endif
                    @endforeach
                @endforeach
            </tr>

            <!-- Display the internships and their wishes -->
        @foreach ($parentInternships as $internship)
            <!-- Do not display a group if all internships are attributed -->
                @if($placesQuantities[$internship->id] >= 1 )
                    <tr data-internship-id="{{ $internship->id }}">
                        <td>
                            {{-- Display the company of the internship, with a link to the first available internship --}}
                            <a href="/internships/{{ $childIds[$internship->id] }}/view">
                                {{ $internship->company->companyName }}

                                {{-- Display the number of available internships, if that number is greater than 1 --}}
                                @if($placesQuantities[$internship->id] >= 2)
                                    ({{ $placesQuantities[$internship->id] }})
                                @endif
                            </a>
                        </td>

                        <!-- Create the clickable case for each person -->
                    @foreach ($flocks as $flock)
                        @foreach ($flock->students as $person)
                            @if ($currentUser->getLevel() != 0)
                                <!-- Give extra classes to teacher -->
                                    <td class="clickableCase locked teacher">
                                    @else
                                        <!-- Student -->
                                    @if ($currentUser->getId() == $person->id)
                                        <td class="clickableCase currentStudent">
                                    @else
                                        <td class="clickableCase">
                                        @endif
                                        @endif

                                        <!-- If student person has a wish for this internship, display the rank -->
                                            @foreach($person->wishes as $wish)
                                                @if($wish->internship->id == $internship->id)
                                                    {{ $wish->rank }}
                                                @endif
                                            @endforeach
                                        </td>
                                        @endforeach
                                        @endforeach
                    </tr>
                @endif
            @endforeach
        </table>

        <!-- Lock table button -->
        @if ($currentUser->getLevel() != 0)
            <img id="lockTable" src="/images/padlock_32x32.png"/>
        @endif
    </div>

    <!-- Parameters modification, for teachers only -->
    <!-- Check if current user is not a student -->
    @if ($currentUser->getLevel() != 0)
        <form action="/wishesMatrix" method="post">
            <!-- Necessary in order to validate the POST-->
        {{ csrf_field() }}

        <!-- Limit date for modifications -->
            <label>Modifiable jusqu'au</label>
            <input id="dateEndChoices" placeholder="AAAA-MM-DD" type="date" name="dateEndWishes"
                   value="{{ $dateEndWishes }}"/>

            <!-- Year selection -->
            <label>Année à afficher</label>
            <select name="flockYear" id="flockYear">
            @foreach($flockYears as $year)
                <!-- default selected year is the displayed year -->
                    <option value="{{ $year }}"
                            @if($year == $selectedYear)
                            selected
                            @endif
                    >{{ $year }}
                    </option>
                @endforeach
            </select>

            <!-- Submit button -->
            <button type="submit">Enregistrer</button>
        </form>
    @endif

    <!-- Save choices, students only -->
    <!-- Check if current user is a student -->
    @if ($currentUser->getLevel() == 0)
        <form id="choicesForm" action="/updateWishes" method="post">
            <!-- Necessary in order to validate the POST-->
        {{ csrf_field() }}

        <!-- modifications, hidden -->
            <textarea id="choices" name="choices" hidden></textarea>

            <!-- Submit button -->
            <button type="submit">Enregistrer</button>
        </form>
    @endif

@stop

@section ('page_specific_js')
    <script src="/js/wishesMatrix.js"></script>
@stop