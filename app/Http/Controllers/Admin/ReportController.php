<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\PaymentSender;
use App\Report;
use Illuminate\Http\Request;

use App\Http\Requests;

class ReportController extends Controller
{
    /**
     * Show reports
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $reports = Report::orderBy('created_at', 'desc')->get();

        return view('admin.report.index', compact('reports'));
    }

    /**
     * Show report details
     *
     * @param Report $report
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Report $report)
    {
        return view('admin.report.show', compact('report'));
    }

    /**
     * Send a payment for a report
     *
     * @param Request $request
     * @param Report $report
     * @return $this|string
     */
    public function pay(Request $request, Report $report)
    {
        $this->validate($request, [
            'amount' => 'required|numeric|min:1'
        ]);

        if (empty($report->user->paypal_email)) {
            \Alert::error('Could not send payment. User does not have a PayPal email set.')->flash();

            return redirect()->back()->withInput($request->all());
        }

        $amount = floatval(trim($request->input('amount')));

        $payment = $report->pay($amount);

        if ($payment->failed() || $payment->error()) {
            \Alert::error('Error sending payment to ' . $report->user->paypal_email . '.')->flash();
        } else {
            \Alert::success('Payment sent to ' . $report->user->paypal_email . '.')->flash();
        }

        return redirect()->route('admin.report.show', $report);
    }
}
