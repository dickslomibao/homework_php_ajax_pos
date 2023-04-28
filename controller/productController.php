<?php 
require_once '../model/product.php';
if(isset($_POST['add_product'])){
    $product = new Product;
    try {
        $product->setName($_POST['name']);
        $product->setDesc($_POST['desc']);
        $product->setCategory($_POST['cat']);
        $product->setPrice($_POST['price']);
        $product->insert();
        echo '200';
    
    } catch (PDOException $er) {
        echo $er->getMessage();
    }
}

if(isset($_POST['edit_product'])){
    $product = new Product;
    try {
        $product->setId($_POST['id']);
        $product->setName($_POST['name']);
        $product->setDesc($_POST['desc']);
        $product->setCategory($_POST['cat']);
        $product->setPrice($_POST['price']);
        $product->update();
        echo '200';
    
    } catch (PDOException $er) {
        echo $er->getMessage();
    }
}
if (isset($_POST['single-product'])) {
    try {

        $product = new Product;
        $product->setId($_POST['id']);
        $result = $product->singleProduct();
        echo json_encode($result);
    } catch (PDOException $ex) {
        echo $ex->getMessage();
    }
}
if (isset($_POST['display-product'])) {
    try {
        $html = "";
        $product = new Product;

        $result = $product->displayAll();
        foreach ($result as $key => $value) {
            $html .= '<tr>
            <td>' . $value['id'] . '</td>
             <td>' . $value['name'] . '</td>
             <td>' . $value['price'] . '</td>
             <td>' . $value['description'] . '</td>
             <td>' . $value['category'] . '</td>
             <td>' . $value['date_created'] . '</td>
             <td>' . $value['date_updated'] . '</td>
             <td>
                <button class="edit" data-id="' . $value['id'] . '">Edit</button>
                <button class="delete" data-id="' . $value['id'] . '">Delete</button>
             </td>
            </tr>';
        }
        echo $html;
    } catch (PDOException $ex) {
        echo $ex->getMessage();
    }
}
if (isset($_POST['search-product'])) {
    try {
        $html = "";
        $q1 = "";
        $q2 = "";
        $and = "";
    
        if ($_POST['data'] != "" && $_POST['from'] != "" && $_POST['to'] != "") {
            $and = "and";
        }
        if ($_POST['data'] != "") {
            $q1 = "(product.id like '%".$_POST['data']."%' or product.name like '%".$_POST['data']."%' or product.price like '%".$_POST['data']."%' or product.description like '%".$_POST['data']."%' or category.name like '%".$_POST['data']."%')";
        }
        if (!empty($_POST['from']) and !empty($_POST['to'])) {
            $q2 = "(product.date_created >= '" . $_POST['from'] . "' and product.date_created <= '" . $_POST['to'] . "')";
        }
        $product = new Product;
        
        $result = $product->search($q2 . " " . $and . " " . $q1);
        foreach ($result as $key => $value) {
            $html .= '<tr>
            <td>' . $value['id'] . '</td>
             <td>' . $value['name'] . '</td>
             <td>' . $value['price'] . '</td>
             <td>' . $value['description'] . '</td>
             <td>' . $value['category'] . '</td>
             <td>' . $value['date_created'] . '</td>
             <td>' . $value['date_updated'] . '</td>
             <td>
                <button class="edit" data-id="' . $value['id'] . '">Edit</button>
                <button class="delete" data-id="' . $value['id'] . '">Delete</button>
             </td>
            </tr>';
        }
        echo $html;
    } catch (PDOException $ex) {
        echo 'error';
    }
}
if (isset($_POST['delete-product'])) {
    try {

        $product = new Product;
        $product->setId($_POST['id']);
        $product->delete();
        echo '200';
    } catch (PDOException $ex) {
        echo $ex->getMessage();
    }
}
if (isset($_POST['for-stock'])) {
    try {
        $html = "";
        $product = new Product;

        $result = $product->forStock();
        foreach ($result as $key => $value) {
            $html .= "<option value=" . $value['id'] . ">" . $value['name'] . "</option>";
        }
        echo $html;
    } catch (PDOException $ex) {
        echo $ex->getMessage();
    }
}