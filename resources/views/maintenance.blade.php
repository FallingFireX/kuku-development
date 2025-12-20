<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>

    {{-- Bootstrap CSS (CDN) --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Optional: your app CSS if you want branding --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="d-flex align-items-center justify-content-center vh-100">

    <div class="row justify-content-center">
        <div class="col-md-7 ml-auto">
            <img src="https://www.kukuri-arpg.com/files/Beauty_Contest_electric.png" width="100%">
        </div>
        <div class="col-md-5 mb-auto mt-auto">

            <h1 class="mb-3" style="font-size:60px">We’ll be back soon!</h1>
            <p style="font-size:20px">The site is currently undergoing maintenance.<br>
                We are adding exciting new stuff! Check back later to see whats new!</p>

        </div>
    </div>

    {{-- Bootstrap JS (CDN) --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
