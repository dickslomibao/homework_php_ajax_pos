$(document).ready(function () {
    displaySelect();
    display();
    async function display() {
        await $.post("../controller/productController.php", {
            'display-product': '',
        },
            function (data, textStatus, jqXHR) {
                $('#table-body').html(data);
            },

        );
    }
    async function displaySelect() {
        await $.post("../controller/categoryController.php", {
            'for-product': '',
        },
            function (data, textStatus, jqXHR) {
                $('#category').html(data);
                $('#editcategory').html(data);
            },

        );
    }

    $("#add_btn").click(function (e) {

        $name = $("#name");
        $desc = $("#desc");
        $price = $("#price");
        if ($name.val() == "") {
            $('#name-error').html("Name is required");
            return;
        }
        $('#name-error').html('');
        if ($desc.val() == "") {
            $('#desc-error').html("Description is required");
            return;
        }
        if ($price.val() == "") {
            $('#price-error').html("Price is required");
            return;
        }
        if (parseInt($price.val()) <= 0) {
            $('#price-error').html("Invalid price");
            return;
        }
        $('#desc-error').html('');
        $('#addModal').modal('hide');
        $('.loader').css('display', 'flex');
        setTimeout(async () => {
            await $.post("../controller/productController.php", {
                'name': $name.val(),
                'desc': $desc.val(),
                'cat': $('#category').val(),
                'price': $price.val(),
                'add_product': '',
            },
                function (data, textStatus, jqXHR) {

                    $('.loader').css('display', 'none');
                    if (data == "200") {
                        display();
                        swal("Good job!", "Successfuly Addded", "success");
                        $name.val('');
                        $desc.val('');
                    } else {
                        console.log(data);
                    }
                },

            );
        }, 1000);
    });

    let id;


    $(document).on('click', '.delete', async function () {
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this category!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    $('.loader').css('display', 'flex');
                    setTimeout(async () => {
                        await $.post("../controller/productController.php", {
                            'id': $(this).attr('data-id'),
                            'delete-product': '',
                        },
                            function (data, textStatus, jqXHR) {
                                $('.loader').css('display', 'none');
                                if (data == "200") {
                                    swal("Deleted successfuly.", {
                                        icon: "success",
                                    });
                                    display();
                                } else {
                                    console.log(data);
                                }
                            },

                        );
                    }, 1000);

                }
            });
    });

    $(document).on('click', '.edit', async function () {
        id = $(this).attr('data-id');
        await $.post("../controller/productController.php", {
            'single-product': '',
            'id': id,
        },
            function (data, textStatus, jqXHR) {
                let result = JSON.parse(data);
                $("#editname").val(result[0]['name']);
                $("#editprice").val(result[0]['price']);
                $("#editcategory").val(result[0]['category']);
                $("#editdesc").val(result[0]['description']);
                $('#editModal').modal('show');
            },

        );
    });


    $("#edit_btn").click(function (e) {

        $name = $("#editname");
        $desc = $("#editdesc");
        $price = $("#editprice");
        if ($name.val() == "") {
            $('#editname-error').html("Name is required");
            return;
        }
        $('#editname-error').html('');
        if ($desc.val() == "") {
            $('#editdesc-error').html("Description is required");
            return;
        }
        if ($price.val() == "") {
            $('#editprice-error').html("Price is required");
            return;
        }
        if (parseInt($price.val()) <= 0) {
            $('#editprice-error').html("Invalid price");
            return;
        }
        $('#editdesc-error').html('');
        $('#editname-error').html('');
        $('#editprice-error').html('');
        $('#editModal').modal('hide');
        $('.loader').css('display', 'flex');
        setTimeout(async () => {
            await $.post("../controller/productController.php", {
                'id': id,
                'name': $name.val(),
                'desc': $desc.val(),
                'cat': $('#editcategory').val(),
                'price': $price.val(),
                'edit_product': '',
            },
                function (data, textStatus, jqXHR) {
                    $('.loader').css('display', 'none');
                    if (data == "200") {
                        display();
                        swal("Good job!", "Successfuly updated", "success");
                        $name.val('');
                        $desc.val('');
                    } else {
                        console.log(data);
                    }
                },

            );
        }, 1000);
    });
    $('#search').keyup(async function (e) {
        search();
    });
    $('#from').on('change', function () {
        search() ;
    });
    $('#to').on('change', function () {
        search() ;
    });
    async function search() {
        if ($('#to').val() != "" && $('#to').val() < $('#from').val()) {
            swal("Opppss", "invalid selected date", "warning");
            return;
        }
        await $.post("../controller/productController.php", {
            'search-product': '',
            'data': $('#search').val(),
            'from': $('#from').val(),
            'to': $('#to').val(),
        },
            function (data, textStatus, jqXHR) {
                console.log(data);
                if (data == "error") {
                    display();
                } else {
                    $('#table-body').html(data);
                }
            },

        );
    }
});
