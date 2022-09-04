import { escapeRegExp } from "@angular/compiler/src/util";
import { Component, OnInit } from "@angular/core";
import { Router } from "@angular/router";
import { ApiService } from "src/app/api.service";
import { UtilService } from "src/app/util.service";

@Component({
  selector: "app-product-view",
  templateUrl: "./product-view.page.html",
  styleUrls: ["./product-view.page.scss"],
})
export class ProductViewPage implements OnInit {
  currency: any;
  id: any;
  services: any = [];
  type: any;
  constructor(
    private api: ApiService,
    private util: UtilService,
    private router: Router
  ) {
    if (this.router.getCurrentNavigation().extras.state) {
      this.id = this.router.getCurrentNavigation().extras.state.id;
    }
  }
  productName: string = "";
  qty = 0;
  products: any = [];
  cartData = [];
  ngOnInit() {
    this.util.startLoad();
    this.productName = this.api.service_name;
    this.currency = localStorage.getItem("currency_symbol");
    let data = {
      service_id: localStorage.getItem("product-id"),
    };
    this.cartData = JSON.parse(localStorage.getItem("cart-data"))
      ? JSON.parse(localStorage.getItem("cart-data"))
      : [];
    this.api.postData("service_product", data).subscribe(
      (success: any) => {
        this.products = success.data;

        this.products.forEach((element) => {
          element.qty = this.qtyGet(element.id);
        });
        this.util.dismissLoader();
      },
      (err) => {
        this.util.dismissLoader();
      }
    );

    this.api.getData("settings").subscribe(
      (success: any) => {
        this.type = success.data.cloth_unit;
      },
      (err) => {}
    );
  }

  addToCart(item) {
    item.qty = item.qty + 1;
    let data = {
      single_service_id: this.id,
      qty: item.qty,
      name: item.name,
      price: item.price,
      total: JSON.parse(item.price),
      type: item.service_name,
    };
    this.cartData = JSON.parse(localStorage.getItem("cart-data"))
      ? JSON.parse(localStorage.getItem("cart-data"))
      : [];

    if (this.cartData.length > 0) {
      let product = this.cartData.find((e) => e.id == item.id);

      if (product && product.service) {
        const single = product.service.find(
          (e) => e.single_service_id == this.id
        );
        if (single) {
          single.qty += 1;
          single.price = item.price;
          single.total = item.price * single.qty;
        } else {
          product.service.push(data);
        }
      } else {
        product = item;
        product.service = [];
        product.service.push(data);
        this.cartData.push(product);
      }
    } else {
      item.service = [];

      item.service.total = 1 * JSON.parse(data.price);
      item.service.push(data);
      this.cartData.push(item);
    }

    localStorage.setItem("cart-data", JSON.stringify(this.cartData));
    localStorage.setItem("cart-data", JSON.stringify(this.cartData));
  }

  back() {
    this.util.navCtrl.navigateBack("tabs/home");
  }

  minusFromCart(item) {
    if (item.qty !== 0) {
      item.qty--;
      item.total = item.qty * item.price;
      let data = {
        single_service_id: this.id,
        qty: item.qty,
        total: item.total,
        name: item.name,
        price: item.price,
        type: item.service_name,
      };
      let product = this.cartData.find((e) => e.id == item.id);

      if (product && product.service) {
        const single = product.service.find(
          (e) => e.single_service_id == this.id
        );
        if (single) {
          if (product.service.length != 0)
            if (single.qty != 1) {
              single.qty--;
              single.price = item.price;

              single.total = item.price * single.qty;
            } else {
              const index = product.service.indexOf(single, 0);

              if (index > -1) {
                product.service.splice(index, 1);
                if (product.service.length == 0) {
                  const cindex = this.cartData.indexOf(product, 0);
                  if (cindex > -1) {
                    this.cartData.splice(cindex, 1);
                  }
                }
              }
            }
        } else {
          product.service.splice(data);
        }
      } else {
        product = item;
        product.service = [];
        product.service.splice(data);
        this.cartData.splice(product);
      }
    }
    localStorage.setItem("cart-data", JSON.stringify(this.cartData));
  }

  qtyGet(id) {
    let product = this.cartData.find((e) => e.id == id);

    if (product) {
      const single = product.service.find(
        (e) => e.single_service_id == this.id
      );

      if (single) {
        return single.qty;
      } else {
        return 0;
      }
    }
    return 0;
  }
}
