<form  method="POST" action="" id="imagesMoreAdd"  enctype="multipart/form-data" >
    <div class="controls-field" id="b1">
        <div class="row">
            <div class="col-md-9">
                <div class="form-group">
                    <label for="exampleInputFile">Hazard Slider Image</label>
                    <input type="file" name="gly_path[]"  id="exampleInputFile">
                    <input name="id" type="hidden" value="<?php echo $id ?>">
                    <input name="nid" type="hidden" value="<?php echo $table ?>">
                    <input name="type" type="hidden" value="<?php echo $type ?>">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="submit">&nbsp;&nbsp;</label><br>
                    <button id="b1" class="btn btn-info add-more-gallery" type="button">+</button>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group col-md-12">
        <label for="submit">&nbsp;&nbsp;</label><br>
        <button  class="btn btn-primary submitCompany">Submit</button>
    </div>
</form>
</section>
<script type="text/javascript">
    $(document).off('click', '.add-more-gallery')
    $(document).on('click', '.add-more-gallery', function (e) {
        e.preventDefault();
        var count =$('div.controls-field').length;
        $(".add-more-gallery").on('click','.btnminus',function(){
                $(this).closest('.col-md-9').remove();
            });
        var addto = "#b" + count;
        next = count + 1;
        var newIn ='<div class="controls-field" id="b'+next+'"><div class="row"><div class="col-md-9"> <div class="form-group"> <label for="exampleInputFile">Hazard Slider Image '+next+'</label> <input type="file" name="gly_path[]" id="exampleInputFile"> </div></div><div class="col-md-3"> <div class="form-group"> <label for="submit">&nbsp;&nbsp;</label> <br><a href="javascript:void(0)" class="btn btn-danger btnminus">x</a></div></div></div></div>';
        var newInput = $(newIn);
        $(addto).after(newInput);
    });

</script>

