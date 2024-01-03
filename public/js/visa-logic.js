 $(function () {
    $("#toast-container").fadeOut(12000);

    $("#dateDepart").change(function(e){

     //adding months function
     function addMonth(date, months){
      var d =date.getDate();
      date.setMonth(date.getMonth()+ +months);
      if (date.getDate() !=d) {
        date.setDate(0);
      }
      //return the expiration date
      return date;
     }//end of the function

     //adding days function
     function addDay(depart, days){
      var date =new Date(depart);
      date.setDate(date.getDate()+days);
      //return the expiration date
      return addMonth(date,1);
     }//end of the function
     
    //convert the date to the right format
    function conv(dates){

     var date=new Date(dates),
           yr=date.getFullYear(),
           month=date.getMonth() < 10 ? '0' + date.getMonth() :date.getMonth(),
           day=date.getDate() < 10 ? '0' + date.getDate() : date.getDate(),
           newDate=yr + '-' + month +'-'+day;
      return newDate;
    }

     //get the visa type
      var type= $("#visa_type").val();
      //get the departure date of the demander
      var depart=$("#dateDepart").val();

     //the logic if the right visa type is selected
     if (type=="Transit") {
          //add 2 days to the current date selected
         var endDate=addDay(depart,2).toString();
         var newDates=conv(endDate);
           $("#date_expiration").val(newDates);
            $("#date_expirations").val(newDates);
     }
     else if (type=="Court séjour") {
        //add 30 days to the current date
         var endDate=addDay(depart,30).toString();
         var newDates=conv(endDate);
           $("#date_expiration").val(newDates);
            $("#date_expirations").val(newDates);
     }
     else if (type=="Double entrée") {
        //add 6 months to the current date
         var endDate=addMonth(new Date(depart),4).toString();
         var newDates=conv(endDate);
           $("#date_expiration").val(newDates);
            $("#date_expirations").val(newDates);
     }
     else if (type=="Entrée multiple") {
        //add 6 months to the current date
         var endDate=addMonth(new Date(depart),4).toString();
         var newDates=conv(endDate);
           $("#date_expiration").val(newDates);
            $("#date_expirations").val(newDates);
     }
     else{
        //add nothing to the current date
         $("#date_expirations").val(conv(depart));
          $("#date_expiration").val(conv(depart));
     }   
  });

   $("#visa_type").change(function(){
      //get the visa type
      var type= $("#visa_type").val();
     //show the time of the visa type selected
     if (type=="Transit") {
           $("#temps").val("2 jours");
           $("#date_expirations").val("");
          $("#dateDepart").val("");
     }
     else if (type=="Court séjour") {
           $("#temps").val("30 jours");
           $("#date_expirations").val("");
          $("#dateDepart").val("");
     }
     else if (type=="Double entrée") {
           $("#temps").val("90 jours");
          $("#date_expirations").val("");
          $("#dateDepart").val("");
     }
     else if (type=="Entrée multiple") {
           $("#temps").val("90 jours");
          $("#date_expirations").val("");
          $("#dateDepart").val("");
     }
     else{
          $("#temps").val("");
     } }); 
});