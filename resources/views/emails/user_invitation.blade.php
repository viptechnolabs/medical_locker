<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shortlisted</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        p {
            margin-top: 42px;
            margin-bottom: 0;
        }
    </style>
</head>
<body style="margin: 0; padding: 0; box-sizing: border-box; font-family: 'Helvetica Neue', sans-serif; ">
<div class="brand-logo" style="padding: 41px 0 60px 0; text-align: center; border-bottom: 1px solid #818a8f;">
    <a href="#">
        <img src="{{ asset('images/logo-portal.svg') }}" alt="logo">
    </a>
</div>
<div class="mail-content"
     style="padding: 73px 83px 64px 84px; font-size: 28px; font-family: 'Helvetica Neue', sans-serif; font-weight: 400; text-align: left; color: #003150; line-height: normal;">
    <h2 style="font-size: 46px; color: #000000; font-weight: 700; text-align: left;">You've been invited!</h2>
    <p>Hello,</p>
    <p style="margin-top: 0px">You have been invited to join as {{ ($type === "consultant") ? "'a Consultant'" : "'Industry Partner'" }} with Naval Shipbuilding College. <br/>Please create your account by clicking on the button below.</p>
    <p style="margin-top: 70px;">
        <a href="{{ $url }}"
           style="font-size: 21px; text-align: center; color: #ffffff; font-weight: 700; padding: 13px 39px 14px; background-color: #005293; text-decoration: none; border-radius: 25px;">
            Create Account
        </a>
    </p>
    <p style="font-weight: 400; font-size: 21px; margin-top: 65px;">Kind regards, <br> The NSC team.</p>
</div>

</body>
</html>
