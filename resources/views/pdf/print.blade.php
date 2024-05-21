<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>pdf</title>
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap');

    * {
        border: 0;
        margin: 0;
        box-sizing: border-box;
        font-family: "Montserrat", sans-serif;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .printcontainer {
        display: flex;
        justify-content: space-around;
    }

    .printtable {
        margin: 10px;
        width: 100%;
        padding: 10px;
        border: 1px solid black
    }

    .printdiv h1 {
        font-size: 15;
        margin-top: 5px
    }

    .printdiv h2 {
        font-size: 12;
        font-weight: 400;
    }

    .computationtable {
        width: 100%;
        border-collapse: collapse;
        margin-top: 0px
    }

    .computationtable td {
        padding: 5px;
    }
</style>

<body>
    <div class="printcontainer">
        @php
            $selectedData->month = date('F', strtotime("{$selectedData->year}-{$selectedData->month}-01"));
            $previous_month_date = date(
                'Y-m-01',
                strtotime('-1 month', strtotime("{$selectedData->year}-{$selectedData->month}-01")),
            );
            $previous_month = date('F', strtotime($previous_month_date));
            $selectedData->last_month = $previous_month;
            $duedate = $selectedData->month;
            $carbonDate = \Carbon\Carbon::parse($duedate);
            $due = $carbonDate->format('F d Y');

            $totalkwh = abs($selectedData->latest_reading - $selectedData->last_reading);

        @endphp
        <table class="printtable">
            <tr>
                <td class="printdiv">
                    <h1>{{ $selectedData->name }}</h1>
                    <div class="details">
                        <h2>Month: {{ $selectedData->month }}</h2>
                        <h2>Bill: {{ $selectedData->bill }}</h2>
                        <h2>Due Date: {{ $due }}</h2>
                        <h2>KWH: {{ $selectedData->kwh }}</h2>
                    </div>
                </td>
                <td class="printdiv">
                    <br>
                    <h1>Computation</h1>
                    <table class="computationtable">
                        <tr>
                            <td>{{ $previous_month }}</td>
                            <td>&nbsp; {{ $selectedData->last_reading }}</td>
                            <td style=" border-left:1px solid black;">
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp; {{ $totalkwh }}
                            </td>
                        </tr>
                        <tr>
                            <td style="border-bottom: 1px solid black;">
                                {{ $selectedData->month }}
                            </td>
                            <td style="border-bottom: 1px solid black;">-
                                {{ $selectedData->latest_reading }}</td>
                            <td style="border-bottom: 1px solid black; border-left:1px solid black;">
                                kwh x
                                {{ $selectedData->kwh }}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;{{ $totalkwh }}
                            </td>
                            <td>{{ $selectedData->total }}</td>
                        </tr>
                    </table>

                    <h1 class="">Total bill to pay:</h1>
                    <h2 class="totalbill" style="font-size: 20px;font-weight: 700; margin-top:-10px;">
                        {{ $selectedData->total }}.00</h2>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
