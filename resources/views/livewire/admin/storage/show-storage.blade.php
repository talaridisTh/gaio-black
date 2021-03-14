<div class="mt-8  overflow-x-auto">

    <x-table.table>

        <x-slot name="head">

            <x-table.table-th>
                <input x-ref="mainInput"
                       @click="selectAllCheckboxes()"
                       type="checkbox"/>
            </x-table.table-th>

            <x-table.table-th>
                <span wire:click="sortBy('name')"
                      class="text-gray-300 flex cursor-pointer">
                    Ονομα
                    <x-sort-icon :sortBy="$sortBy"
                                 :sortDirection="$sortDirection"
                                 type="name"
                    /></span>


            </x-table.table-th>

            <x-table.table-th>
                    <span wire:click="sortBy('mm')"
                          class="text-gray-300 flex cursor-pointer">
                        Μονάδα μέτρησης
                        <x-sort-icon :sortBy="$sortBy"
                                     :sortDirection="$sortDirection"
                                     type="mm"/>
                    </span>

            </x-table.table-th>

            <x-table.table-th>
                <span class="text-gray-300">Κώδικος προιοντος</span>
            </x-table.table-th>

            <x-table.table-th>
                    <span wire:click="sortBy('quantity')"
                          class="text-gray-300 flex cursor-pointer">
                        Ποσότητα
                <x-sort-icon :sortBy="$sortBy"
                             :sortDirection="$sortDirection"
                             type="quantity"/>
                    </span>


            </x-table.table-th>

            <x-table.table-th>
                    <span wire:click="sortBy('created_at')"
                          class="text-gray-300 flex cursor-pointer">Created
                <x-sort-icon :sortBy="$sortBy"
                             :sortDirection="$sortDirection"
                             type="created_at"/>
                    </span>
            </x-table.table-th>

            <x-table.table-th>
                    <span wire:click="sortBy('updated_at')"
                          class="text-gray-300 flex cursor-pointer">Update
                <x-sort-icon :sortBy="$sortBy"
                             :sortDirection="$sortDirection"
                             type="updated_at"/>
                    </span>
            </x-table.table-th>

            <x-table.table-th>
                <span class="text-gray-300 flex">Action</span>
            </x-table.table-th>

        </x-slot>

        <x-slot name="body">
            <div class="flex justify-end  px-16">
                <a href="{{route('users.create')}}">
                    <button class="button w-24 mr-1 mb-2 bg-blue-700 transition ease-in duration-100 hover:bg-blue-800 text-white">
                        Create
                    </button>
                </a>

            </div>

                @foreach($storage as $item)
                    <x-table.table-tr wire:key="{{ $item->id }}"  class="border border-l-0 border-r-0 border-gray-200 @if($loop->first)border-t-2 @endif">
                        <x-table.table-td class="flex  justify-center">
                            <label for="checkbox{{$loop->index+1}}"
                                   class="p-thick mt-1">
                                <input @click="checkedMainInput()"
                                       id="checkbox{{$loop->index+1}}"
                                       type="checkbox"/>
                            </label>
                        </x-table.table-td>
                        <x-table.table-td>
                    <span x-on:click="$dispatch('accordeon',{{$item}},console.log({{$item}}))"
                          class="cursor-pointer text-center ml-2 font-semibold">{{$item->name}}</span>
                        </x-table.table-td>
                        <x-table.table-td>
                            <span class="text-center ml-2 font-semibold">{{$item->mm}}</span>
                        </x-table.table-td>
                        <x-table.table-td>
                            <span class="text-center ml-2 font-semibold">{{$item->sku}}</span>
                        </x-table.table-td>
                        <x-table.table-td>
                            <span class="text-center ml-2 font-semibold">{{$item->quantity}}</span>
                        </x-table.table-td>
                        <x-table.table-td>
                            <span>{{$item->created_at->format('d/m/Y')}}</span>
                        </x-table.table-td>
                        <x-table.table-td>
                      <span class="">
                      {{$item->updated_at->format('d/m/Y')}}
                  </span>
                        </x-table.table-td>
                        <x-table.table-td>
                      <span class="">
                      </span>
                        </x-table.table-td>
                    </x-table.table-tr>

                    <x-table.table-tr x-data="{isOpen:false}"
                                      x-show="isOpen"
                                      @click.away="isOpen=false"
                                      @accordeon.window="event.detail.slug==$el.id?isOpen=true:''"
                                      id="{{$item->slug}}"
                                      class="fold">
                        <x-table.table-td colspan="8">
                            <div class="flex flex-col items-start mx-36 p-5">
                                <span class="dark:text-gray-300 text-center ml-2 font-semibold">{{$item->description}}</span>
                            </div>
                        </x-table.table-td>
                    </x-table.table-tr>
                @endforeach

        </x-slot>

    </x-table.table>


</div>

@push("scripts")
    <script>function checked() {
            return {

                selectall: false,

                selectAllCheckboxes() {
                    this.selectall = !this.selectall

                    checkboxes = document.querySelectorAll('[id^=checkbox]');
                    [...checkboxes].map((el) => {
                        el.checked = this.selectall;
                    })
                },

                checkedMainInput() {
                    let checkedAll = [],
                        checkboxes = document.querySelectorAll('[id^=checkbox]');
                    [...checkboxes].map((el) => {
                        checkedAll.push(el.checked)

                    })

                    checkedAll.every(Boolean) ? this.$refs.mainInput.checked = true : this.$refs.mainInput.checked = false;
                }
            }
        }

    </script>
@endpush

