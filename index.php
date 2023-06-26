// İstek parametrelerini almak için kullanılabilir
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

// İstek parametrelerine göre işlem yapma
if (!empty($keyword)) {
    $controller = new ProductController();
    $controller->search($keyword);
}
