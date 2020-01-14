@extends ('layout')

@section ('content')

    <div class="container-fluid">
        <div class="row content-box text-left">
            <div class="col-lg-8 col-lg-offset-2">
                <h5>Nouveau stage chez </h5>
                <div class="table-responsive">
                    <form action="/stage" method="post">
                        <label>Début de stage :&nbsp;</label>
                        <input type="date" name="startDate">
                        <br />
                        <label>Fin de stage :&nbsp;</label>
                        <input type="date" name="endDate">
                        <br />
                        @foreach($companypersons as $companyperson)
                        <label>Responsable administratif :&nbsp;</label>
                        <select name="administratorManager" size="1">
                            <option name="responsible_id" selected>{{ $companyperson->firstname }} {{ $companyperson->lastname }}</option>
                        </select>
                        <br />
                        <label>Responsable :&nbsp;</label>
                        <select name="manager" size="1">
                                <option name="admin_id" selected>{{ $companyperson->firstname }} {{ $companyperson->lastname }}</option>
                        </select>
                        @endforeach
                        <br /><br />
                        <a href="/entreprise">
                            <button type="button" class="">Créer un nouveau stage</button>
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

