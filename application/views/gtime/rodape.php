&copy Gtime V1.0 - Por 
<a href="http://graweb.com.br/" target="_blank">GraWeb</a>
<?php 
if($this->session->userdata('tipo') != '1')
{
	echo "- Projeto: <b>".$this->session->userdata('projeto')."</b>";
}
?>