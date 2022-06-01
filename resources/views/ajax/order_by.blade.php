@foreach($bulletins->data as $bulletin)
    <div class="product">
        <div class="product-img">
            <img src="{{$bulletin->general_photo}}">
        </div>
        <div class="product-desc">
            <p>{{$bulletin->title}}</p>
            <span>{{number_format($bulletin->price,0,'',' ')}}p</span>
        </div>
        <div class="product-buttons">
            <a href="{{url('/bulletins/show/'.$bulletin->id)}}" class="product-show">Смотреть</a>
        </div>
    </div>
@endforeach
