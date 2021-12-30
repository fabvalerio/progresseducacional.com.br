<?php
	/*Adicionar {{NOME}}*/
	function NameInclude($name){
		return strtolower('{{'.$name.'}}');
	}

	/*Adicionar {{NOME}} e remover extensão*/
	function NameIncludeDir($name){
		return strtolower('{{'.substr($name, 0, 4).'}}');
	}

?>