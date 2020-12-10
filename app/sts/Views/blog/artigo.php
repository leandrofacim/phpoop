<?php
if (!defined('URL')) {
  header('Location: /');
  exit();
}

?>
<main role="main">

  <div class="jumbotron blog">
    <div class="container">
      <div class="row">
        <div class="col-md-8 blog-main">
          <?php
          if (!empty($this->dados['sts_artigos'][0])) {
            extract($this->dados['sts_artigos'][0]);
          ?>
            <div class="blog-post">
              <h2 class="blog-post-title"><?= $titulo ?></h2>
              <img src="<?= URL . 'assets/imagens/artigo/' . $id . '/' . $imagem ?>" class="img-fluid" alt="<?= $titulo ?>" style="margin-bottom: 20px;">
              <?= $conteudo ?>
            </div>
            <nav class="blog-pagination">
              <?php
              if (!empty($this->dados['artAnterior'][0])) {
                extract($this->dados['artAnterior'][0]);
                echo "<a class='btn btn-outline-primary' href='" . URL . "artigo/$slug'>Anterior</a>";
              } else {
                echo "<a class='btn btn-outline-secondary disabled' href='#'>Anterior</a>";
              }
              if (!empty($this->dados['artProximo'][0])) {
                extract($this->dados['artProximo'][0]);
                echo "<a class='btn btn-outline-primary' href='" . URL . "artigo/$slug'>Proximo</a>";
              } else {
                echo "<a class='btn btn-outline-secondary disabled' href='#'>Proximo</a>";
              }
              ?>
            </nav>
          <?php
          } else {
            echo "<div class='alert alert-danger'>Erro: Nenhum artigo encontrado!</div>";
          }
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