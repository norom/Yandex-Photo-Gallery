{include file="includes/header.tpl" customtitle="Нормальный интерфейс для Яндекс.фоток"}
<div>
    Фоткер <br>
    <form method="post" action="/user/login/">
        <input name="login"> email</br>
        <input name="pass"> пароль</br>
        <input name="pass2"> пароль еще раз</br>
        <input type="submit" value="Регистрация"></br>
        <a href="/user/login">Войти</a>
    </form>
</div>
{include file="includes/footer.tpl"}