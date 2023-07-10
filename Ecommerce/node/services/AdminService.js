import { read_file } from "./UserDB.js";
import fs from "fs";
//admin
//done
export const loadAdminProduct = (req, res) => {
  let sql = `Select * from product_details`;
  read_file(res, sql, (err, details) => {
    if (err) res.json(0);
    else res.json(details);
  });
};

export const deleteAdminProduct = (req, res) => {
  const p_id = req.body.id;
  let sql = `select img from product_details where id=${p_id}`;
  read_file(res, sql, (err, result) => {
    if (err) res.json({ err: "Error Occured!! " + err });
    else {
        fs.unlink("./img/" + result[0].img, function (err) {
            if (err) console.log(err);
          });
    }
  });
  
  sql = `delete from product_details where id=${p_id}`;
  read_file(res, sql, (err, result) => {
    if (err) res.json({ err: "Error Occured!! " + err });
    else res.json({ dmsg: "deleted" });
  });

};

//done
export const addAdminProduct = (req, res, next) => {
  let id = Date.now();
  let stock = req.body.stock;
  let saller_name = req.body.saller_name;
  let img = req.file.filename;
  let p_name = req.body.p_name;
  let price = req.body.price;
  let color = req.body.color;
  let shipping_charges = req.body.shipping_charges;
  let p_details = req.body.p_details;
  let sql = `insert into product_details values(${id},${stock},'${saller_name}','${img}','${p_name}',${price},'${color}',${shipping_charges},'${p_details}')`;
  read_file(res, sql, (err, result) => {
    if (err)
      res.render("admin", {
        user: req.session.user.user,
        msg: "Error Occured!! " + err,
      });
    else {
      next();
      return;
    }
  });
};

//done
export const updateAdminProduct = (req, res, next) => {
  const p_data = req.body;
  if (p_data.img == undefined) p_data["img"] = req.file.filename;

  let sql = `Update product_details set stock=${p_data.stock},saller_name='${p_data.saller_name}',img='${p_data.img}',p_name='${p_data.p_name}',price=${p_data.price},color='${p_data.color}',shipping_charges=${p_data.shipping_charges},p_details='${p_data.p_details}' where id=${p_data.id}`;
  read_file(res, sql, (err, result) => {
    if (err) res.json({ msg: "Error Occured!! " + err });
    else {
      next();
      return;
    }
  });
};

//done
export const chkAdmin = (req, res, next) => {
  if (req.session.isloginAdmin) {
    res.render("admin", { user: req.session.user.user, msg: "" });
  } else {
    next();
    return;
  }
};
