@extends ('layout')

@section('page_specific_css')
    <link rel="stylesheet" href="/css/logbook.css">
@endsection

@section ('page_specific_js')
    <script src="/js/logbook.js"></script>
    
    <!--vars passed at page load-->
    <script>
        var internshipId = {{$internship->id}};
    </script>
@endsection

@section('sidemenu')
    @include("logbook/_sideMenuInfos", ["modeBtnAction" => "review", "internshipId" => $internship->id])
@endsection

@section ('content')

@endsection