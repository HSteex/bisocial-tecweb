<div class="padding">
    <form action="process-login.php" method="post" class="login" name="login_form">
        <p>Ciao, effettua il login.</p>
        <input class="form-control login" type="text" placeholder="Username" name="username"/>
        <input class="form-control login" type="password" placeholder="Password" name="password" id="password" required>
        <div class="center"><a href="#" class="forgot-password">Password dimenticata?</a>
            <button type="submit" class="btn btn-primary login" <!--onclick="formhash(this.form, this.form.password);"-->Login</button>
        </div>
    </form>
    <div class="oppure"><span class="separator">
    altrimenti</div>
    <div class="center">
        <button class="btn btn-primary registration register" type="button" onclick="location.href = 'register.php';">Registrati</button>
    </div>
</div>
