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
    <style type="text/css">
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

        /* Flights */

        .page-content .trip-summary {
            display: flex;
            justify-content: center;
            flex-direction: column;
            padding: 30px;
            background-color: #f8f8f8;
            border-radius: 3px;
            box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
            margin-bottom: 40px;
        }

        .page-content .trip-summary .title {
            margin: 0px;
        }

        .page-content .trip-summary .flight {
            display: flex;
            justify-content: space-between;
            width: 100%;
            padding: 28px 22px 0px 22px;
            /* background-color: #f4f7f9; */
            box-shadow: rgba(0, 0, 0, 0.05) 0px 6px 24px 0px, rgba(0, 0, 0, 0.08) 0px 0px 0px 1px;
            border-radius: 3px;
            margin-top: 30px;
        }

        .page-content .trip-summary .flight .time-tags-holder {
            display: flex;
            font-size: 18px;
        }

        .page-content .trip-summary .flight .time-tags-holder .tags-holder .tag {
            border-radius: 50px;
            background-color: #e8f4fd;
            color: #005aa3;
            padding: 8px;
            border: 1px solid #005aa32c;
            margin: 0px 6px;
            font-weight: 400;
        }

        .page-content .trip-summary .flight .info-holder .info {
            font-size: 18px;
            font-weight: 100;
        }

        .page-content .trip-summary .flight .info-holder .info .time-country {
            font-size: 20px !important;
            font-weight: 800;
        }

        .page-content .trip-summary .flight .info-holder .info .time-country i {
            background-color: lightgray;
            padding: 8px;
            border-radius: 6px;
            margin-right: 10px;
        }

        .page-content .trip-summary .flight .right {
            flex: 0 0 20%;
            display: flex;
            justify-content: space-around;
            padding-bottom: 30px;
            align-items: center;
            flex-direction: column;
        }

        .page-content .trip-summary .flight .right .price {
            font-size: 42px;
        }

        .page-content .trip-summary .flight .right .book-btn {
            padding: 12px 40px;
            border-radius: 8px;
            background-color: #00ad98;
            font-size: 18px;
            font-weight: 600;
            color: #fff;
            margin-top: 20px;
            border: 2px solid #00ad98;
        }

        .page-content .trip-summary .flight .right .book-btn:hover {
            padding: 12px 40px;
            border-radius: 8px;
            color: #00ad98;
            font-size: 18px;
            font-weight: 600;
            background-color: #fff;
            margin-top: 20px;
        }

        .customer-info .outer {
            background-color: #f8f8f8;
        }

        /* Customer Info */
        .customer-info .inner {
            display: flex;
            border-radius: 6px;
            overflow: auto;
            background-color: #f8f8f8;
            box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
        }

        .page-content .trip-summary .title {
            margin: 0px;
        }

        .customer-info .inner .right {
            width: 100%;
            padding: 40px 30px;
        }

        .customer-info .inner .right form {
            display: flex;
            width: 100%;
            flex-direction: column;
        }

        .customer-info .inner .right form .group {
            display: flex;
        }

        .customer-info .inner .right form .group>input {
            width: 100%;
            padding: 14px;
            border-radius: 40px;
            border: 1px solid lightgray;
            margin-bottom: 20px;
            margin-right: 15px;
        }

        .customer-info .inner .right form .group>input:focus {
            border: 1px solid #47b2e6;
            box-shadow: 0 0 0 1px #47b2e6;
            outline: none;
        }

        .customer-info .inner .right form .control {
            font-size: 18px;
        }

        .customer-info .inner .right form .control button {
            color: #47b2e6;
            background-color: #fff;
            padding: 15px 20px;
            border-radius: 30px;
            border: none;
            box-shadow: rgba(17, 12, 46, 0.15) 0px 48px 100px 0px;
        }

        .customer-info .inner .right form .control span {
            margin: 0px 10px;
        }

        .customer-info .inner .right form .control a {
            font-weight: 700;
            color: #47b2e6;
            text-decoration: none;
        }

        .customer-info .inner .right form .control button:hover,
        .customer-info .inner .right form .control a:hover {
            cursor: pointer;
            transition: all .2s ease-in-out;
            transform: scale(1.1);
        }

        .customer-info .inner .right form .control a:hover {
            font-size: 20px;
        }

    </style>

    @include('partials.sidebar')

    {{-- Page Content --}}
    <section class="page-content">
        <div class="trip-summary">
            <h1 class="title">Trip summary</h1>
            <div class="flight">
                <div class="left">
                    <div class="time-tags-holder">
                        {{-- <span class="date">Wed Apr 27</span> --}}
                        <span class="date"> {{ $ticket->departs_at->format('l M d') }} </span>
                        <div class="tags-holder">
                            <span class="tag"> {{ $ticket->className }} </span>
                            {{-- <span class="tag"> One-way </span> --}}
                            <span class="tag">
                                {{ $ticket->lands_at->diff($ticket->departs_at)->format('%hh %Im') }} </span>
                        </div>
                    </div>
                    <div class="info-holder">
                        <h4 class="info">
                            <span class="time-country">
                                <i class="fa-solid fa-plane-departure"></i>
                                {{ $ticket->departs_at->format('H:i A') }}
                                &nbsp;
                                {{ $ticket->cityFrom }}
                            </span>
                            {{ $ticket->airPortFromName }}
                        </h4>
                        <h4 class="info">
                            <span class="time-country">
                                <i class="fa-solid fa-plane-arrival"></i>
                                {{ $ticket->lands_at->format('H:i A') }}
                                &nbsp;
                                {{ $ticket->cityTo }}
                            </span>
                            {{ $ticket->airPortToName }}
                        </h4>
                    </div>
                </div>
            </div>
        </div>
        @guest
            <div class="customer-info outer">
                <div class="inner">
                    <div class="right">
                        <h1 class="title">Purchase Form</h1>
                        <form action="{{ route('ticket.reserve.guest', $ticket->id) }}" method="GET">
                            @csrf
                            <div class="group">
                                <input name="first_name" type="text" placeholder="Enter first name">
                                <input name="middle_name" type="text" placeholder="Enter middle name">
                            </div>
                            <div class="group">
                                <input name="last_name" type="text" placeholder="Enter last name">
                                <input name="egn" type="text" placeholder="Enter egn">
                            </div>
                            <div class="group">
                                <input name="phone" type="text" placeholder="Enter phone number">
                                <input name="nationality" type="text" placeholder="Enter nationality">
                            </div>
                            <div class="control">
                                <button type="submit">
                                    <i class="fa-solid fa-arrow-right"></i>
                                    Checkout
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endguest

    </section>

    {{-- JQuery --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    {{-- My Scripts --}}
    <script>
        $(document).ready(function() {
            if ({{ $errors->any() }}) {
                toastr.error('{{ $errors->first() }}', 'Error!');
            }
        });
    </script>
</body>

</html>
