<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class RouteTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return array<int, array<int, string>>
     */
    public static function routeProvider(): array
    {
        return [
            ['/dashboard'],
            ['/medicine'],
            ['/bloodSugarReading'],
        ];
    }

    #[DataProvider('routeProvider')]
    public function test_route_is_secured($route): void
    {
        $response = $this->get($route);

        $response->assertRedirectToRoute('login');
    }
}
