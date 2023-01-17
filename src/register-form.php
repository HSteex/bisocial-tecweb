 <div class="padding">
     <form action="process-register.php" method="post" class="login" name="login_form">
         <p>Ciao, registrati.</p>
         <input class="form-control login" type="text" placeholder="Username" name="username"/>
         <input class="form-control login" type="email" placeholder="E-mail" name="email"/>
         <input class="form-control login" type="password" placeholder="Password" name="p" id="password"/>
         <div class="center"><a href="#" class="forgot-password">Password dimenticata?</a>
             <button type="submit" class="btn btn-primary login" onclick="formhash(this.form, this.form.password);">Registrati</button>
         </div>
     </form>
     <div class="oppure"><span class="separator">altrimenti</div>
     <div class="center"><button class="btn btn-primary registration register" type="button" onclick="location.href = 'login.php';">Login</button></div>
 </div>
