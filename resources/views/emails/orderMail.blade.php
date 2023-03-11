<!DOCTYPE html>
<html>
<head>
    <title>GetBeds</title>
</head>
<body>
    <h1>{{ $mailDetails['title'] }}</h1>
    <p style="font-weight: bold;">{{ $mailDetails['body'] }}</p>
    <p>Your booking reference number is  --<strong>{{ $mailDetails['orderNo'] }}</strong>.You will receive your confirmed booking vouchers in next email with in 15-20 minutes</p>   
    <p>Thank you</p>
</body>
</html>