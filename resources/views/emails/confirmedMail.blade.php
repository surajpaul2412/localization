<!DOCTYPE html>
<html>
<head>
    <title>GetBeds</title>
</head>
<body>
    <h1>{{ $mailDetails['title'] }}</h1>
    <p style="font-weight: bold;">{{ $mailDetails['body'] }}</p>
    <p>voucher no. confirmed - {{$mailDetails['voucherNo']??''}}</p>
    <p>Thank you</p>
</body>
</html>