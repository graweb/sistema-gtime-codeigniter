<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="author" content="GraWeb Tecnologia">
<meta name="description" content="Gweb - Gestão de Serviços">
<meta name="keywords" content="Quikee, LinkedIn, Vendas, Propecção">
<title>Gtime - Gestão de Tempo</title>
<link rel="shortcut icon" href="<?php base_url()?>assets/images/favicon.ico" type="image/x-icon">
<link rel="stylesheet" type="text/css" href="<?php base_url();?>assets/jquery-easyui-1.9.15/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="<?php base_url();?>assets/jquery-easyui-1.9.15/themes/icon.css">
<link rel="stylesheet" type="text/css" href="<?php base_url();?>assets/jquery-easyui-1.9.15/demo/demo.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<div class="easyui-layout" fit="true">
	<div data-options="region:'north',border:false" style="height:42px;padding:0;">
	    <div class="easyui-panel" data-options="href:'<?php base_url();?>menu',border:false"></div>
	</div>
	<div data-options="region:'center',border:false">
        <div id="conteudo" class="easyui-tabs" fit="true">
	        <div title="Estatísticas"data-options="href:'<?php base_url();?>painel',border:false"></div>
	    </div>
	</div>
	<div data-options="region:'south',border:false" style="height:30px;padding:6px;">
        <div class="easyui-panel" data-options="href:'<?php base_url();?>rodape',border:false"></div>
    </div>
</div>

<script type="text/javascript" src="<?php base_url();?>assets/jquery-easyui-1.9.15/jquery.min.js"></script>
<script type="text/javascript" src="<?php base_url();?>assets/jquery-easyui-1.9.15/jquery.easyui.min.js"></script>
<script type="text/javascript" src="<?php base_url();?>assets/jquery-easyui-1.9.15/locale/easyui-lang-pt_BR.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script type="text/javascript">
    var index = 0;

    //ADICIONA PAINEL
    function addPanel(titulo, link)
    {
        //VERIFICA SE A TAB ESTÀ ABERTA
        if ($('#conteudo').tabs('exists',titulo))
        {
            $('#conteudo').tabs('select', titulo);
        } else {
            index++;
            $('#conteudo').tabs('add',{
                title: titulo,
                href: link,
                closable: true
            });
        }
    }

    //REMOVE O PAINEL
    function removePanel()
    {
        var tab = $('#conteudo').tabs('getSelected');
        if (tab)
        {
            var index = $('#conteudo').tabs('getTabIndex', tab);
            $('#conteudo').tabs('close', index);
        }
    }

    //SELECIONAR PROJETO
    function selecionaProjeto()
    {
        $('#dlgSelecionarProjeto').dialog('open').dialog('center').dialog('setTitle','Selecionar Projeto');
        $('#formSelecionarProjeto').form('clear');
    }

    // SALVAR PROJETO SELECIONADO
    function salvarSelecaoProjeto(){
        $('#formSelecionarProjeto').form('submit',{
            url: '<?php base_url();?>usuarios_projetos/salvarProjetoSelecionado',
            onSubmit: function(){
                return $(this).form('validate');
            },
            success: function(result){
                var result = eval('('+result+')');
                if (result.errorMsg){
                    $.messager.show({
                        title:'Erro',
                        msg:'<strong style="color:red">'+result.errorMsg+'<i class="fa fa-check fa-2x"></i>Registro armazenado com sucesso!</strong>',
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
                    $('#dlgSelecionarProjeto').dialog('close');
                    location.reload();
                }
            }
        });
    }
</script>

</body>
</html>