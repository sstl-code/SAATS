<!DOCTYPE html>
<html>

<head>
    <title>ATS Login Credentials</title>
</head>
<body>
    <p>Dear User,</p>

    <p>Login have been activated for you to access Asset Tracking System (ATS) with the following:</p>

    <p>Email:  {{ $user->email }}</p>
    {{-- <p>Password: Password@123</p> --}}
    <p>Password: {{ $password }}</p>

    <p>Use the link below to access the  Web Portal:</p>
    <a href="http://115.113.197.12/usermanagement/public/login">View Web Portal</a>

    <p>Also, download and install the ATS Mobile App from the Play Store.</p>

    <p>Thanks,<br>ATS Administrator</p>
</body>
</html>

