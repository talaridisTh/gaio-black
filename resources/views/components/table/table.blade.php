<table x-data="checked()"
       class="min-w-full table-auto">

    <thead class="dark:bg-gray-900">
    {{$head}}
    </thead>

    <tbody class="dark:bg-gray-800">
    <x-table.table-filter/>
    {{$body}}
    </tbody>
</table>


{{--<div class="mt-5">--}}
{{--    {{ $storage->links() }}--}}
{{--</div>--}}