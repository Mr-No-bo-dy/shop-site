// for some Entities' Update
let updatesbtn = document.querySelectorAll('.update')
updatesbtn.forEach(update => {
   update.onclick = () => {
      update.nextElementSibling.style.display = 'inline-block'
      update.style.display = 'none'
      update.closest('.inputs').querySelectorAll('input').forEach(input => {
         input.removeAttribute('readonly')
      })
      update.closest('.inputs').querySelectorAll('select').forEach(input => {
         input.removeAttribute('disabled')
      })
   }
})

// Get specific Product info via AJAX

// // 1 Example
// function viewPoduct() {
//    const xhttp = new XMLHttpRequest();
//    xhttp.onload = function () {
//       document.getElementById("viewProduct").innerHTML =
//          this.responseText;
//    }
//    xhttp.open("GET", "/ajax_info.html");
//    xhttp.send();
// }

// // 2 show file GET   // NO
// function viewPoduct() {
//    const xhr = new XMLHttpRequest();
//    xhr.onload = function () {
//       document.getElementById("viewProduct").innerHTML = this.responseText;
//    }
//    xhr.open("GET", "/app/resource/views/admin/product/show.php");
//    xhr.send();
// }

// // 3 show file POST
// function viewPoduct() {
//    const xhr = new XMLHttpRequest();
//    xhr.onreadystatechange = function () {
//       if (xhr.readyState == 4 && xhr.status == 200) {
//          document.getElementById("viewProduct").innerHTML = xhr.responseText;
//       }
//    }
//    xhr.open("POST", "/app/resource/views/admin/product/show.php", true);
//    // xhr.setRequestHeader("Content-Type", "application/json");   // для JSON
//    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");		// для echo(), тобто як шматок HTML
//    let productID = document.getElementById('productID');
//    let productName = document.getElementById('productName');
//    let params = "id_product=" + productID.value + "&name=" + productName.value;
//    xhr.send(params);
// }

// // 4 Route via POST  => wrong value
// function viewPoduct() {
//    const xhr = new XMLHttpRequest();
//    xhr.onreadystatechange = function () {
//       if (xhr.readyState == 4 && xhr.status == 200) {
//          document.getElementById("viewProduct").innerHTML = xhr.responseText;
//       }
//    }
//    xhr.open("POST", "/admin/product", true);
//    // xhr.setRequestHeader("Content-Type", "application/json");
//    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
//    // let productID = document.getElementById('productID');
//    // let productName = document.getElementById('productName');
//    // let params = "id=" + productID.value + "&name=" + productName.value;

//    let params = "id=" + document.getElementById('productID').value;
//    console.log(params);
//    // console.log(xhr.response);
//    xhr.send(params);
// }

// // 5 Route via POST => fixed
// function viewPoduct(clickedButton) {
//    const xhr = new XMLHttpRequest();
//    xhr.onreadystatechange = function () {
//       if (xhr.readyState == 4 && xhr.status == 200) {
//          document.getElementById("viewProduct").innerHTML = xhr.responseText;
//       }
//    }
//    xhr.open("POST", "/admin/product", true);
//    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
//    // let params = "";
//    // let inputs = document.querySelectorAll('.productID');
//    // inputs.forEach(productID => {
//    //    params += "id=" + productID.value + "&";
//    // });
//    // params = params.slice(0, -1);
//    let productID = clickedButton.previousElementSibling.value;
//    let params = "id=" + productID;
//    console.log(params);
//    xhr.send(params);
// }

// // 5a Route via POST => fixed + changed
// if (document.getElementsByClassName('.viewProductBtn')) {
//    const xhr = new XMLHttpRequest();
//    xhr.onreadystatechange = function () {
//       if (xhr.readyState !== 4 || xhr.status !== 200) {
//          console.log(xhr.status + " " + xhr.statusText);
//       } else {
//          document.getElementById("viewProduct").innerHTML = xhr.responseText;
//       }
//    }
//    xhr.open("POST", "/admin/product", true);
//    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
//    let inputs = document.querySelectorAll('.viewProductBtn');
//    let params = "";
//    inputs.forEach(input => {
//       input.addEventListener("click", function () {
//          params += "id=" + input.value;
//          console.log(params);
//          xhr.send(params);
//       });
//    });
// }

// // 6 GET with parameter
// if (document.getElementsByClassName('.viewProductBtn')) {
//    const xhr = new XMLHttpRequest();
//    xhr.onreadystatechange = function () {
//       if (xhr.readyState !== 4 || xhr.status !== 200) {
//          console.log (xhr.status + " " + xhr.statusText);
//       } else {
//          document.getElementById("viewProduct").innerHTML = xhr.responseText;
//       }
//    }
//    let inputs = document.querySelectorAll('.viewProductBtn');
//    inputs.forEach(input => {
//       input.addEventListener("click", function () {
//          xhr.open("GET", "/admin/product?id=" + input.value, true);
//          console.log(input.value);
//          xhr.send();
//       });
//    });
// }

// // 7 GET with parameter, Al_+_One__page   // On All_page request route to One_page
// if (document.getElementsByClassName('.viewProductBtn')) {
//    const xhr = new XMLHttpRequest();
//    xhr.onreadystatechange = function () {
//       if (xhr.readyState !== 4 || xhr.status !== 200) {
//          console.log (xhr.status + " " + xhr.statusText);
//       } else {
//          document.getElementById("viewProduct").innerHTML = xhr.responseText;
//       }
//    }
//    let inputs = document.querySelectorAll('.viewProductBtn');
//    inputs.forEach(input => {
//       input.addEventListener("click", function () {
//          xhr.open("GET", "/admin/product?id=" + input.value, true);
//          console.log(input.value);
//          xhr.send();
//       });
//    });
// }

// 8 GET with parameter, Al_+_One__page + Styles & Scripts   // On All_page request route to One_page
if (document.getElementsByClassName('.viewProductBtn')) {
   const xhr = new XMLHttpRequest();
   xhr.onreadystatechange = function () {
      if (xhr.readyState !== 4 || xhr.status !== 200) {
         console.log (xhr.status + " " + xhr.statusText);
      } else {
         document.getElementById("viewProduct").innerHTML = xhr.responseText;
         showPopup();
      }
   }
   let inputs = document.querySelectorAll('.viewProductBtn');
   inputs.forEach(input => {
      input.addEventListener("click", function () {
         xhr.open("GET", "/admin/product?id=" + input.value, true);
         console.log(input.value);
         xhr.send();
      });
   });

   function showPopup() {
      let popup = document.getElementById("viewProduct");
      popup.style.display = "block";
      // popup.style.position = "absolute";
      // popup.style.top = "50%";
      popup.style.position = "fixed";
      popup.style.bottom = "-50%";
      popup.style.left = "50%";
      popup.style.transform = "translate(-50%, -50%)";
      popup.style.height = "auto";
      popup.style.width = "auto";
      popup.style.zIndex = "1000";
      popup.style.backgroundColor = "#fff";
      popup.style.border = "1px solid #000";
      popup.style.padding = "20px";
      popup.style.overflow = "auto";
      popup.style.boxShadow = "0 4px 8px rgba(0, 0, 0, 0.1)";
   
      let closeButton = document.createElement("span");
      closeButton.innerHTML = "&times;";
      closeButton.style.position = "absolute";
      closeButton.style.fontSize = "20px";
      closeButton.style.color = "gray";
      closeButton.style.zIndex = "1";
      closeButton.style.backgroundColor = "white";
      closeButton.style.top = "10px";
      closeButton.style.right = "10px";
      closeButton.style.cursor = "pointer";
      closeButton.onclick = closePopup;
      popup.appendChild(closeButton);
   }
   
   function closePopup() {
      let popup = document.getElementById("viewProduct");
      popup.style.display = "none";
      popup.innerHTML = "";
   }
}

