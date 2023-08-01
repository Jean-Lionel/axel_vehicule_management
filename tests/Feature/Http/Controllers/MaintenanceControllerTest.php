<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Maintenance;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\MaintenanceController
 */
class MaintenanceControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view(): void
    {
        $maintenances = Maintenance::factory()->count(3)->create();

        $response = $this->get(route('maintenance.index'));

        $response->assertOk();
        $response->assertViewIs('maintenance.index');
        $response->assertViewHas('maintenances');
    }


    /**
     * @test
     */
    public function create_displays_view(): void
    {
        $response = $this->get(route('maintenance.create'));

        $response->assertOk();
        $response->assertViewIs('maintenance.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\MaintenanceController::class,
            'store',
            \App\Http\Requests\MaintenanceStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects(): void
    {
        $name = $this->faker->name;

        $response = $this->post(route('maintenance.store'), [
            'name' => $name,
        ]);

        $maintenances = Maintenance::query()
            ->where('name', $name)
            ->get();
        $this->assertCount(1, $maintenances);
        $maintenance = $maintenances->first();

        $response->assertRedirect(route('maintenance.index'));
        $response->assertSessionHas('maintenance.id', $maintenance->id);
    }


    /**
     * @test
     */
    public function show_displays_view(): void
    {
        $maintenance = Maintenance::factory()->create();

        $response = $this->get(route('maintenance.show', $maintenance));

        $response->assertOk();
        $response->assertViewIs('maintenance.show');
        $response->assertViewHas('maintenance');
    }


    /**
     * @test
     */
    public function edit_displays_view(): void
    {
        $maintenance = Maintenance::factory()->create();

        $response = $this->get(route('maintenance.edit', $maintenance));

        $response->assertOk();
        $response->assertViewIs('maintenance.edit');
        $response->assertViewHas('maintenance');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\MaintenanceController::class,
            'update',
            \App\Http\Requests\MaintenanceUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects(): void
    {
        $maintenance = Maintenance::factory()->create();
        $name = $this->faker->name;

        $response = $this->put(route('maintenance.update', $maintenance), [
            'name' => $name,
        ]);

        $maintenance->refresh();

        $response->assertRedirect(route('maintenance.index'));
        $response->assertSessionHas('maintenance.id', $maintenance->id);

        $this->assertEquals($name, $maintenance->name);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects(): void
    {
        $maintenance = Maintenance::factory()->create();

        $response = $this->delete(route('maintenance.destroy', $maintenance));

        $response->assertRedirect(route('maintenance.index'));

        $this->assertModelMissing($maintenance);
    }
}
