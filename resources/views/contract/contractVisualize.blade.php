@extends ('layout')

@section ('content')
    <div class="container-fluid">
        <h1>Visualisation de contract</h1>
        <form id="contractEditor" method="post" action="{{route('saveContract',['id' => $id])}}">
            {{ csrf_field() }}
            <textarea name="contractText"><?php echo e($contract->contractText); ?></textarea><br>
            <button>Valider</button> <button name="pdf" value="pdf">Générer pdf</button>
        </form>
    </div>
    <style>
        [name=contractText]{
            min-width: 90%;
            min-height: 80vh;
        }
    </style>

@stop

@push ('page_specific_js')
    {{-- TODO: Register idk wtf--}}
    <script src='https://cloud.tinymce.com/stable/tinymce.min.js'></script>
    <script>
        tinymce.init({
            selector:'textarea',
            height: "600"
        });
    </script>
@endpush
