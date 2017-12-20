@extends ('layout')

@section ('content')
    <h1>Synchro</h1>

    <table class="table table-bordered col-md-6">
      <tr>
        <th class="col-md-2">Nom</th>
        <th class="col-md-2">Email</th>
        <th class="col-md-2">Classe</th>
      </tr>
      @foreach($jsonResponse as $response)
      <tr>
        <td class="col-md-2">{{ $response['lastname'] . ' ' . $response['firstname'] }}
        <td class="col-md-2">{{ $response['corporate_email'] }}
        <td class="col-md-2">{{ $response['current_class']['link']['name'] }}
      </tr>
      @endforeach
    </table>
@stop