@extends('layout.app')
@section('title','Продукт')

@section('content')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <nav>
        <ul>
            <li><span class="bulletin_sorting-main">Главная</span>
                <ul>
                    <li class="bulletin_sorting-btn" data-order="по цене (возрастанию)"><span>по цене (возрастанию)</span></li>
                    <li class="bulletin_sorting-btn" data-order="по цене (убыванию)"><span>по цене (убыванию)</span></li>
                    <li class="bulletin_sorting-btn" data-order="по дате (возрастанию)"><span>по дате (возрастанию)</span></li>
                    <li class="bulletin_sorting-btn" data-order="по дате (убыванию)"><span>по дате (убыванию)</span></li>
                </ul>
            </li>
        </ul>
    </nav>
    <a href="{{Route('output-bulletin-add')}}" class="add-bulletin">Добавить объявление</a>
    <div class="products">
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
                <a href="{{url('/bulletin/show/'.$bulletin->id)}}" class="product-show">Смотреть</a>
            </div>
        </div>
        @endforeach
    </div>
    <div class="paginate">
        <a href="{{route('bulletins',1)}}">«</a>
        @for($i = 1; $i <= $bulletins->last_page; $i++)
            <a href="{{route('bulletins',$i)}}">{{$i}}</a>
        @endfor
        <a href="{{route('bulletins',$bulletins->last_page)}}">»</a>
    </div>
    <script>
        $(document).ready(function () {
            $('.bulletin_sorting-btn').click(function () {
                let orderBy = $(this).data('order');
                $('.bulletin_sorting-main').html(orderBy);
                $.ajax({
                    url: "{{route('bulletins',$page)}}",
                    type: "GET",
                    data: {
                        orderBy: orderBy
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: (data) => {
                        let positionParameters = location.pathname.indexOf('?');
                        let url = location.pathname.substring(positionParameters,location.pathname.length);
                        let newURL = url + '?';
                        newURL += 'orderBy=' + orderBy;
                        history.pushState({},'',newURL);

                        $('.products').html();
                        $('.products').html(data);
                    }
                });
            })
        })
    </script>
@endsection
