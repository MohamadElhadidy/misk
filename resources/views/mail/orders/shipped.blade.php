<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Order Confirmation</title>
    <style>
        /* Inline Email-Safe CSS */
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            background-color: white;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #ddd;
            margin: auto;
        }

        h2 {
            color: #333;
            text-align: center;
        }

        p {
            color: #555;
            text-align: center;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table th, .table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        .table th {
            background-color: #f4f4f4;
            font-weight: bold;
        }

        .button {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            text-align: center;
            margin-top: 20px;
            display: block;
            width: fit-content;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>🛒 New Order Received!</h2>
    <p>Thank you for your order. Below are the details:</p>

    <table class="table">
        <tr>
            <th>Order ID</th>
            <td>{{ $order->order_id }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td style="color: #0000;">{{ $order->customer->email }}</td>
        </tr>
        <tr>
            <th>Total Amount</th>
            <td><strong style="color: green;">{{$order->total_price}} {{config('app.currency')}}</strong></td>
        </tr>
        <tr>
            <th>Order Date</th>
            <td>{{ $order->created_at->format('d M Y, h:i A') }}</td>
        </tr>
    </table>




    <h3>🛍 Order Items</h3>
    <table class="table">
        <thead>
        <tr>
            <th>Product</th>
            <th>Qty</th>
        </tr>
        </thead>
        <tbody>
        @foreach($order->details as $item)
            <tr>
                <td>{{ $item->product->name }}  - {{$item->size}}</td>
                <td style="text-align: center;">{{ $item->quantity }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <!-- Shipping Address Section -->
    <h3>📦 Your Order Will Be Sent To:</h3>
    <table class="table">
        <tr>
            <th>Recipient Name</th>
            <td>{{ $order->customer->name }}</td>
        </tr>
        <tr>
            <th>Phone Number</th>
            <td>{{  $order->address->phone_number }}</td>
        </tr>
        <tr>
            <th>Address</th>
            <td>{{  $order->address->address_line_1 }}- {{  $order->address->address_line_2 }}</td>
        </tr>
        <tr>
            <th>City</th>
            <td>{{  $order->address->city }}</td>
        </tr>
        <tr>
            <th>Country</th>
            <td>{{ $order->address->country }}</td>
        </tr>
    </table>


    <a href="{{ url('/orders/' . $order->order_id) }}" class="button">View Order</a>

    <p style="text-align: center; font-size: 12px; color: #000;">
        If you have any questions, contact our support team at
        <a href="mailto:{{env('ADMIN_MAIL')}}" style="color: #007bff;">{{env('ADMIN_MAIL')}}</a>.
    </p>
</div>

</body>
</html>
