@extends ('layout')
@push ('page_specific_css')
    <link rel="stylesheet" href="/css/wishesMatrix.css"/>
@endpush
@section ('content')
    <!-- Display messages if the user doesn't have the correct rights -->
    <div class="alert-info hidden"></div>

    <h1>Matrice des souhaits</h1>
    <div class="col-md-9">
        <table id="WishesMatrixTable" class="table-bordered col-md-11">
            {{-- Display flocks --}}
            <tr>
                <th></th>
                @foreach ($flocks as $flock)
                    {{-- The colspan of a flock is the number of students of the flock --}}
                    <th colspan="{{ $flock->students->count() }}">{{ $flock->flockName }}</th>
                @endforeach
            </tr>

            {{-- Display the students from the flocks --}}
            <tr>
                <th></th>
                @foreach ($flocks as $flock)
                    @foreach($flock->students as $student)
                        {{-- Display the initials of the student --}}
                        {{-- Add the class access to cases of belonging to the user --}}
                        <th
                                @if ($student->id == $currentUser->id)
                                class="access"
                                @endif
                        >
                        <a href="{{route("person.show", $student->id) }}" title="{{$student->fullName}}">
                                @if ($student->initials!="")
                                    {{ $student->initials }}
                                @else
                                    ???
                                @endif
                            </a>
                        </th>
                    @endforeach
                @endforeach
            </tr>

            {{-- Display the internships and their wishes --}}
            @foreach ($parentInternships as $internship)
                {{-- Display a group only if at least one internship is disponible --}}
                @if($placesQuantities[$internship->id] >= 1 )
                    <tr data-internship-id="{{ $internship->id }}">
                        <td>
                            {{-- Display the company of the internship, with a link to the first available internship --}}
                            <a href="{{route("internship", $childIds[$internship->id])}}">
                                {{ $internship->company->companyName }}

                                {{-- Display the number of available internships, if that number is greater than 1 --}}
                                @if($placesQuantities[$internship->id] > 1)
                                    ({{ $placesQuantities[$internship->id] }})
                                @endif
                            </a>
                        </td>

                        {{-- Create the clickable case for each person --}}
                        @foreach ($flocks as $flock)
                            @foreach ($flock->students as $student)
                                {{-- If the student has a wish associated to the internship, get the wish --}}
                                @php
                                    $currentWish = $student->wishes->where('internship.id', $internship->id)->first();
                                    $tdClasses = " ";
                                    if($currentUser->isTeacher) {
                                        $tdClasses .= "clickableCase locked teacher ";
                                    } elseif ($currentUser->id == $student->id) {
                                        $tdClasses .= "clickableCase currentStudent ";
                                    }
                                    if(!is_null($currentWish) && $currentWish->application >= 1) {
                                        $tdClasses .= "postulationRequest ";
                                    }
                                @endphp
                                <td
                                        class="{{ $tdClasses }}"

                                        @if (!is_null($currentWish))
                                        data-wish-id="{{ $currentWish->id }}"
                                        @else
                                        data-wish-id=""
                                        @endif
                                        data-student-id="{{ $student->id }}"
                                        data-internship-id="{{ $internship->id }}"
                                >
                                    @if (!is_null($currentWish) && $currentWish->rank > 0)
                                        {{ $currentWish->rank }}
                                    @endif
                                </td>
                            @endforeach
                        @endforeach
                    </tr>
                @endif
            @endforeach
        </table>

        {{-- Lock table button --}}
        @if ($currentUser->isTeacher)
            <img id="lockTable" src="/images/padlock_32x32.png" alt="unlock"/>

            <form id="postulationsForm" action="/wishesPostulations" method="post">
                {{-- Necessary in order to validate the POST--}}
                {{ csrf_field() }}

                {{-- data --}}
                <textarea id="postulations" name="postulations" hidden></textarea>

                <button type="submit">Enregistrer les postulations</button>
            </form>
        @endif
    </div>

    {{-- Parameters modification --}}
    @if ($currentUser->isTeacher)
        <form action="/wishesMatrix" method="post">
            {{-- Necessary in order to validate the POST--}}
            {{ csrf_field() }}

            {{-- Limit date for modifications --}}
            <label for="dateEndChoices">Modifiable jusqu'au</label>
            <input id="dateEndChoices" name="dateEndWishes" placeholder="AAAA-MM-DD" type="date"
                   value="{{ $dateEndWishes }}"/>

            {{-- Year selection --}}
            <label for="flockYear">Année à afficher</label>
            <select id="flockYear" name="flockYear">
                @foreach($flockYears as $year)
                    {{-- default selected year is the displayed year --}}
                    <option value="{{ $year }}"
                            @if($year == $selectedYear)
                            selected
                            @endif
                    >{{ $year }}
                    </option>
                @endforeach
            </select>

            <button type="submit">Enregistrer les paramètres</button>
        </form>
    @endif

    {{-- Save choices, students only --}}
    {{-- Check if current user is a student --}}
    @if ($currentUser->isStudent)
        <form id="choicesForm" action="/updateWishes" method="post">
            {{-- Necessary in order to validate the POST--}}
            {{ csrf_field() }}

            {{-- data --}}
            <textarea id="choices" name="choices" hidden></textarea>

            <button type="submit">Enregistrer</button>
        </form>
    @endif

@stop

@push ('page_specific_js')
    <script src="/js/wishesMatrix.js"></script>
@endpush