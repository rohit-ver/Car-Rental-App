<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Signup</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- CSS from above -->
   <style>
  body {
    min-height: 100vh;
    background: url("https://images.unsplash.com/photo-1503376780353-7e6692767b70")
      no-repeat center center/cover;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: 'Segoe UI', sans-serif;
  }

  .glass-card {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border-radius: 15px;
    border: 1px solid rgba(255, 255, 255, 0.3);
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.25);
    padding: 30px;
    width: 100%;
    max-width: 420px;
    color: #fff;
  }

  .glass-card label {
    font-weight: 500;
  }

  .glass-card .form-control,
  .glass-card .form-select {
    background: rgba(255, 255, 255, 0.2);
    border: none;
    color: #fff;
  }

  .glass-card .form-control::placeholder {
    color: #e0e0e0;
  }

  .glass-card a {
    color: #fff;
    text-decoration: underline;
  }
</style>

</head>
<body>

<div class="glass-card">
  <h4 class="text-center mb-4">Create Account</h4>

  <form action="includes/signup_process.php" method="post">
    <div class="mb-3">
      <label>Register As</label>
      <select class="form-select" name="role" required>
        <option value="">Select Role</option>
        <option value="user">User</option>
        <option value="owner">Car Owner</option>
      </select>
    </div>


    <div class="mb-3">
      <label>Full Name</label>
      <input type="text" name="name" class="form-control" placeholder="Enter name">
    </div>

    <div class="mb-3">
      <label>Email</label>
      <input type="email" name="email" class="form-control" placeholder="Enter email">
    </div>

    <div class="mb-3">
      <label>Password</label>
      <input type="password" name="password" class="form-control" placeholder="Create password">
    </div>

    <button class="btn btn-outline-primary w-100">Sign Up</button>
  </form>

  <div class="text-center mt-4">
    <span class="text-light">Already have an account?</span><br>
    <a href="login.php" class="btn btn-outline-primary mt-2 px-4">
      Login Here
    </a>
  </div>
</div>

</body>
</html>
