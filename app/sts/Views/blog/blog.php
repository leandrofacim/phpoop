<?php
if (!defined('URL')) {
  header('Loaction: /');
  exit();
}
?>

<main role="main">

  <div class="jumbotron blog">
    <div class="container">
      <h2 class="display-4 text-center" style="margin-bottom: 40px;">Blog</h2>
      <div class="row">
        <div class="col-md-8 blog-main">
          <?php
          if (empty($this->dados['artigos'])) {
            echo '<div class="alert alert-danger"> Erro: Nenhum artigo encontrado!</div>';
          }
          foreach ($this->dados['artigos'] as $artigo) {
            extract($artigo);
          ?>

            <div class="row featurette">
              <div class="col-md-7 order-md-2 blog-text anim_right">
                <a href="<?= URL . 'artigo/' . $slug ?>">
                  <h2 class="featurette-heading text-danger"><?= $titulo ?></h2>
                </a>
                <p class="lead"><?= $descricao ?><a href="<?= URL . 'artigo/' . $slug ?>" class="text-danger">Continuar lendo</a></p>
              </div>
              <div class="col-md-5 order-md-1 anim_left">
                <a href="<?= URL . 'artigo/' . $slug ?>">
                  <img class="featurette-image img-fluid mx-auto" src="<?= URL . 'assets/imagens/artigo/' . $id . '/' . $imagem ?>" alt="<?= $titulo ?>">
                </a>
              </div>
            </div>
          <?php
          }
          echo $this->dados['paginacao'];
          ?>

        </div>
        <aside class="col-md-4 blog-sidebar">
          <?php
          if (!empty($this->dados['sobreAutor'][0])) {
          ?>
            <div class="p-3 mb-3 bg-light rounded">
              <?php

              extract($this->dados['sobreAutor'][0]);
              ?>
              <h4 class="font-italic"><?= $titulo ?></h4>
              <img src="<?= URL . 'assets/imagens/sobre_autor/' . $id . '/' . $imagem ?>" class="img-fluid" alt="<?= $titulo ?>">
              <p class="mb-0"><?= $descricao ?></p>
            </div>
          <?php } ?>
          <div class="p-3">
            <h4 class="font-italic">Recentes</h4>
            <ol class="list-unstyled mb-0">
              <?php
              foreach ($this->dados['artRecente'] as $artigoRecente) {
                extract($artigoRecente);
                echo "<li><a href='" . URL . "artigo/$slug'>$titulo</a></li>";
              }
              ?>

            </ol>
          </div>

          <div class="p-3">
            <h4 class="font-italic">Destaque</h4>
            <ol class="list-unstyled">
              <?php
              foreach ($this->dados['artDestaque'] as $artigoDestaque) {
                extract($artigoDestaque);
                echo "<li><a href='" . URL . "artigo/$slug'>$titulo</a></li>";
              }
              ?>
            </ol>
          </div>
        </aside>
      </div>
    </div>
  </div>

</main>