@extends('layouts.app')

@section('title', 'Заявка #' . $ticket->id)

@section('content')
    <h1>Заявка #{{ $ticket->id }}</h1>

    <div class="mb-3">
        <strong>Клиент:</strong> {{ $ticket->customer->name }}<br>
        <strong>Email:</strong> {{ $ticket->customer->email }}<br>
        <strong>Телефон:</strong> {{ $ticket->customer->phone }}<br>
    </div>

    <div class="mb-3">
        <strong>Тема:</strong> {{ $ticket->subject }}<br>
        <strong>Статус:</strong>
        <span class="badge bg-secondary">{{ $ticket->status }}</span><br>
        <strong>Создана:</strong> {{ $ticket->created_at->format('d.m.Y H:i') }}<br>
    </div>

    <div class="mb-4">
        <strong>Сообщение:</strong>
        <div class="border rounded p-3 bg-light">{{ $ticket->text }}</div>
    </div>

    @if($ticket->media->count())
        <div class="mb-4">
            <h4>Файлы</h4>
            <ul>
                @foreach($ticket->media as $file)
                    <li><a href="{{ $file->getUrl() }}" target="_blank">{{ $file->file_name }}</a></li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <h4>Изменить статус</h4>

    <form method="POST" action="{{ route('admin.tickets.updateStatus', $ticket->id) }}">
        @csrf
        @method('PATCH')

        <select name="status" class="form-select mb-2">
            <option value="new" @selected($ticket->status === 'new')>Новый</option>
            <option value="in_progress" @selected($ticket->status === 'in_progress')>В работе</option>
            <option value="done" @selected($ticket->status === 'done')>Обработан</option>
        </select>

        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>

    <br>

    <a href="{{ route('admin.tickets.index') }}" class="btn btn-outline-secondary">← Назад к списку</a>


@endsection
