Dobrý den,
<br><br>
vaše objednávka z eshopu petrolwear.cz byla úspěšně přijata.
<br><br>
<b>Detail objednávky:</b><br>
@foreach($email['products'] as $product) 
• {{ $product['name'] }},  {{ $product['quantity'] }} ks, {{ $product->variant->price * $product['quantity'] }} Kč
<br>
@endforeach
<br>
Celkem: {{ $email['order']->total }} Kč
<br><br>
@if($email['order']->payment->name == "banktransfer")
Nyní je potřeba odeslat platbu na náš účet: <br>
Číslo účtu: 235277039/0600 <br>
Variabilní symbol: {{ $email['order']->payment_code }} <br>
Částka: {{ $email['order']->total }}Kč<br>
@endif
Jak jen to bude možné, zboží odešleme a zašleme Vám email se sledovacím kódem, abyste věděli, kdy k vám objednávka dorazí.

<br><br>
Díky za to, že jste si vybrali PetrolWear
<br><br>
S podravem<br>
Tým PetrolWear