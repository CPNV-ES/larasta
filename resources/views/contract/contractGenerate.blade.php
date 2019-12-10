<?php
/**
 * Author :         Quentin Neves
 * Created :        12.12.2017
 * Updated :        14.10.2019 by Diogo Vieira Ferreira
 * Description :    Check if the contract had already been generated and display it's date or the generation form
 */
?>
@extends ('layout')

@section ('content')
    <div class="container-fluid">

        <!--
            There is two conditions because when we manually assign a null value in the database it returns null
            and not '0000-00-00 00:00:00' anymore
        -->
        @if ($contractGenerated == "0000-01-01 00:00:00" || $contractGenerated == null)
            <h1>Génération de contrat</h1><br>
            Rédiger le contrat au : <br>
            <form method="post" action="{{route('viewContract',['id' => $id])}}">
                {{ csrf_field() }}
                <input type="radio" name="gender" value="male" checked>Masculin<br>
                <input type="radio" name="gender" value="female">Féminin<br><br>
                <button>Générer</button>
            </form>
        @else
            <h1>Contrat généré le : {{date('d F Y à H:i:s', strtotime($contractGenerated))}}</h1>
            <a href="{{route('editInternships',['iid' => $id])}}">
                <button class="btn btn-default">Retour au stage</button>
            </a>
        @endif
    </div>


@stop
