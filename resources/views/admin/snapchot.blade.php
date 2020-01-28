@extends ('layout')
@section ('content')

    <h1>Snapshot</h1>
    <h3>Snapshot utilisé actuellement:</h3>
    <form method="get" action="{{route('snapshot.take')}}">
        {{ csrf_field() }}
        <input type=submit name='takesnapshot' value='Prendre un nouveau snapshot' /><br>
    </form>
    <form enctype='multipart/form-data' name='Snapshots' method="post" action="{{route("snapshot.upload")}}">
        {{ csrf_field() }}
        <input type='file' name='newsnapshotfile' id='newsnapshot'><br>
        <input type='submit' value='Importer une snapshot' name='newsnapshot'>
    </form>
    </br>
    <form enctype='multipart/form-data' name='Snapshots' method="post" action="{{route("snapshot.reload")}}">
        {{ csrf_field() }}
        <input type=submit name='reload' value='Recharger la snapshot sélectionné' /><br>
        @foreach($filesName as $fileName)
            <input type="radio" name="snapshot" value="{{$fileName}}">{{App\Snapshot::timeFromSnapshot($fileName)}}<br>
        @endforeach
    </form>
@stop