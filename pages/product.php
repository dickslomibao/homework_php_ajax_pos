<?php
require_once '../db/connection.php';
if (!isset($_SESSION['name'])) {
    header('Location: ../');
}
?>

<?php
require_once 'includes/navbar.php';
navabar('Product');
?>
<div class="maxw" style="padding: 10px;">
    <div class="header-part">
        <h4>Product Management</h4>
        <button class="btn-add" data-bs-toggle="modal" data-bs-target="#addModal">Add Product</button>
    </div>
    <div class="search">
        <div>

            <div class="input-container">
                <label class="my-label" style="font-size: 16px;">Search:</label>
                <input type="text" class="my-form" id="search" placeholder="" style="padding: 8px ;">
            </div>
        </div>
        <div>
            <p>Filter by date added:</p>
            <div style="display: flex;justify-content:space-between;column-gap:20px">

                <div class="input-container">
                    <label class="my-label" style="font-size: 16px;">From:</label>
                    <input type="date" class="my-form" id="from" placeholder="" style="padding: 8px ;">
                </div>
                <div class="input-container">
                    <label class="my-label" style="font-size: 16px;">To:</label>
                    <input type="date" class="my-form" id="to" placeholder="" style="padding: 8px ;">
                </div>
            </div>
        </div>

    </div>
   
    <table class="table" border="1">
        <thead style="background-color: rgba(0,0,0,.1);">
            <tr style="text-align: center;">
                <th scope="col">ID</th>
                <th scope="col">NAME</th>
                <th scope="col">PRICE</th>
                <th scope="col">DESCRIPTION</th>
           
                <th scope="col">CATEGORY</th>
                <th scope="col">DATE ADDED</th>
                <th scope="col">DATE UPDATED</th>
                <th scope="col">ACTION</th>
            </tr>
        </thead>
        <tbody id="table-body" style="text-align: center;">
        </tbody>
    </table> 
</div>

<!-- addModal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Product</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="input-container">
                    <label class="my-label" style="font-size: 16px;">Name:</label>
                    <input type="text" class="my-form" id="name" placeholder="" style="padding: 8px ;">
                    <span id="name-error" style="color:red"></span>
                </div>
                <div class="input-container">
                    <label class="my-label" style="font-size: 16px;">Category:</label>
                    <select class="my-form" style="padding: 8px;border:1px solid rgba(0,0,0,.3);border-radius:5px" id="category">
                    </select>
                </div>
                <div class="input-container">
                    <label class="my-label" style="font-size: 16px;">Description:</label>
                    <input type="text" class="my-form" id="desc" placeholder="" style="padding: 8px ;">
                    <span id="desc-error" style="color:red"></span>
                </div>
                <div class="input-container">
                    <label class="my-label" style="font-size: 16px;">Price:</label>
                    <input type="number" class="my-form" id="price" placeholder="" style="padding: 8px ;">
                    <span id="price-error" style="color:red"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="add_btn">Add</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Product</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="input-container">
                    <label class="my-label" style="font-size: 16px;">Name:</label>
                    <input type="text" class="my-form" id="editname" placeholder="" style="padding: 8px ;">
                    <span id="editname-error" style="color:red"></span>
                </div>
                <div class="input-container">
                    <label class="my-label" style="font-size: 16px;">Category:</label>
                    <select class="my-form" style="padding: 8px;border:1px solid rgba(0,0,0,.3);border-radius:5px" id="editcategory">
                    </select>
                </div>
                <div class="input-container">
                    <label class="my-label" style="font-size: 16px;">Description:</label>
                    <input type="text" class="my-form" id="editdesc" placeholder="" style="padding: 8px ;">
                    <span id="editdesc-error" style="color:red"></span>
                </div>
                <div class="input-container">
                    <label class="my-label" style="font-size: 16px;">Price:</label>
                    <input type="number" class="my-form" id="editprice" placeholder="" style="padding: 8px ;">
                    <span id="editprice-error" style="color:red"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="edit_btn">Save</button>
            </div>
        </div>
    </div>
</div>
<div class="loader">
    <div class="lds-ring">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
<script src="../js//product.js"></script>
</body>

</html>