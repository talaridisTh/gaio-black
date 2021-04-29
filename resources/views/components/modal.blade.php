<div
 class="absolute z-30 bottom-1/2 -translate-x-1/3 left-1/3 -translate-y-1/2 z-50 shadow-2xl">
    <div x-data="{isOpen:false , event:[] , info:''}"
         x-show.transition.opacity.duration.400ms="isOpen"
         @modal.window="isOpen = true,
         event = $event.detail.sales ? $event.detail.sales : $event.detail.storages,
         info = $event.detail"
         @click.away="isOpen=false , $dispatch('overlay',{overlay:false})"
         class="border w-54rem h-96 dark:bg-gray-700 text-white p-2 scrollbar scrollbar-thumb-gray-900 scrollbar-track-gray-100">
        <table class="table-fixed w-full text-lg">
            <h3 :class="{'hidden':!info.description}"
                x-html="info.description??''"
                class="mb-5 border-b border-dotted"></h3>
            <h3 :class="{'hidden':!info.total}"
                x-text=`Συνολο:${info.total??''}`
                class="mb-5 border-b border-dotted text-green-300 font-semibold"></h3>
            <tbody class="divide-y divide-white">
            <tr>
                <th class="w-1/4">
                    <span class="text-gray-300 flex cursor-pointer">id</span>
                </th>

                <th class="w-2/4">
                    <span class="text-gray-300 flex cursor-pointer">name</span>
                </th>

                <th class="w-1/4">
                    <span class="text-gray-300 flex cursor-pointer">Ποσότητα</span>
                </th>

                <th class="w-1/4">
                    <span class="text-gray-300 flex cursor-pointer">Μ.Μ</span>
                </th>

                <th class="w-1/4">
                    <span class="text-gray-300 flex cursor-pointer">Τιμή</span>
                </th>


            </tr>
            <template x-for="(item, index) in event" :key="index">

                <tr class="border-gray-200">

                    <td>
                        <span x-text="index+1" class="cursor-pointer font-semibold"></span>
                    </td>

                    <td>
                        <span x-text="item.name" class="cursor-pointer font-semibold"></span>
                    </td>

                    <td>
                        <span x-text="item.pivot.quantity" class="font-semibold"></span>
                    </td>
                    <td>
                        <span x-text="item.mm" class="font-semibold"></span>
                    </td>

                    <td>
                        <span x-text="item.price" class="font-semibold"></span>
                    </td>

                </tr>

            </template>
            </tbody>

        </table>

    </div>
</div>

