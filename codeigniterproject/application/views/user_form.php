<style>
    .error {
        color: red;
    }
    .form-error{
        /* backface-visibility: visible; */
        margin-top: 10px;


    }
</style>
<?php
$vName = "";
$vEmail = "";
$vPassword = "";
$vMobileNo = "";
$vCity = "";
$id = "";
$btn_name = "Save";
if (!empty($user_details)) {
    // print_r($user_details);die;
    $vName = $user_details->vName;
    $vEmail = $user_details->vEmail;
    $vPassword = $user_details->vPassword;
    $vMobileNo = $user_details->vMobileNo;
    $vCity = $user_details->vCity;
    $id = $user_details->id;
    $btn_name = "Update";
}

?>
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
</head>

<body>
    <div class="container">
        <div class="row">
            <?php if ($this->session->flashdata('error')) {?>
                <p class="form-error" style="background-color:brown; margin-left:200px;"><?=$this->session->flashdata('error');?></p>
                <?php }?>
            <?php if ($this->session->flashdata('success')) {?>
                <p class="form-error" style="background-color:red; margin-left:200px;"><?=$this->session->flashdata('success');?></p>
                <?php }?>
        </div>
        <div class="row">
            <div class="col-sm-3">
            <?=form_open('form_validate/get_user_to_edit', "enctype='multipart/form-data' ");?>


                <?=form_close();?>
            </div>
            <div class="col-sm-6">

                <h2>Registration Validation</h2>
                <?=form_open('form_validate/save_user', "enctype='multipart/form-data' ");?>
                <input type="hidden" name="id" value="<?=$id;?>">
                <div class="form-group">
                    <label for="vName">Name</label>
                    <input type="text" class="form-control" id="vName" placeholder="Enter Name" name="vName" value="<?=empty(form_error('vEmail')) ? $vName : set_value('vEmail')?>">
                    <?=form_error('vName');?>
                </div>
                <div class="form-group">
                    <label for="vEmail">Email</label>
                    <input type="text" class="form-control" id="vEmail" placeholder="Enter email" name="vEmail" value="<?=empty(form_error('vEmail')) ? $vEmail : set_value('vEmail')?>">
                    <?=form_error('vEmail');?>
                </div>
                <div class="form-group">
                    <label for="vPassword">Password</label>
                    <input type="password" class="form-control" id="vPassword" placeholder="Enter password" name="vPassword" value="<?=empty(form_error('vPassword')) ? $vPassword : set_value('vPassword')?>">
                    <?=form_error('vPassword');?>
                </div>

                <div class="form-group">
                    <label for="vMobileNo">Mobile Number</label>
                    <input type="text" class="form-control" id="vMobileNo" placeholder="Enter mobile number" name="vMobileNo" value="<?=empty(form_error('vMobileNo')) ? $vMobileNo : set_value('vMobileNo')?>">
                    <?=form_error('vMobileNo');?>
                </div>

                <div class="form-group">
                    <label for="vCity">City</label>
                    <select class="form-control" id="vCity" name="vCity">
                        <option value="Delhi" <?=$vCity == 'Delhi' ? 'selected' : ''?>>Delhi</option>
                        <option value="Chandigarh" <?=$vCity == 'Chandigarh' ? 'selected' : ''?> >Chandigarh</option>
                        <option value="Noida" <?=$vCity == 'Noida' ? 'selected' : ''?> >Noida</option>
                        <option value="Lucknow" <?=$vCity == 'Lucknow' ? 'selected' : ''?> >Lucknow</option>
                    </select>
                    <?=form_error('vCity');?>
                </div>

                <a href="<?=base_url('form_validate/user_listing')?>" class="btn btn-primary mt-3">Back</a>

                <button type="submit" class="btn btn-primary mt-3"><?=$btn_name?></button>
                <!-- <a  href="<?=base_url('form_validate/delete_user?user_id=' . base64_encode($id));?>" class="btn btn-primary mt-3">Delete</a> -->
                <?=form_close()?>
            </div>
        </div>
    </div>
</body>
</html>

<script>
    var base_url= "<?=base_url();?>";
    setInterval(function(){ $(".form-error").hide(); }, 3000);
</script>
    <script src="<?=base_url('assets/js/general.js')?>"></script>
