@extends ('layout')
@section ('page_specific_css')
    <link rel="stylesheet" href="/css/lifeCycle.css">
@stop
@section ('content')
<div class="container-fluid">
    <div class="body simple-box" id="view">
        <div class="title row">
            <h3>Modification Cycle de vie</h3>
        </div>
    </div>
    <div class="row content-box" id="view">    
        <div class="col-lg-12 col-lg-offset-2">
            <table>
                <thead>
                    <tr>
                        <th width="30"></th>
                    @foreach ($namecycle as $name)
                        
                            <th width="100" height="50">
                                <div class="th">
                                    {{$name->stateDescription}}
                                </div>
                            </th>
                        
                    @endforeach
                    <tr>
                </thead>
                <tbody>
                    @foreach ($namecycle as $from)
                        <tr>
                            <td width="100">{{$from->stateDescription}}</td>
                        @foreach ($namecycle as $to)
                            @foreach ($lifecycle as $cycle)
                                @if ($cycle->from_id == $from->id && $cycle->to_id == $to->id )
                                    <td class="selected" name="cell" data-from="{{$from->id}}" data-to="{{$to->id}}"> </td>
                                    @php
                                        $notfound=false
                                    @endphp
                                    @break
                                @else
                                    @php
                                        $notfound=true
                                    @endphp
                                @endif
                            @endforeach
                            @if($notfound)
                                @if ($from->id == $to->id)
                                    <td data-from="{{$from->id}}" data-to="{{$to->id}}"> </td>
                                @else
                                    <td data-from="{{$from->id}}" name="cell" data-to="{{$to->id}}"> </td>  
                                @endif
                                
                            @endif
                        @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <button id="Submit" class="d-none">Enregistrer</button>
        </div>
        <div class="col-lg-12 col-lg-offset-2 text-center pt-2">
            <img id="lockTable" class="lock" src="/images/padlock_32x32.png"/>
        </div>
        <form method="post" action="">
        </form>
    </div>
</div>
@stop
@section ('page_specific_js')
    <script src="js/cyclelife.js"></script>
@stop