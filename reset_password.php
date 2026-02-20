<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Reset Password</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    min-height:100vh;
    background:url("https://images.unsplash.com/photo-1503376780353-7e6692767b70")
    no-repeat center center/cover;
    display:flex;
    align-items:center;
    justify-content:center;
    font-family:'Segoe UI', sans-serif;
}

/* Glass Card */
.card{
    width:380px;
    padding:40px 35px;
    border-radius:20px;
    background:rgba(255,255,255,0.15);
    backdrop-filter:blur(15px);
    -webkit-backdrop-filter:blur(15px);
    box-shadow:0 8px 32px rgba(0,0,0,0.3);
    border:1px solid rgba(255,255,255,0.2);
    color:#fff;
}

/* Heading */
.card h2{
    text-align:center;
    margin-bottom:30px;
    font-weight:600;
    letter-spacing:1px;
}

/* Input Field */
.input-group{
    margin-bottom:20px;
}

.input-group input{
    width:100%;
    padding:14px;
    border-radius:10px;
    border:none;
    outline:none;
    font-size:14px;
}

/* Button */
button{
    width:100%;
    padding:14px;
    border-radius:10px;
    border:none;
    background:#2d6cdf;
    color:#fff;
    font-size:15px;
    font-weight:600;
    cursor:pointer;
    transition:0.3s ease;
}

button:hover{
    background:#1b4fbf;
    transform:scale(1.02);
}

/* Responsive */
@media(max-width:420px){
    .card{
        width:90%;
        padding:30px;
    }
}
</style>
</head>

<body>

<div class="card">
    <h2>Reset Password</h2>

    <form action="includes/reset_password_process.php" method="POST">
        <div class="input-group">
            <input type="password" name="new_password" placeholder="Enter New Password" required>
        </div>

        <button type="submit">Update Password</button>
    </form>
</div>

</body>
</html>
