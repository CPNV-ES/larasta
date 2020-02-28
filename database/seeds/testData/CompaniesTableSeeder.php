<?php

use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('companies')->delete();
        
        \DB::table('companies')->insert(array (
            0 => 
            array (
                'companyName' => 'Brandi IT Services',
                'contracts_id' => 3,
                'driverLicence' => 0,
                'englishSkills' => 0,
                'id' => 25,
                'location_id' => 525,
                'mptOk' => 0,
                'website' => NULL,
            ),
            1 => 
            array (
                'companyName' => 'CEPM ',
                'contracts_id' => 4,
                'driverLicence' => 0,
                'englishSkills' => 0,
                'id' => 26,
                'location_id' => 526,
                'mptOk' => 0,
                'website' => 'www.vd.ch/etablissements-de-formation/centre-denseignement-professionnel-de-morges-cepm/le-centre',
            ),
            2 => 
            array (
                'companyName' => 'CISOFT',
                'contracts_id' => 3,
                'driverLicence' => 0,
                'englishSkills' => 0,
                'id' => 27,
                'location_id' => 527,
                'mptOk' => 1,
                'website' => NULL,
            ),
            3 => 
            array (
                'companyName' => 'Ecole Cantonale d&apos;Art de Lausanne',
                'contracts_id' => 4,
                'driverLicence' => 0,
                'englishSkills' => 0,
                'id' => 28,
                'location_id' => 528,
                'mptOk' => 1,
                'website' => NULL,
            ),
            4 => 
            array (
                'companyName' => 'EPCN',
                'contracts_id' => 4,
                'driverLicence' => 0,
                'englishSkills' => 0,
                'id' => 29,
                'location_id' => 529,
                'mptOk' => 0,
                'website' => 'http://www.epcn.ch',
            ),
            5 => 
            array (
                'companyName' => 'EPFL - Domain IT',
                'contracts_id' => 3,
                'driverLicence' => 0,
                'englishSkills' => 0,
                'id' => 30,
                'location_id' => 530,
                'mptOk' => 1,
                'website' => NULL,
            ),
            6 => 
            array (
                'companyName' => 'École Professionnelle EPSIC',
                'contracts_id' => 4,
                'driverLicence' => 0,
                'englishSkills' => 0,
                'id' => 31,
                'location_id' => 531,
                'mptOk' => 1,
                'website' => NULL,
            ),
            7 => 
            array (
                'companyName' => 'ETML',
                'contracts_id' => 4,
                'driverLicence' => 0,
                'englishSkills' => 0,
                'id' => 32,
                'location_id' => 532,
                'mptOk' => 1,
                'website' => NULL,
            ),
            8 => 
            array (
                'companyName' => 'ETVJ Ecole Technique de la Vallée de Joux',
                'contracts_id' => 4,
                'driverLicence' => 0,
                'englishSkills' => 0,
                'id' => 33,
                'location_id' => 533,
                'mptOk' => 1,
                'website' => NULL,
            ),
            9 => 
            array (
                'companyName' => 'Gymnase de Beaulieu',
                'contracts_id' => 4,
                'driverLicence' => 0,
                'englishSkills' => 0,
                'id' => 34,
                'location_id' => 534,
                'mptOk' => 1,
                'website' => NULL,
            ),
            10 => 
            array (
                'companyName' => 'HEIG-VD',
                'contracts_id' => 4,
                'driverLicence' => 0,
                'englishSkills' => 0,
                'id' => 35,
                'location_id' => 535,
                'mptOk' => 1,
                'website' => NULL,
            ),
            11 => 
            array (
                'companyName' => 'Helvetica Partners Sàrl',
                'contracts_id' => 3,
                'driverLicence' => 0,
                'englishSkills' => 0,
                'id' => 36,
                'location_id' => 536,
                'mptOk' => 1,
                'website' => NULL,
            ),
            12 => 
            array (
                'companyName' => 'IMD',
                'contracts_id' => 3,
                'driverLicence' => 0,
                'englishSkills' => 0,
                'id' => 37,
                'location_id' => 537,
                'mptOk' => 0,
                'website' => NULL,
            ),
            13 => 
            array (
            'companyName' => 'NagraVision (Kudelski)',
                'contracts_id' => 3,
                'driverLicence' => 0,
                'englishSkills' => 0,
                'id' => 38,
                'location_id' => 538,
                'mptOk' => 1,
                'website' => 'http://www.nagra.com',
            ),
            14 => 
            array (
                'companyName' => 'Medtronic',
                'contracts_id' => 3,
                'driverLicence' => 0,
                'englishSkills' => 0,
                'id' => 39,
                'location_id' => 539,
                'mptOk' => 1,
                'website' => NULL,
            ),
            15 => 
            array (
                'companyName' => 'MerckSerono',
                'contracts_id' => 3,
                'driverLicence' => 0,
                'englishSkills' => 0,
                'id' => 40,
                'location_id' => 540,
                'mptOk' => 1,
                'website' => NULL,
            ),
            16 => 
            array (
            'companyName' => 'Nespresso (Orbe)',
                'contracts_id' => 3,
                'driverLicence' => 0,
                'englishSkills' => 0,
                'id' => 41,
                'location_id' => 541,
                'mptOk' => 1,
                'website' => NULL,
            ),
            17 => 
            array (
            'companyName' => 'Nespresso (Avenches)',
                'contracts_id' => 3,
                'driverLicence' => 0,
                'englishSkills' => 0,
                'id' => 42,
                'location_id' => 542,
                'mptOk' => 0,
                'website' => NULL,
            ),
            18 => 
            array (
                'companyName' => 'Nestlé Product Technology Center',
                'contracts_id' => 3,
                'driverLicence' => 0,
                'englishSkills' => 0,
                'id' => 43,
                'location_id' => 543,
                'mptOk' => 1,
                'website' => NULL,
            ),
            19 => 
            array (
                'companyName' => 'Nestlé Research Center',
                'contracts_id' => 3,
                'driverLicence' => 0,
                'englishSkills' => 0,
                'id' => 44,
                'location_id' => 544,
                'mptOk' => 0,
                'website' => NULL,
            ),
            20 => 
            array (
                'companyName' => 'Nestlé Suisse SA',
                'contracts_id' => 3,
                'driverLicence' => 0,
                'englishSkills' => 0,
                'id' => 45,
                'location_id' => 545,
                'mptOk' => 1,
                'website' => NULL,
            ),
            21 => 
            array (
                'companyName' => 'Swisstems',
                'contracts_id' => 3,
                'driverLicence' => 1,
                'englishSkills' => 0,
                'id' => 46,
                'location_id' => 546,
                'mptOk' => 1,
                'website' => NULL,
            ),
            22 => 
            array (
                'companyName' => 'Université de Lausanne',
                'contracts_id' => 4,
                'driverLicence' => 0,
                'englishSkills' => 0,
                'id' => 47,
                'location_id' => 547,
                'mptOk' => 1,
                'website' => NULL,
            ),
            23 => 
            array (
                'companyName' => 'Canal + Distribution',
                'contracts_id' => 3,
                'driverLicence' => 0,
                'englishSkills' => 0,
                'id' => 48,
                'location_id' => 548,
                'mptOk' => 1,
                'website' => NULL,
            ),
            24 => 
            array (
                'companyName' => 'Ecole hôtelière de Lausanne',
                'contracts_id' => 3,
                'driverLicence' => 0,
                'englishSkills' => 1,
                'id' => 50,
                'location_id' => 550,
                'mptOk' => 1,
                'website' => 'http://www.ehl.edu/fre',
            ),
            25 => 
            array (
                'companyName' => 'Fondation Eben-Hézer ',
                'contracts_id' => 3,
                'driverLicence' => 0,
                'englishSkills' => 0,
                'id' => 52,
                'location_id' => 552,
                'mptOk' => 1,
                'website' => NULL,
            ),
            26 => 
            array (
                'companyName' => 'SI - Ville de Lausanne',
                'contracts_id' => 3,
                'driverLicence' => 0,
                'englishSkills' => 0,
                'id' => 55,
                'location_id' => 555,
                'mptOk' => 1,
                'website' => NULL,
            ),
            27 => 
            array (
                'companyName' => 'World-Connect',
                'contracts_id' => 3,
                'driverLicence' => 0,
                'englishSkills' => 0,
                'id' => 57,
                'location_id' => 557,
                'mptOk' => 1,
                'website' => 'http://www.world-connect.ch',
            ),
            28 => 
            array (
                'companyName' => 'Alltitude',
                'contracts_id' => 3,
                'driverLicence' => 0,
                'englishSkills' => 0,
                'id' => 58,
                'location_id' => 558,
                'mptOk' => 1,
                'website' => NULL,
            ),
            29 => 
            array (
                'companyName' => 'Intrepid Knowledge',
                'contracts_id' => 3,
                'driverLicence' => 0,
                'englishSkills' => 0,
                'id' => 60,
                'location_id' => 560,
                'mptOk' => 1,
                'website' => 'http://www.intrepidknowledge.ch',
            ),
            30 => 
            array (
                'companyName' => 'Ecoscan',
                'contracts_id' => 3,
                'driverLicence' => 0,
                'englishSkills' => 0,
                'id' => 66,
                'location_id' => 566,
                'mptOk' => 1,
                'website' => NULL,
            ),
            31 => 
            array (
                'companyName' => 'Commune de Payerne',
                'contracts_id' => 3,
                'driverLicence' => 0,
                'englishSkills' => 0,
                'id' => 69,
                'location_id' => 569,
                'mptOk' => 1,
                'website' => 'http://www.payerne.ch ',
            ),
            32 => 
            array (
                'companyName' => 'VO Energies',
                'contracts_id' => 3,
                'driverLicence' => 0,
                'englishSkills' => 0,
                'id' => 70,
                'location_id' => 570,
                'mptOk' => 1,
                'website' => 'http://www.voenergies.ch',
            ),
            33 => 
            array (
                'companyName' => 'DSI',
                'contracts_id' => 4,
                'driverLicence' => 0,
                'englishSkills' => 0,
                'id' => 71,
                'location_id' => 571,
                'mptOk' => 1,
                'website' => 'http://www.vd.ch/autorites/departements/dirh/systemes-dinformation/',
            ),
            34 => 
            array (
                'companyName' => 'Wifx',
                'contracts_id' => 3,
                'driverLicence' => 1,
                'englishSkills' => 0,
                'id' => 74,
                'location_id' => 574,
                'mptOk' => 1,
                'website' => 'http://www.wifx.net',
            ),
            35 => 
            array (
                'companyName' => 'Vaudoise Assurances',
                'contracts_id' => 3,
                'driverLicence' => 0,
                'englishSkills' => 0,
                'id' => 75,
                'location_id' => 575,
                'mptOk' => 1,
                'website' => 'http://www.vaudoise.ch',
            ),
            36 => 
            array (
                'companyName' => 'Swissquote',
                'contracts_id' => 3,
                'driverLicence' => 0,
                'englishSkills' => 0,
                'id' => 78,
                'location_id' => 578,
                'mptOk' => 1,
                'website' => 'http://www.swissquote.ch',
            ),
            37 => 
            array (
                'companyName' => 'EESP',
                'contracts_id' => 4,
                'driverLicence' => 0,
                'englishSkills' => 0,
                'id' => 80,
                'location_id' => 580,
                'mptOk' => 1,
                'website' => 'http://www.eesp.ch',
            ),
            38 => 
            array (
            'companyName' => 'Swisscom (ITS SA)',
                'contracts_id' => 3,
                'driverLicence' => 0,
                'englishSkills' => 1,
                'id' => 83,
                'location_id' => 583,
                'mptOk' => 0,
                'website' => 'http://www.itssa.ch',
            ),
            39 => 
            array (
                'companyName' => 'Vaucher',
                'contracts_id' => 3,
                'driverLicence' => 0,
                'englishSkills' => 0,
                'id' => 84,
                'location_id' => 584,
                'mptOk' => 1,
                'website' => 'http://www.vauchermanufacture.ch',
            ),
            40 => 
            array (
                'companyName' => 'Connect-i',
                'contracts_id' => 3,
                'driverLicence' => 0,
                'englishSkills' => 0,
                'id' => 85,
                'location_id' => 585,
                'mptOk' => 1,
                'website' => 'http://www.connect-i.ch',
            ),
            41 => 
            array (
                'companyName' => 'Nimag',
                'contracts_id' => 3,
                'driverLicence' => 0,
                'englishSkills' => 0,
                'id' => 86,
                'location_id' => 586,
                'mptOk' => 1,
                'website' => 'http://www.nimag.net',
            ),
            42 => 
            array (
                'companyName' => 'Vacheron Constantin',
                'contracts_id' => 3,
                'driverLicence' => 0,
                'englishSkills' => 0,
                'id' => 87,
                'location_id' => 587,
                'mptOk' => 1,
                'website' => 'http://www.vacheron-constantin.com/fr/home.html',
            ),
            43 => 
            array (
                'companyName' => 'Commune d\'Yverdon',
                'contracts_id' => 3,
                'driverLicence' => 0,
                'englishSkills' => 0,
                'id' => 89,
                'location_id' => 589,
                'mptOk' => 1,
                'website' => NULL,
            ),
            44 => 
            array (
                'companyName' => 'Southern Regional College',
                'contracts_id' => 3,
                'driverLicence' => 0,
                'englishSkills' => 0,
                'id' => 90,
                'location_id' => 590,
                'mptOk' => 1,
                'website' => NULL,
            ),
            45 => 
            array (
                'companyName' => 'E-unit',
                'contracts_id' => 3,
                'driverLicence' => 0,
                'englishSkills' => 0,
                'id' => 91,
                'location_id' => 591,
                'mptOk' => 1,
                'website' => 'http://www.e-unit.ch/accueil/',
            ),
            46 => 
            array (
                'companyName' => 'TTT',
                'contracts_id' => 3,
                'driverLicence' => 0,
                'englishSkills' => 0,
                'id' => 92,
                'location_id' => 592,
                'mptOk' => 1,
                'website' => 'http://www.tttonline.ch',
            ),
            47 => 
            array (
                'companyName' => 'Liip',
                'contracts_id' => 3,
                'driverLicence' => 0,
                'englishSkills' => 0,
                'id' => 94,
                'location_id' => 594,
                'mptOk' => 1,
                'website' => 'https://www.liip.ch/fr',
            ),
            48 => 
            array (
                'companyName' => 'CFI',
                'contracts_id' => 3,
                'driverLicence' => 0,
                'englishSkills' => 0,
                'id' => 96,
                'location_id' => 596,
                'mptOk' => 1,
                'website' => 'http://www.cfi.ch',
            ),
            49 => 
            array (
                'companyName' => 'Net4all',
                'contracts_id' => 3,
                'driverLicence' => 0,
                'englishSkills' => 0,
                'id' => 97,
                'location_id' => 597,
                'mptOk' => 1,
                'website' => 'http://www.net4all.ch',
            ),
            50 => 
            array (
                'companyName' => 'WhyOpenComputing',
                'contracts_id' => 3,
                'driverLicence' => 0,
                'englishSkills' => 0,
                'id' => 98,
                'location_id' => 598,
                'mptOk' => 1,
                'website' => 'http://whyopencomputing.ch/',
            ),
            51 => 
            array (
                'companyName' => 'Kudelski Security',
                'contracts_id' => 3,
                'driverLicence' => 0,
                'englishSkills' => 0,
                'id' => 99,
                'location_id' => 599,
                'mptOk' => 1,
                'website' => 'https://www.kudelskisecurity.com',
            ),
            52 => 
            array (
                'companyName' => 'Roldeco',
                'contracts_id' => 3,
                'driverLicence' => 0,
                'englishSkills' => 0,
                'id' => 100,
                'location_id' => 600,
                'mptOk' => 1,
                'website' => 'https://www.roldeco.com',
            ),
            53 => 
            array (
                'companyName' => 'Think WebDesign',
                'contracts_id' => 3,
                'driverLicence' => 0,
                'englishSkills' => 0,
                'id' => 101,
                'location_id' => 601,
                'mptOk' => 1,
                'website' => 'http://www.think-webdesign.ch',
            ),
            54 => 
            array (
                'companyName' => 'Apptitude',
                'contracts_id' => 3,
                'driverLicence' => 0,
                'englishSkills' => 0,
                'id' => 102,
                'location_id' => 602,
                'mptOk' => 1,
                'website' => 'https://apptitude.ch',
            ),
            55 => 
            array (
                'companyName' => 'Integrity STS',
                'contracts_id' => 3,
                'driverLicence' => 0,
                'englishSkills' => 0,
                'id' => 103,
                'location_id' => 603,
                'mptOk' => 1,
                'website' => 'http://www.integritysts.com',
            ),
            56 => 
            array (
            'companyName' => 'NagraStar (Kudelski)',
                'contracts_id' => 3,
                'driverLicence' => 0,
                'englishSkills' => 1,
                'id' => 104,
                'location_id' => 604,
                'mptOk' => 1,
                'website' => NULL,
            ),
            57 => 
            array (
                'companyName' => 'Nespresso Suisse',
                'contracts_id' => 3,
                'driverLicence' => 0,
                'englishSkills' => 0,
                'id' => 105,
                'location_id' => 605,
                'mptOk' => 1,
                'website' => NULL,
            ),
            58 => 
            array (
                'companyName' => 'South West College',
                'contracts_id' => 3,
                'driverLicence' => 0,
                'englishSkills' => 1,
                'id' => 109,
                'location_id' => 609,
                'mptOk' => 1,
                'website' => 'http://www.theinnotechcentre.com',
            ),
            59 => 
            array (
                'companyName' => 'Gymnase de Renens',
                'contracts_id' => 4,
                'driverLicence' => 0,
                'englishSkills' => 0,
                'id' => 110,
                'location_id' => 610,
                'mptOk' => 1,
                'website' => NULL,
            ),
            60 => 
            array (
                'companyName' => 'Mairie de Marseille',
                'contracts_id' => 3,
                'driverLicence' => 0,
                'englishSkills' => 0,
                'id' => 111,
                'location_id' => 611,
                'mptOk' => 1,
                'website' => NULL,
            ),
            61 => 
            array (
                'companyName' => 'Microdia',
                'contracts_id' => 3,
                'driverLicence' => 0,
                'englishSkills' => 0,
                'id' => 112,
                'location_id' => 612,
                'mptOk' => 1,
                'website' => NULL,
            ),
            62 => 
            array (
                'companyName' => 'Commune de Montreux',
                'contracts_id' => 3,
                'driverLicence' => 0,
                'englishSkills' => 0,
                'id' => 113,
                'location_id' => 613,
                'mptOk' => 1,
                'website' => NULL,
            ),
            63 => 
            array (
                'companyName' => 'Tchek',
                'contracts_id' => 3,
                'driverLicence' => 0,
                'englishSkills' => 0,
                'id' => 114,
                'location_id' => 614,
                'mptOk' => 1,
                'website' => 'http://www.moncarrosse.com',
            ),
            64 => 
            array (
                'companyName' => 'Sinartis',
                'contracts_id' => 3,
                'driverLicence' => 0,
                'englishSkills' => 0,
                'id' => 115,
                'location_id' => 615,
                'mptOk' => 1,
                'website' => 'http://sinartis.ch',
            ),
            65 => 
            array (
                'companyName' => 'EPFL - VPSI',
                'contracts_id' => 3,
                'driverLicence' => 0,
                'englishSkills' => 0,
                'id' => 116,
                'location_id' => 616,
                'mptOk' => 1,
                'website' => 'http://vpsi.epfl.ch/',
            ),
        ));
        
        
    }
}