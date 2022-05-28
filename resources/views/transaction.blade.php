<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title> Paypal Integration </title>
    <script src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_SANDBOX_CLIENT_ID') }}"></script>
</head>
<body>
    <a class="btn btn-primary m-3" href="{{ route('processTransaction') }}">Pay $1000</a>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <form class="ajax-form" action="{{ route('processTransaction') }}" method="post">
                    @csrf
                    <label> Name </label>
                    <input type="text" name="name" class="form-control">

                    <label> Email </label>
                    <input type="email" name="email" class="form-control">

                    <label> Pay (in USD) </label>
                    <input type="number" name="amount" class="form-control">

                    <button class="btn btn-info mt-3">
                        Pay
                    </button>
                </form>
            </div>
        </div>
    </div>

    @if(\Session::has('error'))
        <div class="alert alert-danger">{{ \Session::get('error') }}</div>
        {{ \Session::forget('error') }}
    @endif
    @if(\Session::has('success'))
        <div class="alert alert-success">{{ \Session::get('success') }}</div>
        {{ \Session::forget('success') }}
    @endif

    {{--  Ajax Form Submit  --}}
    <script src="{{ asset('js/ajax-form-submit.js') }}"></script>
</body>
</html>
