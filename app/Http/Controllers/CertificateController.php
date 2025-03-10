<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class CertificateController extends Controller
{
    public function downloadPDF(Request $request)
    {
        
        $type = $request['type'];
        $barcode = $request['deviceId'];
        $letterHead = $request['letterHead'];
        $certificate = $request['certificate'];
        if ($type == 'department_copy' && $letterHead == 'allow' && $certificate == 'installation') {
            // Data to pass to the view
            $data = ['title' => 'Laravel PDF Example', 'content' => 'This is a test content for the PDF.'];


            $pdf = Pdf::loadView('pdf.certificate.installation', $data);
            $pdf->set_option('isRemoteEnabled', true);
            return $pdf->download('installation_certificate.pdf');
            // return view('pdf.certificate.installation');
        } elseif ($type == 'department_copy' && $letterHead == 'allow' && $certificate == 'warranty') {
            echo $certificate;
            $data = ['title' => 'Laravel PDF Example', 'content' => 'This is a test content for the PDF.'];
            $pdf = Pdf::loadView('pdf.certificate.warranty', $data);
            $pdf->set_option('isRemoteEnabled', true);
            return $pdf->download('warranty.pdf');
        }elseif ($type == 'department_copy' && $letterHead == 'allow' && $certificate == 'fitment') {
            $data = ['title' => 'Laravel PDF Example', 'content' => 'This is a test content for the PDF.'];
            $pdf = Pdf::loadView('pdf.certificate.fitment', $data);
            $pdf->set_option('isRemoteEnabled', true);
            return $pdf->download('fitment.pdf');
        }

        #return view('pdf.certificate.installation');


    }
}
