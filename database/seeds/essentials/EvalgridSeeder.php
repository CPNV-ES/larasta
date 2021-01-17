<?php

use Illuminate\Database\Seeder;

class EvalgridSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('criterias')->delete();
        \DB::table('evaluationsections')->delete();

        // Evaluation sections
        \DB::table('evaluationsections')->insert(array(
            0 =>
                array(
                    'id' => 1,
                    'sectionName' => 'Liste des Travaux',
                    'hasGrade' => 0,
                    'sectionType' => 2,
                ),
            1 =>
                array(
                    'id' => 2,
                    'sectionName' => 'Compétences Professionnelles',
                    'hasGrade' => 1,
                    'sectionType' => 1,
                ),
            2 =>
                array(
                    'id' => 3,
                    'sectionName' => 'Compétences Globales',
                    'hasGrade' => 1,
                    'sectionType' => 1,
                ),
            3 =>
                array(
                    'id' => 4,
                    'sectionName' => 'Compétences Sociales',
                    'hasGrade' => 1,
                    'sectionType' => 1,
                ),
            4 =>
                array(
                    'id' => 5,
                    'sectionName' => 'Feedback sur le Plan de Formation',
                    'hasGrade' => 0,
                    'sectionType' => 3,
                ),
        ));

        // Section 1
        \DB::table('criterias')->insert([
            [
                'criteriaName' => 'Effectués jusqu’à ce jour',
                'evaluationSection_id' => 1,
            ],
            [
                'criteriaName' => 'À effectuer durant la suite du stage',
                'evaluationSection_id' => 1,
            ],
        ]);

        // Section 2
        \DB::table('criterias')->insert([
            [
                'criteriaName' => 'Qualitatif',
                'criteriaDetails' => 'Résultats irréprochables, soignés, de facture professionnelle',
                'maxPoints' => 3,
                'evaluationSection_id' => 2,
            ],
            [
                'criteriaName' => 'Quantitatif',
                'criteriaDetails' => 'Rapide, Performant, Efficace, Habile',
                'maxPoints' => 3,
                'evaluationSection_id' => 2,
            ],
        ]);

        // Section 3
        \DB::table('criterias')->insert([
            [
                'criteriaName' => 'Autonomie et Organisation personnelle',
                'criteriaDetails' => 'Indépendant, Planifie ses tâches, Prend des notes, Reformule et valide sa compréhension des directives',
                'maxPoints' => 3,
                'evaluationSection_id' => 3,
            ],
            [
                'criteriaName' => 'Intérêt et Motivation',
                'criteriaDetails' => 'Engagé, Enthousiaste',
                'maxPoints' => 3,
                'evaluationSection_id' => 3,
            ],
            [
                'criteriaName' => 'Faculté d\'apprendre',
                'criteriaDetails' => 'Consulte ses cours, des littératures et articles',
                'maxPoints' => 3,
                'evaluationSection_id' => 3,
            ],
            [
                'criteriaName' => 'Créativité',
                'criteriaDetails' => 'Imagine des solutions',
                'maxPoints' => 3,
                'evaluationSection_id' => 3,
            ],
            [
                'criteriaName' => 'Ordre et Propreté',
                'criteriaDetails' => 'Range ses affaires et sa place de travail, Soigne sa personne et son habillement',
                'maxPoints' => 3,
                'evaluationSection_id' => 3,
            ],
            [
                'criteriaName' => 'Respect de l\'environnement de travail',
                'criteriaDetails' => 'Respecte le matériel et les infrastructures comme il se doit',
                'maxPoints' => 3,
                'evaluationSection_id' => 3,
            ],
        ]);

        // Section 4
        \DB::table('criterias')->insert([
            [
                'criteriaName' => 'Esprit de collaboration',
                'criteriaDetails' => 'Partage ses informations, é́coute de manière concentrée, Respecte ce qui a été convenu',
                'maxPoints' => 3,
                'evaluationSection_id' => 4,
            ],
            [
                'criteriaName' => 'Sociabilité',
                'criteriaDetails' => 'Aimable, Prévenant, Respectueux, Agréable, Charismatique',
                'maxPoints' => 3,
                'evaluationSection_id' => 4,
            ],
            [
                'criteriaName' => 'Absentéisme et Ponctualité',
                'criteriaDetails' => 'Annonce les imprévus, Raisons évoquées dignes de confiance',
                'maxPoints' => 3,
                'evaluationSection_id' => 4,
            ],
            [
                'criteriaName' => 'Tenue du journal de travail',
                'criteriaDetails' => 'Remis régulièrement selon prescription, Références mentionnées, États des tâches mentionnés',
                'maxPoints' => 3,
                'evaluationSection_id' => 4,
            ],
        ]);

        // Section 5
        \DB::table('criterias')->insert([
            [
                'criteriaName' => 'Connaissances théoriques',
                'evaluationSection_id' => 5,
            ],
            [
                'criteriaName' => 'Compétences pratiques',
                'evaluationSection_id' => 5,
            ],
            [
                'criteriaName' => 'Attitude professionnelle',
                'evaluationSection_id' => 5,
            ],
        ]);

    }
}
