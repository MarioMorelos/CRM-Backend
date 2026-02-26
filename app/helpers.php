<?php

//FUNCTION CREATE CODE CONFIRMATION
function genera_token(){
    $code = "";
    $pattern = "1234567890abcdefghijklmnopqrstuvwxyz";
    $max = strlen($pattern)-1;
    for ($i=0; $i < 40; $i++) {
        $code .= $pattern[crypto_rand_secure(0, $max)];
    }
    return $code;

}
// CODE THAT HELP TO GENERATE RANDOM CHAR
function crypto_rand_secure($min, $max)
{
    $range = $max - $min;
    if ($range < 1) return $min; // not so random...
    $log = ceil(log($range, 2));
    $bytes = (int) ($log / 8) + 1; // length in bytes
    $bits = (int) $log + 1; // length in bits
    $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
    do {
        $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
        $rnd = $rnd & $filter; // discard irrelevant bits
    } while ($rnd > $range);
    return $min + $rnd;
}


function arch_adjunto($file, $file_name, $folder){
    try {
        $dir = resource_path($folder);
        if (!file_exists($dir)) {
            mkdir($dir, 0755, true);
        }
        $file_base_64 = $file;
 
        if(preg_match("/^data:(image\/\w+|application\/pdf);base64,/", $file_base_64)) {
            $file_base_64 = preg_replace("/^data:(image\/\w+|application\/pdf);base64,/", "", $file_base_64);
        }
        $file_base_64 = str_replace(' ', '+', $file_base_64);
 
        $image = base64_decode($file_base_64);
        $path = resource_path($folder . "/" . $file_name);
        file_put_contents($path, $image);
    } catch (\Throwable $th) {
        return response()->json([
            "status" => false,
            "message" => "Error en guardado temporal de archivo",
            "error" => $th->getMessage()
        ], 500);
    }
    return $file_name;
}

// function arch_adjunto($file, $file_name, $folder){
//     try {
//         $dir = resource_path($folder);
//         if (!file_exists($dir)) {
//             mkdir($dir, 0755, true);
//         }
//         $file_base_64 = $file;
//         // 1. Validar formato Data URI permitido
//         if (!preg_match("/^data:(image\/(jpg|jpeg|png)|application\/pdf);base64,/", $file_base_64, $matches)) {
//             throw new \Exception("Formato de archivo no permitido");
//         }
//         // 2. Extraer mime real del encabezado
//         $mime = $matches[1];
//         // 3. Quitar cabecera
//         $file_base_64 = preg_replace("/^data:(image\/(jpg|jpeg|png)|application\/pdf);base64,/", "", $file_base_64);
//         $file_base_64 = str_replace(' ', '+', $file_base_64);
//         // 4. Decodificar
//         $decoded = base64_decode($file_base_64, true);
//         if ($decoded === false) {
//             throw new \Exception("Base64 inválido");
//         }
//         // 5. Validar tipo REAL del archivo
//         $f = finfo_open();
//         $realMime = finfo_buffer($f, $decoded, FILEINFO_MIME_TYPE);
//         finfo_close($f);

//         $allowed = [
//             'image/jpeg',
//             'image/png',
//             'application/pdf'
//         ];

//         if (!in_array($realMime, $allowed)) {
//             throw new \Exception("El contenido del archivo no coincide con el tipo permitido");
//         }
//         // 6. Asignar extensión según mime real
//         $extension = match ($realMime) {
//             'image/jpeg'     => 'jpg',
//             'image/png'      => 'png',
//             'application/pdf'=> 'pdf',
//             default          => throw new \Exception("Extensión no válida")
//         };
//         // 7. Asegurar que el nombre tenga extensión correcta
//         if (!str_ends_with($file_name, ".$extension")) {
//             $file_name .= ".$extension";
//         }
//         // 8. Guardar archivo
//         $path = resource_path($folder . "/" . $file_name);
//         file_put_contents($path, $decoded);
//     } catch (\Throwable $th) {
//         return response()->json([
//             "status" => false,
//             "message" => "Error en guardado temporal de archivo",
//             "error" => $th->getMessage()
//         ], 500);
//     }
//     return $file_name;
// }

?>