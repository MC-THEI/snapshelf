<?php require_once __DIR__ . "/../../../App/Design/header.php"; ?>
<link rel="stylesheet" href="/Snapshelf/src/Register/MVC/Views/register.css">

<div class="outer-container">
  <form class="form-container method="post">
      <h4 class="label">Registriere dich</h4>
    <div class="mb-3">
      <label for="firstName" class="form-label label">Vorname</label>
      <input type="text" class="form-control inputFields" id="firstName" aria-describedby="firstNameHelp">
    </div>

    <div class="mb-3">
      <label for="lastName" class="form-label label">Nachname</label>
      <input type="text" class="form-control inputFields" id="lastName" aria-describedby="lastNameHelp">
    </div>

    <div class="mb-3">
      <label for="userName" class="form-label label">Username</label>
      <input type="text" class="form-control inputFields" id="userName" aria-describedby="userNameHelp">
    </div>

    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label label">E-mail Adresse</label>
      <input type="email" class="form-control inputFields" id="exampleInputEmail1" aria-describedby="emailHelp">
      <div id="emailHelp" class="form-text label">Wir werden Ihre E-Mail auf jeden Fall an Dritte weitergeben.</div>
    </div>

    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label label">Password</label>
      <input type="password" class="form-control inputFields" id="exampleInputPassword1">
    </div>
    <button type="submit" class="button">Submit</button>
    <img class="logo" src="/Snapshelf/public/logo_slim.png" alt="logo">

  </form>
</div>

<?php require_once __DIR__ . "/../../../App/Design/footer.php"; ?>