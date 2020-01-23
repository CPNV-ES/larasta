<h3>Ajouter des fichiers</h3>
<div class="uploadfile">
    <form action="{{$route}}" method="POST"  class="dropzone"  id="my-awesome-dropzone">
        {{ csrf_field() }}
    </form>
</div>