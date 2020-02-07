<?php

use Illuminate\Database\Seeder;

class ContractstatesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('contractstates')->delete();
        
        \DB::table('contractstates')->insert(array (
            0 => 
            array (
            'details' => 'Le maître principal (MP) contacte l’entreprise et évalue la pertinence de l‘idée : L’environnement de travail est-il bon ? L’entreprise pourra-t-elle fournir un encadrement adéquat ? Les missions confiées au stagiaire sont-elles adaptées ? Sont-elles variées ? Le principe de la rémunération et les différences entre CFC et MPT sont-ils acceptables ?',
                'id' => 1,
                'openForApplication' => 0,
                'openForRenewal' => 0,
                'stateDescription' => 'Idée',
            ),
            1 => 
            array (
            'details' => 'Le stage est listé dans la page « souhaits » de l’application. Les élèves peuvent émettre leur souhait de faire ce stage.Début novembre pour février ou début juin pour septembre,  le vote est clos. Les maîtres de classe (MC) et le MP procèdent à l’attribution des places en fonction des souhaits, des attentes des entreprises, des compétences des élèves et des distances entre le domicile et le lieu de travail. Chaque élève postule pour la ou les place(s) attribuée(s). Une postulation consiste en un CV et une lettre au format pdf envoyé par email à la ou les personne(s) responsable(s) du stage dans l’entreprise, avec copie au MC. ',
                'id' => 2,
                'openForApplication' => 1,
                'openForRenewal' => 0,
                'stateDescription' => 'Reconduit',
            ),
            2 => 
            array (
            'details' => '(obsolet)',
                'id' => 3,
                'openForApplication' => 0,
                'openForRenewal' => 0,
                'stateDescription' => 'Considération',
            ),
            3 => 
            array (
                'details' => 'La personne consultée ne pouvant pas prendre de décision formelle, elle regarde en interne s’il est possible de prendre un stagiaire.',
                'id' => 4,
                'openForApplication' => 0,
                'openForRenewal' => 0,
                'stateDescription' => 'Accord de principe',
            ),
            4 => 
            array (
            'details' => '(obsolet)',
                'id' => 5,
                'openForApplication' => 0,
                'openForRenewal' => 0,
                'stateDescription' => 'Rejeté',
            ),
            5 => 
            array (
            'details' => 'Le stage est listé dans la page « souhaits » de l’application. Les élèves peuvent émettre leur souhait de faire ce stage.Début novembre pour février ou début juin pour septembre,  le vote est clos. Les maîtres de classe (MC) et le MP procèdent à l’attribution des places en fonction des souhaits, des attentes des entreprises, des compétences des élèves et des distances entre le domicile et le lieu de travail. Chaque élève postule pour la ou les place(s) attribuée(s). Une postulation consiste en un CV et une lettre au format pdf envoyé par email à la ou les personne(s) responsable(s) du stage dans l’entreprise, avec copie au MC. ',
                'id' => 6,
                'openForApplication' => 1,
                'openForRenewal' => 0,
                'stateDescription' => 'Confirmé',
            ),
            6 => 
            array (
            'details' => '(obsolet)',
                'id' => 7,
                'openForApplication' => 1,
                'openForRenewal' => 0,
                'stateDescription' => 'Attribué',
            ),
            7 => 
            array (
                'details' => 'L’élève prépare le contrat et le soumet au doyen',
                'id' => 8,
                'openForApplication' => 0,
                'openForRenewal' => 1,
                'stateDescription' => 'Rédaction contrat',
            ),
            8 => 
            array (
                'details' => 'Le doyen signe les trois exemplaires',
                'id' => 9,
                'openForApplication' => 0,
                'openForRenewal' => 1,
                'stateDescription' => 'Signature Doyen',
            ),
            9 => 
            array (
                'details' => 'Les trois exemplaires signés par l’élève sont dans les mains de l’entreprise, qui procède à leur signature et les rendent à l’élève.',
                'id' => 10,
                'openForApplication' => 0,
                'openForRenewal' => 1,
                'stateDescription' => 'Signature Entreprise',
            ),
            10 => 
            array (
            'details' => '(obsolet)',
                'id' => 11,
                'openForApplication' => 0,
                'openForRenewal' => 0,
                'stateDescription' => 'Annulé',
            ),
            11 => 
            array (
                'details' => 'Le stage est en cours',
                'id' => 12,
                'openForApplication' => 0,
                'openForRenewal' => 1,
                'stateDescription' => 'Signé',
            ),
            12 => 
            array (
                'details' => 'Le stage s’est terminé normalement. Le processus se termine là en ce qui concerne cette place de stage. Ce stage peut servir de modèle de base pour une nouvelle place plus tard.',
                'id' => 13,
                'openForApplication' => 0,
                'openForRenewal' => 0,
                'stateDescription' => 'Effectué',
            ),
            13 => 
            array (
                'details' => 'A l’un ou l’autre moment durant le stage, l’une des parties a décidé d’y mettre un terme. Le processus se termine là en ce qui concerne cette place de stage. Ce stage peut servir de modèle de base pour une nouvelle place plus tard.',
                'id' => 14,
                'openForApplication' => 0,
                'openForRenewal' => 0,
                'stateDescription' => 'Interrompu',
            ),
        ));
        
        
    }
}