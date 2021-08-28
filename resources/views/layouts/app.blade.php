<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    @yield('css-home')
    @yield('css-add')
    @yield('css-drying')
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">


<body>
    <input type="hidden" name="url" id="baseurl" value="{{ baseUrl() }}">
    <input type="hidden" name="token" id="token" value="{{ csrf_token() }}">


    <ul>
        <div class="profile">
            <div class="avatar">
                <span class="material-icons-outlined">
                    account_circle
                </span>
            </div>
            <div class="username">
                <p>username panjang</p>
            </div>

        </div>
        <li class="list"><a title="Home" href="{{ url('/home') }}"><span class="material-icons-outlined">grid_view</span></a></li>
        <li class="list"><a title="Penjualan" class="{{ request()->is('home') ? 'active' : null }}" href="{{ url('/home') }}"><span class="material-icons-outlined">paid</span></a></li>
        <li class="list"><a title="Gabah Kering" class="{{ request()->is('gabah/kering') ? 'active' : '' }}" href="/gabah/kering"><span class="material-icons-outlined">wb_sunny</span></a></li>
        <li class="list"><a title="Penggilingan" class="{{ request()->is('gabah/giling') ? 'active' : '' }}" href="/gabah/giling"><span class="material-icons">timer</span></a></li>
        <!-- <li><a class="add {{ request()->is('gabah/add') ? 'active' : '' }}" href="/gabah/add"><img src="{{ asset('assets/plus.svg') }}"></a></li> -->
        <li class="list"><a title="Penjualan" class="{{ request()->is('penjualan') ? 'active' : '' }}" href="/penjualan"><span class="material-icons">storefront</span></a></li>
        <li class="list"><a title="Pengambilan" class="{{ request()->is('pengambilan') ? 'active' : '' }}" href="/pengambilan"><span class="material-icons-outlined">delivery_dining</span></a></li>
        <li class="list"><a title="Link To Admin" href="/admin"><span class="material-icons">link</span></a></li>
        <li class="list"><a title="Logout" class="add {{ request()->is('gabah/add') ? 'active' : '' }}" id="logout" href="/logout"><span class="material-icons">logout</span></a></li>
    </ul>

    <script src="{{ asset('js/log.js') }}"></script>

    @yield('content')



</body>

</html>
