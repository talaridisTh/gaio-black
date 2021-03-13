<div class="mt-8  overflow-x-auto">
    <table x-data="checked()"
           class="min-w-full table-auto">
        <thead class="justify-between">
        <tr class="dark:bg-gray-800">
            <th class="px-16 py-2">
                <div class=" p-thick mt-1">
                    <input x-ref="mainInput"
                           @click="selectAllCheckboxes()"
                           type="checkbox"/>
                </div>
            </th>

            <th class="px-16 py-2 cursor-pointer dark:text-white">
                <div class="flex">
                    <span wire:click="sortBy('first_name')"
                          class="text-gray-300">Ονοματεπωνυμο</span>

                    <x-sort-icon :sortBy="$sortBy"
                                 :sortDirection="$sortDirection"
                                 type="first_name"
                    />
                </div>
            </th>

            <th class="px-16 py-2 cursor-pointer  dark:text-white">
                <div class="flex">
                    <span wire:click="sortBy('email')"
                          class="text-gray-300">Email</span>

                    <x-sort-icon :sortBy="$sortBy"
                                 :sortDirection="$sortDirection"
                                 type="email"
                    />

                </div>
            </th>

            <th class="px-16 py-2">
                <span class="text-gray-300">Ρόλος</span>
            </th>

            <th class="px-16 py-2  cursor-pointer dark:text-white">
                <div class="flex">
                    <span wire:click="sortBy('created_at')"
                          class="text-gray-300">Created</span>

                    <x-sort-icon :sortBy="$sortBy"
                                 :sortDirection="$sortDirection"
                                 type="created_at"
                    />
                </div>
            </th>

            <th class="px-16 py-2  cursor-pointer dark:text-white">
                <div class="flex">
                    <span wire:click="sortBy('updated_at')"
                          class="text-gray-300">Update</span>
                    <x-sort-icon :sortBy="$sortBy"
                                 :sortDirection="$sortDirection"
                                 type="updated_at"/>
                </div>
            </th>

            <th class="px-16 py-2">
                <span class="text-gray-300">Action</span>
            </th>

        </tr>
        </thead>

        <tbody class="dark:bg-gray-800">

        <div class="flex justify-end  px-16">
            <a href="{{route('users.create')}}">
                <button class="button w-24 mr-1 mb-2 bg-blue-700 transition ease-in duration-100 hover:bg-blue-800 text-white">
                    Create
                </button>
            </a>

        </div>

        <div wire:ignore
             class="flex justify-between items-center px-16">

            <x-select2 name="filter-entries"
                       id="filter-entries">
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="100">100</option>
                <option value="1000">Όλα</option>

                <x-slot name="attr"></x-slot>

            </x-select2>

            <div class="relative text-gray-600 focus-within:text-gray-400">
                  <span class="absolute inset-y-4 top-2 left-0 flex items-center pl-2">
                    <button type="submit"
                            class="p-1 focus:outline-none focus:shadow-outline">
                        <i class="w-5"
                           data-feather="search"></i>
                     </button>
                  </span>

                <input wire:model.debounce.750ms="search"
                       type="search"
                       class="py-2 mb-2 text-sm text-white bg-gray-900 rounded-md pl-10 focus:outline-none focus:bg-white focus:text-gray-900"
                       placeholder="Search..."
                       autocomplete="off">
            </div>

        </div>

        @foreach($users as $user)
            <tr class="dark:bg-gray-800 bg-white p-5 dark:text-gray-300 border @if($loop->first)border-t-2 @endif border-l-0 border-r-0 border-gray-200">
                <td class="px-16 py-2 flex flex-row items-center">
                    <div class="p-thick mt-1">
                        <input @click="checkedMainInput()"
                               id="checkbox{{$loop->index+1}}"
                               type="checkbox"/>
                    </div>
                </td>
                <td>
                    <span class="text-center ml-2 font-semibold">{{$user->fullname}}</span>
                </td>
                <td class="px-16 py-2">
                    <span class="text-center ml-2 font-semibold">{{$user->email}}</span>
                </td>
                <td class="px-16 py-2">
                    <span>User</span>
                </td>
                <td class="px-16 py-2">
                    <span>{{$user->created_at->format('d/m/Y')}}</span>
                </td>
                <td class="px-16 py-2">
              <span class="">
                  {{$user->updated_at->format('d/m/Y')}}
              </span>
                </td>
                <td class="px-16 py-2">
              <span class="">
              </span>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
    <div class="mt-5">
        {{ $users->links() }}
    </div>

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

