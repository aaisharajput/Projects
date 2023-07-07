let saller_name = document.getElementById("saller_name");
let stock = document.getElementById("stock");
let p_name = document.getElementById("p_name");
let price = document.getElementById("price");
let color = document.getElementById("color");
let shipping_charges = document.getElementById("shipping_charges");
let p_details = document.getElementById("p_details");
let img = document.getElementById("img");
let wrong = document.getElementById("wrong");
let addbtn = document.getElementById("addbtn");
let updt = document.getElementById("updt");
let u_id, u_img;

products();

function admin_product(callback) {
  let request = new XMLHttpRequest();
  request.open("POST", "/admin");
  request.send();
  request.addEventListener("load", function () {
    callback(JSON.parse(request.responseText));
  });
}

function products() {
  admin_product((data) => {
    let list = document.getElementById("list");
    let details = Object.keys(data);
    details.forEach(function (i) {
      list.innerHTML += `<div class="col-12 col-md-3 pt-5" id="col${data[i].id}">
                    <div class="card">
                       <div class="img">
                          <img src="/${data[i].img}" alt="${data[i].img}">
                          <div class="card-text pl-2 pt-3">
                             <h5>${data[i].p_name}</h5>
                             <p>Price: ₹${data[i].price}</p>
                             <p>Available: ${data[i].stock}</p>
                          </div>
                          <div class="btnn d-flex justify-content-around">
                             <button type="submit" class="btn btn-danger" onclick="delete_item(${data[i].id})">Delete</button>
                             <button class="btn btn-primary" onclick="update(${data[i].id})"><a class="up" href="#msg">Update</a></button>

                          </div>
                          
                       </div>
                    </div>
                 </div>
            `;
    });
  });
}

function verify_fields() {
  if (
    saller_name.value.trim() == "" ||
    stock.value.trim() == "" ||
    p_name.value.trim() == "" ||
    price.value.trim() == "" ||
    color.value.trim() == "" ||
    shipping_charges.value.trim() == "" ||
    p_details.value.trim() == "" ||
    img.value.trim() == ""
  ) {
    wrong.innerText = "Empty fields or spaces is not allowed!!";
    return false;
  } else if (
    saller_name.value.match(/\d/) || saller_name.value.match(/[!@#$%^&*()_+\-=\[\]{};':"\\|,<>\/?]+/)) {
    wrong.innerText = "Saller name must be a characters only!!";
    return false;
  } else if (color.value.match(/\d/) || color.value.match(/[!@#$%^&*()_+\-=\[\]{};':"\\|,<>\/?]+/)) {
    wrong.innerText = "Color must be a characters only!!";
    return false;
  } else if (stock.value.match(/\D/)) {
    wrong.innerText = "Stock must be a digit!!";
    return false;
  } else if (price.value.match(/\D/)) {
    wrong.innerText = "Price must be a digit!!";
    return false;
  } else if (shipping_charges.value.match(/\D/)) {
    wrong.innerText = "Shipping charges must be a digit!!";
    return false;
  } else if (/\.(jpeg|png|jpg)$/i.test(img.files[0].name) === false) {
    wrong.innerText = "Format is invalid!!";
    return false;
  } else if (img.files[0].size > 256000) {
    wrong.innerText = "To large file!!";
    return false;
  } else {
    addbtn.disabled = true;
    return true;
  }
}

function update(id) {
  get_details(id, (details) => {
    u_id = id;
    u_img = details[0].img;
    saller_name.value = details[0].saller_name;
    stock.value = details[0].stock;
    p_name.value = details[0].p_name;
    price.value = details[0].price;
    color.value = details[0].color;
    shipping_charges.value = details[0].shipping_charges;
    p_details.value = details[0].p_details;
    updt.disabled = false;
    addbtn.disabled = true;
  });
}

updt.addEventListener("click", () => {
  if (
    saller_name.value.trim() == "" ||
    stock.value.trim() == "" ||
    p_name.value.trim() == "" ||
    price.value.trim() == "" ||
    color.value.trim() == "" ||
    shipping_charges.value.trim() == "" ||
    p_details.value.trim() == ""
  ) {
    wrong.innerText = "Empty fields or spaces is not allowed!!";
  } else if (saller_name.value.match(/\d/) || saller_name.value.match(/[!@#$%^&*()_+\-=\[\]{};':"\\|,<>\/?]+/)) {
    wrong.innerText = "Saller name must be a characters only!!";
  } else if (color.value.match(/\d/) || color.value.match(/[!@#$%^&*()_+\-=\[\]{};':"\\|,<>\/?]+/)) {
    wrong.innerText = "Color must be a characters only!!";
  } else if (stock.value.match(/D/)) {
    wrong.innerText = "Stock must be a digit!!";
  } else if (price.value.match(/D/)) {
    wrong.innerText = "Price must be a digit!!";
  } else if (
    shipping_charges.value.match(/D/)
  ) {
    wrong.innerText = "Shipping charges must be a digit!!";
  } else {
    let formData = new FormData();
    formData.append("id", u_id);
    formData.append("saller_name", saller_name.value);
    formData.append("stock", stock.value);
    formData.append("p_name", p_name.value);
    formData.append("price", price.value);
    formData.append("color", color.value);
    formData.append("p_details", p_details.value);
    formData.append("shipping_charges", shipping_charges.value);
    if (!img.value) formData.append("img", u_img);
    else {
      if (/\.(jpeg|png|jpg)$/i.test(img.files[0].name) === false) {
        wrong.innerText = "Format is invalid!!";
        return;
      } else if (img.files[0].size > 256000) {
        wrong.innerText = "To large file!!";
        return;
      } else {
        formData.append("img", img.files[0]);
      }
    }

    update_product(formData, (data) => {
      Swal.fire("Updated!", "Data has been updated successfully.", "success");
      document.getElementById("myForm").reset();
      addbtn.disabled = false;
      updt.disabled = true;
      wrong.innerText = "";
      let col_id=document.getElementById("col"+data.get('id'));
      col_id.innerHTML = `
      <div class="card">
         <div class="img">
            <img src="/${data.get('img')}" alt="${data.get('img')}">
            <div class="card-text pl-2 pt-3">
               <h5>${data.get('p_name')}</h5>
               <p>Price: ₹${data.get('price')}</p>
               <p>Available: ${data.get('stock')}</p>
            </div>
            <div class="btnn d-flex justify-content-around">
               <button type="submit" class="btn btn-danger" onclick="delete_item(${data.get('id')})">Delete</button>
               <button class="btn btn-primary" onclick="update(${data.get('id')})"><a class="up" href="#msg">Update</a></button>
            </div>
         </div>
      </div>`;
    });
  }
});

function update_product(data, callback) {
  let request = new XMLHttpRequest();
  request.open("POST", "/admin/admin_update_product");
  request.send(data);

  request.addEventListener("load", function () {
    callback(data);
  });
}

function get_details(id, callback) {
  let request = new XMLHttpRequest();
  request.open("POST", "/admin/single_product");
  request.setRequestHeader("Content-Type", "application/json");
  request.send(JSON.stringify({ id: id }));

  request.addEventListener("load", function () {
    callback(JSON.parse(request.responseText));
  });
}

function delete_item(id) {
  Swal.fire({
    title: "Are you sure?",
    text: "You want to delete it!!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!",
  }).then((result) => {
    if (result.isConfirmed) {
      dlt(id, () => {
        let col_id = document.getElementById("col" + id);
        col_id.remove();
      });
    }
  });
}

function dlt(id, callback) {
  let request = new XMLHttpRequest();
  request.open("POST", "/admin/admin_delete");
  request.setRequestHeader("Content-Type", "application/json");
  request.send(JSON.stringify({ id: id }));

  request.addEventListener("load", function () {
    let result = JSON.parse(request.responseText);
    if (result.dmsg) {
      Swal.fire("Deleted!", "Item has been deleted successfully.", "success");
      callback();
    } else {
      Swal.fire({
        title: "Error",
        text: result.err,
        icon: "warning",
      });
    }
  });
}
