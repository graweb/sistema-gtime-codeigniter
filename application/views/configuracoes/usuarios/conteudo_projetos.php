<table id="dgProjetosUsuario"
        class="easyui-datagrid"
        fit="true"
        url="<?php base_url();?>projetos/listarProjetoPorIdUsuario/<?php echo $id_usuario;?>"
        toolbar="#toolbarUsuarioProjeto" 
        pagination="true"
        rownumbers="true"
        fitColumns="true"
        striped="true">
    <thead>
        <tr>
            <th data-options="field:'ck',checkbox:true"></th>
            <th field="id_projeto" width="10">ID</th>
            <th field="projeto" width="70">PROJETO</th>
            <th field="valor_hora" width="20" formatter="formataValorHoraProjeto">VALOR/HORA</th>
        </tr>
    </thead>
</table>
<div id="toolbarUsuarioProjeto">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-plus fa-lg" plain="true" onclick="adicionarUsuarioProjeto()">Adicionar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-ban fa-lg" plain="true" onclick="removerUsuarioProjeto()">Remover</a>
</div>

<!-- MODAL ADICIONAR PROJETO -->
<div id="dlgUsuariosAddProjeto" class="easyui-dialog" style="width:400px;padding:10px 20px;"
        closed="true" buttons="#dlgUsuarioButtonsAddProjeto" modal="true">
    <form id="formUsuarioAddProjeto" class="easyui-form" method="post" data-options="novalidate:true">
        <input type="hidden" id="fk_id_usuario_add_projeto" name="fk_id_usuario_add_projeto">
        <tr>
            <td>
                <select class="easyui-combobox" label="Projeto:" labelPosition="top" id="fk_id_projeto_add" name="fk_id_projeto_add" panelHeight="auto" editable="false" required="true" style="width:99.8%;">
                    <?php foreach ($info_projeto as $projeto) { 
                        echo "<option value='".$projeto->id_projeto."'>".$projeto->projeto."</option>";
                    } ?>
                </select>
            </td>
        </tr>
    </form>
</div>
<div id="dlgUsuarioButtonsAddProjeto">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgUsuariosAddProjeto').dialog('close')" style="width:90px">Fechar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="salvarUsuarioAddProjeto()" style="width:90px">Salvar</a>
</div>

<script type="text/javascript">
var url;

// FORMATA VALOR HORA
function formataValorHoraProjeto(value,row)
{
    return '$'+ value;
}

// ADICIONAR PROJETO
function adicionarUsuarioProjeto(){
    $('#dlgUsuariosAddProjeto').dialog('open').dialog('center').dialog('setTitle','Adicionar Projeto');
    $('#fk_id_usuario_add_projeto').val(<?php echo $id_usuario;?>);
    url = '<?php base_url();?>usuarios_projetos/cadastrar';
}

// SALVAR ADICIONAR PROJETO
function salvarUsuarioAddProjeto(){
    $('#formUsuarioAddProjeto').form('submit',{
        url: url,
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
                $('#dlgUsuariosAddProjeto').dialog('close');
                $('#dgProjetosUsuario').datagrid('reload');
            }
        }
    });
}

// REMOVER PROJETO
function removerUsuarioProjeto(){
    var idprojeto = [];
    var rows = $('#dgProjetosUsuario').datagrid('getSelections');

    if (rows != null) {

        for(var i=0; i<rows.length; i++){
            var row = rows[i];
            idprojeto.push(row.id_projeto);
        }

        $.messager.confirm('Atenção', 'Deseja remover esse(s) projeto(s)?', function(r){
            if (r){
                for (var i = 0; i < idprojeto.length; i++) {
                    $.ajax({
                        url: '<?php base_url();?>usuarios_projetos/remover/'+idprojeto[i]+'/<?php echo $id_usuario;?>',
                        type: 'POST',
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
                                $('#dgProjetosUsuario').datagrid('reload');
                            }
                        }
                    });
                }
            }
        });
    } else {
        $.messager.alert('Atenção','Selecione um registro!','warning');
    }
}
</script>