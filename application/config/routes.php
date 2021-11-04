<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'gtime';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// ROTAS DE LAYOUT
$route['menu'] = 'gtime/menu';
$route['painel'] = 'gtime/painel';
$route['rodape'] = 'gtime/rodape';

// ROTAS DE ACESSO/SAIR DO SITEMA
$route['autenticar'] = 'gtime/autenticar';
$route['login'] = 'gtime/login';
$route['logout'] = 'gtime/sair';