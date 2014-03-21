@section('content')
<form action="" method="POST" class="login">
    <h1 class="text-center">Login</h1>
    <div class="row">
        <label>Username</label>
        <input type="text" name="username">
    </div>
    <div class="row">
        <label>Password</label>
        <input type="password" name="password">
    </div>
    <div class="row">
        <input type="submit" value="Login">
    </div>
</form>
@endsection

@section('injector')
<script type="text/javascript" charset="utf-8">(function($) {"use strict";$($('input')[0]).focus();})(window.$)</script>
@endsection
