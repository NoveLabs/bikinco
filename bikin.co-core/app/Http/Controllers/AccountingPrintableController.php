<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;

    class AccountingPrintableController extends Controller
    {
        public function downPayment()
        {
            return view('document-exports.accounting-down-payment');
        }

        public function repayment()
        {
            return view('document-exports.accounting-invoice-repayment-paid');
        }

        public function downPaymentExport()
        {
            return PDF::loadView('document-exports.exports.accounting-down-payment-export')
                      ->setPaper('a4')
                      ->stream('Invoice-DP-BP-1234.pdf');
        }

        public function repaymentExport()
        {
            return PDF::loadView('document-exports.exports.accounting-invoice-repayment-paid-export')
                      ->setPaper('a4')
                      ->stream('Invoice-Repayment-BP-1234-PAID.pdf');
        }
    }
