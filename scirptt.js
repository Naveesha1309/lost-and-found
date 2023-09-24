window.onload = function exampleFunction() {
  console.log('The Script will load now.');
}


function deleteRow(regno) {
  console.log("Delete button clicked for registration number:", regno);

  if (confirm("Are you sure you want to delete this entry?")) {
            // Send an AJAX request to the PHP script for deletion
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "delete.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Refresh the page after successful deletion
                    window.location.reload();
                }
            };
            xhr.send("regno=" + regno);
        }
}



// function deleteRow(regno) {
//     if (confirm("Are you sure you want to delete this entry?")) {
//         // Send an AJAX request to the PHP script for deletion
//         var xhr = new XMLHttpRequest();
//         xhr.open("POST", "delete.php", true);
//         xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//         xhr.onreadystatechange = function() {
//             if (xhr.readyState === 4 && xhr.status === 200) {
//                 // Refresh the page after successful deletion
//                 window.location.reload();
//             }
//         };
//         xhr.send("regno=" + regno);
//     }
// }


  // MY TRY:
//delete button in listed lost items
// $(document).ready(function(){
//   $("#lostTable").on('click','.btnDelete',function(){
//       $(this).closest('tr').remove();
//    });
// });

// function SomeDeleteRowFunction(o) {
//   var p=o.parentNode.parentNode;
//       p.parentNode.removeChild(p);
//  }  


  // Before GPT:
//  function SomeDeleteRowFunction(){
//    return confirm('Are you sure you want to Delete this Record?');
//  }