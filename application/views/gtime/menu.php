<div class="easyui-panel" fit="true" style="padding:5px;">
    <?php 
        if($this->permission->checkPermission($this->session->userdata('permissao'),'vConfigProjetos') ||
        $this->permission->checkPermission($this->session->userdata('permissao'),'vConfigHistoricoTrabalho') ||
        $this->permission->checkPermission($this->session->userdata('permissao'),'vConfigRelatorios') ||
        $this->permission->checkPermission($this->session->userdata('permissao'),'vConfigConfigProjetosSelecionar') ||
        $this->permission->checkPermission($this->session->userdata('permissao'),'vConfigUsuarios') ||
        $this->permission->checkPermission($this->session->userdata('permissao'),'vConfigPermissoes')) { ?>
    <a href="#" class="easyui-menubutton" data-options="menu:'#menuPadrao',iconCls:'fas fa-home fa-lg'">&nbsp;Painel</a>
    <?php } ?>
    <a href="#" class="easyui-linkbutton" data-options="iconCls:'fas fa-user fa-lg',plain:'false'">&nbsp;<?php echo $this->session->userdata('usuario');?></a>
    <a href="<?php base_url()?>logout" class="easyui-linkbutton" data-options="iconCls:'fas fa-sign-out-alt fa-lg', plain:'false'">&nbsp;Sair</a>

    <div id="menuPadrao" style="width:160px;">
        <?php 
            if($this->permission->checkPermission($this->session->userdata('permissao'),'vConfigProjetos') ||
            $this->permission->checkPermission($this->session->userdata('permissao'),'vConfigHistoricoTrabalho')){ ?>
            <div>
                <span>Cadastros</span>
                <div>
                    <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'vConfigProjetos')){ ?>
                    <div onclick="addPanel('Projetos','<?php base_url();?>projetos')">Projetos</div>
                    <div class="menu-sep"></div>
                    <?php } ?>
                    <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'vConfigHistoricoTrabalho')){ ?>
                    <div onclick="addPanel('Histórico de Trabalho','<?php base_url();?>historico_trabalho')">Histórico de Trabalho</div>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
        <div class="menu-sep"></div>
        <div>
            <?php 
                if(
                $this->permission->checkPermission($this->session->userdata('permissao'),'vConfigRelatorios') ||
                $this->permission->checkPermission($this->session->userdata('permissao'),'vConfigConfigProjetosSelecionar') ||
                $this->permission->checkPermission($this->session->userdata('permissao'),'vConfigUsuarios') ||
                $this->permission->checkPermission($this->session->userdata('permissao'),'vConfigPermissoes')) { ?>
            <span>Configurações</span>
            <div>
                <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'vConfigRelatorios')){ ?>
                <div onclick="addPanel('Relatórios','<?php base_url();?>relatorios')">Relatórios</div>
                <div class="menu-sep"></div>
                <?php } ?>
                <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'vConfigConfigProjetosSelecionar')){ ?>
                <div onclick="selecionaProjeto()">Projetos</div>
                <?php } ?>
                <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'vConfigPermissoes')){ ?>
                <div onclick="addPanel('Permissões','<?php base_url();?>permissoes')">Permissões</div>
                <?php } ?>
                <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'vConfigUsuarios')){ ?>
                <div onclick="addPanel('Usuários','<?php base_url();?>usuarios')">Usuários</div>
                <?php } ?>
            </div>
            <?php } ?>
        </div>
    </div>
</div>