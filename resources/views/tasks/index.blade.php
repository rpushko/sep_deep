
@extends('layouts.app')

@section('content')

    <!-- Bootstrap шаблон... -->

    <div class="panel-body">
        <!-- Отображение ошибок проверки ввода -->
        <a href="{{route('tasks.create')}}" class="btn btn-success">
            <i class="fa fa-plus">New task</i></a>

    @if (count($tasks) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                Текуще задачи
            </div>

            <div class="panel-body">
                <table class="table table-striped task-table">

                    <!-- Заголовок таблицы -->
                    <thead>
                    <tr><th>Название</th>
                        <th>Delete</th>
                        <th>Edit</th></tr>

                    </thead>

                    <!-- Тело таблицы -->
                    <tbody>
                    @foreach ($tasks as $task)
                        <tr>
                            <!-- Имя задачи -->
                            <td class="table-text">
                                <div>{{ $task->name }}</div>
                            </td>

                            <td>
                                <form action ="{{route('tasks.destroy',$task->id)}}" method="post">
                                    {{method_field('DELETE')}}
                                    {{csrf_field()}}
                                    <button class="btn btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                            <td>
                                <form action ="{{route('tasks.edit',$task->id)}}" method="get">
                                    {{method_field('GET')}}
                                   {{csrf_field()}}
                                    <button class="btn btn-warning">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
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
    </div>
@endsection