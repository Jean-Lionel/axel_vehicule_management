<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Vehicule;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\VehiculeController
 */
class VehiculeControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view(): void
    {
        $vehicules = Vehicule::factory()->count(3)->create();

        $response = $this->get(route('vehicule.index'));

        $response->assertOk();
        $response->assertViewIs('vehicule.index');
        $response->assertViewHas('vehicules');
    }


    /**
     * @test
     */
    public function create_displays_view(): void
    {
        $response = $this->get(route('vehicule.create'));

        $response->assertOk();
        $response->assertViewIs('vehicule.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\VehiculeController::class,
            'store',
            \App\Http\Requests\VehiculeStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects(): void
    {
        $name = $this->faker->name;
        $marque = $this->faker->word;
        $date_achat = $this->faker->date();
        $matricule = $this->faker->word;

        $response = $this->post(route('vehicule.store'), [
            'name' => $name,
            'marque' => $marque,
            'date_achat' => $date_achat,
            'matricule' => $matricule,
        ]);

        $vehicules = Vehicule::query()
            ->where('name', $name)
            ->where('marque', $marque)
            ->where('date_achat', $date_achat)
            ->where('matricule', $matricule)
            ->get();
        $this->assertCount(1, $vehicules);
        $vehicule = $vehicules->first();

        $response->assertRedirect(route('vehicule.index'));
        $response->assertSessionHas('vehicule.id', $vehicule->id);
    }


    /**
     * @test
     */
    public function show_displays_view(): void
    {
        $vehicule = Vehicule::factory()->create();

        $response = $this->get(route('vehicule.show', $vehicule));

        $response->assertOk();
        $response->assertViewIs('vehicule.show');
        $response->assertViewHas('vehicule');
    }


    /**
     * @test
     */
    public function edit_displays_view(): void
    {
        $vehicule = Vehicule::factory()->create();

        $response = $this->get(route('vehicule.edit', $vehicule));

        $response->assertOk();
        $response->assertViewIs('vehicule.edit');
        $response->assertViewHas('vehicule');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\VehiculeController::class,
            'update',
            \App\Http\Requests\VehiculeUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects(): void
    {
        $vehicule = Vehicule::factory()->create();
        $name = $this->faker->name;
        $marque = $this->faker->word;
        $date_achat = $this->faker->date();
        $matricule = $this->faker->word;

        $response = $this->put(route('vehicule.update', $vehicule), [
            'name' => $name,
            'marque' => $marque,
            'date_achat' => $date_achat,
            'matricule' => $matricule,
        ]);

        $vehicule->refresh();

        $response->assertRedirect(route('vehicule.index'));
        $response->assertSessionHas('vehicule.id', $vehicule->id);

        $this->assertEquals($name, $vehicule->name);
        $this->assertEquals($marque, $vehicule->marque);
        $this->assertEquals(Carbon::parse($date_achat), $vehicule->date_achat);
        $this->assertEquals($matricule, $vehicule->matricule);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects(): void
    {
        $vehicule = Vehicule::factory()->create();

        $response = $this->delete(route('vehicule.destroy', $vehicule));

        $response->assertRedirect(route('vehicule.index'));

        $this->assertModelMissing($vehicule);
    }
}
