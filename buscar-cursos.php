#!/usr/bin/env php
<?php

require 'vendor/autoload.php';
#require 'src/Buscador.php'; # como não é uma classe que faz parte do composer (não vai ser carregada pelo autoload), tem que explicitamente carregar


use Alura\BuscadorDeCursos\Buscador;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

# para resolver o erro de certificado
# https://cursos.alura.com.br/forum/topico-curl-error-60-ssl-certificate-problem-85798
$client = new Client([
    'base_uri' => 'https://www.alura.com.br/',
    'verify' => false
]);

$crawler = new Crawler();


$buscador = new Buscador($client, $crawler);
$cursos = $buscador->buscar('/cursos-online-programacao/php');

foreach ($cursos as $curso) {
    exibeMensagem($curso);
}