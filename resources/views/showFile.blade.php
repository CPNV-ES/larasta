@if (!empty($medias->first()))
    <h3 class="mt-3">Fichiers</h3>
    <div class="showfile row">
        @foreach ($medias as $media)
        <div class="card pt-3 ml-3">
            <a href="{{$media->getUrl()}}" download>
                <img src="{{getFileIcon($media->mime_type)}}" style="" width="50px" height="50px">
            </a>
            <div class="card-body">
                <h5 class="card-title">{{$media->name}}</h5>
                <hr>
                <form action="{{route($route, ["idMedia" => $media->id, "id" => $id])}}" method="POST">
                    {{method_field('DELETE')}}
                    {{ csrf_field() }}
                    <button type="submit" class="btn-danger">Supprimer</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
@endif