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


@stop

@section ('page_specific_js')
    <script src="/js/tinymce/tinymce.js"></script>
    <script>
        tinymce.init({
            selector:'textarea',
            height: "600"
        });
    </script>
@stop
