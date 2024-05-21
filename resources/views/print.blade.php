@extends('includes.app')
@section('content')
    <div class="page-title">
        <button class="backbtn" onclick="history.back()"><i class="fa-solid fa-arrow-left"
                style="color: #ffffff;"></i></button>PRINT
    </div>
    <div class="printingdiv">
        <form action="{{ route('pdf') }}" method="POST">
            @csrf
            @method('POST')
            @foreach ($latestApartments as $apartment)
                <input id="Name" type="checkbox" name="apartments[]" value="{{ $apartment->id }}">
                <label for="name">{{ $apartment->name }}</label>
                <br>
            @endforeach

            <button type="submit">PRINT</button>
            @if (session('error'))
                <div class="printerror">
                    *{{ session('error') }}
                </div>
            @endif
        </form>
    </div>
@endsection
