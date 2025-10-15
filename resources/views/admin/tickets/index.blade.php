@extends('layouts.app')

@section('title', 'Список заявок')

@section('content')
    <h1 class="mb-3">Список заявок</h1>

    <form method="GET" class="mb-4">
        <input type="text" name="email" placeholder="Email" value="{{ request('email') }}" class="form-control mb-2">
        <input type="text" name="phone" placeholder="Телефон" value="{{ request('phone') }}" class="form-control mb-2">
        <select name="status" class="form-select mb-2">
            <option value="">Все статусы</option>
            <option value="new" @selected(request('status') === 'new')>Новые</option>
            <option value="in_progress" @selected(request('status') === 'in_progress')>В работе</option>
            <option value="done" @selected(request('status') === 'done')>Обработанные</option>
        </select>
        <button class="btn btn-primary">Фильтр</button>
    </form>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Клиент</th>
            <th>Email</th>
            <th>Тема</th>
            <th>Статус</th>
            <th>Дата</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tickets as $ticket)
            <tr>
                <td>
                    <a href="{{ route('admin.tickets.show', $ticket->id) }}">
                        #{{ $ticket->id }}
                    </a>
                </td>
                <td>{{ $ticket->customer->name }}</td>
                <td>{{ $ticket->customer->email }}</td>
                <td>
                    <a href="{{ route('admin.tickets.show', $ticket->id) }}">
                        {{ $ticket->subject }}
                    </a>
                </td>
                <td>{{ $ticket->status }}</td>
                <td>{{ $ticket->created_at->format('d.m.Y H:i') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $tickets->links() }}
@endsection
