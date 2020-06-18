{{-- Subview that displays a list of internships --}}
{{-- Usage:         @include ('internships._internshipslist',['iships' => $your_array_of_internships])  --}}
@if (count($iships) > 0)
    <table class="larastable">
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
        <tr class="fake-link" data-href="{{route("internship", $iship)}}">
            <td>{{ $iship->company->companyName}}</td>
            <td>{{ strftime("%b %g", strtotime($iship->beginDate)) }}</td>
            <td>{{ $iship->admin->firstname ?? ''}} {{ $iship->admin->lastname ?? ''}}</td> 
            <td>{{ $iship->responsible->firstname ?? '' }} {{ $iship->iresplastname ?? '' }}</td>
            <td>{{ $iship->student->firstname ?? ''}} {{ $iship->student->lastname ?? '' }}</td>
            <td>{{ $iship->student->flock->classMaster->initials ?? ''}}</td>
            <td>{{ $iship->contractstate->stateDescription}}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
@else
    <div class="alert-info">Aucun stage ne correspond à ce filtre</div>
@endif
