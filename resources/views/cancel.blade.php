<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Cancelled</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Inter',sans-serif;
        }

        body{
            background:#f4f7fb;
            min-height:100vh;
            display:flex;
            align-items:center;
            justify-content:center;
            padding:20px;
        }

        .cancel-card{
            width:100%;
            max-width:500px;
            background:#fff;
            border-radius:24px;
            padding:40px;
            text-align:center;
            box-shadow:0 10px 35px rgba(0,0,0,0.08);
        }

        .icon{
            width:90px;
            height:90px;
            background:#fee2e2;
            color:#dc2626;
            font-size:42px;
            border-radius:50%;
            display:flex;
            align-items:center;
            justify-content:center;
            margin:auto;
            margin-bottom:20px;
        }

        h1{
            font-size:30px;
            margin-bottom:10px;
            color:#111827;
        }

        p{
            color:#6b7280;
            line-height:1.6;
            margin-bottom:25px;
        }

        .btn-group{
            display:flex;
            gap:12px;
            justify-content:center;
            flex-wrap:wrap;
        }

        .btn{
            padding:14px 24px;
            border-radius:12px;
            text-decoration:none;
            font-weight:600;
            transition:0.3s;
        }

        .btn-dark{
            background:#111827;
            color:#fff;
        }

        .btn-dark:hover{
            background:#1f2937;
        }

        .btn-light{
            background:#f3f4f6;
            color:#111827;
        }

        .btn-light:hover{
            background:#e5e7eb;
        }

    </style>
</head>
<body>

<div class="cancel-card">

    <div class="icon">
        ✕
    </div>

    <h1>Payment Cancelled</h1>

    <p>
        Your transaction was cancelled and no payment was charged.
        You can try again anytime.
    </p>

    <div class="btn-group">

        <a href="{{ url()->previous() }}" class="btn btn-dark">
            Try Again
        </a>

        <a href="{{ url('/') }}" class="btn btn-light">
            Back Home
        </a>

    </div>

</div>

</body>
</html>