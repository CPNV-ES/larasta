@extends ('layout')

@section ('content')
    <h1>Paramètres de l'application</h1>

    <form method="post" action="/params/update">
    @csrf
    <div class="container text-left border">
    @foreach($params as $param)
        <div class="row p-1 border">
            <div class="col-4" >
                <span title="{{ $param->paramName }}">
                    {{ __('params.' . $param->paramName) }}
                </span>
            </div>

            <div class="col-8">

            @if($param->value_type == "text")
                <input value="{{ $param->paramValueText }}" name="{{ "params[$param->paramName]" }}" />
            @elseif($param->value_type == "int")
                <input value="{{ $param->paramValueInt }}" type="number" name="{{ "params[$param->paramName]" }}" />
            @elseif($param->value_type == "date")
                <input type="date" value="{{ (new DateTime($param->paramValueDate))->format('Y-m-d') }}" name="{{ "params[$param->paramName]" }}" />
            @endif

            </div>
        </div>
    @endforeach
    </div>
    <input type="submit" />
    </form>
@endsection

@push('page_specific_css')
    <link rel="stylesheet" href="/css/params.css">
@endpush
