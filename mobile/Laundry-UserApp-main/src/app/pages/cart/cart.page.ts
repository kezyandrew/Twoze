import { Component, OnInit } from "@angular/core";
import { ModalController } from "@ionic/angular";
import { ApiService } from "src/app/api.service";
import { AddAddressPage } from "src/app/modals/add-address/add-address.page";
import { CalendarPage } from "src/app/modals/calendar/calendar.page";
import { UtilService } from "src/app/util.service";
import { LoginPage } from "../login/login.page";
import { ManageAddressPage } from "../manage-address/manage-address.page";

@Component({
  selector: "app-cart",
  templateUrl: "./cart.page.html",
  styleUrls: ["./cart.page.scss"],
})
export class CartPage implements OnInit {
  address: any = "";
  date: any;
  totalBill = 0;
  currency: any;
  payment: number;
  addressDiv: any = [];
  constructor(
    private modal: ModalController,
    private util: UtilService,
    private api: ApiService
  ) {}

  ngOnInit() {}

  public backIcon = "../../../assets/icon/login.svg";

  async manageAddress() {
    localStorage.setItem('isFrom','cart')
    const modal = await this.modal.create({
      component: ManageAddressPage,
    });
    modal.onDidDismiss().then((res) => {
      localStorage.setItem("address-id", res.data.id);
      this.address = res.data.addr1;
      localStorage.removeItem('isFrom')
    });
    return await modal.present();
  }

  makePay() {
    if (this.totalBill == 0) {
    }  else if (this.address == "") {
      this.util.presentToast("Address are Required");
    } else {
      this.util.navCtrl.navigateForward("tabs/home/make-payment");
    }
  }
  async presentModal() {
    const modal = await this.modal.create({
      component: CalendarPage,
      cssClass: "calendar",
    });
    modal.onDidDismiss().then((res) => {
      this.date = this.api.date;
      localStorage.setItem("date", this.api.date);
    });
    return await modal.present();
  }

  cartDataDisplay: any = [];
  service: any = [];
  tot = 0;
  ionViewWillEnter() {
    this.cartDataDisplay = JSON.parse(localStorage.getItem("cart-data"));
    this.cartDataDisplay.forEach((element) => {
      element.total = element.service.qty * element.service.price;
      this.totalBill += element.total;
      localStorage.setItem("totalQty", this.api.qty);
      this.service = element.service;
      this.service.forEach((element) => {
        let price = JSON.parse(element.price) * element.qty;
        this.tot += element.total;
        this.api.total = this.tot;
        this.api.qty += element.qty;
        localStorage.setItem("totalAmount", this.api.total);
      });
    });

    this.util.startLoad();
    setTimeout(async () => {
      this.currency = localStorage.getItem("currency_symbol");
      let token = localStorage.getItem("token")
        ? localStorage.getItem("token")
        : "";
      if (token == "") {
        localStorage.setItem("previous-request", "true");
        localStorage.setItem("previous-request-page", "tabs/home/cart");
        const modal = await this.modal.create({
          component: LoginPage,
        });
        modal.present();
        modal.onDidDismiss().then(() => {
          this.util.startLoad();
          this.api.getDataWithToken("all_address").subscribe(
            (success: any) => {
              if (success.success) {
                this.addressDiv = success.data;
                this.util.dismissLoader();
              }
            },
            (err) => {}
          );
        });
      }
      let hasPre = localStorage.getItem("previous-request")
        ? localStorage.getItem("previous-request")
        : false;
      let prePage = localStorage.getItem("previous-request-page")
        ? localStorage.getItem("previous-request-page")
        : "";
      if (hasPre == "true" && prePage == "cart") {
        localStorage.setItem("previous-request", "true");
        this.util.setNewLogin(true);
      }

      this.util.dismissLoader();
    }, 1000);

    this.util.startLoad();
    this.api.getDataWithToken("all_address").subscribe(
      (success: any) => {
        if (success.success) {
          this.addressDiv = success.data;
          this.util.dismissLoader();
        }
      },
      (err) => {}
    );
  }

  async addresss() {
    
    const modal = await this.modal.create({
      component: AddAddressPage,
      cssClass: "manage-address",
    });
    modal.onDidDismiss().then((res) => {
      this.address = res.data.addr1;
      localStorage.setItem("address-id", res.data.id);
      localStorage.removeItem('marketLat');
      localStorage.removeItem('marketLng')
    });
    return await modal.present();
  }
}
