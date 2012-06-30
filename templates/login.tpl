{include file="includes/header.tpl" customtitle="Главная"}
<div id="login-block">
    <img src="/img/2.png" alt="Фоткер">
    <br>
    <br>
    <br>
    <form method="post" action="/user/login/">
    <input name="login" type="text" placeholder="e-mail">
    <input name="pass" type="password">
        <br>
        <br>
        <input type="submit" value="Войти">&nbsp;&nbsp;&nbsp;
        <a href="/user/registration">регистрация</a>
    </form>
    <br><br>
    или просто просмотреть альбом любого пользователя: /u/_username_
</div>
{include file="includes/footer.tpl"}