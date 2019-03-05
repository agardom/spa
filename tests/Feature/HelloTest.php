<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HelloTest extends TestCase
{
  /**
   * Test if service is running
   */
  public function testServicesBasic() {
    $this->assertTrue(true);
  }

  /**
   * Test api/Hello method:
   *    - Response is ok
   *    - Locale is English and not Spanish
   */
  public function testServicesHello() {
    $response = $this->json('GET', '/api/hello', [], [])
      ->assertStatus(200)
      ->assertSeeText('hi-en')
      ->assertDontSee('hi-es');
  }

  /**
   * Test api/Hello method. Setting spanish language
   *    - Response is ok
   *    - Locale is Spanish and not English
   */
  public function testServicesHelloEs(){
    $headers = ['X-localization' => 'es'];
    $response = $this->json('GET', '/api/hello', [], $headers)
      ->assertStatus(200)
      ->assertSeeText('hi-es')
      ->assertDontSee('hi-en');
  }
}
