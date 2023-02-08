<?php 

$nameTable = $_POST['nameTable'];
$fileTmpName = $_FILES['file']['tmp_name'];       // PEGA O LOCAL DO ARQUIVO
$fileType = $_FILES['file']['type'];             // PEGA A EXTENSÃO DO ARQUIVO

$columRow = $_POST['cl'];

if(!empty($columRow))
{
}   else 
{
    echo "<p class='alert alert-danger'> Selecione o número de campos de acordo com sua tabela </p>";
    return false;
}   

if(!empty($nameTable))
{
   
}   else 
{
    echo "<p class='alert alert-danger'> Adicione um nome a tabela. </p>";
    return false;
}

if(file_exists($fileTmpName))                   // VERIFICA SE O ARQUIVO EXISTE
{
    if($fileType == "text/csv")                // PEGA A EXTENSÃO DO ARQUIVO E VERIFICA SE É PERMITIDA
    {
        $csv = file($fileTmpName);            // ABRE O ARQUVO E O INTERA EM UM ARRAY    
        $csvsKey[] = $csv[0];                // CAPTURA O CABEÇALHO DO ARRAY E PASSA-O PARA UM ARRAY SECUNDÁRIO
        unset($csv[0]);                     // EXPLODE O CABEÇALHO DO ARRAY PRINCIPAL
        
        echo "<p class='alert alert-success'> Upload realizado com sucesso! </p>";

        $lineOne = 0;
        if($columRow == 1)
        {
            foreach ( $csvsKey as $keys ) 
            {
                foreach($csv as $key=>$value)
                {
                    $myNumbersExploded = explode(",", $value);
                    $myNumbersWithNewCaracter = array_map(function($v){ return "'".$v."'"; }, $myNumbersExploded);
                    $myNumbers = implode(",", $myNumbersWithNewCaracter);
                    echo "INSERT INTO $nameTable (id, $keys) VALUES ($key, $myNumbers);"."<br>";
                    if (++$lineOne == 1) break;
                }
                
            }
        }

        if($columRow == 2)
        {
            $keys = implode(",", $csvsKey);          // CONVERTE ARRAY EM STRING
            echo "INSERT INTO $nameTable( id, $keys ) VALUES"."<br>";

            foreach($csv as $key=>$value)
            {
                $myNumbersExploded = explode(",", $value);
                $myNumbersWithNewCaracter = array_map(function($v){ return "'".$v."'"; }, $myNumbersExploded);
                $myNumbers = implode(",", $myNumbersWithNewCaracter);
                echo "($key, $myNumbers),"."<br>";
            }
        }

        if($columRow == 3)
        {
             foreach($csvsKey as $keys)
            {
                foreach($csv as $key=>$value)
                {
                    $myNumbersExploded = explode(",", $value);
                    $myNumbersWithNewCaracter = array_map(function($v){ return "'".$v."'"; }, $myNumbersExploded);
                    $myNumbers = implode(",", $myNumbersWithNewCaracter);
                    echo "INSERT INTO $nameTable (id, $keys) VALUES ($key, $myNumbers);"."<br>";
                }
            }
        }

    }   else 
    {
        echo "<p class='alert alert-danger'> Extensão não permitida. </p>";
        return false;
        die();
    }

}   else 
{
    echo "<p class='alert alert-danger'> Arquivo não existe </p>";
    return false;
    die();
}
