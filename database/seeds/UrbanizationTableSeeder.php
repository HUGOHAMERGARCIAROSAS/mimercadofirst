<?php

use Illuminate\Database\Seeder;
use App\src\Models\ShippingCost;

class UrbanizationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $urbanizations = [
            (object)[
                'name' => 'Las Quintanas',
                'tax' => '4.5',
            ],
            (object)[
                'name' => 'Primavera',
                'tax' => '4.5',
            ],
            (object)[
                'name' => 'Huerta Grande',
                'tax' => '4.5',
            ],
            (object)[
                'name' => 'Los Olivos',
                'tax' => '4.5',
            ],
            (object)[
                'name' => 'San Andrés I y II Etapa',
                'tax' => '7.5',
            ],
            (object)[
                'name' => 'San Andrés III y IV Etapa',
                'tax' => '7.5',
            ],
            (object)[
                'name' => 'San Andrés V Etapa',
                'tax' => '10',
            ],
            (object)[
                'name' => 'El Recreo',
                'tax' => '7.5',
            ],
            (object)[
                'name' => 'Santa María I Etapa',
                'tax' => '8.5',
            ],
            (object)[
                'name' => 'Santa María II y III Etapa',
                'tax' => '8.5',
            ],
            (object)[
                'name' => 'Santa María IV y V Etapa',
                'tax' => '9.5',
            ], (object)[
                'name' => 'Los Laureles',
                'tax' => '10',
            ], (object)[
                'name' => 'San Vicente',
                'tax' => '9.5',
            ], (object)[
                'name' => 'La Merced',
                'tax' => '8.5',
            ], (object)[
                'name' => 'Los Rosales de San Andrés',
                'tax' => '8.5',
            ],
            (object)[
                'name' => 'Los Pinos',
                'tax' => '5',
            ],
            (object)[
                'name' => 'Las Palmeras de San Andrés',
                'tax' => '8',
            ], (object)[
                'name' => 'Las Flores',
                'tax' => '5',
            ], (object)[
                'name' => 'Fátima',
                'tax' => '9.5',
            ], (object)[
                'name' => 'La Arboleda',
                'tax' => '9.5',
            ], (object)[
                'name' => 'San Eloy',
                'tax' => '10',
            ], (object)[
                'name' => 'UPAO',
                'tax' => '9.5',
            ], (object)[
                'name' => 'Ingeniería',
                'tax' => '9.5',
            ], (object)[
                'name' => 'Galeno',
                'tax' => '9.5',
            ], (object)[
                'name' => 'California',
                'tax' => '10',
            ], (object)[
                'name' => 'Santa Edelmira',
                'tax' => '10',
            ], (object)[
                'name' => 'El Golf (especifique sector)',
                'tax' => '10',
            ],

        ];
        foreach ($urbanizations as $item) {
            $urbanization = new ShippingCost();
            $urbanization->create([
                'name' => $item->name,
                'tax' => $item->tax,
            ]);
        }

    }
}
