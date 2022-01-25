<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;

    class VendorPrintableController extends Controller
    {
        public function orderInvoice()
        {
            return view('document-exports.vendor-invoice-tagihan-order');
        }

        public function orderInvoicePaid()
        {
            return view('document-exports.vendor-invoice-tagihan-order-paid');
        }

        public function vendorSPK()
        {
            return view('document-exports.vendor-spk');
        }

        public function billOfMaterial()
        {
            return view('document-exports.vendor-bill-material');
        }

        public function deliveryOrder()
        {
            return view('document-exports.vendor-delivery-order');
        }

        public function qcResult()
        {
            return view('document-exports.vendor-qc-result');
        }


        public function orderInvoiceExport()
        {
            return PDF::loadView('document-exports.exports.vendor-invoice-tagihan-order-export')
                      ->setPaper('a4')
                      ->stream('Invoice-Order-BP-1234-Vendor-One.pdf');
        }

        public function orderInvoicePaidExport()
        {
            return PDF::loadView('document-exports.exports.vendor-invoice-tagihan-order-paid-export')
                      ->setPaper('a4')
                      ->stream('Invoice-Order-BP-1234-Vendor-One-PAID.pdf');
        }

        public function vendorSPKExport()
        {
            return PDF::loadView('document-exports.exports.vendor-spk-export')
                      ->setPaper('a4')
                      ->stream('SPK-BP-1234-Vendor-One-PAID.pdf');
        }

        public function billOfMaterialExport()
        {
            return PDF::loadView('document-exports.exports.vendor-bill-material-export')
                      ->setPaper('a4')
                      ->setOrientation('landscape')
                      ->stream('Bill-Of-Material-BP-1234-Vendor-One.pdf');
        }

        public function deliveryOrderExport()
        {
            return PDF::loadView('document-exports.exports.vendor-delivery-order-export')
                      ->setPaper('a4')
                      ->stream('Delivery-Order-BP-1234-Vendor-One.pdf');
        }

        public function qcResultExport()
        {
            return PDF::loadView('document-exports.exports.vendor-qc-result-export')
                      ->setPaper('a4')
                      ->stream('QC-Vendor-BP-1234-Vendor-One.pdf');
        }
    }
