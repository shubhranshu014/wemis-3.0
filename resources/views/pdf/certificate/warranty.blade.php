<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Installation Certificate - Department Copy</title>
    <style>
        @page {
            size: A4;
            margin: 5mm;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 9px;
            /* Reduced font size */
        }

        .container {
            width: 100%;
            display: table;
            table-layout: fixed;
            padding-bottom: 5mm;
        }

        .column {
            display: table-cell;
            width: 48%;
            padding: 5px;
            vertical-align: top;
        }

        .column h2 {
            font-size: 14px;
            margin-bottom: 5px;
        }

        .column p {
            margin: 3px 0;
        }

        .bordered {
            border: 1px solid black;
            border-radius: 5px;
            margin-top: 3px;
            margin-bottom: 3px;
            padding: 5px;
        }

        .vehicle-details {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
        }

        .vehicle-details td,
        .vehicle-details th {
            padding: 3px;
            text-align: center;
            border: 1px solid black;
        }

        .vehicle-details th {
            background-color: #f2f2f2;
        }

        /* Prevent content from breaking between pages */
        .container,
        .bordered,
        .vehicle-details {
            page-break-inside: avoid;
        }

        .container p {
            font-size: 8px;
        }

        .terms,
        .claims,
        .conditions,
        .repairs {
            font-size: 8px;
            line-height: 1.3;
        }

        h5,
        h4 {
            font-size: 10px;
            margin-bottom: 5px;
        }

        ul {
            font-size: 8px;
            margin-left: 15px;
        }

        /* Ensure image fits within the page */
        .img-fluid {
            width: 80px;
            height: 80px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="column">
            <h2><span style="border-bottom: 1px solid">Warranty Certificate</span></h2>
            <p>Department Copy</p>
        </div>
        <div class="column" style="text-align:right">
            @php
                $mfg = auth('manufacturer')->user();
            @endphp
            <!-- Use the full URL path for the image -->
            <img src="{{ "http://127.0.0.1:8000/storage/$mfg->logo" }}" class="img-fluid">
            <h6>An ISO 9001:2015 & NABCB Certified Company</h6>
        </div>
    </div>
    <div style="text-align: right; margin-top: 5mm;">
        <p>{{ date('d-m-Y') }}</p>
    </div>
    <div class="bordered">
        <h4 style="text-align: center">Vehicle Details</h4>
        <table class="vehicle-details">
            <tr>
                <th>Vehicle Owner Details</th>
                <th>Vehicle No</th>
                <th>Manufacture Year</th>
            </tr>
            <tr>
                <td>Name</td>
                <td>Vehicle No</td>
                <td>Manufacture Year</td>
            </tr>
            <tr>
                <td>Mobile No.</td>
                <td>Chassis No.</td>
                <td>Engine No.</td>
            </tr>
            <tr>
                <td>Address No.</td>
                <td>Vehicle Make</td>
                <td>State</td>
            </tr>
            <tr>
                <td>Email Id</td>
                <td>Vehicle Model</td>
                <td>RTO Code</td>
            </tr>
        </table>
    </div>
    <div class="bordered">
        <h4 style="text-align: center;">VLTD details: Manufactured by: {{ $mfg->businees_name }}</h4>
        <table class="vehicle-details">
            <tr>
                <td>Model</td>
                <td>Type / Tac No</td>
                <td>Invoice No</td>
            </tr>
            <tr>
                <td>IMEI No</td>
                <td>Installation Date</td>
                <td>Invoice Date</td>
            </tr>
            <tr>
                <td>ICCID No</td>
                <td>Recalibration Date</td>
                <td>Primary SIM NO</td>
            </tr>
            <tr>
                <td>ICCID No</td>
                <td>Recalibration Date</td>
                <td>Secondary SIM NO</td>
            </tr>
            <tr>
                <td>No. of SOS/Panic Button</td>
                <td></td>
                <td>Network Provider</td>
            </tr>
        </table>
    </div>
    <div class="bordered terms">
        <h5>TERMS for Warranty</h5>
        <p>{{ $mfg->businees_name }} guarantees the TRAXO101 tracker (applicable to all TRAXO trackers unless stated
            separately) to conform to specifications at the time of manufacture. Warranty is valid for 24 months for the
            Tracker and accessories. You must inform TRAXO immediately if the Tracker is defective.</p>
    </div>
    <div class="bordered claims">
        <h5>CLAIMS</h5>
        <p>For warranty claims, the device must be sent to TRAXO Office at Plot No: 443/4516, ITI Chowk, Balasore,
            Odisha, 756001, with customer details and proof of purchase. For devices fitted to vehicles, first drive to
            an authorized service center for analysis.</p>
    </div>
    <div class="bordered">
        <h5>WHAT IS NOT COVERED BY THE WARRANTY</h5>
        <p>Warranty is not covered for defects due to misuse, tampering, or unauthorized repairs. The following points
            are not covered:</p>
        <ul>
            <li>Defects due to abnormal usage or non-standard environments.</li>
            <li>Defects from misuse, accidents, or intentional damage.</li>
            <li>Improper testing or unauthorized modifications.</li>
            <li>Tamper seals broken by unauthorized persons.</li>
            <li>Excessive force or alterations to the device.</li>
            <li>Unauthorized disassembly or repairs.</li>
            <li>Exposure to unapproved environments or conditions.</li>
            <li>Accessories not manufactured by TRAXO101.</li>
        </ul>
    </div>
    <div class="bordered conditions">
        <h5>CONDITIONS</h5>
        <p>The warranty does not apply if serial numbers are altered. TRAXO101 reserves the right to refuse warranty
            service if documentation is missing or incompatible. Repair may involve software flashing or part
            replacements. Replaced parts are warranted for the remainder of the original warranty period.</p>
    </div>
    <div class="bordered repairs">
        <h5>REPAIRS and SERVICES for Out of Warranty</h5>
        <p>After warranty expiration, TRAXO may offer repairs at a cost borne by the customer as specified by TRAXO.</p>
    </div>
    <div class="container">
        <div class="column">
            <p>Customer Sign</p>
        </div>
        <div class="column">
            <p>Dealer / RFC / Installer Sign</p>
        </div>
        <div class="column" style="background-color: #260950;color:#fff;text-transform:capitalize;text-align:center">
            <h3>{{ $mfg->businees_name }}</h3>
            <p>{{ $mfg->address }}, {{ $mfg->state }}, {{ $mfg->country }}</p>
        </div>
    </div>
</body>

</html>
