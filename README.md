# Dicio
Este projeto, tem o objetivo de ser um **leitor não oficial**, do site [Dicio](https://www.dicio.com.br/) o qual é uma versão online de um **Dicionário** da língua portuguesa;
 
---- 
Este projeto foi inspirado, em outro projeto muito semelhante: [Dicio em Python](https://github.com/felipemfp/dicio)

## Instalação

Instale o pacote via composer:

```
composer require arthurtavares/dicio-php
```

## Como usar
```php
    $dicio = new \ArthurTavaresDev\Dicio\Dicio;
    // Objeto com os dados de "significado, etimologia, sinônimos, exemplos e dados extras"
    $word = $dicio->search('casa'); 

    // Significado
    $meaning = $word->meaning;
    /**
    Resposta: 
        Array
        (
            [0] => Pessoas que habitam o mesmo lugar; reunião dos indivíduos que compõem uma família; lar: a casa dos brasileiros.
            [1] => Reunião das propriedades de uma família ou dos assuntos familiares e domésticos: ele cuida da administração da casa.
            [2] => Local usado para encontros, reuniões; habitação de determinado grupos com interesses em comum: casa dos professores.
            [3] => Designação de algumas repartições ou organizações públicas ou das pessoas subordinadas ao chefe do Estado: casa da moeda; Casa Civil.
            [4] => [Ludologia] As divisões que, separadas por quadrados em branco ou preto, compõe um tabuleiro de xadrez ou de damas.
            [5] => Em costura, fenda usada para pregar botões.
            [6] => [Matemática] Cada dez anos na vida de alguém: ele está na casa dos 20.
            [7] => [Marinha] Fenda ou buraco através do qual algo é instalado a bordo; cada fenda leva o nome do objeto instalado.
        )
    **/
    
    // Etimologia
    $etymology = $word->etymology;
    /* Resposta: A palavra casa deriva do latim "casa,ae", com o sentido de cabana. */


    // Lista de Sinônimos (array)
    $synonyms = $word->synonyms;  
    /**
        Resposta:
        Array
        (
            [0] => mansão
            [1] => morada
            [2] => lar
            [3] => moradia
            [4] => vivenda
            [5] => habitação
            [6] => residência
            [7] => cabana
        )
    **/
        
    // Exemplos
    $examples = $word->examples;
    /**
        Resposta:
        Array
        (
            [0] => Os homens que procuram a felicidade são como os embriagados que não conseguem encontrar a própria casa, apesar de saberem que a têm. - Voltaire
            [1] => A verdadeira arte de viajar... A gente sempre deve sair à rua como quem foge de casa, Como se estivessem abertos diante de nós todos os caminhos do mundo. Não importa que os compromissos, as obrigações, estejam ali... Chegamos de muito longe, de alma aberta e o coração cantando! - Mário Quintana
            [2] => Um porta-voz da polícia afirmou que o pai estava em casa no momento do disparo e que a arma estava aparentemente em local pouco seguro dentro da residência. Folha de S.Paulo, 25/07/2009
            [3] => Além de eventos relacionados a café, a casa serve guloseimas como o minitartelette de maçã, omeletes e sanduíches, além de petisquinhos como a porção de tapioquinhas e a empadinha à carioca. Folha de S.Paulo, 25/07/2009
            [4] => Ontem, os ministérios da Saúde e da Educação recomendaram que os alunos que apresentarem os sintomas da gripe suína procurem um médico de confiança e, dependendo da orientação, fiquem em casa. Folha de S.Paulo, 25/07/2009
        )
    **/

   // Url
    $url = $word->url;
    /* Resultado: http://www.dicio.com.br/casa */

```
