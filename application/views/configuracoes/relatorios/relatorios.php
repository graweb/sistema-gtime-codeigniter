<table id="dgRelatorios"
        class="easyui-datagrid"
        fit="true"
        url="<?php base_url();?>relatorios/listar"
        toolbar="#toolbarHistHorasPorProjeto"
        pagination="true"
        rownumbers="true"
        fitColumns="true"
        singleSelect="true"
        striped="true"
        pageSize="20">
    <thead>
        <tr>
            <th data-options="field:'ck',checkbox:true"></th>
            <th field="id_relatorio" width="10">ID</th>
            <th field="descricao" width="90">RELATÓRIO</th>
        </tr>
    </thead>
</table>
<div id="toolbarHistHorasPorProjeto">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="far fa-file-pdf fa-lg" plain="true" onclick="gerarInvoice()">Gerar</a>
</div>

<!-- MODAL RELATÓRIO POR PROJETO -->
<div id="dlgGerarInvoicePorDataEProjeto" class="easyui-dialog" 
    style="width:350px;height:180px;padding:10px;" closed="true" buttons="#dlgRelaHistoricoPorDataEProjetoButtons" modal="true">
    <form id="formRelHistoricoPorDataEProjeto" class="easyui-form" method="post" data-options="novalidate:true">
        <table style="width:96%;">
            <tr>
                <td colspan="3">
                    <select class="easyui-combobox" label="Projeto:" labelPosition="top" id="id_projeto" name="id_projeto" panelHeight="auto" required="true" style="width:99.8%;">
                        <?php foreach ($dados_projetos as $projeto) { 
                            echo "<option value='".$projeto->id_projeto."'>".$projeto->projeto."</option>";
                        } ?>
                    </select>
                </td>
            </tr>
        </table>
    </form>
</div>
<div id="dlgRelaHistoricoPorDataEProjetoButtons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgGerarInvoicePorDataEProjeto').dialog('close')" style="width:90px">Fechar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="gerarPdfPorDataEProjeto()" style="width:90px">Gerar</a>
</div>

<!-- MODAL RELATÓRIO DE TAREFAS POR PROJETO -->
<div id="dlgGerarInvoiceTarefasPorProjeto" class="easyui-dialog" 
    style="width:350px;height:180px;padding:10px;" closed="true" buttons="#dlgRelTarefasPorProjetoButtons" modal="true">
    <form id="formRelTarefasPorProjeto" class="easyui-form" method="post" data-options="novalidate:true">
        <table style="width:96%;">
            <tr>
                <td colspan="3">
                    <select class="easyui-combobox" label="Projeto:" labelPosition="top" id="id_projeto" name="id_projeto" panelHeight="auto" required="true" style="width:99.8%;">
                        <?php foreach ($dados_projetos as $projeto) { 
                            echo "<option value='".$projeto->id_projeto."'>".$projeto->projeto."</option>";
                        } ?>
                    </select>
                </td>
            </tr>
        </table>
    </form>
</div>
<div id="dlgRelTarefasPorProjetoButtons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgGerarInvoiceTarefasPorProjeto').dialog('close')" style="width:90px">Fechar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="gerarPdfTarefasPorProjeto()" style="width:90px">Gerar</a>
</div>

<script type="text/javascript">

// FORMATA A DATA
function formatarDataCombo(date){
    return [date.getDate(),date.getMonth()+1,date.getFullYear()].join('/');
}

// FORMATA A DATA
function formatarDataComboParser(s){
    if (!s){return new Date();}
    var dt = s.split(' ');
    var dateFormat = dt[0].split('/');
    var date = new Date(dateFormat[2],dateFormat[1]-1,dateFormat[0]);
    return date;
}

// ABRE O DIALOG PARA SELECIONAR AS INFORMAÇÕES PDF
function gerarInvoice(){
    var row = $('#dgRelatorios').datagrid('getSelected');
    
    if (row != null){
        if(row.id_relatorio == 1) 
        {
            $('#dlgGerarInvoicePorDataEProjeto').dialog('open').dialog('center').dialog('setTitle','Selecione as informações');
            $('#formRelHistoricoPorDataEProjeto').form('clear');
        }
        else if(row.id_relatorio == 2) 
        {
            $('#dlgGerarInvoiceTarefasPorProjeto').dialog('open').dialog('center').dialog('setTitle','Selecione as informações');
            $('#formRelTarefasPorProjeto').form('clear');
        }
    } else {
        $.messager.alert('Atenção','Selecione um registro!','warning');
    }
}

// GERAR O RELATÓRIO POR DATA E PROJETO
function gerarPdfPorDataEProjeto() {
    $('#dlgRelDemandasPorData').dialog('close');

    var demData = $.messager.progress({
        title:'Aguarde',
        msg:'Carregando informações...'
    });

    setTimeout(function(){
        $('#formRelHistoricoPorDataEProjeto').form('submit',{
            url: '<?php base_url();?>relatorios/relPorDataEprojeto/',
            onProgress: function(percent){
                $.messager.progressbar('setValue', percent);
            },
            onSubmit: function(){
                return $(this).form('validate');
            }
        });
        $.messager.progress('close');
    },3000)
}

// GERAR O RELATÓRIO DE TAREFAS POR PROJETO
function gerarPdfTarefasPorProjeto() {
    $('#dlgGerarInvoiceTarefasPorProjeto').dialog('close');

    var demData = $.messager.progress({
        title:'Aguarde',
        msg:'Carregando informações...'
    });

    setTimeout(function(){
        $('#formRelTarefasPorProjeto').form('submit',{
            url: '<?php base_url();?>relatorios/relTarefasPorProjeto/',
            onProgress: function(percent){
                $.messager.progressbar('setValue', percent);
            },
            onSubmit: function(){
                return $(this).form('validate');
            }
        });
        $.messager.progress('close');
    },3000)
}
</script>