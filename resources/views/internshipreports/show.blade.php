@extends ('layout')

@section ('content')
<h2>Rapport de stage de {{ $report->internship->student->firstname }} {{ $report->internship->student->lastname }} chez
    {{$report->internship->company->companyName}}</h2>

@if (count($report->sections) < 1) <section class="mb-5">
    <form method="POST" action="{{route("internshipReport.store", $report->id)}}">
        @csrf
        <table class="table text-left larastable mt-5">
            <tr scope="row">
                <td scope="col-md-2">Titre</td>
                <td>
                    <input id="title1" type="text" name="title" class="w-100"
                        value="Description du contexte de mon stage (entreprise, domaine d'activité, rôles, etc...)"
                        readonly />
                </td>
            </tr>
            <tr scope="row">
                <td>Description</td>
                <td class="Description">
                    <textarea id="description" name="description" class="w-100" readonly></textarea>
                </td>
            </tr>
        </table>
        <button id="edit" name="edit" type="button" class="btn-warning">Editer</button>
        <button id="save" name="save" type="submit" class="btn-success save-button" hidden>Enregistrer</button>
    </form>
    </section>

    <section class="mb-5">
        <form method="POST" action="{{route("internshipReport.store", $report->id)}}">
            @csrf
            <table class="table text-left larastable mt-5">
                <tr scope="row">
                    <td scope="col-md-2">Titre</td>
                    <td>
                        <input id="title1" type="text" name="title" class="w-100"
                            value="Description de mon plan de carrière" readonly />
                    </td>
                </tr>
                <tr scope="row">
                    <td>Description</td>
                    <td class="Description">
                        <textarea id="description" name="description" class="w-100" readonly></textarea>
                    </td>
                </tr>
            </table>
            <button id="edit" name="edit" type="button" class="btn-warning">Editer</button>
            <button id="save" name="save" type="submit" class="btn-success" hidden>Enregistrer</button>
        </form>
    </section>

    <section class="mb-5">
        <form method="POST" action="{{route("internshipReport.store", $report->id)}}">
            @csrf
            <table class="table text-left larastable mt-5">
                <tr scope="row">
                    <td scope="col-md-2">Titre</td>
                    <td>
                        <input id="title" type="text" name="title" class="w-100"
                            value="Description de mon équipe (mission, personnes, rôles, organisation, ...)" readonly />
                    </td>
                </tr>
                <tr scope="row">
                    <td>Description</td>
                    <td class="Description">
                        <textarea id="description" name="description" class="w-100" readonly></textarea>
                    </td>
                </tr>
            </table>
            <button id="edit" name="edit" type="button" class="btn-warning">Editer</button>
            <button id="save" name="save" type="submit" class="btn-success" hidden>Enregistrer</button>
        </form>
    </section>
    @else
    @foreach ($report->sections as $section)
    <section class="mb-5">
        <form method="POST" action="{{route("internshipReport.store", $report->id)}}">
            @csrf
            <table class="table text-left larastable mt-5">
                <tr scope="row">
                    <td scope="col-md-2">Titre</td>
                    <td>
                        <input id="title1" type="text" name="title" class="w-100" value="{{$section->name}}" readonly />
                    </td>
                </tr>
                <tr scope="row">
                    <td>Description</td>
                    <td class="Description">
                        <textarea id="description1" name="description" class="w-100" value="{{$section->text}}"
                            readonly></textarea>
                    </td>
                </tr>
            </table>
            <button id="edit" name="edit" type="button" class="btn-warning">Editer</button>
            <button id="save" name="save" type="submit" class="btn-success" hidden>Enregistrer</button>
        </form>
    </section>
    @endforeach

    @endif

    @endsection

    @push ('page_specific_js')
    <script src="/js/internshipreport.js"></script>
    @endpush