@extends ('layout')

@section ('content')
    <h1>Volées</h1>

    <table class="larastable">
    <thead>
        <tr>
            <th></th>
            <th>Volée</th>
            <th>Classe</th>
            <th>Maître de classe</th>
        </tr>
    </thead>
    <tbody>
    @foreach($flocks as $flock)
        <tr class="accordion-head-row">
            <td class="caret"></td>
            <td>20{{ $flock->startYear }}-20{{  $flock->startYear+4 }}</td>
            <td>{{ $flock->flockName }}</td>
            <td>{{ $flock->classMaster->getFullNameAttribute() }}</td>
        </tr>
        <tr class="accordion-content-row folded">
            <td></td>
            <td colspan="3">
                <table class="larastable">
                    <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($flock->students as $student)
                        <tr>
                            <td>{{ $student->lastname }}</td>
                            <td>{{ $student->firstname }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </td>
        </tr>
    @endforeach
    </tbody>
    </table>
@stop

@push('page_specific_css')
    <link rel="stylesheet" href="/css/flocks.css">
@endpush