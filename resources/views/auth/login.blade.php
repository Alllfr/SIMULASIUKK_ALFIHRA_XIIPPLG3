<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif
}

body{
    background:#fff8d6;
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center
}

.login-container{
    display:flex;
    width:900px;
    max-width:95%;
    height:600px;
    border-radius:20px;
    overflow:hidden;
    background:#ffffff;
    box-shadow:0 20px 45px rgba(0,0,0,.15);
    transition:.3s
}

.login-container:hover{
    transform:scale(1.01);
    box-shadow:0 25px 55px rgba(255,193,7,.25);
}

.login-left{
    flex:1;
    position:relative;
    overflow:hidden;
    border-right:3px solid #ffd54f
}

.login-left img{
    width:100%;
    height:100%;
    object-fit:cover;
    transition:.4s
}

.login-left:hover img{
    transform:scale(1.05);
    filter:brightness(.9);
}

.login-right{
    flex:1;
    padding:50px 40px;
    display:flex;
    flex-direction:column;
    justify-content:center
}

.login-heading{
    text-align:center;
    font-weight:700;
    color:#f9a825;
    font-size:28px;
    margin-bottom:25px;
    letter-spacing:1px
}

.alert{
    background:#fff3cd;
    color:#856404;
    padding:12px 14px;
    border-radius:10px;
    margin-bottom:18px;
    font-size:14px
}

.form-group{
    margin-bottom:18px
}

.form-group label{
    display:block;
    margin-bottom:6px;
    font-weight:500;
    color:#444
}

.form-group input{
    width:100%;
    padding:12px 15px;
    border:1px solid #fdd835;
    border-radius:10px;
    font-size:15px;
    transition:.3s
}

.form-group input:focus{
    border-color:#f9a825;
    box-shadow:0 0 10px rgba(255,193,7,.4);
    outline:none
}

.btn-login{
    width:100%;
    padding:14px;
    background:#fbc02d;
    color:#fff;
    font-weight:600;
    border:none;
    border-radius:10px;
    cursor:pointer;
    transition:.3s
}

.btn-login:hover{
    background:#f9a825;
    transform:translateY(-3px);
    box-shadow:0 10px 20px rgba(255,193,7,.4);
}

.register-link{
    margin-top:15px;
    text-align:center;
    font-size:14px
}

.register-link a{
    color:#f9a825;
    text-decoration:none;
    font-weight:600;
    transition:.3s
}

.register-link a:hover{
    color:#ff8f00;
    text-decoration:underline;
}

@media(max-width:900px){
    .login-container{
        flex-direction:column;
        height:auto
    }
    .login-left{
        display:none
    }
    .login-right{
        padding:40px 30px
    }
}
</style>

</head>

<body>

<div class="login-container">

    <div class="login-left">
     <img src="{{ asset('assets/backgroundhotel1.jpg') }}" alt="">
        <svg class="cloud" style="top:10%;left:5%;animation-duration:12s" width="40" height="20" viewBox="0 0 64 32">
            <path d="M20 20C14 20 10 16 10 12C10 8 14 4 18 4C19.5 2 21 0 24 0C28 0 30 4 30 6C36 4 44 6 44 12C48 12 54 14 54 20C54 24 50 28 46 28H20C16 28 14 24 14 20H20Z" fill="#ffffff88"/>
        </svg>
    </div>

    <div class="login-right">
        <h2 class="login-heading">LOGIN</h2>

        @if ($errors->any())
            <div class="alert">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <button type="submit" class="btn-login">Log In</button>
        </form>

        <div class="register-link">
            Don't have an account?
            <a href="{{ route('register') }}">Register here</a>
        </div>
    </div>

</div>

<script>
document.querySelectorAll(".cloud").forEach(c=>{
c.style.top=Math.random()*80+"%"
c.style.left=Math.random()*100+"%"
c.style.animationDuration=6+Math.random()*10+"s"
})
</script>

</body>
</html>
