<?php

namespace Tests\Feature;

use App\Models\Evento;
use App\Models\Icona;
use App\Models\Persona;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class IconeTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutVite();
    }

    public function test_icon_management_requires_login_and_has_no_delete_route(): void
    {
        $this->get(route('icone.index'))->assertRedirect(route('login'));
        $icona = Icona::create(['nome' => 'Telefono', 'classe' => 'fa-solid fa-phone']);
        $this->actingAs(User::factory()->create());
        $this->delete('/icone/'.$icona->id)->assertStatus(405);
        $this->assertDatabaseHas('icone', ['id' => $icona->id]);
    }

    public function test_icons_can_be_created_and_edited_and_forms_render(): void
    {
        $this->actingAs(User::factory()->create());
        $this->get(route('icone.create'))->assertOk()->assertSee('Anteprima')
            ->assertSee('Cerca icona')->assertSee('catalogo-icone')->assertSee('iconPicker', false);
        $this->post(route('icone.store'), ['nome' => 'Telefono', 'classe' => ' fa-solid   fa-phone '])
            ->assertRedirect(route('icone.index'));
        $icona = Icona::firstOrFail();
        $this->assertSame('fa-solid fa-phone', $icona->classe);
        $this->get(route('icone.index'))->assertOk()->assertSee('Telefono');
        $this->get(route('icone.edit', $icona))->assertOk()->assertSee('fa-solid fa-phone');
        $this->patch(route('icone.update', $icona), ['nome' => 'Visita', 'classe' => 'fa-solid fa-heart'])
            ->assertRedirect(route('icone.index'));
        $this->assertDatabaseHas('icone', ['id' => $icona->id, 'nome' => 'Visita', 'classe' => 'fa-solid fa-heart']);
    }

    public function test_icon_html_is_rejected(): void
    {
        $this->actingAs(User::factory()->create())
            ->post(route('icone.store'), ['nome' => 'Telefono', 'classe' => '<i class="fa-solid fa-phone"></i>'])
            ->assertSessionHasErrors('classe');
        $this->assertDatabaseCount('icone', 0);
    }

    public function test_both_event_flows_save_and_change_the_icon(): void
    {
        $this->actingAs(User::factory()->create());
        $persona = Persona::create(['nome' => 'Mario', 'colore' => '#123456']);
        $icona = Icona::create(['nome' => 'Telefono', 'classe' => 'fa-solid fa-phone']);
        $altra = Icona::create(['nome' => 'Visita', 'classe' => 'fa-solid fa-heart']);
        $data = ['persona' => $persona->id, 'icona_id' => $icona->id, 'descrizione' => 'Appuntamento', 'start' => '2026-10-23'];

        foreach (['evento', 'eventi'] as $flow) {
            $create = $flow === 'evento' ? 'evento.nuovo' : 'eventi.create';
            $this->get(route($create))->assertOk()->assertSee('Telefono');
            $this->post(route($flow.'.store'), $data)->assertSessionHasNoErrors()->assertRedirect();
            $evento = Evento::where('icona_id', $icona->id)->firstOrFail();
            $edit = $flow === 'evento' ? 'evento.modifica' : 'eventi.edit';
            $this->get(route($edit, $evento->id))->assertOk()->assertSee('checked', false);
            $data['icona_id'] = $altra->id;
            $this->call($flow === 'evento' ? 'POST' : 'PATCH', route($flow.'.update', $evento->id), $data)
                ->assertSessionHasNoErrors()->assertRedirect();
            $this->assertDatabaseHas('eventi', ['id' => $evento->id, 'icona_id' => $altra->id]);
            $data['icona_id'] = $icona->id;
        }
    }

    public function test_invalid_event_icons_are_rejected(): void
    {
        $this->actingAs(User::factory()->create());
        $persona = Persona::create(['nome' => 'Mario', 'colore' => '#123456']);
        $data = ['persona' => $persona->id, 'descrizione' => 'Appuntamento', 'start' => '2026-10-23'];
        foreach (['evento', 'eventi'] as $flow) {
            $this->post(route($flow.'.store'), $data + ['icona_id' => (string) Str::uuid()])->assertSessionHasErrors('icona_id');
        }
        $this->assertDatabaseCount('eventi', 0);
    }

    public function test_both_event_flows_allow_no_icon_and_removing_an_existing_icon(): void
    {
        $this->actingAs(User::factory()->create());
        $persona = Persona::create(['nome' => 'Mario', 'colore' => '#123456']);
        $icona = Icona::create(['nome' => 'Telefono', 'classe' => 'fa-solid fa-phone']);
        $data = ['persona' => $persona->id, 'descrizione' => 'Appuntamento', 'start' => '2026-10-23'];

        foreach (['evento', 'eventi'] as $flow) {
            foreach ([[], ['icona_id' => ''], ['icona_id' => null]] as $selection) {
                $this->post(route($flow.'.store'), $data + $selection)
                    ->assertSessionHasNoErrors()->assertRedirect();
            }

            $evento = $persona->eventi()->create([
                'descrizione' => 'Con icona', 'start' => '2026-10-23', 'icona_id' => $icona->id,
            ]);
            $edit = $flow === 'evento' ? 'evento.modifica' : 'eventi.edit';
            $this->get(route($edit, $evento->id))->assertOk()->assertSee('Nessuna icona');
            $this->call($flow === 'evento' ? 'POST' : 'PATCH', route($flow.'.update', $evento->id), $data + ['icona_id' => ''])
                ->assertSessionHasNoErrors()->assertRedirect();
            $this->assertDatabaseHas('eventi', ['id' => $evento->id, 'icona_id' => null]);
        }

        $this->assertDatabaseCount('eventi', 8);
        $this->assertSame(0, Evento::whereNotNull('icona_id')->count());
    }

    public function test_feed_supports_legacy_events_and_reflects_icon_changes(): void
    {
        $persona = Persona::create(['nome' => 'Mario', 'colore' => '#123456']);
        $legacy = $persona->eventi()->create(['descrizione' => 'Precedente', 'start' => '2026-10-23']);
        $icona = Icona::create(['nome' => 'Telefono', 'classe' => 'fa-solid fa-phone']);
        $persona->eventi()->create(['descrizione' => 'Nuovo', 'start' => '2026-10-24', 'icona_id' => $icona->id]);
        $events = collect($this->get('/events')->assertOk()->json())->keyBy('title');
        $this->assertNull($events['Precedente']['extendedProps']['icona']);
        $this->assertSame('fa-solid fa-phone', $events['Nuovo']['extendedProps']['icona']);
        $this->assertSame('#123456', $events['Nuovo']['backgroundColor']);
        $icona->update(['classe' => 'fa-solid fa-heart']);
        $events = collect($this->get('/events')->assertOk()->json())->keyBy('title');
        $this->assertSame('fa-solid fa-heart', $events['Nuovo']['extendedProps']['icona']);
        $this->get(route('evento.modifica', $legacy->id))->assertOk();
        $this->get('/')->assertOk()->assertSee('eventContent', false);
        $this->actingAs(User::factory()->create())->get('/dashboard')
            ->assertOk()->assertSee('eventContent', false)
            ->assertSee('icon.style.color = arg.event.backgroundColor', false)
            ->assertSee('.evento-con-icona .fc-daygrid-event-dot', false);
    }

    public function test_empty_catalog_displays_instructions(): void
    {
        $this->get(route('evento.nuovo'))->assertOk()->assertSee('Non ci sono icone disponibili.');
    }
}
