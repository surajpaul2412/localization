<!DOCTYPE html>
<html>
<head>
    <title>GetBeds</title>
</head>
<body>
    <h1>{{ $adminMailDetails['title'] }}</h1>
    <p style="font-weight: bold;">{{ $adminMailDetails['body'] }}</p>
    <p>A new booking reference number is  --<strong>{{ $adminMailDetails['orderNo'] }}</strong> has been placed.</p>   
    <p>Thank you</p>
</body>
</html>