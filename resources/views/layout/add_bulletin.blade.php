@extends('layout.app')
@section('title','Добавить объявление')

@section('content')
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<div class="bulletin__store">
    <h1>Добавить объявление</h1>
    <form action="{{route('store-bulletin')}}" method="POST">
        @csrf
        <input type="text" name="title" placeholder="введите название объявления">
        <input type="text" name="price" placeholder="введите цену">
        <textarea name="description" id="" placeholder="введите описание"></textarea>
        <div class="add__photo">
            <p>Главное фото</p><input type="text" name="general_photo" placeholder="ссылка">
        </div>
        <div class="add__photo">
            <p>Второе фото</p><input type="text" name="photos[0][link_photo]" placeholder="ссылка">
        </div>
        <div class="add__photo">
            <p>Третье фото</p><input type="text" name="photos[1][link_photo]" placeholder="ссылка">
        </div>
        <button type="submit">добавить</button>
    </form>
</div>
@endsection
