@extends ('layout')

@section('page_specific_css')
    <link rel="stylesheet" href="/css/internships.css">
@endsection

@section ('page_specific_js')
    <script src="/js/internships.js"></script>
@stop

@section ('content')
@if(session('error'))
    <div class="alert alert-danger">
      {{session('error')}}
    </div>
@endif
    <div id="collapsedfilters" class="simple-box-collapsed filters"><h4>Filtre...</h4></div>
    <div id="expandedfilters" class="simple-box filters d-none">
        <h4 id="collapsefilters">Afficher les stages dans l'état</h4>
        <form name="filterInternships" method="post">
            {{ csrf_field() }}
                @foreach ($filter->getStateFilter() as $state)
                    <span class="onefilter">
                        <input type="checkbox" id="state{{ $state->id }}" name="state{{ $state->id }}" @if ($state->checked) checked @endif >
                        <label for="state{{ $state->id }}">{{ $state->stateDescription }}</label>
                    </span>
                @endforeach
                <h4> et </h4>
                <span class="onefilter">
                    <input type="checkbox" id="inprogress" name="inprogress" @if ($filter->getInProgress()) checked @endif >
                    <label for="inprogress">En cours</label>
                </span>
                <span class="onefilter">
                    <input type="checkbox" id="mine" name="mine" @if ($filter->getMine()) checked @endif >
                    <label for="mine">A moi</label>
                </span>
            <br>
            <button type="submit">Ok</button>
        </form>
    </div>
    <br><br>
    @include ('internships.internshipslist',['iships' => $iships])
@stop
