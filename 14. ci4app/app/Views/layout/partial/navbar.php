<nav class="navbar navbar-expand-lg bg-light">
  <div class="container">
    <a class="navbar-brand" href="<?= base_url(''); ?>">Alfian Yulianto</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link <?= $title == 'Home | AY-Blog' ? 'active' : ''; ?>" href="<?= base_url('/'); ?>">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= $title == 'About Me | AY-Blog' ? 'active' : ''; ?>" href="<?= base_url('/pages/about'); ?>">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= $title == 'Contact Us' ? 'active' : ''; ?>" href="<?= base_url('/pages/contact'); ?>">Contact</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link <?= $title == 'Daftar Komik' || $title == 'Detail Komik' ? 'active' : ''; ?>" href="<?= base_url('/komik'); ?>">Komik</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link <?= $title == 'Daftar Orang' ? 'active' : ''; ?>" href="<?= base_url('/orang'); ?>">Orang</a>
        </li>
      </ul>
    </div>
  </div>
</nav>