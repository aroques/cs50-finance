<h2>Manage Your Account</h2>
<hr/>
<h3>Change your password</h3>
<br/>
<form action="account.php" method="post">
    <fieldset>
        <div class="form-group">
            <input autocomplete="off" autofocus class="form-control" name="password" placeholder="New password" type="password"/>
        </div>
        <div class="form-group">
            <input class="form-control" name="confirmation" placeholder="New password (again)" type="password"/>
        </div>
        <div class="form-group">
            <button class="btn btn-default" type="submit">
                <span aria-hidden="true" class="glyphicon"></span>
                Submit
            </button>
        </div>
    </fieldset>
</form>