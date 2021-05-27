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
        $evalGrid = [
            'name' => 'Grille d\'évaluation 2021',
            'sections' => [
                [
                    'id' => 1,
                    'sectionName' => 'Liste des Travaux',
                    'hasGrade' => 0,
                    'sectionType' => 2,
                    'criterias' => [
                        [
                            'id' => 1,
                            'criteriaName' => 'Effectués jusqu’à ce jour',
                            'evaluationSection_id' => 1,
                        ],
                        [
                            'id' => 2,
                            'criteriaName' => 'À effectuer durant la suite du stage',
                            'evaluationSection_id' => 1,
                        ],
                    ]
                ],
                [
                    'id' => 2,
                    'sectionName' => 'Compétences Professionnelles',
                    'hasGrade' => 1,
                    'sectionType' => 1,
                    'criterias' => [
                        [
                            'id' => 3,
                            'criteriaName' => 'Qualitatif',
                            'criteriaDetails' => 'Résultats irréprochables, soignés, de facture professionnelle',
                            'maxPoints' => 3,
                            'evaluationSection_id' => 2,
                        ],
                        [
                            'id' => 4,
                            'criteriaName' => 'Quantitatif',
                            'criteriaDetails' => 'Rapide, Performant, Efficace, Habile',
                            'maxPoints' => 3,
                            'evaluationSection_id' => 2,
                        ],
                    ],
                ],
                [
                    'id' => 3,
                    'sectionName' => 'Compétences Globales',
                    'hasGrade' => 1,
                    'sectionType' => 1,
                    'criterias' => [
                        [
                            'id' => 5,
                            'criteriaName' => 'Autonomie et Organisation personnelle',
                            'criteriaDetails' => 'Indépendant, Planifie ses tâches, Prend des notes, Reformule et valide sa compréhension des directives',
                            'maxPoints' => 3,
                            'evaluationSection_id' => 3,
                        ],
                        [
                            'id' => 6,
                            'criteriaName' => 'Intérêt et Motivation',
                            'criteriaDetails' => 'Engagé, Enthousiaste',
                            'maxPoints' => 3,
                            'evaluationSection_id' => 3,
                        ],
                        [
                            'id' => 7,
                            'criteriaName' => 'Faculté d\'apprendre',
                            'criteriaDetails' => 'Consulte ses cours, des littératures et articles',
                            'maxPoints' => 3,
                            'evaluationSection_id' => 3,
                        ],
                        [
                            'id' => 8,
                            'criteriaName' => 'Créativité',
                            'criteriaDetails' => 'Imagine des solutions',
                            'maxPoints' => 3,
                            'evaluationSection_id' => 3,
                        ],
                        [
                            'id' => 9,
                            'criteriaName' => 'Ordre et Propreté',
                            'criteriaDetails' => 'Range ses affaires et sa place de travail, Soigne sa personne et son habillement',
                            'maxPoints' => 3,
                            'evaluationSection_id' => 3,
                        ],
                        [
                            'id' => 10,
                            'criteriaName' => 'Respect de l\'environnement de travail',
                            'criteriaDetails' => 'Respecte le matériel et les infrastructures comme il se doit',
                            'maxPoints' => 3,
                            'evaluationSection_id' => 3,
                        ],
                    ],
                ],
                [
                    'id' => 4,
                    'sectionName' => 'Compétences Sociales',
                    'hasGrade' => 1,
                    'sectionType' => 1,
                    'criterias' => [
                        [
                            'id' => 11,
                            'criteriaName' => 'Esprit de collaboration',
                            'criteriaDetails' => 'Partage ses informations, é́coute de manière concentrée, Respecte ce qui a été convenu',
                            'maxPoints' => 3,
                            'evaluationSection_id' => 4,
                        ],
                        [
                            'id' => 12,
                            'criteriaName' => 'Sociabilité',
                            'criteriaDetails' => 'Aimable, Prévenant, Respectueux, Agréable, Charismatique',
                            'maxPoints' => 3,
                            'evaluationSection_id' => 4,
                        ],
                        [
                            'id' => 13,
                            'criteriaName' => 'Absentéisme et Ponctualité',
                            'criteriaDetails' => 'Annonce les imprévus, Raisons évoquées dignes de confiance',
                            'maxPoints' => 3,
                            'evaluationSection_id' => 4,
                        ],
                        [
                            'id' => 14,
                            'criteriaName' => 'Tenue du journal de travail',
                            'criteriaDetails' => 'Remis régulièrement selon prescription, Références mentionnées, États des tâches mentionnés',
                            'maxPoints' => 3,
                            'evaluationSection_id' => 4,
                        ],
                    ],
                ],
                [
                    'id' => 5,
                    'sectionName' => 'Feedback sur le Plan de Formation',
                    'hasGrade' => 0,
                    'sectionType' => 3,
                    'criterias' => [
                        [
                            'id' => 15,
                            'criteriaName' => 'Connaissances théoriques',
                            'evaluationSection_id' => 5,
                        ],
                        [
                            'id' => 16,
                            'criteriaName' => 'Compétences pratiques',
                            'evaluationSection_id' => 5,
                        ],
                        [
                            'id' => 17,
                            'criteriaName' => 'Attitude professionnelle',
                            'evaluationSection_id' => 5,
                        ],
                    ],
                ],
            ]
        ];

        \DB::table('criteriavalues')->delete();
        \DB::table('criterias')->delete();
        \DB::table('evaluationsections')->delete();
        \DB::table('evaluations')->delete();

        // Create the template
        \DB::table('evaluations')->insert([
            'id' => 1,
            'editable' => 1,
            'visit_id' => null,
            'template_name' => $evalGrid["name"],
        ]);

        foreach($evalGrid["sections"] as $section) {
            \DB::table('evaluationsections')->insert([
                'id' => $section["id"],
                'sectionName' => $section["sectionName"],
                'hasGrade' => $section["hasGrade"],
                'sectionType' => $section["sectionType"],
            ]);

            foreach($section["criterias"] as $criteria) {
                \DB::table('criterias')->insert([
                    'id' => $criteria["id"],
                    'criteriaName' => $criteria["criteriaName"],
                    'evaluationSection_id' => $section["id"]
                ]);

                \DB::table('criteriavalues')->insert([
                    'id' => $criteria["id"],
                    'evaluation_id' => 1,
                    'points' => -1,
                    'criteria_id' => $criteria["id"],
                ]);
            }
        }
    }
}
