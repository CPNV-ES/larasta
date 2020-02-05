<h3 class="mt-3">Fichiers</h3>
<div class="showfile row">
    @foreach ($medias as $media)
        <div class="col-1">
            <a href="{{$media->getUrl()}}" download>
                <img src="{{getFileIcon($media->mime_type)}}" style="border:solid 2px black" width="50px" height="50px">
            </a>
            <p>{{$media->name}}</p>
        </div>
    @endforeach
</div>