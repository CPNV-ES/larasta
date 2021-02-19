@extends ('layout')

@section ('content')
    <h1>Paramètres de l'application</h1>

    <form method="post" action="/params/update">
    @csrf
    <table>
    @foreach($params as $param)
        <tr>
            <td>
                {{ $param->paramName }}
            </td>
            <td>
            <input hidden value="{{ $param->value_type }}" name="{{ "params[$param->paramName][type]" }}" />
            @if($param->value_type == "text")
                <input value="{{ $param->paramValueText }}" name="{{ "params[$param->paramName][value]" }}" />
            @elseif($param->value_type == "int")
                <input value="{{ $param->paramValueInt }}" type="number" name="{{ "params[$param->paramName][value]" }}" />
            @elseif($param->value_type == "date")
                <input type="date" value="{{ (new DateTime($param->paramValueDate))->format('Y-m-d') }}" name="{{ "params[$param->paramName][value][date]" }}">
                <input type="time" value="{{ (new DateTime($param->paramValueDate))->format('H:i') }}" name="{{ "params[$param->paramName][value][time]" }}">
            @endif
            </td>
        </tr>
    @endforeach
    </table>
    <input type="submit" />
    </form>
@endsection
