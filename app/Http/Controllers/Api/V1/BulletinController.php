<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\BulletinResource;
use App\Models\V1\Bulletin;
use App\Models\V1\Photo;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Requests\V1\BulletinRequest;


class BulletinController extends Controller
{
    /**
     * Принимает модель Объявлений
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->model = Bulletin::class;
    }

    /**
     * Возвращает все обяъвления.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->model::with('photos')->paginate(10), 200);
    }
    /**
     * Возвращает все обяъвления, отсортированные по цене (возрастанию).
     *
     * @return \Illuminate\Http\Response
     */
    public function priceLowHigh() {
        return response()->json($this->model::with('photos')->orderBy('price')->paginate(10), 200);
    }
    /**
     * Возвращает все обяъвления, отсортированные по цене (убыванию).
     *
     * @return \Illuminate\Http\Response
     */
    public function priceHighLow() {
        return response()->json($this->model::with('photos')->orderBy('price','desc')->paginate(10), 200);
    }
    /**
     * Возвращает все обяъвления, отсортированные по дате (возрастанию).
     *
     * @return \Illuminate\Http\Response
     */
    public function dateLowHigh() {
        return response()->json($this->model::with('photos')->orderBy('created_at')->paginate(10), 200);
    }
    /**
     * Возвращает все обяъвления, отсортированные по дате (убыванию).
     *
     * @return \Illuminate\Http\Response
     */
    public function dateHighLow() {
        return response()->json($this->model::with('photos')->orderBy('created_at','desc')->paginate(10), 200);
    }
    /**
     * Создает новое объявление.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(BulletinRequest $request)
    {
        $bulletin = new Bulletin();
        $bulletin->fill($request->validated())->save();
        foreach ($request->photos as $photo) {
            $created_photo = new Photo();

            $created_photo->fill($photo);
            $bulletin->photos()->save($created_photo);
        }
        return response()->json("Успешно добавлено!", 202);
    }

    /**
     * Выводит конкретное объявление по id.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(new BulletinResource($this->model::with('photos')->findOrFail($id)), 200);
    }
}
