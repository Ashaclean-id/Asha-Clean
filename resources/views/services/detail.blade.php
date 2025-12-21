@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $service->name }}</h1>

    <p>{{ $service->description }}</p>

    <h3>Tools yang digunakan:</h3>

    @if($service->tools->count())
        <ul>
            @foreach($service->tools as $tool)
                <li>{{ $tool->name }}</li>
            @endforeach
        </ul>
    @else
        <p><em>Belum ada tools untuk layanan ini</em></p>
    @endif
</div>
@endsection
