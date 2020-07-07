<?php

function getListaPdfs($directory){
    $lista=scandir($directory);
    $pdfs=[];
    foreach($lista as $file):
        $extension=pathinfo($file,PATHINFO_EXTENSION);
        if(strtolower($extension) =="pdf"):
            $pdfs[]=pathinfo($file,PATHINFO_FILENAME);
        endif;
    endforeach;
    return $pdfs;
}

function comparaPdfWithEfetivo($fileEfetivo,$directoryPdf,$atributoComparador){
    $pdfs= getListaPdfs($directoryPdf);
    $json= json_decode(file_get_contents($fileEfetivo));
    $lista=[];
    foreach($pdfs as $pdf):
        if(filter($pdf, $json, $atributoComparador)){
            $lista['encontrados'][]=$pdf;
        }
        else{
            $lista['notFounds'][]=$pdf;
        }
    endforeach;
    return $lista;
}

function copyNotFounds($resultCompare, $folderFrom,$folderTo){
    foreach($resultCompare['notFounds'] as $file):
        $filePathFrom= "{$folderFrom}/{$file}.pdf";
        $filePathTo= "{$folderTo}/{$file}.pdf";
        copy($filePathFrom, $filePathTo);

    endforeach;
}

function filter($pdf, $json, $atributo){
   $result= array_filter($json, function($pessoa) use($pdf,$atributo){
        return $pessoa->{$atributo}==$pdf;
    });
    return $result;
}
$resultCompare=comparaPdfWithEfetivo("efetivo.json","laudos","saram");
print_r($resultCompare);
copyNotFounds($resultCompare, "laudos", "laudosNotFound");


