<?php

use App\Models\Client;
use Illuminate\Database\Seeder;

class clientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clients = [
            [
                "name" => "said",
                "phone" => "0863987452",
                "adress" => "mimousas kenitra",
                "email" => "said-merbah@gmail.com",
            ],
            [
                "name" => "rachid",
                "phone" => "07825263",
                "adress" => "ain aouda casablanca",
                "email" => "rachid-salhi@outlook.com",
            ],
            [
                "name" => "chadia",
                "phone" => "0615263696",
                "adress" => "center ville kenitra",
                "email" => "chada@hotmail.com",
            ],
        ];

        foreach ($clients as $client) {
            Client::create($client)->save();
        }
    }
}
