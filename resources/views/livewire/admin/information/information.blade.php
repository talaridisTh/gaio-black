<div class="mt-8 w-full overflow-x-auto">
    <style>
        .pika-single {
            position: absolute;
            border-radius: 10px;
        }
    </style>
    <form wire:submit.prevent="submit" wire:ignore x-data="{isOpen : false}"
          class="calendar flex justify-end px-16 my-3">
        <div @click.away="isOpen = false">
            <div class="calendar__inputs flex space-x-3">
                <div x-show="isOpen" class="flex justify-end space-x-3 my-3">
                    <x-button type="button" wire:click="resetDate" class="calendar__reset" id="calendar-clear"
                              background="red">Reset
                    </x-button>
                </div>
                <input @click="isOpen=true"
                       wire:model.lazy="startDate"
                       class="calendar__input  pl-4 pr-10 py-3 leading-none rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-white dark:bg-gray-800 font-medium"
                       readonly="readonly" type="text" id="calendar-start" placeholder="Start Date">

                <input
                 wire:model.lazy="endDate"
                 class="calendar__input  pl-4 pr-10 py-3 leading-none rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-white dark:bg-gray-800 font-medium"
                 readonly="readonly" type="text" id="calendar-end" placeholder="End Date">
            </div>
            <div x-show="isOpen" class="calendar__pikaday max-w-17rem mt-2" id="calendar-container"></div>
        </div>
    </form>

    <x-table.table>

        <x-slot name="head">
            <x-table.table-th>
                <input x-ref="mainInput"
                       @click="selectAllCheckboxes()"
                       type="checkbox" />
            </x-table.table-th>

            <x-table.table-th>
                <span wire:click="sortBy('id')"
                      class="text-gray-300 flex cursor-pointer">
                    id
                    <x-sort-icon :sortBy="$sortBy"
                                 :sortDirection="$sortDirection"
                                 type="id" /></span>
            </x-table.table-th>


            <x-table.table-th>
                    <span class="text-gray-300 flex cursor-pointer">
                        Ποσότητα
                    </span>
            </x-table.table-th>


            <x-table.table-th>
                    <span wire:click="sortBy('publish_at')"
                          class="text-gray-300 flex cursor-pointer">create
                <x-sort-icon :sortBy="$sortBy"
                             :sortDirection="$sortDirection"
                             type="publish_at" />
                    </span>
            </x-table.table-th>

            <x-table.table-th>
                <span class="text-gray-300 flex">Action</span>
            </x-table.table-th>

        </x-slot>

        <x-slot name="body">

            @forelse($information as $item)

                <x-table.table-tr wire:key="{{ $item->id }}"
                                  class="border border-l-0 border-r-0 border-gray-200 @if($loop->first)border-t-2 @endif">
                    <x-table.table-td class="flex  justify-center">
                        <label for="checkbox{{$loop->index+1}}"
                               class="p-thick mt-1">
                            <input @click="checkedMainInput()"
                                   id="checkbox{{$loop->index+1}}"
                                   type="checkbox" />
                        </label>
                    </x-table.table-td>

                    <x-table.table-td>
                        <span class="cursor-pointer text-center ml-2 font-semibold">{{$item->id}}</span>
                    </x-table.table-td>

                    <x-table.table-td>
                        <span class="text-center ml-2 font-semibold">{{$item->storages->count()}}</span>
                    </x-table.table-td>

                    <x-table.table-td>
                        <span class="text-center ml-2 font-semibold">{{$item->publish}}</span>
                    </x-table.table-td>


                    <x-table.table-td class="flex space-x-2">
                        <span  class="flex space-x-3" @click="$dispatch('modal',{{$item}}), $dispatch('overlay',{overlay:true})">
                            <span  class="hover:scale-105 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor">
                                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                           d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                           </span>
                        </span>
                    </x-table.table-td>
                </x-table.table-tr>



            @empty

            @endforelse

        </x-slot>

    </x-table.table>

</div>

@push("scripts")
    <script>

        function checked() {
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


        // Builds two pikaDay calendars and uses the startRange and endRange functions
        // Pikaday is a Lightweight and dependency free datepicker
        // https://github.com/Pikaday/Pikaday
        this.buildDatePicker = (startInput, endInput) => {
            const container = document.getElementById('calendar-container');
            const minDate = new Date();
            minDate.setHours(0, 0, 0, 0);

            this.startPicker = new Pikaday({
                bound: false,
                container: container,
                field: startInput,
                firstDay: 1,
                theme: 'calendar__start-wrapper',

                onSelect: () => {
                    this.updateStartDate(this.startPicker.getDate());
                }
            });


            this.endPicker = new Pikaday({
                bound: false,
                container: container,
                field: endInput,
                firstDay: 1,
                theme: 'calendar__end-wrapper',
                minDate: minDate,
                onSelect: () => {
                    this.updateEndDate(this.endPicker.getDate());
                }
            });

            this.endPicker.hide();
            this.bindReset(startInput, endInput);
            this.bindMouseMove(endInput, container);
        };

        this.updateStartDate = (selectedDate) => {
            this.startPicker.hide();
            this.endPicker.setMinDate(selectedDate);
            this.endPicker.setStartRange(selectedDate);
            this.endPicker.gotoDate(selectedDate);
            this.setEndRange(selectedDate);
            this.endPicker.show();
        };

        this.updateEndDate = (selectedDate) => {
            this.endDate = new Date(selectedDate);
            console.log('set end date');
            console.log(selectedDate);
            this.setEndRange(selectedDate);
        }

        this.setEndRange = (endDate) => {
            this.endPicker.setEndRange(endDate);
            this.endPicker.draw();
        }

        this.bindReset = (startInput, endInput) => {
            const reset = document.getElementById('calendar-clear');
            reset.addEventListener('click', (event) => {
                event.preventDefault();

                this.endPicker.setDate(null);
                this.updateEndDate(null);
                endInput.value = null;

                this.startPicker.setDate(null);
                this.updateStartDate(null);
                this.startPicker.gotoDate(new Date());
                startInput.value = null;

                this.endPicker.hide();
                this.startPicker.show();
            });
        }

        this.bindMouseMove = (endInput, container) => {
            this.target = false;

            document.querySelector('body').addEventListener('mousemove', (btn) => {
                if (!btn.target.classList.contains('pika-button')) {
                    if (this.target === true) {
                        this.target = false;
                        this.setEndRange(this.endPicker.getDate());
                    }
                } else {
                    this.target = true;
                    const pikaBtn = btn.target;
                    const pikaDate = new Date(pikaBtn.getAttribute('data-pika-year'), pikaBtn.getAttribute('data-pika-month'), pikaBtn.getAttribute('data-pika-day'));
                    this.setEndRange(pikaDate);
                }
            });
        }

        const start = document.getElementById('calendar-start');
        const end = document.getElementById('calendar-end');

        this.buildDatePicker(start, end);


    </script>
@endpush

{{--@foreach($item->storages as $storage)--}}
{{--    <x-table.table-tr wire:key="{{$storage->id}}" x-data="{isOpen:true}"--}}
{{--                      x-init="console.log($el)"--}}
{{--                      x-show="isOpen"--}}
{{--                      --}}{{--@click.away="isOpen=false"--}}
{{--                      @accordeon.window="event.detail.id==$el.id?isOpen=!isOpen:''"--}}
{{--                      id="{{$item->id}}"--}}
{{--                      class="fold">--}}
{{--        <x-table.table-td >--}}
{{--            <div class="flex flex-col items-start mx-36 px-5">--}}
{{--                                <span--}}
{{--                                 class="dark:text-gray-300 text-center ml-2 font-semibold">{{$storage->name}}</span>--}}
{{--            </div>--}}
{{--        </x-table.table-td>--}}
{{--        <x-table.table-td >--}}
{{--            <div class="flex flex-col items-start mx-36 px-5">--}}
{{--                                <span--}}
{{--                                 class="dark:text-gray-300 text-center ml-2 font-semibold">{{$storage->pivot->quantity}}</span>--}}
{{--            </div>--}}
{{--        </x-table.table-td>--}}
{{--        <x-table.table-td >--}}
{{--            <div class="flex flex-col items-start mx-36 px-5">--}}
{{--                                <span--}}
{{--                                 class="dark:text-gray-300 text-center ml-2 font-semibold">{{$item->pivot}}</span>--}}
{{--            </div>--}}
{{--        </x-table.table-td>--}}

{{--    </x-table.table-tr>--}}
{{--@endforeach--}}