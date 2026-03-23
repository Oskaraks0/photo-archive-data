<?php
$baseDir = __DIR__ . "/bilder";
$manifest = [];

if (is_dir($baseDir)) {
    $folders = array_filter(glob($baseDir . '/*'), 'is_dir');
    foreach ($folders as $folder) {
        $folderName = basename($folder);
        $files = glob($folder . "/*.{jpg,jpeg,png,webp,JPG,JPEG,PNG,WEBP}", GLOB_BRACE);
        
        foreach ($files as $file) {
            $size = @getimagesize($file);
            if ($size !== false) {
                $manifest[$folderName][] = [
                    'name'  => basename($file),
                    'ratio' => $size[0] / $size[1]
                ];
            }
        }
    }
}

file_put_contents("images.json", json_encode($manifest, JSON_PRETTY_PRINT));
echo "images.json wurde erfolgreich erstellt!";
?>