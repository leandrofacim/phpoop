<?php 

if (!defined('URL')) {
    header('Location: /');
    exit();
}

?>

<main role="main">

    <div class="jumbotron contato">
        <div class="container">
            <h2 class="display-4 text-center" style="margin-bottom: 40px;">Contato</h2>
            <form action="" method="POST">
                 <div class="form-row">
                    <div class="form-group col-md-6">
                       <label>Nome</label>
                       <input name="nome" type="text" class="form-control" placeholder="Nome completo">
                   </div>
                   <div class="form-group col-md-6">
                       <label>E-mail</label>
                       <input name="email" type="email" class="form-control" placeholder="Seu Melhor E-mail">
                   </div>
               </div>
               <div class="form-group">
                    <label>Assunto</label>
                    <input name="assunto" type="text" class="form-control" placeholder="Assunto da mensagem">
                </div>
                <div class="form-group">
                    <label>Mensagem</label>
                    <textarea name="mensagem" class="form-control" rows="6"></textarea>
                </div>
                <input name="created" type="hidden" value="<?= date('Y-m-d H:i:s')?>">
                <input name="cadMsgCont" type="submit" class="btn btn-danger" value="Enviar">
            </form>
        </div>	
    </div>					

</main>