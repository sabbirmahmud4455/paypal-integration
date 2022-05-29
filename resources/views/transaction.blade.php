<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title> Paypal Integration </title>
    <script src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_SANDBOX_CLIENT_ID') }}"></script>
</head>
<body>
    <div class="container">
        <div class="row">



            <div class="col-md-4 mt-3">
                <div class="card text-left">
                    <div class="card-body">
                      <h4 class="card-title">Paypal Payment Gateway</h4>
                      <form action="{{ route('processTransaction') }}" method="post">
                          @csrf
                          <label> Name </label>
                          <input required type="text" name="name" class="form-control">
                          @error('name')
                              <div class=" text-danger">{{ $message }}</div>
                          @enderror


                          <label> Email </label>
                          <input required type="email" name="email" class="form-control">
                          @error('email')
                              <div class=" text-danger">{{ $message }}</div>
                          @enderror

                          <label> Pay (in USD) </label>
                          <input required type="number" name="amount" class="form-control">

                          @error('amount')
                              <div class=" text-danger">{{ $message }}</div>
                          @enderror

                          <button class="btn btn-info mt-3">
                              Pay
                          </button>
                      </form>

                    </div>
                </div>
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

</body>
</html>
