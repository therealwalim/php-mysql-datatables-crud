<html>

<head>
    <title>Latino Radio Manager v1.0</title>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" integrity="sha512-fRVSQp1g2M/EqDBL+UFSams+aw2qk12Pl/REApotuUVK1qEXERk3nrCFChouag/PdDsPk387HJuetJ1HBx8qAg==" crossorigin="anonymous" />
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
    <script src="js/swal.js"></script>
    <script src="js/feather.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js"></script>
    

    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f1f1f1;
        }

        .content {
            width: 1270px;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 25px;
            box-sizing: border-box;
        }

        .buttons {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
        }

        input.form-control.input-sm{
            margin-left: 10px !important;
        }
        div#user_data_filter.dataTables_filter{
            display: flex;
            flex-direction: row-reverse;
            align-items: flex-end;
        }
    </style>
</head>

<body>
    <div class="container content">
        <h1 align="center">Tableau des disques et MP3/WAVE reçu :</h1>
        <br />
        <div class="table-responsive">
            <br />
            <div align="right">
                <button type="button" name="add" id="add" class="btn btn-info buttons"><i style="height: 15px;" data-feather="plus-circle"></i>
                    <p style="margin: 0;">Add</p>
                </button>
            </div>
            <br />
            <div id="alert_message"></div>
            <table id="user_data" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>name</th>
                        <th>openradio</th>
                        <th>commentaire</th>
                        <th>projet</th>
                        <th>designation</th>
                        <th>valide</th>
                        <th>categorie</th>
                        <th>numero</th>
                        <th>date</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</body>

</html>

<script type="text/javascript" language="javascript">
    $(document).ready(function() {

        fetch_data();

        function fetch_data() {
            var dataTable = $('#user_data').DataTable({
                "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    url: "fetch.php",
                    type: "POST"
                },dom: 'Bfrtip',
                buttons: [
                'csv', 'excel', 'pdf'
                ]
            });
        }

        function update_data(id, column_name, value) {
            $.ajax({
                url: "update.php",
                method: "POST",
                data: {
                    id: id,
                    column_name: column_name,
                    value: value
                },
                success: function(data) {
                    const Toast = Swal.mixin({
                            toast: true,
                            position: 'bottom-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'success',
                            title: 'Donnée modifiée'
                        })
                    $('#user_data').DataTable().destroy();
                    fetch_data();
                }
            });
            setInterval(function() {
                $('#alert_message').html('');
            }, 5000);
        }

        $(document).on('blur', '.update', function() {
            var id = $(this).data("id");
            var column_name = $(this).data("column");
            var value = $(this).text();
            update_data(id, column_name, value);
        });

        $('#add').click(function() {
            var html = '<tr>';
            html += '<td contenteditable id="data1"></td>';
            html += '<td contenteditable id="data2"></td>';
            html += '<td contenteditable id="data3"></td>';
            html += '<td contenteditable id="data4"></td>';
            html += '<td contenteditable id="data5"></td>';
            html += '<td contenteditable id="data6"></td>';
            html += '<td contenteditable id="data7"></td>';
            html += '<td contenteditable id="data8"></td>';
            html += '<td contenteditable id="data9"></td>';
            html += '<td><button type="button" name="insert" id="insert" class="btn btn-success btn-xs">Insert</button></td>';
            html += '</tr>';
            $('#user_data tbody').prepend(html);
        });

        $(document).on('click', '#insert', function() {
            var name = $('#data1').text();
            var openradio = $('#data2').text();
            var commentaire = $('#data3').text();
            var projet = $('#data4').text();
            var designation = $('#data5').text();
            var valide = $('#data6').text();
            var categorie = $('#data7').text();
            var numero = $('#data8').text();
            var date = $('#data9').text();

            if (name != '' && openradio != '' && comentaire != '' && projet != '' && designation != '' && valide != '' && categorie != '' && numero != '' && date != '') {
                $.ajax({
                    url: "insert.php",
                    method: "POST",
                    data: {
                        first_name: first_name,
                        last_name: last_name
                    },
                    success: function(data) {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'bottom-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'success',
                            title: 'Donnée ajoutée'
                        })

                        $('#user_data').DataTable().destroy();
                        fetch_data();
                    }
                });
                setInterval(function() {
                    $('#alert_message').html('');
                }, 5000);
            } else {
                alert("Both Fields is required");
            }
        });

        $(document).on('click', '.delete', function() {
            var id = $(this).attr("id");
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                    url: "delete.php",
                    method: "POST",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'bottom-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'success',
                            title: 'Donnée supprimée'
                        })
                        $('#user_data').DataTable().destroy();
                        fetch_data();
                    }
                });
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })
        });
    });
    feather.replace();
</script>