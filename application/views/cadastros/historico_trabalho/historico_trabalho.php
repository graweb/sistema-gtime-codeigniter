<table id="dgHistoricoTrabalho"
        class="easyui-datagrid"
        fit="true"
        url="<?php base_url();?>historico_trabalho/listar"
        toolbar="#toolbarHistoricoTrabalho" 
        pagination="true"
        rownumbers="false"
        fitColumns="true"
        striped="true"
        showFooter="true"
        pageSize="20">
    <thead>
        <tr>
            <th data-options="field:'ck',checkbox:true"></th>
            <th field="id_historico_trabalho" width="5" styler="tarefaPaga">ID</th>
            <th field="projeto" width="10">PROJETO</th>
            <th field="tarefa" width="46">TAREFA</th>
            <th field="dat_hor_inicio" width="12">DT/HOR INICIO</th>
            <th field="dat_hor_fim" width="12">DT/HOR FIM</th>
            <th field="horas_total" width="5">HORAS</th>
            <th field="minutos_total" width="5">MINUTOS</th>
            <th field="segundos_total" width="5">SEGUNDOS</th>
        </tr>
    </thead>
</table>
<div id="toolbarHistoricoTrabalho">
    <?php if($this->permission->checkPermission($this->session->userdata('permissao'),'aConfigHistoricoTrabalho')) { ?>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-play fa-lg" plain="true" onclick="iniciarHistoricoTrabalho()">Iniciar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-stop fa-lg" plain="true" onclick="pararHistoricoTrabalho()">Parar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-dollar-sign fa-lg" plain="true" onclick="pagarTarefa()">Pagar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="fa fa-plus-square fa-lg" plain="true" onclick="lancarCredito()">Crédito</a>
    <?php } ?>
    <span class="button-sep"></span>
    <input class="easyui-searchbox" prompt='Digite a informação' menu="#menuBuscaHistoricoTrabalho" searcher='buscaHistoricoTrabalho' style="width:30%">
    <div id='menuBuscaHistoricoTrabalho' style='width:auto'>
        <div name='id_historico_trabalho'>ID HISTÓRICO</div>
        <div name='projeto'>PROJETO</div>
        <div name='tarefa'>TAREFA</div>
    </div>
</div>

<div id="dlgIniciarHistoricoTrabalho" class="easyui-dialog" style="width:410px;height:240px" 
        closed="true" buttons="#dlgIniciarHistoricoTrabalhoButtons" modal="true">
    <form id="formIniciarHistoricoTrabalho" class="easyui-form" method="post" data-options="novalidate:true">
        <table style="width:97%;">
            <tr>
                <td colspan="3">
                    <select class="easyui-combobox" label="Projeto:" labelPosition="top" id="fk_id_projeto" name="fk_id_projeto" panelHeight="auto" required="true" style="width:99.8%;">
                        <?php foreach ($dados_projetos as $projetos) { 
                            echo "<option value='".$projetos->id_projeto."'>".$projetos->projeto."</option>";
                        } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <input class="easyui-textbox" label="Tarefa:" labelPosition="top" id="tarefa" name="tarefa" style="width:99.8%;" required="true">
                </td>
            </tr>
        </table>
    </form>
</div>
<div id="dlgIniciarHistoricoTrabalhoButtons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgIniciarHistoricoTrabalho').dialog('close')" style="width:90px">Não</a>
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="salvarIniciarHistoricoTrabalho()" style="width:90px">Sim</a>
</div>

<div id="dlgPararHistoricoTrabalho" class="easyui-dialog" style="width:350px;height:150px;padding:10px;" 
        closed="true" buttons="#dlgPararHistoricoTrabalhoButtons" modal="true">
    <form id="formPararHistoricoTrabalho" class="easyui-form" method="post" data-options="novalidate:true">
        <input type="hidden" id="tarefa_parar" name="tarefa_parar" value="">
        <table style="width:97%;">
            <tr>
                <td colspan="3">
                    <h5 align="center">Deseja finalizar?</h5>
                </td>
            </tr>
        </table>
    </form>
</div>
<div id="dlgPararHistoricoTrabalhoButtons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgPararHistoricoTrabalho').dialog('close')" style="width:90px">Não</a>
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="salvarPararHistoricoTrabalho()" style="width:90px">Sim</a>
</div>

<div id="dlgCredito" class="easyui-dialog" style="width:350px;height:230px;padding:10px;" 
        closed="true" buttons="#dlgCreditoButtons" modal="true">
    <form id="formCredito" class="easyui-form" method="post" data-options="novalidate:true">
        <table style="width:97%;">
            <tr>
                <td colspan="3">
                    <select class="easyui-combobox" label="Projeto:" labelPosition="top" id="fk_id_projeto" name="fk_id_projeto" panelHeight="auto" required="true" style="width:99.8%;">
                        <?php foreach ($dados_projetos as $projetos) { 
                            echo "<option value='".$projetos->id_projeto."'>".$projetos->projeto."</option>";
                        } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <input class="easyui-numberbox" label="Crédito (minutos):" labelPosition="top" id="credito" name="credito" style="width:99.8%;" required="true">
                </td>
            </tr>
        </table>
    </form>
</div>
<div id="dlgCreditoButtons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgCredito').dialog('close')" style="width:90px">Não</a>
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="salvarCredito()" style="width:90px">Sim</a>
</div>

<script type="text/javascript">
var url;

function tarefaPaga(value,row,index){
    if(row.pago == 1)
    {
        return 'background-color:#CEF6CE;';
    }
}

//BUSCA
function buscaHistoricoTrabalho(value,name){
    if(name == 'id_historico_trabalho'){
        $('#dgHistoricoTrabalho').datagrid('load',{
            id_historico_trabalho: value
        });
    }else if(name == 'projeto'){
        $('#dgHistoricoTrabalho').datagrid('load',{
            projeto: value
        });
    }
    else if(name == 'tarefa'){
        $('#dgHistoricoTrabalho').datagrid('load',{
            tarefa: value
        });
    }
}

// INICIAR
function iniciarHistoricoTrabalho(){
    var row = $('#dgHistoricoTrabalho').datagrid('getData');

    if(row.total != 0)
    {
        if(row.rows[0].dat_hor_fim == '00/00/0000 - 00:00:00')
        {
            $.messager.alert('Atenção','Finalize a tarefa anterior!','warning');
        }
        else
        {
            $('#dlgIniciarHistoricoTrabalho').dialog('open').dialog('center').dialog('setTitle','Iniciar Histórico Trabalho');
            $('#formIniciarHistoricoTrabalho').form('clear');
            url = '<?php base_url();?>historico_trabalho/iniciar';
        }
    }
    else
    {
        $('#dlgIniciarHistoricoTrabalho').dialog('open').dialog('center').dialog('setTitle','Iniciar Histórico Trabalho');
        $('#formIniciarHistoricoTrabalho').form('clear');
        url = '<?php base_url();?>historico_trabalho/iniciar';
    }
}

// PARAR
function pararHistoricoTrabalho(){
    var row = $('#dgHistoricoTrabalho').datagrid('getSelected');
    if (row != null) {
        if(row.dat_hor_fim != '00/00/0000 - 00:00:00')
        {
            $.messager.alert('Atenção','Essa tarefa está finalizada!','warning');
        }
        else
        {
            $('#dlgPararHistoricoTrabalho').dialog('open').dialog('center').dialog('setTitle','Parar Histórico Trabalho');
            $('#tarefa_parar').val(row.tarefa);
            url = '<?php base_url();?>historico_trabalho/parar/'+row.id_historico_trabalho;
        }
    } else {
        $.messager.alert('Atenção','Selecione um registro!','warning');
    }
}

// PAGAR
function pagarTarefa(){
    var idtarefa = [];
    var pago = [];
    var rows = $('#dgHistoricoTrabalho').datagrid('getSelections');

    if (rows != null) {

        for(var i=0; i<rows.length; i++){
            var row = rows[i];
            idtarefa.push(row.id_historico_trabalho);
            pago.push(row.pago);
        }

        if(pago.includes('1'))
        {
            $.messager.alert('Atenção','Existe uma tarefa paga na seleção!','warning');
        }
        else
        {
            $.messager.confirm('Atenção', 'Deseja pagar essa(s) tarefa(s)?', function(r){
                if (r){
                    for (var i = 0; i < idtarefa.length; i++) {
                        $.ajax({
                            url: '<?php base_url();?>historico_trabalho/pagar/'+idtarefa[i],
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
                                    $('#dgHistoricoTrabalho').datagrid('reload');
                                }
                            }
                        });
                    }
                }
            });
        }
    } else {
        $.messager.alert('Atenção','Selecione um registro!','warning');
    }
}

// CREDITO
function lancarCredito(){
    $('#dlgCredito').dialog('open').dialog('center').dialog('setTitle','Lançar Crédito');
    $('#formCredito').form('clear');
    url = '<?php base_url();?>historico_trabalho/credito';
}

// SALVAR NOVO/EDITAR
function salvarIniciarHistoricoTrabalho(){
    $('#formIniciarHistoricoTrabalho').form('submit',{
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
                $('#dlgIniciarHistoricoTrabalho').dialog('close');
                $('#dgHistoricoTrabalho').datagrid('reload');
            }
        }
    });
}

// SALVAR NOVO/EDITAR
function salvarPararHistoricoTrabalho(){
    $('#formPararHistoricoTrabalho').form('submit',{
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
                $('#dlgPararHistoricoTrabalho').dialog('close');
                $('#dgHistoricoTrabalho').datagrid('reload');
            }
        }
    });
}

// SALVAR CREDITO
function salvarCredito(){
    $('#formCredito').form('submit',{
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
                $('#dlgCredito').dialog('close');
                $('#dgHistoricoTrabalho').datagrid('reload');
            }
        }
    });
}

</script>