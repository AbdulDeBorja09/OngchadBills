<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Compute;


class PDFController extends Controller
{
    public function generatePDF(Request $request)
    {


        $selectedApartments = $request->input('apartments');
        if (empty($selectedApartments)) {

            return redirect()->back()->with('error', __('validation.noprint'));
        }

        foreach ($selectedApartments as $apartmentName) {
            $selectedData  = Compute::whereIn('id', $selectedApartments)
                ->get();
        }
        $data = [
            'selectedData' => $selectedData,
        ];
        $pdf = PDF::loadView('pdf.pdf_view', $data);
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('selected_data.pdf');
    }
    public function soloprint($id)
    {
        $selectedData  = Compute::where('id', $id)->first();
        if (empty($selectedApartments)) {
            return view('error.404');
        }

        $data = [
            'selectedData' => $selectedData,
        ];
        $pdf = PDF::loadView('pdf.print', $data);
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('print.pdf');
    }
}
