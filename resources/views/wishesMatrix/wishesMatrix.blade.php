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
    <div class="alert-info hidden">
        <!-- Info if user doesn't have the good right -->
    </div>
    <h1>Matrice des souhaits</h1>
    <div class="col-md-9">
        <table id="WishesMatrixTable" class="table-bordered col-md-11">

            <tr>
                <th></th>
                <!-- Display flocks -->
            @foreach ($flocks as $flock)
                <!-- Add each persons where initials is ok -->
                    <th class="" colspan="{{ $flock->students->count() }}">{{ $flock->flockName }}</th>
                @endforeach
            </tr>

            <tr>
                <th></th>
                <!-- Display students from flocks -->
            @foreach ($flocks as $flock)
                <!-- Add each persons where initials is ok -->
                    @foreach($flock->students as $person)
                        @if ($person->initials!="")
                            @if ($person->initials == $currentUser->getInitials())
                                <th class="access" value="{{ $person->id }}">{{ $person->initials }}</th>
                            @else
                                <th value="{{ $person->id }}">{{ $person->initials }}</th>
                            @endif
                        @endif
                    @endforeach
                @endforeach
            </tr>

            @foreach ($companies as $company)
                <tr>
                    <td value="{{ $company->id }}">{{ $company->companyName }}</td>
                    <!-- Create the clickable case for each person -->

                @foreach ($flocks as $flock)
                    @foreach ($flock->students as $person)
                        @if ($person->initials!="")
                            <!-- !!!!!!!!!!!!!!!!!!!!!!!!!PROBLEM BECAUSE NOT EMPTY BECAUSE LARAVEL ADD SYNTAX IN TD !!!!!!!!!!!!!!!!!!!!!! -->
                                @if ($currentUser->getLevel() != 0)
                                    <td class="clickableCase locked teacher">
                                @else
                                    <td class="clickableCase">
                                    @endif
                                    <!-- Add for each person in the table their wishes -->
                                        @foreach($person->wishes as $wish)
                                            @if($wish->internship->company->id == $company->id)
                                                {{ $wish->rank }}
                                            @endif
                                        @endforeach
                                    </td>
                                @endif
                                @endforeach
                                @endforeach

                </tr>
            @endforeach
        </table>
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
            <label>Modifiable jusqu'au</label>
            <input id="dateEndChoices" placeholder="AAAA-MM-DD" type="date" name="dateEndWishes"
                   value="{{ $dateEndWishes }}"/>

            <!-- year selection -->
            <label>Année à afficher</label>
            <select name="flockYear" id="flockYear">
                <!-- default selected year is the displayed year -->
                @foreach($flockYears as $year)
                    <option value="{{ $year }}"
                            @if($year == $selectedYear)
                            selected
                            @endif
                    >{{ $year }}
                    </option>
                @endforeach
            </select>
            <button type="submit">Enregistrer</button>
        </form>
    @endif

@stop

@section ('page_specific_js')
    <script src="/js/wishesMatrix.js"></script>
@stop