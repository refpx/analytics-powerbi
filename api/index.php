<html>

<head>
  <title>Analytics / Power BI</title>
</head>

<body>
  <table>

    <?php
    error_reporting(0); // Turn off error reporting

    $ch = curl_init();
    $url = 'https://api-eu.hosted.exlibrisgroup.com/almaws/v1/analytics/reports';
    $queryParams = '?' . urlencode('path') . '=' . urlencode('/Shared Folders/Universidad Continental 51UCCI_INST/Reports/TSI/5. Power BI/1. Registros') . '&' . urlencode('limit') . '=' . urlencode('1000') . '&' . urlencode('apikey') . '=' . urlencode('l8xx3de7899a5e1e42fa94a78cc91f8305b1');

    curl_setopt($ch, CURLOPT_URL, $url . $queryParams);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

    $response = curl_exec($ch);
    curl_close($ch);

    /* creates xml array */
    $alma_analytics_result_array = simplexml_load_string($response);
    $rowset = $alma_analytics_result_array->QueryResult->ResultXml->rowset;

    function remote_file_exists($url)
    {
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_NOBODY, true);
      curl_exec($ch);
      $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
      curl_close($ch);
      if ($httpCode == 200) {
        return true;
      }
    }

    // Estilos básicos para la tabla
    echo '<style>';
    echo 'table { border-collapse: collapse; width: 100%; }';
    echo 'th, td { text-align: left; padding: 8px; }';
    echo 'tr:nth-child(even) { background-color: #f2f2f2; }';
    echo 'th { background-color: #4CAF50; color: white; }';
    echo '</style>';

    echo '<table>';

    foreach ($rowset->Row as $row_number) {
      echo '<tr><td>' . $row_number[0]->Column3 . ' </td><td>' . $row_number[0]->Column2 . '</td><td>' . $row_number[0]->Column5 . ' </td><td>' . $row_number[0]->Column1 . ' </td><td>' . $row_number[0]->Column11 . ' </td><td>' . $row_number[0]->Column6 . ' </td><td>' . $row_number[0]->Column7 . ' </td><td>' . $row_number[0]->Column8 . ' </td><td>' . $row_number[0]->Column9 . ' </td><td>' . $row_number[0]->Column10 . ' </td><td>' . $row_number[0]->Column4 . ' </td><td>' . $row_number[0]->Column12 . ' </td></tr>';
    }
    echo '</table>';

    ?>

</body>

</html>