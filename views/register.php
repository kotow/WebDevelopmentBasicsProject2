<?=$this->error;?>
<div id="wrapper">
    <form method="post" action="/public/user/register" id="reg">
        <input type="text" name="username" placeholder="UserName">
        <input type="password" name="password" placeholder="Password">
        <input type="password" name="passwordConf" placeholder="Confirm Password">
        <input type="text" name="email" placeholder="E-mail">
        <input type="text" name="emailConf" placeholder="Confirm E-mail">
        <input type="text" name="firstname" placeholder="First Name">
        <input type="text" name="lastname" placeholder="Last Name">
        <div>
            <div class="gender"><label for="male">Male</label><input type="radio" name="gender" value="male" id="male"></div>
            <div class="gender"><label for="female">Female</label><input type="radio" name="gender" value="female" id="female"></div>
            <div class="gender"><label for="undefined">undefined</label><input type="radio" name="gender" value="undefined" id="undefined" checked></div>
        </div>
        <input type="reset" value="Clear">
        <input type="submit" value="Register">
    </form>
</div>
