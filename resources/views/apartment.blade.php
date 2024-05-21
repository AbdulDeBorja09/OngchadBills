@extends('includes.app')
@section('content')

    <div class="page-title">
        <button class="backbtn" onclick="history.back()"><i class="fa-solid fa-arrow-left"
                style="color: #ffffff;"></i></button>APARTMENTS
    </div>
    <section class="apartment-container">
        <div class="left">
            <form action="{{ route('apartmentsearch') }}" method="POST">
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

                            $totalkwh = abs($item->latest_reading - $item->last_reading);

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
                                            <h4>{{ $monthName }} </h4>
                                            <h4>{{ DateTime::createFromFormat('!m', $latest)->format('F') }}</h4>
                                        </div>
                                        <div class="readings">
                                            <h4>{{ $item->last_reading }}</h4>
                                            <h4>- {{ $item->latest_reading }}</h4>
                                        </div>
                                    </div>
                                    <div class="result">
                                        {{ $totalkwh }}
                                    </div>
                                </div>
                                <div class="second-div">
                                    <div class="cpt-right ">
                                        <h4>{{ $totalkwh }}</h4>
                                        <h4>KWH x {{ $item->kwh }}</h4>
                                    </div>
                                    <div class="result">{{ $totalkwh * $item->kwh }}
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
                            <h1>status: {{ $item->status }}</h1>
                            <div class="change-sts-btn">
                                <form action="{{ route('paidstatus', ['id' => $item->id]) }}" method="POST">
                                    @csrf
                                    @method('post')
                                    <button>PAID</button>
                                </form>
                            </div>
                        </section>
                    @endforeach
                @endif
            @endif
        </div>
        @if ($searchstatus == true)
            <div class="right">
                <div class="actionbuttons">
                    <form action="{{ route('delete', ['id' => $item->id]) }}" method="POST">
                        @csrf
                        @method('post')
                        <button class="dlt">DELETE COMPUTATION <i class="fa-solid fa-trash"
                                style="color: #ffffff;"></i></button>
                    </form>
                    <form action="{{ route('editcompute', ['id' => $item->id]) }}" method="POST">
                        @csrf
                        @method('post')
                        <button class="edit">EDIT COMPUTATION <i class="fa-solid fa-pen-to-square"
                                style="color: #ffffff;"></i></button>
                    </form>
                    <form action="{{ route('soloprint', ['id' => $item->id]) }}">
                        @csrf
                        @method('post')
                        <button class="printbtn">PRINT INVOICE</button>
                    </form>

                </div>

            </div>
        @endif
    </section>
@endsection
