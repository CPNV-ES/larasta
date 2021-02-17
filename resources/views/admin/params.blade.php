@extends ('layout')

@section ('content')
    <h1>Paramètres de l'application</h1>

    @foreach($params as $param)
        <p>{{ $param->paramName  }}</p>
    @endforeach
@endsection