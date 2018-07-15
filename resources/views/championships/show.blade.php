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

                                        <input type="checkbox" name="competitions[{{ $competition->_id }}]" class="custom-control-input" id="competition-{{ $competition->_id }}">
                                        <label class="custom-control-label" for="competition-{{ $competition->_id }}">
                                            <div class="media">
                                                <img class="mr-3" src="{{ asset($competition->game()->image) }}" width="100" height="90" alt="Generic placeholder image">
                                                <div class="media-body">
                                                    <h5 class="mt-0">{{ $competition->game()->title }}</h5>
                                                    <h6 class="card-subtitle mb-2 text-muted">{{ $competition->format }}</h6>
                                                    <h3>R$ {{ number_format($competition->getPrice(), 2, ',', '.') }}</h3>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <hr>
                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-primary">Participar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
