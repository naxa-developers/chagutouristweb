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

                 <div class="form-group">
                  <div class="col-md-3"><div class="clearfix"></div>
                     <label for="name"></label>
                    <button type="submit" name="submit" class="btn btn-info" style="margin-top: 23px;" ><?php if($users) { echo "Update";}else{echo "Submit";} ?></button>
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
