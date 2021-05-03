@extends ('layout')

@section ('content')
<h2>
    Rapport de stage de {{ $report->internship->student->firstname }}
    {{ $report->internship->student->lastname }} chez
    {{$report->internship->company->companyName}}
</h2>

<div class="d-flex justify-content-end mb-3">
    <select name="status" id="status">
        @foreach ($reportStatus as $status)
        <option value="{{$status->status}}" @if ($status->id == $report->status_id) selected @endif>{{$status->status}}</option>
        @endforeach
    </select>
</div>

@foreach ($report->sections as $section)
<section>
    <form method="POST" action="{{route("reportSection.update", $section->id)}}">
        @method('PUT')
        @csrf      
        <table class="table text-left larastable">
            <tr scope="row">
                <td scope="col-md-2">Titre</td>
                <td>
                    <input type="text" name="title" class="w-100" value="{{$section->name}}" readonly />
                </td>
            </tr>
            <tr scope="row">
                <td>Description</td>
                <td class="Description">
                    <textarea name="description" class="w-100" value="{{$section->text}}"
                        readonly>{{$section->text}}</textarea>
                </td>
            </tr>
        </table>
        <div class="d-flex justify-content-end mb-3">
            <button name="edit" type="button" class="btn-warning">Editer</button>
            <button name="cancel" type="button" class="btn-warning" hidden>Annuler</button>
            <button name="save" type="submit" class="btn-success" hidden>Enregistrer</button>
        </div>
    </form>
</section>
@endforeach

@endsection

@push ('page_specific_js')
<script src="/js/internshipreport.js"></script>
@endpush