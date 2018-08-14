<?php
    /* Paging */
    echo isset($list_pagination) ? $list_pagination : '';
?>

<div class="row">
    <div class="span12">
        <div class="well">
            <center><h3>Copyright &copy; VIMCC</h3></center>
        </div>
    </div>
</div>

        </div>
    </body>
        <!--<link rel="stylesheet" href="/resources/demos/style.css">-->
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        
        <!-- Đánh giá STAR -- >
        <script src="<?php echo base_url() . 'customs/js/jquery.barrating.js' ?>"></script>
        <script src="<?php echo base_url() . 'customs/js/customs.js' ?>"></script> 
        
        <!-- API Đọc từ -->
        <script src='https://code.responsivevoice.org/responsivevoice.js'></script>
        
        <script type="text/javascript">
        $(function() {
           $('#example').barrating({
             theme: 'fontawesome-stars'
           });
        });
     </script>
        <script  type="text/javascript">
            $( function() {
                var availableTags = [
                  "ActionScript","AppleScript","Asp","BASIC","C","C++","Clojure","COBOL","ColdFusion",
                  "Erlang","Fortran","Groovy","Haskell","Java","JavaScript","Lisp","Perl","PHP",
                  "Python","Ruby","Scala","Scheme",                 
                ];
                $( "#tags" ).autocomplete({
                  source: availableTags
                });
                
                /*$.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>" + "index.php/HomeController/searchAutoComplete",
                    dataType: 'json',
                    data: {textSearch: $('#txtTextSearch').val(), language: $("#ddlLanguage").val()},
                    success: function(data){
                        console.log(data);
                        $( "#txtTextSearch" ).autocomplete({
                            source: data
                        });
                    }
                });*/
               /*$('#txtTextSearch').bind('keypress', function () {
                    setTimeout(function () { 
                        var stringText = $('#txtTextSearch').val();
                        var lan = $("#ddlLanguage").val();
                        jQuery.ajax({
                            type: "POST",
//                            url: "<?php echo base_url(); ?>" + "index.php/HomeController/searchAutoComplete",
//                            dataType: 'json',
//                            data: {textSearch: stringText, language: lan},
//                            success: function(data){
//                                
//                                //var result = JSON.parse(res);
//                                console.log(result);
//                                
//                                
//                                $("#suggesstion-box").show();
//                                $("#suggesstion-box").html(data);
//                                $("#txtTextSearch").css("background","#FFF");
                            }
                        });
                    }, 1);
                });*/
                <?php
                    if(isset($_COOKIE['VI'])){
                        $dataVI = $_COOKIE['VI'];
                        echo "var dataVI = " . $dataVI . ";";
                    }
                    if(isset($_COOKIE['EN'])){
                        $dataEN = $_COOKIE['EN'];
                        echo "var dataEN = " . $dataEN . ";";
                    }
                ?>
                /*var lan = $("#ddlLanguage").val();
                if (typeof dataEN != 'undefined'){
                    var data = dataEN;
                    if(lan == 'vi'){
                        data = dataVI;
                    }
                    $( "#txtTextSearch" ).autocomplete({
                        source: function(request, response) {
                            //alert($("input[name='AZ']").val());
                            var startWidth = $("input[name='AZ']:checked").val();
                            if(startWidth == 'A'){
                                var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(request.term), "i");
                                response($.map(data, function(item) {
                                    if (matcher.test(item)) {
                                        return (item);
                                    }
                                }));
                            }else{
                                response($.map(data, function(item) {
                                    return (item);
                                }));
                            }
                        }
                    });
                    $("#ddlLanguage").change(function(){
                        var lan = $(this).val();

                        if(lan == 'en'){
                            $("input[name='AZ'][value='A']").prop('checked',true);
                            $( "#txtTextSearch" ).autocomplete({
                               //source: dataEN,
                                source: function(request, response) {
                                   //alert($("input[name='AZ']").val());
                                    var startWidth = $("input[name='AZ']:checked").val();
                                    if(startWidth == 'A'){
                                        var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(request.term), "i");
                                        response($.map(dataEN, function(item) {
                                            if (matcher.test(item)) {
                                                return (item);
                                            }
                                        }));
                                    }
                                }
                            });

                        }else{
                            $("input[name='AZ'][value='I'").prop('checked',true);
                            $( "#txtTextSearch" ).autocomplete({
                                source: dataVI,
                            });
                        }
                    });

                    $("input[name='AZ']").change(function(){
                        var startWidth = $("input[name='AZ']:checked").val();
                        var lan = $("#ddlLanguage").val();
                        if(lan == 'vi'){
                            data = dataVI;
                        }else{
                            data = dataEN;
                        }

                        if(startWidth == 'A'){
                             $( "#txtTextSearch" ).autocomplete({
                                source: function(request, response) {
                                    var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(request.term), "i");
                                    response($.map(data, function(item) {
                                        if (matcher.test(item)) {
                                            return (item);
                                        }
                                    }));
                                 }
                            });
                        }else{

                            $( "#txtTextSearch" ).autocomplete({
                                source: data
                            });
                        }
                    });
                }*/
            });
            var searchRequest = null;

    $( function() {
        var minlength = 1;
        
        $("#txtTextSearch").keyup(function () {
            var that = this,
            value = $(this).val();
            var lan = $("#ddlLanguage").val();
            var startWidth = $("input[name='AZ']:checked").val();
            
            if (value.length >= minlength ) {
                if (searchRequest != null) 
                    searchRequest.abort();
                    searchRequest = $.ajax({
                    type: "POST",
                    //url: "sample.php",
                    //data: {'search_keyword' : value},
                    //dataType: "text",
                    url: "<?php echo base_url(); ?>" + "index.php/TranslateController/searchAutoComplete",
                    dataType: 'json',
                    data: {textSearch: value, language: lan, startWidth: startWidth},
                    success: function(data){
                        if(data.length > 0){
                            $( "#txtTextSearch" ).autocomplete({
                                source: data
                            });
                        }
                    }
//                    success: function(msg){
//                        //we need to check if the value is the same
//                        if (value==$(that).val()) {
//                        //Receiving the result of search here
//                        }
//                    }
                });
                
                // Đọc từ
                $("#speak").attr('onclick', 'responsiveVoice.speak("' + value + '")');
                //<input onclick='responsiveVoice.speak(value);' type='button' value='🔊 Play' />
            }
        });
    });
            /*function selectCountry(val) {
                $("#txtTextSearch").val(val);
                $("#suggesstion-box").hide();
            }*/
            
            function getDataSearch(inputData){
                
            }
        </script>
</html>