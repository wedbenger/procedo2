<!-- CONTENT -->
<div class="full-container full-container-mid">
    <div class="container container-mid">
        <h2 class="display-4 sub-title-content" id="content1">Sobre</h2>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <p class="lead">Já imaginou possuir um robô que pode te auxiliar nas tarefas domésticas, conversar com você ou até mesmo se tornar o seu melhor amigo? </p>
                <p class="lead">Então conheça o <strong>ProRobot</strong> o seu sonho que acaba de se tornar realidade.</p>
                <p class="lead">ProRobot chega para revolucionar o mundo como conhecemos, contendo incriveis funcionalidades e capacidade para se adaptar a diferentes situações da vida. O ProRobot pode desempenhar diversas funções e tornar a sua vida muito mais fácil. Desenvolvido com a mais avançada tecnologia ele é capaz de evoluir como uma criança, aprendendo e estudando com você.</p>
                <p class="lead">Acima de tudo o ProRobot foi desenvolvido seguindo as leis da segurança da inteligência artificial, tornando ele inofensivo. Sendo assim, em qualquer situação, seu principal dever é manter a segurança dos humanos.</p>
            </div>
            <div class="col-md-6">
                <img src="<?php echo base_url('assets/images/content1.jpg') ?>" class="img-fluid img-content img-content-right" alt="IA">
            </div>
        </div>
    </div>
</div>

<div class="full-container full-container-mid2">
    <div class="container container-mid">
        <h2 class="display-4 sub-title-content" id="content2">Contato</h2>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <p class="lead"> Deseja obter mais informações sobre este robô revolucionário? Cadastre o seu e-mail abaixo e entraremos em contato o mais rápido possível!
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php
                    echo validation_errors();
                    $attributes = array('id' => 'formContact', 'class' => 'form-ajax');
                    echo form_open('contact/insert', $attributes);
                ?>
                <div class="message-form">

                </div>
                <div class="form-group">
                    <label for="name" id="lbl-name">Nome</label>
                    <input type="text" class="form-control" id="name" name="name" max-length="60">
                </div>
                <div class="form-group">
                    <label for="name" id="lbl-email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" max-length="60">
                </div>
                <div class="form-group">
                    <label for="message">Mensagem</label>
                    <textarea class="form-control" id="message" name="message" rows="3" maxlength="255"></textarea>
                  </div>
                <button type="submit" class="btn btn-success">Enviar</button>
                <?php
                    echo form_close();
                ?>
            </div>
        </div>
    </div>
</div>

  <!-- Modal -->
  <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalLabel">Login</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
            <?php
                echo validation_errors();
                $attributes = array('id' => 'formLogin', 'class' => 'form-ajax');
                echo form_open('home/login', $attributes);
            ?>
            <div class="modal-body">
                <div class="alert message-form" role="alert">
                </div>
                <div class="form-group">
                  <label for="user">Usuário</label>
                  <input type="text" class="form-control" id="user" name="user" maxlength="30" placeholder='Usuário: "admin", senha: "secreta"'>
            
                </div>
                <div class="form-group">
                  <label for="password">Senha</label>
                  <input type="password" class="form-control" id="password" name="password" maxlength="30" placeholder="">
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Login</button>
            </div>
            <?php
                echo form_close();
            ?>
        </div>
      </div>
    </div>