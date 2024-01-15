<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Tenant;

class TenantTest extends TestCase
{

    // use DatabaseMigrations;

    /**
     * A basic feature test example.
     */
    public function test_create_tenant(): void
    {
        $tenant = Tenant::create();
        $response = $this->get('/tenants/' . $tenant->id);

        $response->assertStatus(200);
    }

    protected $tenancy = true;

    // public function setUp(): void
    // {
    //     parent::setUp();

    //     if ($this->tenancy) {
    //         $this->initializeTenancy();
    //     }
    // }

    // public function initializeTenancy()
    // {
    //     $tenant = Tenant::firstOrCreate(['id' => 'test']);
    //     tenancy()->initialize($tenant);
    // }

    // public function tearDown(): void
    // {
    //     parent::tearDown();
    //     $tenant = Tenant::find(['id' => 'test'])->destroy();
    // }
}
