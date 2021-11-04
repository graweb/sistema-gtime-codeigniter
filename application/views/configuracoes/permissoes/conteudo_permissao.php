<?php $permissoes = unserialize($dados->permissoes); ?>

<form id="formAcessosConcedidos" method="post">

<div style="padding: 10px">
	<a href="javascript:void(0)" class="easyui-linkbutton c1" size="large" iconCls="icon-ok" onclick="salvarAcessos()"> Salvar Alterações </a>
	<input type="checkbox" id="marcar_todos" name="marcar_todos" class="marcar" onclick="marcarTodos()">Marcar todos?
</div>

<div class="easyui-tabs" width="100%" height="100%">
	<input type="hidden" id="id_permissao" name="id_permissao" value="<?php echo $dados->id_permissao;?>">
    <div title="Cadastros">
        <table id="dgCadastros">
            <thead>
                <tr>
                    <th field="menu" width="21%" align="left"></th>
                    <th field="visualizar" width="21%" align="left">Visualizar</th>
                    <th field="cadastrar" width="21%" align="left">Cadastrar</th>
                    <th field="editar" width="21%" align="left">Editar</th>
                    <th field="desativar_excluir" width="21%" align="left">Desativar/Excluir</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Projetos</td>
                    <td><input type="checkbox" class="marcar" id="vConfigProjetos" name="vConfigProjetos" value="1" <?php if(isset($permissoes['vConfigProjetos'])){ if($permissoes['vConfigProjetos'] == '1'){echo 'checked';}}?>></td>
                    <td><input type="checkbox" class="marcar" id="aConfigProjetos" name="aConfigProjetos" value="1" <?php if(isset($permissoes['aConfigProjetos'])){ if($permissoes['aConfigProjetos'] == '1'){echo 'checked';}}?>></td>
                    <td><input type="checkbox" class="marcar" id="eConfigProjetos" name="eConfigProjetos" value="1" <?php if(isset($permissoes['eConfigProjetos'])){ if($permissoes['eConfigProjetos'] == '1'){echo 'checked';}}?>></td>
                    <td><input type="checkbox" class="marcar" id="dConfigProjetos" name="dConfigProjetos" value="1" <?php if(isset($permissoes['dConfigProjetos'])){ if($permissoes['dConfigProjetos'] == '1'){echo 'checked';}}?>></td>
                </tr>
                <tr>
                    <td>Histórico de Trabalho</td>
                    <td><input type="checkbox" class="marcar" id="vConfigHistoricoTrabalho" name="vConfigHistoricoTrabalho" value="1" <?php if(isset($permissoes['vConfigHistoricoTrabalho'])){ if($permissoes['vConfigHistoricoTrabalho'] == '1'){echo 'checked';}}?>></td>
                    <td><input type="checkbox" class="marcar" id="aConfigHistoricoTrabalho" name="aConfigHistoricoTrabalho" value="1" <?php if(isset($permissoes['aConfigHistoricoTrabalho'])){ if($permissoes['aConfigHistoricoTrabalho'] == '1'){echo 'checked';}}?>></td>
                    <td><input type="checkbox" class="marcar" id="eConfigHistoricoTrabalho" name="eConfigHistoricoTrabalho" value="1" <?php if(isset($permissoes['eConfigHistoricoTrabalho'])){ if($permissoes['eConfigHistoricoTrabalho'] == '1'){echo 'checked';}}?>></td>
                    <td><input type="checkbox" class="marcar" id="dConfigHistoricoTrabalho" name="dConfigHistoricoTrabalho" value="1" <?php if(isset($permissoes['dConfigHistoricoTrabalho'])){ if($permissoes['dConfigHistoricoTrabalho'] == '1'){echo 'checked';}}?>></td>
                </tr>
            </tbody>
        </table>
    </div>  
    <div title="Configurações">
        <table id="dgConfiguracoes">
            <thead>
                <tr>
                    <th field="menu" width="21%" align="left"></th>
                    <th field="visualizar" width="21%" align="left">Visualizar</th>
                    <th field="cadastrar" width="21%" align="left">Cadastrar</th>
                    <th field="editar" width="21%" align="left">Editar</th>
                    <th field="desativar_excluir" width="21%" align="left">Desativar/Excluir</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Relatórios</td>
                    <td><input type="checkbox" class="marcar" id="vConfigRelatorios" name="vConfigRelatorios" value="1" <?php if(isset($permissoes['vConfigRelatorios'])){ if($permissoes['vConfigRelatorios'] == '1'){echo 'checked';}}?>></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Projetos</td>
                    <td><input type="checkbox" class="marcar" id="vConfigConfigProjetosSelecionar" name="vConfigConfigProjetosSelecionar" value="1" <?php if(isset($permissoes['vConfigConfigProjetosSelecionar'])){ if($permissoes['vConfigConfigProjetosSelecionar'] == '1'){echo 'checked';}}?>></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Permissões</td>
                    <td><input type="checkbox" class="marcar" id="vConfigPermissoes" name="vConfigPermissoes" value="1" <?php if(isset($permissoes['vConfigPermissoes'])){ if($permissoes['vConfigPermissoes'] == '1'){echo 'checked';}}?>></td>
                    <td><input type="checkbox" class="marcar" id="aConfigPermissoes" name="aConfigPermissoes" value="1" <?php if(isset($permissoes['aConfigPermissoes'])){ if($permissoes['aConfigPermissoes'] == '1'){echo 'checked';}}?>></td>
                    <td><input type="checkbox" class="marcar" id="eConfigPermissoes" name="eConfigPermissoes" value="1" <?php if(isset($permissoes['eConfigPermissoes'])){ if($permissoes['eConfigPermissoes'] == '1'){echo 'checked';}}?>></td>
                    <td><input type="checkbox" class="marcar" id="dConfigPermissoes" name="dConfigPermissoes" value="1" <?php if(isset($permissoes['dConfigPermissoes'])){ if($permissoes['dConfigPermissoes'] == '1'){echo 'checked';}}?>></td>
                </tr>
                <tr>
                    <td>Usuários</td>
                    <td><input type="checkbox" class="marcar" id="vConfigUsuarios" name="vConfigUsuarios" value="1" <?php if(isset($permissoes['vConfigUsuarios'])){ if($permissoes['vConfigUsuarios'] == '1'){echo 'checked';}}?>></td>
                    <td><input type="checkbox" class="marcar" id="aConfigUsuarios" name="aConfigUsuarios" value="1" <?php if(isset($permissoes['aConfigUsuarios'])){ if($permissoes['aConfigUsuarios'] == '1'){echo 'checked';}}?>></td>
                    <td><input type="checkbox" class="marcar" id="eConfigUsuarios" name="eConfigUsuarios" value="1" <?php if(isset($permissoes['eConfigUsuarios'])){ if($permissoes['eConfigUsuarios'] == '1'){echo 'checked';}}?>></td>
                    <td><input type="checkbox" class="marcar" id="dConfigUsuarios" name="dConfigUsuarios" value="1" <?php if(isset($permissoes['dConfigUsuarios'])){ if($permissoes['dConfigUsuarios'] == '1'){echo 'checked';}}?>></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
</form>

<script type="text/javascript">

// MARCAR TODOS OS CHECKBOXES
function marcarTodos(){
	$('.marcar').each(
		function(){
			if ($(this).prop("checked")) {
				$(this).prop("checked", false);
				$('#marcar_todos').prop("checked", false);
			} else { 
				$(this).prop("checked", true);
				$('#marcar_todos').prop("checked", true);
			}
		}
	);
}

// SALVAR NOVO/EDITAR
function salvarAcessos(){
    $('#formAcessosConcedidos').form('submit',{
        url: '<?php base_url();?>permissoes/salvarAcessos',
        onSubmit: function(){
            return $(this).form('validate');
        },
        success: function(result){
            var result = eval('('+result+')');
            if (result.errorMsg){
                $.messager.show({
                    title:'Erro',
                    msg: '<strong style="color:red"><i class="fa fa-ban fa-2x"></i>'+result.errorMsg+'</strong>',
                    showType:'show',
                    style:{
                        left:'',
                        right:0,
                        top:document.body.scrollTop+document.documentElement.scrollTop,
                        bottom:''
                    }
                });
            } else {
                $.messager.show({
                    title:'Feito',
                    msg:'<strong style="color:green"><i class="fa fa-check fa-2x"></i>Registro armazenado com sucesso!</strong>',
                    icon: 'info',
                    showType:'show',
                    style:{
                        left:'',
                        right:0,
                        top:document.body.scrollTop+document.documentElement.scrollTop,
                        bottom:''
                    }
                });
            }
        }
    });
}
</script>