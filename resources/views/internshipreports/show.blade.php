@extends ('layout')

@section ('content')
<h2>Rapport de stage de {{ $report->internship->student->firstname }} {{ $report->internship->student->lastname }} chez
    {{$report->internship->company->companyName}}</h2>

<div class="d-flex justify-content-end mb-3">
    <button id="edit" type="button" class="btn-warning">Editer</button>
    <button id="save" type="button" class="btn-success" hidden>Enregistrer</button>
</div>

@foreach ($report->sections as $section)
<section>
    <form method="POST" action="{{route("internshipReport.store", $report->id)}}">
        @csrf
        <table class="table text-left larastable">
            <tr scope="row">
                <td scope="col-md-2">Titre</td>
                <td>
                    <input id="title" type="text" name="title" class="w-100" value="{{$section->name}}" readonly />
                </td>
            </tr>
            <tr scope="row">
                <td>Description</td>
                <td class="Description">
                    <textarea id="description" name="description" class="w-100" value="{{$section->text}}"
                        readonly></textarea>
                </td>
            </tr>
        </table>
    </form>
</section>
@endforeach

@endsection

@push ('page_specific_js')
<script src="/js/internshipreport.js"></script>
@endpush