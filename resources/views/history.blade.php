@extends('includes.app')
@section('content')
    <div class="page-title">
        <button class="backbtn" onclick="history.back()"><i class="fa-solid fa-arrow-left"
                style="color: #ffffff;"></i></button>HISTORY
    </div>
    <section class="history-container">
        <div class="left">
            <form action="{{ route('historysearch') }}" method="POST">
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
                <input type="number" name="year" required placeholder="2024" value="2024">
                <br>
                <button><i class="fa-solid fa-magnifying-glass" style="color: #ffffff;"></i> SEARCH</button>
            </form>
            @php
                $searchstatus = false;
            @endphp
            @if ($result == true)
                @if ($history->isEmpty())
                    <div class="historyerror">
                        <p>*{{ __('validation.noresult') }}</p>
                    </div>
                @else
                    @foreach ($history as $item)
                        <h1>{{ $item->name }}</h1>
                        @php
                            $latest = $item->month;
                            $lastmonth = $latest == 1 ? 12 : $latest - 1;
                            if ($lastmonth < 1) {
                                $lastmonth = 12;
                            } elseif ($lastmonth > 12) {
                                $lastmonth = 1;
                            }
                            $searchstatus = $result;
                            $monthName = date('F', mktime(0, 0, 0, $lastmonth, 1));
                        @endphp
                        <section class="details-section d-flex">
                            <div class="main-details ">
                                <h2>BILL: {{ $item->bill }}</h2>
                                <h2>KWH: {{ $item->kwh }}</h2>
                                <h2>DUE DATE: {{ $item->due }}</h2>
                            </div>
                            <div class="computation-detail d-flex">
                                <div class="first-div">
                                    <div class="cpt-left d-flex">
                                        <div class="info">
                                            <h4>{{ $monthName }}</h4>
                                            <h4>{{ DateTime::createFromFormat('!m', $latest)->format('F') }}</h4>
                                        </div>
                                        <div class="readings">
                                            <h4>{{ $item->last_reading }}</h4>
                                            <h4>- {{ $item->latest_reading }}</h4>
                                        </div>
                                    </div>
                                    <div class="result">
                                        {{ $item->latest_reading - $item->last_reading }}
                                    </div>
                                </div>
                                <div class="second-div">
                                    <div class="cpt-right ">
                                        <h4>{{ $item->latest_reading - $item->last_reading }}</h4>
                                        <h4>KWH x {{ $item->kwh }}</h4>
                                    </div>
                                    <div class="result">{{ ($item->latest_reading - $item->last_reading) * $item->kwh }}
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section class="readings">
                            <h1>readings</h1>
                            <h6>{{ $monthName }}: {{ $item->last_reading }}</h6>
                            <h6>{{ DateTime::createFromFormat('!m', $latest)->format('F') }}: {{ $item->latest_reading }}
                            </h6>
                        </section>
                        <section class="total">
                            <h1>total bill</h1>
                            <h6>To pay: {{ $item->total }}.00</h6>
                        </section>
                        <section class="status">
                            <h6>status: {{ $item->status }}</h6>
                            <h5>{{ $item->due }}</h5>
                        </section>
                    @endforeach
                @endif
            @endif
        </div>
        @if ($searchstatus == true)
            <div class="right">
                <form action="{{ route('soloprint', ['id' => $item->id]) }}">
                    @csrf
                    @method('post')
                    <button>PRINT</button>
                </form>
            </div>
        @endif
    </section>
@endsection
