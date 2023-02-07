<?php 

$nameTable = $_POST['nameTable'];
$fileTmpName = $_FILES['file']['tmp_name'];       // PEGA O LOCAL DO ARQUIVO
$fileType = $_FILES['file']['type'];             // PEGA A EXTENSÃO DO ARQUIVO

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
