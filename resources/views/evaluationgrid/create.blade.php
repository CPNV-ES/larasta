@extends('layout')
@section('content')

    <script>
        let usedTemplatesNames = {!! \App\Evaluation::templates()->pluck('template_name')->toJson() !!}
        let currentTemplate = {!! json_encode($currentTemplate) !!}
    </script>
    <form action="/admin/evaluationgrid/storeTemplate" method="post">
        @csrf
        <h1>Nouvelle grille d'évaluation</h1>
        <div class="container">
            <label for="name">Nom de la grille d'évaluation</label>
            <input id="name" class="form-control" name="name" type="text" minlength="3" maxlength="45" required/>
        </div>
        <br/>
        <button type="button" id="btn-new-section" class="btn btn-info" data-toggle="modal" data-target="#newSectionModal">+ Nouvelle section</button>

        <div id="sections-container">

        </div>
        <br/>
        <button class="btn btn-primary" type="submit">Enregistrer</button>
    </form>

    <div class="modal fade" id="newSectionModal" tabindex="-1" role="dialog" aria-labelledby="newSectionModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newSectionModalLabel">Nouvelle section</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="new-section-name">Nom</label>
                        <input id="new-section-name" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="new-section-type">Type</label>
                        <select id="new-section-type" class="form-control">
                            <option value="1">Type 1 (critères + observations attendues)</option>
                            <option value="2">Type 2 (critères + tâches)</option>
                            <option value="3">Type 3 (critères)</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="new-section-is-graded">Notée ?</label>
                        <input type="checkbox" id="new-section-is-graded" class="form-control" />
                    </div>
                </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-primary" id="newSectionModalSaveBtn">OK</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('page_specific_js')
    <script src="/js/evalgridcreate.js"></script>
@endpush
@push ('page_specific_css')
    <link rel="stylesheet" href="/css/evalGrid.css">
@endpush