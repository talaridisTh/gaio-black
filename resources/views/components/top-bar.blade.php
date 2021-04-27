<div class="border-b border-white h-12 flex items-center  justify-end px-10">
    <form x-data x-ref="upload" method="post" action="{{route('user.upload')}}" enctype='multipart/form-data'>
        @csrf
        <label class="cursor-pointer" for="excel-upload">
            <input @change="$refs.upload.submit()" id="excel-upload" type="file" name="excel-user" hidden>
            <i class="text-white" data-feather="upload"></i>
        </label>
    </form>
</div>