<?php
require_once '../model/category.php';
if (isset($_POST['add-category'])) {
    try {
        $category = new Category;
        $category->setName($_POST['name']);
        $category->setDesc($_POST['desc']);
        $category->insert();
        echo '200';
    } catch (PDOException $ex) {
        echo $ex->getMessage();
    }
}
if (isset($_POST['display-category'])) {
    try {
        $html = "";
        $category = new Category;
        $result = $category->displayAll();
        foreach ($result as $key => $value) {
            $html .= '<tr>
            <td>' . $value['id'] . '</td>
             <td>' . $value['name'] . '</td>
             <td>' . $value['description'] . '</td>
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
if (isset($_POST['for-product'])) {
    try {
        $html = "";
        $category = new Category;

        $result = $category->displayAll();
        foreach ($result as $key => $value) {
            $html .= "<option value=" . $value['id'] . ">" . $value['name'] . "</option>";
        }
        echo $html;
    } catch (PDOException $ex) {
        echo $ex->getMessage();
    }
}
if (isset($_POST['search-category'])) {
    try {
        $q1 = "";
        $q2 = "";
        $html = "";
        $and = "";
        $category = new Category;
        if ($_POST['data'] != "" && $_POST['from'] != "" && $_POST['to'] != "") {
            $and = "and";
        }
        if ($_POST['data'] != "") {
            $q1 = "name like '%" . $_POST['data'] . "%' or description like '%" . $_POST['data'] . "%' ";
        }
        if ($_POST['from'] != "" && $_POST['to'] != "") {
            $q2 = "date_created >= '" . $_POST['from'] . "' and date_created <= '" . $_POST['to'] . "'";
        }
        $result = $category->search($q2 . " " . $and . " " . $q1);
        foreach ($result as $key => $value) {
            $html .= '<tr>
            <td>' . $value['id'] . '</td>
             <td>' . $value['name'] . '</td>
             <td>' . $value['description'] . '</td>
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

if (isset($_POST['single-data'])) {
    try {

        $category = new Category;

        $category->setId($_POST['id']);
        $result = $category->getSingleData();
        echo json_encode($result);
    } catch (PDOException $ex) {
        echo $ex->getMessage();
    }
}

if (isset($_POST['edit-category'])) {
    try {
        $category = new Category;
        $category->setId($_POST['id']);
        $category->setName($_POST['name']);
        $category->setDesc($_POST['desc']);
        $category->update();
        echo '200';
    } catch (PDOException $ex) {
        echo $ex->getMessage();
    }
}
if (isset($_POST['delete-category'])) {
    try {

        $category = new Category;
        $category->setId($_POST['id']);
        $category->delete();
        echo '200';
    } catch (PDOException $ex) {
        echo $ex->getMessage();
    }
}
?>