<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shortlisted</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        p{
            margin-top: 42px;
            margin-bottom: 0;
        }
    </style>
</head>
<body style="margin: 0; padding: 0; box-sizing: border-box; font-family: 'Helvetica Neue', sans-serif; ">

<div class="brand-logo" style="padding: 41px 0 60px 0; text-align: center; border-bottom: 1px solid #818a8f;">
    <a href="#"><img src="{{ asset('upload_file/'.$obj->logo) }}" alt="NSC" style="height: 88px;"></a>
</div>
<div class="mail-content" style="padding: 73px 83px 64px 84px; font-size: 28px; font-family: 'Helvetica Neue', sans-serif; font-weight: 400; text-align: left; color: #003150; line-height: normal;">

    <p>Hi
    <br> Your Verification code is {{ $six_digit_random_number }}.
     </p>

    <p style="font-weight: 400; font-size: 21px; margin-top: 65px;">Kind regards, <br> {{$obj->name}}</p>
</div>

</body>
</html>
