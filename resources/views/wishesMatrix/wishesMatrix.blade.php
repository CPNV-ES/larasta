<!-- ///////////////////////////////////              -->
<!-- Benjamin Delacombaz                              -->
<!-- Wishes Matrix layout                             -->
<!-- Version 0.8                                      -->
<!-- Created 18.12.2017                               -->
<!-- Last edit 10.01.2019 by Damien Jakob             -->


@extends ('layout')
@section ('page_specific_css')
    <link rel="stylesheet" href="/css/wishesMatrix.css" />
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
                <!-- Add each persons where initials is ok -->
                @foreach ($persons as $person)
                    @if ($person->initials!="")
                        <!-- Add access class for authoized to edit a col -->
                        @if ($person->initials == $currentUser->getInitials()) 
                            <th class="access" value="{{ $person->id }}">{{ $person->initials }}</th>
                        @else
                            <th value="{{ $person->id }}">{{ $person->initials }}</th>   
                        @endif
                    @endif
                @endforeach
            </tr>
            @foreach ($companies as $company)
                <tr>
                    <td value="{{ $company->id }}">{{ $company->companyName }}</td>
                    <!-- Create the clickable case for each person -->
                    @foreach ($persons as $person)
                        @if ($person->initials!="")
                        <!-- !!!!!!!!!!!!!!!!!!!!!!!!!PROBLEM BECAUSE NOT EMPTY BECAUSE LARAVEL ADD SYNTAX IN TD !!!!!!!!!!!!!!!!!!!!!! -->
                            @if ($currentUser->getLevel() != 0)
                                <td class="clickableCase locked teacher">
                            @else
                                <td class="clickableCase">
                            @endif
                            <!-- Add for each person in the table their wishes -->
                                @foreach ($wishes[$person->id] as $wish)
                                    <!-- if wish company is equal to the current company, display the rank -->
                                    @if($wish->internship->company->id == $company->id)
                                        {{ $wish->rank }}
                                    @endif
                                @endforeach
                            </td>
                        @endif
                    @endforeach
                </tr>
            @endforeach
        </table>
        @if ($currentUser->getLevel() != 0)
            <img id="lockTable" src="/images/padlock_32x32.png"/>
        @endif
    </div>
    <!-- Check if current user is not a student -->
    @if ($currentUser->getLevel() != 0)
        <a href="/traveltime/{{$currentUserFlockId}}/load" class="col-md-3">Travel time</a>
        <label>Modifiable jusqu'au</label> <input id="dateEndChoices" placeholder="AAAA-MM-DD" type="date" name="editDate" value="{{ $dateEndWishes }}"/>
    @endif
    <button id="save">Enregistrer</button>
@stop

@section ('page_specific_js')
    <script src="/js/wishesMatrix.js"></script>
@stop