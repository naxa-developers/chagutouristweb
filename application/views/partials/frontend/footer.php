 </main>  
    <footer class="site-footer pdtb-50">
        <span class="scroll-up">
            <i class="la la-angle-double-up"></i>
        </span>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="footer-widget">
                        <h4>महत्वपूर्ण साइटहरु</h4>
                        <div class="ft-content">
                            <ul class="ft-links">
                                <li><a target="_blank" href="http://www.moha.gov.np/">गृह मन्त्रालय</a></li>
                                <li><a target="_blank" href="http://neoc.gov.np/en/">राष्ट्रीय आपातकालीन परिचालन केन्द्र</a></li>
                                <li><a target="_blank" href="http://drrportal.gov.np/">डी. आर्. आर् पोर्टल 
</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="footer-widget">
                        <h4>हाम्रो सामाजिक सञ्जाल</h4>
                        <div class="ft-content">
                            <ul class="social-links">
                                <?php if(FACEBOOK): ?>
                                <li>
                                    <a href="<?php echo FACEBOOK ?>">
                                        <i class="la la-facebook"></i>
                                    </a>
                                </li>
                                <?php endif; if(TWITTER): ?>
                                <li>
                                    <a href="<?php echo TWITTER ?>">
                                        <i class="la la-twitter"></i>
                                    </a>
                                </li>
                                <?php endif; if(GOOGLE): ?>
                                <li>
                                    <a href="?php echo GOOGLE ?>">
                                        <i class="la la-youtube"></i>
                                    </a>
                                </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="footer-widget">
                        <h4>सम्पर्क</h4>
                        <div class="ft-content">
                            <ul class="contact-links">
                                <li><a href="#"><i class="la la-phone"></i><label>फोन :</label></a></li>
                                <li><a href="#"><i class="la la-envelope"></i><label>इमेल :</label>info@iset.com</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer> <section class="copyright">
                    ©
                    <?php echo date('Y'); ?>,
                    <span>Developed by <a href="https://naxa.com.np/" target="_blank">Naxa</a> <?php echo !empty(COPY_TEXT)?COPY_TEXT:'' ?></span>
                </section>
    <!-- jquery library start -->   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="<?php echo base_url();?>assets/frontend/newdimsjs/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/frontend/newdimsjs/owl.carousel.min.js"></script>
    <script src="<?php echo base_url();?>assets/frontend/newdimsjs/jquery.magnific-popup.min.js"></script>
    <script src="<?php echo base_url();?>assets/frontend/newdimsjs/jquery.nice-select.min.js"></script>
    <script src="<?php echo base_url();?>assets/frontend/newdimsjs/aos.js"></script>
    <script src="<?php echo base_url();?>assets/frontend/newdimsjs/jquery.slimscroll.min.js"></script>
    
    <script src="<?php echo base_url();?>assets/frontend/newdimsjs/script.js"></script>
  </body>
</html>

 <!--    <script>
        $.extend(
        {
            redirectPost: function(location, args)
            {
                var form = $('<form></form>');
                form.attr("method", "post");
                form.attr("action", location);
                $.each( args, function( key, value ) {
                    var field = $('<input></input>');
                    field.attr("type", "hidden");
                    field.attr("name", key);
                    field.attr("value", value);
                    form.append(field);
                });
                $(form).appendTo('body').submit();
            }
        });
        $(document).off('click','#subscribeButton');
        $(document).on('click','#subscribeButton',function(){
            var title= $(this).data('title');
            $("#subscribeForm").validate({
                errorElement: 'p',
                errorClass:'text-danger',
                //validClass:'success',
                highlight: function (element, errorClass, validClass) {
                    $(element).parents("div.form-group").addClass('has-error').removeClass('has-success');
                },
                unhighlight: function (element, errorClass, validClass) {
                $(element).parents("div.form-group").removeClass('has-error');
                $(element).parents(".error").removeClass('has-error').addClass('has-success');
            },
            rules: {
                email: {
                    required: true,
                    email: true,
                },
                message: {
                    required: true,
                }
            },
            subject: {
                required: errorMessage.required
            },
            messages: {
                email: {
                    required: errorMessage.required,
                    email: errorMessage.email
                }
            },
            errorPlacement: function(e, s) {
                e.appendTo(s.parent())
            },
            submitHandler: function(e) {
                $('#golobalMoadl').modal('show');
                $('#globalTitleModal').html(title);

                jQuery.ajax({
                        type: "json",
                        method:"POST",
                        url: '<?php echo base_url() ?>home/subscribe_form',
                        datatype: 'html',
                        data: $('form#subscribeForm').serialize(),
                        beforeSend: function(){
                        },
                    success: function(jsons) {
                        data = jQuery.parseJSON(jsons);
                        if (data.statuses == 'success') {
                            $( "#globalModalId" ).html(data.template);

                        } else {
                            $( "#globalModalId" ).html(data.message);
                        }
                        setTimeout(function(){
                        $("#submitstatus").html('');
                        },4000);
                    }
                });
            }
        })
    });
    </script>
    <script type="text/javascript">
        $(document).off('click','.CatchName');
        $(document).on('click','.CatchName',function(){
            var name = $(this).data('name');
            if(name == "food") {
                //$("#myInput").attr("onkeyup", "functionPrakash()");
                document.getElementsByName("terminology")[0].addEventListener("keyup", function(event) {
                    validate_numb("terminology")
                });
            }
        });-->
        <script type="text/javascript">
            $('.ChangeLanguage').on('change',function(e) {
            var url  = window.location.href;
            var language=$("#languageCode option:selected").val();//$(this).data('language'); //alert(language);
            var action="<?php echo base_url() ?>/home/change_language";
            $.ajax({
            type: "POST",
            url: action,
            dataType: 'html',
                data: {language:language},
                success: function(jsons)
                {
                 data = jQuery.parseJSON(jsons);
                  if(data.status=='success'){
                    setTimeout(function(){
                    window.location.href = url;
                     }, 500);
                  }
              }
            });
        });

        // conatct load table
        // $(".contact_tab").click(function(){
        //     $("#contact_tbl").html('');
        //     var sub_cat = $(this).attr('id');
        //     var cat = $(this).attr('name');
        //     $.ajax({
        //         type: "json",
        //         method:"POST",
        //         url: '<?php echo base_url() ?>contact/get_contact_tbl',
        //         datatype: 'html',
        //         data: {category:cat,sub_category:sub_cat},
        //         beforeSend: function(){
        //         },
        //         success: function(result) {
        //         //console.log(result);
        //         $("#contact_tbl").html(result);
        //         }
        //     });
        // });
        // $( "#contact_category" ).change(function() {
        //     var cat=$(this).val();
        //     var url='<?php echo base_url()?>contact?cat='+cat;
        //       window.location=url;
        // });

        // $(document).ready(function () {
        //     $("#searhddr").keyup(function () {
        //         var keyword = $('#searhddr').val();
        //         var action="<?php echo base_url() ?>/dictionary/ajaxAutoComplete";
        //         $.ajax({
        //             type: "POST",
        //             url: action,
        //             dataType: 'html',
        //             data: {keyword:keyword},
        //             beforeSend: function(){
        //                 $('#autolist').html();
        //             },
        //             success: function(jsons)
        //             {
        //                 data = jQuery.parseJSON(jsons);
        //                 $("#autolist").addClass("newAutolist");
        //                 if(data.status=='success'){
        //                     $('#autolist').html(data.template);
        //                 }
        //             }
        //         });
        //     });


        // });
      
   </script> 
