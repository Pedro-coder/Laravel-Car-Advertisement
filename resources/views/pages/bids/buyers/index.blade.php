@extends('layouts.app')

@section('content')

            <div class="jumbotron">
                    <h1>Buyers
                        <a href="{{route('buyers.create')}}" type="button" class="btn btn-success float-right">
                            + Create A Bid
                        </a>
                    </h1>
            </div>

@endsection

@section('extra-JS')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
@endsection