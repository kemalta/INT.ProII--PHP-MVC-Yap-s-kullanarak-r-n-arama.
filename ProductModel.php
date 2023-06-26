class ProductModel {
    private $accessKey = 'YOUR_AMAZON_ACCESS_KEY';
    private $secretKey = 'YOUR_AMAZON_SECRET_KEY';
    private $associateTag = 'YOUR_AMAZON_ASSOCIATE_TAG';
    
    public function searchProduct($keyword) {
        require 'vendor/autoload.php';
        
        $client = new \GuzzleHttp\Client();
        
        $params = [
            'AWSAccessKeyId' => $this->accessKey,
            'AssociateTag' => $this->associateTag,
            'Operation' => 'ItemSearch',
            'Keywords' => $keyword,
            'SearchIndex' => 'All',
            'ResponseGroup' => 'ItemAttributes,Images',
            'Sort' => 'relevance',
            'Timestamp' => gmdate('Y-m-d\TH:i:s\Z'),
        ];
        
        ksort($params);
        
        $canonicalQuery = http_build_query($params);
        $canonicalString = "GET\nwebservices.amazon.com\n/onca/xml\n$canonicalQuery";
        $signature = base64_encode(hash_hmac('sha256', $canonicalString, $this->secretKey, true));
        
        $requestUrl = 'https://webservices.amazon.com/onca/xml?' . $canonicalQuery . '&Signature=' . rawurlencode($signature);
        
        $response = $client->request('GET', $requestUrl);
        
        $xml = simplexml_load_string($response->getBody()->getContents());
        
        $results = [];
        
        foreach ($xml->Items->Item as $item) {
            $title = (string)$item->ItemAttributes->Title;
            $price = (string)$item->ItemAttributes->ListPrice->FormattedPrice;
            $imageUrl = (string)$item->LargeImage->URL;
            
            $results[] = [
                'title' => $title,
                'price' => $price,
                'imageUrl' => $imageUrl,
            ];
        }
        
        return $results;
    }
}
