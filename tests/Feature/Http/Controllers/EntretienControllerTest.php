<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Entretien;
use App\Models\Maintenance;
use App\Models\User;
use App\Models\Vehicule;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\EntretienController
 */
class EntretienControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view(): void
    {
        $entretiens = Entretien::factory()->count(3)->create();

        $response = $this->get(route('entretien.index'));

        $response->assertOk();
        $response->assertViewIs('entretien.index');
        $response->assertViewHas('entretiens');
    }


    /**
     * @test
     */
    public function create_displays_view(): void
    {
        $response = $this->get(route('entretien.create'));

        $response->assertOk();
        $response->assertViewIs('entretien.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\EntretienController::class,
            'store',
            \App\Http\Requests\EntretienStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects(): void
    {
        $vehicule = Vehicule::factory()->create();
        $maintenance = Maintenance::factory()->create();
        $description = $this->faker->text;
        $date = $this->faker->date();
        $montant = $this->faker->randomFloat(/** double_attributes **/);
        $user = User::factory()->create();

        $response = $this->post(route('entretien.store'), [
            'vehicule_id' => $vehicule->id,
            'maintenance_id' => $maintenance->id,
            'description' => $description,
            'date' => $date,
            'montant' => $montant,
            'user_id' => $user->id,
        ]);

        $entretiens = Entretien::query()
            ->where('vehicule_id', $vehicule->id)
            ->where('maintenance_id', $maintenance->id)
            ->where('description', $description)
            ->where('date', $date)
            ->where('montant', $montant)
            ->where('user_id', $user->id)
            ->get();
        $this->assertCount(1, $entretiens);
        $entretien = $entretiens->first();

        $response->assertRedirect(route('entretien.index'));
        $response->assertSessionHas('entretien.id', $entretien->id);
    }


    /**
     * @test
     */
    public function show_displays_view(): void
    {
        $entretien = Entretien::factory()->create();

        $response = $this->get(route('entretien.show', $entretien));

        $response->assertOk();
        $response->assertViewIs('entretien.show');
        $response->assertViewHas('entretien');
    }


    /**
     * @test
     */
    public function edit_displays_view(): void
    {
        $entretien = Entretien::factory()->create();

        $response = $this->get(route('entretien.edit', $entretien));

        $response->assertOk();
        $response->assertViewIs('entretien.edit');
        $response->assertViewHas('entretien');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\EntretienController::class,
            'update',
            \App\Http\Requests\EntretienUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects(): void
    {
        $entretien = Entretien::factory()->create();
        $vehicule = Vehicule::factory()->create();
        $maintenance = Maintenance::factory()->create();
        $description = $this->faker->text;
        $date = $this->faker->date();
        $montant = $this->faker->randomFloat(/** double_attributes **/);
        $user = User::factory()->create();

        $response = $this->put(route('entretien.update', $entretien), [
            'vehicule_id' => $vehicule->id,
            'maintenance_id' => $maintenance->id,
            'description' => $description,
            'date' => $date,
            'montant' => $montant,
            'user_id' => $user->id,
        ]);

        $entretien->refresh();

        $response->assertRedirect(route('entretien.index'));
        $response->assertSessionHas('entretien.id', $entretien->id);

        $this->assertEquals($vehicule->id, $entretien->vehicule_id);
        $this->assertEquals($maintenance->id, $entretien->maintenance_id);
        $this->assertEquals($description, $entretien->description);
        $this->assertEquals(Carbon::parse($date), $entretien->date);
        $this->assertEquals($montant, $entretien->montant);
        $this->assertEquals($user->id, $entretien->user_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects(): void
    {
        $entretien = Entretien::factory()->create();

        $response = $this->delete(route('entretien.destroy', $entretien));

        $response->assertRedirect(route('entretien.index'));

        $this->assertModelMissing($entretien);
    }
}
