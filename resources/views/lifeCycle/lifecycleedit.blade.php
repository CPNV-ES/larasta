@extends ('layout')
@push ('page_specific_css')
<link rel="stylesheet" href="/css/lifeCycle.css">
@endpush
@section ('content')
<div class="container-fluid">
    <div class="body simple-box" id="view">
        <div class="title row">
            <h3>Modification Cycle de vie</h3>
        </div>
        <div id="message">
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
                            <div class="titleTable">
                                {{$name->stateDescription}}
                            </div>
                        </th>
                        @endforeach
                    <tr>
                </thead>
                <tbody>
                    @foreach ($namecycle as $from)
                        <tr>
                            <td width="100"><input type="text" name="title" data-title="{{$from->id}}"
                                value="{{$from->stateDescription}}" disabled>
                            </td>
                            @foreach ($namecycle as $to)
                                @if ($from->id == $to->id)
                                    <td data-from="{{$from->id}}" data-to="{{$to->id}}"> </td>
                                @else
                                    @if(isset($lifecycle[$from->id][$to->id]))
                                        <td class="selected" name="cell" data-from="{{$from->id}}" data-to="{{$to->id}}"> </td>
                                    @else
                                        <td name="cell" data-from="{{$from->id}}" data-to="{{$to->id}}"> </td>
                                    @endif
                                @endif
                            @endforeach
                        @if (!array_key_exists($from->id,$lifecycle))
                        <td class="minus">
                            <form method="POST" action="/removelifecycle">
                                {{ csrf_field() }}
                                <input name="id" type="hidden" value="{{$from->id}}">
                                <button class="float-left minusbutton d-none" type="submit">-</button>
                            </form>
                        </td>
                        @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <form method="POST" action="/addlifecycle">
                {{ csrf_field() }}
                <button class="float-left btn-success d-none mt-1" type="submit">+</button>
            </form>
            <button id="Submit" class="d-none">Enregistrer</button>
        </div>
        <div class="col-lg-12 col-lg-offset-2 text-center pt-2">
            <img id="lockTable" class="lock" src="/images/padlock_32x32.png" />
        </div>
        </form>
    </div>
</div>
@stop
@push ('page_specific_js')
<script src="js/cyclelife.js"></script>
@endpush