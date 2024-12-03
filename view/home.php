<?php include 'header.php' ?>

        <!-- Images section-->
         <?php if(!empty($categories)): ?>
            <section id="images">
                <div class="container px-4">
                    <div class="row gx-4 justify-content-center">
                        <div class="col-lg-8">
                            <!-- Galeria -->
                            <?php if(!empty($images)): ?>
                                <h2>Galeria</h2>
                                <div id="myBtnContainer">
                                    <button class="btn active" onclick="filterSelection('all')"> Show all</button>
                                    <?php foreach($categories as $categoria): 
                                        if($categoria['imageCounter'] > 0): ?>
                                            <button class="btn" onclick="filterSelection('category<?= $categoria['id_category'] ?>')"> <?=$categoria['name']?></button>
                                        <?php endif;
                                    endforeach; ?>
                                </div>

                                <div class="row">
                                    <?php foreach($images as $i):?>
                                        <div class="column category<?=$i['cod_category']?>">
                                            <div class="content">
                                                <img src="<?=$i['image']?>" alt="<?=$i['name']?>" style="width:100%">
                                            </div>
                                        </div>
                                    <?php endforeach?>
                                </div> 
                            <?php endif;?>

                            <!-- Formulário de Imagens -->
                            <div id="imageForm">
                                <h2>Adicionar Imagem</h2>
                                
                                <form method="post" class="mt-5" enctype="multipart/form-data" id="imageForm">
                                    <input type="hidden" name="newImage">
                                    
                                    <div class="mb-3">
                                        <label for="name">Nome </label>
                                        <input type="text" class="form-control" id="name" name="imageName" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="country">Categoria</label>
                                        <select class="custom-select d-block w-100" id="country" name="categorySelect" required>
                                            <?php foreach($categories as $ct): ?>
                                                <option value="<?= $ct['id_category']?>"><?= $ct['name']?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="mb-3 custom-file mt-4">
                                        <input type="file" class="custom-file-input" id="customFile" name="imageForm" required>
                                        <label class="custom-file-label" for="customFile">Escolha o arquivo</label>
                                    </div>

                                    <p id="maxSiseError" class="error text-danger"></p>

                                    <div class="mb-3 mt-3 text-right">
                                        <button type="submit" id="disabledBtn" class="btn btn-edit">Submeter</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif?>

        <!-- Categorias section-->
        <section class="bg-light" id="categories">
            <div class="container px-4">
                <div class="row gx-4 justify-content-center">
                    <div class="col-lg-8">

                        <h1>Categorias</h1>

                        <div id="categoryForm" class="mt-5 divCategoryForm">
                        <form method="post">
                            <input type="hidden" name="novaCategoria">
                            <input type="hidden" id="categoryCod" name="categoryCod">

                            <div class="mb-3">
                                <label for="name">Nome </label>
                                <input type="text" class="form-control" id="name" name="nomeCategoria">
                            </div>

                            <div class="row">
                                <div class='col text-right'>
                                    <button type="submit" class="btn btn-edit" id="btnHideCategoryForm">Fechar</button>
                                    <button type="submit" class="btn btn-edit">Submeter</button>
                                </div>
                            </div>

                        </form>
                        </div>

                        <div class="row" id="btnShowCategoryForm">
                        <div class='col text-right'><button type="button" class="btn btn-3cket">Nova categoria</button></div>
                        </div>

                        <!-- Formulário Nova/Editar Categoria -->
                        <div id="categoryForm" class="mt-5 divCategoryForm">
                        <form method="post">
                            <input type="hidden" name="novaCategoria">
                            <input type="hidden" id="categoryCod" name="categoryCod">
                            <div class="input-group mb-3 ">
                                <div class="input-group-prepend">
                                    <span class="input-group-text btn-edit" id="inputGroupName">Nome</span>
                                </div>
                                <input type="text" class="form-control" id='nameInput' name="nomeCategoria" aria-label="Default" aria-describedby="inputGroupName">
                            </div>  

                            <div class="row">
                            <div class='col text-right'>
                                <button type="submit" class="btn btn-edit" id="btnHideCategoryForm">Fechar</button>
                                <button type="submit" class="btn btn-edit">Submeter</button>
                            </div>
                            </div>

                        </form>
                        </div>

                        <!-- Tabela de Categorias -->
                        <table class="table table-striped mt-5 table-categorias rounded">
                            <thead class="btn-3cket">
                                <tr>
                                <th scope="col">Nome</th>
                                <th scope="col">Número de Imagens</th>
                                <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($categories as $c): ?> 
                                    <tr>
                                        <td>
                                            <div id="nameDiv">
                                                <?= $c['name'] ?>
                                            </div>

                                            <div class="divEditForm">
                                                <form method="post">
                                                    <input type="hidden" name="novaCategoria">
                                                    <div class="input-group mb-3 ">
                                                        <div class="input-group-prepend">
                                                        <span class="input-group-text btn-edit" id="inputGroup-sizing-default">Nome</span>
                                                        </div>
                                                        <input type="text" class="form-control" name="nomeCategoria" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                                                    </div>  
                                                </form>
                                            </div>

                                            
                                        </td>
                                        <td class="justify-content-center"><?= $c['imageCounter'] ?></td>
                                        <td class="d-flex justify-content-end">
                                            <div class="row">
                                                <div class="col">
                                                    <form method="post" hidden>
                                                        <input type="hidden" name="editCategory" value= <?= $c['id_category']?>>
                                                    </form>
                                                    <button id="btnCategoryEdit<?=$c['name']?>" value="<?= $c['id_category']?>" name='<?= $c['name']?>' class="btn btn-edit pr-2" >Editar</button>  
                                                </div>
                                                <div class="col">
                                                    <form method="post">
                                                        <input type="hidden" name="deleteCategory" value= <?= $c['id_category']?>>
                                                        <button type="submit" class="btn btn-danger">Apagar</button>  
                                                    </form>  
                                                </div>          
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </section>
        
        <?php include 'footer.php' ?>

       
