<?php
$fileType = $_SERVER['QUERY_STRING'];

if ($fileType) {
  switch ($fileType) {
    case 'css': {
      header('Content-Type: text/css');
      echo file_get_contents(__DIR__ . '/swagger-ui.css');
      echo file_get_contents(__DIR__ . '/index.css');
      break;
    }
    case 'js': {
      header('Content-Type: text/javascript');
      echo file_get_contents(__DIR__ . '/swagger-ui-bundle.js');
      echo file_get_contents(__DIR__ . '/swagger-ui-standalone-preset.js');
      echo file_get_contents(__DIR__ . '/swagger-initializer.js');
      break;
    }
    default: echo 'File type not supported.';
  }
  exit;
}
?>

<!-- HTML for static distribution bundle build -->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Vikuraa API Documentation</title>
    <link rel="stylesheet" type="text/css" href="./index.php?css" />
    <link rel="icon" type="image/png" href="./favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="./favicon-16x16.png" sizes="16x16" />
  </head>

  <body>
    <div id="swagger-ui"></div>
    <script src="./index.php?js" charset="UTF-8"> </script>
  </body>
</html>