![](./arquivos/geral/readme.gif)

# Estrutura de projetos sem framework com php8.2

Construir uma estrutura web e um sistema online sem depender de um framework pode ser um desafio, porém, é totalmente viável. Isso permite criar uma arquitetura personalizada, perfeitamente adaptada às suas necessidades exclusivas. A seguir, apresento uma estrutura geral que incorpora os elementos mencionados.

**Comprometo-me a criar um vídeo explicativo no futuro, detalhando o funcionamento de todo o sistema** 😅.

Peço o apoio e a contribuição neste humilde projeto.

### Tecnologias

- **PHP 8.2**
- **Mysql com PDO**
- **Jquery**
- **Bootstrap 5**
- **Composer**
- **Phpmailer**
- **Twig**
- **SimpleRouter**

### Responsável Técnico

Fabio Augusto [@gitHub](https://github.com/fabiocasadossites)

### Como baixar e usar

1. Tenha o php 8.2 ou maior instaldo.

2. _Por favor, faça um clone do repositório em sua máquina._

```
git clone https://github.com/fabiocasadossites/gruponyata_new.git
```

3. Vá na pasta app/ altere o nome do arquivo config_template.php para config.php

- As informações no arquivo **config.php** não precisam ser alteradas, a menos que você deseje configurar um banco de dados ou personalizar o envio de e-mails. Todas essas opções já estão listadas. No entanto, você pode personalizar o código JWT para torná-lo exclusivo para este projeto, se desejar.
- Os códigos **CHAVESITE** e **CHAVESECRETA** são utilizados para autenticar o reCAPTCHA do Google e garantir que você não seja considerado um robô. Quando você implantar este sistema em sua hospedagem, será necessário substituir essas chaves por novas. Você pode obtê-las no seguinte endereço: https://www.google.com/recaptcha/admin/create
  <br>

4. _Por favor, abra o seu editor de código e execute este comando na pasta do projeto para atualizá-lo e baixar as dependências necessárias do Composer._

```
composer update --ignore-platform-reqs
```

5. _Depois de seguir os passos mencionados acima para acessar o ambiente web e visualizar o projeto online, abra o terminal na pasta do projeto e insira o seguinte comando:_

```
php -S localhost:333
```

_ou_

```
composer server
```
