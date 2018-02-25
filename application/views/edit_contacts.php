<div class="full-container full-container-mid">
    <div class="container container-mid">
        <div class="row">
            <div class="col-md-12">
                <?php
                foreach($contact as $c) {
                    $id = $c->id;
                    $name = $c->name;
                    $email = $c->email;
                    $message = $c->message;
                    $messageAdmin = $c->message_user;
                    $contacted = $c->contacted;
                    $date = $c->date_registered;
                    $user = $c->name_user;
                }
                ?>
                <p class="lead">Nome: <strong><?php echo $name ?></strong></p>
                <p class="lead">Email: <strong><?php echo $email ?></strong></p>
                <p class="lead">Mensagem: <strong><?php echo $message ?></strong></p>
                <p class="lead">Data: <strong><?php echo convert_date($date) ?></strong></p>
                <p class="lead">Responsável Atual: <strong><?php echo $user ?></strong></p>

                <?php
                    echo validation_errors();
                    $attributes = array('id' => 'formContact');
                    echo form_open('contact/update', $attributes);
                ?>
              
                <div class="form-group">
                    <label for="message_user">Mensagem Admin</label>
                    <textarea class="form-control" id="message_user" name="message_user" rows="3" maxlength="255"><?php echo $messageAdmin ?></textarea>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="contacted" id="contacted0" value="0" <?php if ($contacted == 0) { echo 'checked="checked"'; } ?>>
                    <label class="form-check-label" for="contacted0">Pendente</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="contacted" id="contacted1" value="1" <?php if ($contacted == 1) { echo 'checked="checked"'; } ?>>
                    <label class="form-check-label" for="contacted1">Verificado</label>
                </div> <br/><br/>
                <input type="hidden" name="id" value="<?php echo $id ?>" >
                <button type="submit" class="btn btn-success">Atualizar</button>
                <?php
                    echo form_close();
                ?>
            </div>
        </div>
    </div>
</div>