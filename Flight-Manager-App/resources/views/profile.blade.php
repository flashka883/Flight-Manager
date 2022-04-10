<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> @php env('APP_NAME'); @endphp </title>
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- Toastr --}}
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body>
    <style>
        @import "toastr";

        * {
            box-sizing: border-box;
        }

        body {
            display: flex;
            margin: 0px;
        }

        a {
            color: initial;
            text-decoration: none;
        }

        /* Page Content */
        .page-content {
            flex: 0 0 76%;
            display: flex;
            flex-direction: column;
            margin-left: 24vw;
            padding: 40px;
            background-color: #fff;
            /* background-color: #f8f8f8; */
        }

        /* Profile */

        .page-content .profile {
            display: flex;
            justify-content: center;
            flex-direction: column;
            padding: 30px;
            background-color: #f8f8f8;
            border-radius: 3px;
            box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
        }

        .page-content .profile-holder {
            display: flex;
            justify-content: center;
        }

        .page-content .profile-holder .left {
            width: 30%;
            display: flex;
            padding-right: 6%;
            flex-direction: column;
        }

        .page-content .profile-holder .left .image-holder {
            width: 100%;
            display: flex;
            justify-content: left;
            align-items: center;
        }

        .page-content .profile-holder .left .image-holder img {
            width: 100%;
            border-radius: 100%;
        }

        .page-content .profile-holder .left #in-avatar {
            opacity: 0;
            height: 0px;
            width: 0px;
            position: absolute;
        }

        .page-content .profile-holder .left #avatar-btn {
            width: 100%;
            margin-top: 10px;
            padding: 16px 32px;
            border-radius: 30px;
            border: none;
            background-color: #e9ecef;
            color: #010502;
        }

        .page-content .profile-holder .left #avatar-btn:hover {
            cursor: pointer;
            transition: all .2s ease-in-out;
            transform: scale(1.08);
        }

        .page-content .profile-holder .right {
            width: 70%;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .page-content .profile-holder .right .row {
            width: 100%;
            display: flex;
        }

        .page-content .profile-holder .right .group {
            display: flex;
            width: 100%;
            flex-direction: column;
            justify-content: left;
            margin: 0px 20px 20px 0px;
        }

        .page-content .profile-holder .right .group>label {
            margin-bottom: 6px;
        }

        .page-content .profile-holder .right .group>input {
            box-sizing: border-box;
            width: 100%;
            padding: 14px;
            border-radius: 40px;
            border: 1px solid lightgray;
        }

        .page-content .profile-holder .right .group>input:focus {
            border: 1px solid #47b2e6;
            box-shadow: 0 0 0 1px #47b2e6;
            outline: none;
        }

        .page-content .profile-holder .right .control {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .page-content .profile-holder .right .control>.btn {
            color: #47b2e6;
            background-color: #fff;
            padding: 15px 20px;
            border-radius: 30px;
            border: none;
            box-shadow: rgba(17, 12, 46, 0.15) 0px 48px 100px 0px;
        }

        .page-content .profile-holder .right .control>.btn i {
            margin-right: 6px;
        }

        .page-content .profile-holder .right .control>.btn:hover {
            cursor: pointer;
            transition: all .2s ease-in-out;
            transform: scale(1.08);
        }

    </style>

    @include('partials.sidebar')

    {{-- Page Content --}}
    <section class="page-content">
        <div class="profile">
            <div class="title-holder">
                <h2 class="title"> Account Update </h2>
            </div>
            <form action="{{ route('profile.post') }}" method="POST" class="profile-holder">
                @csrf
                <div class="left">
                    <div class="image-holder">
                        <img id="avatar"
                            src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/59/User-avatar.svg/1024px-User-avatar.svg.png"
                            alt="">
                    </div>
                    <div class="button-holder">
                        <button type="button" id="avatar-btn"> Browse </button>
                        <input type="file" name="avatar" id="in-avatar" accept="image/*">
                    </div>
                </div>
                <div class="right">
                    <div class="row">
                        <div class="group">
                            <label for="in-username">Username</label>
                            <input type="text" name="name" id="in-username" placeholder="Enter your username"
                                value="{{ $user->name }}">
                        </div>
                        <div class="group">
                            <label for="in-email">Email</label>
                            <input type="email" name="email" id="in-email" placeholder="Enter your email"
                                value="{{ $user->email }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="group">
                            <label for="in-first-name">First Name</label>
                            <input type="text" name="first_name" id="in-first-name" placeholder="Enter your first name"
                                value="{{ $user->first_name }}">
                        </div>
                        <div class="group">
                            <label for="in-last-name">Last Name</label>
                            <input type="text" name="last_name" id="in-last-name" placeholder="Enter your last name"
                                value="{{ $user->last_name }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="group">
                            <label for="in-egn">Egn</label>
                            <input type="text" name="egn" id="in-egn" placeholder="Enter your egn"
                                value="{{ $user->egn }}">
                        </div>
                        <div class="group">
                            <label for="in-phone">Phone</label>
                            <input type="text" name="phone" id="in-phone" placeholder="Enter your phone"
                                value="{{ $user->phone }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="group">
                            <label for="in-address">Address</label>
                            <input type="text" name="address" id="in-address" placeholder="Enter your address"
                                value="{{ $user->address }}">
                        </div>
                        <div class="group">
                            <label for="in-password">Password</label>
                            <input type="password" name="password" id="in-password" placeholder="Enter new password">
                        </div>
                    </div>
                    <div class="control">
                        <a href="{{ route('logout') }}" class="btn">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            Logout
                        </a>
                        <button type="submit" class="btn">
                            <i class="fa-solid fa-user"></i>
                            Save Profile
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    {{-- JQuery --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    {{-- My Scripts --}}
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#avatar').attr('src', e.target.result);
                    $('#avatar').height($('#avatar').width());
                    $('#in-avatar').val(e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        function updateAvatar() {
            $("#avatar-btn").click(function(e) {
                e.preventDefault();
                $('#in-avatar').click();
            });

            $("#in-avatar").change(function() {
                readURL(this);
            });
        }

        $(document).ready(function() {
            updateAvatar();

            if ("{{ $errors->any() }}") {
                toastr.error('{{ $errors->first() }}', 'Error!');
            }
            // if ({{ Session::has('message') }}) {
            //     toastr.error('{{ Session::get('msg') }}', 'Error!');
            // }
        });
    </script>
</body>

</html>
