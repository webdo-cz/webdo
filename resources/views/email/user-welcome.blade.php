Dobrý den,
<br><br>
váš email byl zaregistrován do administrace webu: {{ parse_url(url('/'))['host'] }}<br>
Posíláme vám vaše údaje.
<br>
Heslo je: <b>{{ $password }}</b>
<br>
Přihlásit se můžete <a href="{{ url('/login') }}"><b>zde</b></a>
<br><br>
S pozdravem {{ parse_url(url('/'))['host'] }}