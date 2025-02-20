@extends('layouts.app')

@section('content')

    <div class="prose ml-4">
        <h2 class="text-lg">タスク一覧</h2>
    </div>

    @if (isset($tasks) && count($tasks) > 0)
        <table class="table table-zebra w-full my-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>タスク内容</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                <tr>
                    <td><a class="link link-hover text-info" href="{{ route('tasks.show', $task->id) }}">{{ $task->id }}</a></td>
                    <td>{{ $task->content }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="ml-4">タスクがありません。</p>
    @endif

    <div class="ml-4 mt-4">
        <a class="btn btn-primary" href="{{ route('tasks.create') }}">新しいタスクを追加</a>
    </div>

@endsection