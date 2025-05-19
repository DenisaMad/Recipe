<?php
include 'crud.php'
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Management System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!-- AOS Animations -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #ff6b6b;
            --secondary-color: #4ecdc4;
            --accent-color: #ffd166;
            --dark-color: #2d3436;
            --light-color: #f8f9fa;
            --text-color: #2d3436;
            --light-gray: #e9ecef;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            color: var(--text-color);
            background-color: #f9f7f4;
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif;
        }
        
        .navbar {
            background: linear-gradient(135deg, var(--primary-color), #e53935);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 15px 0;
        }
        
        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 1.8rem;
            letter-spacing: 0.5px;
        }
        
        .nav-link {
            font-weight: 500;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            padding: 0.5rem 1rem;
            transition: all 0.3s ease;
        }
        
        .nav-link:hover {
            color: var(--accent-color) !important;
            transform: translateY(-2px);
        }
        
        .nav-link.active {
            font-weight: 600;
            color: white !important;
            border-bottom: 2px solid var(--accent-color);
        }
        
        .container {
            max-width: 1200px;
        }
        
        .page-header {
            text-align: center;
            margin-bottom: 2.5rem;
            position: relative;
            padding-bottom: 1rem;
        }
        
        .page-header:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background-color: var(--primary-color);
        }
        
        .recipe-card {
            height: 100%;
            border: none;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.07);
            transition: all 0.4s ease;
        }
        
        .recipe-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        }
        
        .recipe-card .card-img-top {
            height: 200px;
            object-fit: cover;
            transition: all 0.5s ease;
        }
        
        .recipe-card:hover .card-img-top {
            transform: scale(1.05);
        }
        
        .recipe-card .card-body {
            padding: 1.5rem;
        }
        
        .recipe-card .card-title {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
            color: var(--dark-color);
        }
        
        .favorite-btn {
            position: absolute;
            top: 15px;
            right: 15px;
            background: rgba(255,255,255,0.9);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            border: none;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            z-index: 10;
        }
        
        .favorite-btn:hover {
            transform: scale(1.1);
        }
        
        .bi-heart-fill {
            color: var(--primary-color);
        }
        
        .recipe-time {
            font-size: 0.9rem;
            color: #6c757d;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            border-radius: 50px;
            padding: 0.5rem 1.5rem;
            font-weight: 500;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background-color: #e53935;
            border-color: #e53935;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(229, 57, 53, 0.3);
        }
        
        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
            border-radius: 50px;
            padding: 0.5rem 1.5rem;
            font-weight: 500;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }
        
        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(229, 57, 53, 0.2);
        }
        
        .btn-secondary {
            background-color: #6c757d;
            border-radius: 50px;
            transition: all 0.3s ease;
        }
        
        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(108, 117, 125, 0.3);
        }
        
        .btn-sm {
            border-radius: 20px;
            padding: 0.25rem 0.7rem;
        }
        
        .alert {
            border-radius: 10px;
            padding: 1rem 1.5rem;
            border: none;
            box-shadow: 0 3px 10px rgba(0,0,0,0.05);
        }
        
        .alert-success {
            background-color: rgba(40, 167, 69, 0.1);
            color: #28a745;
        }
        
        .alert-danger {
            background-color: rgba(220, 53, 69, 0.1);
            color: #dc3545;
        }
        
        .alert-info {
            background-color: rgba(13, 202, 240, 0.1);
            color: #0dcaf0;
        }
        
        pre {
            white-space: pre-wrap;
            font-family: 'Poppins', sans-serif;
            margin-bottom: 0;
            line-height: 1.6;
        }
        
        /* View Recipe Page */
        .recipe-view-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0,0,0,0.07);
        }
        
        .recipe-view-card .card-header {
            background-color: white;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            padding: 1.5rem;
        }
        
        .recipe-view-card img {
            height: 400px;
            object-fit: cover;
        }
        
        .recipe-info-box {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.03);
        }
        
        .recipe-info-item {
            text-align: center;
            padding: 0.5rem;
        }
        
        .recipe-info-item i {
            font-size: 1.5rem;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }
        
        .recipe-info-item .label {
            font-size: 0.9rem;
            color: #6c757d;
            margin-bottom: 0.25rem;
        }
        
        .recipe-info-item .value {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--dark-color);
        }
        
        .ingredients-list, .instructions-list {
            background-color: white;
            border-radius: 10px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.03);
        }
        
        .section-title {
            position: relative;
            padding-bottom: 0.75rem;
            margin-bottom: 1.5rem;
            color: var(--dark-color);
        }
        
        .section-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background-color: var(--primary-color);
        }
        
        /* Form Styling */
        .form-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0,0,0,0.07);
        }
        
        .form-card .card-header {
            background-color: var(--primary-color);
            color: white;
            padding: 1.5rem;
            border-bottom: none;
        }
        
        .form-card .card-body {
            padding: 2rem;
        }
        
        .form-label {
            font-weight: 500;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
        }
        
        .form-control {
            border-radius: 8px;
            padding: 0.75rem 1rem;
            border: 1px solid #dee2e6;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(255, 107, 107, 0.25);
            border-color: var(--primary-color);
        }
        
        .form-text {
            color: #6c757d;
            font-size: 0.85rem;
            margin-top: 0.5rem;
        }
        
        /* Modal Styling */
        .modal-content {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 25px 50px rgba(0,0,0,0.1);
        }
        
        .modal-header {
            background-color: var(--primary-color);
            color: white;
            border-bottom: none;
            padding: 1.5rem;
        }
        
        .modal-body {
            padding: 2rem;
        }
        
        .modal-footer {
            border-top: none;
            padding: 1.5rem;
        }
        
        /* Footer */
        footer {
            background-color: var(--dark-color);
            color: white;
            padding: 2rem 0;
            margin-top: 5rem;
        }
        
        .footer-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        
        .footer-logo {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 1.8rem;
            margin-bottom: 1rem;
        }
        
        .footer-social {
            margin-bottom: 1.5rem;
        }
        
        .footer-social a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            background-color: rgba(255,255,255,0.1);
            border-radius: 50%;
            margin: 0 5px;
            color: white;
            transition: all 0.3s ease;
        }
        
        .footer-social a:hover {
            background-color: var(--primary-color);
            transform: translateY(-3px);
        }
        
        /* Animations */
        .fade-in {
            animation: fadeIn 1.5s ease-in-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .recipe-badge {
            display: inline-block;
            padding: 0.35em 0.65em;
            font-size: 0.75em;
            font-weight: 600;
            line-height: 1;
            color: #fff;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 50rem;
            background-color: var(--secondary-color);
            margin-bottom: 0.75rem;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="bi bi-book me-2"></i>Recipe Book
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link <?= $action === 'list' ? 'active' : '' ?>" href="index.php">
                            <i class="bi bi-grid me-1"></i> All Recipes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $action === 'favorites' ? 'active' : '' ?>" href="index.php?action=favorites">
                            <i class="bi bi-heart me-1"></i> Favorites
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $action === 'add' ? 'active' : '' ?>" href="index.php?action=add">
                            <i class="bi bi-plus-circle me-1"></i> Add Recipe
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show" data-aos="fade-up">
                <i class="bi bi-check-circle-fill me-2"></i><?= $_SESSION['success'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>
        
        <?php if (isset($error)): ?>
            <div class="alert alert-danger alert-dismissible fade show" data-aos="fade-up">
                <i class="bi bi-exclamation-triangle-fill me-2"></i><?= $error ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php
        // Handle different actions
        switch ($action) {
            case 'view':
                try {
                    $stmt = $db->prepare("SELECT * FROM recipes WHERE id = :id");
                    $stmt->bindParam(':id', $id);
                    $stmt->execute();
                    $recipe = $stmt->fetch(PDO::FETCH_ASSOC);
                    
                    if (!$recipe) {
                        echo '<div class="alert alert-danger">Recipe not found</div>';
                        break;
                    }
                    
                    $isFavorite = isFavorite($recipe['id']);
                } catch (PDOException $e) {
                    echo '<div class="alert alert-danger">Error: ' . $e->getMessage() . '</div>';
                    break;
                }
                ?>
                <div class="row">
                    <div class="col-lg-10 mx-auto">
                        <nav aria-label="breadcrumb" class="mb-4" data-aos="fade-up" data-aos-delay="100">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><?= htmlspecialchars($recipe['title']) ?></li>
                            </ol>
                        </nav>
                        
                        <div class="recipe-view-card mb-4" data-aos="fade-up" data-aos-delay="200">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h1 class="mb-0"><?= htmlspecialchars($recipe['title']) ?></h1>
                                <div>
                                    <form method="post" action="index.php?action=toggle_favorite" class="d-inline">
                                        <input type="hidden" name="recipe_id" value="<?= $recipe['id'] ?>">
                                        <button type="submit" class="btn btn-link p-0">
                                            <?php if ($isFavorite): ?>
                                                <i class="bi bi-heart-fill fs-4"></i>
                                            <?php else: ?>
                                                <i class="bi bi-heart fs-4"></i>
                                            <?php endif; ?>
                                        </button>
                                    </form>
                                    <a href="index.php?action=edit&id=<?= $recipe['id'] ?>" class="btn btn-primary ms-2">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <button type="button" class="btn btn-danger ms-2" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $recipe['id'] ?>">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </div>
                            </div>
                            
                            <img src="<?= htmlspecialchars($recipe['image_url']) ?>" class="card-img-top" alt="<?= htmlspecialchars($recipe['title']) ?>">
                            
                            <div class="card-body p-4">
                                <div class="recipe-info-box mb-4" data-aos="fade-up" data-aos-delay="300">
                                    <div class="row">
                                        <div class="col-md-4 recipe-info-item">
                                            <i class="bi bi-clock"></i>
                                            <div class="label">Prep Time</div>
                                            <div class="value"><?= $recipe['prep_time'] ?> min</div>
                                        </div>
                                        <div class="col-md-4 recipe-info-item">
                                            <i class="bi bi-fire"></i>
                                            <div class="label">Cook Time</div>
                                            <div class="value"><?= $recipe['cook_time'] ?> min</div>
                                        </div>
                                        <div class="col-md-4 recipe-info-item">
                                            <i class="bi bi-people"></i>
                                            <div class="label">Servings</div>
                                            <div class="value"><?= $recipe['servings'] ?></div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row" data-aos="fade-up" data-aos-delay="400">
                                    <div class="col-lg-5">
                                        <div class="ingredients-list">
                                            <h3 class="section-title">Ingredients</h3>
                                            <pre><?= htmlspecialchars($recipe['ingredients']) ?></pre>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="instructions-list">
                                            <h3 class="section-title">Instructions</h3>
                                            <pre><?= htmlspecialchars($recipe['instructions']) ?></pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card-footer text-muted py-3 d-flex justify-content-between align-items-center">
                                <div>Added on <?= date('F j, Y', strtotime($recipe['created_at'])) ?></div>
                                <a href="index.php" class="btn btn-outline-primary">
                                    <i class="bi bi-arrow-left me-1"></i> Back to All Recipes
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Delete Confirmation Modal -->
                <div class="modal fade" id="deleteModal<?= $recipe['id'] ?>" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Confirm Delete</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to delete "<?= htmlspecialchars($recipe['title']) ?>"?</p>
                                <p class="text-danger"><i class="bi bi-exclamation-triangle me-2"></i>This action cannot be undone.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <form method="post" action="index.php?action=delete&id=<?= $recipe['id'] ?>">
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                break;
                
            case 'add':
            case 'edit':
                $recipe = [
                    'id' => 0,
                    'title' => '',
                    'ingredients' => '',
                    'instructions' => '',
                    'prep_time' => 0,
                    'cook_time' => 0,
                    'servings' => 0,
                    'image_url' => 'https://placehold.co/800x600'
                ];
                
                if ($action === 'edit' && $id > 0) {
                    try {
                        $stmt = $db->prepare("SELECT * FROM recipes WHERE id = :id");
                        $stmt->bindParam(':id', $id);
                        $stmt->execute();
                        $editRecipe = $stmt->fetch(PDO::FETCH_ASSOC);
                        
                        if ($editRecipe) {
                            $recipe = $editRecipe;
                        } else {
                            echo '<div class="alert alert-danger">Recipe not found</div>';
                        }
                    } catch (PDOException $e) {
                        echo '<div class="alert alert-danger">Error: ' . $e->getMessage() . '</div>';
                    }
                }
                ?>
                <div class="row" data-aos="fade-up">
                    <div class="col-lg-8 mx-auto">
                        <div class="form-card">
                            <div class="card-header">
                                <h2 class="mb-0"><?= $action === 'add' ? 'Add New Recipe' : 'Edit Recipe' ?></h2>
                            </div>
                            <div class="card-body">
                                <form method="post" action="index.php?action=<?= $action ?><?= $action === 'edit' ? '&id=' . $id : '' ?>">
                                    <div class="mb-4">
                                        <label for="title" class="form-label">Recipe Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($recipe['title']) ?>" required>
                                        <div class="form-text">Give your recipe a descriptive name</div>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label for="image_url" class="form-label">Image URL</label>
                                        <input type="url" class="form-control" id="image_url" name="image_url" value="<?= htmlspecialchars($recipe['image_url']) ?>">
                                        <div class="form-text">Enter a URL for the recipe image (leave blank for default placeholder)</div>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col-md-4">
                                            <label for="prep_time" class="form-label">Prep Time (min)</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="bi bi-clock"></i></span>
                                                <input type="number" class="form-control" id="prep_time" name="prep_time" value="<?= $recipe['prep_time'] ?>" min="0">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="cook_time" class="form-label">Cook Time (min)</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="bi bi-fire"></i></span>
                                                <input type="number" class="form-control" id="cook_time" name="cook_time" value="<?= $recipe['cook_time'] ?>" min="0">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="servings" class="form-label">Servings</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="bi bi-people"></i></span>
                                                <input type="number" class="form-control" id="servings" name="servings" value="<?= $recipe['servings'] ?>" min="0">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label for="ingredients" class="form-label">Ingredients <span class="text-danger">*</span></label>
                                        <textarea class="form-control" id="ingredients" name="ingredients" rows="8" required><?= htmlspecialchars($recipe['ingredients']) ?></textarea>
                                        <div class="form-text">Enter each ingredient on a new line (e.g. "2 cups flour" or "1 tablespoon olive oil")</div>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label for="instructions" class="form-label">Instructions <span class="text-danger">*</span></label>
                                        <textarea class="form-control" id="instructions" name="instructions" rows="10" required><?= htmlspecialchars($recipe['instructions']) ?></textarea>
                                        <div class="form-text">Enter steps on separate lines, preferably numbered (e.g. "1. Preheat oven to 350°F")</div>
                                    </div>
                                    
                                    <div class="text-center mt-4">
                                        <a href="index.php" class="btn btn-secondary me-2">
                                            <i class="bi bi-x-circle me-1"></i> Cancel
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-<?= $action === 'add' ? 'plus-circle' : 'check-circle' ?> me-1"></i>
                                            <?= $action === 'add' ? 'Add Recipe' : 'Update Recipe' ?>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                break;
                
            case 'favorites':
                try {
                    if (empty($_SESSION['favorites'])) {
                        ?>
                        <div class="text-center py-5" data-aos="fade-up">
                            <div class="mb-4">
                                <i class="bi bi-heart text-primary" style="font-size: 5rem; opacity: 0.3;"></i>
                            </div>
                            <h2 class="mb-3">No Favorite Recipes Yet</h2>
                            <p class="text-muted mb-4">Discover recipes and mark your favorites by clicking the heart icon.</p>
                            <a href="index.php" class="btn btn-primary">
                                <i class="bi bi-grid me-2"></i>Browse All Recipes
                            </a>
                        </div>
                        <?php
                        break;
                    }
                    
                    $placeholders = implode(',', array_fill(0, count($_SESSION['favorites']), '?'));
                    $stmt = $db->prepare("SELECT * FROM recipes WHERE id IN ($placeholders) ORDER BY title");
                    
                    foreach ($_SESSION['favorites'] as $i => $favId) {
                        $stmt->bindValue(($i+1), $favId);
                    }
                    
                    $stmt->execute();
                    $recipes = $stmt->fetchAll(PDO::FETCH_ASSOC);
                } catch (PDOException $e) {
                    echo '<div class="alert alert-danger">Error: ' . $e->getMessage() . '</div>';
                    break;
                }
                ?>
                <h2 class="page-header" data-aos="fade-up">My Favorite Recipes</h2>
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    <?php foreach ($recipes as $recipe): ?>
                        <div class="col" data-aos="fade-up" data-aos-delay="<?= $loop_index * 100 ?>">
                            <div class="card recipe-card h-100">
                                <div class="position-relative overflow-hidden">
                                    <img src="<?= htmlspecialchars($recipe['image_url']) ?>" class="card-img-top" alt="<?= htmlspecialchars($recipe['title']) ?>">
                                    <form method="post" action="index.php?action=toggle_favorite" class="favorite-form">
                                        <input type="hidden" name="recipe_id" value="<?= $recipe['id'] ?>">
                                        <button type="submit" class="favorite-btn">
                                            <i class="bi bi-heart-fill"></i>
                                        </button>
                                    </form>
                                    <div class="recipe-badge">Favorite</div>
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title"><?= htmlspecialchars($recipe['title']) ?></h5>
                                    <div class="d-flex justify-content-between mb-3">
                                        <small class="recipe-time"><i class="bi bi-clock"></i> <?= $recipe['prep_time'] + $recipe['cook_time'] ?> min</small>
                                        <small class="recipe-time"><i class="bi bi-people"></i> <?= $recipe['servings'] ?> servings</small>
                                    </div>
                                    <a href="index.php?action=view&id=<?= $recipe['id'] ?>" class="btn btn-outline-primary mt-auto">View Recipe</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <?php
                break;
                
            case 'list':
            default:
                try {
                    $stmt = $db->query("SELECT * FROM recipes ORDER BY title");
                    $recipes = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    
                    if (empty($recipes)) {
                        ?>
                        <div class="text-center py-5" data-aos="fade-up">
                            <div class="mb-4">
                                <i class="bi bi-journal-plus text-primary" style="font-size: 5rem; opacity: 0.3;"></i>
                            </div>
                            <h2 class="mb-3">No Recipes Found</h2>
                            <p class="text-muted mb-4">Your recipe collection is empty. Start by adding your first recipe!</p>
                            <a href="index.php?action=add" class="btn btn-primary">
                                <i class="bi bi-plus-circle me-2"></i>Add Your First Recipe
                            </a>
                        </div>
                        <?php
                        break;
                    }
                } catch (PDOException $e) {
                    echo '<div class="alert alert-danger">Error: ' . $e->getMessage() . '</div>';
                    break;
                }
                ?>
                <h2 class="page-header" data-aos="fade-up">All Recipes</h2>
                
                <!-- Search and Filter -->
                <div class="row mb-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-md-8 mx-auto">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="bi bi-search"></i>
                                    </span>
                                    <input type="text" class="form-control border-start-0" id="searchRecipe" placeholder="Search for recipes...">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4" id="recipeContainer">
                    <?php $loop_index = 0; ?>
                    <?php foreach ($recipes as $recipe): ?>
                        <div class="col recipe-item" data-aos="fade-up" data-aos-delay="<?= $loop_index * 100 ?>">
                            <div class="card recipe-card h-100">
                                <div class="position-relative overflow-hidden">
                                    <img src="<?= htmlspecialchars($recipe['image_url']) ?>" class="card-img-top" alt="<?= htmlspecialchars($recipe['title']) ?>">
                                    <form method="post" action="index.php?action=toggle_favorite" class="favorite-form">
                                        <input type="hidden" name="recipe_id" value="<?= $recipe['id'] ?>">
                                        <button type="submit" class="favorite-btn">
                                            <?php if (isFavorite($recipe['id'])): ?>
                                                <i class="bi bi-heart-fill"></i>
                                            <?php else: ?>
                                                <i class="bi bi-heart"></i>
                                            <?php endif; ?>
                                        </button>
                                    </form>
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title recipe-title"><?= htmlspecialchars($recipe['title']) ?></h5>
                                    <div class="d-flex justify-content-between mb-3">
                                        <small class="recipe-time"><i class="bi bi-clock"></i> <?= $recipe['prep_time'] + $recipe['cook_time'] ?> min</small>
                                        <small class="recipe-time"><i class="bi bi-people"></i> <?= $recipe['servings'] ?> servings</small>
                                    </div>
                                    <div class="d-flex justify-content-between mt-auto">
                                        <a href="index.php?action=view&id=<?= $recipe['id'] ?>" class="btn btn-outline-primary">View Recipe</a>
                                        <div>
                                            <a href="index.php?action=edit&id=<?= $recipe['id'] ?>" class="btn btn-sm btn-outline-secondary me-1" title="Edit Recipe">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $recipe['id'] ?>" title="Delete Recipe">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Delete Confirmation Modal -->
                            <div class="modal fade" id="deleteModal<?= $recipe['id'] ?>" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Confirm Delete</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure you want to delete "<?= htmlspecialchars($recipe['title']) ?>"?</p>
                                            <p class="text-danger"><i class="bi bi-exclamation-triangle me-2"></i>This action cannot be undone.</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <form method="post" action="index.php?action=delete&id=<?= $recipe['id'] ?>">
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php $loop_index++; ?>
                    <?php endforeach; ?>
                </div>
                <?php
                break;
        }
        ?>
    </div>

    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-logo">
                    <i class="bi bi-book me-2"></i>Recipe Book
                </div>
                <div class="footer-social">
                    <a href="#"><i class="bi bi-facebook"></i></a>
                    <a href="#"><i class="bi bi-instagram"></i></a>
                    <a href="#"><i class="bi bi-pinterest"></i></a>
                    <a href="#"><i class="bi bi-twitter"></i></a>
                </div>
                <p class="mb-1">Recipe Book by Madularea Denisa Florina</p>
                <p class="small text-muted">Proiect PWeb</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS Animation Library -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <script>
        // Initialize AOS animations
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });
        
        // Search functionality
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchRecipe');
            if (searchInput) {
                searchInput.addEventListener('keyup', function() {
                    const searchValue = this.value.toLowerCase();
                    const recipeItems = document.querySelectorAll('.recipe-item');
                    
                    recipeItems.forEach(item => {
                        const title = item.querySelector('.recipe-title').textContent.toLowerCase();
                        if (title.includes(searchValue)) {
                            item.style.display = 'block';
                        } else {
                            item.style.display = 'none';
                        }
                    });
                });
            }
        });
    </script>
</body>
</html>