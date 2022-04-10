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

        /* Search Holder */
        .page-content .search-holder {
            width: 100%;
            height: 300px;
            background-image: url("https://forwardsummit.ca/wp-content/uploads/2018/10/plane-header.jpg");
            padding: 40px
        }

        .page-content .search-holder form {
            width: 100%;
            height: 100%;
            background-color: #fff;
            padding: 20px;
            box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
            border-radius: 16px
        }

        .page-content .search-holder form .inputs {
            display: flex;
            align-items: center;
            justify-content: space-between
        }

        .page-content .search-holder form .inputs .search-btn {
            padding: 12px 24px;
            border-radius: 6px;
            border: none;
            background-color: #e8edf1;
        }

        .page-content .search-holder form .inputs .search-btn:hover {
            background-color: #d1d5d8;
            transition: all .2s ease-in-out;
            transform: scale(1.08);
        }

        .page-content .search-holder form .city-btn i {
            margin-right: 10px;
        }

        .citiesDropdownInput {
            box-sizing: border-box;
            background-image: url('searchicon.png');
            background-position: 14px 12px;
            background-repeat: no-repeat;
            font-size: 16px;
            margin: 10px;
            padding: 14px 20px 12px 45px;
            border: none;
            border-bottom: 1px solid #ddd;
        }

        .citiesDropdownInput:focus {
            outline: 2px solid #0172cb;
            border-radius: 6px
        }

        .dropdown {
            position: relative;
            display: inline-block;
            background-color: #fff;
        }

        .dropdown-content {
            display: none;
            left: 0;
            right: 0;
            position: absolute;
            background-color: #fff;
            overflow: auto;
            border-bottom-left-radius: 6px;
            border-bottom-right-radius: 6px;
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown a:hover {
            background-color: #e5eaef;
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
        }

        .page-content .flights-holder .flight .right .price {
            font-size: 42px;
        }

        .page-content .flights-holder .flight .right .book-btn {
            padding: 12px 40px;
            border-radius: 8px;
            background-color: #00ad98;
            font-size: 18px;
            font-weight: 600;
            color: #fff;
            margin-top: 20px;
            border: 2px solid #00ad98;
        }

        .page-content .flights-holder .flight .right .book-btn:hover {
            padding: 12px 40px;
            border-radius: 8px;
            color: #00ad98;
            font-size: 18px;
            font-weight: 600;
            background-color: #fff;
            margin-top: 20px;
        }

        .page-content .links-holder {
            width: 100%;
            float: right;
        }

        .page-content .links-holder ul {
            display: flex;
        }

        .page-content .links-holder ul li {
            display: flex;
            justify-content: center;
            align-content: center;
            width: 40px;
            height: 40px;
            list-style: none;
            padding: 10px;
            margin-right: 10px;
            background-color: lightgray;
            border-radius: 4px;
            border: 2px solid lightgray;
        }

        .page-content .links-holder ul li.active {
            background-color: #fff;
        }

        .page-content .links-holder nav:last-child() {
            display: flex !important;
            flex-direction: row !important;
        }

    </style>

    {{-- Side Bar --}}
    @include('partials.sidebar')

    {{-- Page Content --}}
    <section class="page-content">
        <div class="search-holder">
            <form action="{{ route('home') }}" method="GET">
                <div class="row">

                </div>
                <div class="row inputs">
                    <div class="group">
                        <div class="dropdown">
                            <input name="city_from" type="text" placeholder="From" id="myInput"
                                class="citiesDropdownInput" autocomplete="off" value="{{ $cityFrom }}">
                            <div id="citiesDropdown" class="dropdown-content">
                                @foreach ($cities as $city)
                                    <a href="" class="city-btn">
                                        <i class="fa-solid fa-city"></i>
                                        <span class="city-name"> {{ $city->cityName }}</span>,
                                        {{ $city->countryName }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        <div class="dropdown">
                            <input name="city_to" type="text" placeholder="To" id="cityTo" class="citiesDropdownInput"
                                autocomplete="off" value="{{ $cityTo }}">
                            <div id="citiesDropdown" class="dropdown-content">
                                @foreach ($cities as $city)
                                    <a href="" class="city-btn">
                                        <i class="fa-solid fa-city"></i>
                                        <span class="city-name"> {{ $city->cityName }}</span>,
                                        {{ $city->countryName }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="control">
                        <button type="submit" class="search-btn">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            Search
                        </button>
                    </div>
                </div>
            </form>
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
                            <span class="price"> ${{ $ticket->price }} </span>
                        </div>
                        <div class="control">
                            {{-- @csrf --}}
                            <a href="{{ route('ticket', $ticket->id) }}" class="book-btn"> Book </a>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="links-holder">
                {!! $tickets->links() !!}
            </div>
        </div>

    </section>

    {{-- JQuery --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- My Scripts --}}
    <script>
        function openCitiesDropdown() {
            $(".citiesDropdownInput").click(function() {
                $(this).parent().find('.dropdown-content').show();
                $(this).parent().css({
                    "box-shadow": "rgba(0, 0, 0, 0.24) 0px 3px 8px",
                    "border-top-left-radius": "6px",
                    "border-top-right-radius": "6px",
                });
            });
            $('.citiesDropdownInput').focusout(function() {
                let element = $(this);
                setTimeout(function() {
                    element.parent().find('.dropdown-content').hide();
                    element.parent().css({
                        "box-shadow": "none",
                        "border-top-left-radius": "0px",
                        "border-top-right-radius": "0px",
                    });
                }, 100);
            });
        }

        function selectCity() {
            $(".city-btn").click(function(e) {
                e.preventDefault();
                $(this).parent().parent().find('input').val($(this).find('.city-name').text());

                $('#citiesDropdown').hide();
            });
        }

        function filterCities() {
            $(".citiesDropdownInput").keyup(function() {
                var input, filter, ul, li, a, i;
                input = $(this);
                filter = input.val().toUpperCase();
                div = input.parent().find('.dropdown-content');
                a = div.find("a");
                for (i = 0; i < a.length; i++) {
                    txtValue = a[i].textContent || a[i].innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        a[i].style.display = "";
                    } else {
                        a[i].style.display = "none";
                    }
                }
            });
        }

        $(document).ready(function() {
            openCitiesDropdown();
            selectCity();
            filterCities();

            $("#datepicker").datepicker();
        });
    </script>
</body>

</html>
