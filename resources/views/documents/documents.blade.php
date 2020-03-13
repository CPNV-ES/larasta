@extends ('layout')

@push ('page_specific_css')
    <link rel="stylesheet" type="text/css" href="/css/documents.css"></script>
@endpush

@section ('content')
    <h1>Documents</h1>
    <div id="documents" class="container">
        <p>La formation d'informaticien CFC contient deux stages :</p>
        <ol>
            <li>Stage 1: Sept mois de début février à fin août (6<sup>ème</sup> semestre)</li>
            <li>Stage 2: Cinq mois de début septembre à fin janvier (7<sup>ème</sup> semestre)</li>
        </ol>
        <p>Les deux stages se déroulent de manière similaire:</p>
        <img src="../images/phasesDocumentsPage.png" alt="deroulement">
        <h2>Phases</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Phase</th>
                    <th scope="col">Description</th>
                    <th scope="col">Documents</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">Préparation</th>
                    <td>
                        <p>Le maître principal s'assure que les la liste d'élèves candidats pour les stages est correcte dans l'application. Il valide également la liste des places de stage disponibles, qu'il met dans l'état "reconduit" s'il s'agit d'une entreprise/établissement ayant déjà un stagiaire ou dans "confirmé" s'il s'agit d'une nouvelle place.
                        Le tableau des souhaits est alors prêt
                        De leur côté, les élèves préparent leur dossier de candidature avec l'appui des professeurs de français</p>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <th>Souhaits</th>
                    <td>
                        <p>Les élèves accèdent à l'application et ont la possibilité de poser trois souhaits librement Ils commencent la préparation de leur CV et de leur lettre de motivation</p>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <th scope="row">Attribution</th>
                    <td>
                            <p>les maîtres de classe se concertent et procèdent à l'attribution des places pour les élèves de leur classe et pour les deux stages. 
                            Les critères déterminant sont:</p>
                            <ul>
                                <li>La distance entre le lieu de résidence de l'apprenti et celui de la place de stage </li>
                                <li>Le type d'activités proposées par la place de stage.</li>
                                <li>Le stagiaire précédent dans l'entreprise</li>
                            </ul>
                            <p>Dès qu'une place de stage est attribuée (case bleue), l'élève envoie son dossier de candidature à l'entreprise, sous format électronique avec copie à son maître de classe.
                            Lorsqu'il/elle reçoit une réponse (positive ou négative), il la communique à son maître classe qui la reporte dans l'application.
                            En cas de réponse positive, l'élève entame le processus de rédaction du "contrat tripartite", lequel est différent selon que le stage est en entreprise ou dans un</p>
                    </td>
                    <td>
                        <ul>
                            <li><a href="../documentsLink/DS-ES-11.docx">Contrat de stage en entreprise</a></li>
                            <li><a href="../documentsLink/DS-ES-12.docx">Contrat de stage à l'état de Vaud</a></li>
                            <li><a href="../documentsLink/processus.pdf">Détails sur le le processus de rédaction du contrat</a></li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Déroulement</th>
                    <td>
                        <p>Le stagiaire travaille dans l'entreprise, selon ses horaires. Il remplit quotidiennement un journal de travail, qu'il envoie chaque semaine à son maître de classe.
                        Les élèves en voie matu reviennent à Saint-Croix un jour par semaine pour les cours matu.
                        Le maître de classe effectue deux visites en entreprise, qui font l'objet d'une évaluation.
                        L'élève prépare un rapport de stage et une présentation. Le maître de classe organise une ou plusieurs réunion(s) où les élèves présentent leur stage à leurs camarades, professeur et maître de stage (qui sont invités mais dont la présence n'est pas formellement requise)</p>
                    </td>
                    <td>
                        <ul>
                            <li><a href="../documentsLink/Grille.xlsx">Grille d'évaluation</a></li>
                            <li><a href="../documentsLink/journalDeTravail.xlsx">Modèle de journal de travail (exemple)</a></li>
                            <li><a href="../documentsLink/Directives_pour_rapport_de_stage.pdf">Directives de rédaction du rapport de stage</a></li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Prospection</th>
                    <td>
                        <p>Le maître principal s'assure qu'un nombre suffisant de places de stages peuvent être proposées aux élèves. Pour cela, ils contacte les entreprises et s'assure que le cadre offert est propice à l'accueil d'un stagiaire.
                        Tout au long de ce processus, les places de stages sont maintenues à jour sur l'intranet.</p>
                    </td>
                    <td>
                        <ul>
                            <li><a href="../documentsLink/FormulaireStage.pdf">Stages en entreprise pour apprenti</a></li>
                        </ul>
                    </td>
                </tr>
            </tbody>
            
        </table>
        <h2>Dates</h2>
        <table class="table">
            <thead>
                <tr>
                    <td scope="col"></td>
                    <td scope="col">Stage 1</td>
                    <td scope="col">Stage 2</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td scope="row">T0</td>
                    <td>Début des vacances d'automne</td>
                    <td>1<sup>er</sup> Mai</td>
                </tr>
                <tr>
                    <td scope="row">T1</td>
                    <td>Rentrée des vacances d'automne</td>
                    <td>Ascension</td>
                </tr>
                <tr>
                    <td scope="row">T2</td>
                    <td>Début du trimestre 2 (début novembre)</td>
                    <td>Pentecôte</td>
                </tr>
                <tr>
                    <td scope="row">Début</td>
                    <td>1<sup>er</sup> Février</td>
                    <td>1<sup>er</sup> Septembre</td>
                </tr>
                <tr>
                    <td scope="row">Visite 1</td>
                    <td>Avant les vacances de Pâques</td>
                    <td>Avant les vacances d'automne</td>
                </tr>
                <tr>
                    <td scope="row">Visite 2</td>
                    <td>Entre l'Ascension et Pentecôte</td>
                    <td>Avant Noël</td>
                </tr>
                <tr>
                    <td scope="row">Présentation</td>
                    <td>Durant la semaine spéciale de fin d'année</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td scope="row">Fin</td>
                    <td>31 Août</td>
                    <td>31 Janvier</td>
                </tr>
            </tbody>
            
        </table>
    </div>
    

@stop

@push ('page_specific_js')
    <script src="/js/reconstages.js"></script>
@endpush