<?php

if ( !function_exists('formated_dropdown') )
{

    /**
     * Formata os dados para a select
     *
     * @param array $content
     * @return array
     */
    function formated_dropdown(array $content)
    {
        $retorno = array();
        foreach( $content as $key => $dados ):
            $chave = (isset($dados->name)) ? $dados->id : $key;

            $retorno[$chave] = ($chave != $key) ? $dados->name : $dados->id;
        endforeach;
        return $retorno;
    }
}