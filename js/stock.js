$(document).ready(function () {
    displaySelect()
    display();

    async function display() {
        await $.post("../controller/stockController.php", {
            'display-stock': '',
        },
            function (data, textStatus, jqXHR) {
                $('#table-body').html(data);
            },

        );
    }
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
        await $.post("../controller/stockController.php", {
            'search-stock': '',
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
    async function displaySelect() {
        await $.post("../controller/productController.php", {
            'for-stock': '',
        },
            function (data, textStatus, jqXHR) {
                $('#product').html(data);
               
            },

        );
    }
    let id ;
    $(document).on('click', '.edit', async function () {
        id = $(this).attr('data-id');
        $('#editModal').modal('show');
        $('#editstock').val($(this).attr('data-stock'));
      
    });
    $("#edit_btn").click(function (e) {
        $stock = $("#editstock");
        if ($stock.val() == "") {
            $('#editstock-error').html("Stock is required");
            return;
        }
        if (parseInt($stock.val()) <= 0) {
            $('#editstock-error').html("Invalid stock");
            return;
        }
        $('#editstock-error').html('');
        $('#editModal').modal('hide');
        $('.loader').css('display', 'flex');
        setTimeout(async () => {
            await $.post("../controller/stockController.php", {
                'id': id,
                'stock': $stock.val(),
                'edit-stock': '',
            },
                function (data, textStatus, jqXHR) {
                    $('.loader').css('display', 'none');
                    if (data == "200") {
                        swal("Good job!", "Successfuly Edited", "success");
                        $stock.val('');
                        display();
                    } else {
                        console.log(data);
                    }
                },

            );
        }, 1000);
    });

    $("#add_btn").click(function (e) {
        $price = $("#price");
        if ($price.val() == "") {
            $('#price-error').html("Price is required");
            return;
        }
        if (parseInt($price.val()) <= 0) {
            $('#price-error').html("Invalid price");
            return;
        }
        $('#price-error').html('');
        $('#addModal').modal('hide');
        $('.loader').css('display', 'flex');
        setTimeout(async () => {
            await $.post("../controller/stockController.php", {
                'product': $('#product').val(),
                'stock': $price.val(),
                'add_stock': '',
            },
                function (data, textStatus, jqXHR) {
                    $('.loader').css('display', 'none');
                    if (data == "200") {
                        swal("Good job!", "Successfuly Addded", "success");
                        $price.val('');
                        display();
                        displaySelect();
                    } else {
                        console.log(data);
                    }
                },
            );
        }, 1000);
    });

    $(document).on('click', '.delete', function () {

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
                        await $.post("../controller/stockController.php", {
                            'id': $(this).attr('data-id'),
                            'delete-stock': '',
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
});