{include file="includes/header.tpl" customtitle="Главная" bodystyle="parrots"}
<div id="login-block">
    <img src="/img/3.png" alt="Фоткер">
    <br>
    <br>
    <br>
    Введите URL альбома или имя пользователя:
    <form method="post" action="/user/login/">
    <input name="login" type="text" placeholder="URL или имя пользователя" value="">

        <input type="submit" value=">>">&nbsp;&nbsp;&nbsp;

    </form>
    <br><br>
</div>
{include file="includes/footer.tpl"}