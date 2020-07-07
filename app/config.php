<?php

$config=[
/*
configurações de email
*/

//host: Servidor do zimbra ao qual a aplicação vai conectar
"host"=>"191.6.165.167",
"port"=>587,
//username: Usuário do zimbra ao qual a aplicação usará para disparar emails
"username"=>"fulano@fab.mil.br",
//password: Senha do Usuário zimbra ao aplicação usará para dispara emails
"password"=>"senha",
//fromMail: Email do Usuário remetente
"fromMail"=>"fulano@fab.mil.br",
//fromName: Nome do Usuário remetente
"fromName"=>"Fulano Santos",
//subject: Assunto do Email
"subject"=>"Assunto",
//body: Corpo do Email. Pode se utilizar formatação html
"body"=>"Corpo do Email",
//altBody: Corpo Alternativo. É utilizado somente se o html estiver bloqueado 
//pelo servidor ou por algum motivo houver falha na leitura do body.
"altBody"=>'Corpo do Email em caso de falha.',

/*
configurações de arquivo
*/

//file: arquivo CSV que contem a lista para ser enviada. É Obrigatório ter uma
//coluna chamada email
"file"=>"controle_ sites_internet.csv",
//diretorioFiles: Pasta onde estão os arquivos PDF para enviar por email. 
//Deixe em branco se estiver na raiz
"diretorioFiles"=>"" , 
//nameColumnFile: Nome da Coluna que contem os nomes dos arquivos a serem enviados.
//Na planilha não precisa colocar a extensão ".pdf".
"nameColumnFile"=>"file"


];

/**
 * Instruções para o arquivo que contém os dados:
 * 
 * 1) Ele deve estar no formato CSV. Pode-se usar Libreoffice para salvar como
 * 2) A planilha deve ter cabeçalho. No Cabeçalho deve conter "email"
 * 3) No cabeçalho deve ter Identificação do nome do arquivo. Não precisa colocar extensão
 * 4) Recomenda-se que o cabeçalho esteja em minúsculo, sem espaços ou caracteres especiais
 * 5) Recomenda-se colocar os arquivos pdf em uma pasta e o arquivo CSV na raiz app
 */


