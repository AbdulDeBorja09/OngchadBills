@extends('includes.app')
@section('content')
    <section class="home-container">
        <div class="left">
            <h3>LAST MONTH’S COMPUTATION</h3>
            <div class="box">
                <h1>Apartment 1</h1>
                @if (!$apt1)
                    <h2>{{ __('validation.noapt') }}</h2>
                @else
                    <h2>MONTH: {{ $apt1->month }}</h2>
                    <h2>TOTAL BILL: {{ $apt1->total }}</h2>
                    <h2>STATUS: {{ $apt1->status }}</h2>
                    @if ($apt1->status == 'pending')
                        <a class="cta" href="{{ url('/payments') }}">
                            <span class="hover-underline-animation">View payment </span>
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
                    @if ($apt2->status == 'pending')
                        <a class="cta" href="{{ url('/payments') }}">
                            <span class="hover-underline-animation">View payment </span>
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
                    @if ($apt3->status == 'pending')
                        <a class="cta" href="{{ url('/payments') }}">
                            <span class="hover-underline-animation">View payment </span>
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

        </div>
        <div class="right">
            <div class="startbtn">
                <a href="{{ url('/computation') }}">START COMPUTING</a>
            </div>
        </div>
    </section>
@endsection
