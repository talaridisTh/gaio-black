<select wire:model="entries"
        id="{{$id}}"
        name="{{$name}}">
    {{$slot}}
</select>


@push('scripts')
    <script>
        $(document).ready(function () {
            $("#{{$id}}").select2({
                {{$attr}}
            });

            $(document).on('change', "#{{$id}}", function (e) {
            @this.set("entries", e.target.value);

            });
        });

        document.addEventListener("livewire:load", function (event) {
            window.livewire.hook('afterDomUpdate', () => {
                $("#{{$id}}").select2({});
            });
        });

    </script>
@endpush
