<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Send Email</title>
</head>

<body>
    <h1>New Order</h1>
    <ul class="list-unstyled text-start">
        <li>Name:{{ $userProfile->name }}</li>
        <li>Email: {{ $userProfile->email }}</li>
        <li>Socials: {{ $userProfile->socialMedia ?? 'No socials set.' }} </li>
        <li>Address:
            {{ $userProfile->address ?? 'Location unknown' }}</li>
        <li>Country:{{ $userProfile->country ?? 'No country set' }}</li>
        <li>Postal Code: {{ $userProfile->postalCode ?? 'No postal code set' }}</li>
        <li>Phone Number: {{ $userProfile->phoneNumber ?? 'There is no number!' }}</li>
    </ul>
    <table style="border:1px solid black; text-align:center">
        <tr style="border:1px solid black">
            <th style="border:1px solid black">Product Name</th>
            <th style="border:1px solid black">Description</th>
            <th style="border:1px solid black">Price</th>
            <th style="border:1px solid black">Quantity</th>
        </tr>
        <?php $totalHarga = 0; ?>
        @foreach ($cartData as $cartItem)
            <tr style="border:1px solid black">
                <td style="border:1px solid black">{{ $cartItem['product']->productName }}</td>
                <td style="border:1px solid black">{{ $cartItem['description'] }}</td>
                <td style="border:1px solid black">{{ $cartItem['price'] }}</td>
                <td style="border:1px solid black">{{ $cartItem['qty'] }}</td>
            </tr>
            <?php $totalHarga += $cartItem['price'] * $cartItem['qty']; ?>
        @endforeach
    </table>
    <h3>Total Price: $ <?= $totalHarga ?></h3>
</body>

</html>
