<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <style>
        .auth.outer{
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .auth .inner{
            display: flex;
            width: 500px;
            height: 300px;
            border-radius: 6px;
            overflow: auto;
            box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
        }

        .auth .link-inner-holder{
            position: relative;
        }

        .auth .home-link-holder{
            right: 10px; 
            top: -30px;
            position: absolute;
        }

        .auth .home-link-holder a{
            text-decoration: none;
            color: initial;
            font-size: 18px;
        }

        .auth .home-link-holder a:hover > i{
            transition: transform 0.3s ease;
            transform: translateX(-10px);
        }

        .auth .inner .left{
            display: flex;
            flex-direction: column;
            width: 40%;
            background-color: #47b2e6;
            padding: 40px 30px;
            color: #fff;
        }

        .auth .inner .left .title{
            font-size: 32px;
        }

        .auth .inner .left .welcome-message{
            margin-top: 20px;
            font-size: 18px;
        }

        .auth .inner .right{
            width: 60%;
            padding: 40px 30px;
        }

        .auth .inner .right form{
            display: flex;
            width: 100%;
            flex-direction: column;
        }

        .auth .inner .right form>input{
            width: calc(100% - (2 * 14));
            padding: 14px;
            border-radius: 40px;
            border: 1px solid lightgray;
            margin-bottom: 20px;
        }

        .auth .inner .right form>input:focus{
            border: 2px solid #47b2e6;
            outline: none;
        }

        .auth .inner .right form .control{
            font-size: 18px;
        }

        .auth .inner .right form .control button{
            color: #47b2e6;
            background-color: #fff;
            padding: 15px 20px;
            border-radius: 30px;
            border: none;
            box-shadow: rgba(17, 12, 46, 0.15) 0px 48px 100px 0px;
        }

        .auth .inner .right form .control span{
            margin: 0px 10px;
        }

        .auth .inner .right form .control a{
           font-weight: 700;
           color: #47b2e6;
           text-decoration: none;
        }

        .auth .inner .right form .control button:hover,
        .auth .inner .right form .control a:hover {
            cursor: pointer;
            transition: all .2s ease-in-out;
            transform: scale(1.1);
        }

        .auth .inner .right form .control a:hover {
            font-size: 20px;
        }
    </style>

    <div class="auth outer">
        <div class="link-inner-holder">
            <div class="home-link-holder">
                <a href="{{ route('home') }}">
                    <i class="fa-solid fa-arrow-right"></i>
                    Home
                </a>
            </div>
            <div class="inner">
                <div class="left">
                    <span class="title"> Login </span>
                    <span class="welcome-message"> Sign in and find your destination. </span>
                </div>
                <div class="right">
                    <form action="{{ route('login.post') }}" method="POST">
                        @csrf
                        <input name="email" type="email" placeholder="Enter emal address">
                        <input name="password" type="password" placeholder="Enter password">
                        <div class="control">
                            <button type="submit"> Login </button>
                            <span> or </span>
                            <a href="{{ route('register') }}"> Register </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>