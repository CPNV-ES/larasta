<?php

use Illuminate\Database\Seeder;

class DocumentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('documents')->delete();
        
        \DB::table('documents')->insert(array (
            0 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'Stage34-EBR - NRC.pdf',
                'id' => 3,
                'internships_id' => 34,
            ),
            1 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'Stage29-MBN - IMD.pdf',
                'id' => 5,
                'internships_id' => 29,
            ),
            2 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'Stage26-LCE - ETML.pdf',
                'id' => 6,
                'internships_id' => 26,
            ),
            3 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'Stage28-NKU - IMD.pdf',
                'id' => 7,
                'internships_id' => 28,
            ),
            4 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'Stage35-JMS - Swisstems.pdf',
                'id' => 8,
                'internships_id' => 35,
            ),
            5 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'Stage31-MRA - Kudelski.pdf',
                'id' => 10,
                'internships_id' => 31,
            ),
            6 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'Stage36-AVA - UNIL.pdf',
                'id' => 13,
                'internships_id' => 36,
            ),
            7 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'Stage30-MVS - Kudelski.pdf',
                'id' => 14,
                'internships_id' => 30,
            ),
            8 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'Stage27-JWR - Beaulieu.pdf',
                'id' => 15,
                'internships_id' => 27,
            ),
            9 => 
            array (
                'description' => 'Annexe du Rapport de stage',
                'file' => 'Stage27-Optoma.pdf',
                'id' => 16,
                'internships_id' => 27,
            ),
            10 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'Stage56-Beauverd_Rapport de stage - Bunge.pdf',
                'id' => 17,
                'internships_id' => 56,
            ),
            11 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'Stage52-Blanco_Rapport_De_Stage.pdf',
                'id' => 18,
                'internships_id' => 52,
            ),
            12 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'Stage46-Clerc_RapportDeStage.pdf',
                'id' => 19,
                'internships_id' => 46,
            ),
            13 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'Stage69-Graf_Rapport_de_stageMGF.pdf',
                'id' => 22,
                'internships_id' => 69,
            ),
            14 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'Stage71-Guibert_RapportNestle.pdf',
                'id' => 24,
                'internships_id' => 71,
            ),
            15 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'Stage75-Karoui_Rapport de stage 2013.docx',
                'id' => 25,
                'internships_id' => 75,
            ),
            16 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'Stage53-Leeser_rapport de stage.docx',
                'id' => 26,
                'internships_id' => 53,
            ),
            17 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'Stage40-Martin_RapportStageCEPM.pdf',
                'id' => 27,
                'internships_id' => 40,
            ),
            18 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'Stage64-Shanmuganathan_Rapport_Stage.pdf',
                'id' => 28,
                'internships_id' => 64,
            ),
            19 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'Stage49-Stage49-Geinoz_Rapport_de_stage2013.pdf',
                'id' => 29,
                'internships_id' => 49,
            ),
            20 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'DocumentRapport de stage EBR.pdf',
                'id' => 31,
                'internships_id' => 37,
            ),
            21 => 
            array (
                'description' => 'rapport de stage',
                'file' => 'DocumentRapport de stage MBN.pdf',
                'id' => 32,
                'internships_id' => 48,
            ),
            22 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'DocumentRapport de stage LCE.pdf',
                'id' => 33,
                'internships_id' => 55,
            ),
            23 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'DocumentRapport de stage JMS.pdf',
                'id' => 35,
                'internships_id' => 50,
            ),
            24 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'DocumentGOD - Rapport de stage.pdf',
                'id' => 36,
                'internships_id' => 91,
            ),
            25 => 
            array (
                'description' => 'Description de l\'application',
                'file' => 'DocumentDescription application.pdf',
                'id' => 37,
                'internships_id' => 91,
            ),
            26 => 
            array (
                'description' => 'Manuel utilisateur',
                'file' => 'DocumentManuel utilisateur v1_1.pdf',
                'id' => 38,
                'internships_id' => 91,
            ),
            27 => 
            array (
                'description' => 'Mistra',
                'file' => 'DocumentMistra_Doc.pdf',
                'id' => 39,
                'internships_id' => 91,
            ),
            28 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'Document40_Rapport de stage MRA.pdf',
                'id' => 40,
                'internships_id' => 61,
            ),
            29 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'Document41_L_Rapport de stage MSY.pdf',
                'id' => 41,
                'internships_id' => 60,
            ),
            30 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'Document42_Rapport de stage ETV.pdf',
                'id' => 42,
                'internships_id' => 54,
            ),
            31 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'Document43_Rapport de stage MVS.pdf',
                'id' => 43,
                'internships_id' => 78,
            ),
            32 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'Document45_Rapport de stage - Beauverd- Nestle.pdf',
                'id' => 45,
                'internships_id' => 72,
            ),
            33 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'Document46_Rapport_De_Stage_Guillaume_Blanco.pdf',
                'id' => 46,
                'internships_id' => 74,
            ),
            34 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'Document47_Rapport de stage en entreprise2.pdf',
                'id' => 47,
                'internships_id' => 70,
            ),
            35 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'Document48_Rapport de stage_Ferreira.pdf',
                'id' => 48,
                'internships_id' => 73,
            ),
            36 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'Document49_Rapport de stage Brandi LGZ.docx',
                'id' => 49,
                'internships_id' => 39,
            ),
            37 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'Document50_RapportDeStageFinalTharsshan.pdf',
                'id' => 50,
                'internships_id' => 45,
            ),
            38 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'Document51_Rapport2emeStageMGF.pdf',
                'id' => 51,
                'internships_id' => 67,
            ),
            39 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'Document53_Rapport de stage en entreprise2.pdf',
                'id' => 53,
                'internships_id' => 57,
            ),
            40 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'Document54_Suveeshan - Rapport de stage à vevey.pdf',
                'id' => 54,
                'internships_id' => 65,
            ),
            41 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'Document55_StageNestle_Nikita.pdf',
                'id' => 56,
                'internships_id' => 85,
            ),
            42 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'Document57_Rapport de stage NAGRA.pdf',
                'id' => 57,
                'internships_id' => 84,
            ),
            43 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'Document58_Rapport de stage 2013.docx',
                'id' => 58,
                'internships_id' => 82,
            ),
            44 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'Document59_GOD - Nestlé.pdf',
                'id' => 59,
                'internships_id' => 33,
            ),
            45 => 
            array (
                'description' => 'Rapport',
                'file' => 'Document60_Rapport de stage.pdf',
                'id' => 60,
                'internships_id' => 129,
            ),
            46 => 
            array (
                'description' => 'Rapport',
                'file' => 'Document61_Rapport-de-stage-2014-YC.pdf',
                'id' => 61,
                'internships_id' => 114,
            ),
            47 => 
            array (
                'description' => 'Rapport',
                'file' => 'Document62_RapportStageTGD.pdf',
                'id' => 62,
                'internships_id' => 134,
            ),
            48 => 
            array (
                'description' => 'Rapport',
                'file' => 'Document63_Rapport de stage.pdf',
                'id' => 63,
                'internships_id' => 107,
            ),
            49 => 
            array (
                'description' => 'Rapport',
                'file' => 'Document64_Rapport De Stage.pdf',
                'id' => 64,
                'internships_id' => 105,
            ),
            50 => 
            array (
                'description' => 'Rapport',
                'file' => 'Document65_Rapport de stage- Ilias Goujgali.pdf',
                'id' => 65,
                'internships_id' => 102,
            ),
            51 => 
            array (
                'description' => 'Rapport',
                'file' => 'Document66_Rapport de stage.pdf',
                'id' => 66,
                'internships_id' => 113,
            ),
            52 => 
            array (
                'description' => 'Rapport',
                'file' => 'Document67_Rapport de stage.pdf',
                'id' => 67,
                'internships_id' => 98,
            ),
            53 => 
            array (
                'description' => 'Rapport',
                'file' => 'Document68_Rapport de Stage_Epcn_Nagaratnam_Jaciban .pdf',
                'id' => 68,
                'internships_id' => 100,
            ),
            54 => 
            array (
                'description' => 'Rapport',
                'file' => 'Document69_Rapport_de_stage_Alain_Pichonnat.pdf',
                'id' => 69,
                'internships_id' => 108,
            ),
            55 => 
            array (
                'description' => 'Rapport',
                'file' => 'Document70_FINAL_Rapport de Stage Nestlé Loris_staffieri.pdf',
                'id' => 70,
                'internships_id' => 93,
            ),
            56 => 
            array (
                'description' => 'Rapport',
                'file' => 'Document71_Rapport_de_stage_Gabriel_Wolf.pdf',
                'id' => 71,
                'internships_id' => 119,
            ),
            57 => 
            array (
                'description' => 'Cahier des charges',
                'file' => 'Document72_Placement Student Programme Eric Bousbaa.pdf',
                'id' => 72,
                'internships_id' => 232,
            ),
            58 => 
            array (
                'description' => 'Descriptif',
                'file' => 'Document73_JAZBrochure.pdf',
                'id' => 73,
                'internships_id' => 186,
            ),
            59 => 
            array (
                'description' => 'Descriptif',
                'file' => 'Document74_HDSBrochure Rapport de Stage.pdf',
                'id' => 74,
                'internships_id' => 161,
            ),
            60 => 
            array (
                'description' => 'Descriptif',
            'file' => 'Document75_Depliant-Noé-Ferrari(v2).zip',
                'id' => 75,
                'internships_id' => 180,
            ),
            61 => 
            array (
                'description' => 'Descriptif',
                'file' => 'Document76_TGDFlyer_final.pdf',
                'id' => 76,
                'internships_id' => 183,
            ),
            62 => 
            array (
                'description' => 'Descriptif',
                'file' => 'Document77_MGDBrochure Rapport de Stage.pdf',
                'id' => 77,
                'internships_id' => 187,
            ),
            63 => 
            array (
                'description' => 'Descriptif',
                'file' => 'Document78_JGAstage.pdf',
                'id' => 78,
                'internships_id' => 182,
            ),
            64 => 
            array (
                'description' => 'Descriptif',
                'file' => 'Document79_IGIIlias.Goujgali-Brochure-EPCN.pdf',
                'id' => 79,
                'internships_id' => 185,
            ),
            65 => 
            array (
                'description' => 'Descriptif Page 1',
                'file' => 'Document80_AJCCouverture.pdf',
                'id' => 80,
                'internships_id' => 179,
            ),
            66 => 
            array (
                'description' => 'Descriptif',
                'file' => 'Document83_JNMDépliant Nespresso_Jaciban.pdf',
                'id' => 83,
                'internships_id' => 132,
            ),
            67 => 
            array (
                'description' => 'Descriptif',
                'file' => 'Document84_APTlivret ETVJ exam.pdf',
                'id' => 84,
                'internships_id' => 172,
            ),
            68 => 
            array (
                'description' => 'Descriptif',
                'file' => 'Document85_LSILoris_Brochure_descriptive_IMD.docx',
                'id' => 85,
                'internships_id' => 168,
            ),
            69 => 
            array (
                'description' => 'Descriptif',
                'file' => 'Document86_GWFBrochure_Gabriel_WOLF_CEPM.pdf',
                'id' => 86,
                'internships_id' => 184,
            ),
            70 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'Document87_Bouyiatiotis Stéphane .pdf',
                'id' => 88,
                'internships_id' => 219,
            ),
            71 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'Document89_Cardillo Fabio.pdf',
                'id' => 89,
                'internships_id' => 230,
            ),
            72 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'Document90_Combremont Gaël.pdf',
                'id' => 90,
                'internships_id' => 214,
            ),
            73 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'Document91_Fidalgo Leonardo.pdf',
                'id' => 91,
                'internships_id' => 209,
            ),
            74 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'Document92_Giordano Antonio.pdf',
                'id' => 92,
                'internships_id' => 200,
            ),
            75 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'Document93_Grisel Saber.pdf',
                'id' => 93,
                'internships_id' => 213,
            ),
            76 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'Document94_Lopes Gouveia Rui Filipe.pdf',
                'id' => 94,
                'internships_id' => 215,
            ),
            77 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'Document95_Acuña Ramirez Camilo.pdf',
                'id' => 95,
                'internships_id' => 205,
            ),
            78 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'Document96_Marcoup Thomas .pdf',
                'id' => 96,
                'internships_id' => 228,
            ),
            79 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'Document97_Mondaini Alessandro.pdf',
                'id' => 97,
                'internships_id' => 189,
            ),
            80 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'Document98_Perret Yannick.pdf',
                'id' => 98,
                'internships_id' => 223,
            ),
            81 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'Document99_Pierre Aloys.pdf',
                'id' => 99,
                'internships_id' => 220,
            ),
            82 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'Document100_Sival Marques Fabio.pdf',
                'id' => 100,
                'internships_id' => 199,
            ),
            83 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'Document101_Vuagniaux Rémy.pdf',
                'id' => 101,
                'internships_id' => 210,
            ),
            84 => 
            array (
                'description' => 'Rapport de stage chez Liip de Jordan Assayah',
                'file' => 'Document102_ASSAYAH.pdf',
                'id' => 102,
                'internships_id' => 300,
            ),
            85 => 
            array (
            'description' => 'Rapport de stage 2016 (Audibert)',
                'file' => 'Document103_AUDIBERT.pdf',
                'id' => 104,
                'internships_id' => 270,
            ),
            86 => 
            array (
            'description' => 'Rapport de stage 2016 (Costache)',
                'file' => 'Document105_COSTACHE.pdf',
                'id' => 105,
                'internships_id' => 294,
            ),
            87 => 
            array (
            'description' => 'Rapport de stage 2016 (Dubey)',
                'file' => 'Document106_DUBEY.pdf',
                'id' => 106,
                'internships_id' => 279,
            ),
            88 => 
            array (
            'description' => 'Rapport de stage 2016 (Goncalves)',
                'file' => 'Document107_GONCALVES.pdf',
                'id' => 107,
                'internships_id' => 283,
            ),
            89 => 
            array (
            'description' => 'Rapport de stage 2016 (Guignard)',
                'file' => 'Document108_GUIGNARD.pdf',
                'id' => 108,
                'internships_id' => 282,
            ),
            90 => 
            array (
            'description' => 'Rapport de stage 2016 (Marzolini)',
                'file' => 'Document109_MARZOLINI.pdf',
                'id' => 109,
                'internships_id' => 299,
            ),
            91 => 
            array (
            'description' => 'Rapport de stage 2016 (Pellaton)',
                'file' => 'Document110_PELLATON.pdf',
                'id' => 110,
                'internships_id' => 274,
            ),
            92 => 
            array (
            'description' => 'Rapport de stage 2016 (Rajkovic)',
                'file' => 'Document111_RAJKOVIC.pdf',
                'id' => 111,
                'internships_id' => 295,
            ),
            93 => 
            array (
            'description' => 'Rapport de stage 2016 (Redondo)',
                'file' => 'Document112_REDONDO.pdf',
                'id' => 112,
                'internships_id' => 285,
            ),
            94 => 
            array (
            'description' => 'Rapport de stage 2016 (Sipala)',
                'file' => 'Document113_SIPALA.pdf',
                'id' => 113,
                'internships_id' => 291,
            ),
            95 => 
            array (
            'description' => 'Rapport de stage 2016 (Krattinger)',
                'file' => 'Document114_KRATTINGER.pdf',
                'id' => 114,
                'internships_id' => 304,
            ),
            96 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'Document115_Rapport stage 2 Acuna.pdf',
                'id' => 115,
                'internships_id' => 237,
            ),
            97 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'Document116_Rapport stage 2 Bouyiatiotis.pdf',
                'id' => 116,
                'internships_id' => 239,
            ),
            98 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'Document117_Rapport stage 2 Cardillo.pdf',
                'id' => 117,
                'internships_id' => 242,
            ),
            99 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'Document118_Rapport stage 2 Combremont.pdf',
                'id' => 118,
                'internships_id' => 233,
            ),
            100 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'Document119_Rapport stage 2 Fidalgo.pdf',
                'id' => 119,
                'internships_id' => 253,
            ),
            101 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'Document120_Rapport stage 2 Giordano.pdf',
                'id' => 120,
                'internships_id' => 244,
            ),
            102 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'Document121_Rapport stage 2 Grisel.pdf',
                'id' => 121,
                'internships_id' => 238,
            ),
            103 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'Document122_Rapport stage 2 Lopes-Gouveia.pdf',
                'id' => 122,
                'internships_id' => 250,
            ),
            104 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'Document123_Rapport stage 2 Marcoup.pdf',
                'id' => 123,
                'internships_id' => 246,
            ),
            105 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'Document124_Rapport stage 2 Mondaini.pdf',
                'id' => 124,
                'internships_id' => 259,
            ),
            106 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'Document125_Rapport stage 2 Perret.pdf',
                'id' => 125,
                'internships_id' => 252,
            ),
            107 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'Document126_Rapport stage 2 Pierre.pdf',
                'id' => 126,
                'internships_id' => 245,
            ),
            108 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'Document127_Rapport stage 2 Silva Marques.pdf',
                'id' => 127,
                'internships_id' => 264,
            ),
            109 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'Document128_Rapport stage 2 Vuagniaux.pdf',
                'id' => 128,
                'internships_id' => 234,
            ),
            110 => 
            array (
                'description' => 'HEIG-VD',
                'file' => 'Document129_AUDERGON_RdS_Audergon.pdf',
                'id' => 129,
                'internships_id' => 235,
            ),
            111 => 
            array (
                'description' => 'Nagravision',
                'file' => 'Document130_BOUSBAA_Rapport - Eric Bousbaa.pdf',
                'id' => 130,
                'internships_id' => 256,
            ),
            112 => 
            array (
                'description' => 'unil',
                'file' => 'Document131_CRUZ_RapportdeStage.pdf',
                'id' => 131,
                'internships_id' => 236,
            ),
            113 => 
            array (
                'description' => 'IMD',
                'file' => 'Document132_DUBUIS_Rapport de stage.pdf',
                'id' => 132,
                'internships_id' => 255,
            ),
            114 => 
            array (
                'description' => 'epfl',
                'file' => 'Document133_GILLET_Rapport de stage.pdf',
                'id' => 133,
                'internships_id' => 263,
            ),
            115 => 
            array (
                'description' => 'DSI-Police Cantnale',
                'file' => 'Document134_GONNET_RapportDeStagePolCant.pdf',
                'id' => 134,
                'internships_id' => 241,
            ),
            116 => 
            array (
                'description' => 'Nestlé PTC',
                'file' => 'Document135_LAUBSCHER_Rapport_de_stage_n_2_.pdf',
                'id' => 135,
                'internships_id' => 249,
            ),
            117 => 
            array (
                'description' => 'wifx',
                'file' => 'Document136_MARENDAZ_Rapport - Wifx.pdf',
                'id' => 136,
                'internships_id' => 247,
            ),
            118 => 
            array (
                'description' => 'IMD',
                'file' => 'Document137_NEVES_Rapport de stage IMD.pdf',
                'id' => 137,
                'internships_id' => 254,
            ),
            119 => 
            array (
                'description' => 'Nagravision',
                'file' => 'Document138_RICCI_Rapport de stage_tri.pdf',
                'id' => 138,
                'internships_id' => 240,
            ),
            120 => 
            array (
                'description' => 'epcn',
                'file' => 'Document139_SCHMID_Rapport de stage EPCN.pdf',
                'id' => 139,
                'internships_id' => 243,
            ),
            121 => 
            array (
                'description' => 'nimag',
                'file' => 'Document140_UHAN_NimagNetworks_Rapport_de_Stage_2016.pdf',
                'id' => 140,
                'internships_id' => 261,
            ),
            122 => 
            array (
                'description' => 'Contrat',
                'file' => 'Document141_Engagement stage pratique en entreprise.pdf',
                'id' => 141,
                'internships_id' => 367,
            ),
            123 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'Document142_Rapport de stage VFI.pdf',
                'id' => 142,
                'internships_id' => 387,
            ),
            124 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'Document143_Rapport_AGI.pdf',
                'id' => 143,
                'internships_id' => 361,
            ),
            125 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'Document144_Rapport de stage_JGR.pdf',
                'id' => 144,
                'internships_id' => 365,
            ),
            126 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'Document145_Rapport Stage KGN.pdf',
                'id' => 145,
                'internships_id' => 382,
            ),
            127 => 
            array (
                'description' => 'Raport de stage',
                'file' => 'Document146_RapportDeStage_NagraVisionSA_SGZ.pdf',
                'id' => 146,
                'internships_id' => 378,
            ),
            128 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'Document147_Rapport de stage.pdf',
                'id' => 147,
                'internships_id' => 350,
            ),
            129 => 
            array (
                'description' => 'Rapport de stage',
                'file' => 'Document148_Medtronic-Rapport-Stage-LJM.pdf',
                'id' => 148,
                'internships_id' => 366,
            ),
        ));
        
        
    }
}