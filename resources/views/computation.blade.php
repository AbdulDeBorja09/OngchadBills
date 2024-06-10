@extends('includes.app')
@section('content')
    <div class="page-title">
        <button class="backbtn" onclick="history.back()"><i class="fa-solid fa-arrow-left"
                style="color: #ffffff;"></i></button>COMPUTATION
    </div>
    <section class="computation-div">
        <form class="left" action="{{ route('compute') }}" method="POST">
            @csrf
            @method('post')
            <div class="upper">
                <select name="name" required>
                    <option value="Apartment 1">Apartment 1</option>
                    <option value="Apartment 2">Apartment 2</option>
                    <option value="Apartment 3">Apartment 3</option>
                </select>
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
                <input name="due" type="date" required>
                <input name="bill" type="number" required placeholder="Bill">
                <input name="kwh" type="number" required placeholder="KWH">
            </div>
            <div class="lower">
                <h1>COMPUTATION</h1>
                <input name="R1" type="number" placeholder="Reading 1" required>
                <input name="R2" type="number" placeholder="Reading 2" required>
            </div>
            <button class="submit" type="submit" name="submit"><i class="fa-solid fa-calculator"
                    style="color: #ffffff;"></i> COMPUTE</button>
            @if (session('success'))
                <div class="alert compute-alert" role="alert">*{{ session('success') }} </div>
            @endif
            @if (session('error'))
                <div class="alert compute-alert" role="alert">*{{ session('error') }}
                </div>
            @endif
        </form>
        @if (!$latest)
        @else{
            @php
                $sqlDate = $latest->due;
                $carbonDate = \Carbon\Carbon::parse($sqlDate);
                $due = $carbonDate->format('F d Y');
                $totalkwh = abs($latest->latest_reading - $latest->last_reading);
            @endphp
            <div class="right text-white">
                <h1 class="apt">{{ $latest->name }}</h1>
                <h2>Month: {{ $latest->month }}</h2>
                <h2>bill: {{ $latest->bill }}</h2>
                <h2>Due: {{ $due }}</h2>
                <h2>KWH: {{ $latest->kwh }}</h2>
                <h1 class="cpt">COMPUTATION</h1>
                <h3 class="rdng">readings:</h3>

                <div class="computation-details d-flex">
                    <div class="first-div">
                        <div class="cpt-left d-flex">
                            <div class="info">
                                <h4>{{ $latest->last_month }}</h4>
                                <h4>{{ $latest->month }}</h4>

                            </div>
                            <div class="readings">
                                <h4>{{ $latest->last_reading }}</h4>
                                <h4>- {{ $latest->latest_reading }}</h4>
                            </div>
                        </div>
                        <div class="result">
                            {{ $totalkwh }}
                        </div>
                    </div>
                    <div>
                        <div class="cpt-right ">
                            <h4> {{ $totalkwh }}</h4>
                            <h4>KWH x {{ $latest->kwh }}</h4>
                        </div>
                        <div class="result">{{ $latest->total }}</div>
                    </div>
                </div>
                <h5>TOTAL BILL TO PAY:</h5>
                <h6>{{ $latest->total }}.00</h6>

            </div>
            }
        @endif
    </section>
    <section class="computation-buttons">
        <a class="print" href="{{ route('print') }}">PRINT</a>
    </section>
@endsection
{{-- <script>
    $(document).ready(function() {
        $('select[name="name"]').change(function() {
            var apartment = $(this).val();
            $.ajax({
                url: "{{ route('getLastReading') }}",
                method: 'POST',
                data: {
                    apartment: apartment,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        $('input[name="R1"]').val(response.lastReading);
                    } else {
                        alert(response.message);
                    }
                }
            });
        });
    });
</script> --}}
