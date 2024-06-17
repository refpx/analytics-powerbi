<html>
   <head>
    <title>Microsoft Power BI - API test</title>
    </head>
   <body>
<table>

<?php
// Turn off error reporting
error_reporting(0);
$ch = curl_init();
$url = 'https://api-eu.hosted.exlibrisgroup.com/almaws/v1/analytics/reports';
$queryParams = '?' . urlencode('path') . '=' . urlencode('/shared/Universidad Continental 51UCCI_INST/Reports/TSI/5. Power BI/1. Registros') . '&' . urlencode('limit') . '=' . urlencode('1000') . '&' . urlencode('apikey') . '=' . urlencode('l8xx3de7899a5e1e42fa94a78cc91f8305b1');
curl_setopt($ch, CURLOPT_URL, $url . $queryParams);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
$response = curl_exec($ch);
curl_close($ch);
/* creates xml array */
$alma_analytics_result_array = simplexml_load_string($response);
$rowset = $alma_analytics_result_array ->QueryResult->ResultXml->rowset;
function remote_file_exists($url)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    if( $httpCode == 200 ){return true;}
}
  
echo '<table>';  
  
 foreach ($rowset->Row as $row_number){
 echo '<tr><td>' . $row_number[0]->Column1 . ' </td><td>' . $row_number[0]->Column2 .'</td></tr>';
 
 }
 echo '</table>';
    
?>
  
  </body>
</html>