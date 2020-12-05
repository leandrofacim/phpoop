<?php
if (!defined('URL')) {
    header("Location: /");
    exit();
}

?>
<main role="main">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <?php
            $cont_marc = 0;
            foreach ($this->dados['sts_carousels'] as $carousel) {
                echo "<li data-target='#myCarousel' data-slide-to='$cont_marc'></li>";
                $cont_marc++;
            }
            ?>
        </ol>
        <div class="carousel-inner">
            <?php
            $cont_slide = 0;
            foreach ($this->dados['sts_carousels'] as $carousel) {
                extract($carousel);
            ?>
                <div class="carousel-item <?php
                                            if ($cont_slide === 0) {
                                                echo 'active';
                                            }
                                            ?>">
                    <img class="first-slide img-fluid" src="<?php echo URL . '/assets/imagens/carousel/' . $id . '/' . $imagem; ?>" alt="<?= $titulo ?>">
                    <div class="container">
                        <div class="carousel-caption <?= $posicao_text ?>">
                            <h1 class="d-none d-md-block"><?= $titulo ?></h1>
                            <p class="d-none d-md-block"><?= $descricao ?></p>
                            <p class="d-none d-md-block"><a class="btn btn-lg btn-<?= $cor ?>" href="<?= $link ?>" role="button"><?= $titulo_botao ?></a></p>
                        </div>
                    </div>
                </div>
            <?php
                $cont_slide++;
            }
            ?>
        </div>
        <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <?php extract($this->dados['sts_servicos'][0]) ?>

    <div class="jumbotron servicos">
        <div class="container">
            <h2 class="display-4 text-center" style="margin-bottom: 40px;"><?= $titulo ?></h2>
            <div class="card-deck">
                <div class="card text-center anim_left">
                    <div class="icon-row tamanh-icone">
                        <span class="step size-96 text-danger">
                            <i class="icon <?= $icone_um ?>"></i>
                        </span>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?= $nome_um ?></h5>
                        <p class="card-text lead"><?= $descricao_um ?></p>
                    </div>
                </div>
                <div class="card text-center anim_bottom">
                    <div class="icon-row tamanh-icone">
                        <span class="step size-96 text-danger">
                            <i class="icon <?= $icone_dois ?>"></i>
                        </span>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?= $nome_dois ?></h5>
                        <p class="card-text lead"><?= $descricao_dois ?></p>
                    </div>
                </div>
                <div class="card text-center anim_right">
                    <div class="icon-row tamanh-icone ">
                        <span class="step size-96 text-danger">
                            <i class="icon <?= $icone_tres ?>"></i>
                        </span>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?= $nome_tres ?></h5>
                        <p class="card-text lead"><?= $descricao_tres ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php extract($this->dados['sts_videos'][0]) ?>
    <div class="jumbotron video">
        <div class="container">
            <h2 class="display-4 text-center anim_left" style="margin-bottom: 40px;"><?= $titulo ?></h2>
            <p class="lead text-center anim_right"><?= $descricao ?></p>
            <div class="row justify-content-md-center anim_bottom">

                <div class="col-12 col-md-8">
                    <div class="embed-responsive embed-responsive-16by9">
                        <?= $video ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="jumbotron blog-home">
        <div class="container">
            <h2 class="display-4 text-center" style="margin-bottom: 40px;">Últimos Artigos</h2>
            <div class="card-deck blog-text">
                <?php
                foreach ($this->dados['sts_artigos'] as $artigo) {
                    extract($artigo);
                ?>
                    <div class="card anim_bottom">
                        <a href="<?= URL .'artigo/'. $slug ?>">
                            <img class="card-img-top" src="<?= URL .'assets/imagens/artigo/'. $id . '/'.$imagem?>" alt="<?= $titulo?>">
                        </a>
                        <div class="card-body">
                            <a  href="<?= URL .'artigo/'. $slug ?>">
                                <h5 class="card-title text-center text-danger"><?= $titulo?></h5>
                            </a>
                            <p class="card-text"><?= $descricao ?></p>
                            <p class="text-center"><a href=" href="<?= URL .'artigo/'. $slug ?>"" class="btn btn-danger">Mais Detalhes</a></p>
                        </div>
                    </div>
                <?php
                }

                ?>


            </div>
        </div>
    </div>
</main>