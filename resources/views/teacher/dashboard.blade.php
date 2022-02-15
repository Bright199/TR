<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TREnglish</title>
</head>

<body>
    <h1>This is teacher dashboard</h1>
    <a class="dropdown-item" href="{{ route('teacher.logout') }}"
        onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
        {{ __('Logout') }}
    </a>

    <form id="logout-form" action="{{ route('teacher.logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</body>

</html>