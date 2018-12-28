<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Styles -->
</head>
<body>
    <div style="font-size: 8pt; display: block; width: 2in; text-align: center; white-space: nowrap; border: 0.1px solid #000;">
        <div style="padding: 5px">
            <span style="font-size: 9pt;">
                <img src="{{ public_path() . '/img/dost.png' }}" alt="logo" height="12px"> DOST Caraga Region
            </span>
            <small>{!! $tracker->userEmployee->office->officeFullTitle !!}</small>
            <br>
            <p style="margin: 0;">{!! $tracker->barcodeLogo !!}</p>
            <small>{!! $tracker->trackingDate !!}</small>
        </div>
    </div>
</body>
</html>