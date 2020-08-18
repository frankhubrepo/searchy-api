<?php
class SearchClient {

    public static function searchTerm($endpoint, $params) {
        $url = $endpoint . '?' . http_build_query($params);

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($curl);
        $isSuccesfulResponse = curl_errno($curl) == 0;
        curl_close($curl);

        if ($isSuccesfulResponse) return self::parseResponse($result, "Name");

        return "No se pudo recuperar ningun resultado de " . $endpoint;
    }

    private static function parseResponse($response, $xmlTag) {
        if (substr($response, 0, 5) == "<?xml") {
            return self::parseXML($response, $xmlTag);
        } else {
            return json_decode($response, true);
        }
    }

    private static function parseXML($response, $tag) {
        $doc = new DOMDocument('1.0', 'utf-8');
        $doc->loadXML($response);
        $XMLresults = $doc->getElementsByTagName($tag);

        if ($XMLresults->length != 0) {
            $output = $XMLresults->item(0)->nodeValue;
        } else {
            $output = null;
        }

        return $output;
    }

}
?>