<?php

function convertCsvToJson($fileCsv)
{

    $array = array_map('str_getcsv', file($fileCsv));
    array_walk($array, function (&$a) use ($array) {
        $a = array_combine($array[0], $a);
    });
    array_shift($array); # remove column header

    $json = json_encode($array);
    return $json;
}

function gravarLog(array $dados)
{
    $dados['dataHora'] = date('Y-m-d H:i:s');
    // abre o arquivo .txt em modo escrita
    $file = fopen('./log.txt', 'w');
    // escreve o conteúdo do array no arquivo .txt
    fwrite($file, print_r($dados, true));
}

function getLista()
{
    require 'config.php'; //importar a variavel config
    $arquivoJson = convertCsvToJson($config['file']);
    //retorno de array de objetos do csv
    return json_decode($arquivoJson);
}

function getNomeArquivo($pessoa)
{
    require 'config.php'; //importar a variavel config
    $fileName = $config['nameColumnFile'];
    $nomeArquivo = "./";
    if ($config['diretorioFiles']) {
        $nomeArquivo .= $config['diretorioFiles'] . '/' . trim($pessoa->$fileName) . '.pdf';
    } else {
        $nomeArquivo .= trim($pessoa->$fileName) . '.pdf';
    }

    if (file_exists($nomeArquivo)) {
        return $nomeArquivo;
    } else {
        return false;
    }
}
