<section id="main-content" class="">
   <section class="wrapper">
        <div class="row"><style>.error{ color: red; }</style>
            <div class="col-lg-12">
                <div class="portlet light portlet-fit portlet-form bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-settings font-red"></i>
                            <span class="caption-subject font-red sbold uppercase">Quiz</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                    <style type="text/css">.error { color: red; }</style>
                    <form action="" method="post" class="form-horizontal">
                        <div class="form-body">
                            <div class="form-group">
                                <div class="col-sm-3">
                                    <label>Question Category</label>
                                    <select class="form-control optionType" name="category_id" data- id="optionManu">
                                    <?php $dbcatid = !empty($drrdataeditdata[0]['cat_id'])?$drrdataeditdata[0]['cat_id']:'' ?>
                                        <option selected="selected" value="">---Select Quiz For---</option>
                                        <?php foreach($quizcateory as $key=>$cat): ?>
                                            <option value="<?php echo $cat['id'] ?>" <?php if($dbcatid ==$cat['id']) { echo "selected"; } ?>><?php echo $cat['name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?=form_error('category_id') ?>
                                </div>
                                <div class="col-md-3">
                                    <label class="control-label">Question 
                                        <span class="required" aria-required="true"> * </span>
                                    </label>
                                    <input type="text" name="question" data-required="1" class="form-control" placeholder="Enter Question" value="<?php echo !empty($drrdataeditdata[0]['question_type'])?$drrdataeditdata[0]['question_type']:'' ?>"> 
                                    <?=form_error('description')?>
                                </div>
                                <div class="col-md-3">
                                    <label class="control-label">Do You Want To Publish ?</label>
                                    <div class="mt-checkbox-inline mt-radio-list" data-error-container="#form_2_membership_error">
                                        <?php $dbcatid = !empty($drrdataeditdata[0]['status'])?$drrdataeditdata[0]['status']:'' ?>
                                        <label class="mt-radio">
                                            <input type="radio" name="status" value="1"> Yes
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="status" value="0"> No
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <label>Question Type</label>
                                    <select class="form-control optionType" id="optionType" name="question_type" >
                                      <?php $qtid = !empty($drrdataeditdata[0]['question_type'])?$drrdataeditdata[0]['question_type']:'' ?>
                                        <option selected="selected"  value="checkbox" <?php if($qtid == 'checkbox') { echo "selected";} ?>>Checkbox</option>
                                        <!-- <option value="radio" <?php// if($qtid == 'radio' ){ echo "selected";} ?>>Radio</option> -->
                                    </select>
                                     <?=form_error('question_type')?>
                                </div>
                            </div>
                            <div class="addOptionRow"></div>
                            <div class="form-group" id="radioOptionNew" style="display: none">
                                <div class="col-md-3">
                                    <label></label>
                                    <div class="mt-radio-list" data-error-container="#form_2_membership_error">
                                        <span> Check The right Answer <input type="checkbox" data-id="1" class="rightAnswer" name="right_answer[]" value="y" onclick="$(this).attr('value', this.checked ? 1 : 0)"></input>
                                       
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label">Please Enter Otption 
                                        <span class="required" aria-required="true"> * </span>
                                    </label>
                                    <input type="text" name="rdiooprtion[]" class="form-control" placeholder="Enter Please Enter Otption " > 
                                </div>
                                <div class="col-md-3">
                                    <br><button  class="btn btn-info" id="addOptionsMore" type="button">+</button>
                                    <label class="control-label"></label>
                                </div>
                            </div>
                            <div class="addCheckOptionRow"></div>
                            <div class="form-group" id="checkOptionsNew" style="display: none">
                                <div class="col-md-3">
                                    <label></label>
                                    <div class="mt-checkbox-list">
                                    <span>Check The right Answer <input type="checkbox" class="rightAnswer" data-id="1" name="right_answer_radio[]" onclick="$(this).attr('value', this.checked ? 1 : 0)"></input> <input type="hidden" name="checkboxoption" id="checkrightAnswer1" value="2"></input></span>
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <label class="control-label">Please Enter Otption 
                                        <span class="required" aria-required="true"> * </span>
                                    </label>
                                    <input type="text" name="checkboxoption[]" class="form-control" placeholder="Enter Please Enter Otption"> 
                                </div>
                                <div class="col-md-3">
                                    <br><button  class="btn btn-info" id="addCheckOption" type="button">+</button>
                                    <label class="control-label"></label>
                                </div>
                            </div>
                            <div class="addDropdownOptionRow"></div>
                            <div class="form-group" id="dropDownNew" style="display: none">
                                <div class="col-md-3">
                                    <label>Question Type Dropdown</label>
                                    <div class="mt-checkbox-list">
                                        <label class="mt-checkbox mt-checkbox-outline">
                                            <select class="form-control">
                                                <option>Select</option>
                                            </select>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label">Please Enter Dropdown Otption 
                                        <span class="required" aria-required="true"> * </span>
                                    </label>
                                    <input type="text" name="dropdownoption[]" class="form-control" placeholder="Enter Please Enter Dropdown Otption"> 
                                </div>
                                <div class="col-md-3">
                                    <br><button  class="btn btn-info" id="addDropdownOption" type="button">+</button>
                                    <label class="control-label">Click Plus Option To Add Another Dropdown option</label>
                                </div>
                            </div>
                             <div class="form-group">
                                <div class="col-sm-6">
                                    <label>Wrong Description</label>
                                    <textarea name="wrong_answer" rows="6" class="form-control"><?php echo !empty($drrdataeditdata[0]['wrong_answer'])?$drrdataeditdata[0]['wrong_answer']:'' ?></textarea>
                                    <?=form_error('wrong_answer')?>
                                </div>
                                <div class="col-sm-6">
                                    <label>Right Description</label>
                                    <textarea name="answer" rows="6" class="form-control"><?php echo !empty($drrdataeditdata[0]['answer'])?$drrdataeditdata[0]['answer']:'' ?></textarea>
                                    <?=form_error('answer')?>
                                </div>
                            </div> 
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn btn-success"><?php if(isset($data['row'])) { echo "Update"; }else{echo  "Submit";} ?></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </div>
    </section>
</section>
<script type="text/javascript">
    $(document).off('.datepicker.data-api');
</script>
<script>

    $(".rightAnswer").change(function () {
        var recentid = $(this).data('id');
        // alert(recentid);
        // console.log(recentid);
        if ($(this).prop("checked")) {
            $(this).attr('value', 1);
            $("#checkrightAnswer1").attr('value', 1);
            $("#checkrightAnswer2").attr('value', 1);
            $("#checkrightAnswer3").attr('value', 1);
            $("#checkrightAnswer4").attr('value', 1);
            $("#checkrightAnswer5").attr('value', 1);
        }
        else {
           $(this).attr('value', 1);
        }
    });

    $(document).off('click','#addOptionsMore');
    $(document).on('click','#addOptionsMore', function(){ 
        $(".addOptionRow").on('click','.btnminus',function(){
            $(this).closest('.form-group').remove();
        });
        var count = $('.addOptionRow .btnminus').length+1;
        $('.addOptionRow').append('<div class="form-group"> <div class="col-md-3"> <label></label> <div class="mt-radio-list" data-error-container="#form_2_membership_error"> <label class="mt-radio"> <span> Check The right Answer <input type="checkbox" name="right_answer[]" onclick="$(this).attr(\'value\', this.checked ? 1 : 0)"></input></span> </div></div><div class="col-md-6"> <label class="control-label">Please Enter Otption <span class="required" aria-required="true"> * </span> </label> <input id="radio_option'+count+'" type="text" name="rdiooprtion[]" class="form-control" placeholder="Enter Please Enter Otption"> </div><div class="col-md-3"> <br><button class="btn btn-danger btnminus" type="button">x</button> <label class="control-label"></label></div></div>');

    });
    $(document).off('click','#addCheckOption');
    $(document).on('click','#addCheckOption', function(){ 
        $(".addCheckOptionRow").on('click','.btnminus',function(){
            $(this).closest('.form-group').remove();
        });
        var count = $('.addCheckOptionRow .btnminus').length+1;
        var ncount =count+1;
        $('.addCheckOptionRow').append('<div class="form-group"> <div class="col-md-3"> <label></label> <div class="mt-checkbox-list"> <label class="mt-checkbox mt-checkbox-outline"> </label> <span>Check The right Answer <input type="checkbox" class="rightAnswer"  name="right_answer_radio[]" data-id="'+ncount+'"  onclick="$(this).attr(\'value\', this.checked ? 1 : 0)"></input><input type="hidden" name="checkboxoption" id="checkrightAnswer'+ncount+'" value="2"></span></div></div><div class="col-md-6"> <label class="control-label">Please Enter Otption <span class="required" aria-required="true"> * </span> </label> <input id="check'+count+'" type="text" name="checkboxoption[]" class="form-control" placeholder="Enter Please Enter Otption "> </div><div class="col-md-3"> <br><button class="btn btn-danger btnminus " type="button">x</button> <label class="control-label"></label></div></div>');

    });
    $(document).off('click','#addDropdownOption');
    $(document).on('click','#addDropdownOption', function(){ 
        $(".addDropdownOptionRow").on('click','.btnminus',function(){
            $(this).closest('.form-group').remove();
        });
        var count = $('.addDropdownOptionRow .btnminus').length+1;
        $('.addDropdownOptionRow').append('<div class="form-group" id="dropDownNew"><div class="col-md-3"> <label>Question Type Dropdown</label><div class="mt-checkbox-list"> <label class="mt-checkbox mt-checkbox-outline"> <select class="form-control"><option>Select</option> </select> </label></div></div><div class="col-md-6"> <label class="control-label">Please Enter Dropdown Otption <span class="required" aria-required="true"> * </span> </label> <input type="text" name="dropdownoption[]" class="form-control" placeholder="Enter Please Enter Dropdown Otption"></div><div class="col-md-3"><br><button class="btn btn-danger btnminus" type="button">x</button> <label class="control-label"></label></div></div>');

    });
    $(document).on('change','.optionType',function(){
        var type = $('#optionType').val();
        if(type == 'radio')
        {
            $('#radioOptionNew').show();
        }else{
            $('#radioOptionNew').hide();
        }
        if(type == 'checkbox')
        {
            $('#checkOptionsNew').show();
        }else{
            $('#checkOptionsNew').hide();
        }
        if(type == 'dropdown')
        {
            $('#dropDownNew').show();
        }else{
            $('#dropDownNew').hide();
        }
        if(type == 'star_rating')
        {
            $('#starRating').show();
        }else{
            $('#starRating').hide();
        }
        
    });
</script>