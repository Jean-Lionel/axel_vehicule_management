<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Carburant;
use App\Models\User;
use App\Models\Vehicule;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\CarburantController
 */
class CarburantControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view(): void
    {
        $carburants = Carburant::factory()->count(3)->create();

        $response = $this->get(route('carburant.index'));

        $response->assertOk();
        $response->assertViewIs('carburant.index');
        $response->assertViewHas('carburants');
    }


    /**
     * @test
     */
    public function create_displays_view(): void
    {
        $response = $this->get(route('carburant.create'));

        $response->assertOk();
        $response->assertViewIs('carburant.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\CarburantController::class,
            'store',
            \App\Http\Requests\CarburantStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects(): void
    {
        $vehicule = Vehicule::factory()->create();
        $littre = $this->faker->randomFloat(/** float_attributes **/);
        $price_per_littre = $this->faker->randomFloat(/** double_attributes **/);
        $prix_total = $this->faker->randomFloat(/** double_attributes **/);
        $user = User::factory()->create();
        $date = $this->faker->date();

        $response = $this->post(route('carburant.store'), [
            'vehicule_id' => $vehicule->id,
            'littre' => $littre,
            'price_per_littre' => $price_per_littre,
            'prix_total' => $prix_total,
            'user_id' => $user->id,
            'date' => $date,
        ]);

        $carburants = Carburant::query()
            ->where('vehicule_id', $vehicule->id)
            ->where('littre', $littre)
            ->where('price_per_littre', $price_per_littre)
            ->where('prix_total', $prix_total)
            ->where('user_id', $user->id)
            ->where('date', $date)
            ->get();
        $this->assertCount(1, $carburants);
        $carburant = $carburants->first();

        $response->assertRedirect(route('carburant.index'));
        $response->assertSessionHas('carburant.id', $carburant->id);
    }


    /**
     * @test
     */
    public function show_displays_view(): void
    {
        $carburant = Carburant::factory()->create();

        $response = $this->get(route('carburant.show', $carburant));

        $response->assertOk();
        $response->assertViewIs('carburant.show');
        $response->assertViewHas('carburant');
    }


    /**
     * @test
     */
    public function edit_displays_view(): void
    {
        $carburant = Carburant::factory()->create();

        $response = $this->get(route('carburant.edit', $carburant));

        $response->assertOk();
        $response->assertViewIs('carburant.edit');
        $response->assertViewHas('carburant');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\CarburantController::class,
            'update',
            \App\Http\Requests\CarburantUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects(): void
    {
        $carburant = Carburant::factory()->create();
        $vehicule = Vehicule::factory()->create();
        $littre = $this->faker->randomFloat(/** float_attributes **/);
        $price_per_littre = $this->faker->randomFloat(/** double_attributes **/);
        $prix_total = $this->faker->randomFloat(/** double_attributes **/);
        $user = User::factory()->create();
        $date = $this->faker->date();

        $response = $this->put(route('carburant.update', $carburant), [
            'vehicule_id' => $vehicule->id,
            'littre' => $littre,
            'price_per_littre' => $price_per_littre,
            'prix_total' => $prix_total,
            'user_id' => $user->id,
            'date' => $date,
        ]);

        $carburant->refresh();

        $response->assertRedirect(route('carburant.index'));
        $response->assertSessionHas('carburant.id', $carburant->id);

        $this->assertEquals($vehicule->id, $carburant->vehicule_id);
        $this->assertEquals($littre, $carburant->littre);
        $this->assertEquals($price_per_littre, $carburant->price_per_littre);
        $this->assertEquals($prix_total, $carburant->prix_total);
        $this->assertEquals($user->id, $carburant->user_id);
        $this->assertEquals(Carbon::parse($date), $carburant->date);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects(): void
    {
        $carburant = Carburant::factory()->create();

        $response = $this->delete(route('carburant.destroy', $carburant));

        $response->assertRedirect(route('carburant.index'));

        $this->assertModelMissing($carburant);
    }
}
