<table id="dgProjetos"
        class="easyui-datagrid"
        fit="true"
        url="<?php base_url();?>projetos/listar"
        toolbar="#toolbarProjetos" 
        pagination="true"
        rownumbers="true"
        fitColumns="true"
        singleSelect="true"
        striped="true"
        pageSize="20">
    <thead>
        <tr>
            <th data-options="field:'ck',checkbox:true"></th>
            <th field="id_projeto" width="10">ID</th>
            <th field="projeto" width="70">PROJETO</th>
            <th field="valor_hora" width="10" formatter="formataValorHora">VALOR/HORA</th>
            <th field="situacao" width="10" align="center" formatter="formataSituacaoCliente">SITUAÇÃO</th>
        </tr>
    </thead>
</table>
<div id="toolbarProjetos">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-plus fa-lg" plain="true" onclick="novoProjeto()">Novo</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-edit fa-lg" plain="true" onclick="editarProjeto()">Editar</a>
    <span class="button-sep"></span>
    <input class="easyui-searchbox" prompt='Digite a informação' menu="#menuBuscaProjetos" searcher='buscaProjeto' style="width:30%">
    <div id='menuBuscaProjetos' style='width:auto'>
        <div name='id_projeto'>ID</div>
        <div name='projeto'>PROJETO</div>
    </div>
</div>

<div id="dlgProjetos" class="easyui-dialog" style="width:540px;height:290px" 
        closed="true" buttons="#dlgProjetosButtons" modal="true">
    <form id="formProjetos" class="easyui-form" method="post" data-options="novalidate:true">
        <table style="width:97%;">
            <tr>
                <td>
                    <input class="easyui-textbox" label="Projeto:" labelPosition="top" id="projeto" name="projeto" style="width:100%;" required="true">
                </td>
            </tr>
            <tr>
                <td>
                    <input class="easyui-numberbox" data-options="min:0,precision:2" label="Valor Hora:" labelPosition="top" id="valor_hora" name="valor_hora" style="width:100%;" required="true">
                </td>
            </tr>
            <tr>
                <td>
                    <select class="easyui-combobox" label="Situação:" labelPosition="top" id="situacao" name="situacao" panelHeight="auto" editable="false" required="true" style="width:100%;">
                        <option value='1'>Ativo</option>
                        <option value='0'>Inativo</option>
                    </select>
                </td>
            </tr>
        </table>
    </form>
</div>
<div id="dlgProjetosButtons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgProjetos').dialog('close')" style="width:90px">Fechar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="salvarProjeto()" style="width:90px">Salvar</a>
</div>

<script type="text/javascript">
var url;

//BUSCA
function buscaProjeto(value,name){
    if(name == 'id_projeto'){
        $('#dgProjetos').datagrid('load',{
            id_projeto: value
        });
    }else if(name == 'projeto'){
        $('#dgProjetos').datagrid('load',{
            projeto: value
        });
    }
}

// FORMATA SITUAÇÃO
function formataSituacaoCliente(value,row)
{
    if (value == '0')
    {
        return '<i class="fa fa-ban fa-lg" style="color:red"></i>';
    } 
    else if (value == '1')
    {
        return '<i class="fa fa-check-square fa-lg" style="color:green"></i>';
    }
}

// FORMATA VALOR HORA
function formataValorHora(value,row)
{
    return '$'+ value;
}

//ABRE JANELA COM 2 CLIQUES NO DATAGRID
$('#dgProjetos').datagrid({
    onDblClickCell: function(index,field,value){
        editarProjeto();
    }
});

// NOVO
function novoProjeto(){
    $('#dlgProjetos').dialog('open').dialog('center').dialog('setTitle','Novo Projeto');
    $('#formProjetos').form('clear');
    url = '<?php base_url();?>projetos/cadastrar';
}

// EDITAR
function editarProjeto(){
    var row = $('#dgProjetos').datagrid('getSelected');
    if (row != null){
        $('#dlgProjetos').dialog('open').dialog('center').dialog('setTitle','Editar Projeto');
        $('#formProjetos').form('load',row);
        url = '<?php base_url();?>projetos/atualizar/'+row.id_projeto;
    } else {
        $.messager.alert('Atenção','Selecione um registro!','warning');
    }
}

// SALVAR NOVO/EDITAR
function salvarProjeto(){
    $('#formProjetos').form('submit',{
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
                $('#dlgProjetos').dialog('close');
                $('#dgProjetos').datagrid('reload');
            }
        }
    });
}

</script>