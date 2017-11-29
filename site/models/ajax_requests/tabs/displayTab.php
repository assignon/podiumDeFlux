<?php

    //require "../pdo_connection.php";
  //  require "../tcpdf/tcpdf.php";

    $pdo = new PDO("mysql:host=localhost;dbname=vrijwilliger",'root','');//localhost
    //$pdo = new PDO("mysql:host=localhost;dbname=deb33439n4_vrijwilligers",'deb33439n4_vrijwilligers','podiumwilligers');//podium.nl
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //$pdo = pdo();

    if(isset($_GET['pdf_name']) AND $_GET['pdf_name'] != "")
    {

        $currentPdf = htmlentities(htmlspecialchars($_GET['pdf_name']));

        $getCurrentPdf_file = $pdo->prepare("SELECT pdf_file FROM pdfs WHERE pdf_name=?");
        $getCurrentPdf_file->execute(array($currentPdf));
        $displayPdf = $getCurrentPdf_file->fetch();

        $pdf_file = '../vrijwilliger/public/media/pdfs/'.$displayPdf['pdf_file'];
        header('Content-type: application/pdf');
        header('Content-Disposition: inline; filename="'.$pdf_file.'"');
        header('Content-Transfer-Encoding: binary');
        header('Accept-Ranges: bytes');
        @readfile($pdf_file);


    }else{



    }



    //$content = "<p>". $displayTab_content['tab_content']."</p>";

    //$pdf->writeHTML($content);
  //  $pdf->Output("sample.pdf","I");

  /*  $pdf = new TCPDF('p', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF_8', false);
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetTitle("pdf");
    $pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
    $pdf->SetDefaultMonospacedFont('helvetica');
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    $pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);
    $pdf->setPrintHeader(true);
    $pdf->SetAutoPageBreak(TRUE, 10);
    $pdf->SetFont('helvetica', '', 12);*/



 ?>
