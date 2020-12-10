<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php
    if (!empty($this->dados['seo'][0])) {
        extract($this->dados['seo'][0]);
        echo "<title>$titulo</title>";
        echo "<meta name='robots' content='$tipo_robo'>";
        echo "<meta name='description' content='$description'>";
        echo "<meta name='author' content='$author'>";
        echo "<link rel='canonical' href='" . URL . "$endereco'>";
        echo "<meta name='keywords' content='$keywords'>";

        echo "<meta property='og:site_name' content='$og_site_name'>";
        echo "<meta property='og:locale' content='$og_locale'>";
        //https://pt.piliapp.com/facebook/id/
        echo "<meta property='fb:admins' content='$fb_admins'>";
        echo "<meta property='og:url' content='" . URL . "$endereco'>";
        echo "<meta property='og:title' content='$titulo>";
        echo "<meta property='og:description' content='$description'>";
        echo "<meta property='og:image' content='" . URL . "assets/imagens/$dir_img/$id/$imagem'>";

        echo "<meta name='twitter:site' content='$twitter_site'>";
        echo "<meta name='twitter:card' content='summary_large_image'>";
        echo "<meta name='twitter:title' content='$titulo'>";
        echo "<meta name='twitter:description' content='$description'>";
        echo "<meta name='twitter:image:src' content='" . URL . "assets/imagens/$dir_img/$id/$imagem'>";

        echo "<meta itemprop='name' content='$titulo'>";
        echo "<meta itemprop='description' content='$description'>";
        echo "<meta itemprop='image' content='" . URL . "assets/imagens/$dir_img/$id/$imagem'>";
        echo "<meta itemprop='url' content='" . URL . "$endereco'>";
    }
    ?>
    <link rel="icon" href="<?= URL; ?>assets/imagens/icone/favicon.ico" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= URL; ?>assets/css/ionicons.min.css">
    <link rel="stylesheet" href="<?= URL; ?>assets/css/personalizado.css">
    </meta>
</head>

<body>