
<form action="{{ route('login.validate') }}" method="post">
    @csrf

    E-mail:
    <br>
    <input type="email" name="email" id="email">
    <br><br>

    Senha:
    <br>
    <input type="password" name="password" id="password">
    <br><br>

    <input type="submit" value="Login">

</form>