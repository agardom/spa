<?php

use Illuminate\Database\Seeder;
use spa\Service\Service;
use spa\Service\ServiceTranslation;
use spa\Service\ServiceTimetable;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Limpiamos la tabla
        Service::truncate();

        $faker = \Faker\Factory::create();

        // Creamos varios Servicios en la BBDD
        $service = Service::create(['price' => 100.00]);
        ServiceTranslation::create([
          'serviceId' => $service->id,
          'locale' => 'es',
          'name' => 'Circuito Completo Spa',
          'description' => 'Circuito completo que incluye todas las zonas del spa: termal interno y externo, jacuzzi, sauna, baño turco...'
        ]);

        ServiceTranslation::create([
          'serviceId' => $service->id,
          'locale' => 'en',
          'name' => 'Complete Spa Circuit',
          'description' => 'Complete circuit that includes all areas of the spa: internal and external thermal, jacuzzi, sauna, Turkish bath ...'
        ]);

        for ($i = 1; $i < 29; $i++) {
          ServiceTimeTable::create([
            'serviceId' => $service->id,
            'date' => '2019-03-' . $i,
            'start' => '08:00',
            'end' => '18:00'
          ]);
        }

        $service = Service::create(['price' => 150.00]);
        ServiceTranslation::create([
          'serviceId' => $service->id,
          'locale' => 'es',
          'name' => 'Experiencia bienestar',
          'description' => 'Masaje de piedras volcánicas, acceso ilimitado al spa'
        ]);

        ServiceTranslation::create([
          'serviceId' => $service->id,
          'locale' => 'en',
          'name' => 'Wellness experience',
          'description' => 'Volcanic stone massage, unlimited spa access'
        ]);

        for ($i = 1; $i < 29; $i++) {
          ServiceTimeTable::create([
            'serviceId' => $service->id,
            'date' => '2019-03-' . $i,
            'start' => '08:00',
            'end' => '18:00'
          ]);
        }

        $service = Service::create(['price' => 130.00]);
        ServiceTranslation::create([
          'serviceId' => $service->id,
          'locale' => 'es',
          'name' => 'Ritual Canario',
          'description' => 'Ritual Canario'
        ]);

        ServiceTranslation::create([
          'serviceId' => $service->id,
          'locale' => 'en',
          'name' => 'Canary Ritual',
          'description' => 'Canary Ritual'
        ]);

        for ($i = 1; $i < 29; $i++) {
          ServiceTimeTable::create([
            'serviceId' => $service->id,
            'date' => '2019-03-' . $i,
            'start' => '10:00',
            'end' => '17:00'
          ]);
        }

        $service = Service::create(['price' => 140.00]);
        ServiceTranslation::create([
          'serviceId' => $service->id,
          'locale' => 'es',
          'name' => 'Ritual de la Polinesia',
          'description' => 'Ritual de la Polinesia'
        ]);

        ServiceTranslation::create([
          'serviceId' => $service->id,
          'locale' => 'en',
          'name' => 'Polinesian Ritual',
          'description' => 'Polinesian Ritual'
        ]);

        for ($i = 1; $i < 29; $i++) {
          ServiceTimeTable::create([
            'serviceId' => $service->id,
            'date' => '2019-03-' . $i,
            'start' => '10:00',
            'end' => '17:00'
          ]);
        }

        /*$service = Service::create(['price' => 140.00]);
        ServiceTranslation::create([
          'serviceId' => $service->id,
          'locale' => 'es',
          'name' => '',
          'description' => ''
        ]);

        ServiceTranslation::create([
          'serviceId' => $service->id,
          'locale' => 'en',
          'name' => '',
          'description' => ''
        ]);

        $service = Service::create(['price' => 180.00]);
        ServiceTranslation::create([
          'serviceId' => $service->id,
          'locale' => 'es',
          'name' => '',
          'description' => ''
        ]);

        ServiceTranslation::create([
          'serviceId' => $service->id,
          'locale' => 'en',
          'name' => '',
          'description' => ''
        ]);

        $service = Service::create(['price' => 120.00]);
        ServiceTranslation::create([
          'serviceId' => $service->id,
          'locale' => 'es',
          'name' => '',
          'description' => ''
        ]);

        ServiceTranslation::create([
          'serviceId' => $service->id,
          'locale' => 'en',
          'name' => '',
          'description' => ''
        ]);

        $service = Service::create(['price' => 110.00]);
        ServiceTranslation::create([
          'serviceId' => $service->id,
          'locale' => 'es',
          'name' => '',
          'description' => ''
        ]);

        ServiceTranslation::create([
          'serviceId' => $service->id,
          'locale' => 'en',
          'name' => '',
          'description' => ''
        ]);

        $service = Service::create(['price' => 180.00]);
        ServiceTranslation::create([
          'serviceId' => $service->id,
          'locale' => 'es',
          'name' => '',
          'description' => ''
        ]);

        ServiceTranslation::create([
          'serviceId' => $service->id,
          'locale' => 'en',
          'name' => '',
          'description' => ''
        ]);

        $service = Service::create(['price' => 110.00]);
        ServiceTranslation::create([
          'serviceId' => $service->id,
          'locale' => 'es',
          'name' => '',
          'description' => ''
        ]);

        ServiceTranslation::create([
          'serviceId' => $service->id,
          'locale' => 'en',
          'name' => '',
          'description' => ''
        ]);

        $service = Service::create(['price' => 250.00]);
        ServiceTranslation::create([
          'serviceId' => $service->id,
          'locale' => 'es',
          'name' => '',
          'description' => ''
        ]);

        ServiceTranslation::create([
          'serviceId' => $service->id,
          'locale' => 'en',
          'name' => '',
          'description' => ''
        ]);

        $service = Service::create(['price' => 75.00]);
        ServiceTranslation::create([
          'serviceId' => $service->id,
          'locale' => 'es',
          'name' => '',
          'description' => ''
        ]);

        ServiceTranslation::create([
          'serviceId' => $service->id,
          'locale' => 'en',
          'name' => '',
          'description' => ''
        ]);*/
    }
}
