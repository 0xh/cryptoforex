<div class="popup {{$title}}">
    <div class="close"></div>
    <div class="top">
        @foreach($contents as $content)
            {!! $content !!}
        @endforeach
    </div>
</div>
