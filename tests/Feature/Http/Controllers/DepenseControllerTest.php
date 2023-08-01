<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Depense;
use App\Models\User;
use App\Models\Vehicule;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\DepenseController
 */
class DepenseControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view(): void
    {
        $depenses = Depense::factory()->count(3)->create();

        $response = $this->get(route('depense.index'));

        $response->assertOk();
        $response->assertViewIs('depense.index');
        $response->assertViewHas('depenses');
    }


    /**
     * @test
     */
    public function create_displays_view(): void
    {
        $response = $this->get(route('depense.create'));

        $response->assertOk();
        $response->assertViewIs('depense.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\DepenseController::class,
            'store',
            \App\Http\Requests\DepenseStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects(): void
    {
        $vehicule = Vehicule::factory()->create();
        $piece = $this->faker->word;
        $type = $this->faker->word;
        $price = $this->faker->randomFloat(/** double_attributes **/);
        $user = User::factory()->create();

        $response = $this->post(route('depense.store'), [
            'vehicule_id' => $vehicule->id,
            'piece' => $piece,
            'type' => $type,
            'price' => $price,
            'user_id' => $user->id,
        ]);

        $depenses = Depense::query()
            ->where('vehicule_id', $vehicule->id)
            ->where('piece', $piece)
            ->where('type', $type)
            ->where('price', $price)
            ->where('user_id', $user->id)
            ->get();
        $this->assertCount(1, $depenses);
        $depense = $depenses->first();

        $response->assertRedirect(route('depense.index'));
        $response->assertSessionHas('depense.id', $depense->id);
    }


    /**
     * @test
     */
    public function show_displays_view(): void
    {
        $depense = Depense::factory()->create();

        $response = $this->get(route('depense.show', $depense));

        $response->assertOk();
        $response->assertViewIs('depense.show');
        $response->assertViewHas('depense');
    }


    /**
     * @test
     */
    public function edit_displays_view(): void
    {
        $depense = Depense::factory()->create();

        $response = $this->get(route('depense.edit', $depense));

        $response->assertOk();
        $response->assertViewIs('depense.edit');
        $response->assertViewHas('depense');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\DepenseController::class,
            'update',
            \App\Http\Requests\DepenseUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects(): void
    {
        $depense = Depense::factory()->create();
        $vehicule = Vehicule::factory()->create();
        $piece = $this->faker->word;
        $type = $this->faker->word;
        $price = $this->faker->randomFloat(/** double_attributes **/);
        $user = User::factory()->create();

        $response = $this->put(route('depense.update', $depense), [
            'vehicule_id' => $vehicule->id,
            'piece' => $piece,
            'type' => $type,
            'price' => $price,
            'user_id' => $user->id,
        ]);

        $depense->refresh();

        $response->assertRedirect(route('depense.index'));
        $response->assertSessionHas('depense.id', $depense->id);

        $this->assertEquals($vehicule->id, $depense->vehicule_id);
        $this->assertEquals($piece, $depense->piece);
        $this->assertEquals($type, $depense->type);
        $this->assertEquals($price, $depense->price);
        $this->assertEquals($user->id, $depense->user_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects(): void
    {
        $depense = Depense::factory()->create();

        $response = $this->delete(route('depense.destroy', $depense));

        $response->assertRedirect(route('depense.index'));

        $this->assertModelMissing($depense);
    }
}
