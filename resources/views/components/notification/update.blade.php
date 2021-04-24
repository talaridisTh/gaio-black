@props(["notify-event" , "message"=>false] )

<div x-data="{notify:false}"
     x-init="@this.on('{{$notifyEvent}}',() => {
                            setTimeout(()=>{ notify = false } , 2500)
                            notify = true
                         })"
     x-show.transition.oute.duration.1000ms="notify"
     class="text-white  mx-2">
    {{$message ? $message : 'saved!'}}
</div>
