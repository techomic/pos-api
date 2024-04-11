<?php

namespace Vikuraa\Helpers;

use DI\Container;
use Dompdf\Dompdf;

class DomPdfCreator
{
    private Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function createPdf(string $html, string $fileName)
    {
        $dompdf = new Dompdf([
            "isRemoteEnabled" => TRUE,
            "isPhpEnabled" => TRUE
        ]);

        $dompdf->loadHtml(str_replace(["\n", "\r"], '', $html));
        $dompdf->render();
        
        if ($fileName != '') {
            $dompdf->stream($fileName . '.pdf');
        } else {
            return $dompdf->output();
        }
    }
}