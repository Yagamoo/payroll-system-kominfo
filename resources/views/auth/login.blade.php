<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Chicken Farm | Login</title>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">

    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <style>
        .floating-label {
            position: relative;
            margin-bottom: 20px;
        }

        .floating-label input {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .floating-label label {
            position: absolute;
            top: 50%;
            left: 12px;
            color: #888;
            transform: translateY(-50%);
            transition: all 0.2s ease;
            pointer-events: none;
            background: white;
            padding: 0 4px;
        }

        /* Saat input focus atau terisi */
        .floating-label input:focus+label,
        .floating-label input:not(:placeholder-shown)+label {
            top: -4px;
            font-size: 12px;
            color: #1ab394;
        }
    </style>

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>
                <h1 class="logo-name">PS</h1>
            </div>
            <h3>Welcome to Payroll System</h3>
            <p>Silakan login untuk data karyawan dan gaji.</p>
            @if ($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif
            <form class="m-t" role="form" action="{{ route('login.auth') }}" method="POST">
                @csrf
                <div class="form-group floating-label">
                    <input type="text" class="form-control" name="username" placeholder=" " required>
                    <label>Username</label>
                </div>

                <div class="form-group floating-label">
                    <input type="password" class="form-control" name="password" placeholder=" " required>
                    <label>Password</label>
                </div>

                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

                {{-- <a href="#"><small>Forgot password?</small></a>
                <p class="text-muted text-center"><small>Do not have an account?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="register.html">Create an account</a> --}}
            </form>
            <p class="m-t"> <small>Payroll System &copy; 2025</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>

</body>

</html>
