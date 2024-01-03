$(function () {
$('.delete-data').on('click',async function () {
    var id = $(this).data('id');
   const swalWithBootstrapButtons = Swal.mixin({
     customClass: {
       confirmButton: 'btn btn-success',
       cancelButton: 'btn btn-danger ml-2'
     },
     buttonsStyling: false
   })
    const {value: password}= await swalWithBootstrapButtons.fire({
           title: 'Etes vous sure?',
           text: "Cette action est définitive",
           icon: 'warning',
           showCancelButton: true,
           confirmButtonText: 'Oui, supprimer!',
           cancelButtonColor: '#d33',
           cancelButtonText: 'Non, annuler',
           input: 'password',
         inputPlaceholder: 'Entrez le mot de passe administrateur',
         confirmButtonColor: '#3085d6',
         inputValidator: (value) => {
           if (!value) {
             return 'Ce champ est requis'
           }
           else{
             // ajax
           $.ajax({
             type:"DELETE",
             url: "{{ url('citoyens') }}"+'/'+id,
             data: { id: id, password: value},
             dataType: 'json',
             success: function(res){
               console.log(res);
               if(res['success']){
                 const Toast = Swal.mixin({
                   toast: true,
                   position: 'top-end',
                   showConfirmButton: false,
                   timer: 3000,
                   timerProgressBar: true,
                   didOpen: (toast) => {
                     toast.addEventListener('mouseenter', Swal.stopTimer)
                     toast.addEventListener('mouseleave', Swal.resumeTimer)
                   }
                 })
                 Toast.fire({
                   icon: 'success',
                   title: res['success']
                       })
               }
                 if(res['error']){
                 swalWithBootstrapButtons.fire(
                         'Woops!',
                          res['error'],
                         'error'
                     )
               }
               var oTable = $('#datatable').dataTable();
               oTable.fnDraw(false);
             }
           });
           }
       }
         });
    });
})
