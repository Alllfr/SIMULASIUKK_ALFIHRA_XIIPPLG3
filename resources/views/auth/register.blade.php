<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register</title>

<style>
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

.fullscreen-login{
    width:100%;
    height:100%;
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
    box-shadow:0 25px 60px rgba(255,193,7,.25);
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
    padding:50px 45px;
    display:flex;
    flex-direction:column;
    justify-content:center
}

.login-heading{
    text-align:center;
    font-size:28px;
    font-weight:700;
    color:#f9a825;
    margin-bottom:30px;
    min-height:40px;
    letter-spacing:1px
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
    border-radius:10px;
    border:1px solid #fdd835;
    font-size:15px;
    transition:.3s
}

.form-group input:focus{
    border-color:#f9a825;
    box-shadow:0 0 10px rgba(255,193,7,.4);
    outline:none
}

.btn-register{
    margin-top:10px;
    width:100%;
    padding:14px;
    border:none;
    border-radius:10px;
    background:#fbc02d;
    color:#fff;
    font-size:16px;
    font-weight:600;
    cursor:pointer;
    transition:.3s
}

.btn-register:hover{
    background:#f9a825;
    transform:translateY(-3px);
    box-shadow:0 10px 20px rgba(255,193,7,.4);
}

.form-footer{
    margin-top:18px;
    text-align:center;
    font-size:14px
}

.form-footer a{
    color:#f9a825;
    text-decoration:none;
    font-weight:600;
    transition:.3s
}

.form-footer a:hover{
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

.pop-letter{
    display:inline-block;
    opacity:0;
    transform:translateY(10px);
    animation:pop .5s forwards
}

@keyframes pop{
    to{
        opacity:1;
        transform:translateY(0)
    }
}
</style>

</head>

<body>

<div class="fullscreen-login">
    <div class="login-container">

        <div class="login-left">
            <img src="{{ asset('assets/backgroundhotel2.jpg') }}" alt="">
            <svg class="cloud" style="top:15%;left:5%;animation-duration:12s" width="40" height="20" viewBox="0 0 64 32">
                <path d="M20 20C14 20 10 16 10 12C10 8 14 4 18 4C19.5 2 21 0 24 0C28 0 30 4 30 6C36 4 44 6 44 12C48 12 54 14 54 20C54 24 50 28 46 28H20C16 28 14 24 14 20H20Z" fill="#ffffff88"/>
            </svg>
        </div>

        <div class="login-right">
            <h2 id="register-title" class="login-heading"></h2>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <label for="name">Name</label>
                    <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" name="password" type="password" required>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required>
                </div>

                <button type="submit" class="btn-register">Register</button>
            </form>

            <div class="form-footer">
                Already have an account?
                <a href="{{ route('login') }}">Login here</a>
            </div>
        </div>

    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded",()=>{
const t="REGISTER"
const e=document.getElementById("register-title")
e.innerHTML=""
t.split("").forEach((c,i)=>{
const s=document.createElement("span")
s.textContent=c
s.className="pop-letter"
s.style.animationDelay=`${i*.08}s`
e.appendChild(s)
})
})
</script>

</body>
</html>
