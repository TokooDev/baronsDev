$("#table-rooms").DataTable({
    order:[0,'desc']
 });

 $("#table-students").DataTable({
    order:[0,'desc']
 });

 $(function () {
   $(".delete").on("click", function (event) {
       event.preventDefault();
       const eventInitiator = this;
       const id = parseInt(eventInitiator.getAttribute("href").match(/\d+/)[0]);
       const deleteRoom = (eventInitiator,icon,text,display=false) => {
           $.ajax({
               type: "POST",
               url: `${eventInitiator.getAttribute("href")}`,
               success: function (response) {
                   const grandFather = eventInitiator.parentElement.parentElement;
                   $(grandFather).remove();
                   if(display){
                       Swal.fire({
                           icon: `${icon}`,
                           title: 'Suppression',
                           text: `${text}`
                       });
                   }
               }
           });
       };
       const sweetDeleteRoom = title => {
           const swalWithBootstrapButtons = Swal.mixin({
               customClass: {
                   confirmButton: 'btn btn-success move-btn ml-3',
                   cancelButton: 'btn btn-danger'
               },
               buttonsStyling: false
           });
             
           swalWithBootstrapButtons.fire({
               title: `${title}`,
               text: "Voulez-vous vraiment la supprimer ?",
               icon: 'warning',
               showCancelButton: true,
               confirmButtonText: 'Oui supprimer!',
               cancelButtonText: 'Annuler!',
               reverseButtons: true
           }).then((result) => {
               if (result.value) {
                   deleteRoom(eventInitiator);
                   swalWithBootstrapButtons.fire(
                       'Suppression!',
                       'La chambre a bien été supprimé.',
                       'success'
                   )
               } else if (
                 /* Read more about handling dismissals below */
                   result.dismiss === Swal.DismissReason.cancel
               ) {
                   swalWithBootstrapButtons.fire(
                       'Annulation',
                       "La chambre n'a pas été supprimé",
                       'error'
                   )
               }
             });
       };
       $.ajax({
           type: "POST",
           url: `/chambres/${id}/isRoomVide`,
           dataType: "json",
           success: function (response) {
               const message = JSON.parse(response).message;
               if(message == "libre"){
                   sweetDeleteRoom("Chambre vide !!");
               }else if(message == "occupe"){
                   sweetDeleteRoom("Chambre occupée !!");
               }
           }
       });
   });
   $('#table-rooms').DataTable();
   $("#delete").on("click", function () {
       Swal.fire({
           icon: 'success',
           title: 'Suppression',
           text: 'La chambre a été supprimé'
       });
   });
});