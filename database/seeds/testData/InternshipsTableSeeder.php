<?php

use Illuminate\Database\Seeder;

class InternshipsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('internships')->delete();
        
        \DB::table('internships')->insert(array (
            0 => 
            array (
                'admin_id' => 54,
                'beginDate' => '2014-02-01 00:00:00',
                'companies_id' => 28,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2014-08-30 00:00:00',
                'grossSalary' => 1230,
                'id' => 25,
                'intern_id' => 39,
                'internshipDescription' => NULL,
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 57,
            ),
            1 => 
            array (
                'admin_id' => 53,
                'beginDate' => '2014-02-01 00:00:00',
                'companies_id' => 32,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2014-08-30 00:00:00',
                'grossSalary' => 1230,
                'id' => 26,
                'intern_id' => 33,
                'internshipDescription' => NULL,
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 53,
            ),
            2 => 
            array (
                'admin_id' => 48,
                'beginDate' => '2014-02-01 00:00:00',
                'companies_id' => 34,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2014-08-30 00:00:00',
                'grossSalary' => 1230,
                'id' => 27,
                'intern_id' => 42,
                'internshipDescription' => NULL,
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 48,
            ),
            3 => 
            array (
                'admin_id' => 45,
                'beginDate' => '2014-02-01 00:00:00',
                'companies_id' => 37,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2014-08-30 00:00:00',
                'grossSalary' => 1230,
                'id' => 28,
                'intern_id' => 34,
                'internshipDescription' => NULL,
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 84,
            ),
            4 => 
            array (
                'admin_id' => 45,
                'beginDate' => '2014-02-01 00:00:00',
                'companies_id' => 37,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2014-08-30 00:00:00',
                'grossSalary' => 1230,
                'id' => 29,
                'intern_id' => 32,
                'internshipDescription' => NULL,
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 84,
            ),
            5 => 
            array (
                'admin_id' => 65,
                'beginDate' => '2014-02-01 00:00:00',
                'companies_id' => 38,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2014-08-30 00:00:00',
                'grossSalary' => 1230,
                'id' => 30,
                'intern_id' => 41,
                'internshipDescription' => NULL,
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 81,
            ),
            6 => 
            array (
                'admin_id' => 65,
                'beginDate' => '2014-02-01 00:00:00',
                'companies_id' => 38,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2014-08-30 00:00:00',
                'grossSalary' => 1230,
                'id' => 31,
                'intern_id' => 37,
                'internshipDescription' => NULL,
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 80,
            ),
            7 => 
            array (
                'admin_id' => 61,
                'beginDate' => '2014-02-01 00:00:00',
                'companies_id' => 39,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2014-08-30 00:00:00',
                'grossSalary' => 1230,
                'id' => 32,
                'intern_id' => 38,
                'internshipDescription' => NULL,
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 61,
            ),
            8 => 
            array (
                'admin_id' => 72,
                'beginDate' => '2014-02-01 00:00:00',
                'companies_id' => 42,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2014-08-30 00:00:00',
                'grossSalary' => 1230,
                'id' => 33,
                'intern_id' => 36,
                'internshipDescription' => NULL,
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 97,
            ),
            9 => 
            array (
                'admin_id' => 50,
                'beginDate' => '2014-02-01 00:00:00',
                'companies_id' => 44,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2014-08-30 00:00:00',
                'grossSalary' => 1230,
                'id' => 34,
                'intern_id' => 31,
                'internshipDescription' => NULL,
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 82,
            ),
            10 => 
            array (
                'admin_id' => 56,
                'beginDate' => '2014-02-01 00:00:00',
                'companies_id' => 46,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2014-08-30 00:00:00',
                'grossSalary' => 1230,
                'id' => 35,
                'intern_id' => 35,
                'internshipDescription' => NULL,
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 56,
            ),
            11 => 
            array (
                'admin_id' => 77,
                'beginDate' => '2014-02-01 00:00:00',
                'companies_id' => 47,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2014-08-30 00:00:00',
                'grossSalary' => 1230,
                'id' => 36,
                'intern_id' => 40,
                'internshipDescription' => NULL,
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 77,
            ),
            12 => 
            array (
                'admin_id' => 54,
                'beginDate' => '2014-09-02 00:00:00',
                'companies_id' => 28,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2015-02-28 00:00:00',
                'grossSalary' => 1230,
                'id' => 37,
                'intern_id' => 31,
                'internshipDescription' => 'Environnement MAC.
Demandent des stagiaires curieux et désireux d\'apprendre!',
                'parent_id' => NULL,
                'previous_id' => 25,
                'responsible_id' => 57,
            ),
            13 => 
            array (
                'admin_id' => 74,
                'beginDate' => '2014-02-01 00:00:00',
                'companies_id' => 25,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2014-08-30 00:00:00',
                'grossSalary' => 1230,
                'id' => 38,
                'intern_id' => 20,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 74,
            ),
            14 => 
            array (
                'admin_id' => 74,
                'beginDate' => '2014-09-02 00:00:00',
                'companies_id' => 25,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2015-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 39,
                'intern_id' => 21,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 38,
                'responsible_id' => 74,
            ),
            15 => 
            array (
                'admin_id' => 43,
                'beginDate' => '2014-02-01 00:00:00',
                'companies_id' => 26,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2014-08-30 00:00:00',
                'grossSalary' => 1230,
                'id' => 40,
                'intern_id' => 28,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 78,
            ),
            16 => 
            array (
                'admin_id' => 43,
                'beginDate' => '2014-09-02 00:00:00',
                'companies_id' => 26,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 14,
                'endDate' => '2015-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 41,
                'intern_id' => 40,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 40,
                'responsible_id' => 78,
            ),
            17 => 
            array (
                'admin_id' => 75,
                'beginDate' => '2014-02-01 00:00:00',
                'companies_id' => 27,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 14,
                'endDate' => '2014-08-30 00:00:00',
                'grossSalary' => 1230,
                'id' => 42,
                'intern_id' => 25,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 75,
            ),
            18 => 
            array (
                'admin_id' => 63,
                'beginDate' => '2014-02-01 00:00:00',
                'companies_id' => 29,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2014-08-30 00:00:00',
                'grossSalary' => 1230,
                'id' => 44,
                'intern_id' => 30,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 66,
            ),
            19 => 
            array (
                'admin_id' => 63,
                'beginDate' => '2014-09-02 00:00:00',
                'companies_id' => 29,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2015-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 45,
                'intern_id' => 22,
                'internshipDescription' => 'Travail varié: support, installation, dépannage, projets individuels.<br>Très peu d\'encadrement!',
                'parent_id' => NULL,
                'previous_id' => 44,
                'responsible_id' => 66,
            ),
            20 => 
            array (
                'admin_id' => 60,
                'beginDate' => '2014-02-01 00:00:00',
                'companies_id' => 30,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2014-08-30 00:00:00',
                'grossSalary' => 1230,
                'id' => 46,
                'intern_id' => 19,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 68,
            ),
            21 => 
            array (
                'admin_id' => 68,
                'beginDate' => '2014-09-02 00:00:00',
                'companies_id' => 30,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2015-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 47,
                'intern_id' => 42,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 46,
                'responsible_id' => 156,
            ),
            22 => 
            array (
                'admin_id' => 53,
                'beginDate' => '2014-09-02 00:00:00',
                'companies_id' => 32,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2015-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 48,
                'intern_id' => 32,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 26,
                'responsible_id' => 53,
            ),
            23 => 
            array (
                'admin_id' => 79,
                'beginDate' => '2014-02-01 00:00:00',
                'companies_id' => 33,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2014-08-30 00:00:00',
                'grossSalary' => 1230,
                'id' => 49,
                'intern_id' => 21,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 79,
            ),
            24 => 
            array (
                'admin_id' => 79,
                'beginDate' => '2014-09-02 00:00:00',
                'companies_id' => 33,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2015-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 50,
                'intern_id' => 35,
                'internshipDescription' => 'Support, installation, dépannage, projets individuels',
                'parent_id' => NULL,
                'previous_id' => 49,
                'responsible_id' => 79,
            ),
            25 => 
            array (
                'admin_id' => 62,
                'beginDate' => '2014-02-01 00:00:00',
                'companies_id' => 35,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2014-08-30 00:00:00',
                'grossSalary' => 1230,
                'id' => 52,
                'intern_id' => 18,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 62,
            ),
            26 => 
            array (
                'admin_id' => 62,
                'beginDate' => '2014-02-01 00:00:00',
                'companies_id' => 35,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2014-08-30 00:00:00',
                'grossSalary' => 1230,
                'id' => 53,
                'intern_id' => 27,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 62,
            ),
            27 => 
            array (
                'admin_id' => 62,
                'beginDate' => '2014-09-02 00:00:00',
                'companies_id' => 35,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2015-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 54,
                'intern_id' => 39,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 52,
                'responsible_id' => 150,
            ),
            28 => 
            array (
                'admin_id' => 62,
                'beginDate' => '2014-09-02 00:00:00',
                'companies_id' => 35,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2015-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 55,
                'intern_id' => 33,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 53,
                'responsible_id' => 148,
            ),
            29 => 
            array (
                'admin_id' => 49,
                'beginDate' => '2014-02-01 00:00:00',
                'companies_id' => 36,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2014-08-30 00:00:00',
                'grossSalary' => 1230,
                'id' => 56,
                'intern_id' => 17,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 69,
            ),
            30 => 
            array (
                'admin_id' => 49,
                'beginDate' => '2014-09-02 00:00:00',
                'companies_id' => 36,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2015-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 57,
                'intern_id' => 30,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 56,
                'responsible_id' => 69,
            ),
            31 => 
            array (
                'admin_id' => 169,
                'beginDate' => '2014-09-02 00:00:00',
                'companies_id' => 37,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2015-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 58,
                'intern_id' => 24,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 28,
                'responsible_id' => 70,
            ),
            32 => 
            array (
                'admin_id' => 169,
                'beginDate' => '2014-09-02 00:00:00',
                'companies_id' => 37,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2015-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 60,
                'intern_id' => 38,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 29,
                'responsible_id' => 70,
            ),
            33 => 
            array (
                'admin_id' => 65,
                'beginDate' => '2014-09-02 00:00:00',
                'companies_id' => 38,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2015-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 61,
                'intern_id' => 37,
                'internshipDescription' => 'L’équipe « Integration & Development » est composée de 5 ingénieurs et d’un Team Leader.  Elle est sollicitée pour tout type de développement en interne que ce soit pour l’IT ou d’autres départements. Les technologies utilisées sont entre autres JAVA – JEE, BPEL, PHP5, Python, etc…
Le stagiaire est sollicité par l’équipe pour divers travaux en fonction des connaissances et de la motivation démontrée. Les premiers travaux sont de petites envergures afin de laisser un temps pour s’adapter et faire ses preuves. Les premières tâches seront généralement :
·         Effectuer des modifications sur des applications web (PHP & Java)
·         Rédiger de la documentation
·         Se former sur les framework technologies utilisées
Chaque semaine du temps est laissé au stagiaire pour se former personnellement et de manière autodidacte. Suite à quoi, l’équipe pourra lui proposer des projets de moyennes ou grandes envergures. Le projet peut être, par exemple, une application web qui comprend les phases (Analyse, Conception, Réalisation, Tests, Mise en service).
L’équipe est souvent très prise. C’est pourquoi le triangle des compétences requis pour ce stage est : l’autonomie, la débrouillardise et la motivation.',
                'parent_id' => NULL,
                'previous_id' => 31,
                'responsible_id' => 80,
            ),
            34 => 
            array (
                'admin_id' => 59,
                'beginDate' => '2014-02-01 00:00:00',
                'companies_id' => 40,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2014-08-30 00:00:00',
                'grossSalary' => 1230,
                'id' => 64,
                'intern_id' => 29,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 58,
            ),
            35 => 
            array (
                'admin_id' => 59,
                'beginDate' => '2014-09-02 00:00:00',
                'companies_id' => 40,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2015-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 65,
                'intern_id' => 29,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 64,
                'responsible_id' => 58,
            ),
            36 => 
            array (
                'admin_id' => 71,
                'beginDate' => '2014-02-01 00:00:00',
                'companies_id' => 41,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2014-08-30 00:00:00',
                'grossSalary' => 1230,
                'id' => 66,
                'intern_id' => 22,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 47,
            ),
            37 => 
            array (
                'admin_id' => 71,
                'beginDate' => '2014-09-02 00:00:00',
                'companies_id' => 41,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2015-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 67,
                'intern_id' => 23,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 66,
                'responsible_id' => 47,
            ),
            38 => 
            array (
                'admin_id' => 72,
                'beginDate' => '2014-09-02 00:00:00',
                'companies_id' => 42,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2015-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 68,
                'intern_id' => 25,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 33,
                'responsible_id' => 73,
            ),
            39 => 
            array (
                'admin_id' => 51,
                'beginDate' => '2014-02-01 00:00:00',
                'companies_id' => 43,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2014-08-30 00:00:00',
                'grossSalary' => 1230,
                'id' => 69,
                'intern_id' => 23,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 44,
            ),
            40 => 
            array (
                'admin_id' => 51,
                'beginDate' => '2014-09-02 00:00:00',
                'companies_id' => 43,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2015-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 70,
                'intern_id' => 19,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 69,
                'responsible_id' => 44,
            ),
            41 => 
            array (
                'admin_id' => 44,
                'beginDate' => '2014-02-01 00:00:00',
                'companies_id' => 45,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2014-08-30 00:00:00',
                'grossSalary' => 1230,
                'id' => 71,
                'intern_id' => 24,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 44,
            ),
            42 => 
            array (
                'admin_id' => 44,
                'beginDate' => '2014-09-02 00:00:00',
                'companies_id' => 45,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2015-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 72,
                'intern_id' => 17,
                'internshipDescription' => 'Support, installation, dépannage',
                'parent_id' => NULL,
                'previous_id' => 71,
                'responsible_id' => 44,
            ),
            43 => 
            array (
                'admin_id' => 56,
                'beginDate' => '2014-09-02 00:00:00',
                'companies_id' => 46,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2015-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 73,
                'intern_id' => 20,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 35,
                'responsible_id' => 56,
            ),
            44 => 
            array (
                'admin_id' => 77,
                'beginDate' => '2014-09-02 00:00:00',
                'companies_id' => 47,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2015-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 74,
                'intern_id' => 18,
                'internshipDescription' => 'Support, installation, dépannage',
                'parent_id' => NULL,
                'previous_id' => 36,
                'responsible_id' => 109,
            ),
            45 => 
            array (
                'admin_id' => 64,
                'beginDate' => '2014-02-01 00:00:00',
                'companies_id' => 48,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2014-08-30 00:00:00',
                'grossSalary' => 1230,
                'id' => 75,
                'intern_id' => 26,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 64,
            ),
            46 => 
            array (
                'admin_id' => 65,
                'beginDate' => '2014-09-02 00:00:00',
                'companies_id' => 38,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2015-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 78,
                'intern_id' => 41,
                'internshipDescription' => 'Programmation d\'un microcontrolleur pour un minidisplay qui doit être intégré dans un émulateur.',
                'parent_id' => NULL,
                'previous_id' => 30,
                'responsible_id' => 81,
            ),
            47 => 
            array (
                'admin_id' => 64,
                'beginDate' => '2014-09-02 00:00:00',
                'companies_id' => 48,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2015-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 82,
                'intern_id' => 26,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 75,
                'responsible_id' => 64,
            ),
            48 => 
            array (
                'admin_id' => 65,
                'beginDate' => '2014-09-02 00:00:00',
                'companies_id' => 38,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2015-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 84,
                'intern_id' => 27,
                'internshipDescription' => 'Implémentation de workflow de commande de cartes à puce sur du SharePoint avec l’outil de design NINTEX.<br>
Le process est défini; Le workflow comporte plusieurs chemins possibles et une dizaine d’étape sur le chemin standard. Les actions peuvent être lancées par e-mail.',
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 98,
            ),
            49 => 
            array (
                'admin_id' => 50,
                'beginDate' => '2014-09-02 00:00:00',
                'companies_id' => 44,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2015-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 85,
                'intern_id' => 28,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 34,
                'responsible_id' => 82,
            ),
            50 => 
            array (
                'admin_id' => 105,
                'beginDate' => '2014-09-01 00:00:00',
                'companies_id' => 66,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2015-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 91,
                'intern_id' => 36,
                'internshipDescription' => 'Réalisation d\'une application passerelle entre ArcGIS et MISTRA.
1. Elaboration d\'un modèle conceptuel de données
2. Passerelle ArcGIS - ImportSheet (facultatif)
3. Passerelle ArcGIG - MISTRA
4. Calcul de l\'orientation des capteurs à partir des fichiers shape
Technologie à choix',
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 106,
            ),
            51 => 
            array (
                'admin_id' => 44,
                'beginDate' => '2015-02-01 00:00:00',
                'companies_id' => 45,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2015-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 93,
                'intern_id' => 136,
                'internshipDescription' => 'Support, installation, dépannage',
                'parent_id' => NULL,
                'previous_id' => 72,
                'responsible_id' => 44,
            ),
            52 => 
            array (
                'admin_id' => 109,
                'beginDate' => '2015-02-01 00:00:00',
                'companies_id' => 47,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2015-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 95,
                'intern_id' => 122,
                'internshipDescription' => 'Support, installation, dépannage',
                'parent_id' => NULL,
                'previous_id' => 74,
                'responsible_id' => 109,
            ),
            53 => 
            array (
                'admin_id' => 51,
                'beginDate' => '2015-02-01 00:00:00',
                'companies_id' => 43,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2015-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 96,
                'intern_id' => 113,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 70,
                'responsible_id' => 44,
            ),
            54 => 
            array (
                'admin_id' => 155,
                'beginDate' => '2015-02-01 00:00:00',
                'companies_id' => 46,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2015-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 98,
                'intern_id' => 144,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 73,
                'responsible_id' => 56,
            ),
            55 => 
            array (
                'admin_id' => 74,
                'beginDate' => '2015-02-01 00:00:00',
                'companies_id' => 25,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2015-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 99,
                'intern_id' => 128,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 39,
                'responsible_id' => 74,
            ),
            56 => 
            array (
                'admin_id' => 63,
                'beginDate' => '2015-02-01 00:00:00',
                'companies_id' => 29,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2015-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 100,
                'intern_id' => 133,
                'internshipDescription' => 'Travail varié: support, installation, dépannage, projets individuels.<br>Très peu d\'encadrement!',
                'parent_id' => NULL,
                'previous_id' => 45,
                'responsible_id' => 66,
            ),
            57 => 
            array (
                'admin_id' => 47,
                'beginDate' => '2015-02-01 00:00:00',
                'companies_id' => 41,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2015-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 101,
                'intern_id' => 118,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 67,
                'responsible_id' => 47,
            ),
            58 => 
            array (
                'admin_id' => 64,
                'beginDate' => '2015-02-01 00:00:00',
                'companies_id' => 48,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2015-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 102,
                'intern_id' => 132,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 82,
                'responsible_id' => 64,
            ),
            59 => 
            array (
                'admin_id' => 163,
                'beginDate' => '2015-02-01 00:00:00',
                'companies_id' => 38,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2015-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 103,
                'intern_id' => 139,
                'internshipDescription' => 'Développement d\'un outil de gestion de commandes internes de cartes à puce sur du SharePoint avec l’outil de design NINTEX.
Le process est défini; Le workflow comporte plusieurs chemins possibles et une dizaine d’étape sur le chemin standard. Les actions peuvent être lancées par e-mail.',
                'parent_id' => NULL,
                'previous_id' => 84,
                'responsible_id' => 98,
            ),
            60 => 
            array (
                'admin_id' => 50,
                'beginDate' => '2015-02-01 00:00:00',
                'companies_id' => 44,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2015-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 104,
                'intern_id' => 114,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 85,
                'responsible_id' => 82,
            ),
            61 => 
            array (
                'admin_id' => 85,
                'beginDate' => '2015-02-01 00:00:00',
                'companies_id' => 40,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2015-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 105,
                'intern_id' => 131,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 65,
                'responsible_id' => 58,
            ),
            62 => 
            array (
                'admin_id' => 54,
                'beginDate' => '2015-02-01 00:00:00',
                'companies_id' => 28,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2015-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 107,
                'intern_id' => 142,
                'internshipDescription' => 'Environnement MAC.
Demandent des stagiaires curieux et désireux d\'apprendre!',
                'parent_id' => NULL,
                'previous_id' => 37,
                'responsible_id' => 57,
            ),
            63 => 
            array (
                'admin_id' => 53,
                'beginDate' => '2015-02-01 00:00:00',
                'companies_id' => 32,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2015-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 108,
                'intern_id' => 134,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 48,
                'responsible_id' => 53,
            ),
            64 => 
            array (
                'admin_id' => 62,
                'beginDate' => '2015-02-01 00:00:00',
                'companies_id' => 35,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2015-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 109,
                'intern_id' => NULL,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 54,
                'responsible_id' => 148,
            ),
            65 => 
            array (
                'admin_id' => 79,
                'beginDate' => '2015-02-01 00:00:00',
                'companies_id' => 33,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2015-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 111,
                'intern_id' => 119,
                'internshipDescription' => 'Support, installation, dépannage, projets individuels',
                'parent_id' => NULL,
                'previous_id' => 50,
                'responsible_id' => 79,
            ),
            66 => 
            array (
                'admin_id' => 169,
                'beginDate' => '2015-02-01 00:00:00',
                'companies_id' => 37,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2015-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 112,
                'intern_id' => 116,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 58,
                'responsible_id' => 70,
            ),
            67 => 
            array (
                'admin_id' => 182,
                'beginDate' => '2015-02-01 00:00:00',
                'companies_id' => 26,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2015-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 113,
                'intern_id' => 143,
            'internshipDescription' => 'Sur le site de Marcelin à Morges se côtoient plusieurs écoles : CEPM, Gymnase de Morges, Agrilogie et CEMEF. Le CEPM (Centre d’enseignement professionnel de Morges) est un centre d’enseignement des professions dans le domaine de la construction.
Le service informatique du CEPM s’occupe de tout le parc informatique Windows du site de Marcelin, qui comporte environ 650 ordinateurs (500 Windows et 150 Macs), une infrastructure VMware sur des serveurs ESX, un réseau câblé Gigabit avec des switches Cisco et un réseau Wireless avec l’équipement Ruckus et maintenance des ordinateurs ainsi que déploiement des applications avec Impero.
Le stagiaire collabore avec une personne du service IT qui est employé à 100% et les tâches sont les suivantes :
•	Développement d’applications en PHP, MySQL, C#, Java (Android), LDAP (AD)
•	Installation, configuration et maintenance des postes de travail fixes et portables (PC)
•	Installation, configuration et maintenance des imprimantes et photocopieuses réseau et locales
•	Gestion des Backup
•	Gestion des toners d’impression
•	Déploiement des images et des logiciels (WDS)
•	Création et gestion des comptes informatiques dans Active Directory
•	Support aux utilisateurs
Le stagiaire a un bureau à sa disposition et travaille dans un environnement agréable. Les commodités à dispositions sont :
•	Deux cafétérias et un stand
•	Transports publics à proximité
',
                'parent_id' => NULL,
                'previous_id' => 41,
                'responsible_id' => 78,
            ),
            68 => 
            array (
                'admin_id' => 60,
                'beginDate' => '2015-02-01 00:00:00',
                'companies_id' => 30,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2015-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 114,
                'intern_id' => 130,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 47,
                'responsible_id' => 156,
            ),
            69 => 
            array (
                'admin_id' => 61,
                'beginDate' => '2015-02-01 00:00:00',
                'companies_id' => 39,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2015-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 115,
                'intern_id' => 123,
                'internshipDescription' => 'Support de 1er et 2ème niveau

Déploiement et support informatique sous différents environnements (Windows , iOS, Android, etc.). 

Contact téléphonique avec les fournisseurs.

Utilisation d’un système de ticketing afin de répertorier les différents incidents.

Contact direct avec les collaborateurs et résolutions de problème depuis le bureau d’accueil (Welcome Desk).

Intervention sur site pour le support informatique ou les remplacements de matériel.

Possibilité d’avoir du temps libre pour la réalisation d’un projet. 

Préparation de vidéoconférence depuis différents systèmes (téléphone Cisco, Bridge…).',
                'parent_id' => NULL,
                'previous_id' => 32,
                'responsible_id' => 61,
            ),
            70 => 
            array (
                'admin_id' => 166,
                'beginDate' => '2015-02-01 00:00:00',
                'companies_id' => 50,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2015-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 116,
                'intern_id' => 125,
                'internshipDescription' => 'Helpdesk pour un parc de PC et Mac
Bon niveau d\'anglais nécessaire (école internationale)',
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 166,
            ),
            71 => 
            array (
                'admin_id' => 62,
                'beginDate' => '2015-02-01 00:00:00',
                'companies_id' => 35,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2015-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 119,
                'intern_id' => 138,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 55,
                'responsible_id' => 150,
            ),
            72 => 
            array (
                'admin_id' => 89,
                'beginDate' => '2015-02-01 00:00:00',
                'companies_id' => 55,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2015-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 121,
                'intern_id' => 126,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 92,
            ),
            73 => 
            array (
                'admin_id' => 169,
                'beginDate' => '2015-02-01 00:00:00',
                'companies_id' => 37,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 14,
                'endDate' => '2015-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 122,
                'intern_id' => 137,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 60,
                'responsible_id' => 70,
            ),
            74 => 
            array (
                'admin_id' => NULL,
                'beginDate' => '2015-09-01 00:00:00',
                'companies_id' => 70,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2016-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 127,
                'intern_id' => 115,
                'internshipDescription' => '-         Support informatique aux utilisateurs interne
-         Réalisation de scripts PHP (sous linux)
-         Configuration réseaux (wifi / firewall / switchs …)
-         Réalisation de pages web (PHP / HTML5)
-         Après formation interne, dépannage réseau chez des clients (firewall / wifi / …)',
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 146,
            ),
            75 => 
            array (
                'admin_id' => 147,
                'beginDate' => '2015-02-01 00:00:00',
                'companies_id' => 71,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2015-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 128,
                'intern_id' => 117,
                'internshipDescription' => 'Helpdesk
Installation de postes
Migration de postes',
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 174,
            ),
            76 => 
            array (
                'admin_id' => 147,
                'beginDate' => '2015-02-01 00:00:00',
                'companies_id' => 71,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2015-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 129,
                'intern_id' => 129,
                'internshipDescription' => 'Helpdesk
Installation de postes
Migration de postes',
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 174,
            ),
            77 => 
            array (
                'admin_id' => 72,
                'beginDate' => '2015-02-01 00:00:00',
                'companies_id' => 42,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2015-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 131,
                'intern_id' => 120,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 68,
                'responsible_id' => 154,
            ),
            78 => 
            array (
                'admin_id' => 190,
                'beginDate' => '2015-09-01 00:00:00',
                'companies_id' => 42,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2016-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 132,
                'intern_id' => 133,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 131,
                'responsible_id' => 154,
            ),
            79 => 
            array (
                'admin_id' => 155,
                'beginDate' => '2015-09-01 00:00:00',
                'companies_id' => 46,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2016-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 133,
                'intern_id' => 127,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 98,
                'responsible_id' => 56,
            ),
            80 => 
            array (
                'admin_id' => 65,
                'beginDate' => '2015-02-01 00:00:00',
                'companies_id' => 38,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2015-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 134,
                'intern_id' => 141,
                'internshipDescription' => 'L’équipe « Integration & Development » est composée de 5 ingénieurs et d’un Team Leader. Elle est sollicitée pour tout type de développement en interne que ce soit pour l’IT ou d’autres départements. Les technologies utilisées sont entre autres JAVA – JEE, BPEL, PHP5, Python, etc…
Le stagiaire est sollicité par l’équipe pour divers travaux en fonction des connaissances et de la motivation démontrée. Les premiers travaux sont de petites envergures afin de laisser un temps pour s’adapter et faire ses preuves. Les premières tâches seront généralement :
· Effectuer des modifications sur des applications web (PHP & Java)
· Rédiger de la documentation
· Se former sur les framework technologies utilisées
Chaque semaine du temps est laissé au stagiaire pour se former personnellement et de manière autodidacte. Suite à quoi, l’équipe pourra lui proposer des projets de moyennes ou grandes envergures. Le projet peut être, par exemple, une application web qui comprend les phases (Analyse, Conception, Réalisation, Tests, Mise en service).
L’équipe est souvent très prise. C’est pourquoi le triangle des compétences requis pour ce stage est : l’autonomie, la débrouillardise et la motivation.',
                'parent_id' => NULL,
                'previous_id' => 103,
                'responsible_id' => 80,
            ),
            81 => 
            array (
                'admin_id' => 164,
                'beginDate' => '2015-02-01 00:00:00',
                'companies_id' => 38,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2015-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 137,
                'intern_id' => 140,
                'internshipDescription' => 'Activités au sein du groupe Kudelski Security, à définir',
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 171,
            ),
            82 => 
            array (
                'admin_id' => 160,
                'beginDate' => '2015-02-01 00:00:00',
                'companies_id' => 74,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2015-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 138,
                'intern_id' => 115,
                'internshipDescription' => 'Entreprise spécialisée dans la création et l\'installation de réseaux informatiques sans fil.
Beaucoup d\'interventions chez le client pour installer, dépanner, améliorer le réseau dans des entreprises, hôtels ou même chez des particuliers.',
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 159,
            ),
            83 => 
            array (
                'admin_id' => 161,
                'beginDate' => '2015-02-01 00:00:00',
                'companies_id' => 75,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2015-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 139,
                'intern_id' => 124,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 161,
            ),
            84 => 
            array (
                'admin_id' => 184,
                'beginDate' => '2015-09-01 00:00:00',
                'companies_id' => 50,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2016-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 158,
                'intern_id' => 116,
                'internshipDescription' => 'Helpdesk pour un parc de PC et Mac
Bon niveau d\'anglais nécessaire (école internationale)',
                'parent_id' => NULL,
                'previous_id' => 116,
                'responsible_id' => 178,
            ),
            85 => 
            array (
                'admin_id' => 161,
                'beginDate' => '2015-09-01 00:00:00',
                'companies_id' => 75,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2016-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 160,
                'intern_id' => 124,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 161,
            ),
            86 => 
            array (
                'admin_id' => 51,
                'beginDate' => '2015-09-01 00:00:00',
                'companies_id' => 43,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2016-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 161,
                'intern_id' => 139,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 96,
                'responsible_id' => 44,
            ),
            87 => 
            array (
                'admin_id' => 50,
                'beginDate' => '2015-09-01 00:00:00',
                'companies_id' => 44,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2016-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 162,
                'intern_id' => 119,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 104,
                'responsible_id' => 82,
            ),
            88 => 
            array (
                'admin_id' => 89,
                'beginDate' => '2015-09-01 00:00:00',
                'companies_id' => 55,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2016-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 163,
                'intern_id' => 122,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 121,
                'responsible_id' => 92,
            ),
            89 => 
            array (
                'admin_id' => 169,
                'beginDate' => '2015-09-01 00:00:00',
                'companies_id' => 37,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2016-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 167,
                'intern_id' => 144,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 122,
                'responsible_id' => 191,
            ),
            90 => 
            array (
                'admin_id' => 169,
                'beginDate' => '2015-09-01 00:00:00',
                'companies_id' => 37,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2016-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 168,
                'intern_id' => 136,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 112,
                'responsible_id' => 191,
            ),
            91 => 
            array (
                'admin_id' => 147,
                'beginDate' => '2015-09-01 00:00:00',
                'companies_id' => 71,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2016-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 169,
                'intern_id' => 113,
                'internshipDescription' => 'Helpdesk
Installation de postes
Migration de postes',
                'parent_id' => NULL,
                'previous_id' => 128,
                'responsible_id' => 174,
            ),
            92 => 
            array (
                'admin_id' => 47,
                'beginDate' => '2015-09-01 00:00:00',
                'companies_id' => 41,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2016-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 171,
                'intern_id' => 117,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 101,
                'responsible_id' => 47,
            ),
            93 => 
            array (
                'admin_id' => 79,
                'beginDate' => '2015-09-01 00:00:00',
                'companies_id' => 33,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2016-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 172,
                'intern_id' => 134,
                'internshipDescription' => 'Support, installation, dépannage, projets individuels',
                'parent_id' => NULL,
                'previous_id' => 111,
                'responsible_id' => 79,
            ),
            94 => 
            array (
                'admin_id' => 62,
                'beginDate' => '2015-09-01 00:00:00',
                'companies_id' => 35,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2016-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 173,
                'intern_id' => 123,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 109,
                'responsible_id' => 148,
            ),
            95 => 
            array (
                'admin_id' => 62,
                'beginDate' => '2015-09-01 00:00:00',
                'companies_id' => 35,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 11,
                'endDate' => '2016-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 174,
                'intern_id' => 137,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 119,
                'responsible_id' => 150,
            ),
            96 => 
            array (
                'admin_id' => 186,
                'beginDate' => '2015-09-01 00:00:00',
                'companies_id' => 39,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2016-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 176,
                'intern_id' => 114,
                'internshipDescription' => 'Support de 1er et 2ème niveau

Déploiement et support informatique sous différents environnements (Windows , iOS, Android, etc.). 

Contact téléphonique avec les fournisseurs.

Utilisation d’un système de ticketing afin de répertorier les différents incidents.

Contact direct avec les collaborateurs et résolutions de problème depuis le bureau d’accueil (Welcome Desk).

Intervention sur site pour le support informatique ou les remplacements de matériel.

Possibilité d’avoir du temps libre pour la réalisation d’un projet. 

Préparation de vidéoconférence depuis différents systèmes (téléphone Cisco, Bridge…).',
                'parent_id' => NULL,
                'previous_id' => 115,
                'responsible_id' => 185,
            ),
            97 => 
            array (
                'admin_id' => 60,
                'beginDate' => '2015-09-01 00:00:00',
                'companies_id' => 30,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2016-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 177,
                'intern_id' => 126,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 114,
                'responsible_id' => 156,
            ),
            98 => 
            array (
                'admin_id' => 163,
                'beginDate' => '2015-09-01 00:00:00',
                'companies_id' => 38,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2016-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 178,
                'intern_id' => 128,
                'internshipDescription' => 'Développement d\'outils au sein du groupe Project Office du R&D Nagravision',
                'parent_id' => NULL,
                'previous_id' => 103,
                'responsible_id' => 98,
            ),
            99 => 
            array (
                'admin_id' => 65,
                'beginDate' => '2015-09-01 00:00:00',
                'companies_id' => 38,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2016-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 179,
                'intern_id' => 143,
                'internshipDescription' => 'L’équipe « Integration & Development » est composée de 5 ingénieurs et d’un Team Leader. Elle est sollicitée pour tout type de développement en interne que ce soit pour l’IT ou d’autres départements. Les technologies utilisées sont entre autres JAVA – JEE, BPEL, PHP5, Python, etc…
Le stagiaire est sollicité par l’équipe pour divers travaux en fonction des connaissances et de la motivation démontrée. Les premiers travaux sont de petites envergures afin de laisser un temps pour s’adapter et faire ses preuves. Les premières tâches seront généralement :
· Effectuer des modifications sur des applications web (PHP & Java)
· Rédiger de la documentation
· Se former sur les framework technologies utilisées
Chaque semaine du temps est laissé au stagiaire pour se former personnellement et de manière autodidacte. Suite à quoi, l’équipe pourra lui proposer des projets de moyennes ou grandes envergures. Le projet peut être, par exemple, une application web qui comprend les phases (Analyse, Conception, Réalisation, Tests, Mise en service).
L’équipe est souvent très prise. C’est pourquoi le triangle des compétences requis pour ce stage est : l’autonomie, la débrouillardise et la motivation.',
                'parent_id' => NULL,
                'previous_id' => 134,
                'responsible_id' => 80,
            ),
            100 => 
            array (
                'admin_id' => 164,
                'beginDate' => '2015-09-01 00:00:00',
                'companies_id' => 38,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2016-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 180,
                'intern_id' => 140,
                'internshipDescription' => 'Activités au sein du groupe "Kudelski Security"',
                'parent_id' => NULL,
                'previous_id' => 137,
                'responsible_id' => 171,
            ),
            101 => 
            array (
                'admin_id' => 54,
                'beginDate' => '2015-09-01 00:00:00',
                'companies_id' => 28,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2016-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 181,
                'intern_id' => 118,
                'internshipDescription' => 'Environnement MAC.
Demandent des stagiaires curieux et désireux d\'apprendre!',
                'parent_id' => NULL,
                'previous_id' => 107,
                'responsible_id' => 57,
            ),
            102 => 
            array (
                'admin_id' => 85,
                'beginDate' => '2015-09-01 00:00:00',
                'companies_id' => 40,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2016-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 182,
                'intern_id' => 131,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 105,
                'responsible_id' => 58,
            ),
            103 => 
            array (
                'admin_id' => 64,
                'beginDate' => '2015-09-01 00:00:00',
                'companies_id' => 48,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2016-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 183,
                'intern_id' => 141,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 102,
                'responsible_id' => 64,
            ),
            104 => 
            array (
                'admin_id' => 182,
                'beginDate' => '2015-09-01 00:00:00',
                'companies_id' => 26,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2016-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 184,
                'intern_id' => 138,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 113,
                'responsible_id' => 78,
            ),
            105 => 
            array (
                'admin_id' => 63,
                'beginDate' => '2015-09-01 00:00:00',
                'companies_id' => 29,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2016-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 185,
                'intern_id' => 132,
                'internshipDescription' => 'Travail varié: support, installation, dépannage, projets individuels.<br>Très peu d\'encadrement!',
                'parent_id' => NULL,
                'previous_id' => 100,
                'responsible_id' => 63,
            ),
            106 => 
            array (
                'admin_id' => 53,
                'beginDate' => '2015-09-01 00:00:00',
                'companies_id' => 32,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2016-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 186,
                'intern_id' => 129,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 108,
                'responsible_id' => 53,
            ),
            107 => 
            array (
                'admin_id' => 44,
                'beginDate' => '2015-09-01 00:00:00',
                'companies_id' => 45,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2016-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 187,
                'intern_id' => 142,
                'internshipDescription' => 'Support, installation, dépannage',
                'parent_id' => NULL,
                'previous_id' => 93,
                'responsible_id' => 44,
            ),
            108 => 
            array (
                'admin_id' => 183,
                'beginDate' => '2016-02-01 00:00:00',
                'companies_id' => 84,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2016-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 189,
                'intern_id' => 217,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 183,
            ),
            109 => 
            array (
                'admin_id' => 184,
                'beginDate' => '2015-09-01 00:00:00',
                'companies_id' => 50,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2016-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 191,
                'intern_id' => 120,
                'internshipDescription' => 'Helpdesk pour un parc de PC et Mac
Bon niveau d\'anglais nécessaire (école internationale)',
                'parent_id' => NULL,
                'previous_id' => 116,
                'responsible_id' => 178,
            ),
            110 => 
            array (
                'admin_id' => 160,
                'beginDate' => '2015-09-01 00:00:00',
                'companies_id' => 74,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2016-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 192,
                'intern_id' => 125,
                'internshipDescription' => 'Entreprise spécialisée dans la création et l\'installation de réseaux informatiques sans fil.
Beaucoup d\'interventions chez le client pour installer, dépanner, améliorer le réseau dans des entreprises, hôtels ou même chez des particuliers.',
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 159,
            ),
            111 => 
            array (
                'admin_id' => 74,
                'beginDate' => '2015-09-01 00:00:00',
                'companies_id' => 25,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 14,
                'endDate' => '2016-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 196,
                'intern_id' => 32,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 99,
                'responsible_id' => 74,
            ),
            112 => 
            array (
                'admin_id' => 51,
                'beginDate' => '2016-02-01 00:00:00',
                'companies_id' => 43,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2016-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 198,
                'intern_id' => 199,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 161,
                'responsible_id' => 44,
            ),
            113 => 
            array (
                'admin_id' => 163,
                'beginDate' => '2016-02-01 00:00:00',
                'companies_id' => 38,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2016-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 199,
                'intern_id' => 209,
                'internshipDescription' => 'Développement d\'outils au sein du groupe Project Office du R&D Nagravision',
                'parent_id' => NULL,
                'previous_id' => 178,
                'responsible_id' => 98,
            ),
            114 => 
            array (
                'admin_id' => 163,
                'beginDate' => '2016-02-01 00:00:00',
                'companies_id' => 38,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2016-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 200,
                'intern_id' => 206,
                'internshipDescription' => 'Développement d\'outils au sein du groupe Project Office du R&D Nagravision',
                'parent_id' => NULL,
                'previous_id' => 178,
                'responsible_id' => 98,
            ),
            115 => 
            array (
                'admin_id' => 65,
                'beginDate' => '2016-02-01 00:00:00',
                'companies_id' => 38,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2016-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 201,
                'intern_id' => 200,
                'internshipDescription' => 'L’équipe « Integration & Development » est composée de 5 ingénieurs et d’un Team Leader. Elle est sollicitée pour tout type de développement en interne que ce soit pour l’IT ou d’autres départements. Les technologies utilisées sont entre autres JAVA – JEE, BPEL, PHP5, Python, etc…
Le stagiaire est sollicité par l’équipe pour divers travaux en fonction des connaissances et de la motivation démontrée. Les premiers travaux sont de petites envergures afin de laisser un temps pour s’adapter et faire ses preuves. Les premières tâches seront généralement :
· Effectuer des modifications sur des applications web (PHP & Java)
· Rédiger de la documentation
· Se former sur les framework technologies utilisées
Chaque semaine du temps est laissé au stagiaire pour se former personnellement et de manière autodidacte. Suite à quoi, l’équipe pourra lui proposer des projets de moyennes ou grandes envergures. Le projet peut être, par exemple, une application web qui comprend les phases (Analyse, Conception, Réalisation, Tests, Mise en service).
L’équipe est souvent très prise. C’est pourquoi le triangle des compétences requis pour ce stage est : l’autonomie, la débrouillardise et la motivation.',
                'parent_id' => NULL,
                'previous_id' => 179,
                'responsible_id' => 236,
            ),
            116 => 
            array (
                'admin_id' => 160,
                'beginDate' => '2016-02-01 00:00:00',
                'companies_id' => 74,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2016-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 203,
                'intern_id' => 212,
                'internshipDescription' => 'Entreprise spécialisée dans la création et l\'installation de réseaux informatiques sans fil.
Beaucoup d\'interventions chez le client pour installer, dépanner, améliorer le réseau dans des entreprises, hôtels ou même chez des particuliers.',
                'parent_id' => NULL,
                'previous_id' => 192,
                'responsible_id' => 159,
            ),
            117 => 
            array (
                'admin_id' => 147,
                'beginDate' => '2016-02-01 00:00:00',
                'companies_id' => 71,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2016-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 204,
                'intern_id' => 196,
                'internshipDescription' => 'Helpdesk
Installation de postes
Migration de postes',
                'parent_id' => NULL,
                'previous_id' => 169,
                'responsible_id' => 177,
            ),
            118 => 
            array (
                'admin_id' => 186,
                'beginDate' => '2016-02-01 00:00:00',
                'companies_id' => 39,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2016-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 205,
                'intern_id' => 202,
                'internshipDescription' => 'Support de 1er et 2ème niveau

Déploiement et support informatique sous différents environnements (Windows , iOS, Android, etc.). 

Contact téléphonique avec les fournisseurs.

Utilisation d’un système de ticketing afin de répertorier les différents incidents.

Contact direct avec les collaborateurs et résolutions de problème depuis le bureau d’accueil (Welcome Desk).

Intervention sur site pour le support informatique ou les remplacements de matériel.

Possibilité d’avoir du temps libre pour la réalisation d’un projet. 

Préparation de vidéoconférence depuis différents systèmes (téléphone Cisco, Bridge…).',
                'parent_id' => NULL,
                'previous_id' => 176,
                'responsible_id' => 185,
            ),
            119 => 
            array (
                'admin_id' => 60,
                'beginDate' => '2016-02-01 00:00:00',
                'companies_id' => 30,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2016-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 206,
                'intern_id' => 195,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 177,
                'responsible_id' => 156,
            ),
            120 => 
            array (
                'admin_id' => 155,
                'beginDate' => '2016-02-01 00:00:00',
                'companies_id' => 46,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2016-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 207,
                'intern_id' => 213,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 133,
                'responsible_id' => 56,
            ),
            121 => 
            array (
                'admin_id' => 184,
                'beginDate' => '2016-02-01 00:00:00',
                'companies_id' => 50,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2016-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 209,
                'intern_id' => 205,
                'internshipDescription' => 'Helpdesk pour un parc de PC et Mac
Bon niveau d\'anglais nécessaire (école internationale)',
                'parent_id' => NULL,
                'previous_id' => 191,
                'responsible_id' => 178,
            ),
            122 => 
            array (
                'admin_id' => 47,
                'beginDate' => '2016-02-01 00:00:00',
                'companies_id' => 41,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2016-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 210,
                'intern_id' => 219,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 171,
                'responsible_id' => 47,
            ),
            123 => 
            array (
                'admin_id' => 54,
                'beginDate' => '2016-02-01 00:00:00',
                'companies_id' => 28,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2016-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 211,
                'intern_id' => NULL,
                'internshipDescription' => 'Environnement MAC.
Demandent des stagiaires curieux et désireux d\'apprendre!',
                'parent_id' => NULL,
                'previous_id' => 181,
                'responsible_id' => 57,
            ),
            124 => 
            array (
                'admin_id' => 50,
                'beginDate' => '2016-02-01 00:00:00',
                'companies_id' => 44,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2016-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 212,
                'intern_id' => 211,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 162,
                'responsible_id' => 82,
            ),
            125 => 
            array (
                'admin_id' => 89,
                'beginDate' => '2016-02-01 00:00:00',
                'companies_id' => 55,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2016-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 213,
                'intern_id' => 207,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 163,
                'responsible_id' => 92,
            ),
            126 => 
            array (
                'admin_id' => 62,
                'beginDate' => '2016-02-01 00:00:00',
                'companies_id' => 35,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2016-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 214,
                'intern_id' => 204,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 173,
                'responsible_id' => 150,
            ),
            127 => 
            array (
                'admin_id' => 62,
                'beginDate' => '2016-02-01 00:00:00',
                'companies_id' => 35,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2016-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 215,
                'intern_id' => 215,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 173,
                'responsible_id' => 148,
            ),
            128 => 
            array (
                'admin_id' => 53,
                'beginDate' => '2016-02-01 00:00:00',
                'companies_id' => 32,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2016-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 216,
                'intern_id' => 201,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 186,
                'responsible_id' => 53,
            ),
            129 => 
            array (
                'admin_id' => 44,
                'beginDate' => '2016-02-01 00:00:00',
                'companies_id' => 45,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2016-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 219,
                'intern_id' => 214,
                'internshipDescription' => 'Support, installation, dépannage',
                'parent_id' => NULL,
                'previous_id' => 187,
                'responsible_id' => 44,
            ),
            130 => 
            array (
                'admin_id' => 85,
                'beginDate' => '2016-02-01 00:00:00',
                'companies_id' => 40,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2016-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 220,
                'intern_id' => 208,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 182,
                'responsible_id' => 58,
            ),
            131 => 
            array (
                'admin_id' => 63,
                'beginDate' => '2016-02-01 00:00:00',
                'companies_id' => 29,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2016-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 221,
                'intern_id' => 210,
                'internshipDescription' => 'Travail varié: support, installation, dépannage, projets individuels.<br>Très peu d\'encadrement!',
                'parent_id' => NULL,
                'previous_id' => 185,
                'responsible_id' => 224,
            ),
            132 => 
            array (
                'admin_id' => 169,
                'beginDate' => '2016-02-01 00:00:00',
                'companies_id' => 37,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2016-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 222,
                'intern_id' => 194,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 167,
                'responsible_id' => 191,
            ),
            133 => 
            array (
                'admin_id' => 169,
                'beginDate' => '2016-02-01 00:00:00',
                'companies_id' => 37,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2016-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 223,
                'intern_id' => 220,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 168,
                'responsible_id' => 191,
            ),
            134 => 
            array (
                'admin_id' => 79,
                'beginDate' => '2016-02-01 00:00:00',
                'companies_id' => 33,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2016-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 225,
                'intern_id' => 198,
                'internshipDescription' => 'Support, installation, dépannage, projets individuels',
                'parent_id' => NULL,
                'previous_id' => 172,
                'responsible_id' => 79,
            ),
            135 => 
            array (
                'admin_id' => 163,
                'beginDate' => '2016-02-01 00:00:00',
                'companies_id' => 38,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2016-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 228,
                'intern_id' => 216,
                'internshipDescription' => 'Développement d\'outils au sein du groupe CAS PU - Trusted Platform',
                'parent_id' => NULL,
                'previous_id' => 30,
                'responsible_id' => 81,
            ),
            136 => 
            array (
                'admin_id' => NULL,
                'beginDate' => '2016-02-01 00:00:00',
                'companies_id' => 69,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2016-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 230,
                'intern_id' => 203,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 162,
            ),
            137 => 
            array (
                'admin_id' => 225,
                'beginDate' => '2016-02-01 00:00:00',
                'companies_id' => 90,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2016-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 232,
                'intern_id' => 193,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 225,
            ),
            138 => 
            array (
                'admin_id' => 62,
                'beginDate' => '2016-09-01 00:00:00',
                'companies_id' => 35,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2017-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 233,
                'intern_id' => 204,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 214,
                'responsible_id' => 148,
            ),
            139 => 
            array (
                'admin_id' => 62,
                'beginDate' => '2016-09-01 00:00:00',
                'companies_id' => 35,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2017-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 234,
                'intern_id' => 219,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 214,
                'responsible_id' => 148,
            ),
            140 => 
            array (
                'admin_id' => 62,
                'beginDate' => '2016-09-01 00:00:00',
                'companies_id' => 35,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2017-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 235,
                'intern_id' => 210,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 148,
            ),
            141 => 
            array (
                'admin_id' => 234,
                'beginDate' => '2016-09-01 00:00:00',
                'companies_id' => 47,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2017-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 236,
                'intern_id' => 194,
                'internshipDescription' => 'Support, installation, dépannage',
                'parent_id' => NULL,
                'previous_id' => 95,
                'responsible_id' => 234,
            ),
            142 => 
            array (
                'admin_id' => 186,
                'beginDate' => '2016-09-01 00:00:00',
                'companies_id' => 39,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2017-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 237,
                'intern_id' => 202,
                'internshipDescription' => 'Support de 1er et 2ème niveau

Déploiement et support informatique sous différents environnements (Windows , iOS, Android, etc.). 

Contact téléphonique avec les fournisseurs.

Utilisation d’un système de ticketing afin de répertorier les différents incidents.

Contact direct avec les collaborateurs et résolutions de problème depuis le bureau d’accueil (Welcome Desk).

Intervention sur site pour le support informatique ou les remplacements de matériel.

Possibilité d’avoir du temps libre pour la réalisation d’un projet. 

Préparation de vidéoconférence depuis différents systèmes (téléphone Cisco, Bridge…).',
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 185,
            ),
            143 => 
            array (
                'admin_id' => 186,
                'beginDate' => '2016-09-01 00:00:00',
                'companies_id' => 39,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2017-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 238,
                'intern_id' => 207,
                'internshipDescription' => 'Support de 1er et 2ème niveau

Déploiement et support informatique sous différents environnements (Windows , iOS, Android, etc.). 

Contact téléphonique avec les fournisseurs.

Utilisation d’un système de ticketing afin de répertorier les différents incidents.

Contact direct avec les collaborateurs et résolutions de problème depuis le bureau d’accueil (Welcome Desk).

Intervention sur site pour le support informatique ou les remplacements de matériel.

Possibilité d’avoir du temps libre pour la réalisation d’un projet. 

Préparation de vidéoconférence depuis différents systèmes (téléphone Cisco, Bridge…).',
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 185,
            ),
            144 => 
            array (
                'admin_id' => 163,
                'beginDate' => '2016-09-01 00:00:00',
                'companies_id' => 38,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2017-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 239,
                'intern_id' => 214,
                'internshipDescription' => 'Développement d\'outils au sein du groupe Project Office du R&D Nagravision',
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 98,
            ),
            145 => 
            array (
                'admin_id' => 163,
                'beginDate' => '2016-09-01 00:00:00',
                'companies_id' => 38,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2017-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 240,
                'intern_id' => 200,
                'internshipDescription' => 'Développement d\'outils au sein du groupe Project Office du R&D Nagravision',
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 98,
            ),
            146 => 
            array (
                'admin_id' => 147,
                'beginDate' => '2016-09-01 00:00:00',
                'companies_id' => 71,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2017-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 241,
                'intern_id' => 196,
                'internshipDescription' => 'Helpdesk
Installation de postes
Migration de postes',
                'parent_id' => NULL,
                'previous_id' => 204,
                'responsible_id' => 177,
            ),
            147 => 
            array (
                'admin_id' => 232,
                'beginDate' => '2016-09-01 00:00:00',
                'companies_id' => 28,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2017-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 242,
                'intern_id' => 203,
                'internshipDescription' => 'Environnement MAC.
Demandent des stagiaires curieux et désireux d\'apprendre!',
                'parent_id' => NULL,
                'previous_id' => 211,
                'responsible_id' => 57,
            ),
            148 => 
            array (
                'admin_id' => 231,
                'beginDate' => '2016-09-01 00:00:00',
                'companies_id' => 29,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2017-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 243,
                'intern_id' => 213,
                'internshipDescription' => 'Travail varié: support, installation, dépannage, projets individuels.<br>Très peu d\'encadrement!',
                'parent_id' => NULL,
                'previous_id' => 221,
                'responsible_id' => 224,
            ),
            149 => 
            array (
                'admin_id' => 79,
                'beginDate' => '2016-09-01 00:00:00',
                'companies_id' => 33,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2017-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 244,
                'intern_id' => 206,
                'internshipDescription' => 'Support, installation, dépannage, projets individuels',
                'parent_id' => NULL,
                'previous_id' => 225,
                'responsible_id' => 79,
            ),
            150 => 
            array (
                'admin_id' => 85,
                'beginDate' => '2016-09-01 00:00:00',
                'companies_id' => 40,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2017-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 245,
                'intern_id' => 208,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 220,
                'responsible_id' => 58,
            ),
            151 => 
            array (
                'admin_id' => 163,
                'beginDate' => '2016-09-01 00:00:00',
                'companies_id' => 38,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2017-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 246,
                'intern_id' => 216,
                'internshipDescription' => 'Développement d\'outils au sein du groupe Project Office du R&D Nagravision',
                'parent_id' => NULL,
                'previous_id' => 228,
                'responsible_id' => 81,
            ),
            152 => 
            array (
                'admin_id' => 160,
                'beginDate' => '2016-09-01 00:00:00',
                'companies_id' => 74,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2017-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 247,
                'intern_id' => 198,
                'internshipDescription' => 'Entreprise spécialisée dans la création et l\'installation de réseaux informatiques sans fil.
Beaucoup d\'interventions chez le client pour installer, dépanner, améliorer le réseau dans des entreprises, hôtels ou même chez des particuliers.',
                'parent_id' => NULL,
                'previous_id' => 203,
                'responsible_id' => 159,
            ),
            153 => 
            array (
                'admin_id' => 182,
                'beginDate' => '2016-09-01 00:00:00',
                'companies_id' => 26,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 11,
                'endDate' => '2017-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 248,
                'intern_id' => NULL,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 184,
                'responsible_id' => 78,
            ),
            154 => 
            array (
                'admin_id' => 237,
                'beginDate' => '2016-09-01 00:00:00',
                'companies_id' => 43,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2017-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 249,
                'intern_id' => 212,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 198,
                'responsible_id' => 44,
            ),
            155 => 
            array (
                'admin_id' => 237,
                'beginDate' => '2016-09-01 00:00:00',
                'companies_id' => 43,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2017-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 250,
                'intern_id' => 215,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 198,
                'responsible_id' => 44,
            ),
            156 => 
            array (
                'admin_id' => 146,
                'beginDate' => '2016-09-01 00:00:00',
                'companies_id' => 70,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2017-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 252,
                'intern_id' => 220,
            'internshipDescription' => 'En fonction du stagiaire, développement PHP, gestion réseau (cisco), paramétrages réseaux / wifi / … chez des clients finaux.
Support aux utilisateurs interne. Administration Linux.
Cela n’est pas figé et cela peut évoluer en fonction des affinités des stagiaires.',
                'parent_id' => NULL,
                'previous_id' => 127,
                'responsible_id' => 146,
            ),
            157 => 
            array (
                'admin_id' => 162,
                'beginDate' => '2016-09-01 00:00:00',
                'companies_id' => 69,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2017-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 253,
                'intern_id' => 205,
                'internshipDescription' => '·         Support PC 1er et éventuellement 2e niveau
·         Mise en place de postes de travail
·         Helpdesk utilisateurs et suivi du ticketing du Helpdesk
·         Modifications et mises à jours des sites internet
·         Aide au changements dans le réseau informatique',
                'parent_id' => NULL,
                'previous_id' => 230,
                'responsible_id' => 162,
            ),
            158 => 
            array (
                'admin_id' => 169,
                'beginDate' => '2016-09-01 00:00:00',
                'companies_id' => 37,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2017-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 254,
                'intern_id' => 199,
                'internshipDescription' => 'Support Helpdesk dans un environnement international, Support de deuxième niveau, Préparation des postes de travail, Coordination et répartition des requêtes des utilisateurs, Installation de logiciels et imprimantes, Gestion des commandes, Gestion des retours de marchandise, Gestion des iPads et Gestion du bon fonctionnement des salles d’étude.',
                'parent_id' => NULL,
                'previous_id' => 222,
                'responsible_id' => 191,
            ),
            159 => 
            array (
                'admin_id' => 169,
                'beginDate' => '2016-09-01 00:00:00',
                'companies_id' => 37,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2017-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 255,
                'intern_id' => 139,
                'internshipDescription' => 'Support Helpdesk dans un environnement international, Support de deuxième niveau, Préparation des postes de travail, Coordination et répartition des requêtes des utilisateurs, Installation de logiciels et imprimantes, Gestion des commandes, Gestion des retours de marchandise, Gestion des iPads et Gestion du bon fonctionnement des salles d’étude.',
                'parent_id' => NULL,
                'previous_id' => 223,
                'responsible_id' => 191,
            ),
            160 => 
            array (
                'admin_id' => 164,
                'beginDate' => '2016-09-01 00:00:00',
                'companies_id' => 38,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2017-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 256,
                'intern_id' => 193,
                'internshipDescription' => 'Activités au sein du groupe "Kudelski Security"',
                'parent_id' => NULL,
                'previous_id' => 137,
                'responsible_id' => 158,
            ),
            161 => 
            array (
                'admin_id' => 239,
                'beginDate' => '2016-09-01 00:00:00',
                'companies_id' => 92,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 14,
                'endDate' => '2017-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 258,
                'intern_id' => 211,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 238,
            ),
            162 => 
            array (
                'admin_id' => 183,
                'beginDate' => '2016-09-01 00:00:00',
                'companies_id' => 84,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2017-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 259,
                'intern_id' => 217,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 189,
                'responsible_id' => 183,
            ),
            163 => 
            array (
                'admin_id' => 189,
                'beginDate' => '2016-09-01 00:00:00',
                'companies_id' => 86,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2017-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 261,
                'intern_id' => 201,
            'internshipDescription' => 'Développement PhP (Framework Yii), javascript, html, éventuellement GUI (QtCreator). Linux est un plus. Maintenance de postes clients',
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 189,
            ),
            164 => 
            array (
                'admin_id' => 47,
                'beginDate' => '2016-09-01 00:00:00',
                'companies_id' => 41,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 11,
                'endDate' => '2017-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 262,
                'intern_id' => NULL,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 210,
                'responsible_id' => 47,
            ),
            165 => 
            array (
                'admin_id' => 60,
                'beginDate' => '2016-09-01 00:00:00',
                'companies_id' => 30,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2017-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 263,
                'intern_id' => 195,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 206,
                'responsible_id' => 156,
            ),
            166 => 
            array (
                'admin_id' => 163,
                'beginDate' => '2016-09-01 00:00:00',
                'companies_id' => 38,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2017-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 264,
                'intern_id' => 209,
                'internshipDescription' => 'Activités au sein du groupe "Kudelski Security"',
                'parent_id' => NULL,
                'previous_id' => 199,
                'responsible_id' => 98,
            ),
            167 => 
            array (
                'admin_id' => 96,
                'beginDate' => '2017-02-01 00:00:00',
                'companies_id' => 60,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2017-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 265,
                'intern_id' => 255,
                'internshipDescription' => 'Participation au développement d\'applications mobiles Android, IOs et Windows universelle.
Ces applications reprennent les fonctionnalités www.intrepidknowledge.ch :
cours, communications par posts, dossiers et fichiers partagés, etc.

Les langages sont donc potentiellement java, C#, javascript, Objective C en
plus des framework mobile de Microsoft, Apple et Android.',
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 96,
            ),
            168 => 
            array (
                'admin_id' => 71,
                'beginDate' => '2017-02-01 00:00:00',
                'companies_id' => 41,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2017-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 268,
                'intern_id' => 253,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 210,
                'responsible_id' => 47,
            ),
            169 => 
            array (
                'admin_id' => 62,
                'beginDate' => '2017-02-01 00:00:00',
                'companies_id' => 35,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2017-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 269,
                'intern_id' => 218,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 234,
                'responsible_id' => 148,
            ),
            170 => 
            array (
                'admin_id' => 62,
                'beginDate' => '2017-02-01 00:00:00',
                'companies_id' => 35,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2017-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 270,
                'intern_id' => 242,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 235,
                'responsible_id' => 148,
            ),
            171 => 
            array (
                'admin_id' => 278,
                'beginDate' => '2017-02-01 00:00:00',
                'companies_id' => 38,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2017-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 271,
                'intern_id' => 266,
                'internshipDescription' => 'Réalisation ou participation à l\'un ou l\'autre des projets suivants:
Mission 1
Improve Visualization of Big Data based on access flows to buildings. Typical profile: 2D/3D design on Web Objects. Database querying.
Mission 2
Evaluate and implement a monitoring solution in a complex environment. Typical Profile: Developer Profile / Network Profile.
Mission 3
The Project shall consist in designing a multi-automated scanner manager. In particular, finalize the network scanning part, implement the web application scanning part, the recommendation part and link that to a GUI.
Mission 4
The Project shall consist in designing dynamical dashboard viewer to be linked with a TV, running on a RaspBerry Pi.
Mission 5
Develop a frontend web application that helps manage / handle a massive portscanning framework performing multiple worldwide scans per day.
Mission 6
Develop a tool in C/C++ on Windows or Linux, preferably based on QEMU, to allow the emulation of a specific type of ARM controller with S-ATA interface. Typical profile: C/C+ / embedded devices.
Develop a web application based on the Yii 2 framework (mandatory) according to an already existing specification.',
                'parent_id' => NULL,
                'previous_id' => 256,
                'responsible_id' => 158,
            ),
            172 => 
            array (
                'admin_id' => 164,
                'beginDate' => '2017-02-01 00:00:00',
                'companies_id' => 38,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2017-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 272,
                'intern_id' => 254,
                'internshipDescription' => 'Développement d\'outils au sein du groupe Project Office du R&D Nagravision',
                'parent_id' => NULL,
                'previous_id' => 239,
                'responsible_id' => 285,
            ),
            173 => 
            array (
                'admin_id' => 164,
                'beginDate' => '2017-02-01 00:00:00',
                'companies_id' => 38,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2017-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 273,
                'intern_id' => 270,
                'internshipDescription' => 'Développement d\'outils au sein du groupe Project Office du R&D Nagravision',
                'parent_id' => NULL,
                'previous_id' => 240,
                'responsible_id' => 285,
            ),
            174 => 
            array (
                'admin_id' => 271,
                'beginDate' => '2017-02-01 00:00:00',
                'companies_id' => 104,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2017-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 274,
                'intern_id' => 268,
            'internshipDescription' => 'Activités de développement chez NagraStar aux Etats-Unis (Denver, CO)',
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 321,
            ),
            175 => 
            array (
                'admin_id' => 234,
                'beginDate' => '2017-02-01 00:00:00',
                'companies_id' => 47,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2017-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 275,
                'intern_id' => 258,
                'internshipDescription' => 'Support, installation, dépannage',
                'parent_id' => NULL,
                'previous_id' => 236,
                'responsible_id' => 234,
            ),
            176 => 
            array (
                'admin_id' => 169,
                'beginDate' => '2017-02-01 00:00:00',
                'companies_id' => 37,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2017-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 276,
                'intern_id' => 264,
                'internshipDescription' => 'Support Helpdesk dans un environnement international, Support de deuxième niveau, Préparation des postes de travail, Coordination et répartition des requêtes des utilisateurs, Installation de logiciels et imprimantes, Gestion des commandes, Gestion des retours de marchandise, Gestion des iPads et Gestion du bon fonctionnement des salles d’étude.',
                'parent_id' => NULL,
                'previous_id' => 254,
                'responsible_id' => 191,
            ),
            177 => 
            array (
                'admin_id' => 169,
                'beginDate' => '2017-02-01 00:00:00',
                'companies_id' => 37,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2017-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 277,
                'intern_id' => 252,
                'internshipDescription' => 'Support Helpdesk dans un environnement international, Support de deuxième niveau, Préparation des postes de travail, Coordination et répartition des requêtes des utilisateurs, Installation de logiciels et imprimantes, Gestion des commandes, Gestion des retours de marchandise, Gestion des iPads et Gestion du bon fonctionnement des salles d’étude.',
                'parent_id' => NULL,
                'previous_id' => 255,
                'responsible_id' => 191,
            ),
            178 => 
            array (
                'admin_id' => 237,
                'beginDate' => '2017-02-01 00:00:00',
                'companies_id' => 43,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2017-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 279,
                'intern_id' => 243,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 249,
                'responsible_id' => 44,
            ),
            179 => 
            array (
                'admin_id' => 237,
                'beginDate' => '2017-02-01 00:00:00',
                'companies_id' => 43,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2017-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 280,
                'intern_id' => 262,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 250,
                'responsible_id' => 44,
            ),
            180 => 
            array (
                'admin_id' => 160,
                'beginDate' => '2017-02-01 00:00:00',
                'companies_id' => 74,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2017-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 281,
                'intern_id' => 256,
                'internshipDescription' => 'Entreprise spécialisée dans la création et l\'installation de réseaux informatiques sans fil.
Beaucoup d\'interventions chez le client pour installer, dépanner, améliorer le réseau dans des entreprises, hôtels ou même chez des particuliers.',
                'parent_id' => NULL,
                'previous_id' => 247,
                'responsible_id' => 159,
            ),
            181 => 
            array (
                'admin_id' => 231,
                'beginDate' => '2017-02-01 00:00:00',
                'companies_id' => 29,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2017-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 282,
                'intern_id' => 245,
                'internshipDescription' => 'Travail varié: support, installation, dépannage, projets individuels.<br>Très peu d\'encadrement!',
                'parent_id' => NULL,
                'previous_id' => 243,
                'responsible_id' => 224,
            ),
            182 => 
            array (
                'admin_id' => 189,
                'beginDate' => '2017-02-01 00:00:00',
                'companies_id' => 86,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2017-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 283,
                'intern_id' => 244,
            'internshipDescription' => 'Développement PhP (Framework Yii), javascript, html, éventuellement GUI (QtCreator). Linux est un plus. Maintenance de postes clients',
                'parent_id' => NULL,
                'previous_id' => 261,
                'responsible_id' => 189,
            ),
            183 => 
            array (
                'admin_id' => 232,
                'beginDate' => '2017-02-01 00:00:00',
                'companies_id' => 28,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2017-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 285,
                'intern_id' => 250,
                'internshipDescription' => 'Environnement MAC.
Demandent des stagiaires curieux et désireux d\'apprendre!',
                'parent_id' => NULL,
                'previous_id' => 242,
                'responsible_id' => 57,
            ),
            184 => 
            array (
                'admin_id' => 79,
                'beginDate' => '2017-02-01 00:00:00',
                'companies_id' => 33,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2017-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 287,
                'intern_id' => 257,
                'internshipDescription' => 'Support, installation, dépannage, projets individuels',
                'parent_id' => NULL,
                'previous_id' => 244,
                'responsible_id' => 79,
            ),
            185 => 
            array (
                'admin_id' => 146,
                'beginDate' => '2017-02-01 00:00:00',
                'companies_id' => 70,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2017-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 288,
                'intern_id' => 248,
            'internshipDescription' => 'En fonction du stagiaire, développement PHP, gestion réseau (cisco), paramétrages réseaux / wifi / … chez des clients finaux.
Support aux utilisateurs interne. Administration Linux.
Cela n’est pas figé et cela peut évoluer en fonction des affinités des stagiaires.',
                'parent_id' => NULL,
                'previous_id' => 252,
                'responsible_id' => 146,
            ),
            186 => 
            array (
                'admin_id' => 85,
                'beginDate' => '2017-02-01 00:00:00',
                'companies_id' => 40,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2017-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 289,
                'intern_id' => 263,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 245,
                'responsible_id' => 58,
            ),
            187 => 
            array (
                'admin_id' => 182,
                'beginDate' => '2017-02-01 00:00:00',
                'companies_id' => 26,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2017-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 291,
                'intern_id' => 251,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 184,
                'responsible_id' => 78,
            ),
            188 => 
            array (
                'admin_id' => 275,
                'beginDate' => '2017-02-01 00:00:00',
                'companies_id' => 50,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2017-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 293,
                'intern_id' => 259,
                'internshipDescription' => 'Helpdesk pour un parc de PC et Mac
Participation aux opérations de maintenance planifiées
Bon niveau d\'anglais nécessaire (école internationale)',
                'parent_id' => NULL,
                'previous_id' => 209,
                'responsible_id' => 283,
            ),
            189 => 
            array (
                'admin_id' => 50,
                'beginDate' => '2017-02-01 00:00:00',
                'companies_id' => 44,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2017-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 294,
                'intern_id' => 265,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 212,
                'responsible_id' => 82,
            ),
            190 => 
            array (
                'admin_id' => 89,
                'beginDate' => '2017-02-01 00:00:00',
                'companies_id' => 55,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2017-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 295,
                'intern_id' => 249,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 213,
                'responsible_id' => 92,
            ),
            191 => 
            array (
                'admin_id' => 186,
                'beginDate' => '2017-02-01 00:00:00',
                'companies_id' => 39,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2017-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 298,
                'intern_id' => 260,
                'internshipDescription' => 'Support de 1er et 2ème niveau

Déploiement et support informatique sous différents environnements (Windows , iOS, Android, etc.). 

Contact téléphonique avec les fournisseurs.

Utilisation d’un système de ticketing afin de répertorier les différents incidents.

Contact direct avec les collaborateurs et résolutions de problème depuis le bureau d’accueil (Welcome Desk).

Intervention sur site pour le support informatique ou les remplacements de matériel.

Possibilité d’avoir du temps libre pour la réalisation d’un projet. 

Préparation de vidéoconférence depuis différents systèmes (téléphone Cisco, Bridge…).',
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 186,
            ),
            192 => 
            array (
                'admin_id' => 278,
                'beginDate' => '2017-02-01 00:00:00',
                'companies_id' => 38,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2017-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 299,
                'intern_id' => 267,
                'internshipDescription' => 'Réalisation ou participation à l\'un ou l\'autre des projets suivants:
Mission 1
Improve Visualization of Big Data based on access flows to buildings. Typical profile: 2D/3D design on Web Objects. Database querying.
Mission 2
Evaluate and implement a monitoring solution in a complex environment. Typical Profile: Developer Profile / Network Profile.
Mission 3
The Project shall consist in designing a multi-automated scanner manager. In particular, finalize the network scanning part, implement the web application scanning part, the recommendation part and link that to a GUI.
Mission 4
The Project shall consist in designing dynamical dashboard viewer to be linked with a TV, running on a RaspBerry Pi.
Mission 5
Develop a frontend web application that helps manage / handle a massive portscanning framework performing multiple worldwide scans per day.
Mission 6
Develop a tool in C/C++ on Windows or Linux, preferably based on QEMU, to allow the emulation of a specific type of ARM controller with S-ATA interface. Typical profile: C/C+ / embedded devices.
Develop a web application based on the Yii 2 framework (mandatory) according to an already existing specification.',
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 158,
            ),
            193 => 
            array (
                'admin_id' => 273,
                'beginDate' => '2017-02-01 00:00:00',
                'companies_id' => 94,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2017-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 300,
                'intern_id' => 241,
                'internshipDescription' => 'Développement Web et Mobile. Le stagiaire est intégré à une équipe de projet de 3 à 6 personnes.',
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 273,
            ),
            194 => 
            array (
                'admin_id' => 62,
                'beginDate' => '2017-09-01 00:00:00',
                'companies_id' => 35,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2018-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 303,
                'intern_id' => 256,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 269,
                'responsible_id' => 62,
            ),
            195 => 
            array (
                'admin_id' => 279,
                'beginDate' => '2017-02-01 00:00:00',
                'companies_id' => 97,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2017-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 304,
                'intern_id' => 247,
                'internshipDescription' => 'Réalisation de sites vitrines. Le stagiaire se perfectionnera et maîtrisera dans les langages du web comme HTML5, Javascript, JQuery, CSS3, Bootstrap. Il sera également amené connaître la partie technique du référencement/SEO, les aspects responsives d’un site. Il sera en contact avec le client par email.',
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 279,
            ),
            196 => 
            array (
                'admin_id' => 161,
                'beginDate' => '2017-02-01 00:00:00',
                'companies_id' => 75,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2017-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 305,
                'intern_id' => 269,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 284,
            ),
            197 => 
            array (
                'admin_id' => 190,
                'beginDate' => '2017-02-01 00:00:00',
                'companies_id' => 42,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2017-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 306,
                'intern_id' => 261,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 132,
                'responsible_id' => 280,
            ),
            198 => 
            array (
                'admin_id' => 286,
                'beginDate' => '2017-09-01 00:00:00',
                'companies_id' => 98,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2018-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 307,
                'intern_id' => 270,
                'internshipDescription' => 'Les domaines dans lesquels le stagiaire pourrait exercer ses compétences seraient les suivants:
- dépannage en atelier et à distance pour des problèmes software (en principe non-professionnels) pour des ordinateurs why! sous GNU/Linux et divers périphériques compatibles
- participation au support en ligne proposé sur www.swisslinux.org pour les ordinateurs why!
- assemblage, flashage de BIOS, élaboration et installation de builds Ubuntu, réparations hardware sur des portables et desktops why!
- participation au déploiement et au développement de l\'ERP Odoo 9 (python) pour les besoins propres de why! et probablement de tiers (en particulier La Bonne Combine)
- développement de sites web (Typo3, Wordpress, Prestashop) pour des clients tiers
- déploiement et infogérance de systèmes informatiques pour les écoles à l\'aide du système open source Puavo (1er projet sur le point de démarrer dans une école privée vaudoise)
- contribution pour le support et le SAV du Fairphone 2 (sous Android, peut-être bientôt Ubuntu Touch)
- autres projets en lien avec les perspectives offertes par l\'open hardware.',
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 296,
            ),
            199 => 
            array (
                'admin_id' => 62,
                'beginDate' => '2017-09-01 00:00:00',
                'companies_id' => 35,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2018-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 309,
                'intern_id' => 261,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 270,
                'responsible_id' => 62,
            ),
            200 => 
            array (
                'admin_id' => 50,
                'beginDate' => '2017-09-01 00:00:00',
                'companies_id' => 44,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2018-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 310,
                'intern_id' => 244,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 294,
                'responsible_id' => 82,
            ),
            201 => 
            array (
                'admin_id' => 237,
                'beginDate' => '2017-09-01 00:00:00',
                'companies_id' => 43,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2018-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 311,
                'intern_id' => 250,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 279,
                'responsible_id' => 44,
            ),
            202 => 
            array (
                'admin_id' => 189,
                'beginDate' => '2017-09-01 00:00:00',
                'companies_id' => 86,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2018-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 312,
                'intern_id' => 242,
            'internshipDescription' => 'Développement PhP (Framework Yii), javascript, html, éventuellement GUI (QtCreator). Linux est un plus. Maintenance de postes clients',
                'parent_id' => NULL,
                'previous_id' => 283,
                'responsible_id' => 189,
            ),
            203 => 
            array (
                'admin_id' => 231,
                'beginDate' => '2017-09-01 00:00:00',
                'companies_id' => 29,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2018-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 313,
                'intern_id' => 249,
                'internshipDescription' => 'Travail varié: support, installation, dépannage, projets individuels.<br>Très peu d\'encadrement!',
                'parent_id' => NULL,
                'previous_id' => 282,
                'responsible_id' => 224,
            ),
            204 => 
            array (
                'admin_id' => 163,
                'beginDate' => '2017-09-01 00:00:00',
                'companies_id' => 38,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2018-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 315,
                'intern_id' => 248,
            'internshipDescription' => 'Your mission within the Content & Access Security (CAS) Product Unit will be to streamline the secure device and system ordering processes through the implementation of efficient, simple and robust workflows. 

This job requires autonomous and result oriented skills in a dynamic and “AGILE” work environment where initiative and innovation are encouraged 

Mission

•	Analyse CAS ordering processes and help on the finalization of the architecture
•	Participate to the design of operational workflows and external systems connectivity
•	Implement the ordering workflows based on internal guidelines & best practices
•	Implement web services & data connection with external systems and user management
•	Implement intelligent web forms
•	Work in collaboration with R&D departments, IT support teams and technical experts
•	Take part in the related project as a key project member

Key responsibilities

•	Workflow implementation & specification of the test strategy
•	Define reusable sub process part
•	Documentation and training material generation
•	Reports on a weekly basis to the project manager and take part in the Project core team meetings (stand-up meetings, planning meetings, demo)
•	Reports to the Process Management team & Industrialization Team leader

Education and experience

•	Software development knowledge
•	Microsoft tools and web services development would be a plus
•	Great interest to learn and work on new technologies
•	Fluent in French and English is a plus
',
                'parent_id' => NULL,
                'previous_id' => 299,
                'responsible_id' => 285,
            ),
            205 => 
            array (
                'admin_id' => 278,
                'beginDate' => '2017-09-01 00:00:00',
                'companies_id' => 99,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2018-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 317,
                'intern_id' => 267,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 317,
                'responsible_id' => 158,
            ),
            206 => 
            array (
                'admin_id' => 146,
                'beginDate' => '2017-09-01 00:00:00',
                'companies_id' => 70,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2018-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 319,
                'intern_id' => 257,
            'internshipDescription' => 'En fonction du stagiaire, développement PHP, gestion réseau (cisco), paramétrages réseaux / wifi / … chez des clients finaux.
Support aux utilisateurs interne. Administration Linux.
Cela n’est pas figé et cela peut évoluer en fonction des affinités des stagiaires.',
                'parent_id' => NULL,
                'previous_id' => 288,
                'responsible_id' => 146,
            ),
            207 => 
            array (
                'admin_id' => 232,
                'beginDate' => '2017-09-01 00:00:00',
                'companies_id' => 28,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2018-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 320,
                'intern_id' => 254,
                'internshipDescription' => 'Environnement MAC.
Demandent des stagiaires curieux et désireux d\'apprendre!',
                'parent_id' => NULL,
                'previous_id' => 285,
                'responsible_id' => 57,
            ),
            208 => 
            array (
                'admin_id' => 169,
                'beginDate' => '2017-09-01 00:00:00',
                'companies_id' => 37,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2018-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 322,
                'intern_id' => 245,
                'internshipDescription' => 'Support Helpdesk dans un environnement international, Support de deuxième niveau, Préparation des postes de travail, Coordination et répartition des requêtes des utilisateurs, Installation de logiciels et imprimantes, Gestion des commandes, Gestion des retours de marchandise, Gestion des iPads et Gestion du bon fonctionnement des salles d’étude.',
                'parent_id' => NULL,
                'previous_id' => 277,
                'responsible_id' => 191,
            ),
            209 => 
            array (
                'admin_id' => 169,
                'beginDate' => '2017-09-01 00:00:00',
                'companies_id' => 37,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2018-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 323,
                'intern_id' => 260,
                'internshipDescription' => 'Support Helpdesk dans un environnement international, Support de deuxième niveau, Préparation des postes de travail, Coordination et répartition des requêtes des utilisateurs, Installation de logiciels et imprimantes, Gestion des commandes, Gestion des retours de marchandise, Gestion des iPads et Gestion du bon fonctionnement des salles d’étude.',
                'parent_id' => NULL,
                'previous_id' => 276,
                'responsible_id' => 191,
            ),
            210 => 
            array (
                'admin_id' => 294,
                'beginDate' => '2017-09-01 00:00:00',
                'companies_id' => 41,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2018-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 324,
                'intern_id' => 253,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 268,
                'responsible_id' => 47,
            ),
            211 => 
            array (
                'admin_id' => 161,
                'beginDate' => '2017-09-01 00:00:00',
                'companies_id' => 75,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2018-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 325,
                'intern_id' => 269,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 305,
                'responsible_id' => 284,
            ),
            212 => 
            array (
                'admin_id' => 160,
                'beginDate' => '2017-09-01 00:00:00',
                'companies_id' => 74,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2018-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 327,
                'intern_id' => 262,
                'internshipDescription' => 'Entreprise spécialisée dans la création et l\'installation de réseaux informatiques sans fil.
Beaucoup d\'interventions chez le client pour installer, dépanner, améliorer le réseau dans des entreprises, hôtels ou même chez des particuliers.',
                'parent_id' => NULL,
                'previous_id' => 281,
                'responsible_id' => 159,
            ),
            213 => 
            array (
                'admin_id' => 79,
                'beginDate' => '2017-09-01 00:00:00',
                'companies_id' => 33,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2018-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 328,
                'intern_id' => 265,
                'internshipDescription' => 'Support, installation, dépannage, projets individuels',
                'parent_id' => NULL,
                'previous_id' => 287,
                'responsible_id' => 79,
            ),
            214 => 
            array (
                'admin_id' => 234,
                'beginDate' => '2017-09-01 00:00:00',
                'companies_id' => 47,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 14,
                'endDate' => '2018-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 329,
                'intern_id' => 243,
                'internshipDescription' => 'Support, installation, dépannage',
                'parent_id' => NULL,
                'previous_id' => 275,
                'responsible_id' => 234,
            ),
            215 => 
            array (
                'admin_id' => 186,
                'beginDate' => '2017-09-01 00:00:00',
                'companies_id' => 39,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2018-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 331,
                'intern_id' => 259,
                'internshipDescription' => 'Support de 1er et 2ème niveau

Déploiement et support informatique sous différents environnements (Windows , iOS, Android, etc.). 

Contact téléphonique avec les fournisseurs.

Utilisation d’un système de ticketing afin de répertorier les différents incidents.

Contact direct avec les collaborateurs et résolutions de problème depuis le bureau d’accueil (Welcome Desk).

Intervention sur site pour le support informatique ou les remplacements de matériel.

Possibilité d’avoir du temps libre pour la réalisation d’un projet. 

Préparation de vidéoconférence depuis différents systèmes (téléphone Cisco, Bridge…).',
                'parent_id' => NULL,
                'previous_id' => 298,
                'responsible_id' => 186,
            ),
            216 => 
            array (
                'admin_id' => 190,
                'beginDate' => '2017-09-01 00:00:00',
                'companies_id' => 42,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2018-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 332,
                'intern_id' => 247,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 306,
                'responsible_id' => 280,
            ),
            217 => 
            array (
                'admin_id' => 237,
                'beginDate' => '2017-09-01 00:00:00',
                'companies_id' => 43,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2018-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 333,
                'intern_id' => 218,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 280,
                'responsible_id' => 44,
            ),
            218 => 
            array (
                'admin_id' => 85,
                'beginDate' => '2017-09-01 00:00:00',
                'companies_id' => 40,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2018-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 334,
                'intern_id' => 263,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 289,
                'responsible_id' => 58,
            ),
            219 => 
            array (
                'admin_id' => 271,
                'beginDate' => '2017-09-01 00:00:00',
                'companies_id' => 104,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2018-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 335,
                'intern_id' => 268,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 274,
                'responsible_id' => 321,
            ),
            220 => 
            array (
                'admin_id' => 288,
                'beginDate' => '2017-09-01 00:00:00',
                'companies_id' => 101,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2018-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 337,
                'intern_id' => 266,
                'internshipDescription' => 'Nous recherchons un étudiant passionnée par le web et les CMS pour compléter notre équipe lors de votre stage.
Vos principales tâches seront les suivantes :
- Développement de thèmes responsive Wordpress
- Développement de fonctionnalités Wordpress

Vous aurez l’occasion de travailler avec les technologies suivantes :
- HTML 5
- CSS / SCSS 
- Javascript / Jquery
- Wordpress

Nous offrons un cadre de travail dynamique au sein de l’EPFL Innovation Park à Lausanne (5 minutes en métro de la gare de Renens) avec café offert.

Notre équipe sera là pour vous former sur Wordpress et répondre à vos questions durant le stage.
',
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 288,
            ),
            221 => 
            array (
                'admin_id' => 289,
                'beginDate' => '2017-09-01 00:00:00',
                'companies_id' => 102,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2018-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 338,
                'intern_id' => 241,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 289,
            ),
            222 => 
            array (
                'admin_id' => 290,
                'beginDate' => '2017-09-01 00:00:00',
                'companies_id' => 103,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2018-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 339,
                'intern_id' => 255,
                'internshipDescription' => 'Nous sommes une société active dans les domaines de l\'informatique et la télécommunication.

Compétences recherchées:

- Connaissance langages informatiques parmi : PHP, JAVA, JAVASCRIPT, Asp.net, CSS, Flash, Laravel, Symfony 2,
- Connaissance OS : Linux/Windows,
- Connaissance de bases de données : SQL, MYSQL (Design/Développement/Administration),
- Capacité à travailler en équipe et en autonomie

Profil :

- Disponible, polyvalent(e), débrouille, autonome et sociable (facilité de contact),
- Aisance relationnelle,
- Goût prononcé pour les challenges,
- Autonomie, Persévérance et détermination,
- Langue : français & Anglais (Technique)

Attitude :
- Vous recherchez la performance dans votre travail,
- Vous avez la culture du résultat et la réussite,
- Vous avez un tempérament de conquérant.
',
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 290,
            ),
            223 => 
            array (
                'admin_id' => 163,
                'beginDate' => '2017-09-01 00:00:00',
                'companies_id' => 38,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2018-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 340,
                'intern_id' => 258,
            'internshipDescription' => 'Le stagiaire sera pleinement intégré à l’équipe réseau de Nagra à Cheseaux dans un environnement international en mutation avec en point de mire le développement de service Cloud , l’automatisation et la virtualisation des fonction réseau (NFV).

Il s’occupera :
·        Du traitement des requêtes (Principalement des demandes d’ouverture d’accès sur nos firewalls, de création de VPN et de patch) et des incidents.  
·        Dev la mise à jour de notre documentation opérationnelle en relation avec les incidents et requêtes traités.
·        Du soutien de nos ingénieur dans la mise en place de nouvelles infrastructures. En particulier la mise à jour des équipements, leur installation dans les centres de calcul et leur configuration de base.
·        De la gestion de petits projets encore à définir en fonction du profil du stagiaire. Dans le passé ces projets ont été par exemple la mise en œuvre d’une solution de gestion des IP, le développement d’une solution de gestion des stocks de petit matériel, La simulation de notre réseau.

Le stagiaire recevra dans l’équipe :
·        une formation technique de base sur notre environnement réseaux et son implémentation spécifique à Cheseaux, les firewall Palo Atlo et les équipements Cisco (Switch, routeurs, Points d’accès et contrôler Wifi, ASA, Prime, ISE ).
·        Une formation à de base sur la gouvernance informatique et la gestion d’incidents et de requêtes avec l’outils Easy Vista.',
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 285,
            ),
            224 => 
            array (
                'admin_id' => 293,
                'beginDate' => '2017-09-01 00:00:00',
                'companies_id' => 83,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2018-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 343,
                'intern_id' => 252,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 325,
            ),
            225 => 
            array (
                'admin_id' => 145,
                'beginDate' => '2017-09-01 00:00:00',
                'companies_id' => 31,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2018-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 344,
                'intern_id' => 264,
            'internshipDescription' => 'Entre autre: le site de l\'école est à refaire complètement en y ajoutant les informations concernant le système qualité (accès - documents - etc...)',
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 145,
            ),
            226 => 
            array (
                'admin_id' => 182,
                'beginDate' => '2017-09-01 00:00:00',
                'companies_id' => 26,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2018-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 345,
                'intern_id' => 251,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 78,
            ),
            227 => 
            array (
                'admin_id' => 85,
                'beginDate' => '2017-09-27 00:00:00',
                'companies_id' => 40,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2018-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 346,
                'intern_id' => 211,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 289,
                'responsible_id' => 297,
            ),
            228 => 
            array (
                'admin_id' => 62,
                'beginDate' => '2018-02-01 00:00:00',
                'companies_id' => 35,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2018-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 348,
                'intern_id' => 313,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 303,
                'responsible_id' => 148,
            ),
            229 => 
            array (
                'admin_id' => 62,
                'beginDate' => '2018-02-01 00:00:00',
                'companies_id' => 35,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2018-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 350,
                'intern_id' => 298,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 309,
                'responsible_id' => 62,
            ),
            230 => 
            array (
                'admin_id' => 237,
                'beginDate' => '2018-02-01 00:00:00',
                'companies_id' => 43,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2018-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 352,
                'intern_id' => 301,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 311,
                'responsible_id' => 44,
            ),
            231 => 
            array (
                'admin_id' => 189,
                'beginDate' => '2018-02-01 00:00:00',
                'companies_id' => 86,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 14,
                'endDate' => '2018-04-30 00:00:00',
                'grossSalary' => 1230,
                'id' => 353,
                'intern_id' => 306,
            'internshipDescription' => 'Développement PhP (Framework Yii), javascript, html, éventuellement GUI (QtCreator). Linux est un plus. Maintenance de postes clients

Une prime peut être ajoutée au dernier salaire en fonction de la performance (entre 500.- et 1500.-)',
                'parent_id' => NULL,
                'previous_id' => 312,
                'responsible_id' => 189,
            ),
            232 => 
            array (
                'admin_id' => 231,
                'beginDate' => '2018-02-01 00:00:00',
                'companies_id' => 29,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2018-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 354,
                'intern_id' => 310,
                'internshipDescription' => 'Travail varié: support, installation, dépannage, projets individuels.<br>Très peu d\'encadrement!',
                'parent_id' => NULL,
                'previous_id' => 313,
                'responsible_id' => 224,
            ),
            233 => 
            array (
                'admin_id' => 164,
                'beginDate' => '2018-02-01 00:00:00',
                'companies_id' => 38,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2018-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 355,
                'intern_id' => 302,
            'internshipDescription' => 'Your mission within the Content & Access Security (CAS) Product Unit will be to streamline the secure device and system ordering processes through the implementation of efficient, simple and robust workflows. 

This job requires autonomous and result oriented skills in a dynamic and “AGILE” work environment where initiative and innovation are encouraged 

Mission

•	Analyse CAS ordering processes and help on the finalization of the architecture
•	Participate to the design of operational workflows and external systems connectivity
•	Implement the ordering workflows based on internal guidelines & best practices
•	Implement web services & data connection with external systems and user management
•	Implement intelligent web forms
•	Work in collaboration with R&D departments, IT support teams and technical experts
•	Take part in the related project as a key project member

Key responsibilities

•	Workflow implementation & specification of the test strategy
•	Define reusable sub process part
•	Documentation and training material generation
•	Reports on a weekly basis to the project manager and take part in the Project core team meetings (stand-up meetings, planning meetings, demo)
•	Reports to the Process Management team & Industrialization Team leader

Education and experience

•	Software development knowledge
•	Microsoft tools and web services development would be a plus
•	Great interest to learn and work on new technologies
•	Fluent in French and English is a plus
',
                'parent_id' => NULL,
                'previous_id' => 315,
                'responsible_id' => 285,
            ),
            234 => 
            array (
                'admin_id' => 278,
                'beginDate' => '2018-02-01 00:00:00',
                'companies_id' => 99,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2018-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 356,
                'intern_id' => 309,
                'internshipDescription' => 'Réalisation ou participation à l\'un ou l\'autre des projets suivants:
Mission 1
Improve Visualization of Big Data based on access flows to buildings. Typical profile: 2D/3D design on Web Objects. Database querying.
Mission 2
Evaluate and implement a monitoring solution in a complex environment. Typical Profile: Developer Profile / Network Profile.
Mission 3
The Project shall consist in designing a multi-automated scanner manager. In particular, finalize the network scanning part, implement the web application scanning part, the recommendation part and link that to a GUI.
Mission 4
The Project shall consist in designing dynamical dashboard viewer to be linked with a TV, running on a RaspBerry Pi.
Mission 5
Develop a frontend web application that helps manage / handle a massive portscanning framework performing multiple worldwide scans per day.
Mission 6
Develop a tool in C/C++ on Windows or Linux, preferably based on QEMU, to allow the emulation of a specific type of ARM controller with S-ATA interface. Typical profile: C/C+ / embedded devices.
Develop a web application based on the Yii 2 framework (mandatory) according to an already existing specification.',
                'parent_id' => NULL,
                'previous_id' => 317,
                'responsible_id' => 158,
            ),
            235 => 
            array (
                'admin_id' => 232,
                'beginDate' => '2018-02-01 00:00:00',
                'companies_id' => 28,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2018-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 358,
                'intern_id' => 307,
                'internshipDescription' => 'Environnement MAC.
Demandent des stagiaires curieux et désireux d\'apprendre!',
                'parent_id' => NULL,
                'previous_id' => 320,
                'responsible_id' => 57,
            ),
            236 => 
            array (
                'admin_id' => 169,
                'beginDate' => '2018-02-01 00:00:00',
                'companies_id' => 37,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2018-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 359,
                'intern_id' => 314,
                'internshipDescription' => 'Support Helpdesk dans un environnement international, Support de deuxième niveau, Préparation des postes de travail, Coordination et répartition des requêtes des utilisateurs, Installation de logiciels et imprimantes, Gestion des commandes, Gestion des retours de marchandise, Gestion des iPads et Gestion du bon fonctionnement des salles d’étude.

En plus du salaire, les repas de midi ainsi que l\'accès à une salle de fitness sont offerts au stagiaire.',
                'parent_id' => NULL,
                'previous_id' => 322,
                'responsible_id' => 191,
            ),
            237 => 
            array (
                'admin_id' => 169,
                'beginDate' => '2018-02-01 00:00:00',
                'companies_id' => 37,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2018-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 360,
                'intern_id' => 312,
                'internshipDescription' => 'Support Helpdesk dans un environnement international, Support de deuxième niveau, Préparation des postes de travail, Coordination et répartition des requêtes des utilisateurs, Installation de logiciels et imprimantes, Gestion des commandes, Gestion des retours de marchandise, Gestion des iPads et Gestion du bon fonctionnement des salles d’étude.

En plus du salaire, les repas de midi ainsi que l\'accès à une salle de fitness sont offerts au stagiaire.',
                'parent_id' => 359,
                'previous_id' => 323,
                'responsible_id' => 191,
            ),
            238 => 
            array (
                'admin_id' => 294,
                'beginDate' => '2018-02-01 00:00:00',
                'companies_id' => 41,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2018-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 361,
                'intern_id' => 304,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 324,
                'responsible_id' => 47,
            ),
            239 => 
            array (
                'admin_id' => 79,
                'beginDate' => '2018-02-01 00:00:00',
                'companies_id' => 33,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2018-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 364,
                'intern_id' => 318,
                'internshipDescription' => 'Support, installation, dépannage, projets individuels',
                'parent_id' => NULL,
                'previous_id' => 328,
                'responsible_id' => 79,
            ),
            240 => 
            array (
                'admin_id' => 234,
                'beginDate' => '2018-02-01 00:00:00',
                'companies_id' => 47,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2018-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 365,
                'intern_id' => 299,
                'internshipDescription' => 'Support, installation, dépannage',
                'parent_id' => NULL,
                'previous_id' => 329,
                'responsible_id' => 234,
            ),
            241 => 
            array (
                'admin_id' => 186,
                'beginDate' => '2018-02-01 00:00:00',
                'companies_id' => 39,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2018-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 366,
                'intern_id' => 303,
                'internshipDescription' => 'En tant que leader mondial dans le domaine des technologies médicales, Medtronic vous propose un stage dans une équipe informatique dynamique et passionnée. 
Votre mission sera de travailler et d’acquérir des compétences « IT » afin de gagner en autonomie dans un support informatique. 

Vous effectuerez des tâches variées telle que :
- Dépannage matériel et logiciel (1er et 2ème niveau)
- Déploiement et installation d’équipements divers (Desktop, Laptop, Smartphone, Tablet…)
- Suivi des demandes et pannes via notre outil de gestion des tickets
- Réalisation de divers projets pour notre équipe
Notre site hébergeant une des usines de production de technologies médicales vous aurez également la chance de pouvoir travailler en lien avec la production.
Tout au long de votre stage vos développerez les points suivants 
- Méthodologie de travail dans un environnement complexe
- Logique de dépannage matériel et logiciel
- Anglais oral et écrit. Un atout indispensable pour votre futur dans le monde de l’informatique.
Vos avantages seront les suivants : 
- Vous effectuerez les mêmes tâches que les membres de l’équipe IT
- Repas de midi offert à la cafétéria de l’entreprise dont 4 menus à choix proposés par nos chefs cuisiniers
- Matériel de support fourni que vous pouvez conserver à la fin de votre stage tel que : disque dur externe, Cyber Tools, baie d’extraction pour disque dur, trousse à outil de dépannage…
- Possibilité de voir votre salaire augmenté au mérite sous forme de « Cash Award » ',
                'parent_id' => NULL,
                'previous_id' => 331,
                'responsible_id' => 186,
            ),
            242 => 
            array (
                'admin_id' => 323,
                'beginDate' => '2018-02-01 00:00:00',
                'companies_id' => 42,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2018-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 367,
                'intern_id' => 315,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 332,
                'responsible_id' => 280,
            ),
            243 => 
            array (
                'admin_id' => 237,
                'beginDate' => '2018-02-01 00:00:00',
                'companies_id' => 43,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2018-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 368,
                'intern_id' => 300,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 333,
                'responsible_id' => 44,
            ),
            244 => 
            array (
                'admin_id' => 288,
                'beginDate' => '2018-02-01 00:00:00',
                'companies_id' => 102,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2018-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 371,
                'intern_id' => 311,
                'internshipDescription' => 'Nous recherchons un étudiant passionnée par le web et les CMS pour compléter notre équipe lors de votre stage.
Vos principales tâches seront les suivantes :
- Développement de thèmes responsive Wordpress
- Développement de fonctionnalités Wordpress

Vous aurez l’occasion de travailler avec les technologies suivantes :
- HTML 5
- CSS / SCSS 
- Javascript / Jquery
- Wordpress

Nous offrons un cadre de travail dynamique au sein de l’EPFL Innovation Park à Lausanne (5 minutes en métro de la gare de Renens) avec café offert.

Notre équipe sera là pour vous former sur Wordpress et répondre à vos questions durant le stage.
',
                'parent_id' => NULL,
                'previous_id' => 337,
                'responsible_id' => 288,
            ),
            245 => 
            array (
                'admin_id' => 164,
                'beginDate' => '2018-02-01 00:00:00',
                'companies_id' => 38,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2018-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 378,
                'intern_id' => 317,
            'internshipDescription' => 'Your mission within the Content & Access Security (CAS) Product Unit will be to streamline the secure device and system ordering processes through the implementation of efficient, simple and robust workflows. 

This job requires autonomous and result oriented skills in a dynamic and “AGILE” work environment where initiative and innovation are encouraged 

Mission

•	Analyse CAS ordering processes and help on the finalization of the architecture
•	Participate to the design of operational workflows and external systems connectivity
•	Implement the ordering workflows based on internal guidelines & best practices
•	Implement web services & data connection with external systems and user management
•	Implement intelligent web forms
•	Work in collaboration with R&D departments, IT support teams and technical experts
•	Take part in the related project as a key project member

Key responsibilities

•	Workflow implementation & specification of the test strategy
•	Define reusable sub process part
•	Documentation and training material generation
•	Reports on a weekly basis to the project manager and take part in the Project core team meetings (stand-up meetings, planning meetings, demo)
•	Reports to the Process Management team & Industrialization Team leader

Education and experience

•	Software development knowledge
•	Microsoft tools and web services development would be a plus
•	Great interest to learn and work on new technologies
•	Fluent in French and English is a plus',
                'parent_id' => NULL,
                'previous_id' => 340,
                'responsible_id' => 285,
            ),
            246 => 
            array (
                'admin_id' => 271,
                'beginDate' => '2018-02-01 00:00:00',
                'companies_id' => 104,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2018-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 379,
                'intern_id' => 320,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 335,
                'responsible_id' => 321,
            ),
            247 => 
            array (
                'admin_id' => 279,
                'beginDate' => '2018-02-01 00:00:00',
                'companies_id' => 97,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 14,
                'endDate' => '2018-04-30 00:00:00',
                'grossSalary' => 1230,
                'id' => 380,
                'intern_id' => 308,
                'internshipDescription' => 'Réalisation de sites vitrines. Le stagiaire se perfectionnera et maîtrisera dans les langages du web comme HTML5, Javascript, JQuery, CSS3, Bootstrap. Il sera également amené connaître la partie technique du référencement/SEO, les aspects responsives d’un site. Il sera en contact avec le client par email.',
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 279,
            ),
            248 => 
            array (
                'admin_id' => 327,
                'beginDate' => '2018-02-01 00:00:00',
                'companies_id' => 109,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2018-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 382,
                'intern_id' => 305,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 232,
                'responsible_id' => 331,
            ),
            249 => 
            array (
                'admin_id' => 50,
                'beginDate' => '2018-09-01 00:00:00',
                'companies_id' => 44,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 12,
                'endDate' => '2019-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 383,
                'intern_id' => 302,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 82,
            ),
            250 => 
            array (
                'admin_id' => 324,
                'beginDate' => '2018-09-01 00:00:00',
                'companies_id' => 105,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 1,
                'endDate' => '2019-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 384,
                'intern_id' => NULL,
            'internshipDescription' => 'Le stagiaire pourrait avoir des interactions avec l’ensemble des équipes du département du marché Suisse (Infrastructure, Applications, Business Intelligence,…) et pourrait notamment toucher aux activités suivantes :
·         Support applicatif niveau 0-1
·         Préparation des machines pour les nouveaux arrivants
·         Gestion des assets IT
·         Participer au projet de migration vers Windows 10
·         Participer aux Market Acceptance Tests dans le cadre de releases ou lancements de nouvelles fonctionnalités

Et plus selon l’intérêt et les capacités.',
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 324,
            ),
            251 => 
            array (
                'admin_id' => 278,
                'beginDate' => '2018-02-01 00:00:00',
                'companies_id' => 99,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2018-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 385,
                'intern_id' => 319,
                'internshipDescription' => 'Réalisation ou participation à l\'un ou l\'autre des projets suivants:
Mission 1
Improve Visualization of Big Data based on access flows to buildings. Typical profile: 2D/3D design on Web Objects. Database querying.
Mission 2
Evaluate and implement a monitoring solution in a complex environment. Typical Profile: Developer Profile / Network Profile.
Mission 3
The Project shall consist in designing a multi-automated scanner manager. In particular, finalize the network scanning part, implement the web application scanning part, the recommendation part and link that to a GUI.
Mission 4
The Project shall consist in designing dynamical dashboard viewer to be linked with a TV, running on a RaspBerry Pi.
Mission 5
Develop a frontend web application that helps manage / handle a massive portscanning framework performing multiple worldwide scans per day.
Mission 6
Develop a tool in C/C++ on Windows or Linux, preferably based on QEMU, to allow the emulation of a specific type of ARM controller with S-ATA interface. Typical profile: C/C+ / embedded devices.
Develop a web application based on the Yii 2 framework (mandatory) according to an already existing specification.',
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 158,
            ),
            252 => 
            array (
                'admin_id' => 60,
                'beginDate' => '2018-02-01 00:00:00',
                'companies_id' => 30,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2018-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 387,
                'intern_id' => 316,
                'internshipDescription' => 'Le stagiaire a le rôle de technicien niveau 1, derrière un guichet ouvert non-stop de 10h à 17h du lundi
au vendredi, il répond directement aux utilisateurs.
Le helpdesk dispose de beaucoup de modèles de portables différents. Ceci permet de faire des
diagnostics de pannes matériels très poussés en croisant des pièces entre nos machines et celles de
nos utilisateurs.
Du stresstest en passant par les outils de diagnostics des fabricants aux outils open-sources ainsi que
diverses distributions GNU/Linux de dépannage, nous avons les moyens de venir à bout de toutes les
pannes.
Trois postes de récupération de données sont régulièrement en fonction. Ils servent à cloner les disques
durs devenu illisibles et des outils spécialisés s’occupent de récupérer un maximum de données
précieuses. La ligne de commande GNU/Linux est un allié précieux dans cette tâche.
Il est possible de suivre un/des cours offert par le sfp durant le stage',
                'parent_id' => NULL,
                'previous_id' => 263,
                'responsible_id' => 156,
            ),
            253 => 
            array (
                'admin_id' => 330,
                'beginDate' => '2018-09-01 00:00:00',
                'companies_id' => 110,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 12,
                'endDate' => '2019-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 388,
                'intern_id' => 299,
            'internshipDescription' => 'Le Gymnase de Renens se constitue de deux sites distincts. L’un à Provence (Lausanne) et l’autre à Renens. Les deux sites accueilleront ensemble dès août 2017 plus de 2000 élèves, 170 maîtres ainsi qu’une vingtaine de collaborateurs administratifs, faisant de lui le plus grand Gymnase vaudois. 
Le stagiaire effectuera les tâches suivantes :
·        Résoudre les problèmes intervenant dans les salles de cours
·        Aider les utilisateurs à l’utilisation du matériel mis à disposition
·        Aider les utilisateurs à l’utilisation des logiciels (basiques) ainsi que de l’OS mis à disposition
·        Développement de solutions WEB utilisées en interne (optionnel)
·        Maintenance logicielle et matérielle du site
·        Création et gestion des comptes AD',
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 329,
            ),
            254 => 
            array (
                'admin_id' => 178,
                'beginDate' => '2018-09-01 00:00:00',
                'companies_id' => 80,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 12,
                'endDate' => '2019-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 389,
                'intern_id' => 319,
                'internshipDescription' => 'Activités principales, en collaboration avec le responsable de chaque service :
--- CMS --- 
o	Participer à l\'évolution du CMS, des bases de données et des serveurs web
--- Réseaux --- 
o	Comprendre, connaître et faire évoluer l\'infrastructure des réseaux de manière à assurer qualité de service et sécurité.
--- Serveurs --- 
o	Comprendre, connaître et faire évoluer l\'infrastructure serveurs de manière à assurer fiabilité, efficience pour les services.
--- Postes clients --- 
o	Maintenir et réaliser les mises à jour des postes de travail
o	Maintenir et faire évoluer les images systèmes
o	Support 2ème niveau (OS, applications)
o	Suivi de l’inventaire
--- Support aux utilisateurs-trices --- 
o	Assurer le service du Help Desk
o	Assurer des tâches techniques du service informatique
o	Gestion du matériel en prêt (vidéo, ordinateurs)
o	Maintenance et création de mode d’emploi
--- Réalisation de projets individuels dans les domaines cités ci-dessous (exemples) --- 
o	Mise en place d\'un serveur de streaming vidéo
o	Virtualisation (environnement RHEV)
o	Evaluation et comparaison de logiciels
o	Gouvernance, construction d’indicateurs 

Activités annexes :
•	Maintenir et améliorer ses compétences par une formation continue
•	Maintenir et mettre à jour la documentation du SIM
•	Veille technologique
Relations internes / externes au service :
•	Participer aux réunions hebdomadaires du SIM et à d’autres séances de travail internes.
',
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 332,
            ),
            255 => 
            array (
                'admin_id' => 62,
                'beginDate' => '2018-09-01 00:00:00',
                'companies_id' => 35,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 9,
                'endDate' => '2019-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 390,
                'intern_id' => 311,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 348,
                'responsible_id' => 148,
            ),
            256 => 
            array (
                'admin_id' => 62,
                'beginDate' => '2018-09-01 00:00:00',
                'companies_id' => 35,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 12,
                'endDate' => '2019-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 391,
                'intern_id' => 304,
                'internshipDescription' => '',
                'parent_id' => 391,
                'previous_id' => 350,
                'responsible_id' => 62,
            ),
            257 => 
            array (
                'admin_id' => 237,
                'beginDate' => '2018-09-01 00:00:00',
                'companies_id' => 43,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 12,
                'endDate' => '2019-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 392,
                'intern_id' => 298,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 352,
                'responsible_id' => 44,
            ),
            258 => 
            array (
                'admin_id' => 232,
                'beginDate' => '2018-09-01 00:00:00',
                'companies_id' => 28,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 12,
                'endDate' => '2019-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 395,
                'intern_id' => 310,
                'internshipDescription' => 'Le stagiaire a le rôle de technicien niveau 1 au Service desk.
Il est directement sous la responsabilité du Manager du Service desk.
Le guichet du Service desk est ouvert de 10h à 12h et de 13h30 à 15h30.
Le stagiaire est au contact des utilisateurs et leur répond directement en fonction des compétences qu’il va acquérir tout au long de son stage.
L’ECAL possède un environnement informatique principalement lié à Mac OS X. Le stagiaire aura donc l’occasion d’acquérir des compétences avancées au sujet de ce système d’exploitation.
Le stagiaire a la possibilité de réaliser durant son stage un projet lié à l’informatique ou à un des métiers enseignés à l’ECAL.',
                'parent_id' => NULL,
                'previous_id' => 358,
                'responsible_id' => 57,
            ),
            259 => 
            array (
                'admin_id' => 169,
                'beginDate' => '2018-09-01 00:00:00',
                'companies_id' => 37,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 12,
                'endDate' => '2019-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 396,
                'intern_id' => 306,
                'internshipDescription' => 'Support Helpdesk dans un environnement international. Activités très variées:
- Support de deuxième niveau
- Préparation des postes de travail
- Coordination et répartition des requêtes des utilisateurs
- Installation de logiciels et imprimantes
- Gestion des commandes
- Gestion des retours de marchandise
- Gestion des iPads
- Gestion du bon fonctionnement des salles d’étude.
- Participation à l’installation de matériel audiovisuel (caméra, micro, écran, etc.).
- Préparation et installation de matériel pour Webinar
- Participation au support audiovisuel dans des auditoires

En plus du salaire, les repas de midi ainsi que l\'accès à une salle de fitness sont offerts au stagiaire.',
                'parent_id' => 397,
                'previous_id' => 359,
                'responsible_id' => 191,
            ),
            260 => 
            array (
                'admin_id' => 169,
                'beginDate' => '2018-09-01 00:00:00',
                'companies_id' => 37,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 12,
                'endDate' => '2019-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 397,
                'intern_id' => 309,
                'internshipDescription' => 'Support Helpdesk dans un environnement international, Support de deuxième niveau, Préparation des postes de travail, Coordination et répartition des requêtes des utilisateurs, Installation de logiciels et imprimantes, Gestion des commandes, Gestion des retours de marchandise, Gestion des iPads et Gestion du bon fonctionnement des salles d’étude.

En plus du salaire, les repas de midi ainsi que l\'accès à une salle de fitness sont offerts au stagiaire.',
                'parent_id' => NULL,
                'previous_id' => 360,
                'responsible_id' => 191,
            ),
            261 => 
            array (
                'admin_id' => 294,
                'beginDate' => '2018-09-01 00:00:00',
                'companies_id' => 41,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 12,
                'endDate' => '2019-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 398,
                'intern_id' => 313,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 361,
                'responsible_id' => 47,
            ),
            262 => 
            array (
                'admin_id' => 79,
                'beginDate' => '2018-09-01 00:00:00',
                'companies_id' => 33,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 12,
                'endDate' => '2019-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 399,
                'intern_id' => 301,
                'internshipDescription' => 'Support, installation, dépannage, projets individuels',
                'parent_id' => NULL,
                'previous_id' => 364,
                'responsible_id' => 79,
            ),
            263 => 
            array (
                'admin_id' => 234,
                'beginDate' => '2018-09-01 00:00:00',
                'companies_id' => 47,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 12,
                'endDate' => '2019-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 400,
                'intern_id' => 314,
            'internshipDescription' => 'L’Université de Lausanne dispose d’un environnement hétérogène (MacOs et Windows). Le support informatique est prodigué aux chercheurs des différents départements de la Faculté de Biologie et de Médecine. Le stage comprend du support 1er et 2ème niveau (installation, dépannage logiciel et matériel) ainsi qu’un mini projet à discuter au début du stage en fonction des différents intérêts du stagiaire.',
                'parent_id' => NULL,
                'previous_id' => 365,
                'responsible_id' => 234,
            ),
            264 => 
            array (
                'admin_id' => 186,
                'beginDate' => '2018-09-01 00:00:00',
                'companies_id' => 39,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 12,
                'endDate' => '2019-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 401,
                'intern_id' => 316,
                'internshipDescription' => 'En tant que leader mondial dans le domaine des technologies médicales, Medtronic vous propose un stage dans une équipe informatique dynamique et passionnée. 
Votre mission sera de travailler et d’acquérir des compétences « IT » afin de gagner en autonomie dans un support informatique. 

Vous effectuerez des tâches variées telle que :
- Dépannage matériel et logiciel (1er et 2ème niveau)
- Déploiement et installation d’équipements divers (Desktop, Laptop, Smartphone, Tablet…)
- Suivi des demandes et pannes via notre outil de gestion des tickets
- Réalisation de divers projets pour notre équipe
Notre site hébergeant une des usines de production de technologies médicales vous aurez également la chance de pouvoir travailler en lien avec la production.
Tout au long de votre stage vos développerez les points suivants 
- Méthodologie de travail dans un environnement complexe
- Logique de dépannage matériel et logiciel
- Anglais oral et écrit. Un atout indispensable pour votre futur dans le monde de l’informatique.
Vos avantages seront les suivants : 
- Vous effectuerez les mêmes tâches que les membres de l’équipe IT
- Repas de midi offert à la cafétéria de l’entreprise dont 4 menus à choix proposés par nos chefs cuisiniers
- Matériel de support fourni que vous pouvez conserver à la fin de votre stage tel que : disque dur externe, Cyber Tools, baie d’extraction pour disque dur, trousse à outil de dépannage…
- Possibilité de voir votre salaire augmenté au mérite sous forme de « Cash Award » ',
                'parent_id' => NULL,
                'previous_id' => 366,
                'responsible_id' => 186,
            ),
            265 => 
            array (
                'admin_id' => 323,
                'beginDate' => '2018-09-01 00:00:00',
                'companies_id' => 42,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 12,
                'endDate' => '2019-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 402,
                'intern_id' => 315,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 367,
                'responsible_id' => 280,
            ),
            266 => 
            array (
                'admin_id' => 271,
                'beginDate' => '2018-09-01 00:00:00',
                'companies_id' => 104,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 12,
                'endDate' => '2019-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 405,
                'intern_id' => 320,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 379,
                'responsible_id' => 321,
            ),
            267 => 
            array (
                'admin_id' => 164,
                'beginDate' => '2018-09-01 00:00:00',
                'companies_id' => 38,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 12,
                'endDate' => '2019-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 407,
                'intern_id' => 303,
            'internshipDescription' => 'Your mission within the Content & Access Security (CAS) Product Unit will be to streamline the secure device and system ordering processes through the implementation of efficient, simple and robust workflows. 

This job requires autonomous and result oriented skills in a dynamic and “AGILE” work environment where initiative and innovation are encouraged 

Mission

•	Analyse CAS ordering processes and help on the finalization of the architecture
•	Participate to the design of operational workflows and external systems connectivity
•	Implement the ordering workflows based on internal guidelines & best practices
•	Implement web services & data connection with external systems and user management
•	Implement intelligent web forms
•	Work in collaboration with R&D departments, IT support teams and technical experts
•	Take part in the related project as a key project member

Key responsibilities

•	Workflow implementation & specification of the test strategy
•	Define reusable sub process part
•	Documentation and training material generation
•	Reports on a weekly basis to the project manager and take part in the Project core team meetings (stand-up meetings, planning meetings, demo)
•	Reports to the Process Management team & Industrialization Team leader

Education and experience

•	Software development knowledge
•	Microsoft tools and web services development would be a plus
•	Great interest to learn and work on new technologies
•	Fluent in French and English is a plus',
                'parent_id' => NULL,
                'previous_id' => 378,
                'responsible_id' => 285,
            ),
            268 => 
            array (
                'admin_id' => 286,
                'beginDate' => '2018-09-01 00:00:00',
                'companies_id' => 98,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 12,
                'endDate' => '2019-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 421,
                'intern_id' => 317,
                'internshipDescription' => 'Les domaines dans lesquels le stagiaire pourrait exercer ses compétences seraient les suivants:
- dépannage en atelier et à distance pour des problèmes software (en principe non-professionnels) pour des ordinateurs why! sous GNU/Linux et divers périphériques compatibles
- participation au support en ligne proposé sur www.swisslinux.org pour les ordinateurs why!
- assemblage, flashage de BIOS, élaboration et installation de builds Ubuntu, réparations hardware sur des portables et desktops why!
- participation au déploiement et au développement de l\'ERP Odoo 9 (python) pour les besoins propres de why! et probablement de tiers (en particulier La Bonne Combine)
- développement de sites web (Typo3, Wordpress, Prestashop) pour des clients tiers
- déploiement et infogérance de systèmes informatiques pour les écoles à l\'aide du système open source Puavo (1er projet sur le point de démarrer dans une école privée vaudoise)
- contribution pour le support et le SAV du Fairphone 2 (sous Android, peut-être bientôt Ubuntu Touch)
- autres projets en lien avec les perspectives offertes par l\'open hardware.',
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 296,
            ),
            269 => 
            array (
                'admin_id' => 279,
                'beginDate' => '2018-05-10 00:00:00',
                'companies_id' => 97,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 13,
                'endDate' => '2018-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 423,
                'intern_id' => 306,
                'internshipDescription' => 'Réalisation de sites vitrines. Le stagiaire se perfectionnera et maîtrisera dans les langages du web comme HTML5, Javascript, JQuery, CSS3, Bootstrap. Il sera également amené connaître la partie technique du référencement/SEO, les aspects responsives d’un site. Il sera en contact avec le client par email.',
                'parent_id' => NULL,
                'previous_id' => 380,
                'responsible_id' => 279,
            ),
            270 => 
            array (
                'admin_id' => 335,
                'beginDate' => '2018-07-01 00:00:00',
                'companies_id' => 112,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 9,
                'endDate' => '2019-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 424,
                'intern_id' => 308,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 335,
            ),
            271 => 
            array (
                'admin_id' => 164,
                'beginDate' => '2018-09-01 00:00:00',
                'companies_id' => 38,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 12,
                'endDate' => '2019-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 425,
                'intern_id' => 305,
            'internshipDescription' => 'Your mission within the Content & Access Security (CAS) Product Unit will be to streamline the secure device and system ordering processes through the implementation of efficient, simple and robust workflows. 

This job requires autonomous and result oriented skills in a dynamic and “AGILE” work environment where initiative and innovation are encouraged 

Mission

•	Analyse CAS ordering processes and help on the finalization of the architecture
•	Participate to the design of operational workflows and external systems connectivity
•	Implement the ordering workflows based on internal guidelines & best practices
•	Implement web services & data connection with external systems and user management
•	Implement intelligent web forms
•	Work in collaboration with R&D departments, IT support teams and technical experts
•	Take part in the related project as a key project member

Key responsibilities

•	Workflow implementation & specification of the test strategy
•	Define reusable sub process part
•	Documentation and training material generation
•	Reports on a weekly basis to the project manager and take part in the Project core team meetings (stand-up meetings, planning meetings, demo)
•	Reports to the Process Management team & Industrialization Team leader

Education and experience

•	Software development knowledge
•	Microsoft tools and web services development would be a plus
•	Great interest to learn and work on new technologies
•	Fluent in French and English is a plus',
                'parent_id' => NULL,
                'previous_id' => 355,
                'responsible_id' => 285,
            ),
            272 => 
            array (
                'admin_id' => 231,
                'beginDate' => '2018-09-01 00:00:00',
                'companies_id' => 29,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 8,
                'endDate' => '2019-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 427,
                'intern_id' => 312,
                'internshipDescription' => 'Travail varié: support, installation, dépannage, projets individuels.<br>Très peu d\'encadrement!',
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 224,
            ),
            273 => 
            array (
                'admin_id' => 164,
                'beginDate' => '2018-09-01 00:00:00',
                'companies_id' => 38,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 12,
                'endDate' => '2019-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 428,
                'intern_id' => 318,
                'internshipDescription' => 'Développement d\'outils au sein du groupe CAS PU - Trusted Platform',
                'parent_id' => NULL,
                'previous_id' => 228,
                'responsible_id' => 81,
            ),
            274 => 
            array (
                'admin_id' => 237,
                'beginDate' => '2018-09-01 00:00:00',
                'companies_id' => 43,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 8,
                'endDate' => '2019-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 429,
                'intern_id' => 307,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 44,
            ),
            275 => 
            array (
                'admin_id' => 339,
                'beginDate' => '2018-09-01 00:00:00',
                'companies_id' => 114,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 12,
                'endDate' => '2019-01-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 430,
                'intern_id' => 300,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 339,
            ),
            276 => 
            array (
                'admin_id' => 273,
                'beginDate' => '2019-02-01 00:00:00',
                'companies_id' => 94,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 6,
                'endDate' => '2019-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 431,
                'intern_id' => NULL,
                'internshipDescription' => 'Stage en développement web.
Activités:
- Développement backend, sur des projets d\'application web. Ce à l\'aide de frameworks, CMS ou LMS, tels DjangoCMS ou Moodle.
- Développement front-end mobile-first et responsive basé sur le standard HTML5.
- Travail en équipe auto-organisée, application de la méthodologie SCRUM ;
- Participation aux évenements et à la vie de l\'entreprise.

Objectifs:
- Le stagiaire a pu observer le déroulement d\'un projet d\'application web, de bout en bout ;
- Le stagiaire a atteint les objectifs techniques fixés au début du stage en collaboration avec Liip.

Compétences requises:
- Connaissances en programmation orientée objet
- Connaissances de tout ou partie des termes HTML, PHP, Python, CSS, Javascript, Moodle, Django, SSH, Git, ...
- Autonomie et capacité à travailler en équipe',
                'parent_id' => NULL,
                'previous_id' => 300,
                'responsible_id' => 273,
            ),
            277 => 
            array (
                'admin_id' => 362,
                'beginDate' => '2019-02-01 00:00:00',
                'companies_id' => 44,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 6,
                'endDate' => '2019-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 432,
                'intern_id' => NULL,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 383,
                'responsible_id' => 82,
            ),
            278 => 
            array (
                'admin_id' => 330,
                'beginDate' => '2019-02-01 00:00:00',
                'companies_id' => 110,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 6,
                'endDate' => '2019-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 433,
                'intern_id' => NULL,
            'internshipDescription' => 'Le Gymnase de Renens se constitue de deux sites distincts. L’un à Provence (Lausanne) et l’autre à Renens. Les deux sites accueilleront ensemble dès août 2017 plus de 2000 élèves, 170 maîtres ainsi qu’une vingtaine de collaborateurs administratifs, faisant de lui le plus grand Gymnase vaudois. 
Le stagiaire effectuera les tâches suivantes :
·        Résoudre les problèmes intervenant dans les salles de cours
·        Aider les utilisateurs à l’utilisation du matériel mis à disposition
·        Aider les utilisateurs à l’utilisation des logiciels (basiques) ainsi que de l’OS mis à disposition
·        Développement de solutions WEB utilisées en interne (optionnel)
·        Maintenance logicielle et matérielle du site
·        Création et gestion des comptes AD',
                'parent_id' => NULL,
                'previous_id' => 388,
                'responsible_id' => 329,
            ),
            279 => 
            array (
                'admin_id' => 178,
                'beginDate' => '2019-02-01 00:00:00',
                'companies_id' => 80,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 2,
                'endDate' => '2019-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 434,
                'intern_id' => NULL,
                'internshipDescription' => 'Activités principales, en collaboration avec le responsable de chaque service :
--- CMS --- 
o	Participer à l\'évolution du CMS, des bases de données et des serveurs web
--- Réseaux --- 
o	Comprendre, connaître et faire évoluer l\'infrastructure des réseaux de manière à assurer qualité de service et sécurité.
--- Serveurs --- 
o	Comprendre, connaître et faire évoluer l\'infrastructure serveurs de manière à assurer fiabilité, efficience pour les services.
--- Postes clients --- 
o	Maintenir et réaliser les mises à jour des postes de travail
o	Maintenir et faire évoluer les images systèmes
o	Support 2ème niveau (OS, applications)
o	Suivi de l’inventaire
--- Support aux utilisateurs-trices --- 
o	Assurer le service du Help Desk
o	Assurer des tâches techniques du service informatique
o	Gestion du matériel en prêt (vidéo, ordinateurs)
o	Maintenance et création de mode d’emploi
--- Réalisation de projets individuels dans les domaines cités ci-dessous (exemples) --- 
o	Mise en place d\'un serveur de streaming vidéo
o	Virtualisation (environnement RHEV)
o	Evaluation et comparaison de logiciels
o	Gouvernance, construction d’indicateurs 

Activités annexes :
•	Maintenir et améliorer ses compétences par une formation continue
•	Maintenir et mettre à jour la documentation du SIM
•	Veille technologique
Relations internes / externes au service :
•	Participer aux réunions hebdomadaires du SIM et à d’autres séances de travail internes.
',
                'parent_id' => NULL,
                'previous_id' => 389,
                'responsible_id' => 332,
            ),
            280 => 
            array (
                'admin_id' => 62,
                'beginDate' => '2019-02-01 00:00:00',
                'companies_id' => 35,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 6,
                'endDate' => '2019-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 435,
                'intern_id' => NULL,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 391,
                'responsible_id' => 62,
            ),
            281 => 
            array (
                'admin_id' => 232,
                'beginDate' => '2019-02-01 00:00:00',
                'companies_id' => 28,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 2,
                'endDate' => '2019-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 436,
                'intern_id' => NULL,
                'internshipDescription' => 'Le stagiaire a le rôle de technicien niveau 1 au Service desk.
Il est directement sous la responsabilité du Manager du Service desk.
Le guichet du Service desk est ouvert de 10h à 12h et de 13h30 à 15h30.
Le stagiaire est au contact des utilisateurs et leur répond directement en fonction des compétences qu’il va acquérir tout au long de son stage.
L’ECAL possède un environnement informatique principalement lié à Mac OS X. Le stagiaire aura donc l’occasion d’acquérir des compétences avancées au sujet de ce système d’exploitation.
Le stagiaire a la possibilité de réaliser durant son stage un projet lié à l’informatique ou à un des métiers enseignés à l’ECAL.',
                'parent_id' => NULL,
                'previous_id' => 395,
                'responsible_id' => 57,
            ),
            282 => 
            array (
                'admin_id' => 169,
                'beginDate' => '2019-02-01 00:00:00',
                'companies_id' => 37,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 6,
                'endDate' => '2019-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 437,
                'intern_id' => NULL,
                'internshipDescription' => 'Support Helpdesk dans un environnement international. Activités très variées:
- Support de deuxième niveau
- Préparation des postes de travail
- Coordination et répartition des requêtes des utilisateurs
- Installation de logiciels et imprimantes
- Gestion des commandes
- Gestion des retours de marchandise
- Gestion des iPads
- Gestion du bon fonctionnement des salles d’étude.
- Participation à l’installation de matériel audiovisuel (caméra, micro, écran, etc.).
- Préparation et installation de matériel pour Webinar
- Participation au support audiovisuel dans des auditoires

En plus du salaire, les repas de midi ainsi que l\'accès à une salle de fitness sont offerts au stagiaire.

Bon niveau d\'anglais conseillé',
                'parent_id' => NULL,
                'previous_id' => 396,
                'responsible_id' => 191,
            ),
            283 => 
            array (
                'admin_id' => 169,
                'beginDate' => '2019-02-01 00:00:00',
                'companies_id' => 37,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 6,
                'endDate' => '2019-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 438,
                'intern_id' => NULL,
                'internshipDescription' => 'Support Helpdesk dans un environnement international, Support de deuxième niveau, Préparation des postes de travail, Coordination et répartition des requêtes des utilisateurs, Installation de logiciels et imprimantes, Gestion des commandes, Gestion des retours de marchandise, Gestion des iPads et Gestion du bon fonctionnement des salles d’étude.

En plus du salaire, les repas de midi ainsi que l\'accès à une salle de fitness sont offerts au stagiaire.

Bon niveau d\'anglais conseillé',
                'parent_id' => NULL,
                'previous_id' => 397,
                'responsible_id' => 191,
            ),
            284 => 
            array (
                'admin_id' => 294,
                'beginDate' => '2019-02-01 00:00:00',
                'companies_id' => 41,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 2,
                'endDate' => '2019-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 439,
                'intern_id' => NULL,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 398,
                'responsible_id' => 47,
            ),
            285 => 
            array (
                'admin_id' => 79,
                'beginDate' => '2019-02-01 00:00:00',
                'companies_id' => 33,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 6,
                'endDate' => '2019-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 440,
                'intern_id' => NULL,
                'internshipDescription' => 'Support, installation, dépannage, projets individuels',
                'parent_id' => NULL,
                'previous_id' => 399,
                'responsible_id' => 79,
            ),
            286 => 
            array (
                'admin_id' => 234,
                'beginDate' => '2019-02-01 00:00:00',
                'companies_id' => 47,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 2,
                'endDate' => '2019-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 441,
                'intern_id' => NULL,
            'internshipDescription' => 'L’Université de Lausanne dispose d’un environnement hétérogène (MacOs et Windows). Le support informatique est prodigué aux chercheurs des différents départements de la Faculté de Biologie et de Médecine. Le stage comprend du support 1er et 2ème niveau (installation, dépannage logiciel et matériel) ainsi qu’un mini projet à discuter au début du stage en fonction des différents intérêts du stagiaire.',
                'parent_id' => NULL,
                'previous_id' => 400,
                'responsible_id' => 234,
            ),
            287 => 
            array (
                'admin_id' => 323,
                'beginDate' => '2019-02-01 00:00:00',
                'companies_id' => 42,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 2,
                'endDate' => '2019-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 442,
                'intern_id' => NULL,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 402,
                'responsible_id' => 280,
            ),
            288 => 
            array (
                'admin_id' => 286,
                'beginDate' => '2019-02-01 00:00:00',
                'companies_id' => 98,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 6,
                'endDate' => '2019-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 444,
                'intern_id' => NULL,
                'internshipDescription' => 'Les domaines dans lesquels le stagiaire pourrait exercer ses compétences seraient les suivants:
- dépannage en atelier et à distance pour des problèmes software (en principe non-professionnels) pour des ordinateurs why! sous GNU/Linux et divers périphériques compatibles
- participation au support en ligne proposé sur www.swisslinux.org pour les ordinateurs why!
- assemblage, flashage de BIOS, élaboration et installation de builds Ubuntu, réparations hardware sur des portables et desktops why!
- participation au déploiement et au développement de l\'ERP Odoo 9 (python) pour les besoins propres de why! et probablement de tiers (en particulier La Bonne Combine)
- développement de sites web (Typo3, Wordpress, Prestashop) pour des clients tiers
- déploiement et infogérance de systèmes informatiques pour les écoles à l\'aide du système open source Puavo (1er projet sur le point de démarrer dans une école privée vaudoise)
- contribution pour le support et le SAV du Fairphone 2 (sous Android, peut-être bientôt Ubuntu Touch)
- autres projets en lien avec les perspectives offertes par l\'open hardware.',
                'parent_id' => NULL,
                'previous_id' => 421,
                'responsible_id' => 296,
            ),
            289 => 
            array (
                'admin_id' => 186,
                'beginDate' => '2019-02-01 00:00:00',
                'companies_id' => 39,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 6,
                'endDate' => '2019-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 447,
                'intern_id' => NULL,
                'internshipDescription' => 'En tant que leader mondial dans le domaine des technologies médicales, Medtronic vous propose un stage dans une équipe informatique dynamique et passionnée. 
Votre mission sera de travailler et d’acquérir des compétences « IT » afin de gagner en autonomie dans un support informatique. 

Vous effectuerez des tâches variées telle que :
- Dépannage matériel et logiciel (1er et 2ème niveau)
- Déploiement et installation d’équipements divers (Desktop, Laptop, Smartphone, Tablet…)
- Suivi des demandes et pannes via notre outil de gestion des tickets
- Réalisation de divers projets pour notre équipe
Notre site hébergeant une des usines de production de technologies médicales vous aurez également la chance de pouvoir travailler en lien avec la production.
Tout au long de votre stage vos développerez les points suivants 
- Méthodologie de travail dans un environnement complexe
- Logique de dépannage matériel et logiciel
- Anglais oral et écrit. Un atout indispensable pour votre futur dans le monde de l’informatique.
Vos avantages seront les suivants : 
- Vous effectuerez les mêmes tâches que les membres de l’équipe IT
- Repas de midi offert à la cafétéria de l’entreprise dont 4 menus à choix proposés par nos chefs cuisiniers
- Matériel de support fourni que vous pouvez conserver à la fin de votre stage tel que : disque dur externe, Cyber Tools, baie d’extraction pour disque dur, trousse à outil de dépannage…
- Possibilité de voir votre salaire augmenté au mérite sous forme de « Cash Award » ',
                'parent_id' => NULL,
                'previous_id' => 401,
                'responsible_id' => 186,
            ),
            290 => 
            array (
                'admin_id' => 164,
                'beginDate' => '2019-02-01 00:00:00',
                'companies_id' => 38,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 6,
                'endDate' => '2019-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 448,
                'intern_id' => NULL,
            'internshipDescription' => 'Your mission within the Content & Access Security (CAS) Product Unit will be to streamline the secure device and system ordering processes through the implementation of efficient, simple and robust workflows. 

This job requires autonomous and result oriented skills in a dynamic and “AGILE” work environment where initiative and innovation are encouraged 

Mission

•	Analyse CAS ordering processes and help on the finalization of the architecture
•	Participate to the design of operational workflows and external systems connectivity
•	Implement the ordering workflows based on internal guidelines & best practices
•	Implement web services & data connection with external systems and user management
•	Implement intelligent web forms
•	Work in collaboration with R&D departments, IT support teams and technical experts
•	Take part in the related project as a key project member

Key responsibilities

•	Workflow implementation & specification of the test strategy
•	Define reusable sub process part
•	Documentation and training material generation
•	Reports on a weekly basis to the project manager and take part in the Project core team meetings (stand-up meetings, planning meetings, demo)
•	Reports to the Process Management team & Industrialization Team leader

Education and experience

•	Software development knowledge
•	Microsoft tools and web services development would be a plus
•	Great interest to learn and work on new technologies
•	Fluent in French and English is a plus',
                'parent_id' => NULL,
                'previous_id' => 425,
                'responsible_id' => 285,
            ),
            291 => 
            array (
                'admin_id' => 164,
                'beginDate' => '2019-02-01 00:00:00',
                'companies_id' => 38,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 6,
                'endDate' => '2019-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 449,
                'intern_id' => NULL,
                'internshipDescription' => 'Développement d\'outils au sein du groupe CAS PU - Trusted Platform',
                'parent_id' => NULL,
                'previous_id' => 428,
                'responsible_id' => 81,
            ),
            292 => 
            array (
                'admin_id' => 237,
                'beginDate' => '2019-02-01 00:00:00',
                'companies_id' => 43,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 6,
                'endDate' => '2019-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 450,
                'intern_id' => NULL,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 392,
                'responsible_id' => 44,
            ),
            293 => 
            array (
                'admin_id' => 237,
                'beginDate' => '2019-02-01 00:00:00',
                'companies_id' => 43,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 6,
                'endDate' => '2019-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 451,
                'intern_id' => NULL,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 429,
                'responsible_id' => 44,
            ),
            294 => 
            array (
                'admin_id' => 62,
                'beginDate' => '2019-02-01 00:00:00',
                'companies_id' => 35,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 6,
                'endDate' => '2019-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 452,
                'intern_id' => NULL,
                'internshipDescription' => '',
                'parent_id' => NULL,
                'previous_id' => 390,
                'responsible_id' => 62,
            ),
            295 => 
            array (
                'admin_id' => 231,
                'beginDate' => '2019-02-01 00:00:00',
                'companies_id' => 29,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 2,
                'endDate' => '2019-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 453,
                'intern_id' => NULL,
                'internshipDescription' => 'Travail varié: support, installation, dépannage, projets individuels.<br>Très peu d\'encadrement!',
                'parent_id' => NULL,
                'previous_id' => 427,
                'responsible_id' => 224,
            ),
            296 => 
            array (
                'admin_id' => 363,
                'beginDate' => '2019-02-01 00:00:00',
                'companies_id' => 116,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 6,
                'endDate' => '2019-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 454,
                'intern_id' => NULL,
            'internshipDescription' => 'Participation à l\'exploitation de l\'infrastructure UC (Unified communication) comprenant plus de 10’000 postes de téléphones IP.
Soutient à l’équipe de support dans les dépannages, traitement des demandes de changements et intervention sur place en cas de nécessité.',
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 363,
            ),
            297 => 
            array (
                'admin_id' => 335,
                'beginDate' => '2019-02-01 00:00:00',
                'companies_id' => 112,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 6,
                'endDate' => '2019-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 455,
                'intern_id' => NULL,
                'internshipDescription' => 'Stage d’informaticien dans le support informatique ainsi que de la gestion.

Le stagiaire devra participer à la finalisation de la mise en place du nouvel ERP sage X3, notamment :

-        Création d’états avec Crystal report
-        Formation des utilisateurs finaux
-        Personnalisation et création de requêtes métier

Il devra assister les utilisateurs , implémenter et maintenir nos serveurs physiques et virtuels sous VMware dans un contexte AD et Exchange.
',
                'parent_id' => NULL,
                'previous_id' => 424,
                'responsible_id' => 335,
            ),
            298 => 
            array (
                'admin_id' => 164,
                'beginDate' => '2019-02-01 00:00:00',
                'companies_id' => 38,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 6,
                'endDate' => '2019-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 456,
                'intern_id' => NULL,
                'internshipDescription' => 'Stage dans le service IT.

Support de deuxième niveau aux utilisateurs, installation, configuration, maintenance et supervision des postes de travail.',
                'parent_id' => NULL,
                'previous_id' => NULL,
                'responsible_id' => 364,
            ),
            299 => 
            array (
                'admin_id' => 330,
                'beginDate' => '2019-02-01 00:00:00',
                'companies_id' => 110,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 2,
                'endDate' => '2019-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 460,
                'intern_id' => NULL,
            'internshipDescription' => 'Le Gymnase de Renens se constitue de deux sites distincts. L’un à Provence (Lausanne) et l’autre à Renens. Les deux sites accueilleront ensemble dès août 2017 plus de 2000 élèves, 170 maîtres ainsi qu’une vingtaine de collaborateurs administratifs, faisant de lui le plus grand Gymnase vaudois. 
Le stagiaire effectuera les tâches suivantes :
·        Résoudre les problèmes intervenant dans les salles de cours
·        Aider les utilisateurs à l’utilisation du matériel mis à disposition
·        Aider les utilisateurs à l’utilisation des logiciels (basiques) ainsi que de l’OS mis à disposition
·        Développement de solutions WEB utilisées en interne (optionnel)
·        Maintenance logicielle et matérielle du site
·        Création et gestion des comptes AD',
                'parent_id' => NULL,
                'previous_id' => 299,
                'responsible_id' => 329,
            ),
            300 => 
            array (
                'admin_id' => 178,
                'beginDate' => '2019-02-01 00:00:00',
                'companies_id' => 80,
                'contractGenerated' => '0000-01-01 00:00:00',
                'contractstate_id' => 2,
                'endDate' => '2019-08-31 00:00:00',
                'grossSalary' => 1230,
                'id' => 461,
                'intern_id' => NULL,
                'internshipDescription' => 'Activités principales, en collaboration avec le responsable de chaque service :
--- CMS --- 
o	Participer à l\'évolution du CMS, des bases de données et des serveurs web
--- Réseaux --- 
o	Comprendre, connaître et faire évoluer l\'infrastructure des réseaux de manière à assurer qualité de service et sécurité.
--- Serveurs --- 
o	Comprendre, connaître et faire évoluer l\'infrastructure serveurs de manière à assurer fiabilité, efficience pour les services.
--- Postes clients --- 
o	Maintenir et réaliser les mises à jour des postes de travail
o	Maintenir et faire évoluer les images systèmes
o	Support 2ème niveau (OS, applications)
o	Suivi de l’inventaire
--- Support aux utilisateurs-trices --- 
o	Assurer le service du Help Desk
o	Assurer des tâches techniques du service informatique
o	Gestion du matériel en prêt (vidéo, ordinateurs)
o	Maintenance et création de mode d’emploi
--- Réalisation de projets individuels dans les domaines cités ci-dessous (exemples) --- 
o	Mise en place d\'un serveur de streaming vidéo
o	Virtualisation (environnement RHEV)
o	Evaluation et comparaison de logiciels
o	Gouvernance, construction d’indicateurs 

Activités annexes :
•	Maintenir et améliorer ses compétences par une formation continue
•	Maintenir et mettre à jour la documentation du SIM
•	Veille technologique
Relations internes / externes au service :
•	Participer aux réunions hebdomadaires du SIM et à d’autres séances de travail internes.
',
                'parent_id' => NULL,
                'previous_id' => 319,
                'responsible_id' => 332,
            ),
        ));
        
        
    }
}