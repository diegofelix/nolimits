@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="col">
            <h2>Inscrição <strong>{{ $enroll->_id }}</strong></h2>
            <h4 class="text-muted">{{ $enroll->championship()->title }}</h4>

            <hr>
            <div class="row">
                @foreach ($enroll->competitions() as $competition)
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <div class="media">
                                    <img class="mr-3" src="{{ asset($competition->game()->image) }}" width="100" height="90" alt="Generic placeholder image">
                                    <div class="media-body">
                                        <h5 class="mt-0">{{ $competition->game()->title }}</h5>
                                        <h6 class="card-subtitle mb-2 text-muted">{{ $competition->format }}</h6>
                                        <h3>R$ {{ number_format($competition->getPrice(), 2, ',', '.') }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <hr>
            <h2><small>Total:</small> <strong>R$ {{ number_format($enroll->getTotalValue(), 2, ',', '.') }}</strong></h2>
            <hr>
            <div class="row">
                <div class="col">
                    <a href="{{ $enroll->getPaymentUrl() }}" class="btn btn-primary">Realizar Pagamento</a>
                </div>
            </div>
        </div>
    </div>
@endsection
