@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">{{ $championship->title }}</div>

                <div class="card-body">
                    {{ $championship->description }}
                </div>
            </div>


            <div class="card card-default">
                <div class="card-header">{{ $championship->title }}</div>

                <div class="card-body">
                    {{ $championship->description }}
                </div>
            </div>
        </div>
    </div>
@endsection
