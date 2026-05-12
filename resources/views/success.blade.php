<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Payment Success</title>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>

body{
    margin:0;
    font-family:'Inter',sans-serif;
    background:linear-gradient(135deg,#eef2ff,#f8fafc);
    height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
}

.card{
    background:#fff;
    width:100%;
    max-width:520px;
    padding:40px;
    border-radius:24px;
    box-shadow:0 20px 50px rgba(0,0,0,0.08);
    text-align:center;
}

.icon{
    width:90px;
    height:90px;
    margin:auto;
    border-radius:50%;
    background:#dcfce7;
    color:#16a34a;
    font-size:42px;
    display:flex;
    align-items:center;
    justify-content:center;
    margin-bottom:20px;
    animation:pop .4s ease;
}

@keyframes pop{
    from{transform:scale(0);}
    to{transform:scale(1);}
}

h1{
    margin:0;
    font-size:30px;
    color:#111827;
}

p{
    color:#6b7280;
    margin-top:10px;
    margin-bottom:25px;
}

.box{
    background:#f9fafb;
    border-radius:16px;
    padding:18px;
    text-align:left;
    margin-bottom:25px;
}

.row{
    display:flex;
    justify-content:space-between;
    margin-bottom:10px;
    font-size:14px;
}

.badge{
    display:inline-block;
    padding:6px 12px;
    background:#dcfce7;
    color:#16a34a;
    border-radius:999px;
    font-size:12px;
    font-weight:600;
}

.btn{
    display:inline-block;
    padding:14px 24px;
    background:#111827;
    color:#fff;
    text-decoration:none;
    border-radius:12px;
    font-weight:600;
}

.btn:hover{
    background:#1f2937;
}

</style>
</head>

<body>

<div class="card">

    <div class="icon">✓</div>

    <h1>Payment Successful</h1>

    <p>Your transaction has been completed securely with Stripe.</p>

    @if(isset($order))

    <div class="box">

        <div class="row">
            <span>Order ID</span>
            <strong>#{{ $order->id }}</strong>
        </div>

        <div class="row">
            <span>Amount</span>
            <strong>Rs {{ number_format($order->amount,2) }}</strong>
        </div>

        <div class="row">
            <span>Status</span>
            <span class="badge">Paid</span>
        </div>

    </div>

    @endif

    <a href="{{ url('dashboard') }}" class="btn">Back to Home</a>

</div>

</body>
</html>