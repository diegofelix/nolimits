@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="col">
            <h2>Inscrição <strong>{{ $enroll->_id }}</strong></h2>
            <h4>{{ $enroll->championship()->title }}</h4>

            <hr>
            <div class="row">
                @foreach ($enroll->competitions() as $competition)
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $competition->game()->title }}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">{{ $competition->format }}</h6>
                                R$ {{ number_format($competition->getPrice(), 2, ',', '.') }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <hr>
            <h3>Total</h3>
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">{{ number_format($enroll->getTotalValue(), 2, ',', '.') }}</h5>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <a href="{{ route('checkout', $enroll->championship()->slug) }}" class="btn btn-primary">Realizar Pagamento</a>
                </div>
            </div>
        </div>
    </div>
@endsection
