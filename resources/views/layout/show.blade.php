@extends('layout.app')

@section('title','Продукт')

@section('content')
    <div class="wrapper">
        <div class="container">
            <div class="mySlides" style="display: block;">
            <div class="numbertext">1 / {{count($bulletin->photos)+1}}</div>
                <img src="{{$bulletin->general_photo}}">
            </div>
            @foreach($bulletin->photos as $key => $photo)
            <div class="mySlides">
            <div class="numbertext">{{$key + 2}} / {{count($bulletin->photos)+1}}</div>
                <img src="{{$photo->link_photo}}">
            </div>
            @endforeach
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
            <div class="row">
            <div class="column">
                <img class="demo cursor active" src="{{$bulletin->general_photo}}" onclick="currentSlide(1)">
            </div>
            @foreach($bulletin->photos as $photo)
                <div class="column">
                    <img class="demo cursor" src="{{$photo->link_photo}}" onclick="currentSlide(2)">
                </div>
            @endforeach
            </div>
        </div>
        <div class="show-info">
            <div class="show-title">
                <p>{{$bulletin->title}}</p>
            </div>
            <div class="show-price">
                <span>{{$bulletin->price}}</span>
            </div>
            <div class="show-desc">
                <p>
                    {{$bulletin->description}}
                </p>
            </div>
            <div class="show-add-basket">
                <input type="button" name="add-basket" value="Купить">
            </div>
        </div>
    </div>
@endsection
