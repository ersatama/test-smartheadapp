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

    <a href="{{ route('admin.tickets.index') }}" class="btn btn-outline-secondary">← Назад к списку</a>
@endsection
