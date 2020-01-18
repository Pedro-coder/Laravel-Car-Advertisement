<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <style type="text/css" rel="stylesheet" media="all">
        /* Media Queries */
        @media only screen and (max-width: 500px) {
            .button {
                width: 100% !important;
            }
        }
    </style>
</head>

<?php
$style = [
    /* Layout ------------------------------ */
    'body' => 'margin: 0; padding: 0; width: 100%; background-color: #F2F4F6;',
    'email-wrapper' => 'width: 100%; margin: 0; padding: 0; background-color: #F2F4F6;',
    /* Masthead ----------------------- */
    'email-masthead' => 'padding: 25px 0; text-align: center;',
    'email-masthead_name' => 'font-size: 16px; font-weight: bold; color: #2F3133; text-decoration: none; text-shadow: 0 1px 0 white;',
    'email-body' => 'width: 100%; margin: 0; padding: 0; border-top: 1px solid #EDEFF2; border-bottom: 1px solid #EDEFF2; background-color: #FFF;',
    'email-body_inner' => 'width: auto; max-width: 570px; margin: 0 auto; padding: 0;',
    'email-body_cell' => 'padding: 35px;',
    'email-footer' => 'width: auto; max-width: 570px; margin: 0 auto; padding: 0; text-align: center;',
    'email-footer_cell' => 'color: #AEAEAE; padding: 35px; text-align: center;',
    /* Body ------------------------------ */
    'body_action' => 'width: 100%; margin: 30px auto; padding: 0; text-align: center;',
    'body_sub' => 'margin-top: 25px; padding-top: 25px; border-top: 1px solid #EDEFF2;',
    /* Type ------------------------------ */
    'anchor' => 'color: #3869D4;',
    'header-1' => 'margin-top: 0; color: #2F3133; font-size: 19px; font-weight: bold; text-align: left;',
    'paragraph' => 'margin-top: 0; color: #74787E; font-size: 16px; line-height: 1.5em;',
    'paragraph-sub' => 'margin-top: 0; color: #74787E; font-size: 12px; line-height: 1.5em;',
    'paragraph-center' => 'text-align: center;',
    /* Buttons ------------------------------ */
    'button' => 'display: block; display: inline-block; width: 200px; min-height: 20px; padding: 10px;
                 background-color: #3869D4; border-radius: 3px; color: #ffffff; font-size: 15px; line-height: 25px;
                 text-align: center; text-decoration: none; -webkit-text-size-adjust: none;',
    'button--green' => 'background-color: #22BC66;',
    'button--red' => 'background-color: #dc4d2f;',
    'button--blue' => 'background-color: #3869D4;',
];
?>

<?php $fontFamily = 'font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif;'; ?>

<body style="{{ $style['body'] }}">
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td style="{{ $style['email-wrapper'] }}" align="center">
                <table width="100%" cellpadding="0" cellspacing="0">
                    <!-- Logo -->
                    <tr>
                        <td style="{{ $style['email-masthead'] }}">
                            <a style="{{ $fontFamily }} {{ $style['email-masthead_name'] }}" href="{{ url('/') }}" target="_blank">
                                {{ config('app.name') }}
                            </a>
                        </td>
                    </tr>

                    <!-- Email Body -->
                    <tr>
                        <td style="{{ $style['email-body'] }}" width="100%">
                            <table style="{{ $style['email-body_inner'] }}" align="center" width="570" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="{{ $fontFamily }} {{ $style['email-body_cell'] }}">
                                    
                                        <!-- Action Button -->
                                        <table width="630" border="0" align="center" cellpadding="0" cellspacing="0">
                                            <tbody>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td bgcolor="#FFFFFF" style="padding:15px;border:1px solid #e5e5e5">
                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                        <tbody>
                                                        <tr bgcolor="#ffffff">
                                                            <td>
                                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                <tbody>
                                                                {{-- <tr>
                                                                    <td height="60"><img src="http://test.tellinmedicinellc.com/unnamed.png" alt="Tellinmedicine" title="Logo" style="display:block; width:500px !important; height:200px;padding-left:10px" class="CToWUd"></td>
                                                                    
                                                                </tr> --}}
                                                                </tbody>
                                                            </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td height="10"></td>
                                                        </tr>
                                                        <tr>
                                                            <td height="1" bgcolor="#dddddd"></td>
                                                        </tr>
                                                        <tr>
                                                            <td height="10"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                            <strong> Hello ,</strong><br>
                                                            <br>Following Appointment is send to doctor for approval &nbsp;based on your request.<br> <br>
                                                                Below are the details - <br>
                                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                <tbody>
                                                               
                                                                <tr>
                                                                    <td>Email ID</td>
                                                                    <td><a href="mailto:" target="_blank">{{$event->id}}</a></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Patient Name</td>
                                                                    {{-- <td>{{$appointment->patient_first_name}} {{$appointment->patient_last_name}}</td> --}}
                                                                </tr>
                                                                <tr>
                                                                    <td>Phone No.</td>
                                                                    {{-- <td>{{$appointment->phone}}</td> --}}
                                                                </tr>
                                                                <tr>
                                                                    <td>Address</td>
                                                                    {{-- <td>{{$appointment->address}}</td> --}}
                                                                </tr>
                                                                <tr>
                                                                    <td>Patient Type</td>
                                                                    {{-- <td>{{$appointment->patient_type}}</td> --}}
                                                                </tr>
                                                                <tr>
                                                                    <td>Appointment Type</td>
                                                                    {{-- <td>{{$appointment->appointment_type}}</td> --}}
                                                                </tr>
                                                                <tr>
                                                                    <td>Appoinntment Date</td>
                                                                    {{-- <td>{{$appointment->appointment_date}}</td> --}}
                                                                </tr>
                                                                <tr>
                                                                    <td>Appoinntment Time</td>
                                                                    {{-- <td>{{$appointment->appointment_time}}</td> --}}
                                                                </tr>
                                                                <tr>
                                                                    {{-- <td colspan="2">Package Details -</td> --}}
                                                                </tr>
                                                                </tbody>
                                                                </table>
                                                                {{-- <br>
                                                                <a style="background:#f26500 none repeat scroll 0 0;border:0 none;border-radius:3px;color:#fff;font-size:16px;padding:4px 19px;text-transform:uppercase;text-decoration:none" name="m_2048129593438973612_book_now" id="m_2048129593438973612book_now" href="#" target="_blank" data-saferedirecturl="https://www.google.com/">Book Now</a>
                                                                <br><br>
                                                                <br>To make a booking, click the book now button. Alternatively, you can also open this quote and complete the booking by entering the Quote Number on our website.<br>
                                                                <br>Kind Regards<br>{{ config('app.name') }}<br>
                                                                <br><span>For any query or assistance, feel free to&nbsp;
                                                                    <a href="#" rel="nofollow" target="_blank">Contact Us</a>
                                                                    &nbsp;on 02 7909 5001.</span><br> 
                                                                </td> --}}
                                                            </tr>
                                                            <tr>
                                                                <td>&nbsp;</td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="color:#fff;text-align:center;background-color:#131418;padding:8px 0">© {{ config('app.name') }}. All rights reserved.</td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Footer -->
                    
                </table>
            </td>
        </tr>
    </table>
</body>
</html>