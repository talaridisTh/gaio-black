<?php

namespace Tests\Feature;

use App\Models\Storage;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;
use function PHPUnit\Framework\assertTrue;

class StorageTest extends TestCase {

    use RefreshDatabase;

    /** @test */
    public function can_see_livewire_component_on_create_storage_page()
    {
        $user = User::factory()->create();
        $this->actingAs($user)
            ->withoutExceptionHandling()
            ->get("/storage/create")
            ->assertSuccessful()
            ->assertSeeLivewire("admin.storage.create-storage");
    }

    /** @test */
    public function can_create_storage_product()
    {
        Livewire::test("admin.storage.create-storage")
            ->set("name", "foo")
            ->set("sku", 2)
            ->set("mm", 2)
            ->set("price", 2)
            ->set("quantity", 2)
            ->call("submit")
            ->assertRedirect('/storage');
        $this->assertTrue(Storage::where("name", "foo")->exists());
    }

    /** @test */
    public function validate_name_field_has_error_real_time()
    {
        Livewire::test("admin.storage.create-storage")
            ->set("name")
            ->assertHasErrors(["name" => "required"]);
    }

    /** @test */
    public function validate_price_field_has_error()
    {
        Livewire::test("admin.storage.create-storage")
            ->set("price")
            ->call("submit")
            ->assertHasErrors(["price" => "required"]);
    }

    /** @test */
    public function validate_quantity_field_has_error_when_isn_t_numeric()
    {
        Livewire::test("admin.storage.create-storage")
            ->set("quantity", "s")
            ->call("submit")
            ->assertHasErrors(["quantity" => "numeric"]);
    }

    /** @test */
    public function can_see_livewire_component_on_show_storage_page()
    {
        $user = User::factory()->create();
        $this->actingAs($user)
            ->withoutExceptionHandling()
            ->get("/storage")
            ->assertSuccessful()
            ->assertSeeLivewire("admin.storage.show-storage");
    }

    /** @test */
    public function can_search_in_datatable_for_first_name()
    {
        $storageA = Storage::factory()->create([
            "name" => "foo"
        ]);
        Livewire::test("admin.storage.show-storage")
            ->set("search", "foo")
            ->assertSee($storageA->name);

    }

    /** @test */
    public function can_order_first_name_datatable()
    {
        Storage::factory()->create([
            "name" => "bar"
        ]);
        Storage::factory()->create([
            "name" => "foo"
        ]);
        Storage::factory()->create([
            "name" => "google"
        ]);
        Livewire::test("admin.storage.show-storage")
            ->call("sortBy", "name")
            ->call("sortBy", "name")
            ->assertSeeInOrder(["bar", "foo", "google"]);
    }

    /** @test */
    public function can_destroy_storage()
    {
        Storage::factory()->create([
            "id" => 1,
            "name" => "bar"
        ]);
        Livewire::test("admin.storage.show-storage")
            ->call("deleteStorage", 1);
        $this->assertFalse(Storage::whereName('bar')->exists());

    }

    /** @test */
    public function can_see_message_when_update_an_storage_item()
    {
        Storage::factory()->create([
            "name" => "bar",
        ]);
        Livewire::test("admin.storage.update-storage")
            ->set("name", "foo")
            ->set("price", 2)
            ->set("quantity", 4)
            ->call("updateStorage")
            ->assertEmitted("update-event");
    }

    /** @test */
    public function can_see_livewire_component_on_add_storage_page()
    {
        $user = User::factory()->create();
        $this->actingAs($user)
            ->withoutExceptionHandling()
            ->get("/storage/add")
            ->assertSuccessful()
            ->assertSeeLivewire("admin.storage.storage");
    }

    /** @test */
    public function can_fill_correct_mm_when_select_an_name()
    {
        Storage::factory()->create([
            "id" => 1,
            "name" => "bar",
            "mm" => "foo",
        ]);
        Livewire::test("admin.storage.storage")
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
        Livewire::test("admin.storage.storage")
            ->call("fillField", 1, 0)
            ->assertSet("price.0", 2);
    }

    /** @test */
    public function can_fill_quantity_equal_to_zero_as_default_parametr()
    {
        Storage::factory()->create([
            "id" => 1,
            "name" => "bar",
        ]);
        Livewire::test("admin.storage.storage")
            ->call("fillField", 1, 0)
            ->assertSet("quantity.0", 0);
    }

    /** @test */
    public function can_update_item_quantity()
    {
        Storage::factory()->create([
            "id" => 1,
            "name" => "bar",
            "quantity" => 10
        ]);
        Livewire::test("admin.storage.storage")
            ->call("fillField", 1, 0)
            ->set("quantity.0", 5)
            ->set("date", date("d/m/Y"))
            ->call("addProduct");
        $this->assertTrue(Storage::where("name", "bar")->first()->quantity == 15);
    }

    /** @test */
    public function can_update_item_quantity_and_show_event()
    {
        Storage::factory()->create([
            "id" => 1,
            "name" => "bar",
            "quantity" => 10
        ]);
        Livewire::test("admin.storage.storage")
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
        Livewire::test("admin.storage.storage")
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
        Livewire::test("admin.storage.storage")
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
        Livewire::test("admin.storage.storage")
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
        Livewire::test("admin.storage.storage")
            ->call("fillField", 1, 0)
            ->set("quantity.0", 5)
            ->call("plusRow")
            ->call("fillField", 2, 1)
            ->set("quantity.1", 2)
            ->set("date", date("d/m/Y"))
            ->call("addProduct");
        $this->assertTrue(Storage::where("name", "bar")->first()->quantity == 15);
        $this->assertTrue(Storage::where("name", "baz")->first()->quantity == 5);

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
        Livewire::test("admin.storage.storage")
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
        Livewire::test("admin.storage.storage")
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
        Livewire::test("admin.storage.storage")
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
        Livewire::test("admin.storage.storage")
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
        Livewire::test("admin.storage.storage")
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
        $this->assertTrue(Storage::where("name", "foz")->first()->quantity == 15);
    }

    /** @test */
    public function cannot_add_field_if_all_field_are_not_full()
    {

        Livewire::test("admin.storage.storage")
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
        Livewire::test("admin.storage.storage")
            ->call("fillField", 1, 0)
            ->call("plusRow")
            ->call("fillField", 2, 1)
            ->call("minusRow", 0)
            ->call("plusRow")
            ->assertEmitted("event-plus-row");
    }





//todo na to dw otan dw ta videok
//    /** @test */
//    public function can_see_search_resault_when_write_on_input_name_field()
//    {
//        Storage::factory()->create([
//            "name" => "bar",
//        ]);
//        Livewire::test("admin.storage.storage")
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
