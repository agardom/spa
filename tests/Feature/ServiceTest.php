<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ServiceTest extends TestCase
{
  /**
   * A basic feature test example.
   *
   * @return void
   */
  public function testServicesListedCorrectly()
  {
    $response = $this->json('GET', '/api/services', [], [])
      ->assertStatus(200)
      ->assertJsonStructure([
        'data' => ['*' => ['id', 'price', 'name', 'description', 'created_at', 'updated_at']]
      ]);
  }

  public function testServicesTimetableListedCorrectly()
  {
    $response = $this->json('GET', '/api/servicesTimetable', [], [])
      ->assertStatus(200);
  }

}
