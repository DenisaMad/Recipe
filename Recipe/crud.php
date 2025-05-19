<?php
// index.php - Main file for the Recipe Management System
session_start();

// Initialize favorites array in session if it doesn't exist
if (!isset($_SESSION['favorites'])) {
    $_SESSION['favorites'] = [];
}

// Database connection
$host = '109.197.87.24'; 
$dbname = 'denisa_DB_TI'; 
$username = 'jimmydb'; 
$password = '66152002'; 

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<script>console.log('Database connection successful');</script>";
    
    // Check if recipes table exists
    $tableExists = false;
    $stmt = $db->query("SHOW TABLES LIKE 'recipes'");
    if ($stmt->rowCount() > 0) {
        $tableExists = true;
    }
    
    // Create recipes table if it doesn't existv
    if (!$tableExists) {
        $db->exec("CREATE TABLE recipes (
            id INT AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(255) NOT NULL,
            ingredients TEXT NOT NULL,
            instructions TEXT NOT NULL,
            prep_time INT,
            cook_time INT,
            servings INT,
            image_url VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");
        
        // Insert sample data
        $sampleRecipes = [
            [
                'title' => 'Spaghetti Carbonara',
                'ingredients' => "400g spaghetti\n200g pancetta\n3 eggs\n50g pecorino cheese\n50g parmesan\nBlack pepper",
                'instructions' => "1. Cook pasta according to package directions\n2. Fry pancetta until crispy\n3. Beat eggs with cheese and pepper\n4. Mix hot pasta with pancetta, then quickly stir in egg mixture\n5. Serve immediately with extra cheese",
                'prep_time' => 10,
                'cook_time' => 15,
                'servings' => 4,
                'image_url' => 'https://placehold.co/400x300'
            ],
            [
                'title' => 'Classic Chocolate Chip Cookies',
                'ingredients' => "225g butter\n110g white sugar\n165g brown sugar\n2 eggs\n2 tsp vanilla extract\n280g flour\n1 tsp baking soda\n1/2 tsp salt\n335g chocolate chips",
                'instructions' => "1. Preheat oven to 375°F (190°C)\n2. Cream butter and sugars until light\n3. Beat in eggs and vanilla\n4. Mix in dry ingredients\n5. Fold in chocolate chips\n6. Drop tablespoons of dough onto baking sheets\n7. Bake 9-11 minutes until golden",
                'prep_time' => 15,
                'cook_time' => 10,
                'servings' => 24,
                'image_url' => 'https://placehold.co/400x300'
            ]
        ];
        
        $stmt = $db->prepare("INSERT INTO recipes (title, ingredients, instructions, prep_time, cook_time, servings, image_url) 
                             VALUES (:title, :ingredients, :instructions, :prep_time, :cook_time, :servings, :image_url)");
        
        foreach ($sampleRecipes as $recipe) {
            $stmt->execute($recipe);
        }
        
        echo "<script>console.log('Recipes table created and sample data inserted');</script>";
    }
    
} catch (PDOException $e) {
    echo "<script>console.log('Database error: " . $e->getMessage() . "');</script>";
    die("Database error: " . $e->getMessage());
}

// Handle actions
$action = isset($_GET['action']) ? $_GET['action'] : 'list';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    switch ($action) {
        case 'add':
        case 'edit':
            $title = $_POST['title'] ?? '';
            $ingredients = $_POST['ingredients'] ?? '';
            $instructions = $_POST['instructions'] ?? '';
            $prep_time = (int)($_POST['prep_time'] ?? 0);
            $cook_time = (int)($_POST['cook_time'] ?? 0);
            $servings = (int)($_POST['servings'] ?? 0);
            $image_url = $_POST['image_url'] ?? 'https://placehold.co/400x300';
            
            if (empty($title) || empty($ingredients) || empty($instructions)) {
                $error = "Please fill in all required fields";
            } else {
                try {
                    if ($action === 'add') {
                        $stmt = $db->prepare("INSERT INTO recipes (title, ingredients, instructions, prep_time, cook_time, servings, image_url) 
                                             VALUES (:title, :ingredients, :instructions, :prep_time, :cook_time, :servings, :image_url)");
                        $success = "Recipe added successfully!";
                    } else {
                        $stmt = $db->prepare("UPDATE recipes SET title = :title, ingredients = :ingredients, instructions = :instructions, 
                                             prep_time = :prep_time, cook_time = :cook_time, servings = :servings, image_url = :image_url 
                                             WHERE id = :id");
                        $stmt->bindParam(':id', $id);
                        $success = "Recipe updated successfully!";
                    }
                    
                    $stmt->bindParam(':title', $title);
                    $stmt->bindParam(':ingredients', $ingredients);
                    $stmt->bindParam(':instructions', $instructions);
                    $stmt->bindParam(':prep_time', $prep_time);
                    $stmt->bindParam(':cook_time', $cook_time);
                    $stmt->bindParam(':servings', $servings);
                    $stmt->bindParam(':image_url', $image_url);
                    $stmt->execute();
                    
                    $_SESSION['success'] = $success;
                    header("Location: index.php");
                    exit;
                } catch (PDOException $e) {
                    $error = "Error: " . $e->getMessage();
                }
            }
            break;
            
        case 'delete':
            try {
                $stmt = $db->prepare("DELETE FROM recipes WHERE id = :id");
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                
                $_SESSION['success'] = "Recipe deleted successfully!";
                header("Location: index.php");
                exit;
            } catch (PDOException $e) {
                $error = "Error: " . $e->getMessage();
            }
            break;
            
        case 'toggle_favorite':
            $recipeId = (int)$_POST['recipe_id'];
            
            // Check if it's already in favorites
            $key = array_search($recipeId, $_SESSION['favorites']);
            
            if ($key !== false) {
                // Remove from favorites
                unset($_SESSION['favorites'][$key]);
                $_SESSION['favorites'] = array_values($_SESSION['favorites']); // Re-index array
                $message = "Recipe removed from favorites";
            } else {
                // Add to favorites
                $_SESSION['favorites'][] = $recipeId;
                $message = "Recipe added to favorites";
            }
            
            // Return JSON response for AJAX
            if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
                echo json_encode(['status' => 'success', 'message' => $message]);
                exit;
            }
            
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
            break;
    }
}

// Function to check if a recipe is favorite
function isFavorite($recipeId) {
    return in_array($recipeId, $_SESSION['favorites']);
}

?>