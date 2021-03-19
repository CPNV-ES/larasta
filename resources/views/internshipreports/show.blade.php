@extends ('layout')

@section ('content')
    <h2>Rapport de stage de {{ $report->internship->student->firstname }} {{ $report->internship->student->lastname }}</h2>
@endsection
