<?php

namespace Tests\Feature;

use App\Models\Information;
use App\Models\Storage;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class InformationTest extends TestCase {

    use RefreshDatabase;

    /** @test */
    public function can_see_current_date_as_default_field()
    {

        Livewire::test("admin.storage.storage")
            ->set("date", date("d/m/Y"))
            ->assertPayloadSet("date", date('d/m/Y'));

    }

    /** @test */
    public function can_save_description_field()
    {
        Storage::factory()->create([
            "id" => 1,
            "name" => "bar",
        ]);
        Livewire::test("admin.storage.storage")
            ->call("fillField", 1, 0)
            ->set("quantity.0", 5)
            ->set("description", "foo")
            ->set("date", date("d/m/Y"))
            ->call("addProduct");
        $this->assertTrue(Information::where("description", "foo")->exists());

    }

    /** @test */
    public function can_save_publish_at()
    {
        Storage::factory()->create([
            "id" => 1,
            "name" => "bar",
        ]);
        Livewire::test("admin.storage.storage")
            ->call("fillField", 1, 0)
            ->set("quantity.0", 5)
            ->set("date", date("d/m/Y"))
            ->set("description", "foo")
            ->call("addProduct");
        $this->assertTrue(Information::where("description", "foo")->first()->publish_at != null);

    }

    /** @test */
    public function can_reset_description_after_save()
    {
        Storage::factory()->create([
            "id" => 1,
            "name" => "bar",
        ]);
        Livewire::test("admin.storage.storage")
            ->call("fillField", 1, 0)
            ->set("quantity.0", 5)
            ->set("description", "foo")
            ->set("date", date("d/m/Y"))
            ->call("addProduct")
            ->assertSet("description", null);
    }

    /** @test */
    public function can_reset_date_after_save()
    {
        Storage::factory()->create([
            "id" => 1,
            "name" => "bar",
        ]);
        Livewire::test("admin.storage.storage")
            ->call("fillField", 1, 0)
            ->set("quantity.0", 5)
            ->set("description", "foo")
            ->set("date", date("d/m/Y"))
            ->call("addProduct")
            ->assertSet("date", date("d/m/Y"));
    }

    /** @test */
    public function can_save_with_blank_description()
    {
        Storage::factory()->create([
            "id" => 1,
            "name" => "bar",
        ]);
        Livewire::test("admin.storage.storage")
            ->call("fillField", 1, 0)
            ->set("quantity.0", 5)
            ->set("date", date("d/m/Y"))
            ->call("addProduct");
        $this->assertTrue(Information::where("id", 1)->first()->description == null);
    }

    /** @test */
    public function can_save_quantity_in_pivot_table()
    {
        Storage::factory()->create([
            "id" => 1,
            "name" => "bar",
        ]);
        Livewire::test("admin.storage.storage")
            ->call("fillField", 1, 0)
            ->set("quantity.0", 5)
            ->set("date", date("d/m/Y"))
            ->call("addProduct");
        $this->assertTrue(Information::where("id", 1)->first()->storages()->first()->quantity == 5);
    }

    /** @test */
    public function can_count_product_in_one_order()
    {
        Storage::factory()->count(10)->create();
        Livewire::test("admin.storage.storage")
            ->call("fillField", 1, 0)
            ->call("fillField", 2, 1)
            ->call("fillField", 3, 2)
            ->set("quantity.0", 5)
            ->set("quantity.1", 5)
            ->set("quantity.2", 5)
            ->set("date", date("d/m/Y"))
            ->call("addProduct");
        $this->assertTrue(Information::where("id", 1)->first()->storages()->count() == 3);
    }

    /** @test */
    public function can_create_two_information()
    {
        Storage::factory()->count(10)->create();
        Livewire::test("admin.storage.storage")
            ->call("fillField", 1, 0)
            ->set("quantity.0", 5)
            ->set("date", date("d/m/Y"))
            ->call("addProduct")
            ->call("fillField", 1, 0)
            ->set("quantity.0", 5)
            ->set("date", date("d/m/Y"))
            ->call("addProduct");
        $this->assertTrue(Information::where("id", 1)->exists(), Information::where("id", 2)->exists());
    }

}