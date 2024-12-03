<?php

    include 'config.php';
    include 'functions.php';
    include 'config.php';

    //upload image
    if(isset($_POST['newImage'])){
        $target_dir = "uploads/";
        $file_name = $target_dir . basename($_FILES["imageForm"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($file_name,PATHINFO_EXTENSION));

        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            $error = "Desculpe, apenas ficheiros JPG, JPEG ou PNG são aceites.";
            $uploadOk = 0;
        }else{

            $compressedImage = compressImage( $_FILES["imageForm"]["tmp_name"], $file_name);

            $nome = escapeSQL($_POST['imageName']);

            $data = [
                'name' => $nome,
                'image' => $compressedImage,
                'cod_categoria' => $_POST['categorySelect'],
            ];

            $insertImage = $pdo->prepare("INSERT INTO image (name,image,cod_category) VALUES (:name, :image, :cod_categoria)")->execute($data);

            $uploadOk = 1;
        }

    }


    // Listagem de Imagens
    $images = $pdo->query('SELECT * FROM image')->fetchAll();


    // Insert de nova categoria
    if(isset($_POST['novaCategoria']) && empty($_POST['categoryCod'])){
        if(!empty($_POST['nomeCategoria'])){
            $nome = escapeSQL($_POST['nomeCategoria']);

            $data = [
                'name' => $nome,
            ];

            $insertCategory = $pdo->prepare("INSERT INTO category (name) VALUES (:name)")->execute($data);

            if($insertCategory){
                $insertSuccess = true;
            }
        }
    }

    // Editar Categoria
    if(isset($_POST['categoryCod']) && $_POST['categoryCod'] > 0){
        $updateCat = "UPDATE category SET name=? WHERE id_category=?";
        $pdo->prepare($updateCat)->execute([$_POST['nomeCategoria'], $_POST['categoryCod']]);
        unset($_POST['categoryCod']);
    }

    // Apagar Categoria
    if(isset($_POST['deleteCategory'])){
        $deleteCategory = $pdo->prepare("DELETE FROM category WHERE id_category = ?")->execute([$_POST['deleteCategory']]);
        $deleteImages = $pdo->prepare("DELETE FROM image WHERE cod_category = ?")->execute([$_POST['deleteCategory']]);

    }

    // Listagem de categorias
    $categories = $pdo->query('SELECT * FROM category')->fetchAll();
    foreach($categories as &$category){
        // Contagem de numero de imagens de cada categoria para complementar a tabela 'Categorias'
        $categoriesNames[] = $category['name'];

        $categoryImages = $pdo->query('SELECT * FROM image WHERE cod_category =' .$category['id_category'])->fetchAll();

        $category['imageCounter'] = count($categoryImages);

        foreach($categoryImages as $cI){
            $category['images'][] = array(
                'name' => $cI['name'],
                'image' => $cI['image'],
            );
        }

    }

    require 'view/home.php';    

?>