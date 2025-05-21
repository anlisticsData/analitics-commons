# Http 

Helpper para recuperar as variaves do http e gerenciamento de upload 
de arquivos





# Utilizacao de Cors


Libera a Cors policy , para aplicação poder acessar


```php

<?php

use AnaliticsCommons\Http;
require_once "vendor/autoload.php";
Http::cors();





```



# Utilizacao de Upload 

```php


<?php

use AnaliticsCommons\FileUploader;
require_once "vendor/autoload.php";
 
try {
    FileUploader::setUploadDir(__DIR__ . '/uploads');       // Definir diretório
    FileUploader::setMinFileSize(2048);                     // Tamanho mínimo: 2KB

    $resultado = FileUploader::upload($_FILES['arquivo']);

    print_r($resultado);
    
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
}




**Saida 


Array ( [uuid] => a18b289a-b6c5-4dcd-9227-40735aaf7bc0 [original_name] => image.png [extension] => png )


```




# Utilizacao de recupera as Variaveis

```php


<?php

use AnaliticsCommons\Http;
require_once "vendor/autoload.php";
print_r(["<pre>",Http::all()]);



///Saida  post

Array ( [0] =>
    [1] => Array
        (
            [AA] => 2025
            [TETX] => rwdsadsa
dsa
d
sad
sa
dsa
d
sadsad
            [ARQUIVO] => Array
                (
                    [name] => image.png
                    [full_path] => image.png
                    [type] => image/png
                    [tmp_name] => /tmp/phpEBp213
                    [error] => 0
                    [size] => 62428
                )

            [FILES] => Array
                (
                    [name] => Primeiro Contato com Lógica de Programação e Algoritmos_ Notas de Aula - Marco Aurelio Thompson.pdf
                    [full_path] => Primeiro Contato com Lógica de Programação e Algoritmos_ Notas de Aula - Marco Aurelio Thompson.pdf
                    [type] => application/pdf
                    [tmp_name] => /tmp/phphWCCJi
                    [error] => 0
                    [size] => 1075254
                )

            [ARQUIVO2] => Array
                (
                    [name] => logo.svg
                    [full_path] => logo.svg
                    [type] => image/svg+xml
                    [tmp_name] => /tmp/phpmx02wm
                    [error] => 0
                    [size] => 15039
                )

            [HTTP_HOST] => localhost:8245
            [HTTP_BANANA] => 11125
            [CONTENT_TYPE] => multipart/form-data; boundary=X-INSOMNIA-BOUNDARY
            [HTTP_USER_AGENT] => insomnia/11.1.0
            [HTTP_ACCEPT] => 
            [CONTENT_LENGTH] => 1153393
            [PATH] => /usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin
            [SERVER_SIGNATURE] => 
Apache/2.4.62 (Debian) Server at localhost Port 8245


            [SERVER_SOFTWARE] => Apache/2.4.62 (Debian)
            [SERVER_NAME] => localhost
            [SERVER_ADDR] => 172.18.0.3
            [SERVER_PORT] => 8245
            [REMOTE_ADDR] => 172.18.0.1
            [DOCUMENT_ROOT] => /var/www/html
            [REQUEST_SCHEME] => http
            [CONTEXT_PREFIX] => 
            [CONTEXT_DOCUMENT_ROOT] => /var/www/html
            [SERVER_ADMIN] => webmaster@localhost
            [SCRIPT_FILENAME] => /var/www/html/analitics-commons/index.php
            [REMOTE_PORT] => 52670
            [GATEWAY_INTERFACE] => CGI/1.1
            [SERVER_PROTOCOL] => HTTP/1.1
            [REQUEST_METHOD] => POST
            [QUERY_STRING] => 
            [REQUEST_URI] => /analitics-commons/index.php
            [SCRIPT_NAME] => /analitics-commons/index.php
            [PHP_SELF] => /analitics-commons/index.php
            [REQUEST_TIME_FLOAT] => 1747788286.7553
            [REQUEST_TIME] => 1747788286
            [ARGV] => Array
                (
                )

            [ARGC] => 0
            [HOST] => localhost:8245
            [BANANA] => 11125
            [CONTENT-TYPE] => multipart/form-data; boundary=X-INSOMNIA-BOUNDARY
            [USER-AGENT] => insomnia/11.1.0
            [ACCEPT] => */*
            [CONTENT-LENGTH] => 1153393
        )

)



```
