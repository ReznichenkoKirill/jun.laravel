@extends('layouts.default')    <!-- folder.file -->
<!-- путь подключ. шаблона, аналогичен layouts/default -->
@section('content')    <!-- указывает на то, в какой секции будет подключён этот фрагмент кода, аналогичен include -->
<!-- путь подключ. контента -->
<div class="panel-body">
    <!-- Отображение ошибок проверки ввода -->
@include('common.errors')

<!-- Форма новой задачи -->
<!-- аналогично action="<?//= $value ?>} -->
    <!-- Если нам будет необходимо формировать адрес который соответственно требует входяи параметров, то параметры перечисляются после запятой -->
    <form action="{{ route('tasks.all') }}"
          method="POST"
          class="form-horizontal">
    {{ csrf_field() }}
    <!-- csrf_field() является обязательным, без него не будет происодить обработка -->

        <div class="form-group">
            <label for="task"
                   class="col-sm-3 control-label">Задача</label>
            <div class="col-sm-6">
                <input type="text"
                       name="name"
                       id="task"
                       class="form-control">
            </div>
        </div>
        <!-- Кнопка добавления задачи -->
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <button type="submit"
                        class="btn btn-default">
                    <i class="fa fa-plus"></i> Добавить задачу
                </button>
            </div>
        </div>
    </form>
</div>

<!-- TODO: Текущие задачи -->
<!-- Текущие задачи | Список задач -->
@if (count($tasks) > 0)
    <div class="panel panel-default">
        <div class="panel-heading">
            Текущая задача
        </div>

        <div class="panel-body">
            <table class="table table-striped task-table">

                <!-- Заголовок таблицы -->
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
                </thead>
                <!-- Тело таблицы -->
                <tbody>
                @foreach ($tasks as $task)
                    <tr>
                        <!-- Имя задачи -->
                        <td class="table-text">
                            {{ $task->name }}
                        </td>

                        <td>
                            <form method="POST" action="{{route('tasks.delete', $task->id)}}"> <!-- $tasks->id - это ходящее значение для Route::delete -->
                                {{csrf_field()}}
                                {{method_field('DELETE')}}  <!-- определяет метод передачи -->
                                <button class="btn btn-danger">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif
@endsection <!-- окончание секции -->