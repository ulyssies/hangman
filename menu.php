<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Home</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#index.php">Hangman</a> 
        </li>
        </ul>
          <?php if (isset($_SESSION['username'])) : ?>
            <form method="post" action="logout.php" class="float-end me-3">
              <button type="submit" name="logout" class="btn btn-outline-danger">Logout</button>
            </form>
          <?php else : ?>
            <a href="login.php" class="btn btn-primary float-end me-3">Login</a>
            <a href="signup.php" class="btn btn-secondary float-end me-3">Register</a>
          <?php endif; ?>
    </div>
  </div>
</nav>