<div class="item">
    <strong>{{title}}</strong>
    <ul>
        @foreach($items as $item)
            <li>
                <p><a href="#" id="{{$item->uid}}">{{$item->name}}</a></p>
                <p class="num">{{$item->num}}</p>
                <p class="last_num">{{$item->num}}<</p>
            </li>
        @endforeach
    </ul>
</div>
