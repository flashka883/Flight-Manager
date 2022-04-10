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
</head>

<body>
    <style>
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
            height: 100vh;
            display: flex;
            flex-direction: column;
            margin-left: 24vw;
        }

        .page-content .page-title-holder {
            text-align: center;
            margin-top: 40px;
        }

        .page-content .page-title-holder .page-title {
            font-size: 28px;
        }

        /* Flights */

        .page-content .flights-holder {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            padding: 30px
        }

        .page-content .flights-holder .flight {
            display: flex;
            justify-content: space-between;
            width: 100%;
            padding: 28px 22px 0px 22px;
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
            border-radius: 6px;
            margin-top: 30px;
        }

        .page-content .flights-holder .flight .time-tags-holder {
            display: flex;
            font-size: 18px;
        }

        .page-content .flights-holder .flight .time-tags-holder .tags-holder .tag {
            border-radius: 50px;
            background-color: #e8f4fd;
            color: #005aa3;
            padding: 8px;
            border: 1px solid #005aa32c;
            margin: 0px 6px;
            font-weight: 400;
        }

        .page-content .flights-holder .flight .info-holder .info {
            font-size: 18px;
            font-weight: 100;
        }

        .page-content .flights-holder .flight .info-holder .info .time-country {
            font-size: 20px !important;
            font-weight: 800;
        }

        .page-content .flights-holder .flight .info-holder .info .time-country i {
            background-color: lightgray;
            padding: 8px;
            border-radius: 6px;
            margin-right: 10px;
        }

        .page-content .flights-holder .flight .right {
            flex: 0 0 20%;
            display: flex;
            justify-content: space-around;
            padding-bottom: 30px;
            align-items: center;
            flex-direction: column;
            text-align: center;
        }

        .page-content .flights-holder .flight .right .status {
            display: flex;
            justify-content: center;
            align-content: center;
            flex-direction: column;
        }

        .page-content .flights-holder .flight .right .status i {
            font-size: 62px;
            color: green;
        }

        .page-content .flights-holder .flight .right .status i.danger {
            color: #df4759;
        }

        .page-content .flights-holder .flight .right .status span {
            margin-top: 10px;
            font-size: 16px;
        }

        .page-content .holder .btn {
            margin-top: 10px;
            color: #47b2e6;
            background-color: #fff;
            padding: 15px 20px;
            border-radius: 30px;
            border: none;
            box-shadow: rgba(17, 12, 46, 0.15) 0px 48px 100px 0px;
        }

        .page-content .holder .btn i {
            margin-right: 6px;
        }

        .page-content .holder .btn:hover {
            cursor: pointer;
            transition: all .2s ease-in-out;
            transform: scale(1.08);
        }

    </style>

    {{-- Side Bar --}}
    @include('partials.sidebar')

    {{-- Page Content --}}
    <section class="page-content">
        <div class="page-title-holder">
            <h1 class="page-title"> Booked Tickets </h1>
        </div>
        <div class="flights-holder">
            @foreach ($tickets as $ticket)
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
                    <div class="right">
                        <div class="price-holder">
                            <span class="status">
                                @if ($ticket->is_paid)
                                    <i class="fa-solid fa-check"></i>
                                    <span>Paid</span>
                                @else
                                    <i class="fa-solid fa-x danger"></i>
                                @endif
                            </span>
                        </div>
                        @if (!$ticket->is_paid)
                            <div class="holder">
                                <form
                                    action="{{ route('ticket.checkout', ['ticket' => $ticket->id,'reservedTicket' => $ticket->reserved_ticket_id,'guest' => false]) }}"
                                    method="GET">
                                    <button type="submit" class="btn">
                                        <i class="fa-solid fa-arrow-right"></i>
                                        Checkout
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- JQuery --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- My Scripts --}}
    <script>
    </script>
</body>

</html>
