<h2>Ajouter des fichiers</h2>
<div class="uploadfile d-flex justify-content-center">
    <form action="{{$route}}" method="POST" class="dropzone col-4" id="my-awesome-dropzone">
        {{ csrf_field() }}
    </form>
</div>