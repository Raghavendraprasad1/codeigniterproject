<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
    <script src=""></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <a style="float: right;" href="<?= base_url('form_validate') ?>" class="btn btn-primary mb-3 mt-3">Add User</a>
            </div>
        </div>
        <div class="row">
            <!-- <div class="col-sm-"></div> -->
            <div class="col-lg-12">
                <table id="manage-users" class=" table-md table-striped display nowrap compact" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Action</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile No.</th>
                            <th>Password </th>
                            <th>City</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
<script>
    var base_url = "<?= base_url(); ?>";
</script>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/js/general.js') ?>"></script>