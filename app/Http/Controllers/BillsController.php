<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compute;

class BillsController extends Controller
{
    protected $apt1;
    protected $apt2;
    protected $apt3;

    public function __construct()
    {
        $this->initializeApartments();
    }

    protected function initializeApartments()
    {
        $this->apt1 = Compute::latest('id')
            ->where('name', 'Apartment 1')
            ->first();
        $this->apt2 = Compute::latest('id')
            ->where('name', 'Apartment 2')
            ->first();
        $this->apt3 = Compute::latest('id')
            ->where('name', 'Apartment 3')
            ->first();

        if ($this->apt1) {
            $this->apt1->month = date('F', strtotime("{$this->apt1->year}-{$this->apt1->month}-01"));
        }
        if ($this->apt2) {
            $this->apt2->month = date('F', strtotime("{$this->apt2->year}-{$this->apt2->month}-01"));
        }
        if ($this->apt3) {
            $this->apt3->month = date('F', strtotime("{$this->apt3->year}-{$this->apt3->month}-01"));
        }
    }

    public function index()
    {
        return view('home', [
            'apt1' => $this->apt1,
            'apt2' => $this->apt2,
            'apt3' => $this->apt3,
        ]);
    }
    public function payments()
    {
        return view('payments', [
            'apt1' => $this->apt1,
            'apt2' => $this->apt2,
            'apt3' => $this->apt3,
        ]);
    }
    public function history()
    {
        $result = false;
        return view('history', compact('result'));
    }
    public function historysearch(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'month' => 'required|string|max:255',
            'year' => 'required|string|max:255',
        ]);
        $name = $request->input('name');
        $month = $request->input('month');
        $year = $request->input('year');
        $history = Compute::where('name', $name)
            ->where('month', $month)
            ->where('year', $year)
            ->where('status', 'paid')
            ->get();
        $result =  true;
        return view('history', compact('history', 'result'));
    }
    public function showhistory($id)
    {
        $history = Compute::where('id', $id)->get();
        $result = true;
        $isDirectView = true;
        return view('history', compact('history', 'result'));
    }
    public function apartmentsearch(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'month' => 'required|string|max:255',
            'year' => 'required|string|max:255',
        ]);
        $name = $request->input('name');
        $month = $request->input('month');
        $year = $request->input('year');
        $history = Compute::where('name', $name)
            ->where('month', $month)
            ->where('year', $year)
            ->where('status', 'pending')
            ->get();
        $result =  true;
        return view('apartment', compact('history', 'result'));
    }
    public function showapartment($id)
    {
        $history = Compute::where('id', $id)->get();
        $result = true;
        return view('apartment', compact('history', 'result'));
    }
    public function paidstatus($id)
    {
        $history = Compute::where('id', $id)->get();
        $result = true;
        Compute::where('id', $id)->update([
            'status' => 'paid',
        ]);
        return view('apartment', compact('history', 'result'));
    }
    public function delete($id)
    {
        $result = false;
        Compute::where('id', $id)->delete();
        return view('apartment', compact('result'));
    }
    public function pendingstatus($id)
    {
        $history = Compute::where('id', $id)->get();
        $result = true;
        Compute::where('id', $id)->update([
            'status' => 'pending',
        ]);
        return view('apartment', compact('history', 'result'));
    }
    public function apartment()
    {
        $result = false;
        return view('apartment', compact('result'));
    }
    public function submeter()
    {
        $result = false;
        return view('submeter', compact('result'));
    }
    public function submetersearch(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'month' => 'required|string|max:255',
        ]);
        $name = $request->input('name');
        $month = $request->input('month');
        $year = date('Y');

        $search = Compute::where('name', $name)
            ->where('month', $month)
            ->where('year', $year)
            ->get();
        $result = true;
        return view('submeter', compact('search', 'result'));
    }
    public function editcompute($id)
    {
        $edit = Compute::where('id', $id)->first();

        if (!$edit) {
        } else {
            $edit->month = date('F', strtotime("{$edit->year}-{$edit->month}-01"));
            $previous_month_date = date('Y-m-01', strtotime("-1 month", strtotime("{$edit->year}-{$edit->month}-01")));
            $previous_month = date('F', strtotime($previous_month_date));
            $edit->last_month = $previous_month;
        }
        return view('editcompute', compact('edit'));
    }
    public function computation()
    {
        $latest = Compute::latest('id')->first();
        if ($latest) {
            $latest->month = date('F', strtotime("{$latest->year}-{$latest->month}-01"));
            $previous_month_date = date('Y-m-01', strtotime("-1 month", strtotime("{$latest->year}-{$latest->month}-01")));
            $previous_month = date('F', strtotime($previous_month_date));
            $latest->last_month = $previous_month;
        }
        return view('computation', compact('latest'));
    }
    public function submitedit(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'due' => 'required|date',
            'bill' => 'required|numeric',
            'kwh' => 'required|integer',
            'R1' => 'required|integer',
            'R2' => 'required|integer',
        ]);
        $id = $request->input('id');
        $due = $request->input('due');
        $bill = $request->input('bill');
        $kwh = $request->input('kwh');
        $R1 = $request->input('R1');
        $R2 = $request->input('R2');
        $difference = $R2 - $R1;
        $total = $difference * $kwh;
        Compute::where('id', $id)->update([
            'bill' => $bill,
            'due' => $due,
            'kwh' => $kwh,
            'last_reading' => $R1,
            'latest_reading' => $R2,
            'total' => $total,
        ]);
        return redirect()->route('editcompute', compact('id'))->with('success', __('validation.editsucces'));
    }

    public function compute(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'month' => 'required|string|max:255',
            'due' => 'required|date',
            'bill' => 'required|numeric',
            'kwh' => 'required|integer',
            'R1' => 'required|integer',
            'R2' => 'required|integer',
        ]);

        $name = $request->input('name');
        $month = $request->input('month');
        $year = date('Y');
        $due = $request->input('due');
        $bill = $request->input('bill');
        $kwh = $request->input('kwh');
        $R1 = $request->input('R1');
        $R2 = $request->input('R2');
        $difference = $R2 - $R1;
        $total = $difference * $kwh;

        $existingBill = Compute::where('name', $name)->where('month', $month)->first();
        if ($existingBill) {
            return redirect()->back()->with('error',  __('validation.computeerror'));
        } else {
            Compute::create([
                'name' => $name,
                'month' => $month,
                'year' => $year,
                'bill' => $bill,
                'due' => $due,
                'kwh' => $kwh,
                'last_reading' => $R1,
                'latest_reading' => $R2,
                'total' => $total,
            ]);
            return redirect()->route('computation')->with('success', __('validation.computesucess'));
        }
    }

    public function print()
    {
        $latestApartments = Compute::whereIn('name', ['Apartment 1', 'Apartment 2', 'Apartment 3'])
            ->whereIn('id', function ($query) {
                $query->selectRaw('MAX(id)')
                    ->from('bills')
                    ->whereIn('name', ['Apartment 1', 'Apartment 2', 'Apartment 3'])
                    ->groupBy('name');
            })
            ->orderBy('name', 'asc')
            ->get();
        return view('print', compact('latestApartments'));
    }
}
