<!--Load the AJAX API-->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    // Load the Visualization API and the corechart package.
    google.charts.load('current', {'packages':['corechart']});

    // Set a callback to run when the Google Visualization API is loaded.
    google.charts.setOnLoadCallback(drawChart);

    // Callback that creates and populates a data table,
    // instantiates the pie chart, passes in the data and
    // draws it.
    function drawChart() {

    // Create the data table.
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Período');
    data.addColumn('number', 'Novos Contatos');
    data.addRows([
        <?php
            foreach($chart as $c) {
                echo "['Hoje', ".$c->today."],";
                echo "['Semana', ".$c->week."],";
                echo "['Mês', ".$c->month."]";
            }
        ?> 
    ]);


    // Set chart options
    var options = {'title':'Novos Contatos cadastrados'}
    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
    chart.draw(data, options);
    }
</script>

<div class="full-container full-container-mid">
    <div class="container container-mid">
        <div class="row" style="margin-bottom:20px;">
            <div class="col-md-8">
                <h3><?php echo $title ?>: <small><?php echo $subTitle ?></small></h3>
            </div>
            <div class="col-md-4" style="text-align:right">
                <a href="<?php echo base_url('contact') ?>" class="btn btn-info">Pendentes</a>
                <a href="<?php echo base_url('contact/verified') ?>" class="btn btn-info">Verificados</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php
                //create table
                $cont = 1;
                $this->table->set_heading("#", "Nome", "Email", "Mensagem", "Data", "Responsável", "Editar", "Excluir");
                foreach($contacts as $contact) {
                    $id = $contact->id;
                    $name = $contact->name;
                    $email = $contact->email;
                    $date = convert_date($contact->date_registered);
                    $message = $contact->message;
                    $user = $contact->name_user;
                    $edit = anchor(base_url('contact/edit/'.$id),'<i class="fa fa-pencil" aria-hidden="true"></i>');
                    $delete = anchor(base_url('contact/delete/'.$id),'<i class="fa fa-trash" aria-hidden="true"></i>', 'class="delete-contact" data-toggle="modal" data-target="#exampleModal"');
                    //insert the row
                    $this->table->add_row($cont,$name,$email,$message,$date,$user,$edit,$delete);
                    $cont++;
                }
                //set the template
                $this->table->set_template(array(
                    'table_open' => '<table class="table table-striped table-hover table-responsive-md">'
                ));

                //print the table
                echo $this->table->generate();
                 ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
             <div id="chart_div"></div>
            </div>
        </div>
    </div>
</div>

<div id="exampleModal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirmar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Deseja realmente deletar o contato selecionado?</p>
      </div>
      <div class="modal-footer">
        <a href="javascript:" class="btn btn-primary" id="deleteContact">Sim</a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
      </div>
    </div>
  </div>
</div>