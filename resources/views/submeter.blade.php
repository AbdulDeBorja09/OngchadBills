@extends('includes.app')
@section('content')
    <div class="page-title">
        <button class="backbtn" onclick="history.back()"><i class="fa-solid fa-arrow-left"
                style="color: #ffffff;"></i></button>SUBMETER
    </div>
    <section class="submeter-container">
        <h1>READINGS</h1>
        <form action="{{ route('submetersearch') }}" method="POST">
            @csrf
            @method('post')
            <select name="name" id="name">
                <option value="Apartment 1">Apartment 1</option>
                <option value="Apartment 2">Apartment 2</option>
                <option value="Apartment 3">Apartment 3</option>
            </select>
            <br>
            <select name="month" required>
                <option value="1">january</option>
                <option value="2">february</option>
                <option value="3">march</option>
                <option value="4">april</option>
                <option value="5">may</option>
                <option value="6">june</option>
                <option value="7">july</option>
                <option value="8">august</option>
                <option value="9">september</option>
                <option value="10">october</option>
                <option value="11">november</option>
                <option value="12">december</option>
            </select>
            <br>
            <button><i class="fa-solid fa-magnifying-glass" style="color: #ffffff;"></i> SEARCH</button>
        </form>
        @if ($result == true)
            @if ($result)
                @if ($search->isEmpty())
                    <div class="submerteralert">
                        <p>*{{ __('validation.noresult') }}</p>
                    </div>
                @else
                    @foreach ($search as $item)
                        @php
                            $latest = $item->month;
                            $lastmonth = $latest == 1 ? 12 : $latest - 1;
                            if ($lastmonth < 1) {
                                $lastmonth = 12;
                            } elseif ($lastmonth > 12) {
                                $lastmonth = 1;
                            }
                            $monthName = date('F', mktime(0, 0, 0, $lastmonth, 1));
                        @endphp
                        <h6>{{ $monthName }}: {{ $item->last_reading }}</h6>
                        <h6>{{ DateTime::createFromFormat('!m', $latest)->format('F') }}: {{ $item->latest_reading }}</h6>
                    @endforeach
                @endif
            @endif
        @endif
    </section>
@endsection
