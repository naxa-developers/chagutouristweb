<form class="form-signin" method="post" action="" style="margin: 15px auto;">
    <?php
      $error=   $this->session->flashdata('Login');
       if($error){
       echo $error;

       }
        ?>
    <div class="login-wrap">
        <div class="user-login-info" style="background: transparent;">
            <input type="text" class="form-control" name="username" placeholder="User ID" autofocus>
            <input type="password" class="form-control" name="password" placeholder="Password">
        </div>
        <button class="btn btn-lg btn-login btn-block" name="submit" type="submit">Sign in</button>

    </div>

</form>