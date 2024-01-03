     
$(document).ready(function(){
    $("#search-box").keyup(function(){
      
        $.ajax({
        type: "POST",
        url: "ajax_autocomplete/getProf.php",
        data:'keyword='+$(this).val(),
        // beforeSend: function(){
        //     $("#search-box").css("background","#FFF url(images/LoaderIcon.gif) no-repeat 165px");
        // },
        success: function(data){
            $("#suggesstion-box").fadeIn();
            $("#suggesstion-box").html(data);
            $("#search-box").css("background","#FFF");
        }
        });
    });
});
function selectTeacher(val) {
    $("#search-box").val(val);
    $("#suggesstion-box").fadeOut();
}