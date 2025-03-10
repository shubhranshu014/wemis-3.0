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
            font-size: 10px;
            /* Reduced font size */
        }

        .container {
            width: 100%;
            display: table;
            table-layout: fixed;
        }

        .column {
            display: table-cell;
            width: 48%;
            padding: 5px;
            vertical-align: top;
        }

        .column h2 {
            font-size: 16px;
            /* Reduced font size */
            margin-bottom: 5px;
        }

        .column p {
            margin: 5px 0;
        }

        .bordered {
            border: 1px solid black;
            border-radius: 10px;
            margin-top: 5px;
            margin-bottom: 5px;
        }

        .vehicle-details {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .signature {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
            text-align: center;
        }

        .signature th,
        .vehicle-details td {
            padding: 6px;
            /* Reduced padding */
            text-align: center;
            border: 1px solid black;
        }

        .vehicle-details th {
            background-color: #f2f2f2;
        }

        /* Prevent content from breaking between pages */
        .container,
        .bordered,
        .vehicle-details,
        .signature {
            page-break-inside: avoid;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="column">
            <h2><span style="border-bottom: 1px solid ">Installation Certificate</span></h2>
            <p>Department Copy</p>
        </div>
        <div class="column" style="text-align:right">
            @php
                $mfg = auth('manufacturer')->user();
            @endphp
            <!-- Use the full URL path for the image -->
            <img src="{{"http://127.0.0.1:8000/storage/$mfg->logo"}}"
                class="img-fluid" style="width: 100px;height:100px">
            <h6>An ISO 9001:2015 & NABCB Certified Company</h6>
        </div>
    </div>
    <div style="text-align: right">
        <p>{{ date('d-m-Y') }}</p>
    </div>
    <div>
        <p>
            To, <br>
            The R.T.O / J.R.T.O <br>
            Odisha
        </p>
        <p>
            This is to certify that the VLTD (Vehicle Location Tracking System) fitted on the below detailed vehicle,
            is approved by the ICAT vide TAC No. CN8757 dated: 22/06/2024. During installation, it was thoroughly
            tested with all functionality as per AIS140 standard, and the VLTD device is working properly. Unless the
            VLTD device is not receiving proper GSM/GPS signals or is tampered with by unauthorized
            individuals/technicians.
        </p>
    </div>

    <div class="bordered">
        <h4 style="text-align: center">Vehicle Details</h4>
        <table class="vehicle-details">
            <tr>
                <th><span style="border-bottom: 1px solid">Vehicle Owner Details</span></th>
                <th><span style="border-bottom: 1px solid">Vehicle No</span></th>
                <th><span style="border-bottom: 1px solid">Manufacture Year</span></th>
            </tr>
            <tr>
                <td>Name</td>
                <td>Vehicle No</td>
                <td>Manufacture Year</td>
            </tr>
            <tr>
                <td>MObile No.</td>
                <td>Chassis No.</td>
                <td>Engine No.</td>
            </tr>
            <tr>
                <td>Address No.</td>
                <td>Vehical Make</td>
                <td>State</td>
            </tr>
            <tr>
                <td>Email Id</td>
                <td>Vehical Model</td>
                <td>RTO Code</td>
            </tr>
        </table>
    </div>

    <div class="bordered">
        <h4 style="text-align: center">VLTD details: Manufactured by : {{ $mfg->businees_name }}</h4>
        <table class="vehicle-details">
            <tr>
                <td><span>Model</span></td>
                <td><span>Type / Tac No</span></td>
                <td><span>Invoice No</span></td>
            </tr>
            <tr>
                <td><span>IMEI No</span></td>
                <td><span>Installation Date</span></td>
                <td><span>Invoice Date</span></td>
            </tr>
            <tr>
                <td><span>ICCID No</span></td>
                <td><span>Recalibration Date</span></td>
                <td><span>Primary SIM NO ( Network Provider Name)</span></td>
            </tr>
            <tr>
                <td><span>ICCID No</span></td>
                <td><span>Recalibration Date</span></td>
                <td><span>Primary SIM NO ( Network Provider Name)</span></td>
            </tr>
            <tr>
                <td>NO. Of SOS/Panic Button</td>
                <td></td>
                <td>Secondary SIM NO ( Network Provider Name)</td>
            </tr>
        </table>
    </div>

    <h2> VALID FOR THE STATE OF ODISHA </h2>
    <table class="vehicle-details">
        <tr>
            <td> TRAXO INDIA AUTOMATION Vehicle Location Tracker (VLT) </td>
            <td> Serial No : TIA/072024A4993 </td>
        </tr>
        <tr>
            <td>Installation Date : 25/09/2024 </td>
            <td>Renewal Due Date : 25/09/2026</td>
        </tr>
    </table>

    <table class="signature">
        <tr>
            <td> Dealers seal & Signature </td>
            <td> Customer Signature </td>
            <td> Authorised Signature </td>
        </tr>
    </table>

    <div class="bordered" style="text-align: center; background-color:#260950; color:#fff; text-transform: capitalize;">
        <h3>{{ $mfg->businees_name }}</h3>
        <p>{{ $mfg->address }},{{ $mfg->state }},{{ $mfg->country }},</p>
    </div>
</body>

</html>
