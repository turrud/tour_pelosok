<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
</head>
<body>
    <button id="pay-button">Bayar Sekarang</button>

    <script>
        document.getElementById('pay-button').addEventListener('click', function () {
            snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    console.log(result);
                    alert('Pembayaran berhasil!');
                },
                onPending: function(result) {
                    console.log(result);
                    alert('Pembayaran tertunda.');
                },
                onError: function(result) {
                    console.log(result);
                    alert('Pembayaran gagal.');
                },
                onClose: function() {
                    alert('Anda menutup popup pembayaran.');
                }
            });
        });
    </script>
</body>
</html>
