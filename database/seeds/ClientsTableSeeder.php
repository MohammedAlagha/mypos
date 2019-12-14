<?php

use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clients = ['Ahmed','Mohammed'];

        foreach ($clients as $client ) {
            \App\Client::create([
                'name'=>$client,
                'mobile'=>'0500000000',
                'phone'=>'000000000',
                'address'=>'Aljalla'
            ]);//end of create

        };//end of foreach
    }
}
