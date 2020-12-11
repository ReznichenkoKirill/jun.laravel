<?php
    use App\Task;
    use Illuminate\Http\Request;
    /**
     * Вывести панель с задачами
     */
    Route::get(
            '/tasks', function () {
        return view('tasks.index');
    }
    );
    /**
     * Добавить новую задачу
     */
    Route::post(
            '/tasks', function (Request $request) {
        //
    }
    );
    /**
     * Удалить задачу
     */
    Route::delete(
            '/tasks/{task}', function (Task $task) {
        //
    }
    );