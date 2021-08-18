<?php

// SDK de Mercado Pago
require __DIR__ .  'autoload.php';

// Agrega credenciales
MercadoPago\SDK::setAccessToken('TEST-7410216103926868-081521-6e7ab10489deb5d0ba577842176916d7-700016335');

// Crea un objeto de preferencia
$preference = new MercadoPago\Preference();

// Crea un ítem en la preferencia
$item = new MercadoPago\Item();
$item->title = 'Mi producto';
$item->quantity = 1;
$item->unit_price = 75.56;
$preference->items = array($item);
$preference->save();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<!-- // SDK MercadoPago.js V2 -->
<script src="https://sdk.mercadopago.com/js/v2"></script>
<script>
// Agrega credenciales de SDK
  const mp = new MercadoPago('PUBLIC_KEY', {
        locale: 'es-AR'
  });

  // Inicializa el checkout
  mp.checkout({
      preference: {
          id: 'YOUR_PREFERENCE_ID'
      },
      render: {
            container: '.cho-container', // Indica el nombre de la clase donde se mostrará el botón de pago
            label: 'Pagar', // Cambia el texto del botón de pago (opcional)
      }
});
</script>

</body>
</html>
