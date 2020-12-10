<header>
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-danger">
    <div class="container">
      <a class="navbar-brand" href="index.html">Celke</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
          <?php
          foreach ($this->dados['menu'] as $menu) {
            extract($menu);
          ?>
            <li class="nav-item menu">
              <a class="nav-link" href="<?= URL . $endereco ?>"><?= $nome_pagina ?> </a>
            </li>
          <?php
          }
          ?>
        </ul>
      </div>
    </div>
  </nav>
</header>