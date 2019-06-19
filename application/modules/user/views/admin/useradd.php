<script
  src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"
  integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30="
  crossorigin="anonymous"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/admin/js/bootstrap-datepicker.js') ?>"></script>
<!-- <link rel="stylesheet" type"text="" css"="" href="<?php echo base_url('assets/admin/datepicker/nepali.datepicker.v2.2.min.css') ?>">
<script type="text/javascript" src="<?php echo base_url('assets/admin/datepicker/nepali.datepicker.v2.2.min.js') ?>"></script> -->

<section id="main-content" class="">
  <section class="wrapper">
    <div class="row"><style>.error{ color: red; }</style>
      <div class="col-lg-12">
        <section class="panel">
          <header class="panel-heading">
           Create User
            <form role="form"  method="POST" action="" enctype="multipart/form-data">
              <input type="hidden" name="id" value="<?php echo !empty($users[0]['user_id'])?$users[0]['user_id']:'' ?>">
                <div class="form-group">
                  <div class="col-sm-3">
                    <label for="name">Full Name:</label>
                      <input type="text" name="name" class="form-control" id="name" value="<?php echo !empty($users[0]['username'])?$users[0]['username']:'' ?>" placeholder="Please Enter User Name">
                    <?=form_error('name')?>
                    </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-3">
                    <label for="email">Email:</label>
                      <input type="text" name="email" class="form-control" id="email" value="<?php echo !empty($users[0]['email'])?$users[0]['email']:'' ?>" placeholder="Please Enter User Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                    <?=form_error('email')?>
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="control-label">Select Gender</label>
                    <div class="mt-checkbox-inline mt-radio-list" data-error-container="#form_2_membership_error">
                        <?php $dbgender = !empty($users[0]['gender'])?$users[0]['gender']:'' ?>
                        <label class="mt-radio">
                            <input type="radio" name="gender" value="Male" <?php if($dbgender == "Male") echo "checked"; ?>> Male
                            <span></span>
                        </label>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <label class="mt-radio">
                            <input type="radio" name="gender" value="Female" <?php if($dbgender == "Female") echo "checked"; ?>> Female
                            <span></span>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-3">
                    <label for="exampleInputFile"> Select Visiting Purpose</label>
                     <?php $dbpurpose = !empty($users[0]['purpose'])?$users[0]['purpose']:'' ?>
                    <select name="purpose" class="form-control">
                      <option value="">-----  Select Visiting Purpose ------</option>
                      <option value="Religious Visit" <?php if($dbpurpose == "Religious Visit") echo "selected=selected";?>>Religious Visit</option>
                      <option value="Sight Seeing" <?php if($dbpurpose == "Sight Seeing") echo "selected=selected";?>>Sight Seeing</option>
                      <option value="Others" <?php if($dbpurpose == "Other") echo "selected=selected"; ?>>Other</option>
                    </select>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="form-group">
                  <div class="col-sm-3">
                    <label for="contact_num">Contact Number:</label>
                      <input type="text" name="contact_num" class="form-control" id="contact_num" value="<?php echo !empty($users[0]['contact_num'])?$users[0]['contact_num']:'' ?>" placeholder="Please Enter User Contact Number">
                    <?=form_error('contact_num')?>
                    </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-3">
                    <label for="name">Validity Start Date:</label>
                    <input type='text' name="start_date" class="form-control form-control-inline input-medium default-date-picker" value="<?php echo !empty($users[0]['start_date'])?$users[0]['start_date']:'' ?>" id='' autocomplete="off" placeholder="Please Select Validity Start Date">
                     <?=form_error('start_date')?>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-3">
                    <label for="name">Validity End Date:</label>
                    <input type='text' name="end_date" class="form-control form-control-inline input-medium default-date-picker" value="<?php echo !empty($users[0]['end_date'])?$users[0]['end_date']:'' ?>" autocomplete="off" placeholder="Please Select Validity End Date">
                     <?=form_error('end_date')?>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-3">
                  <label for="exampleInputFile"> Select Country</label>
                  <?php $dbcountry = !empty($users[0]['country'])?$users[0]['country']:'' ?>
                    <select name="country" class="form-control">
                      <option value="">----- Select Country ------</option>
                      <?php 
                      if($country){ 
                      foreach ($country as $key => $value) {  ?>
                        <option value="<?php echo $value['country_name']  ?>" <?php  if($dbcountry == $value['country_name'] ) echo "Selected=Selected"; ?>><?php echo $value['country_name'] ?></option>
                      <?php }  } ?>
                    </select>
                    <?php echo form_error('country'); ?>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-12">
                    <button type="submit" name="submit" class="btn btn-info"><?php if($users) { echo "Update";}else{echo "Submit";} ?></button>
                   </div>
                </div>
                <div class="clearfix"></div>
            </form>
            </div>
          </div>
        </header>
      </section>
    </div>
  </div>
</section>
<script>
  // $(document).ready(function(){
  //   $('#nepaliDate').nepaliDatePicker({
  //     ndpEnglishInput: 'englishDate'
  //   });
  //   $('#englishDate').change(function(){
  //     $('#nepaliDate').val(AD2BS($('#englishDate').val()));
  //   });

  //   $('#englishDate9').change(function(){
  //     $('#nepaliDate9').val(AD2BS($('#englishDate9').val()));
  //   });

  //   $('#nepaliDate9').change(function(){
  //     $('#englishDate9').val(BS2AD($('#nepaliDate9').val()));
  //   });
  //   $('#nepaliDate2').nepaliDatePicker({
  //     ndpEnglishInput: 'englishDate2'
  //   });
  //   $('#englishDate2').change(function(){
  //     $('#nepaliDate2').val(AD2BS($('#englishDate2').val()));
  //   });
  // });
  //date picker start


$(function(){
    window.prettyPrint && prettyPrint();
    $('.default-date-picker').datepicker({
        format: 'yyyy-dd-mm',
        autoclose: true
    });
  });
</script>