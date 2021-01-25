@extends ('layout')

@section ('content')
    <h1>Volées</h1>

    <table class="larastable table table-striped">
    <thead class="thead-inverse">
        <tr class="d-flex">
            <th class="col-3">Volée</th>
            <th class="col-3">Classe</th>
            <th class="col-6">Maître de classe</th>
        </tr>
    </thead>
    <tbody>
    @foreach($flocks as $flock)
        <tr class="d-flex text-left flock-head-row">
            <td class="col-3">20{{ $flock->startYear }}-20{{  $flock->startYear+4 }}</td>
            <td class="col-3">{{ $flock->flockName }}</td>
            <td class="col-6">{{ $flock->classMaster->getFullNameAttribute() }}</td>
        </tr>
        <tr class="d-flex text-left flock-students-row folded">
            <td class="col-12">
                <table class="larastable table table-striped">
                    <thead class="thead-inverse">
                    <tr class="d-flex">
                        <th class="col-3">Nom</th>
                        <th class="col-9">Prénom</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($flock->students as $student)
                        <tr class="d-flex">
                            <td class="col-3">{{ $student->lastname }}</td>
                            <td class="col-9">{{ $student->firstname }}</td>
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
@push('page_specific_js')
    <script src="/js/flocks.js"></script>
@endpush
