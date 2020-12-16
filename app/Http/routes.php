<?php

use App\Task;
use Illuminate\Http\Request;

Route::group(['prefix' => 'tasks'], function () {   // первый параметры группировки, второй функция

    /**
     * Вывести панель с задачами
     */
    Route::get('/', function () {
        $tasks = Task::orderBy('created_at', 'acs')->get(); // Подготовка билдера
        return view('tasks.index', ['tasks'=>$tasks,]); // url.file, $nameVar in index.blade (42 line)
    }
    )->name('tasks.all');   // В именовании, как и в папках принято именовать соответственно по controller.action


    Route::post('/', function (Request $request) {
        $validator = Validator::make($request->all(), ['name'=> 'required|max:255',]);
        if($validator->fails()){
            return redirect(route('tasks.all'))
                ->withInput()
                ->withErrors($validator);
        }
        #v1#####################
        //dd($request->name); //образение к сойству объекта $request | request->parameters
        $task = new Task(); // экземпляр модели
        $task->name = $request->name;
        $task->save();
        ########################
        #v2#####################
        //$name = $request->name;
        // Task::create(['name'=>$name]);  // (Массовая операция) Делает запрос на создание кучи записей в одном запросе
        // Для того чтобы было разрешено массовое назначение, необходимо в свойстве класса $fillable = ['имя/именаСвойств'];
        return redirect(route('tasks.all'));
        // Возвращает на стр. со всеми значениями
    }
    )->name('tasks.add');


    Route::delete('/{task}', function (Task $task) {
        Task::find($task); // возвращает сразу результат поиска
        $task->delete();
        return redirect(route('tasks.all'));
    }
    )->name('tasks.delete');
});

//->name('url') - яляется поименованным маршрутом, используется с route() / helper
// тобишь, на основании этого имени он будет искать в роутах это имя, подставлять домен и всё что указано в url
// dd() аналогичен var_dump()