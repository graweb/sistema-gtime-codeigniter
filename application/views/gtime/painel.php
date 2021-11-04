<div class="container">
    <a href="<?php base_url();?>" class="easyui-linkbutton" data-options="plain:true">Atualizar</a>
    <?php 
        $i = 0;
        $minutosTotal = array();
        $horasTotal = array();
        $horas = array();
        foreach ($dashProjetos as $horasProj) {
            $horas[$i] = $horasProj->horas_total . ':' . $horasProj->minutos_total;
            $horasTotal[$i] = $horasProj->horas_total;
            $minutosTotal[$i] = $horasProj->minutos_total;
            $i++;
        }
    ?>
    <div class="row my-3">
        <div class="col-md-6">
            <div class="card text-center h-100 card-danger">
                <div class="card-block">
                    <h4 class="card-title">Tarefas</h4>
                    <h2><i class="fa fa-tasks fa-2x text-secondary"></i></h2>
                </div>
                <div class="row p-2 no-gutters rounded">
                    <div class="col-6 rounded">
                        <div class="card card-block text-danger rounded-0 border-left-0 border-right-0 border-top-0 border-bottom-0">
                            <h3>
                                <?php
                                    echo $i;
                                ?>
                            </h3>
                            <span class="small text-uppercase">quantidade</span>
                        </div>
                    </div>
                    <div class="col-6 rounded">
                        <div class="card card-block text-danger rounded-0 border-right-0 border-top-0 border-bottom-0">
                            <h3>
                            <?php
                                $minutos = array_sum($minutosTotal);
                                $horas = floor($minutos / 60);
                                $minutos = $minutos % 60;
                                $exibe = array_sum($horasTotal)+$horas;
                                echo $exibe.':'.$minutos."h";
                            ?>
                            </h3>
                            <span class="small text-uppercase">total horas</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card text-center h-100 card-success">
                <div class="card-block">
                    <h4 class="card-title">Custos</h4>
                    <h2><i class="fas fa-dollar-sign fa-2x text-secondary"></i></h2>
                </div>
                <div class="row p-2 no-gutters rounded">
                    <div class="col-6 rounded">
                        <div class="card card-block text-success rounded-0 border-left-0 border-right-0 border-top-0 border-bottom-0">
                            <h3>
                            <?php 
                                if(is_null($this->session->userdata('valorhoraprojeto')))
                                {
                                    echo '$0,00';
                                }
                                else
                                {
                                    echo '$'.$this->session->userdata('valorhoraprojeto');
                                }
                            ?>
                            </h3>
                            <span class="small text-uppercase">custo hora</span>
                        </div>
                    </div>
                    <div class="col-6 rounded">
                        <div class="card card-block text-success rounded-0 border-right-0 border-top-0 border-bottom-0">
                            <h3>
                                <?php 
                                    $minutos = array_sum($minutosTotal);
                                    $horas = floor($minutos / 60);
                                    $minutos = $minutos % 60;
                                    $exibe = array_sum($horasTotal)+$horas;
                                    echo '$'.number_format($exibe*25, 2, ',','.');
                                ?>
                            </h3>
                            <span class="small text-uppercase">total a pagar</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL SELECIONAR PROJETO -->
<div id="dlgSelecionarProjeto" class="easyui-dialog" style="width:230px;height:150px" 
        closed="true" buttons="#dlgTemaButtons" modal="true" title="Configurar tema">
    <form id="formSelecionarProjeto" class="easyui-form" method="post" data-options="novalidate:true">
        <tr>
            <td>
                <select class="easyui-combobox" label="Projeto:" labelPosition="top" id="fk_id_projeto_selecionado" name="fk_id_projeto_selecionado" panelHeight="auto" required="true" style="width:99.8%;">
                    <?php foreach ($info_projeto as $projeto) { 
                        echo "<option value='".$projeto->id_projeto."'>".$projeto->projeto."</option>";
                    } ?>
                </select>
            </td>
        </tr>
    </form>
</div>
<div id="dlgTemaButtons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgSelecionarProjeto').dialog('close')" style="width:90px">Fechar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="salvarSelecaoProjeto()" style="width:90px">Salvar</a>
</div>

<?php echo $this->session->userdata('permissoes');?>