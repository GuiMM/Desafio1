<meta charset="utf-8"/>
<?php
 session_start();
 $_SESSION['matricula'] = $_POST["matricula"];
 
 $matricula = $_SESSION['matricula'];  


 if (autenticaMatricula($matricula)==0)
     echo("matricula não existe no banco");
else if (verificaStatus($matricula))
    echo("Status inativo, você não tem mais vínculo com a UFF");
    else{
    echo "<h1>Escolha uma opção de Email:</h1>";
    gerarPossibilidades($matricula);
    
}
    
function verificaStatus($mat){
    $matricula = $mat;   
    $delimitador = ',';
    $cerca = '"';
    $aluno_ativo = false;    
    // Abrir arquivo para leitura
    $f = fopen('./datasets/alunos.csv', 'r');
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
            if($registro['matricula']==$matricula)
                if(strcmp($registro['status'],"Ativo"))
                    $aluno_ativo=true;
                else
                    $aluno_ativo=false;
            //echo $registro['matricula'];echo '<br>';
        }

        fclose($f);
        return $aluno_ativo;
    }
    
    
}
function gerarPossibilidades($mat){
    $matricula = $mat;   
    $delimitador = ',';
    $cerca = '"';
    $possibilidades = Array(); 
    $nomeAluno='';
    // Abrir arquivo para leitura
    $f = fopen('./datasets/alunos.csv', 'r');
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

            // Obtendo o nome
            if($registro['matricula']==$matricula)$nomeAluno =strtolower($registro['nome']);
            
        }

        fclose($f);
        
        //gerando possibilidades
        $ultimo_Nome = substr($nomeAluno,strrpos($nomeAluno," ")+1);
        $primeiro_nome = substr($nomeAluno,0,strpos($nomeAluno," "));
        
        $possibilidades[0] = str_replace(" ", "", $nomeAluno)."@id.uff.br";
        $possibilidades[1] = "uffmail@id.uff.br";                                   //testando apenas os emails que ja foram usados.
        $possibilidades[2] = $primeiro_nome.substr($ultimo_Nome,0,3)."@id.uff.br";
        $possibilidades[3] = str_replace(" ", "_", $nomeAluno)."@id.uff.br";
        $possibilidades[4] = $primeiro_nome."_".$ultimo_Nome."@id.uff.br";
        $possibilidades[5] = $primeiro_nome.'.'.$ultimo_Nome."@id.uff.br";
        $possibilidades[6] = $primeiro_nome.$ultimo_Nome."@id.uff.br";
       
        
        //gerando formulário para a escolha do Email
        ?>
        <form action="form-email.php" method="post">
            <p>
        <?php       
                for($index = 0; $index < count($possibilidades); $index ++){

             if (autenticaEmail($possibilidades[$index])==0){
                                                           
                 echo '<input type="radio" name="opcoesEmail" value="'.$possibilidades[$index].'"/>'.$possibilidades[$index].'<br>';
             }
         }
        ?>        
            </p>
            <p>
                <input type="submit" value="Submit" />
            </p>
        </form>
     <?php    
        
    }
    
}
function autenticaEmail($mail){
    $uff_Mail = $mail;   
    $delimitador = ',';
    $cerca = '"';
    $existe_Email = false;    
    // Abrir arquivo para leitura
    $f = fopen('./datasets/alunos.csv', 'r');
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

            // Obtendo o uffmail
            if($registro['uffmail']==$uff_Mail){$existe_Email=true; break;}
            
        }

        fclose($f);
        return $existe_Email;
    }
    
    
}
function autenticaMatricula($mat){
    $matricula = $mat;   
    $delimitador = ',';
    $cerca = '"';
    $existe_Aluno = false;    
    // Abrir arquivo para leitura
    $f = fopen('./datasets/alunos.csv', 'r');
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
            if($registro['matricula']==$matricula)$existe_Aluno=true;
            //echo $registro['matricula'];echo '<br>';
        }

        fclose($f);
        return $existe_Aluno;
    }
    
    
}
?>     