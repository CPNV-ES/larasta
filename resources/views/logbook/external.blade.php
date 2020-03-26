@extends ('layout')
@push('page_specific_css')
    <link rel="stylesheet" href="/css/logbook.css">
@endpush
@section ('content')
    <h1>Journal de {{$student->full_name}}</h1>
    <h2>{{$internship->company->companyName}}</h2>
    @if($logbookFileUrl)
        <iframe id="externalLogbookPreview" src="{{$logbookFileUrl}}"></iframe>
    @else
        <p id="noLogbookMessage">Aucun journal de bord n'a encore été ajouté.</p>
    @endif
    <form method="POST" enctype="multipart/form-data" action="{{route('externalLogbook.store', ["internshipId"=>$internship->id])}}">
        @method('PUT')
        @csrf()
        <div id="fileDropzone">
            <p id="dropzoneFileName">Selectionnez un fichier</p>
            <input id="fileInput" autocomplete="off" type="file" name="file" required/>
        </div>
        <br/>
        <button type="submit">Mettre à jour</button>
    </form>
    <script>
        fileInput.addEventListener("dragenter", evt=>{
            fileDropzone.classList.add("dragOver");
        });
        fileInput.addEventListener("dragleave", evt=>{
            fileDropzone.classList.remove("dragOver");
        });

        fileInput.addEventListener("input", evt=>{
            fileDropzone.classList.remove("dragOver");
            if(fileInput.files.length > 1){
                dropzoneFileName.textContent = `${fileInput.files.length} fichiers sélectionnés.`
            }else{
                dropzoneFileName.textContent = fileInput.files[0].name;
            }
        });
    </script>
@endsection