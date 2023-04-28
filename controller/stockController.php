<?php
require_once '../model/stock.php';
if (isset($_POST['add_stock'])) {
    $stock = new Stock;
    try {
        $stock->setProduct($_POST['product']);
        $stock->setStock($_POST['stock']);
        $stock->insert();
        echo '200';
    } catch (PDOException $er) {
        echo $er->getMessage();
    }
}
if(isset($_POST['edit-stock'])){
    $stock = new Stock;
    try {
        $stock->setID($_POST['id']);
        $stock->setStock($_POST['stock']);
        $stock->update();
        echo '200';
    } catch (PDOException $er) {
        echo $er->getMessage();
    }
}
if (isset($_POST['search-stock'])) {
    try {
        $q1 = "";
        $q2 = "";
        $html = "";
        $and = "";
   
        if ($_POST['data'] != "" && $_POST['from'] != "" && $_POST['to'] != "") {
            $and = "and";
        }
        if ($_POST['data'] != "") {
            $q1 = "stock.id like '%" . $_POST['data'] . "%' or product.name like '%" . $_POST['data'] . "%' or stock.stock like '%" . $_POST['data'] . "%'";
        }
        if ($_POST['from'] != "" && $_POST['to'] != "") {
            $q2 = "stock.date_created >= '" . $_POST['from'] . "' and stock.date_created <= '" . $_POST['to'] . "'";
        }
        
        $stock = new Stock;
     
        $result = $stock->search($q2 . " " . $and . " " . $q1);
        foreach ($result as $key => $value) {
            $html .= '<tr>
            <td>' . $value['id'] . '</td>
             <td>' . $value['name'] . '</td>
             <td>' . $value['stock'] . '</td>
             <td>' . $value['date_created'] . '</td>
             <td>' . $value['date_updated'] . '</td>
             <td>
                <button class="edit" data-id="' . $value['id'] . '"  data-stock="' . $value['stock'] . '">Edit</button>
                <button class="delete" data-id="' . $value['id'] . '"  data-stock="' . $value['stock'] . '">Delete</button>
             </td>
            </tr>';
        }
        echo $html;
    } catch (PDOException $ex) {
        echo 'error';
    }
}

if(isset($_POST['delete-stock'])){
    $stock = new Stock;
    try {
        $stock->setID($_POST['id']);
        $stock->delete();
        echo '200';
    } catch (PDOException $er) {
        echo $er->getMessage();
    }
}
if (isset($_POST['display-stock'])) {
    try {
        $html = "";
        $stock = new Stock;
        $result = $stock->displayAll();
        foreach ($result as $key => $value) {
            $html .= '<tr>
            <td>' . $value['id'] . '</td>
             <td>' . $value['name'] . '</td>
             <td>' . $value['stock'] . '</td>
             <td>' . $value['date_created'] . '</td>
             <td>' . $value['date_updated'] . '</td>
             <td>
                <button class="edit" data-id="' . $value['id'] . '"  data-stock="' . $value['stock'] . '">Edit</button>
                <button class="delete" data-id="' . $value['id'] . '"  data-stock="' . $value['stock'] . '">Delete</button>
             </td>
            </tr>';
        }
        echo $html;
    } catch (PDOException $ex) {
        echo $ex->getMessage();
    }
}
