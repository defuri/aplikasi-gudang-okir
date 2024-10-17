<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;

class ngetes extends Controller
{
    public function index()
    {
        // Create an instance of Dompdf
        $dompdf = new Dompdf();

        // Preload the compiled Tailwind CSS
        $tailwindCss = file_get_contents(public_path('css/tailwind-pdf.css'));

        // Get the image and convert to base64
        $imagePath = public_path('img/logo.webp');
        $imageData = base64_encode(file_get_contents($imagePath));
        $imageBase64 = 'data:image/webp;base64,' . $imageData;

        // Define your HTML with inlined Tailwind styles and base64 encoded image
        $html = '
        <html>
            <head>
                <style>' . $tailwindCss . '</style>
            </head>
            <body class="bg-gray-100 text-gray-900">
                <div class="container mx-auto p-4">
                    <h1 class="text-3xl font-bold text-center">Hello, World with Tailwind CSS!</h1>
                    <p class="mt-4 text-lg">This is a sample PDF generated using Tailwind CSS and Dompdf.</p>
                    <img src="' . $imageBase64 . '" alt="Logo" style="max-width: 150px;">
                </div>
            </body>
        </html>';

        // Load the HTML content
        $dompdf->loadHtml($html);

        // Set the paper size to A4 and the orientation to landscape
        $dompdf->setPaper('A4', 'landscape');  // 'portrait' is the default

        // Render the HTML as PDF
        $dompdf->render();

        // Stream the generated PDF
        return $dompdf->stream('document.pdf', ['Attachment' => 0]);
    }
}
