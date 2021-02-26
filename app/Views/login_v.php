<div class="container-fluid w-75 h-100"  style="background-color:white; border-radius:10px; margin-top:7%; padding:1%;">
    <div class="row  p-4">
        <div class="col-6 col-sm-12 col-md-6 h-100">
            <img src="<?=base_url('/img/register.jpg')?>" class="w-100" style="border-radius:10px;" alt="Login" >  
        </div>
        <div class="col-6 col-sm-12 col-md-6 h-100 w-100">
            <form class="">
                <div class="form-group">
                    <label for="useremail">Email address or Username</label>
                    <input type="text" class="form-control" id="useremail" name="email">
                    <small id="emailHelp" class="form-text text-muted">enter your email or username</small>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="form-group">
                    <label class="form-check-label" for="exampleCheck1">Don't have a account ? 
                    <a class="" href="<?= base_url('/register');?>">Register</a>
                    </label>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

    </div>
</div>
