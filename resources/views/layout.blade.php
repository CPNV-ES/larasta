<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Larasta</title>
    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/app.css">
    @yield('page_specific_css')
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Larasta</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="/">Home</a></li>
            <li><a href="#">Antonio</a></li>
            <li><a href="/evalgrid">Bastien</a></li>
            <li><a href="/wishesMatrix">Benjamin</a></li>
            <li><a href="/listPeople">Davide</a></li>
            <li><a href="/visits">Jean-Yves</a></li>
            <li><a href="#">Julien</a></li>
            <li><a href="/traveltime">Kevin</a></li>
            <li><a href="#">Nicolas</a></li>
            <li><a href="/contratGen">Quentin N</a></li>
            <li><a href="#">Quentin R</a></li>
            <li><a href="/synchro">Steven</a></li>
            <li><a href="#">Xavier</a></li>
        </ul>
    </div>
</nav>
@if (!empty($message))
    <div class="alert-info willvanish">{{ $message }}</div>
@endif

<div class="container-fluid text-center">
    @yield ('content')
</div>
</body>
<script src="/node_modules/jquery/dist/jquery.min.js"></script>
<script src="/node_modules/bootstrap/dist/js/bootstrap.js"></script>
<script src="/node_modules/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="/js/appjs.js"></script>

@yield('page_specific_js')
</html>