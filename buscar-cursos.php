<?php

require_once "vendor/autoload.php";


use Alura\BuscadorDeCursos\Buscador;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

$client = new Client(["base_uri" => "https://www.alura.com.br/"]); // Aqui estanciamos a classe Client() do pacote que baixamos, e passamos um array, o primeiro elemento, a key, dizemos que vamos passar uma url base, com "base_uri", como indice desse elemento, passamos a url bas. 

$crawler = new Crawler(); // Aqui estanciamos a classe Crawler() do pacote que baixamos.

$buscador = new Buscador($client, $crawler); // Aqui estanciamos nossa classe Buscador(), e passamos como argumento o nosso Client() e nosso Crawler().

$cursos = $buscador->buscar("/cursos-online-programacao/php"); // Aqui chamamos nosso método buscar() da nossa classe Buscador(). Como argumento passamos a $url. 

// Por último estamos fazendo um foreach() em $cursos, para exibir cada elemento, note que para exibir estamos usando uma function que criamos exibiMensagem() para treinar sobre "files" no autoload, que configuramos no arquivo composer.json, e esse método basicamente recebe um argumento de string e da um echo nele.
foreach($cursos as $curso){
    exibiMensagem($curso);
}