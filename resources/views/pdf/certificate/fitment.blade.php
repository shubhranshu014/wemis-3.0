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
            <h2><span style="border-bottom: 1px solid ">Fitment Certificate</span></h2>
            <p>Department Copy</p>
        </div>
        <div class="column" style="text-align:right">
            @php
                $mfg = auth('manufacturer')->user();
            @endphp
            <!-- Use the full URL path for the image -->
            <img src="{{ "http://127.0.0.1:8000/storage/$mfg->logo" }}" class="img-fluid"
                style="width: 100px;height:100px">
            <h6>An ISO 9001:2015 & NABCB Certified Company</h6>
        </div>
    </div>
    <div class="container">
        <div class="column">
            <p>Fitment Certificate No: TRAXOVLTD111100000</p>
        </div>
        <div class="column">
            <div style="text-align: right">
                <p>{{ date('d-m-Y') }}</p>
            </div>
        </div>
    </div>


    <div class="bordered">
        <div class="container">
            <div class="column">
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
            <div class="column">
            </div>
        </div>
    </div>

    <div class="bordered">
        <h4 style="text-align: center">Vehical Owner Details</h4>
        <table class="vehicle-details">
            <tr>
                <td><span>Name</span></td>
                <td><span>Mobile</span></td>
                <td><span>Address</span></td>
                <td><span>Email Id</span></td>
            </tr>
            <tr>
                <td><span>xxx</span></td>
                <td><span>xxx</span></td>
                <td><span>xxx</span></td>
                <td>xxx@xxx.com</td>
            </tr>
        </table>
    </div>
    <div class="bordered">
        <h4 style="text-align: center;text-tranform: capitalize">VLTD details: Manufactured by : {{$mfg->businees_name}}</h4>
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
    {{-- <div class="bordered"> --}}
        <table class="vehicle-details">
            <tr>
                <td><span>Dealer /Rfc / Installer </span></td>
                <td><span>Mobile Number</span></td>
                <td><span>Address</span></td>
                <td>Stamp & Sign</td>
            </tr>
            <tr>
                <td><span>xxx</span></td>
                <td><span>xxxx</span></td>
                <td><span>xxx</span></td>
                <td>xxx/td>
            </tr>
        </table>
    {{-- </div> --}}
    <p>This is to acknowledge confirm that we have got our vehicle bearing registration no OD11D973Z . VLT Device manufactured by TRAXO INDIA AUTOMATION bearing Sr. No………..  We have checked the performance of the vehicle after fitment of the said VLT device the unit is sealed and functioning as per norms laid out in AIS-140.We have satisfied with the performance of the unit in all respects. We undertake not to raise any dispute or any legal claims against TRAXO INDIA AUTOMATION in the event that the above mentioned seals at found broken/tampered. </p>

    <div class="container">
        <div class="column">
            <div class="bordered" style="margin:5px;height:100px">
                1
            </div>
        </div>
        <div class="column">
            <div class="bordered" style="margin:5px;height:100px">
                2
            </div>
        </div>
        <div class="column">
            <div class="bordered" style="margin:5px;height:100px">
                3
            </div>
        </div>
        <div class="column">
            <div class="bordered" style="margin:5px;height:100px">
                4
            </div>
        </div>
    </div>

    <div class="bordered" style="text-align: center; background-color:#260950; color:#fff; text-transform: capitalize;">
        <h3>{{ $mfg->businees_name }}</h3>
        <p>{{ $mfg->address }},{{ $mfg->state }},{{ $mfg->country }},</p>
    </div>
</body>

</html>
