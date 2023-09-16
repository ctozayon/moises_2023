<?php
// require 'vendor/autoload.php'; // Carrega o SDK da AWS
require __DIR__ . '/../vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\Exception\AwsException;

// Verifica se o arquivo foi enviado com sucesso
if (isset($_FILES["file"]) && $_FILES["file"]["error"] === UPLOAD_ERR_OK) {
    $targetDir = 'uploads/';
    $targetFile = $targetDir . basename($_FILES["file"]["name"]);

    // Move o arquivo para a pasta 'uploads'
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
        echo "Arquivo enviado e movido para 'uploads/' com sucesso.";
    } else {
        echo "Ocorreu um erro ao mover o arquivo.";
    }
} else {
    echo "Ocorreu um erro no envio do arquivo.";
}

$bucketName = 'mosynicria';
$targetFile = 'uploads/' . basename($_FILES["file"]["name"]); // Caminho completo do arquivo no servidor local

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
        echo "Arquivo carregado com sucesso.";
    } else {
        echo "Ocorreu um erro no upload do arquivo.";
    }
} catch (AwsException $e) {
    echo "Ocorreu um erro na AWS: " . $e->getMessage();
}
?>

