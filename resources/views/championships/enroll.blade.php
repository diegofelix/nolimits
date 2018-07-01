@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="col">
            <h3>{{ $championship->title }}</h3>

            <hr>
            <div class="row">
                @foreach ($championship->competitions() as $competition)
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="competition-{{ $loop->index }}">
                                    <label class="custom-control-label" for="competition-{{ $loop->index }}">
                                        <h5 class="card-title">{{ $competition->game()->title }}</h5>
                                        <h6 class="card-subtitle mb-2 text-muted">{{ $competition->format }}</h6>
                                        R$ {{ $competition->price / 100 }}
                                    </label>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col">
                    <a href="{{ route('checkout', $championship->slug) }}" class="btn btn-primary">Participar</a>
                </div>
            </div>
        </div>
    </div>
@endsection
