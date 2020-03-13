@if (!empty($medias->first()))
<h3 class="mt-3">Fichiers</h3>
<div class="showfile row p-2 m-2">
    @foreach ($medias as $media)
    <div class="col-2 filecard">
        <div class="card mt-2 pt-4">
            <a href="{{$media->getUrl()}}" download>
                <img src="{{getFileIcon($media->mime_type)}}" style="" width="50px" height="50px">
            </a>
            <div class="card-body">
                <h5 title="{{$media->name}}" class="card-title text-ellipsis">{{$media->name}}</h5>
                @if (env('USER_LEVEL') > 1 && !isset($editable))
                    <hr>
                    <form id="showFile" data-action="{{route($route, ["idMedia" => $media->id, "id" => $id])}}" data-method="DELETE"> 
                        <button type="submit" class="btn-danger deletefile">Supprimer</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif
@push ('page_specific_js')
    <script src="/js/uploadfile.js"></script>
@endpush