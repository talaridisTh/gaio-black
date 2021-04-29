<?php

namespace Tests\Feature;

use App\Models\Information;
use App\Models\Storage;
use App\Models\User;
use Livewire\Livewire;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StorageRemoveTest extends TestCase {

    use RefreshDatabase;
    /** @test */
    public function can_see_livewire_component_on_remove_storage_page()
    {
        $user = User::factory()->create();
        $this->actingAs($user)
            ->withoutExceptionHandling()
            ->get("/storage/remove")
            ->assertSuccessful()
            ->assertSeeLivewire("admin.storage.remove-storage");
    }

    /** @test */
    public function can_fill_correct_mm_when_select_an_name()
    {
        Storage::factory()->create([
            "id" => 1,
            "name" => "bar",
            "mm" => "foo",
        ]);
        Livewire::test("admin.storage.remove-storage")
            ->call("fillField", 1, 0)
            ->assertSet("mm.0", "foo");

    }

    /** @test */
    public function can_fill_correct_price_when_select_an_name()
    {
        Storage::factory()->create([
            "id" => 1,
            "name" => "bar",
            "price" => 2,
        ]);
        Livewire::test("admin.storage.remove-storage")
            ->call("fillField", 1, 0)
            ->assertSet("price.0", 2);
    }
//
    /** @test */
    public function can_fill_quantity_equal_to_zero_as_default_parametr()
    {
        Storage::factory()->create([
            "id" => 1,
            "name" => "bar",
        ]);
        Livewire::test("admin.storage.remove-storage")
            ->call("fillField", 1, 0)
            ->assertSet("quantity.0", 0);
    }
//
    /** @test */
    public function can_fill_offer_equal_to_zero_as_default_parametr()
    {
        Storage::factory()->create([
            "id" => 1,
            "name" => "bar",
        ]);
        Livewire::test("admin.storage.remove-storage")
            ->call("fillField", 1, 0)
            ->assertSet("offer.0", 0);
    }
//
    /** @test */
    public function can_fill_total_equal_to_zero_as_default_parametr()
    {
        Storage::factory()->create([
            "id" => 1,
            "name" => "bar",
        ]);
        Livewire::test("admin.storage.remove-storage")
            ->call("fillField", 1, 0)
            ->assertSet("total.0", 0);
    }

    /** @test */
    public function can_update_item_quantity()
    {
        Storage::factory()->create([
            "id" => 1,
            "name" => "bar",
            "quantity" => 10
        ]);
        Livewire::test("admin.storage.remove-storage")
            ->call("fillField", 1, 0)
            ->set("quantity.0", 5)
            ->set("date", date("d/m/Y"))
            ->call("addProduct");
        $this->assertTrue(Storage::where("name", "bar")->first()->quantity == 5);
    }

    /** @test */
    public function can_update_item_quantity_and_show_event()
    {
        Storage::factory()->create([
            "id" => 1,
            "name" => "bar",
            "quantity" => 10
        ]);
        Livewire::test("admin.storage.remove-storage")
            ->call("fillField", 1, 0)
            ->set("quantity.0", 5)
            ->set("date", date("d/m/Y"))
            ->call("addProduct")
            ->assertEmitted("event-product");

    }

    /** @test */
    public function check_if_field_is_null_before_update_an_item()
    {
        Storage::factory()->create([
            "id" => 1,
            "name" => "bar",
            "quantity" => 10
        ]);
        Livewire::test("admin.storage.remove-storage")
            ->call("fillField", 1, 0)
            ->set("quantity.0", 5)
            ->assertNotSet("name.0", null);

    }

    /** @test */
    public function can_reset_field_after_update_an_item()
    {
        Storage::factory()->create([
            "id" => 1,
            "name" => "bar",
            "quantity" => 10
        ]);
        Livewire::test("admin.storage.remove-storage")
            ->call("fillField", 1, 0)
            ->set("quantity.0", 5)
            ->set("date", date("d/m/Y"))
            ->call("addProduct")
            ->assertSet("name.0", null)
            ->assertSet("row", 0);
    }

    /** @test */
    public function can_see_two_or_more_row()
    {
        Storage::factory()->create([
            "id" => 1,
            "name" => "bar",
            "quantity" => 10
        ]);
        Storage::factory()->create([
            "id" => 2,
            "name" => "baz",
            "quantity" => 3
        ]);
        Livewire::test("admin.storage.remove-storage")
            ->call("fillField", 1, 0)
            ->call("plusRow")
            ->call("fillField", 2, 1)
            ->assertSet("name.0", "bar")
            ->assertSet("name.1", "baz");
    }

    /** @test */
    public function can_update_two_row()
    {
        Storage::factory()->create([
            "id" => 1,
            "name" => "bar",
            "quantity" => 10
        ]);
        Storage::factory()->create([
            "id" => 2,
            "name" => "baz",
            "quantity" => 3
        ]);
        Livewire::test("admin.storage.remove-storage")
            ->call("fillField", 1, 0)
            ->set("quantity.0", 5)
            ->call("plusRow")
            ->call("fillField", 2, 1)
            ->set("quantity.1", 2)
            ->set("date", date("d/m/Y"))
            ->call("addProduct");
        $this->assertTrue(Storage::where("name", "bar")->first()->quantity == 5);
        $this->assertTrue(Storage::where("name", "baz")->first()->quantity == 1);

    }

    /** @test */
    public function can_remove_one_row()
    {
        Storage::factory()->create([
            "id" => 1,
            "name" => "bar",
        ]);
        Storage::factory()->create([
            "id" => 2,
            "name" => "baz",
        ]);
        Livewire::test("admin.storage.remove-storage")
            ->call("fillField", 1, 0)
            ->call("plusRow")
            ->call("fillField", 2, 1)
            ->call("minusRow", 1)
            ->assertSet("name.0", "bar")
            ->assertNotSet("name.1", "baz");
    }

    /** @test */
    public function cannot_remove_if_has_one_row()
    {
        Storage::factory()->create([
            "id" => 1,
            "name" => "bar",
        ]);
        Storage::factory()->create([
            "id" => 2,
            "name" => "baz",
        ]);
        Livewire::test("admin.storage.remove-storage")
            ->call("fillField", 1, 0)
            ->call("plusRow")
            ->call("fillField", 2, 1)
            ->call("minusRow", 1)
            ->call("minusRow", 2)
            ->assertSet("name.0", "bar")
            ->assertNotSet("name.1", "baz");
    }

    /** @test */
    public function can_remove_two_row_if_exist_three()
    {
        Storage::factory()->create([
            "id" => 1,
            "name" => "bar",
        ]);
        Storage::factory()->create([
            "id" => 2,
            "name" => "baz",
        ]);
        Storage::factory()->create([
            "id" => 3,
            "name" => "foo",
        ]);
        Livewire::test("admin.storage.remove-storage")
            ->call("fillField", 1, 0)
            ->call("plusRow")
            ->call("fillField", 2, 1)
            ->call("plusRow")
            ->call("fillField", 3, 2)
            ->call("minusRow", 1)
            ->call("minusRow", 2)
            ->assertSet("name.0", "bar")
            ->assertNotSet("name.1", "baz")
            ->assertNotSet("name.2", "foo");
    }

    /** @test */
    public function can_delete_field_and_field_again()
    {
        Storage::factory()->create([
            "id" => 1,
            "name" => "bar",
        ]);
        Storage::factory()->create([
            "id" => 2,
            "name" => "baz",
        ]);
        Storage::factory()->create([
            "id" => 3,
            "name" => "foo",
        ]);
        Storage::factory()->create([
            "id" => 4,
            "name" => "foz",
        ]);
        Livewire::test("admin.storage.remove-storage")
            ->call("fillField", 1, 0)
            ->call("plusRow")
            ->call("fillField", 2, 1)
            ->call("plusRow")
            ->call("fillField", 3, 2)
            ->call("minusRow", 1)
            ->call("fillField", 4, 1)
            ->assertSet("name.1", "foz")
            ->assertNotSet("name.1", "baz");
    }

    /** @test */
    public function can_delete_field_fill_with_other_and_update()
    {
        Storage::factory()->create([
            "id" => 1,
            "name" => "bar",
        ]);
        Storage::factory()->create([
            "id" => 2,
            "name" => "baz",
        ]);
        Storage::factory()->create([
            "id" => 3,
            "name" => "foo",
        ]);
        Storage::factory()->create([
            "id" => 4,
            "name" => "foz",
            "quantity" => 10
        ]);
        Livewire::test("admin.storage.remove-storage")
            ->call("fillField", 1, 0)
            ->call("plusRow")
            ->call("fillField", 2, 1)
            ->call("plusRow")
            ->call("fillField", 3, 2)
            ->call("minusRow", 1)
            ->call("fillField", 4, 1)
            ->set("quantity.0", 5)
            ->set("quantity.1", 5)
            ->set("quantity.2", 5)
            ->set("quantity.3", 5)
            ->set("date", date("d/m/Y"))
            ->call("addProduct");
//
        $this->assertTrue(Storage::where("name", "foz")->first()->quantity == 5);
    }

    /** @test */
    public function cannot_add_field_if_all_field_are_not_full()
    {

        Livewire::test("admin.storage.remove-storage")
            ->call("plusRow")
            ->assertEmitted("event-plus-row");
    }

    /** @test */
    public function cannot_add_field_when_remove_field_until_field_again()
    {
        Storage::factory()->create([
            "id" => 1,
            "name" => "bar",
        ]);
        Storage::factory()->create([
            "id" => 2,
            "name" => "baz",
        ]);
        Livewire::test("admin.storage.remove-storage")
            ->call("fillField", 1, 0)
            ->call("plusRow")
            ->call("fillField", 2, 1)
            ->call("minusRow", 0)
            ->call("plusRow")
            ->assertEmitted("event-plus-row");
    }
    /** @test */
    public function can_fill_total_when_fill_quantity()
    {
        Storage::factory()->create([
            "id" => 1,
            "name" => "bar",
            "price"=>5
        ]);
        Livewire::test("admin.storage.remove-storage")
            ->call("fillField", 1, 0)
            ->set("quantity.0",5)
            ->call("totalUpdate",0)
            ->assertSet("total.0",25);
    }

    /** @test */
    public function can_fill_total_when_fill_quantity_and_price()
    {
        Storage::factory()->create([
            "id" => 1,
            "name" => "bar",
        ]);
        Livewire::test("admin.storage.remove-storage")
            ->call("fillField", 1, 0)
            ->set("quantity.0",5)
            ->set("price.0",5)
            ->call("totalUpdate",0)
            ->assertSet("total.0",25);
    }

    /** @test */
    public function can_fill_total_when_fill_quantity_and_change_price()
    {
        Storage::factory()->create([
            "id" => 1,
            "name" => "bar",
            "price" => 2,
        ]);
        Livewire::test("admin.storage.remove-storage")
            ->call("fillField", 1, 0)
            ->set("quantity.0",5)
            ->set("price.0",5)
            ->call("totalUpdate",0)
            ->assertSet("total.0",25);
    }


    /** @test */
    public function can_fill_total_when_fill_quantity_and_offer()
    {
        Storage::factory()->create([
            "id" => 1,
            "name" => "bar",
            "price" => 5,
        ]);
        Livewire::test("admin.storage.remove-storage")
            ->call("fillField", 1, 0)
            ->set("quantity.0",5)
            ->set("offer.0",50)
            ->call("totalUpdate",0)
            ->assertSet("total.0",12.5);
    }

    /** @test */
    public function can_fill_totalall()
    {
        Storage::factory()->create([
            "id" => 1,
            "name" => "bar",
            "price" => 5,
        ]);
        Storage::factory()->create([
            "id" => 2,
            "name" => "foo",
            "price" => 5,
        ]);
        Livewire::test("admin.storage.remove-storage")
            ->call("fillField", 1, 0)
            ->set("quantity.0",5)
            ->call("totalUpdate",0)
            ->call("plusRow")
            ->call("fillField", 2, 1)
            ->set("quantity.1",5)
            ->call("totalUpdate",1)
            ->assertSet("totalAll",50);
    }



//todo na to dw otan dw ta videok
//    /** @test */
//    public function can_see_search_resault_when_write_on_input_name_field()
//    {
//        Storage::factory()->create([
//            "name" => "bar",
//        ]);
//        Livewire::test("admin.storage.remove-storage")
//            ->assertDispatchedBrowserEvent('keydown', "thanos");
//    }
//    /** @test */
//    public function can_see_five_entries_in_datatable()
//    {
//        Storage::factory()->count(100)->create([
//            "name"=>"foo"
//        ]);
//       $test = Livewire::test("admin.storage.show-storage")
//            ->set("entries", 5);
//    }

}