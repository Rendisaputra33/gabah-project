<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <title>Landing Page</title>

</head>

<body>
    <input type="hidden" name="url" id="baseurl" value="{{ baseUrl() }}">
    <input type="hidden" name="token" id="token" value="{{ csrf_token() }}">

    <div class="container">
        <div class="header">
            <img src="{{ asset('assets/informent.svg') }}" alt="">
        </div>
        <div class="hero-content">
            <div class="text">
                <div class="title">
                    <h4>SELAMAT DATANG DI</h4>
                    <h2>WEB PENGELOLAAN GABAH</h2>
                </div>
                <div class="buttons">
                    <button onclick="document.getElementById('id01').style.display='block'" type="button"
                        class="button-text">Get Started</button>
                </div>
            </div>
            <div class="svg">
                <img src="{{ asset('assets/ilustration-orange.svg') }}" alt="">
            </div>
        </div>
    </div>

    <div class="w3-container">
        <div id="id01" class="w3-modal">
            <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">

                <div class="w3-center"><br>
                    <span onclick="document.getElementById('id01').style.display='none'"
                        class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
                </div>

                <form class="w3-container" action="">
                    <div class="w3-section">
                        <input type="hidden" id="kodepenerimaan" value="">
                        <label><b>Email</b></label>
                        <input class="w3-input w3-border w3-margin-bottom" type="text" id="email" name="email" required>
                        <label><b>Password</b></label>
                        <input class="w3-input w3-border w3-margin-bottom" type="password" id="password" name="password"
                            required>

                        <button class="button-text" type="button" id="send">Input</button>
                    </div>
                </form>
            </div>
        </div>
        <script src="{{ asset('js/Auth.js') }}"></script>
</body>

</html>
