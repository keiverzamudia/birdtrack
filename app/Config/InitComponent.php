<?php
if (!defined('_URL_')) {
    die('Error: URL constant is not defined. Please load ConfigSystem.php first.');
}

// HEADER: CSS y fonts (rutas correctas, uso de Assets y link rel)
$varHeader = '<!-- Custom fonts for this template -->' . PHP_EOL
    . '<link href="' . _URL_ . 'Assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">' . PHP_EOL
    . '<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">' . PHP_EOL
    // DataTables CSS (bootstrap integration)
    . '<link href="' . _URL_ . 'Assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">' . PHP_EOL
    // Template CSS
    . '<link href="' . _URL_ . 'Assets/css/sb-admin-2.min.css" rel="stylesheet" type="text/css">' . PHP_EOL;

// JS: jQuery primero, luego Bootstrap, plugins y scripts del template
$varJs = '<!-- jQuery (debe ir primero) -->' . PHP_EOL
    . '<script src="' . _URL_ . 'Assets/vendor/jquery/jquery.min.js"></script>' . PHP_EOL
    // Bootstrap bundle (incluye Popper)
    . '<script src="' . _URL_ . 'Assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>' . PHP_EOL
    // jQuery Easing (plugin usado por el template)
    . '<script src="' . _URL_ . 'Assets/vendor/jquery-easing/jquery.easing.min.js"></script>' . PHP_EOL
    // DataTables (jQuery plugin) y su integración con Bootstrap 4
    . '<script src="' . _URL_ . 'Assets/vendor/datatables/jquery.dataTables.min.js"></script>' . PHP_EOL
    . '<script src="' . _URL_ . 'Assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>' . PHP_EOL
    // Core script del template
    . '<script src="' . _URL_ . 'Assets/js/sb-admin-2.min.js"></script>' . PHP_EOL
    // Chart.js (si se usa)
    . '<script src="' . _URL_ . 'Assets/vendor/chart.js/Chart.min.js"></script>' . PHP_EOL
    // Demos / page-level scripts (opcionales)
    . '<script src="' . _URL_ . 'Assets/js/demo/chart-area-demo.js"></script>' . PHP_EOL
    . '<script src="' . _URL_ . 'Assets/js/demo/chart-pie-demo.js"></script>' . PHP_EOL;

?>