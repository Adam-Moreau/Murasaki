<nav class="navbar customNavbar shadow d-flex justify-content-between align-items-center">
  <a href="index.php" class="leftItems d-flex"> <!-- Added href attribute -->
    <div class="pinkSquare d-flex justify-content-center align-items-center">
      <div class="siteIcon">紫</div>
    </div>
    <div class="titleNavbar">Murasaki</div>
  </a> <!-- Added closing anchor tag -->
  <?php
  // Check if the user is logged in and is an admin
  if (
    !isset($_SESSION['user_id']) ||
    !isset($_SESSION['is_admin']) ||
    !$_SESSION['is_admin']
  ) {
  } else {
  ?>
    <a href="logout.php"><img class="icons" src="style/images/icons/logout.png" alt="Logout"></a>
  <?php
  }
  ?>
</nav>