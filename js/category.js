$(document).ready(function () {
    let id;
    display();

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
        await $.post("../controller/categoryController.php", {
            'search-category': '',
            'data': $('#search').val(),
            'from': $('#from').val(),
            'to': $('#to').val(),
        },
            function (data, textStatus, jqXHR) {
                if (data == "error") {
                    display();
                } else {
                    $('#table-body').html(data);
                }

            },

        );
    }
    async function display() {
        await $.post("../controller/categoryController.php", {
            'display-category': '',
        },
            function (data, textStatus, jqXHR) {
                $('#table-body').html(data);
            },

        );
    }
    $("#add_btn").click(async function (e) {

        $name = $("#name");
        $desc = $("#desc");

        if ($name.val() == "") {
            $('#name-error').html("Name is required");
            return;
        }
        $('#name-error').html('');
        if ($desc.val() == "") {
            $('#desc-error').html("Description is required");
            return;
        }
        $('#desc-error').html('');
        $('#addModal').modal('hide');
        $('.loader').css('display', 'flex');
        await $.post("../controller/categoryController.php", {
            'name': $name.val(),
            'desc': $desc.val(),
            'add-category': '',
        },
            function (data, textStatus, jqXHR) {
                $('.loader').css('display', 'none');
                if (data == "200") {
                    swal("Good job!", "Successfuly Addded", "success");
                    $name.val('');
                    $desc.val('');
                    display();
                } else {
                    console.log(data);
                }
            },

        );
    });

    $(document).on('click', '.edit', async function () {
        id = $(this).attr('data-id');
        await $.post("../controller/categoryController.php", {
            'single-data': '',
            'id': id,
        },
            function (data, textStatus, jqXHR) {
                let result = JSON.parse(data);
                $("#editname").val(result[0]['name']);
                $("#editdesc").val(result[0]['description']);
                $('#editModal').modal('show');
            },

        );
    });
    $("#edit_btn").click(function (e) {

        $name = $("#editname");
        $desc = $("#editdesc");

        if ($name.val() == "") {
            $('#editname-error').html("Name is required");
            return;
        }
        $('#editname-error').html('');
        if ($desc.val() == "") {
            $('#editdesc-error').html("Description is required");
            return;
        }
        $('#editdesc-error').html('');

        $('#editModal').modal('hide');
        $('.loader').css('display', 'flex');

        setTimeout(async () => {
            await $.post("../controller/categoryController.php", {
                'id': id,
                'name': $name.val(),
                'desc': $desc.val(),
                'edit-category': '',
            },
                function (data, textStatus, jqXHR) {
                    $('.loader').css('display', 'none');
                    if (data == "200") {
                        swal("Good job!", "Successfuly Edited", "success");
                        $name.val('');
                        $desc.val('');
                        display();
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
                        await $.post("../controller/categoryController.php", {
                            'id': $(this).attr('data-id'),
                            'delete-category': '',
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