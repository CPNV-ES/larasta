{{-- Menu for admin functions --}}
@extends ('layout')

@section ('content')
    <div class="enterprises">
        @foreach($companies as $company)
        <div class="enterprise">
            <span class="delete">x</span>
            <span class="enterpriseName">{{$company->companyName}}</span>
            <span class="enterpriseDate">{{$company->internship->sortByDesc('endDate')->first()->endDate}}</span>
            <div class="responsibles">
                @foreach($company->internship->unique('responsible_id') as $internship)
                   <div class="responsible" email="{{json_encode($internship->responsible->emails())}}">{{$internship->responsible->lastname}} <span class="delete">x</span></div>
                @endforeach
            </div>
            <div class="showDeletedResponsibles d-none">()</div>
        </div>
        @endforeach
        <div class="showDeletedEnterprises d-none"></div>
            <button class="cmdMail">Envoyer un mail</button>
    </div>
@stop

@push('page_specific_css')
    <link rel="stylesheet" href="/css/mpmenu.css">
    <link rel="stylesheet" href="/css/mailing.css">
@endpush
@push('page_specific_js')
    <script src="/js/mailing.js"></script>
@endpush
