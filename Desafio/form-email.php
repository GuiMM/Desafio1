<meta charset="utf-8"/>
<?php
session_start();
$opcoesEmail = $_POST["opcoesEmail"];
//atualizandoEmail($_SESSION['matricula'],$opcoesEmail);
$numero = getCelular($_SESSION['matricula']);
echo "<p>A criação de seu e-mail (".$opcoesEmail.") será feita nos próximos minutos.
Um SMS foi enviado para".$numero." com a sua senha de acesso.</p>";


function getCelular($mat){
     $matricula = $mat;   
    $delimitador = ',';
    $cerca = '"';
    $existe_Aluno = false;    
    // Abrir arquivo para leitura
    $f = fopen('./datasets/alunos.csv', 'rw');
    if ($f) { 

        // Ler cabecalho do arquivo
        $cabecalho = fgetcsv($f, 0, $delimitador, $cerca);
        $i=0;
        // Enquanto nao terminar o arquivo
        while (!feof($f)) { 

            // Ler uma linha do arquivo
            $linha = fgetcsv($f, 0, $delimitador, $cerca);
            if (!$linha) {
                continue;
            }

            // Montar registro com valores indexados pelo cabecalho
            $registro = array_combine($cabecalho, $linha);

            // Obtendo a matricula
            if($registro['matricula']==$matricula){fclose($f); return $registro['telefone'];}
            //echo $registro['matricula'];echo '<br>';
        }

        fclose($f);
        
    }
    
}
//manutenção...
function atualizandoEmail($mat,$opEmail){
    $matricula = $mat;
    $opcoesEmail = $opEmail;
    $delimitador = ',';
    $cerca = '"';
    $existe_Aluno = false;    
    // Abrir arquivo para leitura
    $f = fopen('./datasets/alunos.csv', 'rw');
    if ($f) { 

        // Ler cabecalho do arquivo
        $cabecalho = fgetcsv($f, 0, $delimitador, $cerca);
        $i=0;
        // Enquanto nao terminar o arquivo
        while (!feof($f)) { 

            // Ler uma linha do arquivo
            $linha = fgetcsv($f, 0, $delimitador, $cerca);
            if (!$linha) {
                continue;
            }

            // Montar registro com valores indexados pelo cabecalho
            $registro = array_combine($cabecalho, $linha);

            // Obtendo a matricula
            if($registro['matricula']==$matricula){$registro['uffmail']=$opcoesEmail;fputcsv($f, $linha, $delimitador, $cerca);}
            
        }

        fclose($f);
        return $existe_Aluno;
    }
    
    
}

?>

