@extends('includes.app')
@section('content')
    <div class="page-title">
        <button class="backbtn" onclick="history.back()"><i class="fa-solid fa-arrow-left"
                style="color: #ffffff;"></i></button>EDIT COMPUTATION
    </div>
    @if (!$edit)
    @else
        <section class="computation-div">
            <form class="left" action="{{ route('submitedit') }}" method="POST">
                @csrf
                @method('post')
                <input type="hidden" name="id" value="{{ $edit->id }}">
                <div class="upper">
                    <select name="name" required>
                        <option selected value="{{ $edit->name }}">{{ $edit->name }}</option>
                        {{-- <option value="Apartment 1">Apartment 1</option>
                        <option value="Apartment 2">Apartment 2</option>
                        <option value="Apartment 3">Apartment 3</option> --}}
                    </select>
                    @php
                        $totalkwh = abs($edit->latest_reading - $edit->last_reading);
                        $numonth = $edit->month;
                    @endphp
                    <select name="month" required >
                        <option selected value="{{ $numonth }}">{{ $edit->month }}</option>
                        <option value="1">january</option>
                        <option value="2">february</option>
                        <option value="3">march</option>
                        <option value="4">april</option>
                        <option value="5">may</option>s
                        <option value="6">june</option>
                        <option value="7">july</option>
                        <option value="8">august</option>
                        <option value="9">september</option>
                        <option value="10">october</option>
                        <option value="11">november</option>
                        <option value="12">december</option>
                    </select>
                    <input name="due" type="date" required value="{{ $edit->due }}">
                    <input name="bill" type="number" required placeholder="Bill" value="{{ $edit->bill }}">
                    <input name="kwh" type="number" required placeholder="KWH" value="{{ $edit->kwh }}">
                </div>
                <div class="lower">
                    <h1>COMPUTATION</h1>
                    <input name="R1" type="number" placeholder="Reading 1" required value="{{ $edit->last_reading }}">
                    <input name="R2" type="number" placeholder="Reading 2" required
                        value="{{ $edit->latest_reading }}">
                </div>
                <button class="submit" type="submit" name="submit"><i class="fa-solid fa-check"
                        style="color: #ffffff;"></i> UPDATE</button>
                @if (session('success'))
                    <div class="alert compute-alert" role="alert">*{{ session('success') }} </div>
                @endif
                @if (session('error'))
                    <div class="alert compute-alert" role="alert">*{{ session('error') }}
                    </div>
                @endif
            </form>

            <div class="right text-white">
                @php
                    $sqlDate = $edit->due;
                    $carbonDate = \Carbon\Carbon::parse($sqlDate);
                    $due = $carbonDate->format('F d Y');
                @endphp
                <h1 class="apt">{{ $edit->name }}</h1>
                <h2>Month: {{ $edit->month }}</h2>
                <h2>bill: {{ $edit->bill }}</h2>
                <h2>Due: {{ $due }}</h2>
                <h2>KWH: {{ $edit->kwh }}</h2>
                <h1 class="cpt">COMPUTATION</h1>
                <h3 class="rdng">readings:</h3>
                <div class="computation-details d-flex">
                    <div class="first-div">
                        <div class="cpt-left d-flex">
                            <div class="info">
                                <h4>{{ $edit->last_month }}</h4>
                                <h4>{{ $edit->month }}</h4>

                            </div>
                            <div class="readings">
                                <h4>{{ $edit->last_reading }}</h4>
                                <h4>- {{ $edit->latest_reading }}</h4>
                            </div>
                        </div>
                        <div class="result">
                            {{ $totalkwh }}
                        </div>
                    </div>
                    <div>
                        <div class="cpt-right ">
                            <h4>{{ $totalkwh }}</h4>
                            <h4>KWH x {{ $edit->kwh }}</h4>
                        </div>
                        <div class="result">{{ $edit->total }}</div>
                    </div>
                </div>
                <h5>TOTAL BILL TO PAY:</h5>
                <h6>{{ $edit->total }}.00</h6>
            </div>
        </section>
    @endif
@endsection
