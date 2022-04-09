<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> @php env('APP_NAME'); @endphp </title>
    {{-- <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" /> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- Toastr --}}
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    {{-- My Styles --}}
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
            height: 100vh;
            display: flex;
            flex-direction: column;
            padding: 40px;
            margin-left: 24vw;
        }

        /* .panel-title {
            display: inline;
            font-weight: bold;
        }

        .display-table {
            display: table;
        }

        .display-tr {
            display: table-row;
        }

        .display-td {
            display: table-cell;
            vertical-align: middle;
            width: 61%;
        } */

        .customer-info .outer {
            background-color: #f8f8f8;
        }

        /* Payment Form */
        .page-content .payment-form {
            display: flex;
            justify-content: center;
            flex-direction: column;
            padding: 30px;
            background-color: #f8f8f8;
            border-radius: 3px;
            box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
        }

        .page-content .payment-holder {
            display: flex;
            justify-content: center;
        }

        .page-content .payment-holder form {
            width: 100%;
        }

        .page-content .payment-holder .left {
            width: 30%;
            display: flex;
            flex-direction: column;
        }

        .page-content .payment-holder .left .image-holder {
            width: 100%;
            display: flex;
            justify-content: left;
            align-items: center;
        }

        .page-content .payment-holder .left .image-holder img {
            width: 100%;
            border-radius: 100%;
        }

        .page-content .payment-holder .left #in-avatar {
            opacity: 0;
            height: 0px;
            width: 0px;
            position: absolute;
        }

        .page-content .payment-holder {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .page-content .payment-holder .row {
            width: 100%;
            display: flex;
        }

        .page-content .payment-holder .group {
            display: flex;
            width: 100%;
            flex-direction: column;
            justify-content: left;
            margin: 0px 20px 20px 0px;
        }

        .page-content .payment-holder .group>label {
            margin-bottom: 6px;
        }

        .page-content .payment-holder .group>input {
            box-sizing: border-box;
            width: 100%;
            padding: 14px;
            border-radius: 40px;
            border: 1px solid lightgray;
        }

        .page-content .payment-holder .group>input:focus {
            border: 1px solid #47b2e6;
            box-shadow: 0 0 0 1px #47b2e6;
            outline: none;
        }

        .page-content .payment-holder .control {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .page-content .payment-holder .control>.btn {
            color: #47b2e6;
            background-color: #fff;
            padding: 15px 20px;
            border-radius: 30px;
            border: none;
            box-shadow: rgba(17, 12, 46, 0.15) 0px 48px 100px 0px;
        }

        .page-content .payment-holder .control>.btn i {
            margin-right: 6px;
        }

        .page-content .payment-holder .control>.btn:hover {
            cursor: pointer;
            transition: all .2s ease-in-out;
            transform: scale(1.08);
        }

        .hide {
            display: none;
        }

    </style>
</head>

<body>
    {{-- Side Bar --}}
    @include('partials.sidebar')

    {{-- Page Content --}}
    <section class="page-content">
        <div class="payment-form">
            <div class="title-holder">
                <h2 class="title"> Payment Form </h2>
            </div>
            <div class="payment-holder">
                <form role="form"
                    action="{{ route('ticket.checkout.post', ['ticket' => $ticket->id,'reservedTicket' => $reservedTicket,'guest' => $guest]) }}"
                    method="post" class="require-validation" data-cc-on-file="false"
                    data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
                    @csrf
                    <div class="group">
                        <label for="in-first-name">Name on Card</label>
                        <input type="text" id="in-first-name" placeholder="Enter name on card">
                    </div>
                    <div class="group">
                        <label for="in-last-name">Card Number</label>
                        <input type="text" class="card-number" size="20" id="in-card-number"
                            placeholder="Enter card number">
                    </div>
                    <div class="row">
                        <div class="group">
                            <label for="in-card-cvc">CVC</label>
                            <input class='form-control card-cvc' type="text" size='4' id="in-card-cvc"
                                placeholder="Enter cvc">
                        </div>
                        <div class="group">
                            <label for="in-card-expiry-month">Expiration Month</label>
                            <input class="card-expiry-month" type="text" size='2' id="in-card-expiry-month"
                                placeholder="Enter expiration month">
                        </div>
                        <div class="group">
                            <label for="in-card-expiry-year">Expiration Year</label>
                            <input type="text" class="card-expiry-year" size='4' id="in-card-expiry-year"
                                placeholder="Enter expiration year">
                        </div>
                    </div>
                    <div class="control">
                        <button type="submit" class="btn">
                            <i class="fa-solid fa-arrow-right"></i>
                            Pay
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

<script type="text/javascript">
    $(function() {
        var $form = $(".require-validation");
        $('form.require-validation').bind('submit', function(e) {
            var $form = $(".require-validation"),
                inputSelector = ['input[type=email]', 'input[type=password]',
                    'input[type=text]', 'input[type=file]',
                    'textarea'
                ].join(', '),
                $inputs = $form.find('.required').find(inputSelector),
                $errorMessage = $form.find('div.error'),
                valid = true;
            $errorMessage.addClass('hide');

            $('.has-error').removeClass('has-error');
            $inputs.each(function(i, el) {
                var $input = $(el);
                if ($input.val() === '') {
                    $input.parent().addClass('has-error');
                    $errorMessage.removeClass('hide');
                    e.preventDefault();
                }
            });

            if (!$form.data('cc-on-file')) {
                e.preventDefault();
                Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                Stripe.createToken({
                    number: $('.card-number').val(),
                    cvc: $('.card-cvc').val(),
                    exp_month: $('.card-expiry-month').val(),
                    exp_year: $('.card-expiry-year').val()
                }, stripeResponseHandler);
            }

        });

        function stripeResponseHandler(status, response) {
            if (response.error) {
                // $('.error')
                //     .removeClass('hide')
                //     .find('.alert')
                //     .text(response.error.message);
                toastr.error(response.error.message, 'Error!')
            } else {
                // token contains id, last4, and card type
                var token = response['id'];
                // insert the token into the form so it gets submitted to the server
                $form.find('input[type=text]').empty();
                $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                $form.get(0).submit();
            }
        }

    });
</script>

</html>
