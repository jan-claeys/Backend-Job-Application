<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

use function PHPUnit\Framework\assertCount;

class BusinessTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    /** @test */
    public function it_returns_countries()
    {
        $response = $this->get('/api/businesses/countries');

        $response->assertJsonCount(3)
            ->assertJsonPath('0', 'Belgium')
            ->assertJsonPath('1', 'France')
            ->assertJsonPath('2', 'Netherlands');
    }

    /** @test */
    public function it_return_business()
    {
        $id = DB::table('businesses')->insertGetID([
            'name' => 'Next Apps',
            'description' => 'We create digital applications with a big focus on the end user.',
            'address' => 'Stationsplein 41',
            'city' => 'Lokeren',
            'zip_code' => '9160',
            'country' => 'Belgium'
        ]);

        $response = $this->get("/api/businesses/{$id}");

        $response->assertJsonStructure([
            'id',
            'name',
            'description',
            'address',
            'city',
            'zip_code',
            'country',
            'owners' => [
                '*' => [
                    'id',
                    'name',
                    'business_id'
                ]
            ]
        ]);
    }

    /** @test */
    public function it_returns_businesses()
    {
        $response = $this->get('/api/businesses');

        $response->assertJsonStructure([
            '*' => [
                'id',
                'name',
                'description',
                'address',
                'city',
                'zip_code',
                'country',
                'owners' => [
                    '*' => [
                        'id',
                        'name',
                        'business_id'
                    ]
                ]
            ]
        ])
            ->assertJsonCount(4);
    }

    /** @test */
    public function it_returns_businesses_with_filter_on_city()
    {
        $response = $this->get('/api/businesses?search=gent');

        $response->assertJsonCount(1);
    }


    /** @test */
    public function it_returns_businesses_with_filter_on_countries()
    {
        $response = $this->get('/api/businesses?countries[]=Belgium&countries[]=France');

        $response->assertJsonCount(3);
    }

    /** @test */
    public function it_returns_businesses_with_filter_on_owner_name_and_countries()
    {
        $response = $this->get('/api/businesses?countries[]=Belgium&search=wim');

        $response->assertJsonCount(1);
    }
}
