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
                    <h4 class="card-title">A Receber</h4>
                    <h2><i class="fas fa-dollar-sign fa-2x text-secondary"></i></h2>
                </div>
                <div class="row p-2 no-gutters rounded">
                    <div class="col-12 rounded">
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
                            <span class="small text-uppercase">total a receber</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
