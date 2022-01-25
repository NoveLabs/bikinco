<?php
    
    namespace App\Http\Controllers;
    
    use Illuminate\Http\Request;
    use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
    use Illuminate\Support\Facades\App;
    
    class PrintableController extends Controller
    {
        
        public function repaymentPaid()
        {
            return view('document-exports.so-repayment-paid');
        }
        
        public function repayment()
        {
            return view('document-exports.so-repayment');
        }
        
        public function downPayment()
        {
            return view('document-exports.so-downPayment');
        }
    
        public function quotation()
        {
            return view('document-exports.so-quotation');
        }
    
        public function shipmentReceipt()
        {
            return view('document-exports.so-shipment-receipt');
        }
    
        public function customerSPK()
        {
            return view('document-exports.so-spk-customer');
        }
    
        public function vendorSPK()
        {
            return view('document-exports.so-spk-vendor');
        }
    
    
        // Laravel Snappy Plugin
        public function repaymentPaidExport()
        {
            return PDF::loadView('document-exports.exports.so-invoice-repayment-paid-export')
                      ->setPaper('a4')
                      ->stream('Invoice-BP-1234-Repayment-PAID.pdf');
        }
    
        public function repaymentExport()
        {
            return PDF::loadView('document-exports.exports.so-invoice-repayment-export')
                      ->setPaper('a4')->stream('Invoice-BP-1234-Repayment.pdf');
        }
    
        public function downPaymentExport()
        {
            return PDF::loadView('document-exports.exports.so-invoice-downpayment-export')
                      ->setPaper('a4')
                      ->stream('Invoice-Downpayment-BP-1234.pdf');
        }
    
        public function quotationExport()
        {
            return PDF::loadView('document-exports.exports.so-quotation-export')
                      ->setPaper('a4')->stream('Quotation-BP-1234.pdf');
        }
    
        public function shipmentReceiptExport()
        {
            return PDF::loadView('document-exports.exports.so-shipment-receipt-export')
                      ->setPaper('a4')->stream('Shipment-Receipt-BP-1234.pdf');
        }
    
        public function customerSPKExport()
        {
            return PDF::loadView('document-exports.exports.so-spk-customer-export')
                      ->setPaper('a4')->stream('SPK-Customer-BP-1234.pdf');
        }
    
        public function vendorSPKExport()
        {
            return PDF::loadView('document-exports.exports.so-spk-vendor-export')
                      ->setPaper('a4')->stream('SPK-Vendor-BP-1234.pdf');
        }
        
    }
