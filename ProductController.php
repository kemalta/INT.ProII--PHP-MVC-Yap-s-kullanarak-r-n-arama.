class ProductController {
    public function search($keyword) {
        $model = new ProductModel();
        $results = $model->searchProduct($keyword);
        
        // Sonuçları görüntülemek için uygun bir görünüm dosyasına yönlendirme
        include 'views/search_results.php';
    }
}
