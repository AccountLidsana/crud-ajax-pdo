<?php

include 'connect.php';



?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.4.0/css/fixedHeader.dataTables.min.css">
        <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
        <style>
        *,
        *::after,
        *::before {
            font-family: "phetsarath OT";
        }
        </style>

    </head>
    <body>
        <!-- Button trigger modal -->

        <!-- Edit Student Modal -->
        <div class="modal fade" id="studentEditModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Student</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="updateStudent">
                        <div class="modal-body">

                            <label for="">ID :</label>
                            <input type="text" name="editId" id="student_id" class="form-control">

                            <div class="mb-3">
                                <label for="">ຊື່</label>
                                <input type="text" name="name" id="name" class="form-control" />
                            </div>
                            <div class="mb-3">
                                <label for="">ອີເມວ</label>
                                <input type="text" name="email" id="email" class="form-control" />
                            </div>
                            <div class="mb-3">
                                <label for="">ເບີໂທ</label>
                                <input type="text" name="phone" id="phone" class="form-control" />
                            </div>
                            <div class="mb-3">
                                <label for="">ຄອດ</label>
                                <input type="text" name="course" id="course" class="form-control" />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ປິດ</button>
                            <button type="submit" class="btn btn-primary">ຍືນຍັນ</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="studentAddModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="saveStudent" method="POST" enctype="multipart/form-data">

                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name">ຊື່</label>
                                <input type="text" name="name" id="name" class="form-control" />
                            </div>
                            <div class="mb-3">
                                <label for="name">ອີເມວ</label>
                                <input type="text" name="email" id="email" class="form-control" />
                            </div>
                            <div class="mb-3">
                                <label for="phone">ເບີໂທ</label>
                                <input type="number" name="phone" id="phone" class="form-control" />
                            </div>
                            <div class="mb-3">
                                <label for="course">ຄອດ</label>
                                <input type="text" name="course" id="course" class="form-control" />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ປິດ</button>
                            <button type="submit" id="submit" name="submit" class="btn btn-primary">ບັນທຶກ</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        </div>

        <div class="container">
            <div class="row my-4">
                <div class="col-md-3">
                    <h1>CRUD PDO AJAX</h1>
                </div>
                <div class="col-md-8 text-end">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#studentAddModal">
                        ເພີ່ມ
                    </button>
                </div>
            </div>
            <table class="table table-striped  table-hover display responsive nowrap " id="myTable" width="100%">
                <thead>
                    <tr>
                        <th>ID :</th>
                        <th>Name :</th>
                        <th>Email :</th>
                        <th>Phone :</th>
                        <th>Course :</th>
                        <th>Action :</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

               
                    $sql_selectAll = "SELECT * FROM students";
                    $sql_selectAll = $conn->query($sql_selectAll);
                    $row_selectAll = $sql_selectAll->fetchAll(PDO::FETCH_ASSOC);

                    
                    foreach($row_selectAll as $row){
                        ?>

                    <tr>
                        <td><?php echo $row['id'] ?></td>
                        <td><?php echo $row['name'] ?></td>
                        <td><?php echo $row['email'] ?></td>
                        <td><?php echo $row['phone'] ?></td>
                        <td><?php echo $row['course'] ?></td>
                        <td>
                            <button type="button" value="<?=$row['id'];?>" class=" btn btn-success btn-sm"
                                id="editStudentBtn">ແກ້ໄຂ</button>
                            <button type="button" value="<?=$row['id'];?>" class=" btn btn-danger btn-sm"
                                id="DeleteBtn">ລົບ</button>
                        </td>
                    </tr>
                    <?php    
                 }
                    ?>
                </tbody>
            </table>
        </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>

        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

        <script>
        $(document).ready(function() {

            $(document).ready(function() {
                var table = $('#myTable').DataTable({

                    responsive: true,
                    columnDefs: [{
                            responsivePriority: 1,
                            targets: 0
                        },
                        {
                            responsivePriority: 2,
                            targets: -1
                        }
                    ]
                });
            })

            $('#saveStudent').submit(function(e) {
                e.preventDefault();

                var formData = new FormData(this);
                formData.append("save_student", true);

                $.ajax({
                    url: "chkdb.php",
                    type: "POST",
                    data: formData,
                    cache: false,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log(response);

                        var res = jQuery.parseJSON(response);
                        if (res.status == 422) {

                            Swal.fire({
                                title: 'ຜິດຜາດ',
                                text: res.message,
                                icon: 'warning',
                                // showCancelButton: true,
                                // confirmButtonColor: '#3085d6',
                                showConfirmButton: false, // cancelButtonColor: '#d33',
                                // confirmButtonText: 'Yes, delete it!'
                            })

                        } else if (res.status == 200) {


                            $('#studentAddModal').modal('hide');
                            $('#saveStudent')[0].reset();

                            alertify.set('notifier', 'position', 'top-right');
                            alertify.success(res.message);

                            $('#myTable').load(location.href + " #myTable");

                        } else if (res.status == 500) {
                            // alert(res.message);
                            Swal.fire({
                                title: 'ຜິດຜາດ',
                                text: res.message,
                                icon: 'warning',
                                // showCancelButton: true,
                                // confirmButtonColor: '#3085d6',
                                showConfirmButton: false, // cancelButtonColor: '#d33',
                                // confirmButtonText: 'Yes, delete it!'
                            })

                        }
                    }
                });

            });

            $(document).on('click', '#editStudentBtn', function() {

                var editID = $(this).val();
                console.log(editID);
                $.ajax({
                    type: "GET",
                    url: "chkdb.php?editId=" + editID,
                    success: function(response) {
                        console.log(response);
                        var res = jQuery.parseJSON(response);
                        if (res.status == 404) {
                            Swal.fire({
                                title: 'ຜິດຜາດ',
                                text: res.message,
                                icon: 'warning',
                                // showCancelButton: true,
                                // confirmButtonColor: '#3085d6',
                                showConfirmButton: false, // cancelButtonColor: '#d33',
                                // confirmButtonText: 'Yes, delete it!'
                            })
                        } else if (res.status == 200) {

                            $('#student_id').val(res.data.id);
                            $('#name').val(res.data.name);
                            $('#email').val(res.data.email);
                            $('#phone').val(res.data.phone);
                            $('#course').val(res.data.course);
                            $('#studentEditModal').modal('show');

                        }

                    }
                });

            });


            $(document).on("click", "#DeleteBtn", function(e) {
                e.preventDefault();
                var delID = $(this).val();
                console.log(delID);
                Swal.fire({
                    title: 'ທ່ານຕ້ອງການລົບຂໍ້ມູນບໍ່?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'ຍືນຍັນ',
                    cancelButtonText: 'ຍົກເລິກ',
                }).then((result) => {

                    if (result.isConfirmed) {
                        $.ajax({
                            type: "GET",
                            url: "chkdb.php?deleteID=" + delID,
                            success: function(data) {
                                console.log(data);
                                var res = JSON.parse(data);
                                if (res.status == 500) {



                                } else if (res.status == 200) {
                                    // alertify.set('notifier', 'position', 'top-right');
                                    // alertify.success(res.message);
                                    // alert(res.status, res.message);
                                    Swal.fire(
                                        'ສຳເລັດ!',
                                        'ລົບຂໍ້ມູນສຳເລັດ.',
                                        'success'
                                    ).then(function() {
                                        $('#myTable').load(location.href +
                                            " #myTable");
                                    })


                                }

                            }


                        })
                    }
                })


            })
        })







        $(document).on('submit', '#updateStudent', function(e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("update_student", true);

            $.ajax({
                type: "POST",
                url: "chkdb.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {

                    var res = jQuery.parseJSON(response);
                    console.log(response);
                    if (res.status == 422) {
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);

                    } else if (res.status == 200) {


                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);

                        $('#studentEditModal').modal('hide');
                        $('#updateStudent')[0].reset();

                        $('#myTable').load(location.href + " #myTable");

                    } else if (res.status == 500) {
                        Swal.fire({
                            title: 'ຜິດຜາດ',
                            text: res.message,
                            icon: 'warning',
                            // showCancelButton: true,
                            // confirmButtonColor: '#3085d6',
                            showConfirmButton: false, // cancelButtonColor: '#d33',
                            // confirmButtonText: 'Yes, delete it!'
                        })
                    } else {

                    }
                }
            });

        });



        // })
        </script>
    </body>
</html>