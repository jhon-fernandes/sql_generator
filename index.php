<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>CSV => Dump SQL</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1> Gerador CSV para Dump SQL </h1>
                <hr>
                <strong> Forma de usar: </strong>
                <ul>
                    <li> Único Insert      - Se seu arquivo possue um cabeçalho e uma linha selecione a primeira opção. </li>
                    <li> Multiplos Inserts - Se seu arquivo possue um cabeçalho e mais de uma linha selecione a segunda opção. </li>
                    <li> Caso queira apenas ver os códigos SQL selecione a terceira opção. </li>
                </ul>
               <span> OBS: Ao selecionar a segunda opção a última linha no final a vírgula deverá ser substituída por ; </span>
                <form id="formUpload" method="post" enctype="multipart/form-data" class="form">
                    <label> 
                        <strong> Arquivo: </strong> 
                    </label> <br>
                    <input type="file" name="file">
                    <br>
                    <label> 
                        <strong> Tabela: </strong> 
                    </label>
                    <input type="text" class="form-control in" name="nameTable">
                    <br>
                    <label> 
                        <strong> Selecione de acordo com seu arquivo: </strong> 
                    </label>
                    <br>
                    <select name="cl" class="form-control">
                        <option hidden value=""> </option>
                        <option value="1"> Único Insert - 1 Coluna (Cabeçalho) e 1 Linha </option>
                        <option value="2"> Múltiplos Inserts - 1 Coluna (Cabeçalho) e + de 1 Linha </option>
                        <option value="3"> Deseja ver código de vários inserts ? </option>
                    </select>
                    <br>
                    <button type="submit" class="btn btn-primary btn-enviar"> 
                        <span class="btn-enviar-txt"> Enviar </span>
                        </button>
                </form>
                <br>
                <div class="result"></div>
                <br>
                <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
                <script>
             
                    $(".btn-enviar").on("click", function(e)
                    {                                         // FORMDATA API DO HTML5
                        e.preventDefault();                   // EVITA DE CARREGAR
                        var form = $('form')[0];              // CAPTURA ELEMENTOS DO FORMULÁRIO
                        var formData = new FormData(form);    // CRIA O ELEMENTO

                        $.ajax({
                            url: 'generator.php',
                            type: 'post',
                            data: formData,
                            processData: false,
                            contentType: false,
                            beforeSend: function()
                            {

                                $(".btn-enviar-txt").html(" ... ");
                                $(".btn-enviar").attr("disabled", "disabled");
                            },  
                            success: function(data)
                            {
                                $(".btn-enviar-txt").html("Enviar");
                                $(".btn-enviar").removeAttr("disabled", "disabled");
                                $(".result").html(data);
                                
                            }
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</body>
</html>