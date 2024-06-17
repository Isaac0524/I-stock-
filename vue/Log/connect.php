<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../Log/style.css" />
    <title> CONNEXION </title>
  </head>
  <body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
          <form action="/I-stock/model/authentificate.php" method="POST" class="sign-in-form">
            <h2 class="title"> Se Connecter </h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" name="username" placeholder="Username" required />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" name="password" placeholder="Password" required />
            </div>
            <input type="submit" value="Login" class="btn solid" />
            <p class="social-text"> Utilisez une autre de methode de connexion </p>
            <div class="social-media">
              <a href="#" class="social-icon">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-google"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </div>
          </form>
          
          <form action="/I-stock/model/register.php" method="POST" class="sign-up-form">
            <h2 class="title"> Inscription</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" name="username" placeholder="Username" required />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" name="password" placeholder="Password" required />
            </div>
            <input type="submit" class="btn" value="Sign up" />
            <p class="social-text"> Utilisez une autre de methode de connexion </p>
            <div class="social-media">
              <a href="#" class="social-icon">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-google"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </div>
          </form>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3> Vous etes nouveau ? </h3>
            <p>
                Dans ce cas Passez a votre Inscription
            </p>
            <button class="btn transparent" id="sign-up-btn">
             Inscris toi
            </button>
          </div>
          <img src="../img/log.svg" class="image" alt="" />
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3> Deja Inscris ? </h3>
            <p>
              Nous esperons que vous passerez une bonne experience avec nous 
              merci de votre confiance 
            </p>
            <button class="btn transparent" id="sign-in-btn">
              Se Connecter 
            </button>
          </div>
          <img src="../img/register.svg" class="image" alt="" />
        </div>
      </div>
    </div>

    <script src="app.js"></script>
  </body>
</html>
