<?php

namespace App\Http\Controllers;

use App\Components\ImportDataClient;
use http\Env\Response;
use Illuminate\Http\Request;


class BulletinController extends Controller
{
    /**
     *   Вывод всех записей (в том числе и отсортированных)
     */
    public function output(Request $request, $page) {
        // Обращаемся к API и создаем новый объект
        $import = new ImportDataClient();
        $bulletins = $import->client->request('GET', 'bulletins?page='.$page);

        // Сохраняем состояние сортировки, для падинга других страниц
        if(session('sort-by')) {
            $bulletins = $this->sortBy(session('sort-by'), $page);
        }

        // Проверяем, существует ли сортировка и сохраняем её
        if(isset($request->orderBy)){
            $bulletins = $this->sortBy($request->orderBy,$page);
        }

        // Формирование сортировки
        if($request->ajax()){
            $bulletins = $this->sortBy($request->orderBy,$page);
            // Возвращаем ajax сортировку, вместе с номером страницы
            return view('ajax.order_by',[
                'bulletins' => json_decode($bulletins->getBody()->getContents(),),
                'page' => $page
            ])->render();
        }

        // Возвращаем страницу с объявлениями и номер страницы
        return view('layout.bulletins', [
            'bulletins' => json_decode($bulletins->getBody()->getContents()),
            'page' => $page
        ]);
    }

    /**
     *   Просмотр нужной страницы
     */
    public function show($id) {
        $import = new ImportDataClient();
        $bulletin = $import->client->request('GET','bulletins/'.$id);

        return view('layout.show',[
            'bulletin' => json_decode($bulletin->getBody()->getContents())
        ]);
    }

    /**
     * Вывод страницы добавления объявления
     */
    public function output_add() {
        session()->forget('sort-by'); // Удаление сортировки
        return view('layout.add_bulletin');
    }

    /**
     * Отправка данных на api
     */
    public function store(Request $request) {
        $import = new ImportDataClient();
        $import->client->request('POST','bulletins', [
            'form_params' => [
                'title' => $request->title,
                'price' => $request->price,
                'description' => $request->description,
                'general_photo' => $request->general_photo
            ]
        ]);
        return response()->redirect('/bulletins/1');
    }

    /**
     *   Метод сортировки
     */
    public function sortBy($sortBy,$page) {
        $import = new ImportDataClient();

        // Сортировка по указанным параметрам
        switch ($sortBy){
            case 'по цене (возрастанию)':
                session(['sort-by' => $sortBy]);
                return $import->client->request('GET','bulletins/price/low-high?page='.$page);
            case 'по цене (убыванию)':
                session(['sort-by' => $sortBy]);
                return $import->client->request('GET','bulletins/price/high-low?page='.$page);
            case 'по дате (возрастанию)':
                session(['sort-by' => $sortBy]);
                return $import->client->request('GET','bulletins/date/low-high?page='.$page);
            case 'по дате (убыванию)':
                session(['sort-by' => $sortBy]);
                return $import->client->request('GET','bulletins/date/high-low?page='.$page);
        }
    }
}
