<?php

namespace AnaliticsCommons;

class FileUploader
{
    private function __clone() {}
    private function __construct() {}
    
    // Extensões permitidas
    private static array $allowedExtensions = ['jpg', 'jpeg', 'png', 'pdf', 'docx', 'xlsx','svg'];

    // Diretório padrão de upload
    private static string $uploadDir = __DIR__ . '/../uploads/';

    // Tamanho mínimo permitido em bytes (ex: 1KB = 1024 bytes)
    private static int $minFileSize = 1024; // 1KB

    public static function setUploadDir(string $path): void
    {
        self::$uploadDir = rtrim($path, '/') . '/';
    }

    public static function setMinFileSize(int $bytes): void
    {
        self::$minFileSize = $bytes;
    }

    public static function upload(array $file): array
    {
        try {
            if (!isset($file['tmp_name'], $file['name'], $file['error'], $file['size'])) {
                throw new \RuntimeException('Formato de upload inválido.');
            }

            if ($file['error'] !== UPLOAD_ERR_OK) {
                throw new \RuntimeException(self::codeToMessage($file['error']));
            }

            if ($file['size'] < self::$minFileSize) {
                throw new \RuntimeException("O arquivo é muito pequeno. Tamanho mínimo: " . self::$minFileSize . " bytes.");
            }

            $originalName = $file['name'];
            $extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

            if (!in_array($extension, self::$allowedExtensions)) {
                throw new \RuntimeException("Tipo de arquivo não permitido: .$extension");
            }

            // Geração de UUID v4
            $uuid = self::generateUuid();

            if (!is_dir(self::$uploadDir) && !mkdir(self::$uploadDir, 0755, true)) {
                throw new \RuntimeException('Falha ao criar diretório de upload.');
            }

            $newFileName = $uuid . '.' . $extension;
            $destination = self::$uploadDir . $newFileName;

            if (!move_uploaded_file($file['tmp_name'], $destination)) {
                throw new \RuntimeException('Falha ao mover o arquivo enviado.');
            }

            return [
                'uuid' => $uuid,
                'original_name' => $originalName,
                'extension' => $extension,
            ];
        } catch (\Throwable $e) {
            // Aqui você pode registrar log de erro, se necessário
            throw new \Exception("Erro no upload: " . $e->getMessage());
        }
    }

    private static function generateUuid(): string
    {
        $data = random_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

    private static function codeToMessage(int $code): string
    {
        return match ($code) {
            UPLOAD_ERR_INI_SIZE => 'O arquivo excede o tamanho máximo permitido pelo PHP.',
            UPLOAD_ERR_FORM_SIZE => 'O arquivo excede o tamanho máximo permitido pelo formulário.',
            UPLOAD_ERR_PARTIAL => 'O upload do arquivo foi feito parcialmente.',
            UPLOAD_ERR_NO_FILE => 'Nenhum arquivo foi enviado.',
            UPLOAD_ERR_NO_TMP_DIR => 'Pasta temporária ausente.',
            UPLOAD_ERR_CANT_WRITE => 'Falha ao escrever o arquivo em disco.',
            UPLOAD_ERR_EXTENSION => 'Uma extensão do PHP interrompeu o upload.',
            default => 'Erro desconhecido no upload.',
        };
    }
}
