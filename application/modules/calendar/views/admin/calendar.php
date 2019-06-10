<script
  src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"
  integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30="
  crossorigin="anonymous"></script>
<link rel="stylesheet" type"text="" css"="" href="<?php echo base_url('assets/admin/datepicker/nepali.datepicker.v2.2.min.css') ?>">
<script type="text/javascript" src="<?php echo base_url('assets/admin/datepicker/nepali.datepicker.v2.2.min.js') ?>"></script>

<section id="main-content" class="">
  <section class="wrapper">
    <div class="row"><style>.error{ color: red; }</style>
      <div class="col-lg-12">
        <section class="panel">
          <header class="panel-heading">
           Calendar
            <form role="form"  method="POST" action="" enctype="multipart/form-data">
              <input type="hidden" name="id" value="<?php echo !empty($drrdataeditdata[0]['id'])?$drrdataeditdata[0]['id']:'' ?>">
                <div class="form-group position-center">
                  <label for="name">Event Name:</label>
                  <input type="text" name="name" class="form-control" id="name" value="<?php echo !empty($drrdataeditdata[0]['name'])?$drrdataeditdata[0]['name']:'' ?>" placeholder="Please Enter Calendar Name">
                <?=form_error('name')?>
                </div>
                <div class="form-group position-center">
                  <label for="name">Description:</label>
                  <textarea rows="4" name="description" class="form-control" placeholder="Please Enter Description"><?php echo !empty($drrdataeditdata[0]['description'])?$drrdataeditdata[0]['description']:'' ?></textarea>
                <?=form_error('description')?>
                </div>
                <div class="form-group position-center">
                      <label for="name">Date:</label>
                      <input type='text' name="created_at" class="form-control" value="<?php echo !empty($drrdataeditdata[0]['created_at'])?$drrdataeditdata[0]['created_at']:'' ?>" id='nepaliDate'/>
                </div>
                <div class="form-group position-center">
                      <?php if($categories): ?>
                            <?php $dbcatid = !empty($drrdataeditdata[0]['type'])?$drrdataeditdata[0]['type']:'' ?>
                            <label for="type">प्रकोप छानुहोस : </label>
                            <select class="form-control" id="type" name="type" required>
                                <option value="0">----  प्रकोप छानुहोस  ----- </option>
                                <?php foreach ($categories as $key => $value) { ?>
                                <option value="<?php echo $value['id'] ?>" <?php if($dbcatid == $value['id']){ echo "Selected=Selected";}?>><?php echo  $value['name']; ?></option>
                                <?php } ?>
                            <?=form_error('type')?>
                            </select>
                        <?php endif; ?>
                </div>
                <div class="panel-body">
                    <div class="position-center">
                      <div class="form-group">
                        <div class="col-md-12">
                          <button type="submit" name="submit" class="btn btn-info"><?php if($drrdataeditdata) { echo "Update";}else{echo "Submit";} ?></button>
                         </div>
                        </div>
                    </div>
                </div>
            </form>
            </div>
          </div>
        </header>
      </section>
    </div>
  </div>
</section>
<script>
  $(document).ready(function(){
   
    $('#nepaliDate').nepaliDatePicker({
      ndpEnglishInput: 'englishDate'
    });
    $('#englishDate').change(function(){
      $('#nepaliDate').val(AD2BS($('#englishDate').val()));
    });

    $('#englishDate9').change(function(){
      $('#nepaliDate9').val(AD2BS($('#englishDate9').val()));
    });

    $('#nepaliDate9').change(function(){
      $('#englishDate9').val(BS2AD($('#nepaliDate9').val()));
    });
  });
</script>