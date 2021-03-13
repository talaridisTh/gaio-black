<form wire:submit.prevent="submit"
      class="p-8 grid grid-cols-6  gap-5  ">
    <x-card class="col-span-4  grid grid-cols-3 gap-2">
        <div class="rounded-md py-5 px-2 col-span-1">
            <div class="w-40 h-40 relative image-fit cursor-pointer zoom-in ">
                <img class="rounded-md"
                     alt="Midone Tailwind HTML Admin Template"
                     src="https://placeimg.com/640/480/any">
                <div class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-theme-6 right-0 top-0 -mr-2 -mt-2">
                    <x-feathericon-x-circle/>
                </div>
            </div>
            <div class="w-40  cursor-pointer relative ">
                <button type="button"
                        class="button w-full bg-theme-1 text-white">Change Photo
                </button>
                <input type="file"
                       class="w-full h-full top-0 left-0 absolute opacity-0">
            </div>
        </div>
        <div class="flex flex-wrap col-span-2">
            <x-input class="flex-1"
                     id="first_name"
                     value="Ονομα"/>
            <x-input class="flex-1 "
                     id="last_name"
                     value="Επίθετο"/>
            <x-input wire:model="email"
                     class="w-full mt-3"
                     id="email"
                     value="Email">
                <x-slot name="feather">
                    <x-feathericon-mail/>
                </x-slot>
            </x-input>
            <x-input class="w-full mt-3"
                     id="profile"
                     value="Προφίλ"
                     type="textarea">
            </x-input>

        </div>
    </x-card>

    <x-card class="col-span-2 ">
        <div class="flex flex-wrap">
            <x-input class="w-full"
                     id="password"
                     value="Password"/>
            <x-input class="w-full mt-3"
                     id="confirm_password"
                     value="Confirm password"/>
        </div>
    </x-card>

    <x-card class="col-start-1 col-end-3 row-span-1">
        <x-input id="role"
                 value="Ρόλος"
                 type="select"
                 :user="$users">
        </x-input>
    </x-card>

    <div class="col-span-6 h-15 row-span-1 flex justify-start items-end">
        <button class="bg-blue-500 px-4 py-2 rounded-lg" type="submit">Save Contact</button>
    </div>


</form>


