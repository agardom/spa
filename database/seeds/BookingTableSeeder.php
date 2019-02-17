<?php

use Illuminate\Database\Seeder;
use spa\Booking\Booking;

class BookingTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    // Limpiamos la tabla
    Booking::truncate();

    $faker = \Faker\Factory::create();

    // Creamos varios Servicios en la BBDD
    for ($i = 0; $i < 30; $i++) {
      Booking::create([
        'clientName' => $faker->firstName . " " . $faker->lastName,
        'comments' => $faker->sentence,
        'date' => $faker->dateTime(),
        'serviceId' => $faker->numberBetween(1, 10),
        'price' => $faker->randomFloat(2, 75, 400),
      ]);
    }
  }
}
