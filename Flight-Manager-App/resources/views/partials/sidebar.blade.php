<style>
    /* Side Bar */
    .side-bar {
        position: fixed;
        flex: 0 0 24%;
        width: 24vw;
        height: 100vh;
        background-color: #fafafa;
        display: flex;
        flex-direction: column;
        padding: 110px 0px;
        font-weight: 600;
    }

    .side-bar .image-holder {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .side-bar .image-holder img {
        max-width: 50px;
        border-radius: 50%;
    }

    .side-bar .login-control {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding: 0px 15px;
    }

    .side-bar .login-control .group {
        display: flex;
    }

    .side-bar .login-control .redirect-btn {
        font-size: 20px;
    }

    .side-bar .login-control .redirect-btn i {
        font-size: 24px;
        margin-right: 10px;
    }

    .side-bar .login-control div {
        margin-right: 15px;
    }

    .side-bar .login-control .name-holder {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
    }

    .side-bar .login-control .name-holder span {
        font-size: 20px;
    }

    .side-bar .login-control .controlls * {
        font-size: 20px;
    }

    .side-bar .login-control .controlls i:hover {
        transition: all .2s ease-in-out;
        transform: scale(1.3);
    }

    .side-bar .main-menu .links {
        display: flex;
        justify-content: left;
        flex-direction: column;
        list-style: none;
        width: 90%;
        padding-left: 0px;
    }

    .side-bar .main-menu .links .link {
        display: block;
        width: 100%;
        font-size: 18px;
        padding: 15px 0px 15px 30px;
        border-top-right-radius: 50px;
        border-bottom-right-radius: 50px;
    }

    .side-bar .main-menu .links .link i {
        margin-right: 10px;
    }

    .side-bar .main-menu .links .link.active,
    .side-bar .main-menu .links .link:hover {
        background-color: #cfefff;
        color: #60b0e4;
    }

</style>

{{-- Side Bar --}}
<section class="side-bar">
    {{-- Login Control --}}
    <div class="login-control">
        @auth
            <div class="group">
                <div class="image-holder">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/59/User-avatar.svg/1024px-User-avatar.svg.png"
                        alt="">
                </div>
                <div class="name-holder">
                    <span>{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</span>
                </div>
            </div>
            <div class="controlls">
                <a href="{{ route('profile') }}" id="edit-btn"><i class="fa-solid fa-pen"></i></a>
            </div>
        @endauth
        @guest
            <a href="{{ route('login') }}" class="redirect-btn">
                <i class="fa-solid fa-right-to-bracket"></i>
                Login/Register
            </a>
        @endguest
    </div>
    {{-- Main Menu --}}
    <nav class="main-menu">
        <ul class="links">
            <li>
                <a href="{{ route('home') }}/" class="link">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    Browse Offers
                </a>
            </li>
            @auth
                <li>
                    <a href="{{ route('booked.tickets') }}" class="link">
                        <i class="fa-solid fa-ticket"></i>
                        Booked Tickets
                    </a>
                </li>
                {{-- <li>
                    <a href="" class="link">
                        <i class="fa-solid fa-heart"></i>
                        Saved Offers
                    </a>
                </li> --}}
            @endauth
        </ul>
    </nav>
</section>

{{-- JQuery --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>
{{-- My Scripts --}}
<script>
    function setActiveSection() {
        $(".link").each(function() {
            if ($(this).attr('href').toUpperCase() === window.location.href.toUpperCase()) {
                $(this).addClass('active');
            }
        });
    }

    $(document).ready(function() {
        setActiveSection();
    });
</script>
