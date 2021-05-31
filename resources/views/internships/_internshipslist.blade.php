{{-- Subview that displays a list of internships --}}
{{-- Usage:         @include ('internships._internshipslist',['iships' => $your_array_of_internships])  --}}
<h5 class="titlebar">Stages</h5>
@if (count($iships) > 0)
    <table class="larastable w-100">
        <thead>
        <tr>
            <th>Entreprise</th>
            <th>Début</th>
            <th>Responsable administratif</th>
            <th>Responsable</th>
            <th>Stagiaire</th>
            <th>MC</th>
            <th>Etat</th>
        </tr>
        </thead>
        <tbody>
        @foreach($iships as $iship)
        <tr class="fake-link" data-href="{{route("internships.show", $iship)}}">
            <td>{{ $iship->company->companyName}}</td>
            <td>{{ strftime("%b %g", strtotime($iship->beginDate)) }}</td>
            <td>{{ $iship->admin->fullName ?? ''}}</td> 
            <td>{{ $iship->responsible->fullName ?? '' }}</td>
            <td>{{ $iship->student->fullName ?? '' }}</td>
            <td title="{{ $iship->student->flock->classMaster->fullName ?? ''}}">{{ $iship->student->flock->classMaster->initials ?? ''}}</td>
            <td>{{ $iship->contractstate->stateDescription}}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
@else
    <div class="alert-info">Aucun stage ne correspond à ce filtre</div>
@endif
