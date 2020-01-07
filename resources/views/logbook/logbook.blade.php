@extends ('layout')
@section ('page_specific_js')
    <script src="/js/logbook.js"></script>
@stop
@section ('content')
    {{$internship->id}}
@stop