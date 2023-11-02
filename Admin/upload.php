<?php
// require 'vendor/autoload.php'; // Carrega o SDK da AWS
require __DIR__ . '/../vendor/autoload.php';
require_once "layouts/config.php";

use Aws\S3\S3Client;
use Aws\Exception\AwsException;

session_start();
$empresa = $_SESSION['empresa_selecionada'];
$projeto = $_SESSION['projeto_selecionado'];
$id_user = $_SESSION["id"];


if (isset($_FILES["file"]) && $_FILES["file"]["error"] === UPLOAD_ERR_OK) {
    $targetDir = 'uploads/';
    $nome_original = basename($_FILES["file"]["name"]);
    $nome_sem_espaco = str_replace(' ', '_', $nome_original);
    $nome_modificado = $empresa . '_' . $projeto . '_' . $nome_sem_espaco;
    $targetFile = $targetDir . $nome_modificado;
    $url = 'https://mosynicria.s3.amazonaws.com/' . $nome_modificado;

    // Move o arquivo para a pasta 'uploads'
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) { // A função move_uploaded_file() é usada para mover um arquivo enviado (temporariamente armazenado em $_FILES["file"]["tmp_name"]) para o destino especificado em $targetFile.
        echo "Arquivo enviado e movido para 'uploads/' com sucesso.";

        // Agora, vamos carregar o arquivo para a AWS aqui...
        $bucketName = 'mosynicria';
        $targetFile = 'uploads/' . $nome_modificado; // Caminho completo do arquivo no servidor local

        // Configura as credenciais e a região do seu bucket na AWS
        $credentials = new Aws\Credentials\Credentials('AKIA2FECAGS3MXKEHIMS', 'hqAk5eQdMqm4MnSRfH/k6TAlXSRuzUPBvQCAR1MB');
        $region = 'us-east-1'; // Substitua pela região correta

        // Cria uma instância do cliente S3 usando as credenciais e a região
        $s3Client = new S3Client([
            'version' => 'latest',
            'region'  => $region,
            'credentials' => $credentials
        ]);

        try {
            // Faz o upload do arquivo para o bucket na AWS
            $result = $s3Client->putObject([
                'Bucket' => $bucketName,
                'Key'    => basename($targetFile),
                'SourceFile' => $targetFile
            ]);

            // Verifica se o upload foi bem-sucedido
            if ($result['@metadata']['statusCode'] === 200) {
                $uploadParaAWSComSucesso = true; // Defina como verdadeiro se o upload for bem-sucedido
                echo "Arquivo carregado com sucesso.";
            } else {
                echo "Ocorreu um erro no upload do arquivo.";
            }
        } catch (AwsException $e) {
            echo "Ocorreu um erro na AWS: " . $e->getMessage();
        }

        // Verificou se o upload para a AWS foi bem-sucedido
        if ($uploadParaAWSComSucesso) {
            // Exclui o arquivo da pasta 'uploads'
            if (unlink($targetFile)) {
                echo "Arquivo excluído da pasta 'uploads/' com sucesso.";
            } else {
                echo "Erro ao excluir o arquivo da pasta 'uploads/'.";
            }

            // Insere o registro do arquivo no banco de dados
            
            // Insira os dados na tabela de projetos (exemplo simples)
            $sql = "INSERT INTO minia_php.file (id_project, id_company, id_user, name, link) VALUES ('$projeto', '$empresa', '$id_user', '$nome_original', '$url')";

            // Execute a consulta SQL usando a conexão com o banco de dados
            // Certifique-se de ajustar isso de acordo com sua configuração de banco de dados
            $result = mysqli_query($link, $sql);

            // Se a consulta foi bem-sucedida, você pode retornar uma resposta de sucesso
            if ($result) {
                echo "Dados do projeto inseridos com sucesso!";
            } else {
                // Se a consulta falhou, você pode retornar uma mensagem de erro
                echo "Erro ao inserir dados do projeto: " . mysqli_error($link);
            }

            // Certifique-se de fechar a conexão com o banco de dados, se aplicável
            mysqli_close($link);

        } else {
            echo "Erro ao fazer o upload para a AWS.";
        }
    } else {
        echo "Ocorreu um erro ao mover o arquivo.";
    }
} else {
    echo "Ocorreu um erro no envio do arquivo.";
}
?>