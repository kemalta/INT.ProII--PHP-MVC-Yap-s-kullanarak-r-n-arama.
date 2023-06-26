<!DOCTYPE html>
<html>
<head>
    <title>Product Search Results</title>
    <style>
        .product {
            display: flex;
            margin-bottom: 20px;
        }
        
        .product img {
            width: 100px;
            height: 100px;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <h1>Product Search Results</h1>
    
    <?php if (!empty($results)): ?>
        <?php foreach ($results as $product): ?>
            <div class="product">
                <img src="<?php echo $product['imageUrl']; ?>" alt="<?php echo $product['title']; ?>">
                <div>
                    <h2><?php echo $product['title']; ?></h2>
                    <p><?php echo $product['price']; ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No products found.</p>
    <?php endif; ?>
</body>
</html>
