@extends ('layout')
@section ('page_specific_css')
    <link rel="stylesheet" href="/css/lifecycle.css">
@stop
@section ('content')
<div class="container-fluid">
    <div class="body simple-box" id="view">
        <div class="title row">
            <h3>Modification Cycle de vie</h3>
        </div>
    </div>
    <div class="row content-box" id="view">
            <form method="post" action="">
                
                    
                <div class="col-lg-8 col-lg-offset-2">
                @foreach ($namecicle as $key => $name)
                <h4 class="font-weight-bold pl-5">{{$name->stateDescription}}</h4>
                    @foreach ($lifecicle as $cicle)
                        @if ($cicle->from_id == $name->id)
                            <div class="row-6">
                                <div class="col-6 form-group">
                                    <input class="form-control-sm" type="text" name={{$cicle->id}} value={{$cicle->contractstatefrom->stateDescription}} disabled>
                                </div>
                                <div class="col-6 form-group">
                                    <select class="form-control-sm" disabled>
                                        @foreach ($namecicle as $value)
                                            @if ($value->stateDescription == $cicle->contractstateto->stateDescription)
                                                <option value={{$value->id}} selected>{{$value->stateDescription}}</option>
                                            @else
                                                <option value={{$value->id}}>{{$value->stateDescription}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="btn-group pb-5">
                                <button class="btn btn-primary mr-2" name="modifycycle" type="button">Modifier</button>
                                <button class="btn btn-primary" name="suppresscycle" type="button">Supprimer</button>
                                </div>
                            </div>
                        @endif
                    @endforeach
                    <button   class="btn btn-primary" name="ajoutercycle" type="button">Ajouter</button>
                @endforeach
                </div>
            </form>
    </div>
</div>
@stop
@section ('page_specific_js')
    <script src="js/cyclelife.js"></script>
@stop