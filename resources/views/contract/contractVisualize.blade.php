<?php
/**
 * Author :         Quentin Neves
 * Created :        12.12.2017
 * Updated :        14.10.2019 by Diogo Vieira Ferreira
 * Description :    Displays the generated contract in a rich text editor
 */
?>
@extends ('layout')

@section ('content')
    <div class="container-fluid">
        <h1>Visualisation de contract</h1>

        <script src="/node_modules/tinymce/tinymce.min.js"></script>
        <script>
            tinymce.init({
                selector:'textarea',
                height: "600"
            });
        </script>
        <form id="contractEditor" method="post" action="/contract/{{$id}}/save">
            {{ csrf_field() }}
            <textarea name="contractText"><?php echo e($contract->contractText); ?></textarea><br>
            <button>Valider</button> <button name="pdf" value="pdf">Générer pdf</button>
        </form>
    </div>


@stop