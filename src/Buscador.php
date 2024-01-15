<?php 

namespace Alura\BuscadorDeCursos;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Symfony\Component\DomCrawler\Crawler;

class Buscador
{

    private $httpClient;
    private $crawler;

    public function __construct(ClientInterface $httpClient, Crawler $crawler) // Iremos passar ao nosso construtor um argumento do tipo ClientInterface, do pacote que baixamos, e um outro argumento do tipo Crawler de outro pacote que baixamos. Um para fazermos a requisição, e o outro para pegarmos o DOM desse link. 
    {
        $this->httpClient = $httpClient;
        $this->crawler = $crawler;
    }

    public function buscar(string $url):array // Iremos fazer esse método para buscar os dados da requisação e os retorna-los. 
    {
        $resposta = $this->httpClient->request("GET", $url); // Aqui nós chamamos o método request() da classe que estanciamos (passada no construtor), passando como argumento o tipo da requisição, que é GET para pegarmos as informações, e em seguida o segundo argumento que é a $url que passamos por argumento/parâmetro.

        $html = $resposta->getBody(); // Aqui estamos pegando o conteudo HTML da request, usando o método getBody() e armazenando isso em uma variável $html. 

        $this->crawler->addHtmlContent($html); // Aqui estamos chamando o método addHtmlContent,da classe Crawler que estanciamos (passada no construtor) e como argumento do método passamos nosso html.

        $elementosCursos = $this->crawler->filter("span.card-curso__nome"); // Aqui estamos chamando o método filter() da classe crawler e passando como argumento a propriedade css que vai ser referencia para pegar os dados em html. Ou seja, iremos pegar todos os elementos que tiverem um span com a classe ".card-curso__nome" nesse html.

        $cursos = []; // Aqui criamos um aray $cursos;

        // Agora fazemos um foreach nos $elementosCursos e atribuímos cada elemento para nossa array $cursos. Usamos o textContent, pois como ela vem como html, precisamos usar o textContent para podermos exibir e armazena-las como string.
        foreach($elementosCursos as $elementoCurso){
            $cursos[] = $elementoCurso->textContent;
        }

        return $cursos; // Aqui retornamos nosso array. 
    }
}