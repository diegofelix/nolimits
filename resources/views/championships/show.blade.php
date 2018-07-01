@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col">
            <div class="row">
                <div class="col">
                    <div class="card card-default">
                        <div class="card-header">{{ $championship->title }}</div>

                        <div class="card-body">
                            {{ $championship->description }}
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <form action="{{ route('checkout', $championship->slug) }}" method="post">
                <input name="_token" type="hidden" value="{{ csrf_token() }}">
                <div class="row">
                    @foreach ($championship->competitions() as $competition)
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="competitions[{{ $loop->index }}]" class="custom-control-input" id="competition-{{ $loop->index }}">
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
                        <button type="submit" class="btn btn-primary">Participar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
