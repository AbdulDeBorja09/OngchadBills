@extends('includes.app')
@section('content')
    <div class="page-title">
        <button class="backbtn" onclick="history.back()"><i class="fa-solid fa-arrow-left"
                style="color: #ffffff;"></i></button>PAYMENTS
    </div>
    <section class="payments-container">
        <div class="box">
            <h1>Apartment 1</h1>
            @if (!$apt1)
                <h2>{{ __('validation.noapt') }}</h2>
            @else
                <h2>MONTH: {{ $apt1->month }}</h2>
                <h2>TOTAL BILL: {{ $apt1->total }}</h2>
                <h2>STATUS: {{ $apt1->status }}</h2>
                <h3> {{ $apt1->due }}</h3>
                @if ($apt1->status == 'pending')
                    <a class="cta" href="{{ route('showapartment', ['id' => $apt1->id]) }}">
                        <span class="hover-underline-animation">View apartment </span>
                        <svg id="arrow-horizontal" xmlns="http://www.w3.org/2000/svg" width="30" height="10"
                            viewBox="0 0 46 16" fill="#ffffff">
                            <path id="Path_10" data-name="Path 10"
                                d="M8,0,6.545,1.455l5.506,5.506H-30V9.039H12.052L6.545,14.545,8,16l8-8Z"
                                transform="translate(30)"></path>
                        </svg>
                    </a>
                @else
                    <a class="cta" href="{{ route('showhistory', ['id' => $apt1->id]) }}">
                        <span class="hover-underline-animation">View history </span>
                        <svg id="arrow-horizontal" xmlns="http://www.w3.org/2000/svg" width="30" height="10"
                            viewBox="0 0 46 16" fill="#ffffff">
                            <path id="Path_10" data-name="Path 10"
                                d="M8,0,6.545,1.455l5.506,5.506H-30V9.039H12.052L6.545,14.545,8,16l8-8Z"
                                transform="translate(30)"></path>
                        </svg>
                    </a>
                @endif
            @endif
        </div>

        <div class="box">
            <h1>Apartment 2</h1>
            @if (!$apt2)
                <h2>{{ __('validation.noapt') }}</h2>
            @else
                <h2>MONTH: {{ $apt2->month }}</h2>
                <h2>TOTAL BILL: {{ $apt2->total }}</h2>
                <h2>STATUS: {{ $apt2->status }}</h2>
                <h3> {{ $apt2->due }}</h3>
                @if ($apt2->status == 'pending')
                    <a class="cta" href="{{ route('showapartment', ['id' => $apt2->id]) }}">
                        <span class="hover-underline-animation">View apartment </span>
                        <svg id="arrow-horizontal" xmlns="http://www.w3.org/2000/svg" width="30" height="10"
                            viewBox="0 0 46 16" fill="#ffffff">
                            <path id="Path_10" data-name="Path 10"
                                d="M8,0,6.545,1.455l5.506,5.506H-30V9.039H12.052L6.545,14.545,8,16l8-8Z"
                                transform="translate(30)"></path>
                        </svg>
                    </a>
                @else
                    <a class="cta" href="{{ route('showhistory', ['id' => $apt2->id]) }}">
                        <span class="hover-underline-animation">View history </span>
                        <svg id="arrow-horizontal" xmlns="http://www.w3.org/2000/svg" width="30" height="10"
                            viewBox="0 0 46 16" fill="#ffffff">
                            <path id="Path_10" data-name="Path 10"
                                d="M8,0,6.545,1.455l5.506,5.506H-30V9.039H12.052L6.545,14.545,8,16l8-8Z"
                                transform="translate(30)"></path>
                        </svg>
                    </a>
                @endif
            @endif
        </div>

        <div class="box">
            <h1>Apartment 3</h1>
            @if (!$apt3)
                <h2>{{ __('validation.noapt') }}</h2>
            @else
                <h2>MONTH: {{ $apt3->month }}</h2>
                <h2>TOTAL BILL: {{ $apt3->total }}</h2>
                <h2>STATUS: {{ $apt3->status }}</h2>
                <h3> {{ $apt3->due }}</h3>

                @if ($apt3->status == 'pending')
                    <a class="cta" href="{{ route('showapartment', ['id' => $apt3->id]) }}">
                        <span class="hover-underline-animation">View apartment </span>
                        <svg id="arrow-horizontal" xmlns="http://www.w3.org/2000/svg" width="30" height="10"
                            viewBox="0 0 46 16" fill="#ffffff">
                            <path id="Path_10" data-name="Path 10"
                                d="M8,0,6.545,1.455l5.506,5.506H-30V9.039H12.052L6.545,14.545,8,16l8-8Z"
                                transform="translate(30)"></path>
                        </svg>
                    </a>
                @else
                    <a class="cta" href="{{ route('showhistory', ['id' => $apt3->id]) }}">
                        <span class="hover-underline-animation">View history </span>
                        <svg id="arrow-horizontal" xmlns="http://www.w3.org/2000/svg" width="30" height="10"
                            viewBox="0 0 46 16" fill="#ffffff">
                            <path id="Path_10" data-name="Path 10"
                                d="M8,0,6.545,1.455l5.506,5.506H-30V9.039H12.052L6.545,14.545,8,16l8-8Z"
                                transform="translate(30)"></path>
                        </svg>
                    </a>
                @endif
            @endif
        </div>
    </section>
@endsection
