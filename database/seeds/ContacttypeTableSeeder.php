<?php

use App\Contacttypes;
use Illuminate\Database\Seeder;

class ContacttypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contacttypes = [
            ['contactTypeDescription'=>'Email', 'iconName' => 'envelope'],
            ['contactTypeDescription'=>'Tel Fixe', 'iconName' => 'phone-alt'],
            ['contactTypeDescription'=>'Tel Portable', 'iconName' => 'earphone']
        ];

        foreach ($contacttypes as $contacttype){
            Contacttypes::create($contacttype);
        }
    }
}
