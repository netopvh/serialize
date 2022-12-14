# Response Serialize

Package para gerar retorno serializado para a api endpoint

## Como instalar

para instalar execute o comando abaixo no seu terminal

```bash
  composer require netopvh/serializer
```

Após a instalação basta fazer o publish no provider

```bash
  php artisan vendor:publish --provider "NetoPvh\ResponseSerialize\ResponseSerializerServiceProvider"
```

Para gerar uim novo arquivo de serializaçao, basta executar o comando abaixo

```bash
  php artisan make:serialize Arquivo
```
