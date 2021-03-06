@extends ('layout')

@section ('content')
<h2>
    Rapport de stage de {{ $report->internship->student->firstname }}
    {{ $report->internship->student->lastname }} chez
    {{$report->internship->company->companyName}}
</h2>

<div class="d-flex justify-content-end mb-3">
    <i>Dernière modification : {{ $report->updated_at }}</i>
</div>

<div class="d-flex justify-content-end mb-3">
    @if (Auth::user()->id == $report->internship->intern_id)
        <form method="POST" action="{{route("internshipReport.update", $report->id)}}">
            @method('PUT')
            @csrf
            <select name="status" id="status">
                @foreach ($reportStatus as $status)
                <option value="{{$status->status}}" @if ($status->id == $report->status_id) selected @endif>{{$status->status}}</option>
                @endforeach
            </select>
        </form>
    @else
        @foreach ($reportStatus as $status)
            @if ($status->id == $report->status_id) 
                Statut : {{$status->status}}
            @endif
        @endforeach
    @endif
</div>

@foreach ($report->sections as $section)
<section>
    <form method="POST" action="{{route("reportSection.update", $section->id)}}">
        @method('PUT')
        @csrf      
        <table class="larastable">
            <tr scope="row">
                <th scope="col-md-2">Titre</th>
                <th>
                    <div class="input-rendering">{{$section->name}}</div>
                    <input class="w-100" type="text" name="title" value="{{$section->name}}" hidden />
                </th>
            </tr>
            <tr scope="row">
                <td>Description</td>
                <td class="w-100">
                    <div class="raw-markdown" hidden>{!!$section->text!!}</div>
                    <div class="description-rendering">{!!$section->text!!}</div>
                    <textarea name="description" hidden>{!!$section->text!!}</textarea>
                </td>
            </tr>
        </table>
        @if (Auth::user()->id == $report->internship->intern_id)
        <div class="d-flex justify-content-end mb-3 mt-1">
            <button name="edit" type="button" class="btn-warning">Editer</button>
            <button name="delete" type="button" class="btn-danger">Supprimer</button>
            <button name="cancel" type="button" class="btn-danger" hidden>Annuler</button>
            <button name="save" type="submit" class="btn-success" hidden>Enregistrer</button>
        </div>
        @endif
    </form>
</section>
@endforeach

<section id="newSection" hidden>
    <form method="POST" action="{{route("reportSection.store", $report->id)}}">
        @csrf      
        <table class="table text-left larastable">
            <tr scope="row">
                <td scope="col-md-2">Titre</td>
                <td>
                    <input type="text" name="title" class="w-100" />
                </td>
            </tr>
            <tr scope="row">
                <td>Description</td>
                <td class="Description">
                    <textarea name="description" class="w-100"></textarea>
                </td>
            </tr>
        </table>
        <div class="d-flex justify-content-end mb-3">
            <button name="edit" type="button" class="btn-warning">Editer</button>
            <button name="delete" type="button" class="btn-danger">Supprimer</button>
            <button name="cancel" type="button" class="btn-danger" hidden>Annuler</button>
            <button name="save" type="submit" class="btn-success" hidden>Enregistrer</button>
        </div>
    </form>
</section>

@if (Auth::user()->id == $report->internship->intern_id)
<div class="d-flex justify-content-end mb-3">
    <button name="create" type="button" class="btn-success">Créer une section</button>
</div>
@endif

@endsection

@push ('page_specific_js')
<script src="/js/internshipreport.js"></script>
@endpush