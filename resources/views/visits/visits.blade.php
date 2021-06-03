
@extends ('layout')
@push ('page_specific_css')
    <link rel="stylesheet" href="/css/visits.css">
@endpush
@section ('content')
        <form method="post" action="/visits">
        <div class="row justify-content-md-center">
            <div class="col-3">

                {{ csrf_field() }}
                <h3 for="teacher">Résponsable</h3>
                <select name="teacher" class="form-control form-control-sm" onchange="this.form.submit()">
                    @foreach ($persons as $person)
                            <option {{ $person->id == $id ? 'selected' : '' }} value="{{$person->id}}">{{$person->fullName}}</option>
                    @endforeach
            </select>

            </div>
        </div>
        <br>
        <div class="row justify-content-md-center">

        </div>
        </form>
        <br>
        <br>
        @foreach($visitsByState as $state)
            <table class="larastable accordion-table">
                <thead></thead>
                <tbody>
                <tr class="accordion-head-row">
                    <td>
                        <h3>
                            {{ ucfirst($state['state_name']) }}
                            <small>({{ count($state['visits']) }})</small>
                            @if($state['needsAttentionCount'] > 0)
                                <small class="text-danger">({{ $state['needsAttentionCount'] }})</small>
                            @endif
                        </h3>
                    </td>
                </tr>
                <tr class="accordion-content-row folded">
                    <td>
                    @include('visits.visitsDetailedList', ['visits' => $state['visits'], 'displayState' => false])
                    </td>
                </tr>
                </tbody>
            </table>
        @endforeach
@stop
@push ('page_specific_js')
    <script src="js/visits.js"></script>
    <script src="js/visit.js"></script>
@endpush
