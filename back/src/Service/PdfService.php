<?php

namespace App\Service;

use Dompdf\Dompdf;
use Dompdf\Options;
use Twig\Environment;
use App\Entity\Report;

class PdfService
{
    private $dompdf;
    private $twig;

    public function __construct(Dompdf $dompdf, Environment $twig)
    {
        $this->dompdf = $dompdf;
        $this->twig = $twig;
    }

    public function createPdfFromReport(Report $report): string
    {
        $htmlContent = $this->twig->render('pdf/report.html.twig', ['report' => $report]);
        $this->dompdf->loadHtml($htmlContent);
        $this->dompdf->setPaper('A4', 'portrait');
        $this->dompdf->render();
        return $this->dompdf->output();
    }
}